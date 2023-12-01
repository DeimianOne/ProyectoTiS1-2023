<?php
include("database/auth.php");
$query = "SELECT * FROM departamento";
$result = mysqli_query($connection, $query);
?>

<script>
    function validarFechas() {
        // Obtener las fechas del formulario
        var fechaInicio = new Date(document.getElementById('fecha_inicio_proyecto').value);
        var fechaTerminoEstimada = new Date(document.getElementById('fecha_termino_estimada_proyecto').value);

        // Verificar si la fecha de inicio está especificada
        if (fechaInicio == 'Invalid Date') {
            alert('Por favor, especifica la fecha de inicio antes de la fecha de término estimada.');
            return false;
        }

        // Verificar si la fecha de término estimada es menor que la fecha de inicio
        if (fechaTerminoEstimada < fechaInicio) {
            alert('La fecha de término estimada no puede ser menor que la fecha de inicio.');
            return false;
        }

        // Si todo está bien, permitir enviar el formulario
        return true;
    }
</script>


<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir Proyecto</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/proyectos/actions/store.php" method="POST" onsubmit="return validarFechas()">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_proyecto" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                            required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Departamento</label>
                        <select class="form-control" id="origin" name="cod_departamento">
                            <?php
                            // Iterar a través de los resultados y crear opciones para el select
                            while ($fila = $result->fetch_assoc()) {
                                $cod_departamento = $fila["cod_departamento"];
                                $nombre_departamento = $fila["nombre_departamento"];
                                echo "<option value=\"$cod_departamento\">$nombre_departamento</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="descripcion_proyecto" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_proyecto" name="descripcion_proyecto" rows="4"
                            maxlength="500" required></textarea>
                        <div id="descripcion_proyecto_help" class="form-text">Máximo 500 caracteres.</div>
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio_proyecto" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio_proyecto" name="fecha_inicio_proyecto"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_termino_estimada_proyecto" class="form-label">Fecha Término Estimada</label>
                        <input type="date" class="form-control" id="fecha_termino_estimada_proyecto"
                            name="fecha_termino_estimada_proyecto" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>