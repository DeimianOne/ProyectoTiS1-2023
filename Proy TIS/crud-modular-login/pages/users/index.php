<?php
    include("database/auth.php");
    include("database/connection.php");

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);

?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Gestión de usuarios</h1>
    </div>
</div>



<main class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">

                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=users/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $user['id'] ?></th>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a href="index.php?p=users/edit&id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                                <a href="pages/users/actions/delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>