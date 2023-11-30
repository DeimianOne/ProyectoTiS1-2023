<?php
include("../../../database/connection.php");
include("../../../mail/index.php");

session_start();

$cod_ticket = $_POST["cod_ticket"];
$rut_usuario = $_SESSION['rut_usuario'];
$detalles_respuesta = $_POST["detalles_respuesta"];
$cod_estado = $_POST["cod_estado"];

$query = "INSERT INTO respuesta (cod_ticket, rut_usuario, detalles_respuesta) VALUES ('$cod_ticket', '$rut_usuario', '$detalles_respuesta')";
$result = mysqli_query($connection, $query);

if ($result) {
    $_SESSION['mensaje'] = "Respuesta enviada correctamente.";

    $codigo = mysqli_insert_id($connection);

    $query_r_estado = "DELETE FROM estado_ticket WHERE cod_ticket='" . $cod_ticket . "';";
    $result_r_estado = mysqli_query($connection, $query_r_estado);

    if ($result_r_estado) {
        $query = "INSERT INTO estado_ticket(cod_ticket, cod_estado) VALUES ('$cod_ticket', '$cod_estado')";
        $result = mysqli_query($connection, $query);
    }

    include("../../registro_tickets\actions\store_register.php");
    insertar_registro($cod_ticket, $codigo);




    $query_correo = "SELECT ticket.*, usuario.correo_electronico_usuario, usuario.nombre_usuario, estado_ticket.cod_estado, estado.nombre_estado
    FROM ticket 
    JOIN usuario ON ticket.rut_usuario = usuario.rut_usuario 
    LEFT JOIN estado_ticket ON ticket.cod_ticket = estado_ticket.cod_ticket
    LEFT JOIN estado ON estado_ticket.cod_estado = estado.cod_estado
    WHERE ticket.cod_ticket ='" . $cod_ticket . "';";
    $result_correo = mysqli_query($connection, $query_correo);


    // Enviar correo a usuario creador del ticket
    if ($row = mysqli_fetch_assoc($result_correo)) {
        $correo = $row["correo_electronico_usuario"];
        $nombre_usuario = $row["nombre_usuario"];
        $nombre_estado = $row["nombre_estado"];

        enviarCorreoRespuesta($correo, $nombre_usuario, $cod_ticket, $nombre_estado);
    }

    
    // Obtener los suscriptores del ticket y enviarles correo
    $querySuscriptores = "SELECT * FROM suscripcion WHERE cod_ticket = ".$cod_ticket;
    $resultSuscriptores = mysqli_query($connection, $querySuscriptores);

    while ($filaSuscriptores = mysqli_fetch_array($resultSuscriptores)) {
        $querySuscriptor = "SELECT * FROM usuario WHERE rut_usuario =".$filaSuscriptores['rut_usuario'];
        $resultSuscriptor = mysqli_query($connection, $querySuscriptor);

        if($row = mysqli_fetch_array($resultSuscriptor)){
            enviarCorreoRespuesta($row['correo_electronico_usuario'], $row['nombre_usuario'], $cod_ticket, $nombre_estado);
        }
    }

} else {
    $_SESSION['mensaje'] = "Error al enviar el ticket: " . mysqli_error($connection);
}

header("Location: ../../../index.php?p=tickets/view&cod_ticket=$cod_ticket");
?>