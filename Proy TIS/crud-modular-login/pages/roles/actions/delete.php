<?php
    include("../../../database/connection.php");

    $cod_rol = $_GET["cod_rol"];

    $query = "DELETE FROM rol WHERE cod_rol=".$cod_rol.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=roles/index");
?>