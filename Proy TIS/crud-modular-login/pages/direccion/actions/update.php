<?php
    include("../../../database/connection.php");
    
    $nombre = $_POST["nombre_comuna"];
    $region = $_POST["cod_region"];
    $id= $_POST["cod_comuna"];
    
    $query = "UPDATE comuna SET nombre_comuna = '$nombre', cod_region = '$region' WHERE cod_comuna = ".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=comuna/index");
?>