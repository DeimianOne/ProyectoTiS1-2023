<?php
include("database/connection.php");
include("database/auth.php");

// Verifica el rol del usuario
if (isset($_SESSION['rut_usuario'])) {
    if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)) {
        $query = "SELECT ticket.*, estado.cod_estado, estado.nombre_estado, departamento.nombre_departamento
            FROM ticket
            LEFT JOIN estado_ticket ON ticket.cod_ticket = estado_ticket.cod_ticket
            LEFT JOIN estado ON estado_ticket.cod_estado = estado.cod_estado
            LEFT JOIN departamento ON ticket.cod_departamento = departamento.cod_departamento";
    } elseif ($_SESSION['rol_usuario'] == '2') {
        $query = "SELECT ticket.*, estado.nombre_estado, departamento.nombre_departamento
            FROM ticket
            LEFT JOIN estado_ticket ON ticket.cod_ticket = estado_ticket.cod_ticket
            LEFT JOIN estado ON estado_ticket.cod_estado = estado.cod_estado
            LEFT JOIN departamento ON ticket.cod_departamento = departamento.cod_departamento
            WHERE rut_usuario = '" . $_SESSION['rut_usuario'] . "'";
    } else {
        header("Location: index.php?p=auth/login");
        exit;
    }
} else {
    header("Location: index.php?p=auth/login");
    exit;
}

$result = mysqli_query($connection, $query);

if (isset($_SESSION['mensaje'])) {
    ?>
    <div class="alert alert-<?php echo ($_SESSION['mensaje'] == 'Ticket enviado correctamente.') ? 'success' : 'danger'; ?>"
        role="alert">
        <?php echo $_SESSION['mensaje']; ?>
    </div>
    <?php
    unset($_SESSION['mensaje']);
}

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

// Consulta para contar la cantidad de cada tipo de solicitud
$queryContarTipoSolicitud = "SELECT tipo_solicitud, COUNT(*) as cantidad FROM ticket GROUP BY tipo_solicitud";
$resultContarTipoSolicitud = mysqli_query($connection, $queryContarTipoSolicitud);

// Inicializar arrays para los datos del gráfico
$labels = [];
$data = [];

// Recorrer los resultados y llenar los arrays
while ($row = $resultContarTipoSolicitud->fetch_assoc()) {
    $labels[] = $row['tipo_solicitud'];
    $data[] = $row['cantidad'];
}

// Realiza tu consulta para obtener el total de tickets
$queryTotalTickets = "SELECT COUNT(*) as total FROM ticket";
$resultTotalTickets = mysqli_query($connection, $queryTotalTickets);

// Obtiene el total de tickets
$rowTotalTickets = $resultTotalTickets->fetch_assoc();
$totalTickets = $rowTotalTickets['total'];

?>


<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <?php if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?>
            <h2 class="fw-normal">Tickets en el sistema</h2>
        <?php endif; ?>
        <?php if ($_SESSION['rol_usuario'] == '2'): ?>
            <h2 class="fw-normal">Mis tickets en el sistema</h2>
        <?php endif; ?>
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

        <?php if ($_SESSION['rol_usuario'] == '2'): ?>
            table.column(2).visible(false);
            table.column(3).visible(false);
        <?php endif; ?>

        <?php if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?>
            table.column(1).visible(false);
        <?php endif; ?>


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

<script>
    function exportarCSV(){

        var tabla = $('#example').DataTable(); //obtener datos tabla
        //var datos = tabla.rows().data().toArray();

        console.log(tabla.rows().data().toArray()); //depuracion

        //try and catch para ver si se obtienen los datos correctamente
        try{
            var datos = tabla.rows().data().toArray();
        }catch(error){
            console.error('Error al obtener datos de la datatable:', error);
            return;
        }

        //para ver si hay datos
        if(datos.length === 0) {
            console.error('No hay datos para exportar.');
            return;
        }
        
        var contenidoCSV = 'data:text/csv;charset=utf-8,'; //crear contenido del archivo CSV

        contenidoCSV += 'Codigo Ticket;Departamento;Tipo Solicitud;Estado Solicitud;Fecha y Hora Envio;Visibilidad\n'; //encabezados

        //agregar filas de datos
        datos.forEach(function(row){
            contenidoCSV += row[0] + ';' + row[3] + ';' + row[4] + ';' + row[6] + ';' + row[7] + ';' + row[8] + '\n';
        });

        //crear enlace temporal y clic para descargar el archivo
        var uri = encodeURI(contenidoCSV);
        var link = document.createElement('a');
        link.setAttribute('href', uri);
        link.setAttribute('download', 'datos_tickets.csv');
        document.body.appendChild(link);
        link.click();
        
    }
