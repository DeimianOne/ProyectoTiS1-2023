<?php
    include("../../../database/connection.php");
    
    $calificacion_sistema = $_POST["calificacion_sistema"];
    $comentario_sistema= $_POST["comentario_sistema"];
    
    $query = "UPDATE region SET nombre_region = '$nombre' WHERE cod_region = ".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=region/index");
?>