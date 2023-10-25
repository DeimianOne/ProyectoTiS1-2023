<?php
    include("../../../database/connection.php");

    $cod_departamento = $_GET["id"];

    $query = "DELETE FROM departamento WHERE cod_departamento=".$cod_departamento.";";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=departamentos/index");
?>
