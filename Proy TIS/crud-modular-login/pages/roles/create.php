<?php
include("database/connection.php");
include("database/auth.php");

$query = "SELECT * FROM permiso";
$result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir un nuevo rol</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/roles/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre del rol</label>
                        <input type="text" class="form-control" id="name" name="nombre_rol" placeholder="Rol" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="permisos" class="form-label">Permisos</label>
                        <div class="ml-3">
                            <?php
                            // Comprobar si la consulta se ejecutó con éxito
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row["cod_permiso"];
                                    $nombre = $row['nombre_permiso'];

                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input" type="checkbox" name="permisos[]" value="' . $id . '" id="flexCheck' . $id . '">';
                                    echo '<label class="form-check-label" for="flexCheck' . $id . '">';
                                    echo $nombre;
                                    echo '</label>';
                                    echo '</div>';

                                    echo '<input type="hidden" name="cod_permiso" value="' . $id . '">';
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