<?php
include("../../../database/connection.php");

// Obtener el código de ticket enviado por AJAX
$codTicket = $_GET['codTicket'];

$query = "SELECT * FROM ticket WHERE cod_ticket = " . $codTicket;
$result = mysqli_query($connection, $query);


$detalles = mysqli_fetch_assoc($result);


echo "<p>Rut creador del ticket: {$detalles['rut_usuario']}</p>";
echo "<p>Tipo de solicitud: {$detalles['tipo_solicitud']}</p>";

?>
