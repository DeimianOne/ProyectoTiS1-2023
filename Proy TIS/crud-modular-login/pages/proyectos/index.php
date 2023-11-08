<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == '1') {
        
        $query = "SELECT * FROM proyecto";
        $result = mysqli_query($connection, $query);

    } else {
        header("Location: index.php?p=auth/login");
    }

?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Proyectos en el sistema</h2>
    </div>
</div>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Proyectos</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=proyectos/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código Departamento</th>
                        <th scope="col">Nombre Proyecto</th>
                        <th scope="col">Descripción Proyecto</th>
                        <th scope="col">Fecha Inicio Proyecto</th>
                        <th scope="col">Fecha Término Estimado Proyecto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_proyecto'] ?></th>
                            <td><?= $fila['cod_departamento'] ?></td>
                            <td><?= $fila['nombre_proyecto'] ?></td>
                            <td><?= $fila['descripcion_proyecto'] ?></td>
                            <td><?= $fila['fecha_inicio_proyecto'] ?></td>
                            <td><?= $fila['fecha_termino_estimada_proyecto'] ?></td>
                            <td>
                                <a href="index.php?p=proyectos/edit&id=<?= $fila['cod_proyecto'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                                <a href="pages/proyectos/actions/delete.php?id=<?= $fila['cod_proyecto'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
