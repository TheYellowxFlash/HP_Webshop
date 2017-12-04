<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function toggleTabellen(){
            $('#aanpassenTabel').toggle();
            $('#overzichtTabel').toggle();
            $('.toggleButton').toggle();
        }

        $(document).ready(function () {
            setInterval(function() {
                if ($("input[name='email']").val() == "" ||
                    $("input[name='voornaam']").val() == "" ||
                    $("input[name='achternaam']").val() == "" ||
                    $("input[name='huisnummer']").val() == "" ||
                    $("input[name='postcode']").val() == "" ||
                    $("input[name='straat']").val() == "" ||
                    $("input[name='woonplaats']").val() == "") {
                    $("input[name='submitForm']").attr("disabled", "disabled");
                }
                else{
                    $("input[name='submitForm']").removeAttr("disabled");
                }
            }, 10);
        });
    </script>

    <link rel="stylesheet" href="klantInfo.css"/>
</head>

<?php
session_start();

        include("include/dbconnect.php");;
        $result = $conn->query("SELECT Klantnummer FROM klant WHERE Email='" . $_SESSION["login"] . "';");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kNum = $row["Klantnummer"];
            }
        }
        $conn->close();

    if(isset($_SESSION["updateSuccesful"])){
        $updateSuccesful = true;
        unset($_SESSION["updateSuccesful"]);
    }

    if(isset($_POST["submitForm"])){
        $email = $_POST["email"];
        $voornaam = $_POST["voornaam"];
        $tussenvoegsel = $_POST["tussenvoegsel"];
        $achternaam = $_POST["achternaam"];
        $huisnummer = $_POST["huisnummer"];
        $postcode = $_POST["postcode"];
        $straat = $_POST["straat"];
        $woonplaats = $_POST["woonplaats"];

        include("include/dbconnect.php");;
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE klant SET
        Email='" . $email . "',
        Voornaam='" . $voornaam . "',
        Tussenvoegsel='" . $tussenvoegsel . "',
        Achternaam='" . $achternaam . "'
        WHERE Klantnummer=" . $kNum . ";";
        $sql2 = "UPDATE locatie SET
        Huisnummer='" . $huisnummer . "',
        Postcode='" . $postcode . "',
        Straat='" . $straat . "',
        Woonplaats='" . $woonplaats . "'
        WHERE Klantnummer=" . $kNum . ";";

        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            $_SESSION["updateSuccesful"] = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        header('Location: '.$_SERVER['PHP_SELF']);
    }
    else {
        include("include/dbconnect.php");;
        $result = $conn->query("SELECT k.Email, k.Voornaam, k.Tussenvoegsel, k.Achternaam, l.Huisnummer, l.Postcode, l.Straat, l.Woonplaats FROM klant k JOIN locatie l ON k.Klantnummer=l.Klantnummer WHERE k.Klantnummer=" . $kNum . ";");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $email = $row["Email"];
                $voornaam = $row["Voornaam"];
                $tussenvoegsel = $row["Tussenvoegsel"];
                $achternaam = $row["Achternaam"];
                $huisnummer = $row["Huisnummer"];
                $postcode = $row["Postcode"];
                $straat = $row["Straat"];
                $woonplaats = $row["Woonplaats"];
            }
        }
        $conn->close();
    }

    if(isset($updateSuccesful)){
        echo "U heeft uw gegevens succesvol geupdate ;)";
        unset($updateSuccesful);
    }
?>

<body>
    <div class="container-fluid">
        <h2>Klant-overzicht</h2>
    </div>
    <div class="col-md-6">
        <h4>Persoonsgegevens</h4>
        <table class="table-bordered table-hover" id="overzichtTabel">
            <tr>
                <!-- E-mail adres -->
                <td><?php echo $email ?></td>
            </tr>
            <tr>
                <!-- Naam -->
                <td><?php echo $voornaam . " " . $tussenvoegsel . " " . $achternaam ?></td>
            </tr>
            <tr>
                <!-- Adres -->
                <td><?php echo $straat . " " . $huisnummer ?></td>
            </tr>
            <tr>
                <!-- Postcode -->
                <td><?php echo $postcode ?></td>
            </tr>
            <tr>
                <!-- Woonplaats -->
                <td><?php echo $woonplaats ?></td>
            </tr>
        </table>

        <form method="post" action="">
        <table class="table-bordered table-hover" id="aanpassenTabel" style="display: none;">
                <tr>
                    <!-- E-mail adres -->
                    <th>E-mail adres</th>
                    <td><input name="email" type="text" placeholder="E-mail adres" value="<?php echo $email ?>"></td>
                </tr>
                <tr>
                    <!-- Voornaam -->
                    <th>Voornaam</th>
                    <td><input name="voornaam" type="text" placeholder="Voornaam" value="<?php echo $voornaam ?>"></td>
                </tr>
                <tr>
                    <!-- Tussenvoegsel -->
                    <th>Tussenvoegsel</th>
                    <td><input name="tussenvoegsel" type="text" placeholder="Tussenvoegsel" value="<?php echo $tussenvoegsel ?>"></td>
                </tr>
                <tr>
                    <!-- Achternaam -->
                    <th>Achternaam</th>
                    <td><input name="achternaam" type="text" placeholder="Achternaam" value="<?php echo $achternaam ?>"></td>
                </tr>
                <tr>
                    <!-- Straat -->
                    <th>Straat</th>
                    <td><input name="straat" type="text" placeholder="Straat" value="<?php echo $straat ?>"></td>
                </tr>
                <tr>
                    <!-- Huisnummer -->
                    <th>Huisnummer</th>
                    <td><input name="huisnummer" type="text" placeholder="Huisnummer" value="<?php echo $huisnummer ?>"></td>
                </tr>
                <tr>
                    <!-- Postcode -->
                    <th>Postcode</th>
                    <td><input name="postcode" type="text" placeholder="Postcode" value="<?php echo $postcode ?>"></td>
                </tr>
                <tr>
                    <!-- Woonplaats -->
                    <th>Woonplaats</th>
                    <td><input name="woonplaats" type="text" placeholder="Woonplaats" value="<?php echo $woonplaats ?>"></td>
                </tr>
        </table>

        <button type="button" class="toggleButton" onclick="toggleTabellen()">Wijzig gegevens</button>
        <input type="submit" name="submitForm" class="toggleButton" style="display: none;" value="Wijzigen"/>
        <button type="button" class="toggleButton" onclick="toggleTabellen()" style="display: none;">Annuleren</button>
        <a href="login.php"><button type="button" class="toggleButton">Home</button></a>
        </form>

    </div>
    <div class="col-md-6">
        <h4>Bestelgeschiedenis</h4>
    </div>
</body>