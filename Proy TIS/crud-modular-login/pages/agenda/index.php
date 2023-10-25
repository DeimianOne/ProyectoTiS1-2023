<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    $query = "SELECT agenda.*, departamento.nombre_departamento AS nombre_departamento, usuario.rut_usuario AS rut_usuario, usuario.nombre_usuario AS nombre_usuario
    FROM agenda
    JOIN departamento ON agenda.cod_departamento = departamento.cod_departamento
    JOIN usuario ON agenda.rut_usuario = usuario.rut_usuario";
    $result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Agenda</h1>
    </div>
</div>

<main class="container mt-5">


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Agenda</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=agenda/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Rut agendado</th>
                        <th scope="col">Nombre agendado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_agenda'] ?></th>
                            <td><?= $fila['nombre_departamento'] ?></td>
                            <td><?= $fila['rut_usuario'] ?></td>
                            <td><?= $fila['nombre_usuario'] ?></td>
                            <td><?= $fila['fecha'] ?></td>
                            <td><?= $fila['hora'] ?></td>
                            <td>
                                <a href="index.php?p=agenda/edit&cod_agenda=<?= $fila['cod_agenda'] ?>" class="btn btn-sm btn-outline-warning">Revisar</a>
                                <a href="pages/agenda/actions/delete.php?cod_agenda=<?= $fila['cod_agenda'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>