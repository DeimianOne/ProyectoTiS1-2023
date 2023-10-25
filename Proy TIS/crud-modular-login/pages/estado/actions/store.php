<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre_estado"];

    $query = "INSERT INTO estado (nombre_estado) VALUES ('$nombre');";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=estado/index");
?>
