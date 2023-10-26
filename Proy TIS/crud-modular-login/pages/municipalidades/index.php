<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == '1') {
        
        $query = "SELECT municipalidad.*, comuna.nombre_comuna AS nombre_comuna, region.nombre_region AS nombre_region FROM municipalidad JOIN comuna ON municipalidad.cod_comuna = comuna.cod_comuna JOIN region ON comuna.cod_region = region.cod_region";
        $result = mysqli_query($connection, $query);

    } else {
        header("Location: index.php?p=auth/login");
    }

?>


<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Municipalidades en el sistema</h1>
    </div>
</div>

<main class="container mt-5">


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Hola, aquí puedes agregar municipalidades si eres admin</span>
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="index.php?p=municipalidades/create" role="button">Agregar nueva Municipalidad</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">Código Municipalidad</th>
                        <th scope="col">Nombre Municipalidad</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Región</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Sitio Web</th>
                        <th scope="col">Escudo</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_municipalidad'] ?></th>
                            <td><?= $fila['nombre_municipalidad'] ?></td>
                            <td><?= $fila['nombre_comuna'] ?></td>
                            <td><?= $fila['direccion_municipalidad'] ?></td>
                            <td><?= $fila['correo_municipalidad'] ?></td>
                            <td><?= $fila['nombre_region'] ?></td>
                            <td>
                                <a href="index.php?p=municipalidades/edit&cod_municipalidad=<?= $fila['cod_municipalidad'] ?>" class="btn btn-sm btn-outline-warning">Revisar</a>
                                <a href="pages/municipalidades/actions/delete.php?id=<?= $fila['cod_municipalidad'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>