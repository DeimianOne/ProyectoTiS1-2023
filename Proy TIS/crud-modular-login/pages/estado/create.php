<?php
    include("database/auth.php");
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de registro</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/estado/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">
                
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="name" name="nombre_estado" pattern="[A-Za-z ]+" title="Ocupa solo espacios y letras del abecedario" placeholder="Estado" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="name" name="descripcion_estado" placeholder="Descripción" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>