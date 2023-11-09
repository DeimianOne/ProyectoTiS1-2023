<?php
    include("../../../database/connection.php");
    session_start();

    $rut_usuario = $_SESSION['rut_usuario'];
    $cod_departamento = $_POST["cod_departamento"];
    $tipo_solicitud = $_POST["tipo_solicitud"];
    $asunto_ticket = $_POST["asunto_ticket"];
    $detalles_solicitud = $_POST["detalles_solicitud"];

    $query = "INSERT INTO ticket (cod_departamento, rut_usuario, tipo_solicitud, asunto_ticket, detalles_solicitud) VALUES ('$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$asunto_ticket', '$detalles_solicitud')";
    $result = mysqli_query($connection, $query);

    $codigo = mysqli_insert_id($connection);

    $query_registro = "INSERT INTO registro_ticket (cod_ticket, cod_departamento, rut_usuario, tipo_solicitud, asunto_ticket, detalles_solicitud) VALUES ('$codigo','$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$asunto_ticket', '$detalles_solicitud')";
    $result_registro = mysqli_query($connection, $query_registro);


    header("Location: ../../../index.php?p=tickets/index");
?>
