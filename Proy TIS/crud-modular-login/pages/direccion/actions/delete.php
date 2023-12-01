<?php
    include("../../../database/connection.php");

    $id = $_GET["cod_direccion"];

    $query = "DELETE FROM direccion WHERE cod_direccion=".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=direccion/index");
?>