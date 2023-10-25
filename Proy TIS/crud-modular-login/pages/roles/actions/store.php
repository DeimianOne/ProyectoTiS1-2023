<?php
    include("../../../database/connection.php");

    $codigo = $_POST["cod_rol"];
    $nombre = $_POST["nombre_rol"];

    $query = "INSERT INTO rol (cod_rol, nombre_rol) VALUES ('$codigo', '$nombre');";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=roles/index");
?>
