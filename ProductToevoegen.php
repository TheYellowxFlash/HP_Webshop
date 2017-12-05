<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="include/css/klantInfo.css"/>
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

if ($_SESSION['rol'] != 2 && $_SESSION['rol'] != 3){
    header("location:login.php");
}

if(isset($_POST["deleteProduct"])){
    echo "DELETE FROM collectie WHERE Productnummer=" . $_POST["pnr"];
}
if(isset($_POST["addproduct"])){
    if(substr($_POST["Prijs"], -3, 1) == ","){
        $prijs = substr($_POST["Prijs"], 0, -3) . "." . substr($_POST["Prijs"], -2, 2);
    }
    else{
        $prijs = $_POST["Prijs"];
    }

    echo "INSERT INTO collectie VALUES(" . $_POST["ColID"] . ", " .
        $_POST["CatID"] . ", " .
        $_POST["Productnummer"] . ", " .
        $_POST["Productnaam"] . ", " .
        $_POST["Prijs"] . ", " .
        $_POST["Productbeschrijving"] . ", " .
        $_POST["Afbeelding"] . ")";

    //$_POST["ColNaam"] . ", " .
    //$_POST["CatNaam"] . ", " .
}

//Kijk hoeveel collecties er in de database staan en sla dit op in $collecties
include("include/dbconnect.php");
$sql = "SELECT COUNT('ColID') FROM collectie";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)) {
    $collecties = $row["COUNT('ColID')"];
}

$sql2 = "SELECT ColNaam FROM `collectie`";
$result2 = $conn->query($sql2);
$i = 0;
while ($row2 = mysqli_fetch_array($result2)) {
    $collectieNaam[$i] = $row2['ColNaam'];
    $i++;
};

$sql3 = "SELECT COUNT('CatID') FROM categorie";
$result3 = $conn->query($sql3);
while($row3 = mysqli_fetch_array($result3)) {
    $categorieen = $row3["COUNT('CatID')"];
}

$sql4 = "SELECT CatNaam FROM `categorie`";
$result4 = $conn->query($sql4);
$i = 0;
while ($row4 = mysqli_fetch_array($result4)) {
    $categorieNaam[$i] = $row4['CatNaam'];
    $i++;
};
$conn->close();
//--

$zichtbareCollecties = array();
for ($i = 1; $i <= $collecties; $i++) {
    if(isset($_GET["co" . $i . "enabled"])){
        array_push($zichtbareCollecties, $i);
    }
}
$zichtbareCategorieen = array();
for ($i = 1; $i <= $categorieen; $i++) {
    if(isset($_GET["ca" . $i . "enabled"])){
        array_push($zichtbareCategorieen, $i);
    }
}

//Laat een form zien om alleen bepaalde collecties aan te passen
echo "<div class='col-md-6'>
<div class='container-fluid'><div class='col-md-3'><form method='get' action=''>";
if(!isset($_GET["alleCollectiesSet"])) {
    $temp = true;

    for ($i = 1; $i <= $collecties; $i++) {
        echo "<input type='hidden' name='co" . $i . "enabled' />";
        if(!isset($_GET["co" . $i . "enabled"])){
            $temp = false;
        }
    }

    if($temp){
        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] . "&alleCollectiesSet=on");
    }
}
for ($i = 1; $i <= $categorieen; $i++) {
    if(isset($_GET["ca" . $i . "enabled"])){
        echo "<input type='hidden' name='ca" . $i . "enabled' />";
    }
    if(isset($_GET["alleCategorieenSet"])){
        echo "<input type='hidden' name='alleCategorieenSet' />";
    }
}

echo "<input onchange='this.form.submit()' type='checkbox' name='alleCollectiesSet' ";
if(isset($_GET["alleCollectiesSet"])){ echo "checked"; }
echo"><p1> Alles</p1><br>
</form>";

echo "<form method='get' action=''>";
for ($i = 1; $i <= $categorieen; $i++) {
    if(isset($_GET["ca" . $i . "enabled"])){
        echo "<input type='hidden' name='ca" . $i . "enabled' />";
    }
    if(isset($_GET["alleCategorieenSet"])){
        echo "<input type='hidden' name='alleCategorieenSet' />";
    }
}
for($i = 1; $i <= $collecties; $i++) {
    echo "<input onchange='this.form.submit()' type='checkbox' name='co" . $i . "enabled'";
    if(isset($_GET["co" . $i . "enabled"])){
        echo "checked";
    }
    echo"><p1> " . $collectieNaam[$i-1] . "</p1><br>";
}
echo "</form></div>";
//--
//Laat een form zien om alleen bepaalde categorieën aan te passen
echo "<div class='col-md-3'><form method='get' action=''>";
if(!isset($_GET["alleCategorieenSet"])) {
    $temp = true;


    for ($i = 1; $i <= $categorieen; $i++) {
        echo "<input type='hidden' name='ca" . $i . "enabled' />";
        if(!isset($_GET["ca" . $i . "enabled"])){
            $temp = false;
        }
    }

    if($temp){
        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] . "&alleCategorieenSet=on");
    }
}
for ($i = 1; $i <= $collecties; $i++) {
    if(isset($_GET["co" . $i . "enabled"])){
        echo "<input type='hidden' name='co" . $i . "enabled' />";
    }
    if(isset($_GET["alleCollectiesSet"])){
        echo "<input type='hidden' name='alleCollectiesSet' />";
    }
}
echo "<input onchange='this.form.submit()' type='checkbox' name='alleCategorieenSet' ";
if(isset($_GET["alleCategorieenSet"])){ echo "checked"; }
echo"><p1> Alles</p1><br>
</form>";

