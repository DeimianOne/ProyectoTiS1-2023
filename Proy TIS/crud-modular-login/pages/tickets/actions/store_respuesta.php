<?php
include("../../../database/connection.php");
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

    $query_correo = "SELECT ticket.*, usuario.correo_electronico_usuario FROM ticket JOIN usuario ON ticket.rut_usuario = usuario.rut_usuario WHERE ticket.cod_ticket='" . $cod_ticket . "';";
    $result_correo = mysqli_query($connection, $query_correo);

    if ($result_correo) {
        $correo = mysqli_fetch_assoc($result_correo)["correo_electronico_usuario"];

        $correo = "josephftwyt@gmail.com";

        // the message
        $msg = "First line of text\nSecond line of text";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg, 70);
        $headers = "From: josephriv98@gmail.com";


        mail($correo, "Ticket Retroalimentacion Ciudadana Actualizado", $msg, $headers);
    }

} else {
    $_SESSION['mensaje'] = "Error al enviar el ticket: " . mysqli_error($connection);
}

header("Location: ../../../index.php?p=tickets/view&cod_ticket=$cod_ticket");
?>