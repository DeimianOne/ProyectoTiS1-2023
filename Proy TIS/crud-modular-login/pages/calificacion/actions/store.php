<?php
    include("../../../database/connection.php");
    
    $calificacion = $_POST["nombre_region"];
    $id= $_POST["cod_region"];
    
    $query = "UPDATE region SET nombre_region = '$nombre' WHERE cod_region = ".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=region/index");
?>