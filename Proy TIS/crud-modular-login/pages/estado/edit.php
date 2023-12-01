<?php
include("database/connection.php");
include("database/auth.php");

$id = $_GET["cod_estado"];

$query = "SELECT * FROM estado WHERE cod_estado=" . $id . ";";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre = $row["nombre_estado"];
    $desc = $row["descripcion_estado"];
    $id = $row["cod_estado"];
} else {
    header("Location: index.php?p=estado/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/estado/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_estado" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="name" name="nombre_estado"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números, máximo 50 caracteres"
                            placeholder="Estado" value="<?php echo $nombre ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="name" name="descripcion_estado" maxlength="250"
                            placeholder="Descripción" value="<?php echo $desc ?>" required>
                        <div id="descripcion_proyecto_help" class="form-text">Máximo 250 caracteres.</div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>