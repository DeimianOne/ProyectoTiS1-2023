<?php
require('database/connection.php');

// If form submitted, insert values into the database.
if (isset($_REQUEST['rut_usuario'])) {
    $rut_usuario = stripslashes($_REQUEST['rut_usuario']);
    $rut_usuario = mysqli_real_escape_string($connection, $rut_usuario);

    $rol_usuario = 2; //Por defecto, los usuarios comunes tienen el rol 2 = "usuario"

    $nombre_usuario = stripslashes($_REQUEST['nombre_usuario']);
    $nombre_usuario = mysqli_real_escape_string($connection, $nombre_usuario);

    $correo_electronico_usuario = stripslashes($_REQUEST['correo_electronico_usuario']);
    $correo_electronico_usuario = mysqli_real_escape_string($connection, $correo_electronico_usuario);

    $correo_electronico_tercero = isset($_REQUEST['correo_electronico_tercero']) ? stripslashes($_REQUEST['correo_electronico_tercero']) : "";
    $correo_electronico_tercero = mysqli_real_escape_string($connection, $correo_electronico_tercero);

    $telefono_usuario = isset($_REQUEST['telefono_usuario']) ? stripslashes($_REQUEST['telefono_usuario']) : "";
    $telefono_usuario = mysqli_real_escape_string($connection, $telefono_usuario);

    $telefono_tercero = isset($_REQUEST['telefono_tercero']) ? stripslashes($_REQUEST['telefono_tercero']) : "";
    $telefono_tercero = mysqli_real_escape_string($connection, $telefono_tercero);

    $cod_direccion = isset($_REQUEST['cod_direccion']) ? stripslashes($_REQUEST['cod_direccion']) : "";
    $cod_direccion = mysqli_real_escape_string($connection, $cod_direccion);

    $trn_date = date("Y-m-d H:i:s");
    $query = "INSERT into `usuario` (rut_usuario, rol_usuario, nombre_usuario, correo_electronico_usuario, correo_electronico_tercero, telefono_usuario, telefono_tercero, cod_direccion) VALUES ('$rut_usuario', '$rol_usuario', '$nombre_usuario', '$correo_electronico_usuario', '$correo_electronico_tercero', '$telefono_usuario', '$telefono_tercero', '$cod_direccion')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<div class='form'><h3>Te has registrado correctamente!</h3><br/>Haz click aquí para <a href='index.php'>Logearte</a></div>";
    }
} else {
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Registrate Aquí</h1>
                    </div>
                    <div class="card-body">
                        <form name="registration" action="" method="post">
                            <div class="form-group mb-3">
                                <label for="rut_usuario" class="form-label">RUT</label>
                                <input type="text" name="rut_usuario" class="form-control" id="rut_usuario" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nombre_usuario" class="form-label">Nombre</label>
                                <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario">
                            </div>
                            <div class="form-group mb-3">
                                <label for="correo_electronico_usuario" class="form-label">Correo Electrónico</label>
                                <input type="email" name="correo_electronico_usuario" class="form-control" id="correo_electronico_usuario">
                            </div>
                            <div class="form-group mb-3">
                                <label for="correo_electronico_tercero" class="form-label">Correo Electrónico Tercero</label>
                                <input type="email" name="correo_electronico_tercero" class="form-control" id="correo_electronico_tercero">
                            </div>
                            <div class="form-group mb-3">
                                <label for="telefono_usuario" class="form-label">Teléfono</label>
                                <input type="text" name="telefono_usuario" class="form-control" id="telefono_usuario">
                            </div>
                            <div class="form-group mb-3">
                                <label for="telefono_tercero" class="form-label">Teléfono Tercero</label>
                                <input type="text" name="telefono_tercero" class="form-control" id="telefono_tercero">
                            </div>
                            <div class="form-group mb-3">
                                <label for="cod_direccion" class="form-label">Código de Dirección</label>
                                <input type="text" name="cod_direccion" class="form-control" id="cod_direccion">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
