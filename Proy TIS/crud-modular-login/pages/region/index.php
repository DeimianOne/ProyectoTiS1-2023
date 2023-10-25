<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    $query = "SELECT * FROM region";
    $result = mysqli_query($connection2, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Regiones</h1>
    </div>
</div>

<main class="container mt-5">


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Regiones</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=region/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre de la Región</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_region'] ?></th>
                            <td><?= $fila['nombre_region'] ?></td>
                            <td>
                                <a href="index.php?p=region/edit&cod_region=<?= $fila['cod_region'] ?>" class="btn btn-sm btn-outline-warning">Revisar</a>
                                <a href="pages/region/actions/delete.php?cod_region=<?= $fila['cod_region'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>