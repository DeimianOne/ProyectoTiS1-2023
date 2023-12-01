<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Departamento</title>
</head>

<body>

    <?php
    include("database/auth.php");
    include("database/connection.php");  // Incluye la conexión
    
    $query = "SELECT * FROM municipalidad";
    $result = mysqli_query($connection, $query);

    // Cierra la conexión a la base de datos después de utilizarla
    mysqli_close($connection);
    ?>

    <div class="container-fluid border-bottom border-top bg-body-tertiary">
        <div class="p-5 rounded text-center">
            <h2 class="fw-normal">Añadir Departamento</h2>
        </div>
    </div>

    <main class="container mt-5">
        <div class="card">
            <form id="formDepartamento" action="pages/departamentos/actions/store.php" method="POST"
                onsubmit="return validarFormulario()">
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
                            <input type="text" class="form-control" id="nombre_departamento" name="nombre_departamento"
                                pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                                title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                                required>
                        </div>


                        <div class="col-md-12 mb-3">
                            <label for="telefono_departamento" class="form-label">Teléfono Departamento</label>
                            <input type="tel" class="form-control" id="telefono_departamento"
                                name="telefono_departamento" pattern="[0-9]{6,15}"
                                title="Ingrese solo números, entre 6 y 15 dígitos" required>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="atencion_presencial"
                                    name="atencion_presencial">
                                <label class="form-check-label" for="atencion_presencial">
                                    Atención Presencial
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="horario_atencion_inicio" class="form-label">Horario de Atención (Inicio)</label>
                            <input type="time" class="form-control" id="horario_atencion_inicio"
                                name="horario_atencion_inicio">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="horario_atencion_termino" class="form-label">Horario de Atención
                                (Término)</label>
                            <input type="time" class="form-control" id="horario_atencion_termino"
                                name="horario_atencion_termino">
                        </div>
                    </div>
                </div>

                <div class="card-footer text-body-secondary text-end">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>