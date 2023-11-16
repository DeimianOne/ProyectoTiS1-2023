<?php
    include("../../../database/connection.php");
    
    $calificacion_atencion = $_POST["calificacion_atencion"];
    $comentario_atencion= $_POST["comentario_atencion"];
    
    $query = "UPDATE region SET nombre_region = '$nombre' WHERE cod_region = ".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=region/index");
?>