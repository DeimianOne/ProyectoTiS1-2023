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
        <form action="pages/permiso/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre del permiso</label>
                        <input type="text" class="form-control" id="name" name="nombre_permiso" placeholder="Permiso"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,30}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 30 caracteres"
                            required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Descripción del permiso</label>
                        <textarea class="form-control" id="name" name="descripcion_permiso" placeholder="Descripción"
                            maxlength="250" required></textarea>
                        <div id="descripcion_proyecto_help" class="form-text">Máximo 250 caracteres.</div>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>