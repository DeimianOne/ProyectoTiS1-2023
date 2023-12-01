<?php
include("database/connection.php");
include("database/auth.php");

$id1 = $_GET["rut_usuario"];
$id2 = $_GET["cod_rol"];


$query = "SELECT usuario_rol.*, rol.nombre_rol AS nombre_rol FROM usuario_rol JOIN rol ON usuario_rol.cod_rol = rol.cod_rol WHERE rut_usuario=" . $id1 . " AND usuario_rol.cod_rol=".$id2;
$result = mysqli_query($connection, $query);

$queryRoles = "SELECT * FROM rol";
$resultRoles = mysqli_query($connection, $queryRoles);

if ($row = mysqli_fetch_assoc($result)) {
    $rut_usuario = $row["rut_usuario"];
    $cod_rol = $row["cod_rol"];
    $nombre_rol = $row["nombre_rol"];
} else {
    header("Location: index.php?p=roles/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/roles/actions/update_user_rol.php" method="POST">
            <div class="card-body">
                <div class="row">
                <input type="text" class="d-none" name="cod_old" value="<?php echo $cod_rol; ?>">
                    <input type="text" class="d-none" name="rut_usuario" value="<?php echo $rut_usuario; ?>">

                    <span>Rut: </span>
                    <span><?php echo $rut_usuario; ?></span>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Elegir Rol:</label>
                        <select class="form-control" id="origin" name="cod_rol">
                            <?php
                            // Iterar a través de los resultados y crear opciones para el select
                            while ($fila = $resultRoles->fetch_assoc()) {
                                $cod = $fila["cod_rol"];
                                $nombre = $fila["nombre_rol"];
                                $selected = ($cod == $cod_rol) ? 'selected' : '';
                                echo "<option value=\"$cod\" $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>