<?php
include("database/connection.php");
include("database/auth.php");

$id = $_GET["cod_rol"];

$query = "SELECT * FROM rol WHERE cod_rol=" . $id . ";";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre_rol = $row["nombre_rol"];
    $cod_rol = $row["cod_rol"];
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
        <form action="pages/roles/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_rol" value="<?php echo $cod_rol; ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre del rol</label>
                        <input type="text" class="form-control" id="name" name="nombre_rol" placeholder="Rol"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                            value="<?php echo $nombre_rol; ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="permisos" class="form-label">Permisos</label>
                        <div class="ml-3">
                            <?php
                            // Obtener los permisos asignados al rol
                            $query_permisos_asignados = "SELECT cod_permiso FROM rol_permiso WHERE cod_rol = $cod_rol";
                            $result_permisos_asignados = mysqli_query($connection, $query_permisos_asignados);
                            $permisos_asignados = array();

                            if ($result_permisos_asignados) {
                                while ($row_permisos_asignados = mysqli_fetch_assoc($result_permisos_asignados)) {
                                    $permisos_asignados[] = $row_permisos_asignados['cod_permiso'];
                                }
                            }

                            // Obtener la lista de todos los permisos disponibles
                            $query_permisos_disponibles = "SELECT * FROM permiso";
                            $result_permisos_disponibles = mysqli_query($connection, $query_permisos_disponibles);

                            if ($result_permisos_disponibles) {
                                while ($row_permisos = mysqli_fetch_assoc($result_permisos_disponibles)) {
                                    $id_permiso = $row_permisos["cod_permiso"];
                                    $nombre_permiso = $row_permisos['nombre_permiso'];
                                    $checked = in_array($id_permiso, $permisos_asignados) ? 'checked' : '';

                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input" type="checkbox" name="permisos[]" value="' . $id_permiso . '" id="flexCheck' . $id_permiso . '" ' . $checked . '>';
                                    echo '<label class="form-check-label" for="flexCheck' . $id_permiso . '">';
                                    echo $nombre_permiso;
                                    echo '</label>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>