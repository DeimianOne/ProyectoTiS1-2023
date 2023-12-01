<?php
    include("../../../database/connection.php");
    
    $nombre = $_POST["nombre_estado"];
    $desc = $_POST["descripcion_estado"];
    $id= $_POST["cod_estado"];
    
    $query = "UPDATE estado SET nombre_estado = '$nombre', descripcion_estado = '$desc' WHERE cod_estado = ".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=estado/index");
?>