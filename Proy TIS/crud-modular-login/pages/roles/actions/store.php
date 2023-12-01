<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre_rol"];

    $query = "INSERT INTO rol (nombre_rol) VALUES ('$nombre');";
    $result =  mysqli_query($connection, $query);

    $codigo = mysqli_insert_id($connection);

    if (isset($_POST['permisos'])) {
        $permisos = $_POST['permisos'];

        // Iterar a través de los permisos seleccionados y agregarlos a la tabla rol_permiso
        foreach ($permisos as $permiso) {
            $query_permisos = "INSERT INTO rol_permiso (cod_rol, cod_permiso) VALUES ('$codigo', '$permiso');";
            $result_permisos = mysqli_query($connection, $query_permisos);
        }
    }

    header("Location: ../../../index.php?p=roles/index");
?>
