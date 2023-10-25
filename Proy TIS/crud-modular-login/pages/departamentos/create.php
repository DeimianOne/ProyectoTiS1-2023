<?php
    include("database/auth.php");
    include("database/connection.php");  // Incluye la conexión

    $query = "SELECT * FROM municipalidad";
    $result = mysqli_query($connection, $query);
?>
<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir Departamento</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/departamentos/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">
                
                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Municipalidad</label>
                        <select class="form-control" id="origin" name="cod_municipalidad">
                        <?php
                        // Iterar a través de los resultados y crear opciones para el select
                        while ($fila = $result->fetch_assoc()) {
                            $cod_municipalidad = $fila["cod_municipalidad"];
                            $nombre_municipalidad = $fila["nombre_municipalidad"];
                            echo "<option value=\"$cod_municipalidad\">$nombre_municipalidad</option>";
                        }
                        ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="nombre_departamento" class="form-label">Nombre Departamento</label>
                        <input type="text" class="form-control" id="nombre_departamento" name="nombre_departamento" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="telefono_departamento" class="form-label">Teléfono Departamento</label>
                        <input type="tel" class="form-control" id="telefono_departamento" name="telefono_departamento" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="atencion_presencial" name="atencion_presencial">
                            <label class="form-check-label" for="atencion_presencial">
                                Atención Presencial
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="horario_atencion_inicio" class="form-label">Horario de Atención (Inicio)</label>
                        <input type="time" class="form-control" id="horario_atencion_inicio" name="horario_atencion_inicio" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="horario_atencion_termino" class="form-label">Horario de Atención (Término)</label>
                        <input type="time" class="form-control" id="horario_atencion_termino" name="horario_atencion_termino" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>
