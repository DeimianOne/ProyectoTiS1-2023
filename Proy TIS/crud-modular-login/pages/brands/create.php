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
        <form action="pages/brands/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">
                
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="nombre" placeholder="Japón" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Origen</label>
                        <select class="form-control" id="origin" name="origen">
                            <option value="Japón">Japón</option>
                            <option value="China">China</option>
                            <option value="Francia">Francia</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="text" class="form-control" id="logo" name="logo" placeholder="logo.png">
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>