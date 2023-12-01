<?php
    include("../../../database/connection.php");
    
    $old = $_POST["cod_old"];
    $codigo = $_POST["cod_rol"];
    $rut = $_POST["rut_usuario"];

    $query_actualizar_rol_usuario = "UPDATE usuario_rol SET cod_rol = '$codigo' WHERE rut_usuario = '$rut' AND cod_rol = '$old';";
    
    $result_actualizar_rol_usuario = mysqli_query($connection, $query_actualizar_rol_usuario);

    header("Location: ../../../index.php?p=roles/index");
?>