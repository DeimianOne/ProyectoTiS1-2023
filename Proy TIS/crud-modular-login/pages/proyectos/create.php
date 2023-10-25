<?php
    include("database/auth.php");
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir Proyecto</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/proyectos/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="cod_proyecto" class="form-label">Código Proyecto</label>
                        <input type="text" class="form-control" id="cod_proyecto" name="cod_proyecto" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="cod_departamento" class="form-label">Código Departamento</label>
                        <input type="text" class="form-control" id="cod_departamento" name="cod_departamento" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="nombre_proyecto" class="form-label">Nombre Proyecto</label>
                        <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="descripcion_proyecto" class="form-label">Descripción Proyecto</label>
                        <textarea class="form-control" id="descripcion_proyecto" name="descripcion_proyecto" rows="4" required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio_proyecto" class="form-label">Fecha Inicio Proyecto</label>
                        <input type="date" class="form-control" id="fecha_inicio_proyecto" name="fecha_inicio_proyecto" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_termino_estimada_proyecto" class="form-label">Fecha Término Estimado Proyecto</label>
                        <input type="date" class="form-control" id="fecha_termino_estimada_proyecto" name="fecha_termino_estimada_proyecto" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>
