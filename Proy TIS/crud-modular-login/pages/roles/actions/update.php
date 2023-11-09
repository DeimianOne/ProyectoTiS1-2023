<?php
    include("../../../database/connection.php");
    
    $codigo = $_POST["cod_rol"];
    $nombre = $_POST["nombre_rol"];

    $query_actualizar_rol = "UPDATE rol SET nombre_rol = '$nombre' WHERE cod_rol = $codigo";
    $result_actualizar_rol = mysqli_query($connection, $query_actualizar_rol);

    if ($result_actualizar_rol) {
        // Eliminar las relaciones de permisos existentes para el rol
        $query_eliminar_permisos = "DELETE FROM rol_permiso WHERE cod_rol = $codigo";
        $result_eliminar_permisos = mysqli_query($connection, $query_eliminar_permisos);

        if ($result_eliminar_permisos) {
            // Verificar si se enviaron nuevos permisos en el formulario
            if (isset($_POST['permisos']) && is_array($_POST['permisos'])) {
                // Insertar las nuevas relaciones de permisos en la tabla 'rol_permiso'
                foreach ($_POST['permisos'] as $cod_permiso) {
                    $query_insertar_permiso = "INSERT INTO rol_permiso (cod_rol, cod_permiso) VALUES ($codigo, $cod_permiso)";
                    $result_insertar_permiso = mysqli_query($connection, $query_insertar_permiso);
                }
            }
        }
    }

    header("Location: ../../../index.php?p=roles/index");
?>