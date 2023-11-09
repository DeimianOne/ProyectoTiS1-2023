<?php
    include("database/auth.php");
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir una nueva palabra</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/palabrasofensivas/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">
                
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Palabra</label>
                        <input type="text" class="form-control" id="word" name="palabra" pattern="[A-Za-z]+" title="Ingresa solo letras del abecedario" placeholder="Palabra" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>