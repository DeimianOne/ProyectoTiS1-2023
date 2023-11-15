<?php
include("database/connection.php");
include("database/auth.php");

// Verifica el rol del usuario
if (isset($_SESSION['rut_usuario'])) {
    if ($_SESSION['rol_usuario'] == '1') {
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

// Obtener los estados de solicitud
$queryDepartamentos = "SELECT * FROM departamento";
$resultDepartamentos = mysqli_query($connection, $queryDepartamentos);

$departamento = array();
while ($filaDepartamento = mysqli_fetch_array($resultDepartamentos)) {
    $departamento[$filaDepartamento['cod_departamento']] = $filaDepartamento['nombre_departamento'];
}

?>


<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Mis tickets en el sistema</h2>
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
            $('#example').DataTable().column(2).search(filtro).draw();
        });

        $('#estadoFilter').on('change', function () {
            var filtroEstado = $(this).val();

            // Filtra la tabla según el valor seleccionado en el nuevo dropdown
            $('#example').DataTable().column(3).search(filtroEstado).draw();
        });

        $('#departamentoFilter').on('change', function () {
            var filtroDepartamento = $(this).val();

            console.log(filtroDepartamento)
            // Filtra la tabla según el valor seleccionado en el nuevo dropdown
            $('#example').DataTable().column(1).search(filtroDepartamento).draw();
        });

        table.column(3).visible(false); 
        table.column(1).visible(false); 
    });
</script>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <span>Tickets</span>
                </div>

                <?php if ($_SESSION['rol_usuario'] == '2'): ?> <!-- Si es usuario, puede meter tickets -->
                    <div>
                        <a class="btn btn-sm btn-primary" href="index.php?p=tickets/create" role="button">Crear nuevo
                            Ticket</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <div class="card-body table-responsive">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tipoSolicitudFilter" class="form-label">Filtrar por Tipo de Solicitud:</label>
                    <select class="form-select" id="tipoSolicitudFilter">
                        <option value="">Todos</option>
                        <option value="felicitacion">Felicitaciones</option>
                        <option value="reclamo">Reclamos</option>
                        <option value="sugerencia">Sugerencias</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
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

                <div class="col-md-6 mb-3">
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
            </div>


            <table id="example" class="display table-hover justify-content-center" style="width:100%">
                <thead class="">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Tipo de Solicitud</th>
                        <th scope="col">Estado Solicitud</th>
                        <th scope="col">Estado Solicitud</th>
                        <th scope="col">Fecha y Hora de Envío</th>
                        <?php if ($_SESSION['rol_usuario'] == '1'): ?> <!-- Si es admin, muestra la columna -->
                            <th scope="col">Visibilidad</th>
                        <?php endif; ?>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)): ?>
                        <tr>
                            <th scope="row">
                                <?= $fila['cod_ticket'] ?>
                            </th>
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
                            <?php if ($_SESSION['rol_usuario'] == '1'): ?> <!-- Si es admin, muestra el RUT del usuario -->
                                <td>
                                <?= $fila['fecha_hora_envio']  ? "Privado" : "Público" ?>
                                </td>
                            <?php endif; ?>
                            <td>
                                <a href="index.php?p=tickets/details&cod_ticket=<?= $fila['cod_ticket'] ?>"
                                    class="btn btn-sm btn-outline-info">Detalles</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>