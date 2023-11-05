<?php
    include("database/auth.php");
    include("database/connection.php");  // Incluye la conexión

    $query_departamento = "SELECT * FROM departamento";
    $result_departamento = mysqli_query($connection, $query_departamento);
    $query_usuario = "SELECT * FROM usuario";
    $result_usuario = mysqli_query($connection, $query_usuario);
?>
<div class="container">
    <div class="col-md-8 offset-md-2">
        <div id='calendar'></div>
    </div>
</div>




<!--
<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de registro</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/agenda/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Departamento</label>
                        <select class="form-control" id="origin" name="cod_departamento">
                        <?php
                        /* Iterar a través de los resultados y crear opciones para el select
                        while ($fila = $result_departamento->fetch_assoc()) {
                            $cod_departamento = $fila["cod_departamento"];
                            $nombre_departamento = $fila["nombre_departamento"];
                            echo "<option value=\"$cod_departamento\">$nombre_departamento</option>";
                        }*/
                        ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Rut usuario agendado</label>
                        <input type="text" class="form-control" id="name" name="nombre_region" placeholder="Rut" required>
                    </div>
                    
                    

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
-->
</main>