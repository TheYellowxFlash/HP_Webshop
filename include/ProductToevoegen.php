<head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="klantInfo.css"/>
</head>
<body>
<h3>Product overzicht</h3>
<?php
session_start();




$conn = new mysqli("localhost", "root", "usbw", "webshopdb");
        $sql = "SELECT * FROM product WHERE collectie_ID = '1' ";
        $result = $conn->query($sql);


echo "<table  class=\"table-bordered table-hover\" id=\"overzichtTabel\"> <caption>Vaartuigen</caption>"; // start a table tag in the HTML

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
    echo "<td><td>" . "Pnr: " . $row['Productnummer'] . "</td><td>" . "Naam: ". $row['Productnaam'] . "</td><td>" . "Prijs: " . $row['Prijs'] . " euro" . "</td></tr>";  //$row['index'] the index here is a field name
};

    echo "</table>";

$conn = new mysqli("localhost", "root", "usbw", "webshopdb");
        $sql = "SELECT * FROM product WHERE collectie_ID = '2' ";
        $result = $conn->query($sql);

echo "<table  class=\"table-bordered table-hover\" id=\"overzichtTabel\"> <caption>Specerijen</caption>"; // start a table tag in the HTML

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
    echo "<td><td>" . "Pnr: " . $row['Productnummer'] . "</td><td>" . "Naam: ". $row['Productnaam'] . "</td><td>" . "Prijs: " . $row['Prijs'] . " euro" . "</td></tr>";  //$row['index'] the index here is a field name
}

    echo "</table>";

$conn = new mysqli("localhost", "root", "usbw", "webshopdb");
        $sql = "SELECT * FROM product WHERE collectie_ID = '3' ";
        $result = $conn->query($sql);

echo "<table  class=\"table-bordered table-hover\" id=\"overzichtTabel\"> <caption>Vastgoed</caption>"; // start a table tag in the HTML

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
    echo "<td><td>" . "Pnr: " . $row['Productnummer'] . "</td><td>" . "Naam: ". $row['Productnaam'] . "</td><td>" . "Prijs: " . $row['Prijs'] . " euro" . "</td></tr>";  //$row['index'] the index here is a field name
}

    echo "</table>"

?>

<a href="login.php"><button type="button" class="toggleButton">Home</button
</body>
