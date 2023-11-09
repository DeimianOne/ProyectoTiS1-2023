<?php
    include("../../../database/connection.php");

    $codigo = $_GET["cod_palabra"];

    $query = "DELETE FROM palabra_ofensiva WHERE cod_palabra=".$codigo.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=palabrasofensivas/index");
?>