<?php
include("../../../database/connection.php");

// Obtener el código de ticket enviado por AJAX
$id = $_GET['codTicket'];

// Consulta para obtener la información del ticket
$query = "SELECT ticket.*, estado.cod_estado, estado.nombre_estado, departamento.nombre_departamento
FROM ticket
LEFT JOIN estado_ticket ON ticket.cod_ticket = estado_ticket.cod_ticket
LEFT JOIN estado ON estado_ticket.cod_estado = estado.cod_estado
LEFT JOIN departamento ON ticket.cod_departamento = departamento.cod_departamento 
WHERE ticket.cod_ticket=" . $id . ";";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {

    // Obtener los estados de solicitud
    $queryEstados = "SELECT * FROM estado";
    $resultEstados = mysqli_query($connection, $queryEstados);

    $estados = array();
    while ($filaEstado = mysqli_fetch_array($resultEstados)) {
        $estados[$filaEstado['cod_estado']] = $filaEstado['nombre_estado'];
    }

    // Obtener departamentos de solicitud
    $queryDepartamentos = "SELECT * FROM departamento";
    $resultDepartamentos = mysqli_query($connection, $queryDepartamentos);

    $departamentos = array();
    while ($filaDepartamento = mysqli_fetch_array($resultDepartamentos)) {
        $departamentos[$filaDepartamento['cod_departamento']] = $filaDepartamento['nombre_departamento'];
    }

    echo "<p>Rut creador del ticket: {$row['rut_usuario']} </p>";
    echo "<p>Tipo de solicitud: {$row['tipo_solicitud']}</p>";
    
    // Checkbox para realizar cambios
    echo '<input type="checkbox" id="cambiosCheckbox" /> Realizar cambios';

} else {
    echo "<p>No hay detalles</p>";
}

echo '<div class="modal-footer">';
echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
echo '<button type="button" class="btn btn-primary" id="guardarCambiosBtn" disabled onclick="guardarCambios()">Guardar cambios</button>';
echo '</div>';

?>

<script>
    function guardarCambios() {
        // Obtener el estado del checkbox
        var cambiosCheckbox = document.getElementById('cambiosCheckbox');
        var cambiosRealizados = cambiosCheckbox.checked;

        // Si se realizaron cambios, enviar los datos al servidor
        if (cambiosRealizados) {
            var idTicket = <?php echo $id; ?>; // Obtener el ID del ticket desde PHP
            // Aquí deberías enviar una solicitud AJAX al servidor con los datos que deseas insertar
            // Puedes utilizar la biblioteca XMLHttpRequest o una biblioteca como jQuery.ajax para esto
            // Ejemplo con jQuery.ajax:
            $.ajax({
                type: 'POST',
                url: 'guardar_cambios.php', // Reemplaza esto con la ruta correcta de tu script PHP
                data: {
                    idTicket: idTicket,
                    // Otros datos que desees enviar al servidor
                },
                success: function(response) {
                    // Manejar la respuesta del servidor
                    console.log(response);
                    // Actualizar la interfaz de usuario si es necesario
                    alert("Cambios guardados con éxito"); // Puedes mostrar un mensaje de éxito
                    // También puedes realizar otras actualizaciones en la interfaz de usuario aquí
                },
                error: function(error) {
                    // Manejar errores si los hay
                    console.error(error);
                    alert("Hubo un error al guardar los cambios");
                }
            });
        }
    }
</script>

