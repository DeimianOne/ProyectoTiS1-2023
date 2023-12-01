<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre_estado"];
    $desc = $_POST["descripcion_estado"];

    $query = "INSERT INTO estado (nombre_estado, descripcion_estado) VALUES ('$nombre', '$desc');";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=estado/index");
?>
