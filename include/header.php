<style>
    .navbar-middle{
        width: 100%;
        height: 1em;
        text-align: center;
    }
    .extrabuttons{
        text-align: center;
        display: inline-block;
        width: calc(25% - 3px);
    }
    .extrabuttons:not(:last-child){
        border-right: 1px solid lightgray;
    }
    .extrabuttons a{
        color: #777;
        text-decoration: none;
    }
    .extrabuttons a:hover{
        color: #5e5e5e;
    }
    .navbar-form{
        border: 1px solid lightgray;
        background-color: #fff;
        border-radius: 1em;
    }
    .navbar-form button{
        margin: 0 0 0 -1em;
    }
    .navbar-form input, .navbar-form button{
        border: none;
        background: none;
        line-height: 2em;
    }
    .navbar-lower{
        margin-bottom: 0;
    }
</style>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="col-md-5">
            <form class="navbar-form navbar-left" action="/action_page.php">
                <div class="form-group">
                    <button type="submit" class="glyphicon glyphicon-search"></button>
                    <input type="text" placeholder="Search">
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <a class="navbar-brand navbar-middle" href="../Webshop/Homepage.php">Hair-Plaza</a>
        </div>
        <div class="col-md-5">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Login<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php include("../include/login.php"); ?>
                    </ul>
                </li><li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Winkelwagen <span class="badge">1</span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <p1>Mijn winkelwagen<br>
                        <br>
                        Product - aantal - prijs</p1>
                        <?php //include("../Webshop/Cart.html"); ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br/><br/>
<nav class="navbar navbar-default navbar-lower">
    <br/>
    <div class="extrabuttons">
        <a href="../Webshop/shop.php">Producten</a>
    </div>
    <div class="extrabuttons">
        <a href="../Webshop/shop.php?col">Collecties</a>
    </div>
    <div class="extrabuttons">
        <a href="#">Gifts</a>
    </div>
    <div class="extrabuttons">
        <a href="../Webshop/about.php">About</a>
    </div>
</nav>