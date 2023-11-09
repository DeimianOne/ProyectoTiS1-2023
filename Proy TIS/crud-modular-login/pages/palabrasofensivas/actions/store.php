<?php
    include("../../../database/connection.php");

    $codigo = $_POST["cod_palabra"];
    $palabra = $_POST["palabra"];

    $query = "INSERT INTO palabra_ofensiva (cod_palabra, palabra) VALUES ('$codigo', '$palabra');";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=palabrasofensivas/index");
?>
