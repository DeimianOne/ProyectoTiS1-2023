<?php
include("database/connection.php"); // Incluye la conexión
include("database/auth.php"); // Comprueba si el usuario está logueado, sino lo redirige al login

// Verifica el rol del usuario
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
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-warning my-3" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Calificar Sistema
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning my-3 "
                                        data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                        Calificar Atención
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>





    </div>
</main>




<!-- Modal Sistema -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Calificación de sistema</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-start">
                    <div class="col-md-12 mb-3 d-flex justify-content-start">
                        <?php while ($fila = mysqli_fetch_array($resultModalS)): ?>
                            <div style="text-align: justify;">
                                <span>
                                    <h4>En relación al ticket N°:
                                        <?= $fila['cod_ticket'] ?>
                                    </h4>
                                </span>
                                <div>
                                    <h4>Asunto:
                                        <?= $fila['asunto_ticket'] ?>
                                    </h4>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div>
                    <form action="pages/calificacion/actions/storeCalificacionSis.php" method="POST">
                        <div style="text-align: justify;">
                            <span>
                                <h4>Califique la facilidad del sistema para ofrecer retroalimentación.</h4>
                            </span>
                        </div>

                        <div class="rating my-3 col-md-8" >
                            <input type="radio" id="star5"      name="calificacion_sistema" value="5"             /> <label class="full" for="star5"      title="Excelente - 5 stars"></label>
                            <input type="radio" id="star4half"  name="calificacion_sistema" value="4 y medio"     /> <label class="half" for="star4half"  title="Muy Buena - 4.5 stars"></label>
                            <input type="radio" id="star4"      name="calificacion_sistema" value="4"             /> <label class="full" for="star4"      title="Buena - 4 stars"></label>
                            <input type="radio" id="star3half"  name="calificacion_sistema" value="3 y medio"     /> <label class="half" for="star3half"  title="Meh - 3.5 stars"></label>
                            <input type="radio" id="star3"      name="calificacion_sistema" value="3"             /> <label class="full" for="star3"      title="Meh - 3 stars"></label>
                            <input type="radio" id="star2half"  name="calificacion_sistema" value="2 y medio"     /> <label class="half" for="star2half"  title="Regular - 2.5 stars"></label>
                            <input type="radio" id="star2"      name="calificacion_sistema" value="2"             /> <label class="full" for="star2"      title="Deficiente - 2 stars"></label>
                            <input type="radio" id="star1half"  name="calificacion_sistema" value="1 y medio"     /> <label class="half" for="star1half"  title="Mala - 1.5 stars"></label>
                            <input type="radio" id="star1"      name="calificacion_sistema" value="1"             /> <label class="full" for="star1"      title="Muy mala - 1 star"></label>
                            <input type="radio" id="starhalf"   name="calificacion_sistema" value="medio"         /> <label class="half" for="starhalf"   title="Pésima - 0.5 stars"></label>
                        </div>
                        <br><br><br>
                        <div style="align-content: start;">
                            <span>
                                <h4>Por favor, detalle su experiencia utilizando la plataforma.</h4>
                            </span>
                        </div>
                        <textarea class="form-control" id="comentario_sistema"name="comentario_sistema"></textarea>
                    </form>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div class="card-footer text-body-secondary text-end">
                    <button type="submit" class="btn btn-dark disabled">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Atención -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Calificación de atención personal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-start">
                    <div class="col-md-12 mb-3 d-flex justify-content-start">
                        <?php while ($fila = mysqli_fetch_array($resultModalA)): ?>
                            <div style="text-align: justify;">
                                <span>
                                    <h4>En relación al ticket N°:
                                        <?= $fila['cod_ticket'] ?>
                                    </h4>
                                </span>
                                <span>
                                    <h4>Asunto:
                                        <?= $fila['asunto_ticket'] ?>
                                    </h4>
                                </span>
                                <span>
                                    <h4>Encargado:
                                    </h4>
                                </span>
                                <span>
                                    <h4>Periodo:
                                    </h4>
                                </span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div>
                    <form action="pages/calificacion/actions/storeCalificacionAt.php" method="POST">
                        <div style="text-align: justify;">
                            <span>
                                <h4>Califique la atención recibida.</h4>
                            </span>
                        </div>

                        <div class="rating my-3 col-md-8" >
                            <input type="radio" id="star5"      name="calificacion_atencion" value="5"             /> <label class="full" for="star5"      title="Excelente - 5 stars"></label>
                            <input type="radio" id="star4half"  name="calificacion_atencion" value="4 y medio"     /> <label class="half" for="star4half"  title="Muy Buena - 4.5 stars"></label>
                            <input type="radio" id="star4"      name="calificacion_atencion" value="4"             /> <label class="full" for="star4"      title="Buena - 4 stars"></label>
                            <input type="radio" id="star3half"  name="calificacion_atencion" value="3 y medio"     /> <label class="half" for="star3half"  title="Meh - 3.5 stars"></label>
                            <input type="radio" id="star3"      name="calificacion_atencion" value="3"             /> <label class="full" for="star3"      title="Meh - 3 stars"></label>
                            <input type="radio" id="star2half"  name="calificacion_atencion" value="2 y medio"     /> <label class="half" for="star2half"  title="Regular - 2.5 stars"></label>
                            <input type="radio" id="star2"      name="calificacion_atencion" value="2"             /> <label class="full" for="star2"      title="Deficiente - 2 stars"></label>
                            <input type="radio" id="star1half"  name="calificacion_atencion" value="1 y medio"     /> <label class="half" for="star1half"  title="Mala - 1.5 stars"></label>
                            <input type="radio" id="star1"      name="calificacion_atencion" value="1"             /> <label class="full" for="star1"      title="Muy mala - 1 star"></label>
                            <input type="radio" id="starhalf"   name="calificacion_atencion" value="medio"         /> <label class="half" for="starhalf"   title="Pésima - 0.5 stars"></label>
                        </div>
                        <br><br><br>
                        <div style="align-content: start;">
                            <span>
                                <h4>Por favor, detalle su experiencia utilizando la plataforma.</h4>
                            </span>
                        </div>
                        <textarea class="form-control" id="comentario_sistema"name="comentario_sistema"></textarea>
                    </form>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div class="card-footer text-body-secondary text-end">
                    <button type="submit" class="btn btn-dark disabled">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
