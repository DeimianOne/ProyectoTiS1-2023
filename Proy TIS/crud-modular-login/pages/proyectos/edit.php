<?php
include("database/connection.php");
include("database/auth.php");

$cod_proyecto = $_GET["id"];

$query = "SELECT * FROM proyecto WHERE cod_proyecto=" . $cod_proyecto . ";";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $codigo_departamento = $row["cod_departamento"];
    $nombre_proyecto = $row["nombre_proyecto"];
    $descripcion_proyecto = $row["descripcion_proyecto"];
    $fecha_inicio_proyecto = $row["fecha_inicio_proyecto"];
    $fecha_termino_estimada_proyecto = $row["fecha_termino_estimada_proyecto"];
} else {
    header("Location: index.php?p=proyectos/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición de Proyecto</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/proyectos/actions/update.php" method="POST" onsubmit="return validarFechas()">
            <div class="card-body">
                <div class="row">

                    <input type="text" class="d-none" name="cod_proyecto" value="<?php echo $cod_proyecto ?>">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_proyecto" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                            value="<?php echo $nombre_proyecto ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="descripcion_proyecto" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_proyecto" name="descripcion_proyecto" rows="4"
                            maxlength="500" required
                            pattern="[a-zA-Z0-9\s]*"><?php echo $descripcion_proyecto ?></textarea>
                        <div id="descripcion_proyecto_help" class="form-text">Máximo 500 caracteres. Solo letras y
                            números permitidos.</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="fecha_inicio_proyecto" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio_proyecto" name="fecha_inicio_proyecto"
                            value="<?php echo $fecha_inicio_proyecto ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="fecha_termino_estimada_proyecto" class="form-label">Fecha de Término
                            Estimada</label>
                        <input type="date" class="form-control" id="fecha_termino_estimada_proyecto"
                            name="fecha_termino_estimada_proyecto"
                            value="<?php echo $fecha_termino_estimada_proyecto ?>">
                    </div>
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>

<script>
    function validarFechas() {
        var fechaInicio = new Date(document.getElementById('fecha_inicio_proyecto').value);
        var fechaTerminoEstimada = new Date(document.getElementById('fecha_termino_estimada_proyecto').value);

        if (fechaInicio == 'Invalid Date') {
            alert('Por favor, especifica la fecha de inicio antes de la fecha de término estimada.');
            return false;
        }

        if (fechaTerminoEstimada < fechaInicio) {
            alert('La fecha de término estimada no puede ser menor que la fecha de inicio.');
            return false;
        }

        return true;
    }
</script>