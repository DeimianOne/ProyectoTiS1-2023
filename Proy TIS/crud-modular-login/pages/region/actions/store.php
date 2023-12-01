<?php
    include("../../../database/connection.php");

    $nombre = addslashes($_POST["nombre_region"]);

    $query = "INSERT INTO region (nombre_region) VALUES ('$nombre')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "La región se ha insertado correctamente.";
    } else {
        echo "Error al insertar la región: " . mysqli_error($connection);
    }

    mysqli_close($connection);

    header("Location: ../../../index.php?p=region/index");
?>
