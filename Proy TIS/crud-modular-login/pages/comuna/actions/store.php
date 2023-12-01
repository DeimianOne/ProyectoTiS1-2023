<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre_comuna"];
    $region = $_POST["cod_region"];

    if (isset($_POST['cod_region']) && !empty($_POST['cod_region'])){
        $query = "INSERT INTO comuna (nombre_comuna, cod_region) VALUES ('$nombre', '$region');";

        $result =  mysqli_query($connection, $query);

        header("Location: ../../../index.php?p=comuna/index");
    } else {
        header("Location: ../../../index.php?p=comuna/index");
    }
?>
