<?php
    include("../../../database/connection.php");

    $cod_municipalidad = $_GET["id"];

    $query = "DELETE FROM municipalidad WHERE cod_municipalidad=".$cod_municipalidad.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=municipalidades/index");
?>