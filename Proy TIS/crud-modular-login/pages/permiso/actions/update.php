<?php
    include("../../../database/connection.php");

    $nombre = $_POST["nombre_permiso"];
    $id = $_POST["cod_permiso"];
    if (isset($_POST['descripcion_permiso']) && !empty($_POST['descripcion_permiso'])) {
        $descripcion = $_POST['descripcion_permiso'];
        $query = "UPDATE permiso SET nombre_permiso = '$nombre', descripcion_permiso = '$descripcion' WHERE cod_permiso = ".$id.";";
 
    } else {
        $query = "UPDATE permiso SET nombre_permiso = '$nombre', descripcion_permiso = NULL WHERE cod_permiso = ".$id.";";
    }

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=permiso/index");
?>