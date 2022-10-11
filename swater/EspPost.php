<?php

require_once "db.php";

if ($conn) {

    if(isset($_POST['value'])) {
        $value = $_POST['value'];
        echo " Value : '".$value."'";
        $query = "INSERT INTO test(value) VALUES ('$value')";
        $result = mysqli_query($conn, $query);
        if ($result){
          echo "Registered.";
        } else {
          echo "Error. Not registered.";
        }
    }

} else {
    echo "Falla! conexion con Base de datos ";
}


?>
