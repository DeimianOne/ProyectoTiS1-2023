<?php
    include("database/auth.php");
    include("database/connection.php");  // Incluye la conexión

    $query = "SELECT * FROM comuna";
    $result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de registro</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/direccion/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">
                
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Calle</label>
                        <input type="text" class="form-control" id="name" name="calle" placeholder="Calle" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Número</label>
                        <input type="number" class="form-control" id="name" name="numero" placeholder="Número" step="1" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Número Piso/Oficina/Depto</label>
                        <input type="number" class="form-control" id="name" name="numero_departamento" placeholder="Número Piso/Oficina/Depto" step="1" aria-describedby="optional">
                        <div id="optional" class="form-text">Opcional*</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Comuna</label>
                        <select class="form-control" id="origin" name="cod_comuna">
                        <?php
                        // Iterar a través de los resultados y crear opciones para el select
                        while ($fila = $result->fetch_assoc()) {
                            $cod_comuna = $fila["cod_comuna"];
                            $nombre_comuna = $fila["nombre_comuna"];
                            echo "<option value=\"$cod_comuna\">$nombre_comuna</option>";
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