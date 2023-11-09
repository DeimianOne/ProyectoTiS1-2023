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

<main class="container mt-5">


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Direcciones</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=direccion/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
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
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_direccion'] ?></th>
                            <td><?= $fila['calle'] ?></td>
                            <td><?= $fila['numero'] ?></td>
                            <td><?= $fila['numero_departamento'] ?></td>
                            <td><?= $fila['nombre_comuna'] ?></td>
                            <td>
                                <a href="index.php?p=direccion/edit&cod_direccion=<?= $fila['cod_direccion'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                                <a href="pages/direccion/actions/delete.php?cod_direccion=<?= $fila['cod_direccion'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>