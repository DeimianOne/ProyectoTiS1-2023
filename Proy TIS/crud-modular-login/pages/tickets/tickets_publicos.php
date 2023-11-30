<?php
include("database/connection.php");

$query = "SELECT ticket.*, estado.cod_estado, estado.nombre_estado, departamento.nombre_departamento
    FROM ticket
    LEFT JOIN estado_ticket ON ticket.cod_ticket = estado_ticket.cod_ticket
    LEFT JOIN estado ON estado_ticket.cod_estado = estado.cod_estado
    LEFT JOIN departamento ON ticket.cod_departamento = departamento.cod_departamento
    WHERE ticket.visibilidad_solicitud = true";
$result = mysqli_query($connection, $query);

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

$departamento = array();
while ($filaDepartamento = mysqli_fetch_array($resultDepartamentos)) {
    $departamento[$filaDepartamento['cod_departamento']] = $filaDepartamento['nombre_departamento'];
}

?>


<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Tickets Públicos</h2>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
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

        $('#tipoSolicitudFilter').on('change', function () {
            var filtro = $(this).val();

            // Filtra la tabla según el valor seleccionado
            $('#example').DataTable().column(4).search(filtro).draw();
        });

        $('#estadoFilter').on('change', function () {
            var filtroEstado = $(this).val();

            // Filtra la tabla según el valor seleccionado en el nuevo dropdown
            $('#example').DataTable().column(5).search(filtroEstado).draw();
        });

        $('#departamentoFilter').on('change', function () {
            var filtroDepartamento = $(this).val();

            console.log(filtroDepartamento)
            // Filtra la tabla según el valor seleccionado en el nuevo dropdown
            $('#example').DataTable().column(2).search(filtroDepartamento).draw();
        });

        table.column(5).visible(false);
        table.column(2).visible(false);

        table.column(2).visible(false);
        table.column(3).visible(false);

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var codTicket = button.data('cod-ticket'); // Obtener el valor del atributo data-cod-ticket

            // Actualizar el contenido del modal con el código de ticket
            $('#codTicket').text(codTicket);

            // Realizar una petición AJAX para obtener los detalles del ticket
            $.ajax({
                type: 'GET',
                url: 'pages/tickets/actions/obtener_detalles.php',
                data: { codTicket: codTicket },
                success: function (response) {
                    $('#detalleTicket').html(response); // Mostrar los detalles en el modal
                },
                error: function () {
                    alert('Error al obtener detalles del ticket');
                }
            });
        });
    });
</script>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <span>Listado de tickets públicos</span>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label for="departamentoFilter" class="form-label">Filtrar por Departamento:</label>
                    <select class="form-select" id="departamentoFilter">
                        <option value="">Todos</option>
                        <?php foreach ($departamento as $codDepartamento => $nombreDepartamento): ?>
                            <option value="<?= $codDepartamento ?>">
                                <?= $nombreDepartamento ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tipoSolicitudFilter" class="form-label">Filtrar por Tipo de Solicitud:</label>
                    <select class="form-select" id="tipoSolicitudFilter">
                        <option value="">Todos</option>
                        <option value="felicitacion">Felicitaciones</option>
                        <option value="reclamo">Reclamos</option>
                        <option value="sugerencia">Sugerencias</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="estadoFilter" class="form-label">Filtrar por Estado:</label>
                    <select class="form-select" id="estadoFilter">
                        <option value="">Todos</option>
                        <?php foreach ($estados as $codEstado => $nombreEstado): ?>
                            <option value="<?= $codEstado ?>">
                                <?= $nombreEstado ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <table id="example" class="display table-hover justify-content-center" style="width:100%">
                <thead class="">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col" style="width: 400px;">Asunto</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Tipo de Solicitud</th>
                        <th scope="col">Estado Solicitud</th>
                        <th scope="col">Estado Solicitud</th>
                        <th scope="col">Fecha y Hora de Envío</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)): ?>
                        <tr>
                            <th scope="row">
                                <?= $fila['cod_ticket'] ?>
                            </th>
                            <td style="width: 400px;">
                                <?php
                                $asunto = $fila['asunto_ticket'];
                                $maxCaracteres = 40; // Puedes ajustar este valor según tus necesidades
                            
                                // Trim y agrega puntos suspensivos si el texto supera la longitud máxima
                                echo strlen($asunto) > $maxCaracteres ? substr($asunto, 0, $maxCaracteres) . '...' : $asunto;
                                ?>
                            </td>
                            <td>
                                <?= $fila['cod_departamento'] ?>
                            </td>
                            <td>
                                <?= $fila['nombre_departamento'] ?>
                            </td>
                            <td>
                                <?= ucfirst($fila['tipo_solicitud']) ?>
                            </td>
                            <td>
                                <?= $fila['cod_estado'] ?>
                            </td>
                            <td>
                                <?= $fila['nombre_estado'] ?>
                            </td>
                            <td>
                                <?= $fila['fecha_hora_envio'] ?>
                            </td>
                            <td>
                                <div class="btn-group-sm" role="group" aria-label="Basic example">
                                    <button
                                        onclick="window.location.href='index.php?p=tickets/view&cod_ticket=<?= $fila['cod_ticket'] ?>'"
                                        type="button" class="btn btn-outline-primary">Ver</button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>