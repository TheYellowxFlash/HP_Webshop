<?php
/**
 * Created by PhpStorm.
 * User: Startklaar
 * Date: 8-12-2017
 * Time: 13:15
 */


$mysqli = new mysqli('8080', 'root', 'usbw', 'webshopdb');

if (mysqli_connect_errno()) {
    echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
    exit;
}

$page = isset($_GET['p'])? $_GET['p'] : '' ;
if($page=='view'){
    $result = $mysqli->query("SELECT * FROM tabledit WHERE deleted != '1'");
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $row['Productnummer'] ?></td>
            <td><?php echo $row['Productbeschrijving'] ?></td>
            <td><?php echo $row['Prijs'] ?></td>
            <td><?php echo $row['Afbeelding'] ?></td>
            <td><?php echo $row['Productnaam'] ?></td>
            <td><?php echo $row['Collectie_ID'] ?></td>
            <td><?php echo $row['Catergorie_ID'] ?></td>
        </tr>
        <?php
    }
} else{

    // Basic example of PHP script to handle with jQuery-Tabledit plug-in.
    // Note that is just an example. Should take precautions such as filtering the input data.

    header('Content-Type: application/json');

    $input = filter_input_array(INPUT_POST);



    if ($input['action'] == 'edit') {
        $mysqli->query("UPDATE tabledit SET name='" . $input['name'] . "', gender='" . $input['gender'] . "', email='" . $input['email'] . "', phone='" . $input['phone'] . "', address='" . $input['address'] . "' WHERE id='" . $input['id'] . "'");
    } else if ($input['action'] == 'delete') {
        $mysqli->query("UPDATE tabledit SET deleted=1 WHERE id='" . $input['id'] . "'");
    } else if ($input['action'] == 'restore') {
        $mysqli->query("UPDATE tabledit SET deleted=0 WHERE id='" . $input['id'] . "'");
    }

    mysqli_close($mysqli);

    echo json_encode($input);

}
?>