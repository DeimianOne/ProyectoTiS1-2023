<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == '1') {
        
        $query = "SELECT * FROM palabra_ofensiva";
        $result = mysqli_query($connection, $query);

    } else {
        header("Location: index.php?p=auth/login");
    }
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Palabras ofensivas</h1>
    </div>
</div>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Agregar palabras ofensivas</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=palabrasofensivas/create" role="button">Agregar nueva palabra ofensiva</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">Codigo palabra</th>
                        <th scope="col">Palabra</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_palabra'] ?></th>
                            <td><?= $fila['palabra'] ?></td>
                            <td>
                                <a href="index.php?p=palabrasofensivas/edit&cod_palabra=<?= $fila['cod_palabra'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                                <a href="pages/palabrasofensivas/actions/delete.php?cod_palabra=<?= $fila['cod_palabra'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>