<?php
include("database/connection.php");  // Incluye la conexión
include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == '1') {

    $query = "SELECT departamento.*, municipalidad.nombre_municipalidad AS nombre_municipalidad FROM departamento JOIN municipalidad ON departamento.cod_municipalidad = municipalidad.cod_municipalidad";

    $result = mysqli_query($connection, $query);

} else {
    header("Location: index.php?p=auth/login");
}

?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Departamentos en el sistema</h2>
    </div>
</div>

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


    function showDoubleConfirmModal(codDepartamento) {
        $('#doubleConfirmModal').modal('show');

        // Guarda el ID del departamento que se eliminará para usarlo en la función executeDelete
        $('#doubleConfirmModal').data('codDepartamento', codDepartamento);
    }

    function executeDelete() {
        // Obtiene el ID del departamento guardado
        var codDepartamento = $('#doubleConfirmModal').data('codDepartamento');

        // Cierra el modal de doble confirmación
        $('#doubleConfirmModal').modal('hide');

        // Ejecuta la función confirmDelete con el ID del departamento
        confirmDelete(codDepartamento);
    }

    function confirmDelete(cod_departamento) {
        // Verificar si el departamento es clave foránea en varias tablas
        $.ajax({
            url: 'pages/actions/check_foreign_key.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                value: cod_departamento,
                checks: [
                    { table: 'proyecto', field: 'cod_departamento' },
                    { table: 'registro_ticket', field: 'cod_departamento' },
                    { table: 'agenda', field: 'cod_departamento' },
                    { table: 'ticket', field: 'cod_departamento' }
                ]
            }),
            success: function (response) {
                const parsedResponse = JSON.parse(response);
                const dependentTables = Array.isArray(parsedResponse) ? parsedResponse : [];

                if (dependentTables.length > 0) {
                    // Es clave foránea, mostrar alerta con información de las tablas
                    alert(`No se puede borrar este departamento, ya que depende de las siguientes tablas: ${dependentTables}`);
                } else {
                    // No es clave foránea, redirigir a delete.php para eliminar
                    window.location.href = 'pages/departamentos/actions/delete.php?id=' + cod_departamento;
                }
            },
            error: function (error) {
                console.error('Error al verificar clave foránea:', error);
            }
        });
    }

</script>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <span>Listado de departamentos</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=departamentos/create" role="button">Agregar
                        nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="example" class="display table-hover justify-content-center" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Municipalidad</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Atención Presencial</th>
                        <th scope="col">Horario de Atención (Inicio)</th>
                        <th scope="col">Horario de Atención (Término)</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)): ?>
                        <tr>
                            <th scope="row">
                                <?= $fila['cod_departamento'] ?>
                            </th>
                            <td>
                                <?= $fila['nombre_municipalidad'] ?>
                            </td>
                            <td>
                                <?= $fila['nombre_departamento'] ?>
                            </td>
                            <td>
                                <?= $fila['telefono_departamento'] ?>
                            </td>
                            <td>
                                <?= $fila['atencion_presencial'] == 1 ? 'Sí' : 'No' ?>
                            </td>
                            <td>
                                <?= $fila['horario_atencion_inicio'] ?>
                            </td>
                            <td>
                                <?= $fila['horario_atencion_termino'] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <a href="index.php?p=departamentos/edit&id=<?= $fila['cod_departamento'] ?>"
                                        class="btn btn-sm btn-outline-warning">Editar</a>
                                    <a href="javascript:void(0);" onclick="showDoubleConfirmModal(<?= $fila['cod_departamento'] ?>)"
                                        class="btn btn-sm btn-outline-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Double Confirmation Modal -->
    <div class="modal fade" id="doubleConfirmModal" tabindex="-1" aria-labelledby="doubleConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white text-center">
                    <h1 class="modal-title fs-5" id="doubleConfirmModalLabel">
                        Confirmación
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p><strong>¿Seguro que deseas eliminar esta fila?</strong> <br> Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="executeDelete()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>


</main>

