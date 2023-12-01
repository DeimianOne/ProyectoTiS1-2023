<?php
    include("../../../database/connection.php");
    
    $cod_palabra = $_POST["cod_palabra"];
    $palabra = $_POST["palabra"];
    
    $query = "UPDATE palabra_ofensiva SET palabra = '$palabra' 
              WHERE cod_palabra = ".$cod_palabra.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=palabrasofensivas/index");
?>