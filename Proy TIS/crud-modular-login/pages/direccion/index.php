<?php
include("database/connection.php");  // Incluye la conexión
include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

$query = "SELECT direccion.*, comuna.nombre_comuna AS nombre_comuna FROM direccion JOIN comuna ON direccion.cod_comuna = comuna.cod_comuna";
$result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Direcciones</h1>
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

    function confirmDelete(cod_tabla) {
        // Verificar si valor es clave foránea en varias tablas
        $.ajax({
            url: 'pages/actions/check_foreign_key.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                value: cod_tabla,
                checks: [
                    { table: 'usuario_direccion', field: 'cod_direccion' }
                ]
            }),
            success: function (response) {
                const parsedResponse = JSON.parse(response);
                const dependentTables = Array.isArray(parsedResponse) ? parsedResponse : [];

                if (dependentTables.length > 0) {
                    // Es clave foránea, mostrar alerta con información de las tablas
                    alert(`No se puede borrar este dato, ya que depende de las siguientes tablas: ${dependentTables.join(', ')}`);
                } else {
                    // No es clave foránea, redirigir a delete.php para eliminar
                    window.location.href = 'pages/direccion/actions/delete.php?cod_direccion=' + cod_tabla;
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
                    <span>Listado de direcciones</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=direccion/create" role="button">Agregar
                        nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table id="example" class="display table-hover justify-content-center" style="width:100%">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Calle</th>
                        <th scope="col">Número</th>
                        <th scope="col">Número Piso/Oficina/Depto/</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)): ?>
                        <tr>
                            <th scope="row">
                                <?= $fila['cod_direccion'] ?>
                            </th>
                            <td>
                                <?= $fila['calle'] ?>
                            </td>
                            <td>
                                <?= $fila['numero'] ?>
                            </td>
                            <td>
                                <?= $fila['numero_departamento'] ?>
                            </td>
                            <td>
                                <?= $fila['nombre_comuna'] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <a href="index.php?p=direccion/edit&cod_direccion=<?= $fila['cod_direccion'] ?>"
                                        class="btn btn-sm btn-outline-warning">Editar</a>
                                    <a href="javascript:void(0);" onclick="confirmDelete(<?= $fila['cod_direccion'] ?>)"
                                        class="btn btn-sm btn-outline-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>