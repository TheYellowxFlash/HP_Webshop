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
    <link href="css/shop-contact.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

    <?php
        include ('../include/header.php');
        ?>

</head>
<body>


<!-- Page Content -->
    <br>
<div class="container">
    <h1 class="my-4">Contact met Hair Plaza</h1>
</div>

<?php

        $opgeslagenVoornaam = "";

if(isset($_POST['contactSubmit'])) {
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $bericht = $_POST['bericht'];

        $_SESSION['voornaam'] = $voornaam;
    }
    if(isset($_SESSION['voornaam'])){
        $opgeslagenVoornaam = $_SESSION['voornaam'];
}
?>

    <div class="panel panel-default col-md-12">
        <div class="panel-body">
        <form method="post">
            <div class="form-group">
            <label for="voornaam">Voornaam</label>
                <input type="text" name="voornaam" id="voornaam" maxlength="50" class="validate['required'] form-control" value="<?php echo $opgeslagenVoornaam; ?>">

            <label for="achternaam">Achternaam</label>
                <input type="text" name="achternaam" id="achternaam" maxlength="50" class="validate['required'] form-control">

            <label for="email">E-mailadres</label>
            <input type="text" name="email" id="email" maxlength="80" class="validate['required'] form-control">

            <label for="telefoonnummer">Telefoonnummer</label>
                <input type="text" name="telefoonnummer" id="telefoonnummer" maxlength="30" class="validate['numeric'] form-control">
                <?php
                if (isset($_POST['telefoonnummer'])){
                    if(!ctype_digit($_POST['telefoonnummer'])){
                        echo "Vul een geldig telefoonnummer in<br>";
                    }
                }
                ?>

            <label for="bericht">Bericht</label>
                <textarea name="bericht" id="bericht" maxlength="1000" cols="25" rows="6" class="validate['required'] form-control"></textarea>
            </div>

                <?php
                if(empty($voornaam) || empty($achternaam) || empty($email) || empty($bericht)){
                    echo "Vul de bovenstaande velden correct in<br>";
                }

            ?>

            <button type="submit" name="contactSubmit" class="btn btn-primary contactButton ">Submit</button>
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