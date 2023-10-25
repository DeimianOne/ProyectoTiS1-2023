<?php
    include("database/connection.php");
    include("database/auth.php");

    $cod_departamento = $_GET["id"];

    $query = "SELECT * FROM departamento WHERE cod_departamento=" . $cod_departamento . ";";
    $result = mysqli_query($connection, $query);

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
        <h2 class="fw-normal">Formulario de edición de Departamento</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/departamentos/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_departamento" value="<?php echo $cod_departamento ?>">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_departamento" class="form-label">Nombre del Departamento</label>
                        <input type="text" class="form-control" id="nombre_departamento" name="nombre_departamento" value="<?php echo $nombre_departamento ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="telefono_departamento" class="form-label">Teléfono del Departamento</label>
                        <input type="tel" class="form-control" id="telefono_departamento" name="telefono_departamento" value="<?php echo $telefono_departamento ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <input type="checkbox" class="form-check-input" id="atencion_presencial" name="atencion_presencial" <?php echo $atencion_presencial == 1 ? 'checked' : '' ?>>
                        <label for="atencion_presencial" class="form-check-label">¿Acepta atención presencial?</label>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="horario_atencion_inicio" class="form-label">Horario de Atención (Inicio)</label>
                        <input type="time" class="form-control" id="horario_atencion_inicio" name="horario_atencion_inicio" value="<?php echo $horario_atencion_inicio ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="horario_atencion_termino" class="form-label">Horario de Atención (Término)</label>
                        <input type="time" class="form-control" id="horario_atencion_termino" name="horario_atencion_termino" value="<?php echo $horario_atencion_termino ?>" required>
                    </div>

                    
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>
