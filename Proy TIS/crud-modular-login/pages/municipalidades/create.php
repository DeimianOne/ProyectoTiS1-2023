<?php
include("database/auth.php");
include("database/connection.php");  // Incluye la conexión

$query = "SELECT * FROM comuna";
$result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir Municipalidad</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/municipalidades/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_municipalidad" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_municipalidad" name="nombre_municipalidad"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                            required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Comuna</label>
                        <select class="form-control" id="origin" name="cod_comuna">
                            <?php
                            // Iterar a través de los resultados y crear opciones para el select
                            while ($fila = $result->fetch_assoc()) {
                                $cod_comuna = $fila["cod_comuna"];
                                $nombre_comuna = $fila["nombre_comuna"];
                                echo "<option value=\"$cod_comuna\">$nombre_comuna</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="direccion_municipalidad" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_municipalidad"
                            name="direccion_municipalidad" pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,255}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 255 caracteres"
                            required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="correo_municipalidad" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo_municipalidad" name="correo_municipalidad"
                            required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>