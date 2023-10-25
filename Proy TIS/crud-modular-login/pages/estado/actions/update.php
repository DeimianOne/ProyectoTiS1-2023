<?php
    include("../../../database/connection.php");
    
    $nombre = $_POST["nombre_estado"];
    $id= $_POST["cod_estado"];
    
    $query = "UPDATE estado SET nombre_estado = '$nombre' WHERE cod_estado = ".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=estado/index");
?>