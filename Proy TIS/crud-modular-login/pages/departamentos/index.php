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
</script>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Aquí puedes agregar departamentos.</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=departamentos/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="example" class="display table-hover justify-content-center" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Código Departamento</th>
                        <th scope="col">Municipalidad</th>
                        <th scope="col">Nombre Departamento</th>
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
                            <th scope="row"><?= $fila['cod_departamento'] ?></th>
                            <td><?= $fila['nombre_municipalidad'] ?></td>
                            <td><?= $fila['nombre_departamento'] ?></td>
                            <td><?= $fila['telefono_departamento'] ?></td>
                            <td><?= $fila['atencion_presencial'] == 1 ? 'Sí' : 'No' ?></td>
                            <td><?= $fila['horario_atencion_inicio'] ?></td>
                            <td><?= $fila['horario_atencion_termino'] ?></td>
                            <td>
                                <a href="index.php?p=departamentos/edit&id=<?= $fila['cod_departamento'] ?>" class="btn btn-sm btn-outline-warning my-2">Editar Datos</a>
                                <a href="pages/departamentos/actions/delete.php?id=<?= $fila['cod_departamento'] ?>" class="btn btn-sm btn-outline-danger my-2">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
