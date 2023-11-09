<?php
    include("database/connection.php");
    include("database/auth.php");

    $query = "SELECT * FROM permiso";
    $result =  mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir un nuevo rol</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/roles/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    
                
                    <div class="col-md-12 mb-3">
                        <label for="cod" class="form-label">Codigo del rol</label>
                        <input type="number" class="form-control" id="cod" name="cod_rol" placeholder="Codigo rol" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre del rol</label>
                        <input type="text" class="form-control" id="name" name="nombre_rol" placeholder="Rol" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>