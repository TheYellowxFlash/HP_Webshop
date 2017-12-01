<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Management-overzicht</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<?php
    date_default_timezone_set ( "Europe/Amsterdam" );

    include("dbconnect.php");
    $result = $conn->query("SELECT * FROM bestelling");
    if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $bestelnummer[$i] = $row["Bestelnummer"];
            $klantnummer[$i] = $row["Klantnummer"];
            $productnummer[$i] = $row["Productnummer"];
            $verzendmethode[$i] = $row["Verzendmethode"];
            $besteldatum[$i] = $row["Besteldatum"];
            $aantal[$i] = $row["Aantal"];
            $i++;
        }
    }
    $conn->close();
?>

<body>
    <div class="jumbotron container-fluid">
        <h2>Management-overzicht</h2>
    </div>
    <div class="container-fluid">
        <h3>Verkoop producten</h3>
        <div style="width: 900px;">
            <button style="float: right;">Jaar</button>
            <button style="float: right;">Maand</button>
            <button style="float: right;">Week</button>
            <button style="float: right;">Dag</button>
            <canvas id="productenCanvas" width="900" height="430" style="border:1px solid #d3d3d3;">Uw browser ondersteunt geen HTML5-canvas</canvas>
        </div>
    </div>
    <br>
</body>

<script>
    var ctx = document.getElementById("productenCanvas").getContext("2d");
    ctx.moveTo(0,400);
    ctx.lineTo(900,400);
    ctx.stroke();

    ctx.font = "20px Arial";
    ctx.fillText("<?php echo date('Y-m-d'); ?>",0,425);
</script>