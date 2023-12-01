<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre_permiso"];
    if (isset($_POST['descripcion_permiso']) && !empty($_POST['descripcion_permiso'])) {
        $descripcion = $_POST['descripcion_permiso'];
        $query = "INSERT INTO permiso (nombre_permiso, descripcion_permiso) VALUES ('$nombre', '$descripcion');";
 
    } else {
        $query = "INSERT INTO permiso (nombre_permiso) VALUES ('$nombre');";
    }

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=permiso/index");
?>
