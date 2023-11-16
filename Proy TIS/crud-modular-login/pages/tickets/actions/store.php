<?php
    include("../../../database/connection.php");
    session_start();

    function contieneMalasPalabras($texto, $conexion) {
        $query = "SELECT palabra FROM palabra_ofensiva";
        $resultConsulta = mysqli_query($conexion, $query);
    
        if ($resultConsulta) {
            while ($row = $resultConsulta->fetch_assoc()) {
                $palabra = $row['palabra'];
                if (stripos($texto, $palabra) !== false) {
                    return true;
                }
            }
        }
        return false;
    }

    $rut_usuario = $_SESSION['rut_usuario'];
    $cod_departamento = $_POST["cod_departamento"];
    $tipo_solicitud = $_POST["tipo_solicitud"];
    $asunto_ticket = $_POST["asunto_ticket"];
    $detalles_solicitud = $_POST["detalles_solicitud"];

    // Verificar malas palabras
    if (contieneMalasPalabras($detalles_solicitud, $connection)) {
        $_SESSION['mensaje'] = "El texto contiene malas palabras. No se puede enviar el ticket.";
    } else {
        // Insertar el ticket en la base de datos
        $query = "INSERT INTO ticket (cod_departamento, rut_usuario, tipo_solicitud, asunto_ticket, detalles_solicitud) VALUES ('$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$asunto_ticket', '$detalles_solicitud')";
        $resultInsercion = mysqli_query($connection, $query);

        if ($resultInsercion) {
            $_SESSION['mensaje'] = "Ticket enviado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al enviar el ticket: " . mysqli_error($connection);
        }
    }

    //$query = "INSERT INTO ticket (cod_departamento, rut_usuario, tipo_solicitud, asunto_ticket, detalles_solicitud) VALUES ('$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$asunto_ticket', '$detalles_solicitud')";
    //$result = mysqli_query($connection, $query);

    $codigo = mysqli_insert_id($connection);

    $query_registro = "INSERT INTO registro_ticket (cod_ticket, cod_departamento, rut_usuario, tipo_solicitud, asunto_ticket, detalles_solicitud) VALUES ('$codigo','$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$asunto_ticket', '$detalles_solicitud')";
    $result_registro = mysqli_query($connection, $query_registro);


    header("Location: ../../../index.php?p=tickets/index");
?>
