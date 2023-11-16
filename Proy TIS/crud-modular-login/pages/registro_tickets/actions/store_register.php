<?php
    function insertar_registro($codigo, $cod_respuesta = null) {
        include("../../../database/connection.php");

        $cod_ticket = $codigo;

        $ticket_query = "SELECT * FROM ticket WHERE cod_ticket = " . $cod_ticket;
        $ticket_result = mysqli_query($connection, $ticket_query);

        if ($ticket_result) {
            $ticket_data = mysqli_fetch_assoc($ticket_result);

        $cod_departamento = $ticket_data['cod_departamento'];
        $rut_usuario = $ticket_data['rut_usuario'];
        $tipo_solicitud = $ticket_data['tipo_solicitud'];

        $cod_estado_query = "SELECT estado.cod_estado
        FROM estado
        LEFT JOIN estado_ticket ON estado.cod_estado = estado_ticket.cod_estado
        LEFT JOIN ticket ON estado_ticket.cod_ticket = ticket.cod_ticket
        WHERE ticket.cod_ticket = '".$cod_ticket."'";        
        $cod_estado_result = mysqli_query($connection, $cod_estado_query);
        $cod_estado_data = mysqli_fetch_assoc($cod_estado_result);
        $cod_estado = $cod_estado_data['cod_estado'];

        $asunto_ticket = $ticket_data['asunto_ticket'];
        $detalles_solicitud = $ticket_data['detalles_solicitud'];
        $fecha_hora_envio = $ticket_data['fecha_hora_envio'];
        $calificacion = $ticket_data['calificacion'];
        $visibilidad_solicitud = $ticket_data['visibilidad_solicitud'];
        
        
        if($cod_respuesta){
            $query = "INSERT INTO registro_ticket (cod_ticket, cod_departamento, rut_usuario, tipo_solicitud, cod_estado, asunto_ticket, detalles_solicitud, fecha_hora_envio, calificacion, visibilidad_solicitud, cod_respuesta) VALUES ('$cod_ticket', '$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$cod_estado', '$asunto_ticket', '$detalles_solicitud', '$fecha_hora_envio', '$calificacion', '$visibilidad_solicitud', '$cod_respuesta')";
        } else{
            $query = "INSERT INTO registro_ticket (cod_ticket, cod_departamento, rut_usuario, tipo_solicitud, cod_estado, asunto_ticket, detalles_solicitud, fecha_hora_envio, calificacion, visibilidad_solicitud) VALUES ('$cod_ticket', '$cod_departamento', '$rut_usuario', '$tipo_solicitud', '$cod_estado', '$asunto_ticket', '$detalles_solicitud', '$fecha_hora_envio', '$calificacion', '$visibilidad_solicitud')";
        }

        $result =  mysqli_query($connection, $query);

    } else {
        echo "Error al obtener los datos del ticket.";
    }
}
?>