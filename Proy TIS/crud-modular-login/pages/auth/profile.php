<?php
    include("database/auth.php");
?>

<div class="container mt-5">
    <h1>Bienvenido a tu perfil, <?php echo $_SESSION['rut_usuario']; ?>!</h1>
    <p>Aquí puedes editar tus datos.</p>
</div>

<div class="row mx-2 my-2 px-2">
    <div class="col-6">
        <div class="container mt-3">
            <h2>Esto probablemente debería ir en algún botón en vez de suelto aqui en el perfil</h2>

            <?php while ($fila = mysqli_fetch_array($result)) : ?>
            <form action="pages/auth/actions/update.php" method="post">
                <div class="form-group">
                    <label for="nombre_usuario">Nombre:</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?= $fila['nombre_usuario'] ?>">
                </div>
                <div class="form-group">
                    <label for="correo_electronico">Correo Electronico:</label>
                    <input type="email" class="form-control" id="correo_electronico" name="correo_electronico_usuario" value="<?= $fila['correo_electronico_usuario'] ?>">
                </div>
                <div class="form-group">
                    <label for="correo_electronico_tercero">Correo Electronico Tercero:</label>
                    <input type="email" class="form-control" id="correo_electronico_tercero" name="correo_electronico_tercero" value="<?= $fila['correo_electronico_tercero'] ?>">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono:</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono_usuario" value="<?= $fila['telefono_usuario'] ?>">
                </div>
                <div class="form-group">
                    <label for="telefono_tercero">Telefono Tercero:</label>
                    <input type="tel" class="form-control" id="telefono_tercero" name="telefono_tercero" value="<?= $fila['telefono_tercero'] ?>">
                </div>
            

                <!-- Assuming there's an ID field to identify the user -->
                <input type="hidden" name="rut_usuario" value="<?= $fila['rut_usuario'] ?>">

                <button type="submit" class="btn btn-primary">Actualizar Datos Perfil</button>
            </form>
            <?php endwhile; ?>
        </div>
    </div>
</div>