</script>

<script>
    var pieChartModal;

    function mostrarGrafico(){
        //obtener el canvas existente con su contexto
        var canvas = document.getElementById('pieChartModal');
        var ctxModal = canvas.getContext('2d');

        //verificar si hay al menos un ticket antes de mostrar el gráfico
        if(<?php echo json_encode($totalTickets); ?> > 0){

            //si existe un gráfico actualiza sus datos en lugar de destruirlo volver a crearlo
            if (pieChartModal){
                //cargar datos nuevos
                var newData = {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($data); ?>,
                        backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384']
                    }]
                };

                // Actualizar datos del gráfico existente
                pieChartModal.data = newData;
                pieChartModal.update();

            }else{
                //si no existe el gráfico crea uno nuevo
                var data = {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($data); ?>,
                        backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384']
                    }]
                };

                pieChartModal = new Chart(ctxModal, {
                    type: 'pie',
                    data: data,
                });
            }

        //activar modal
        var chartModal = new bootstrap.Modal(document.getElementById('chartModal'));
        chartModal.show();

        }else{
            // Muestra un mensaje o realiza alguna acción si no hay tickets
            alert("No hay tickets disponibles");
        }
    }
</script>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <span>Tickets</span>
                </div>

                <div class="d-flex">
                    <?php if ($_SESSION['rol_usuario'] == '2'): ?> <!-- Si es usuario, puede meter tickets -->
                        <div>
                            <a class="btn btn-sm btn-primary" href="index.php?p=tickets/create" role="button">Crear nuevo
                                Ticket</a>
                        </div>
                    <?php endif; ?>

                    <?php if($_SESSION['rol_usuario'] == '1' || (in_array(11,$codPermisoArray)) && (in_array(10,$codPermisoArray))): ?> <!-- Si es admin, puede exportar los datos de los tickets -->
                        <div style="margin-right: 10px;">
                            <a class="btn btn-sm btn-primary " id="graphBtn" role="button" onclick="mostrarGrafico()">Ver grafico comparativo de tickets</a>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-primary" id="exportBtn" role="button" onclick="exportarCSV()">Exportar datos a archivo CSV</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="chartModalLabel">Gráfico Comparativo de Tickets</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- aqui se muestra el gráfico -->
                                <canvas id="pieChartModal" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Grafico -->
                <!-- <canvas id="pieChart" width="400" height="400"></canvas> -->

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
                        <?php if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?> <!-- Si es admin, muestra la columna -->
                            <th scope="col">Visibilidad</th>
                        <?php endif; ?>
                        <th scope="col"></th>

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
                            <?php if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?>
                                <td>
                                    <?= $fila['visibilidad_solicitud'] ? "Público" : "Privado" ?>
                                </td>
                            <?php endif; ?>
                            <?php if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?>
                                <td>
                                    <div class="btn-group-sm" role="group" aria-label="Basic example">
                                        <button
                                            onclick="window.location.href='index.php?p=tickets/view&cod_ticket=<?= $fila['cod_ticket'] ?>'"
                                            type="button" class="btn btn-outline-primary">Ver</button>
                                        <!-- <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            data-cod-ticket="<?= $fila['cod_ticket'] ?>">Detalles</button> -->
                                    </div>
                                </td>
                            <?php elseif ($_SESSION['rol_usuario'] == '2'): ?>
                                <td>
                                    <div class="btn-group-sm" role="group" aria-label="Basic example">
                                        <button
                                            onclick="window.location.href='index.php?p=tickets/view&cod_ticket=<?= $fila['cod_ticket'] ?>'"
                                            type="button" class="btn btn-outline-primary">Ver</button>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de Ticket</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Código de Ticket: <span id="codTicket"></span></p>
                        <div id="detalleTicket"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>