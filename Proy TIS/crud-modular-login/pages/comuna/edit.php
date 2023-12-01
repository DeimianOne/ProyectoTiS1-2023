<?php
include("database/connection.php");
include("database/auth.php");

$id = $_GET["cod_comuna"];

$query = "SELECT * FROM comuna WHERE cod_comuna=" . $id . ";";
$query_region = "SELECT * FROM region";
$result = mysqli_query($connection, $query);
$result_region = mysqli_query($connection, $query_region);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre = $row["nombre_comuna"];
    $id = $row["cod_comuna"];
    $region_comuna = $row["cod_region"];
} else {
    header("Location: index.php?p=comuna/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/comuna/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_comuna" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre de la Comuna</label>
                        <input type="text" class="form-control" id="name" name="nombre_comuna" placeholder="Comuna"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                            value="<?php echo $nombre ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Región</label>
                        <select class="form-control" id="origin" name="cod_region">
                            <?php
                            // Iterar a través de los resultados y crear opciones para el select
                            while ($fila = $result_region->fetch_assoc()) {
                                $cod_region = $fila["cod_region"];
                                $nombre_region = $fila["nombre_region"];
                                $selected = ($cod_region == $region_comuna) ? 'selected' : '';
                                echo "<option value=\"$cod_region\" $selected>$nombre_region</option>";
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