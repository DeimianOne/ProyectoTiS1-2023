<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    // Verifica el rol del usuario
    if(isset($_SESSION['rut_usuario'])) {
        if ($_SESSION['rol_usuario'] == '1') {
            $query = "SELECT * FROM registro_ticket";  // Si es admin, selecciona todos los tickets
        } else {
            header("Location: index.php?p=auth/login");
            exit;
        }
    } else {
        header("Location: index.php?p=auth/login");
        exit;
    }

    $result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Registro de tickets en el sistema</h2>
    </div>
</div>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Registro</span>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">Código Registro</th>
                        <th scope="col">Fecha de Registro</th>
                        <th scope="col">Código Ticket</th>
                        <th scope="col">RUT del Usuario</th>
                        <th scope="col">Código Departamento</th>
                        <th scope="col">Tipo de Solicitud</th>
                        <th scope="col">Asunto Ticket</th>
                        <th scope="col">Detalles de Solicitud</th>
                        <th scope="col">Fecha y Hora de Envío</th>
                        <th scope="col">Calificación</th>
                        <th scope="col">Visibilidad de Solicitud</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_registro'] ?></th>
                            <td><?= $fila['fecha_hora_registro'] ?></td>
                            <td><?= $fila['cod_ticket'] ?></td>
                            <td><?= $fila['rut_usuario'] ?></td>
                            <td><?= $fila['cod_departamento'] ?></td>
                            <td><?= $fila['tipo_solicitud'] ?></td>
                            <td><?= $fila['asunto_ticket'] ?></td>
                            <td><?= $fila['detalles_solicitud'] ?></td>
                            <td><?= $fila['fecha_hora_envio'] ?></td>
                            <td><?= $fila['calificacion'] ?></td>
                            <td><?= $fila['visibilidad_solicitud'] == 1 ? 'Visible' : 'No Visible' ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
