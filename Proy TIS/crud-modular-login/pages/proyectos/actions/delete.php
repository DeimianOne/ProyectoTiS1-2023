<?php
    include("../../../database/connection.php");

    $cod_proyecto = $_GET["id"];

    $query = "DELETE FROM proyecto WHERE cod_proyecto='".$cod_proyecto."';";

    $result = mysqli_query($connection, $query);

    // Asegúrate de cambiar la dirección de redireccionamiento si es necesario
    header("Location: ../../../index.php?p=proyectos/index");
?>
