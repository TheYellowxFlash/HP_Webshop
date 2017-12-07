
<?php


    $query = $_GET['query'];


    $min_length = 1;

    $conn = new mysqli("localhost", "root", "usbw", "webshopdb");

    if(strlen($query) >= $min_length){

        $query = htmlspecialchars($query);


        $query = mysqli_real_escape_string($conn, $query);


        $raw_results = $conn->query("SELECT * FROM product
            WHERE (`Productnummer` LIKE '%".$query."%') OR (`Productbeschrijving` LIKE '%".$query."%') OR (`Prijs` LIKE '%".$query."%') OR (`Afbeelding` LIKE '%".$query."%') OR (`Productnaam` LIKE '%".$query."%')") or die(mysqli_error());



        if(mysqli_num_rows($raw_results) > 0) {

            $i = 0;
            while ($results = mysqli_fetch_array($raw_results)) {

                //print_r($results);
                $productnummer[$i] = $results[0];
                $productbeschrijving[$i] = $results[1];
                $prijs[$i] = $results[2];
                $afbeelding[$i] = $results[3];
                $productnaam[$i] = $results[4];
                $colID[$i] = $results[5];
                $catID[$i] = $results[6];
                $i++;
            }

            echo $productnummer[0] . ", " . $productbeschrijving[0] . ", " . $prijs[0] . ", " . $afbeelding[0] . ", " . $productnaam[0] . ", " . $colID[0] . ", " . $catID[0];
        }
        else{
                echo "Geen resultaten";
            }

        }
        else{
            echo "Minimum lengte van zoekopdracht is " . $min_length . " karakters.";
        }
        ?>