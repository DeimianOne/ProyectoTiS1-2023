<?php
    include("database/connection.php");
    include("database/auth.php");

    $cod_municipalidad = $_GET["id"];

    $query = "SELECT * FROM municipalidad WHERE cod_municipalidad=" . $cod_municipalidad . ";";
    $result = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_municipalidad = $row["nombre_municipalidad"];
        $cod_comuna = $row["cod_comuna"];
        $direccion_municipalidad = $row["direccion_municipalidad"];
        $correo_municipalidad = $row["correo_municipalidad"];
    } else {
        header("Location: index.php?p=municipalidades/index");
    }
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición de Municipalidad</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/municipalidades/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_municipalidad" value="<?php echo $cod_municipalidad ?>">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_municipalidad" class="form-label">Nombre de la Municipalidad</label>
                        <input type="text" class="form-control" id="nombre_municipalidad" name="nombre_municipalidad" value="<?php echo $nombre_municipalidad ?>" required>
                    </div>

                    <!-- Supongo que el código de comuna es un número, de lo contrario, ajusta el input correspondiente -->
                    <div class="col-md-12 mb-3">
                        <label for="cod_comuna" class="form-label">Código de Comuna</label>
                        <input type="number" class="form-control" id="cod_comuna" name="cod_comuna" value="<?php echo $cod_comuna ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="direccion_municipalidad" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_municipalidad" name="direccion_municipalidad" value="<?php echo $direccion_municipalidad ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="correo_municipalidad" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo_municipalidad" name="correo_municipalidad" value="<?php echo $correo_municipalidad ?>">
                    </div>
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>
