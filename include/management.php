<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Management-overzicht</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

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
            <canvas id="productenCanvas" width="900" height="400" style="border:1px solid #d3d3d3;">Uw browser ondersteunt geen HTML5-canvas</canvas>
        </div>
    </div>
</body>

<script>
    var c = document.getElementById("productenCanvas");
    var ctx = c.getContext("2d");
    ctx.moveTo(0,100);
    ctx.lineTo(900,200);
    ctx.stroke();
</script>