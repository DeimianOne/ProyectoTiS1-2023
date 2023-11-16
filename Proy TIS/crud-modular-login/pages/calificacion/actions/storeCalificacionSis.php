<?php
    include("../../../database/connection.php");
    
    
    $cod_ticket = $_POST["cod_ticket"];
    $calificacion_sistema = $_POST["calificacion_sistema"];
    $comentario_sistema= $_POST["comentario_sistema"];

    $query = "INSERT INTO calificacion_sistema (cod_ticket, calificacion_sistema, comentario_sistema) 
              VALUES ('$cod_ticket', '$calificacion_sistema', '$comentario_sistema');";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=calificacion/index");
?>