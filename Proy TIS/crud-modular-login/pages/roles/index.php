<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == '1') {
        
        $query = "SELECT * FROM rol";
        $result = mysqli_query($connection, $query);

    } else {
        header("Location: index.php?p=auth/login");
    }

?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Roles</h1>
    </div>
</div>

<main class="container mt-5">


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Roles</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=roles/create" role="button">Agregar nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">Codigo rol</th>
                        <th scope="col">Nombre del rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_rol'] ?></th>
                            <td><?= $fila['nombre_rol'] ?></td>
                            <td>
                                <a href="index.php?p=roles/edit&cod_rol=<?= $fila['cod_rol'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                                <a href="pages/roles/actions/delete.php?cod_rol=<?= $fila['cod_rol'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>