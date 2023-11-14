<?php
    include("../../../database/connection.php");

    $rut_usuario = $_POST["rut_usuario"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $correo_electronico_usuario = $_POST["correo_electronico_usuario"];
    $correo_electronico_tercero = $_POST["correo_electronico_tercero"];
    $telefono_usuario = $_POST["telefono_usuario"];
    $telefono_tercero = $_POST["telefono_tercero"];

    $query = "UPDATE usuario SET 
                nombre_usuario = '$nombre_usuario', 
                correo_electronico_usuario = '$correo_electronico_usuario',
                correo_electronico_tercero = '$correo_electronico_tercero',
                telefono_usuario = '$telefono_usuario',
                telefono_tercero = '$telefono_tercero'
              WHERE rut_usuario = '$rut_usuario';";

    $result = mysqli_query($connection, $query);

    // Asegúrate de cambiar la dirección de redireccionamiento si es necesario
    header("Location: ../../../index.php?p=home");
?>
