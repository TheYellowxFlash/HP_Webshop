<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="klantInfo.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        var deleteArray = [];
        function checkCheckBoxes(){

            var anyBoxesChecked = false;
            deleteArray = [];
            var index = 0;

            $('input[name="deleteproduct"]').each(function() {
                if ($(this).is(":checked")) {
                    anyBoxesChecked = true;
                    deleteArray[index] = $(this).attr("prodnum");
                    index++;
                }
            });

            if (anyBoxesChecked == true) {
                $("#massaVerwijderButton").css("display", "block");
            }
            else{
                $("#massaVerwijderButton").css("display", "none");
            }
        }


        function deleteProducts(){
            var deleteString = "";
            var i;
            for (i = 0; i < deleteArray.length-1; i++) {
                deleteString += deleteArray[i] + ",";
            }
            deleteString += deleteArray[deleteArray.length-1];
            document.cookie = "itemsToDelete=" + deleteString + "; path=/";
            window.location.reload();
            //alert(deleteString);
        }
    </script>
</head>

<body>
<h3>Product overzicht</h3>
<?php
if(isset($_COOKIE["itemsToDelete"])) {
    $deleteString = explode(",", $_COOKIE["itemsToDelete"]);
    unset($_COOKIE["itemsToDelete"]);
    setcookie('itemsToDelete', null, -1, '/');
    $temp = "DELETE FROM product WHERE";

    for($i = 0; $i < count($deleteString); $i++) {
        $temp .= " Productnummer=" . $deleteString[$i];
        if($i < count($deleteString)-1){
            $temp .= " OR";
        }
    }
    $temp .= ";";

    include("include/dbconnect.php");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = $temp;
    if ($conn->query($sql) === TRUE) {
        echo "Product(en) succesvol verwijderd ;)";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

session_start();

if(isset($_SESSION["ExtraSQL"])){
    include("include/dbconnect.php");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query($_SESSION["ExtraSQL"]) === TRUE) {
        echo "Product succesvol toegevoegd ;)";
    } else {
        echo "Error: " . $_SESSION["ExtraSQL"] . "<br>" . $conn->error;
    }

    unset($_SESSION["ExtraSQL"]);
}

if(isset($_POST["deleteProduct"])){
    echo "DELETE FROM collectie WHERE Productnummer=" . $_POST["pnr"];
}
if(isset($_POST["addproduct"])){
    $sql1 = "";
    $sql2 = "";
    $sql3 = "";

    if(substr($_POST["Prijs"], -3, 1) == ","){
        $prijs = substr($_POST["Prijs"], 0, -3) . "." . substr($_POST["Prijs"], -2, 2);
    }
    else{
        $prijs = $_POST["Prijs"];
    }

    $colid = $_POST["ColID"];
    $colnaam = $_POST["ColNaam"];
    $catid = $_POST["CatID"];
    $catnaam = $_POST["CatNaam"];

    $foundColName = $colnaam;
    $foundColID = $colid;
    include("include/dbconnect.php");
    $sql = "SELECT * FROM collectie";
    $result = $conn->query($sql);
    while($row = mysqli_fetch_array($result)) {
        if($colid == $row["ColID"]){
            $foundColName = $row["ColNaam"];
        }
        if($colnaam == $row["ColNaam"]){
            $foundColID = $row["ColID"];
        }
    }
    if($foundColID == $colid && $foundColName == $colnaam){
        $sql1 = "INSERT INTO collectie VALUES(" . $colid . ", '" .
            $colnaam . "')";
    }


    $foundCatName = $catnaam;
    $foundCatID = $catid;
    include("include/dbconnect.php");
    $sql = "SELECT * FROM categorie";
    $result = $conn->query($sql);
    while($row = mysqli_fetch_array($result)) {
        if($catid == $row["CatID"]){
            $foundCatName = $row["CatNaam"];
        }
        if($catnaam == $row["CatNaam"]){
            $foundCatID = $row["CatID"];
        }
    }
    if($foundCatID == $catid && $foundCatName == $catnaam){
        $sql2 = "INSERT INTO categorie VALUES(" . $catid . ", '" .
            $catnaam . "')";
    }

    $sql3 = "INSERT INTO product VALUES(" .
        $_POST["Productnummer"] . ", '" .
        $_POST["Productbeschrijving"] . "', " .
        $prijs . ", '" .
        $_POST["Afbeelding"] . "', '" .
        $_POST["Productnaam"] . "', " .
        $foundColID . ", " .
        $foundCatID . ")";

    include("include/dbconnect.php");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($sql1 != "") {
        if ($conn->query($sql1) === TRUE) {
            echo "Product succesvol toegevoegd ;)";
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
    }
    if($sql2 != "") {
        if ($conn->query($sql2) === TRUE) {
            echo "Product succesvol toegevoegd ;)";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }
    if($sql3 != ""){
        if($sql1 != "" || $sql2 != ""){
            $_SESSION["ExtraSQL"] = $sql3;
            header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        }
        else {
            if ($conn->query($sql3) === TRUE) {
                echo "Product succesvol toegevoegd ;)";
            } else {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
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
        <tr><th>Verwijder</th>';
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
        <td></td>
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
                echo "<a href='" . $_SERVER['PHP_SELF'] . '?' . substr($_SERVER['QUERY_STRING'], 0, -9) . "'><button>Sorteer Oplopend</button></a>";
            } else {
                echo "<a href='" . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . "&orderDir'><button>Sorteer Aflopend</button></a>";
            }
            echo "<br><a><button id='massaVerwijderButton' style='display: none;' onclick='deleteProducts()'>Verwijder Geselecteerde</button></a>";
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
                    <td><input name='deleteproduct' type='checkbox' onclick='checkCheckBoxes()' prodnum='" . $row['Productnummer'] . "'/></td>
                    <td>" . $row['ColID'] . "</td>
                    <td>" . $row['ColNaam'] . "</td>
                    <td>" . $row['CatID'] . "</td>
                    <td>" . $row['CatNaam'] . "</td>
                    <td><input type='hidden' name='pnr' value='" . $row['Productnummer'] . "'>" . $row['Productnummer'] . "</td>
                    <td>" . $row['Productnaam'] . "</td>
                    <td><span>&#x20ac;</span> <span style='float: right;'>" . $prijs . "</span></td>
                    <td>" . $row['Productbeschrijving'] . "</td>
                    <td><button>Bestand kiezen</button></td>
                    <td><input type='submit' name='deleteProduct' value='&#x2716;' onclick=\"return confirm('Weet u zeker dat u " . $row['Productnaam'] . " wilt verwijderen?');\"/></td>
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
