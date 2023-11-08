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

    if (isset($_SESSION['mensaje'])) {
        ?>
        <div class="alert alert-<?php echo ($_SESSION['mensaje'] == 'Ticket enviado correctamente.') ? 'success' : 'danger'; ?>" role="alert"> 
            <?php echo $_SESSION['mensaje'];?>
        </div>
        <?php
        unset($_SESSION['mensaje']); // Limpiar la variable de sesión después de mostrar el mensaje
    }

?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class=" p-5 rounded text-center">
        <h2 class="fw-normal">Mis tickets en el sistema</h2>
    </div>
</div>

<main class="container mt-5">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                        <span>Hola, aquí puedes ver los tickets</span>
                </div>

                <?php if($_SESSION['rol_usuario'] == '2'): ?> <!-- Si es usuario, puede meter tickets -->
                    <div>
                        <a class="btn btn-sm btn-primary" href="index.php?p=tickets/create" role="button">Crear nuevo Ticket</a>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th scope="col">Código Ticket</th>
                        <?php if($_SESSION['rol_usuario'] == '1'): ?> <!-- Si es admin, muestra la columna -->
                            <th scope="col">RUT del Usuario</th>
                        <?php endif; ?>
                        <th scope="col">Código Departamento</th>
                        <th scope="col">Tipo de Solicitud</th>
                        <th scope="col">Asunto Ticket</th>
                        <th scope="col">Detalles de Solicitud</th>
                        <th scope="col">Fecha y Hora de Envío</th>
                        <th scope="col">Calificación</th>
                        <?php if($_SESSION['rol_usuario'] == '1'): ?> <!-- Si es admin, muestra la columna -->
                            <th scope="col">Visibilidad de Solicitud</th>
                        <?php endif; ?>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <th scope="row"><?= $fila['cod_ticket'] ?></th>
                            <?php if($_SESSION['rol_usuario'] == '1'): ?> <!-- Si es admin, muestra el RUT del usuario -->
                            <td><?= $fila['rut_usuario'] ?></td>
                            <?php endif; ?>
                            <td><?= $fila['cod_departamento'] ?></td>
                            <td><?= $fila['tipo_solicitud'] ?></td>
                            <td><?= $fila['asunto_ticket'] ?></td>
                            <td><?= $fila['detalles_solicitud'] ?></td>
                            <td><?= $fila['fecha_hora_envio'] ?></td>
                            <td><?= $fila['calificacion'] ?></td>
                            <?php if($_SESSION['rol_usuario'] == '1'): ?> <!-- Si es admin, muestra el RUT del usuario -->
                            <td><?= $fila['visibilidad_solicitud'] == 1 ? 'Visible' : 'No Visible' ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
