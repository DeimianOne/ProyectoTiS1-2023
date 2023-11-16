<?php
    include("../../../database/connection.php");
    
    $cod_ticket = $_POST["cod_ticket"];
    $calificacion_atencion = $_POST["calificacion_atencion"];
    $comentario_atencion= $_POST["comentario_atencion"];
    
    $query = "INSERT INTO calificacion_atencion (cod_ticket, calificacion_atencion, comentario_atencion) 
              VALUES ('$cod_ticket', '$calificacion_atencion', '$comentario_atencion');";
    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=calificacion/index");
?>