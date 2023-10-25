<?php
    include("database/auth.php");
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir Municipalidad</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/municipalidades/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">
                
                    <div class="col-md-12 mb-3">
                        <label for="cod_municipalidad" class="form-label">Código Municipalidad</label>
                        <input type="text" class="form-control" id="cod_municipalidad" name="cod_municipalidad" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="nombre_municipalidad" class="form-label">Nombre Municipalidad</label>
                        <input type="text" class="form-control" id="nombre_municipalidad" name="nombre_municipalidad" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="cod_comuna" class="form-label">Código Comuna</label>
                        <input type="text" class="form-control" id="cod_comuna" name="cod_comuna" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="direccion_municipalidad" class="form-label">Dirección Municipalidad</label>
                        <input type="text" class="form-control" id="direccion_municipalidad" name="direccion_municipalidad" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="correo_municipalidad" class="form-label">Correo Municipalidad</label>
                        <input type="email" class="form-control" id="correo_municipalidad" name="correo_municipalidad" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>
