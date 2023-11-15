<?php
// Verifica la sesión del usuario o cualquier otra lógica de seguridad que sea necesaria

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos del formulario
    $cod_ticket = $_POST['cod_ticket'];
    $visibilidad = $_POST['visibilidad'];

    // Realiza la actualización en la base de datos
    // Aquí deberías tener tu lógica para actualizar el campo 'visibilidad_solicitud' en tu base de datos
    // Utiliza consultas preparadas para prevenir inyecciones SQL

    // Devuelve una respuesta (puede ser un mensaje de éxito, error, o cualquier otra cosa)
    echo 'Éxito';
} else {
    // Si alguien intenta acceder directamente a este archivo sin una solicitud POST, devuelve un mensaje de error
    echo 'Error: Acceso no permitido';
}
?>
