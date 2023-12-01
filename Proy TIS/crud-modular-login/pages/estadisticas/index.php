<?php
//include("database/auth.php");
include("database/connection.php");  // Incluye la conexión

// Verificar si es una solicitud AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['municipalidad'])) {
    $municipalidad = mysqli_real_escape_string($connection, $_POST['municipalidad']);

    // Consulta SQL para obtener los detalles de las calificaciones
    $sqlDetalles = "SELECT d.nombre_departamento, t.cod_ticket, ca.calificacion_atencion, ca.comentario_atencion, cs.calificacion_sistema, cs.comentario_sistema 
                    FROM municipalidad m
                    LEFT JOIN departamento d ON m.cod_municipalidad = d.cod_municipalidad
                    LEFT JOIN ticket t ON d.cod_departamento = t.cod_departamento
                    LEFT JOIN calificacion_atencion ca ON t.cod_ticket = ca.cod_ticket
                    LEFT JOIN calificacion_sistema cs ON t.cod_ticket = cs.cod_ticket
                    WHERE m.nombre_municipalidad = '$municipalidad'";

    $resultDetalles = mysqli_query($connection, $sqlDetalles);
    $html = "<table class='table table-bordered'><thead><tr><th>Departamento</th><th>Código Ticket</th><th>Calificación Atención</th><th>Comentario Atención</th><th>Calificación Sistema</th><th>Comentario Sistema</th></tr></thead><tbody>";

    while ($fila = mysqli_fetch_assoc($resultDetalles)) {
        $calificacionAtencion = isset($fila['calificacion_atencion']) && $fila['calificacion_atencion'] !== null ? $fila['calificacion_atencion'] : 'Pendiente';
        $calificacionSistema = isset($fila['calificacion_sistema']) && $fila['calificacion_sistema'] !== null ? $fila['calificacion_sistema'] : 'Pendiente';

        $html .= "<tr>
                <td>{$fila['nombre_departamento']}</td>
                <td>{$fila['cod_ticket']}</td>
                <td>{$calificacionAtencion}</td>
                <td>{$fila['comentario_atencion']}</td>
                <td>{$calificacionSistema}</td>
                <td>{$fila['comentario_sistema']}</td>
              </tr>";
    }

    $html .= "</tbody></table>";

    echo $html;  // Devolver los detalles para el AJAX
    exit;
}

// Lógica para cargar la página normalmente
$sql = "SELECT 
m.nombre_municipalidad AS Municipalidad,
COUNT(DISTINCT t.cod_ticket) AS TotalTickets,
COUNT(DISTINCT ca.cod_ticket) AS NumCalificacionesAtencion,
AVG(ca.calificacion_atencion) AS PromedioAtencion,
COUNT(DISTINCT cs.cod_ticket) AS NumCalificacionesSistema,
AVG(cs.calificacion_sistema) AS PromedioSistema
FROM municipalidad m
LEFT JOIN departamento d ON m.cod_municipalidad = d.cod_municipalidad
LEFT JOIN ticket t ON d.cod_departamento = t.cod_departamento
LEFT JOIN calificacion_atencion ca ON t.cod_ticket = ca.cod_ticket
LEFT JOIN calificacion_sistema cs ON t.cod_ticket = cs.cod_ticket
GROUP BY m.nombre_municipalidad;";
$result = mysqli_query($connection, $sql);

?>

<main class="container mt-5">
    <div class="card">
        <div class="card-header">
            Información de Calificaciones por Municipalidad
        </div>
        <div class="card-body table-responsive">
            <table id="exampleE" class="display table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Municipalidad</th>
                        <th>Tickets en la Municipalidad</th>
                        <th>Número de Calificaciones Atención</th>
                        <th>Promedio Atención</th>
                        <th>Número de Calificaciones Sistema</th>
                        <th>Promedio Sistema</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td>
                                <?= $fila['Municipalidad'] ?>
                            </td>
                            <td>
                                <?= $fila['TotalTickets'] ?>
                            </td>
                            <td>
                                <?= $fila['NumCalificacionesAtencion'] ?>
                            </td>
                            <td>
                                <?= number_format($fila['PromedioAtencion'], 2) ?>
                            </td>
                            <td>
                                <?= $fila['NumCalificacionesSistema'] ?>
                            </td>
                            <td>
                                <?= number_format($fila['PromedioSistema'], 2) ?>
                            </td>
                            
                            <td>
                                <button class="btn btn-success" onclick="verDetalle('<?= $fila['Municipalidad'] ?>')">Ver Detalle</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal para Detalles -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Detalles de Calificaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hola
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#exampleE').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "slast": "Ultimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior",
                },
                "sProcessing": "Procesando...",
            }
        });
    });

    function verDetalle(municipalidad) {
        $.ajax({
            url: 'index.php?p=estadisticas/index', // Ruta actualizada
            type: 'POST',
            data: { municipalidad: municipalidad },
            success: function (response) {
                // Cargar la respuesta en el cuerpo del modal
                $('#detalleModal .modal-body').html(response);
                // Mostrar el modal
                $('#detalleModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error("Error en AJAX: " + status + ", " + error);
            }
        });
    }
</script>