<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre"];
    $origen = $_POST["origen"];
    $logo = $_POST["logo"];

    $query = "INSERT INTO marcas (nombre, origen, logo) VALUES ('$nombre', '$origen', '$logo');";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=brands/index");
?>
