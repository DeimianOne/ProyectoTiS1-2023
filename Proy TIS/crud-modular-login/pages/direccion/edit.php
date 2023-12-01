<?php
include("database/connection.php");
include("database/auth.php");

$id = $_GET["cod_direccion"];

$query = "SELECT * FROM direccion WHERE cod_direccion=" . $id . ";";
$query_comuna = "SELECT * FROM comuna";
$result = mysqli_query($connection, $query);
$result_comuna = mysqli_query($connection, $query_comuna);

if ($row = mysqli_fetch_assoc($result)) {
    $calle = $row["calle"];
    $numero = $row["numero"];
    $numero_departamento = $row["numero_departamento"];
    $id = $row["cod_direccion"];
    $comuna_direccion = $row["cod_comuna"];
} else {
    header("Location: index.php?p=direccion/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/direccion/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_direccion" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Calle</label>
                        <input type="text" class="form-control" id="name" name="calle" placeholder="Calle"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,255}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 255 caracteres"
                            value="<?php echo $calle ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Número</label>
                        <input type="number" class="form-control" id="name" name="numero" placeholder="Número" step="1"
                            value="<?php echo $numero ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Número Piso/Oficina/Depto</label>
                        <input type="number" class="form-control" id="name" name="numero_departamento"
                            placeholder="Número Piso/Oficina/Depto" step="1" value="<?php echo $numero_departamento ?>"
                            aria-describedby="optional">
                        <div id="optional" class="form-text">Opcional*</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Comuna</label>
                        <select class="form-control" id="origin" name="cod_comuna">
                            <?php
                            // Iterar a través de los resultados y crear opciones para el select
                            while ($fila = $result_comuna->fetch_assoc()) {
                                $cod_comuna = $fila["cod_comuna"];
                                $nombre_comuna = $fila["nombre_comuna"];
                                $selected = ($cod_comuna == $comuna_direccion) ? 'selected' : '';
                                echo "<option value=\"$cod_comuna\" $selected>$nombre_comuna</option>";
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