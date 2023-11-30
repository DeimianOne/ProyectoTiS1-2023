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
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"]; //falta crear estos espacios en la bd

    // Verificar malas palabras
    if (contieneMalasPalabras($detalles_solicitud, $connection)) {
        $_SESSION['mensaje'] = "El texto contiene malas palabras. No se puede enviar el ticket.";
    } else {
        // Insertar el ticket en la base de datos
        $query = "INSERT INTO ticket (cod_departamento, rut_usuario, tipo_solicitud, asunto_ticket, detalles_solicitud) VALUES ('$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$asunto_ticket', '$detalles_solicitud')";
        $resultInsercion = mysqli_query($connection, $query);

        if ($resultInsercion) {
            $_SESSION['mensaje'] = "Ticket enviado correctamente.";

            $codigo = mysqli_insert_id($connection);

            $query_estado_ticket = "INSERT INTO estado_ticket (cod_ticket, cod_estado) VALUES ('$codigo', 0)"; //0 es el codigo del estado prestablecido para indicar un ticket recien insertado
            $result_estado_ticket = mysqli_query($connection, $query_estado_ticket);

            include("../../registro_tickets\actions\store_register.php"); 
            insertar_registro($codigo);

        } else {
            $_SESSION['mensaje'] = "Error al enviar el ticket: " . mysqli_error($connection);
        }
    }


    header("Location: ../../../index.php?p=tickets/index");
?>
