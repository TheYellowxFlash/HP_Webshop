<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function checkAllFields(){
        if(emailCorrect && passwordCorrect && informationComplete){
            $("input[name='register']").removeAttr("disabled");
        }
        else{
            $("input[name='register']").attr("disabled", "disabled");
        }
    }

    $(function(){
        var validateEmail = function(elementValue) {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(elementValue);
        }

        $('#submit').click(function() {
            var value = $('input[name="email"]').val();
            var valid = validateEmail(value);
            if (!valid) {
                alert("Please enter a valid email");
                return false;
            }
        });

        $('input[name="email"]').keyup(function() {

            var value = $(this).val();
            var valid = validateEmail(value);

            if (!valid) {
                $("#emailTypeError").html("<p1 style='color: red;'>Email niet geldig!</p1>");
                emailCorrect = false;
            } else {
                $("#emailTypeError").html("<p1 style='color: lime;'>Email geldig!</p1>");
                emailCorrect = true;
            }

            checkAllFields();

        });
    });

    function openRegForm()
    {
        $("#registerForm").slideToggle();
        $("#loginForm").slideToggle();
        $("#passwordMatchError").html("");
    }

    function checkPasswordMatch() {
        var password = $("input[name='wachtwoord1']").val();
        var confirmPassword = $("input[name='wachtwoord2']").val();

        if (password != confirmPassword) {
            $("#passwordMatchError").html("<p1 style='color: red;'>Wachtwoorden komen niet overeen!</p1>");
            passwordCorrect = false;
        }
        else {
            $("#passwordMatchError").html("<p1 style='color: lime;'>Wachtwoorden komen overeen!</p1>");
            passwordCorrect = true;
        }

        checkAllFields();
    }

    function checkInformation(){
        if($("input[name='voornaam']").val() == "" ||
            $("input[name='achternaam']").val() == "" ||
            $("input[name='straat']").val() == "" ||
            $("input[name='huisnummer']").val() == "" ||
            $("input[name='postcode']").val() == "" ||
            $("input[name='woonplaats']").val() == ""){
            informationComplete = false;
        }
        else{
            informationComplete = true;
        }

        checkAllFields();
    }

    $(document).ready(function () {
        $("input[name='wachtwoord2']").keyup(checkPasswordMatch);

        $("input[name='voornaam']").keyup(checkInformation);
        $("input[name='achternaam']").keyup(checkInformation);
        $("input[name='straat']").keyup(checkInformation);
        $("input[name='huisnummer']").keyup(checkInformation);
        $("input[name='postcode']").keyup(checkInformation);
        $("input[name='woonplaats']").keyup(checkInformation);

        var emailCorrect = false;
        var passwordCorrect = false;
        var informationComplete = false;
    });
</script>

<?php
function generateRandomString($length) {
    $poss = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $rand = '';
    for ($i = 0; $i < $length; $i++) {
        $rand .= $poss[rand(0, strlen($poss) - 1)];
    }
    return $rand;
}

function generateSalt(){
    $salt = "";
    //Genereer salt als random-nummer, en check of deze nog niet bestaat
    include("include/dbconnect.php");
    $result = $conn->query("SELECT Salt FROM klant");
    if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $oldSalts[$i] = $row["Salt"];
            $i++;
        }
    }
    $conn->close();

    for($i = 0; $i < count($oldSalts); $i++) {
        while ($salt == "" || $salt == $oldSalts[$i]) {
            $salt = generateRandomString(15);
        }
    }

    return $salt;
}

function hashPass($pass, $salt){
    //Verleng salt totdat deze even lang is als het opgegeven wachtwoord
    while(strlen($pass) > strlen($salt)){
        $salt = $salt.$salt;
    }
    while(strlen($salt) > strlen($pass)){
        $salt = substr($salt, 0, -1);
    }

    $hashable = "";
    for($i = 0; $i < strlen($pass); $i++) {
        $hashable = $hashable . substr($pass, $i, 1) . substr($salt, $i, 1);
    }

    //Hash the hashable string a couple of times
    $hashedData = $hashable;
    for($i = 0; $i < 10000; $i++){
        $hashedData = hash('sha512', $hashedData);
    }

    return $hashedData;
}

session_start();

//Genereer salt als random-nummer, en check of deze nog niet bestaat
include("include/dbconnect.php");
$result = $conn->query("SELECT Email, Wachtwoord, Salt, Rol_ID FROM klant");
if ($result->num_rows > 0) {
    $i = 0;
    while($row = $result->fetch_assoc()) {
        $email[$i] = $row["Email"];
        $pass[$i] = $row["Wachtwoord"];
        $salts[$i] = $row["Salt"];
        $rol[$i] = $row["Rol_ID"];
        $i++;
    }
}
$conn->close();

if(isset($_SESSION["wrongLogin"])){
    $wrongLogin = true;
    unset($_SESSION["wrongLogin"]);
}
if(isset($_SESSION["logout"])){
    $logout = true;
    unset($_SESSION["logout"]);
}
if(isset($_SESSION["registerSuccesful"])){
    $registerSuccesful = $_SESSION["registerSuccesful"];
    unset($_SESSION["registerSuccesful"]);
}

