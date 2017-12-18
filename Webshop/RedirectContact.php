<!DOCTYPE html>

<?php
    if(($_POST["voornaam"]) == "" || ($_POST["achternaam"]) == "" || ($_POST["email"]) == "" || ($_POST["bericht"]) == "" || (!ctype_digit($_POST['telefoonnummer']) && $_POST['telefoonnummer'] != "")){
        header("Location: " . substr($_SERVER["REQUEST_URI"], 0, -strlen("RedirectContact.php")) . "Contact.php");
    }
?>

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
    include('../include/header.php');
    ?>

</head>
<body>


<!-- Page Content -->
<br>
<h1 class="my4 infoBox">Hartelijk dank voor uw bericht!</h1>
<p class="infoBox">Wij zullen zo snel mogelijk contact met u opnemen.</p>

<!-- Einde Page Content -->

<?php
//
//if(isset($_POST['contactSubmit'])) {
//    $voornaam = $_POST['voornaam'];
//    $achternaam = $_POST['achternaam'];
//    $email = $_POST['email'];
//    $telefoonnummer = $_POST['telefoonnummer'];
//    $bericht = $_POST['bericht'];
//}
//
//?>

<?php
include('../include/footer.php');
?>