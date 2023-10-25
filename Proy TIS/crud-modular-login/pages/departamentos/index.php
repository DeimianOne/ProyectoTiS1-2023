<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == '1') {
        
        $query = "SELECT * FROM departamento";
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

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Hola, aquí puedes agregar departamentos si eres admin</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=departamentos/create" role="button">Agregar nuevo Departamento</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código Departamento</th>
                        <th scope="col">Código Municipalidad</th>
                        <th scope="col">Nombre Departamento</th>
                        <th scope="col">Telefono Departamento</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_departamento'] ?></th>
                            <td><?= $fila['cod_municipalidad'] ?></td>
                            <td><?= $fila['nombre_departamento'] ?></td>
                            <td><?= $fila['telefono_departamento'] ?></td>
                            <td>
                                <a href="index.php?p=departamentos/edit&id=<?= $fila['cod_departamento'] ?>" class="btn btn-sm btn-outline-warning">Editar Datos Departamento</a>
                                <a href="pages/departamentos/actions/delete.php?id=<?= $fila['cod_departamento'] ?>" class="btn btn-sm btn-outline-danger">Eliminar Departamento</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
