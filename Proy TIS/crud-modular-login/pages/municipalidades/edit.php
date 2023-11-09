<?php
    include("database/connection.php");
    include("database/auth.php");

    $id = $_GET["cod_municipalidad"];

    $query = "SELECT * FROM municipalidad WHERE cod_municipalidad=" . $id . ";";
    $query_comuna = "SELECT * FROM comuna";
    $result =  mysqli_query($connection, $query);
    $result_comuna =  mysqli_query($connection, $query_comuna);

    $queryComuna = "SELECT * FROM comuna";
    $resultComuna = mysqli_query($connection, $queryComuna);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_municipalidad = $row["nombre_municipalidad"];
        $municipalidad_comuna = $row["cod_comuna"];
        $direccion_municipalidad = $row["direccion_municipalidad"];
        $correo_municipalidad = $row["correo_municipalidad"];
    } else {
        header("Location: index.php?p=municipalidades/index");
    }
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Edición de Municipalidad</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/municipalidades/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_municipalidad" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_municipalidad" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_municipalidad" name="nombre_municipalidad" value="<?php echo $nombre_municipalidad ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Comuna</label>
                        <select class="form-control" id="origin" name="cod_comuna">
                        <?php
                        // Iterar a través de los resultados y crear opciones para el select
                        while ($fila = $result_comuna->fetch_assoc()) {
                            $cod_comuna = $fila["cod_comuna"];
                            $nombre_comuna = $fila["nombre_comuna"];
                            $selected = ($cod_comuna == $municipalidad_comuna) ? 'selected' : '';
                            echo "<option value=\"$cod_comuna\" $selected>$nombre_comuna</option>";
                        }
                        ?>
                        </select>
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
