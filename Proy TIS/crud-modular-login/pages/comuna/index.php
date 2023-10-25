<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    $query = "SELECT comuna.*, region.nombre_region AS nombre_region FROM comuna JOIN region ON comuna.cod_region = region.cod_region";
    $result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Comunas</h1>
    </div>
</div>

<main class="container mt-5">


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Comunas</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=comuna/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Region</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_comuna'] ?></th>
                            <td><?= $fila['nombre_comuna'] ?></td>
                            <td><?= $fila['nombre_region'] ?></td>
                            <td>
                                <a href="index.php?p=comuna/edit&cod_comuna=<?= $fila['cod_comuna'] ?>" class="btn btn-sm btn-outline-warning">Revisar</a>
                                <a href="pages/comuna/actions/delete.php?cod_comuna=<?= $fila['cod_comuna'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>