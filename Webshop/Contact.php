<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Item - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../Webshop/css/shop-contact.css" rel="stylesheet">
    <link href="../Webshop/css/shop-homepage.css" rel="stylesheet">

    <?php
        include ('../include/header.php');
        ?>

</head>
<body>


<!-- Page Content -->
    <br>
<div class="container">
    <h1 class="my-4 infoBox">Contact met Hair Plaza</h1>
</div>

<?php

        $opgeslagenVoornaam = "";
        $opgeslagenAchternaam = "";
        $opgeslagenEmail = "";
        $opgeslagenBericht = "";
        $opgeslagenTelefoonnummer = "";

        if(isset($_POST['contactSubmit'])) {
            $voornaam = $_POST['voornaam'];
            $achternaam = $_POST['achternaam'];
            $email = $_POST['email'];
            $telefoonnummer = $_POST['telefoonnummer'];
            $bericht = $_POST['bericht'];


            if (isset($_SESSION['Formulier'])) {
                $_SESSION['voornaam'] = $voornaam;
                $_SESSION['achternaam'] = $achternaam;
                $_SESSION['email'] = $email;
                $_SESSION['telefoonnummer'] = $telefoonnummer;
                $_SESSION['bericht'] = $bericht;
            }
            if (isset($_SESSION['voornaam'])) {
                $opgeslagenVoornaam = $_SESSION['voornaam'];
            }
            if (isset($_SESSION['achternaam'])) {
                $opgeslagenAchternaam = $_SESSION['achternaam'];
            }
            if (isset($_SESSION['email'])) {
                $opgeslagenEmail = $_SESSION['email'];
            }
            if (isset($_SESSION['telefoonnummer'])) {
                $opgeslagenTelefoonnummer = $_POST['telefoonnummer'];
            }
            if (isset($_SESSION['bericht'])) {
                $opgeslagenBericht = $_POST['bericht'];
            }
        }

?>

<?php
if(isset($_POST['contactSubmit'])){
    $van = "stefangrebenar@hotmail.com";
    $naar = $_POST['email'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $onderwerp = "Contactformulier";
    $onderwerp2 = "Kopie van het contactformulier";
    $bericht = $voornaam . " " . $achternaam . " heeft het volgende bericht gestuurd:" . "\n\n" . $_POST['bericht'];
    $bericht2 = "Dit is een kopie van het bericht " . $voornaam . "\n\n" . $_POST['bericht'];

    $headers = "Van:" . $van;
    $headers2 = "Van:" . $naar;
    mail($van,$onderwerp,$bericht,$headers);
    mail($naar,$onderwerp2,$bericht2,$headers2);
}
?>

<script>


    function validateField(fieldName) {
        var field = document.getElementById(fieldName);

        if(field.value.length <= 0) {
            field.style.borderColor = "Red";
        }
        else if(/[0-9]/.test(field.value)) {
            field.style.borderColor = "Red";
        }
        else {
            field.style.borderColor = "Green";
        }
    }


//    <form>
//    <label> Voornaam </label>
//    <br>
//    <input type="text" id="voornaam" onkeyup="validateField('voornaam')">
//        <br>
//        <label> Achternaam </label>
//        <br>
//        <input type="text" id="achternaam" onkeyup="validateField('achternaam')">
//        <br>
//        <label> Email </label>
//        <br>
//        <input type="text" id="email" onkeyup="validateField('email')">
//        <br>
//        <label> Telefoonnummer </label>
//        <br>
//        <input type="text" id="telefoonnummer" onkeyup="validateField('telefoonnummer')">
//        <br>
//        <label> Bericht </label>
//        <br>
//        <textfield type="text" id="bericht" onkeyup="validateField('bericht')">
//        </textfield>
//        </form>

</script>

    <div class="panel panel-default col-md-12">
        <div class="panel-body">
        <form method="post" action="RedirectContact.php" id="contactForm" onsubmit="return validateField()">
            <div class="form-group">
            <label for="voornaam">Voornaam</label>
                <input type="text" name="voornaam" id="voornaam" maxlength="50" onchange="validateField('voornaam')" class="validate['required'] form-control form-field" value="<?php echo $opgeslagenVoornaam; ?>">

            <label for="achternaam">Achternaam</label>
                <input type="text" name="achternaam" id="achternaam"  maxlength="50" class="validate['required'] form-control form-field" value="<?php echo $opgeslagenAchternaam; ?>">

            <label for="email">E-mailadres</label>
            <input type="text" name="email" id="email" maxlength="80" onchange="validateField('achternaam')" class="validate['required'] form-control form-field" value="<?php echo $opgeslagenEmail; ?>">

            <label for="telefoonnummer">Telefoonnummer</label>
                <input type="text" name="telefoonnummer" id="telefoonnummer" maxlength="30" class="validate['numeric'] form-control form-field" value="<?php echo $opgeslagenTelefoonnummer; ?>">

            <label for="bericht">Bericht</label>
                <textarea name="bericht" id="bericht" maxlength="1000" cols="25" rows="6" class="validate['required'] form-control form-field" value="<?php echo $opgeslagenBericht; ?>"></textarea>
            </div>

            <button type="submit" name="contactSubmit" class="btn btn-primary contactButton ">Verstuur</button>
        </form>
        </div>
    </div>

<div class="row">
    <div class="panel panel-default col-md-12 infoBox">
        <div class="panel-body">
            <p><strong>Adresgegevens Hattem</strong></p>
            <p>Nieuweweg 36<br>8051 EE  Hattem<br>Tel: 038 - 444 9310</p>
            <p><strong>Openingstijden</strong></p>
            <p>Di - Do: 9.00 - 18.00<br>Vrij: 8.30 - 20.00<br>Zat: 8.30 - 15.00</p>
        </div>
    </div>

</div>
    <div class="row">
        <div class="col-md-12">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.4042014661272!2d6.068530215983716!3d52.47181684755107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7d952a4965291%3A0xb55aad9edb065777!2sHair+Plaza+Hattem!5e0!3m2!1snl!2snl!4v1513181060147" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>

<div class="panel panel-default col-md-12 infoBox">
    <div class="panel-body">
        <p><strong>Adresgegevens Zwolle</strong></p>
        <p>Sassenstraat 19<br>8014 PC  Zwolle<br>Tel: 038 - 303 2186</p>
        <p><strong>Openingstijden</strong></p>
        <p>Di - Wo: 9.00 - 18.00<br>Do: 9.00 - 20.00<br>Vrij: 9.00 - 18.00<br>Zat: 9.00 - 16.00</p>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2428.203894341476!2d6.091515715984804!3d52.511649044600155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7df2f836b76c5%3A0xcd50b1053c3bde27!2sHair+Plaza+Zwolle!5e0!3m2!1snl!2snl!4v1513181156193" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>

<!--- Send Form Email ---!>

<?php
include ('../include/footer.php');
?>




</body>
</html>