if(isset($_POST["login"])){
    $loginCheck = false;

    for($i = 0; $i < count($email); $i++){
        if($_POST["email"] == $email[$i] && hashPass($_POST["pass"], $salts[$i]) == $pass[$i]){
            $_SESSION["login"] = $_POST["email"];
            $_SESSION["rol"] = 1;
            $loginCheck = true;
        }
    }

    if(!$loginCheck){
        $_SESSION["wrongLogin"] = true;
    }

    header('Location: '.$_SERVER['PHP_SELF']);
}
if(isset($_POST["logout"])){
    unset($_SESSION["login"]);
    $_SESSION["logout"] = true;
    header('Location: '.$_SERVER['PHP_SELF']);
}


if(isset($wrongLogin)){
    echo "<p>Inloggegevens incorrect.</p>";
    unset($wrongLogin);
}
if(isset($logout)){
    echo "<p>U bent uitgelogd.</p>";
    unset($logout);
}

if(isset($_SESSION["login"])){
    echo "<p>Ingelogd als " . $_SESSION["login"] . ". <a href='klantInfo.php'><button>Persoonsgegevens inzien</button></a>
            <br>
            <form method='post' action=''>
                <input type='submit' name='logout' value='Log uit'/>
            </form>";

    if($_SESSION['rol'] == 2 && $_SESSION['rol'] == 3){
        echo"<a href='ProductToevoegen.php'><button>Producten Inzien</button></a>";
    }
}
else{
    echo'<form id="loginForm" method="post" action="">
                <input type="text"      name="email"    placeholder="E-mail adres"/><br>
                <input type="password"  name="pass"     placeholder="Wachtwoord"/><br>
                <input type="submit"    name="login"    value="Log in"/>
                <button type="button" onclick="openRegForm()">Registreer</button>
            </form>';
}


if(isset($_POST["register"])){
    if($_POST["voornaam"] != "" &&
        $_POST["achternaam"] != "" &&
        $_POST["straat"] != "" &&
        $_POST["huisnummer"] != "" &&
        $_POST["postcode"] != "" &&
        $_POST["woonplaats"] != "" &&
        $_POST["email"] != "" &&
        $_POST["wachtwoord1"] != "" &&
        $_POST["wachtwoord1"] == $_POST["wachtwoord2"]) {
        $newSalt = generateSalt();

        include("include/dbconnect.php");
        $result = $conn->query("SELECT MAX(Klantnummer) FROM klant");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nieuwKlantNummer = $row["MAX(Klantnummer)"] + 1;
            }
        }
        $conn->close();

        // Create connection
        include("include/dbconnect.php");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO klant VALUES('" . $nieuwKlantNummer . "', '" . $_POST["email"] . "', '" . $_POST["voornaam"] . "', '" . $_POST["tussenvoegsel"] . "', '" . $_POST["achternaam"] . "', '" . hashPass($_POST["wachtwoord1"], $newSalt) . "', '1', '" . $newSalt . "');";
        $sql2 = "INSERT INTO locatie VALUES('" . $nieuwKlantNummer . "', '" . $_POST["huisnummer"] . "', '" . $_POST["postcode"] . "', '" . $_POST["straat"] . "', '" . $_POST["woonplaats"] . "')";

        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            $_SESSION["registerSuccesful"] = true;
            echo "U bent succesvol geregistreerd ;)";
            $_SESSION["rol"] = 1;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $_SESSION["registerSuccesful"] = false;
        }

        $conn->close();
    }
    else{
        $_SESSION["registerSuccesful"] = false;
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
}


if(isset($registerSuccesful)){
    if($registerSuccesful == true) {
        echo "U bent succesvol geregistreerd ;)";
        unset($registerSuccesful);
    }
    else{
        echo "Registratie gefaald, missende informatie.";
        unset($registerSuccesful);
    }
}
?>

<form id="registerForm" style="display: none;" method="post" action="">
    <input type="text"      name="voornaam"         placeholder="Voornaam"/><br>
    <input type="text"      name="tussenvoegsel"    placeholder="Tussenvoegsel"/><br>
    <input type="text"      name="achternaam"       placeholder="Achternaam"/><br>
    <input type="text"      name="straat"           placeholder="Straat"/><br>
    <input type="text"      name="huisnummer"       placeholder="Huisnummer"/><br>
    <input type="text"      name="postcode"         placeholder="Postcode"/><br>
    <input type="text"      name="woonplaats"       placeholder="Woonplaats"/><br>
    <input type="text"      name="email"            placeholder="E-mail adres"/><p1 id="emailTypeError"></p1><br>
    <input type="password"  name="wachtwoord1"      placeholder="Wachtwoord"/><br>
    <input type="password"  name="wachtwoord2"      placeholder="Wachtwoord herhalen"/><p1 id="passwordMatchError"></p1><br>
    <input type="submit"    name="register"         value="Registreer"  disabled="false"/>
    <button type="button" onclick="openRegForm()">Annuleer</button>
</form>