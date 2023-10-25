<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre_region"];

    $query = "INSERT INTO region (nombre_region) VALUES ('$nombre');";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=region/index");
?>
