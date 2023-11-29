<?php
include("database/connection.php");
include("database/auth.php");

$cod_departamento = $_GET["id"];

$query = "SELECT * FROM departamento WHERE cod_departamento=" . $cod_departamento . ";";
$result = mysqli_query($connection, $query);

$query_muni = "SELECT * FROM municipalidad";
$result_muni = mysqli_query($connection, $query_muni);

if ($row = mysqli_fetch_assoc($result)) {
    $cod_municipalidad = $row["cod_municipalidad"];
    $nombre_departamento = $row["nombre_departamento"];
    $telefono_departamento = $row["telefono_departamento"];
    $atencion_presencial = $row["atencion_presencial"];
    $horario_atencion_inicio = $row["horario_atencion_inicio"];
    $horario_atencion_termino = $row["horario_atencion_termino"];
} else {
    header("Location: index.php?p=departamentos/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición de departamento.</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form id="formEditarDepartamento" action="pages/departamentos/actions/update.php" method="POST"
            onsubmit="return validarFormulario()">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_departamento" value="<?php echo $cod_departamento ?>">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_departamento" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_departamento" name="nombre_departamento"
                            pattern="[A-Za-z0-9\s]{1,50}"
                            title="Solo se permiten letras y números, máximo 50 caracteres"
                            value="<?php echo $nombre_departamento ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="telefono_departamento" class="form-label">Teléfono (Opcional)</label>
                        <input type="tel" class="form-control" id="telefono_departamento" name="telefono_departamento"
                            pattern="[0-9]{1,20}" title="Solo se permiten números, máximo 20 caracteres"
                            value="<?php echo $telefono_departamento ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <input type="checkbox" class="form-check-input" id="atencion_presencial"
                            name="atencion_presencial" <?php echo $atencion_presencial == 1 ? 'checked' : '' ?>>
                        <label for="atencion_presencial" class="form-check-label">¿Acepta atención presencial?</label>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="horario_atencion_inicio" class="form-label">Horario de Atención (Inicio)</label>
                        <input type="time" class="form-control" id="horario_atencion_inicio"
                            name="horario_atencion_inicio" value="<?php echo $horario_atencion_inicio ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="horario_atencion_termino" class="form-label">Horario de Atención (Término)</label>
                        <input type="time" class="form-control" id="horario_atencion_termino"
                            name="horario_atencion_termino" value="<?php echo $horario_atencion_termino ?>">
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
    function validarFormulario() {
        var nombreDepartamento = document.getElementById('nombre_departamento').value;
        var telefonoDepartamento = document.getElementById('telefono_departamento').value;

        // Validar el campo "Nombre Departamento"
        if (!/^[A-Za-z0-9\s]{1,50}$/.test(nombreDepartamento)) {
            alert("El campo 'Nombre Departamento' solo puede contener letras y números, y debe tener un tamaño máximo de 50 caracteres.");
            return false;
        }

        // Validar el campo "Teléfono Departamento"
        if (telefonoDepartamento !== "" && !/^\d{1,20}$/.test(telefonoDepartamento)) {
            alert("El campo 'Teléfono Departamento' solo debe contener números y debe tener un tamaño máximo de 20 caracteres.");
            return false;
        }

        return true; // Envía el formulario si las validaciones son exitosas
    }
</script>