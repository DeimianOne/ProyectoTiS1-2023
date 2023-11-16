<?php
include("database/connection.php"); // Incluye la conexión
include("database/auth.php"); // Comprueba si el usuario está logueado, sino lo redirige al login

if (isset($_SESSION['rut_usuario'])) {
    if ($_SESSION['rol_usuario'] == '1') {
        $query = "SELECT * FROM ticket"; // Si es admin, selecciona todos los tickets
    } elseif ($_SESSION['rol_usuario'] == '2') {
        $query = "SELECT ticket.*, departamento.nombre_departamento as nombre_departamento, estado.nombre_estado as estado_ticket FROM ticket left join estado_ticket ON (ticket.cod_ticket = estado_ticket.cod_ticket) left join estado on (estado_ticket.cod_estado=estado.cod_estado) left join departamento on (ticket.cod_departamento=departamento.cod_departamento) WHERE rut_usuario = '" . $_SESSION['rut_usuario'] . "'"; // Selecciona sólo los tickets del rut de sesión
    } else {
        header("Location: index.php?p=auth/login");
        exit;
    }
} else {
    header("Location: index.php?p=auth/login");
    exit;
}

$result = mysqli_query($connection, $query);
$resultModalS = mysqli_query($connection, $query);
$resultModalA = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Mis calificaciones pendientes</h2>
    </div>
</div>

<!-- DataTable en español  -->

<script>
    $(document).ready(function () {
        $('#example').DataTable({
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
</script>

<main class="container mt-5">

    <div class="card">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <span>Hola, aquí puedes calificar la utilizabilidad del sistema</span>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table id="example" class="display table-hover justify-content-center" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Tipo de Solicitud</th>
                        <th scope="col">Código Ticket</th>
                        <th scope="col">Asunto Ticket</th>
                        <th scope="col">Fecha y Hora de Envío</th>
                        <th scope="col">Departamento asociado</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td>
                                <?= $fila['tipo_solicitud'] ?>
                            </td>
                            <td>
                                <?= $fila['cod_ticket'] ?>
                            </td>
                            <td>
                                <?= $fila['asunto_ticket'] ?>
                            </td>
                            <td>
                                <?= $fila['fecha_hora_envio'] ?>
                            </td>
                            <td>
                                <?= $fila['nombre_departamento'] ?>
                            </td> <!-- Probablemente deberiamos poner el nombre del depa... -->
                            <td>
                                <?= $fila['estado_ticket'] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Horizontal button group">
                                    <a href="index.php?p=calificacion/calificar_sistema&cod_ticketx=<?= $fila['cod_ticket'] ?>" class="btn btn-sm btn-warning">Calificar Sistema</a>
                                    <a href="index.php?p=calificacion/calificar_atencion&cod_ticketx=<?= $fila['cod_ticket'] ?>" class="btn btn-sm btn-warning">Calificar Atención</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>





    </div>
</main>


