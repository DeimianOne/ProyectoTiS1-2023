<?php
include("database/connection.php");
include("database/auth.php");

$id = $_GET["cod_region"];

$query = "SELECT * FROM region WHERE cod_region=" . $id . ";";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre = $row["nombre_region"];
    $id = $row["cod_region"];
} else {
    header("Location: index.php?p=region/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/region/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_region" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre de la Región</label>
                        <input type="text" class="form-control" id="name" name="nombre_region" placeholder="Región"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                            value="<?php echo $nombre ?>" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>