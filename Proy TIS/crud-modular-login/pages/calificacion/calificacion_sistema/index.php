<?php
    include("database/connection.php");  // Incluye la conexión
    include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

    // Verifica el rol del usuario
    if(isset($_SESSION['rut_usuario'])) {
        if ($_SESSION['rol_usuario'] == '1') {
            $query = "SELECT * FROM ticket";  // Si es admin, selecciona todos los tickets
        } elseif ($_SESSION['rol_usuario'] == '2') {
            $query = "SELECT * FROM ticket WHERE rut_usuario = '" . $_SESSION['rut_usuario'] . "'";  // Selecciona sólo los tickets del rut de sesión
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
        <h2 class="fw-normal">Mis calificaciones pendientes</h2>
    </div>
</div>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Hola, aquí puedes calificar la utilizabilidad del sistema</span>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">Tipo de Solicitud</th>
                        <th scope="col">Código Ticket</th>
                        <th scope="col">Asunto Ticket</th>
                        <th scope="col">Fecha y Hora de Envío</th>
                        <th scope="col">Departamento asociado</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><?= $fila['tipo_solicitud'] ?></td>
                            <td><?= $fila['cod_ticket'] ?></td>
                            <td><?= $fila['asunto_ticket'] ?></td>
                            <td><?= $fila['fecha_hora_envio'] ?></td>
                            <td><?= $fila['cod_departamento'] ?></td> <!-- Probablemente deberiamos poner el nombre del depa... -->
                            <td><?= $fila['estado_ticket'] ?></td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                    <a href="index.php?p=calificacion/calificacion_sistema/rate&cod_ticket=<?= $fila['cod_ticket'] ?>" class="btn btn-sm btn-outline-warning my-1">Calificar sistema</a>
                                    <a href="index.php?p=calificacion/calificacion_atencion/rate&cod_ticket=<?= $fila['cod_ticket'] ?>" class="btn btn-sm btn-outline-warning disabled">Calificar atención</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