echo "<form method='get' action=''>";
for ($i = 1; $i <= $collecties; $i++) {
    if(isset($_GET["co" . $i . "enabled"])){
        echo "<input type='hidden' name='co" . $i . "enabled' />";
    }
    if(isset($_GET["alleCollectiesSet"])){
        echo "<input type='hidden' name='alleCollectiesSet' />";
    }
}
for($i = 1; $i <= $categorieen; $i++) {
    echo "<input onchange='this.form.submit()' type='checkbox' name='ca" . $i . "enabled'";
    if(isset($_GET["ca" . $i . "enabled"])){
        echo "checked";
    }
    echo"><p1> " . $categorieNaam[$i-1] . "</p1><br>";
}
echo "</form></div>";
?>

<?php

$alltests = array("ColID", "ColNaam", "CatID", "CatNaam", "Productnummer", "Productnaam", "Prijs", "Productbeschrijving");
    echo '
    <table class="table-bordered table-hover">
        <tr>';
            for($i = 0; $i < count($alltests); $i++) {
                $currentTest = $alltests[$i];
                echo '<th><a ';
                if (isset($_GET["order"])) {
                    if ($_GET["order"] == $currentTest) {
                        echo 'href="' . $_SERVER['PHP_SELF'] . '?' . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'], "order") - 1);
                    } else {
                        echo 'href="' . $_SERVER['PHP_SELF'] . '?' . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'], "order") - 1) . "&order=" . $currentTest;
                    }
                } else {
                    echo 'href="' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . "&order=" . $currentTest;
                }
                echo '">' . $currentTest . "</a></th>";
            }
        echo '</tr>';

        $CurrColIDs = "";
        for($i = 1; $i <= $collecties; $i++){
            if(isset($_GET["co" . $i . "enabled"])){
                if($CurrColIDs == "") {
                    $CurrColIDs .= $i;
                }
                else{
                    $CurrColIDs .= ", " . $i;
                }
            }
        }
        $CurrCatIDs = "";
        for($i = 1; $i <= $categorieen; $i++){
            if(isset($_GET["ca" . $i . "enabled"])){
                if($CurrCatIDs == "") {
                    $CurrCatIDs .= $i;
                }
                else{
                    $CurrCatIDs .= ", " . $i;
                }
            }
        }
        echo '
    <tr>
        <form method="post" action="">
        <td><input name="ColID"                 placeholder="ColID..." style="width: 4em;"/></td>
        <td><input name="ColNaam"               placeholder="ColNaam..."/></td>
        <td><input name="CatID"                 placeholder="CatID..." style="width: 4em;"/></td>
        <td><input name="CatNaam"               placeholder="CatNaam..."/></td>
        <td><input name="Productnummer"         placeholder="Producnummer..."/></td>
        <td><input name="Productnaam"           placeholder="Productnaam..."/></td>
        <td><input name="Prijs"                 placeholder="Prijs..."/></td>
        <td><input name="Productbeschrijving"   placeholder="Productbeschrijving..."/></td>
        <td><input name="Afbeelding"            placeholder="Afbeelding..."/></td>
        <td><input name="addproduct"            type="submit" value="&#x2795;"/></td>
        </form>
    </tr>';
        if($CurrCatIDs != "" && $CurrColIDs != "") {
            include("include/dbconnect.php");
            $sql = "SELECT * FROM product p JOIN categorie cat ON p.Categorie_ID=cat.CatID JOIN collectie col ON p.Collectie_ID=col.ColID WHERE CatID IN (" . $CurrCatIDs . ") AND ColID IN (" . $CurrColIDs . ")";
            if (isset($_GET["order"])) {
                for ($i = 0; $i < count($alltests); $i++) {
                    if ($_GET["order"] == $alltests[$i]) {
                        $sql .= " ORDER BY " . $alltests[$i];
                    }
                }
            } else {
                $sql .= " ORDER BY ColID";
            }


            if (isset($_GET["orderDir"])) {
                $sql .= " DESC";
                echo "<a href='" . $_SERVER['PHP_SELF'] . '?' . substr($_SERVER['QUERY_STRING'], 0, -9) . "'><button>Sort Ascending</button></a>";
            } else {
                echo "<a href='" . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . "&orderDir'><button>Sort Descending</button></a>";
            }
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
                $prijs = $row['Prijs'];
                if (substr($prijs, -2, 2) == "00") {
                    $prijs = substr($prijs, 0, -3) . ",-&#8239&#8239&#8239&#8239";
                }
                for ($j = 0; $j < strlen($prijs); $j++) {
                    if (substr($prijs, $j, 1) == ".") {
                        $prijs = substr($prijs, 0, $j) . "," . substr($prijs, -2, 2);
                    }
                }

                echo "<tr><form method='post' action=''>
                    <td>" . $row['ColID'] . "</td>
                    <td>" . $row['ColNaam'] . "</td>
                    <td>" . $row['CatID'] . "</td>
                    <td>" . $row['CatNaam'] . "</td>
                    <td><input type='hidden' name='pnr' value='" . $row['Productnummer'] . "'>" . $row['Productnummer'] . "</td>
                    <td>" . $row['Productnaam'] . "</td>
                    <td><span>&#x20ac;</span> <span style='float: right;'>" . $prijs . "</span></td>
                    <td>" . $row['Productbeschrijving'] . "</td>
                    <td><button>Bestand kiezen</button></td>
                    <td><input type='submit' name='deleteProduct' value='&#x2716;'/></td>
                    </form>
                </tr>";
            };
            $conn->close();
        }
    echo '
    </table>
    ';
?>

</b><a href="login.php"><button type="button">Home</button></a>
</div></div>
</body>
