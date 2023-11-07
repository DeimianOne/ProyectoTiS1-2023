<?php
    include("database/auth.php");
    include("database/connection.php");  // Incluye la conexión

    // Fetching the departments for the dropdown
    $query = "SELECT * FROM ticket"; 
    $result = mysqli_query($connection, $query);

    // Fetching the ENUM values for 'tipo_solicitud'
    $enumQuery = "SHOW COLUMNS FROM ticket WHERE Field='tipo_solicitud'";
    $enumResult = mysqli_query($connection, $enumQuery);
    $row = $enumResult->fetch_assoc();
    $type = $row['Type'];
    $matches = array();
    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
    $enum_values = explode("','", $matches[1]);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Calificar sistema</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/tickets/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-control" id="departamento" name="cod_departamento">
                        <?php
                        while ($fila = $result->fetch_assoc()) {
                            $cod_departamento = $fila["cod_departamento"];
                            $nombre_departamento = $fila["nombre_departamento"];
                            echo "<option value=\"$cod_departamento\">$nombre_departamento</option>";
                        }
                        ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="tipo_solicitud" class="form-label">Tipo de Solicitud</label>
                        <select class="form-control" id="tipo_solicitud" name="tipo_solicitud">
                        <?php
                        foreach ($enum_values as $value) {
                            echo "<option value=\"$value\">$value</option>";
                        }
                        ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="asunto_ticket" class="form-label">Asunto Ticket</label>
                        <textarea class="form-control" id="asunto_ticket" name="asunto_ticket" required></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="detalles_solicitud" class="form-label">Detalles de Solicitud</label>
                        <textarea class="form-control" id="detalles_solicitud" name="detalles_solicitud" required></textarea>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>
