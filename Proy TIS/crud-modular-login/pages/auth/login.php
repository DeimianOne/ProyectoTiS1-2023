<?php
require('database/connection.php');

if (isset($_REQUEST['rut_usuario']) && isset($_REQUEST['nombre_usuario'])) {
    $rut_usuario = stripslashes($_REQUEST['rut_usuario']);
    $rut_usuario = mysqli_real_escape_string($connection, $rut_usuario);

    $nombre_usuario = stripslashes($_REQUEST['nombre_usuario']);
    $nombre_usuario = mysqli_real_escape_string($connection, $nombre_usuario);

    $query = "SELECT * FROM `usuario` WHERE rut_usuario='$rut_usuario' AND nombre_usuario='$nombre_usuario' AND rol_usuario=2";
    $query_rol_usuario = "SELECT rol_usuario FROM `usuario` WHERE rut_usuario='$rut_usuario' AND nombre_usuario='$nombre_usuario'";

    $rol_usuario = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($rol_usuario);

    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        // 
        $_SESSION['rut_usuario'] = $rut_usuario;  // 
        $_SESSION['rol_usuario'] = $row['rol_usuario'];
        header("Location: index.php");   // Redirect to user dashboard or any desired page
        exit();
    } else {
        //echo '<script type="text/javascript">alert("Your alert message here.");</script>';
        header("Refresh:0");
        //echo "<div class='form'><h3>Combinación de RUT y nombre incorrectos.</h3><br/>Haz click aquí para <a href='login.php'>intentar de nuevo</a></div>";
    }
} else {
?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center">Inicia Sesión</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" name="login">
                                <div class="form-group mb-3">
                                    <label for="rut_usuario">RUT</label>
                                    <input type="text" name="rut_usuario" class="form-control" placeholder="Ingresa tu RUT" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nombre_usuario">Nombre</label>
                                    <input type="text" name="nombre_usuario" class="form-control" placeholder="Ingresa tu nombre" required />
                                </div>
                                <div class="form-group d-flex justify-content-center my-2">
                                    <button name="submit" type="submit" class="btn btn-dark btn-block">Entrar</button>
                                </div>
                            </form>
                            <p class="text-center">¿No estás registrado aún? <a href='index.php?p=auth/register'>Regístrate aquí</a></p>
                            <a class="text-center nav-link" href='index.php?p=auth/loginAdmin'>Acceso Administrador</a>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } 
?>