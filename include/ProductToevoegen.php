<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="klantInfo.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function toggleTabellen() {
            $(".toggleTable").toggle();
        }
    </script>
</head>

<body>
<h3>Product overzicht</h3>
<?php
session_start();

//Kijk hoeveel collecties er in de database staan en sla dit op in $collecties
$conn = new mysqli("localhost", "root", "usbw", "webshopdb");
$sql = "SELECT COUNT('ID') FROM collectie";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)) {
    $collecties = $row["COUNT('ID')"];
}

$sql2 = "SELECT Naam FROM `collectie`";
$result2 = $conn->query($sql2);
$i = 0;
while ($row2 = mysqli_fetch_array($result2)) {
    $collectieNaam[$i] = $row2['Naam'];
    $i++;
};

$sql3 = "SELECT COUNT('ID') FROM collectie";
$result3 = $conn->query($sql3);
while($row3 = mysqli_fetch_array($result3)) {
    $categorieen = $row3["COUNT('ID')"];
}

$sql4 = "SELECT Naam FROM `collectie`";
$result4 = $conn->query($sql4);
$i = 0;
while ($row4 = mysqli_fetch_array($result4)) {
    $categorieNaam[$i] = $row4['Naam'];
    $i++;
};
$conn->close();
//--

//Laat een form zien om alleen bepaalde collecties aan te passen
echo "<div class='col-md-3'><form method='get' action=''>";
if(!isset($_GET["allesSet"])) {
    for ($i = 1; $i <= $collecties; $i++) {
        echo "<input type='hidden' name='c" . $i . "enabled' />";
    }
}
echo "<input onchange='this.form.submit()' type='checkbox' name='allesSet' ";
if(isset($_GET["allesSet"])){ echo "checked"; }
echo"><p1> Alles</p1><br>
</form>";

echo "<form method='get' action=''>";
for($i = 1; $i <= $collecties; $i++) {
    echo "<input onchange='this.form.submit()' type='checkbox' name='c" . $i . "enabled'";
    if(isset($_GET["c" . $i . "enabled"])){
        echo "checked";
    }
    echo"><p1> " . $collectieNaam[$i-1] . "</p1><br>";
}
echo "</form></div>";
//--
//Laat een form zien om alleen bepaalde categorieën aan te passen
echo "<div class='col-md-3'><form method='get' action=''>";
if(!isset($_GET["allesSet"])) {
    for ($i = 1; $i <= $categorieen; $i++) {
        echo "<input type='hidden' name='c" . $i . "enabled' />";
    }
}
echo "<input onchange='this.form.submit()' type='checkbox' name='allesSet' ";
if(isset($_GET["allesSet"])){ echo "checked"; }
echo"><p1> Alles</p1><br>
</form>";

echo "<form method='get' action=''>";
for($i = 1; $i <= $categorieen; $i++) {
    echo "<input onchange='this.form.submit()' type='checkbox' name='c" . $i . "enabled'";
    if(isset($_GET["c" . $i . "enabled"])){
        echo "checked";
    }
    echo"><p1> " . $categorieNaam[$i-1] . "</p1><br>";
}
echo "</form></div>";
//--

//Loop door alle collecties heen en laat deze zien in een tabel dmv $collecties en $i
echo "<span class='toggleTable'><table  class=\"table-bordered table-hover\" id=\"overzichtTabel\">"; // start a table tag in the HTML
echo "<tr><th>C_ID</th><th>Collectie-naam</th><th>Pnr</th><th>Naam</th><th>Prijs</th></tr>";

for($i = 1; $i <= $collecties; $i++) {
    $conn = new mysqli("localhost", "root", "usbw", "webshopdb");
    $sql = "SELECT * FROM product WHERE collectie_ID = " . $i;
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
        $prijs = $row['Prijs'];
        if(substr($prijs, -2, 2) == "00"){
            $prijs = substr($prijs, 0, -3) . ",-&#8239&#8239&#8239&#8239";
        }
        for($j = 0; $j < strlen($prijs); $j++){
            if(substr($prijs, $j, 1) == "."){
                $prijs = substr($prijs, 0, $j) . "," . substr($prijs, -2, 2);
            }
        }

        echo "<tr>
            <td>" . $row['Collectie_ID'] . "</td>
            <td>" . $collectieNaam[$i-1] . "</td>
            <td>" . $row['Productnummer'] . "</td>
            <td>" . $row['Productnaam'] . "</td>
            <td><span>&#x20ac;</span> <span style='float: right;'>" . $prijs . "</span></td>
        </tr>";
    };
    $conn->close();
}

echo "</table><button type='button' class='toggleButton' onclick='toggleTabellen()'>Wijzigen</button></span>";


//Loop door alle collecties heen en laat deze zien in een tabel dmv $collecties en $i
echo "<span class='toggleTable' style='display: none;'><table  class=\"table-bordered table-hover\" id=\"overzichtTabel\">"; // start a table tag in the HTML
echo "<tr><th>C_ID</th><th>Pnr</th><th>Naam</th><th>Prijs</th></tr>";

for($i = 1; $i <= $collecties; $i++) {
    $conn = new mysqli("localhost", "root", "usbw", "webshopdb");
    $sql = "SELECT * FROM product WHERE collectie_ID = " . $i;
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
        echo "<tr>
            <td>" . $row['Collectie_ID'] . "</td>
            <td>" . $row['Productnummer'] . "</td>
            <td>" . $row['Productnaam'] . "</td>
            <td><span>&#x20ac;</span> <span style='float: right;'>" . $row['Prijs'] . "</span></td>
        </tr>";
    };
    $conn->close();
}

echo "</table><button type='button' class='toggleButton' onclick='toggleTabellen()'>Annuleren</button></span>";


?>

<a href="login.php"><button type="button">Home</button></a>
</body>
