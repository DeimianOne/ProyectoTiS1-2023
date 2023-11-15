<?php
include("database/auth.php");
include("database/connection.php");  // Incluye la conexión

$query_departamento = "SELECT * FROM departamento";
$result_departamento = mysqli_query($connection, $query_departamento);
$query_usuario = "SELECT * FROM usuario";
$result_usuario = mysqli_query($connection, $query_usuario);
?>

<!--calendario-->
<div class="container">
    <div class="col-md-8 offset-md-2">
        <div id='calendar'></div>
    </div>
</div>

<!-- modal-->

<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="titulo">Registro de cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span hidden>&times;</span>
                </button>
            </div>
            <form id="formulario">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre">
                        <label for="nombre" class="form-label">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="rut" >
                        <label for="rut" class="form-label">RUT</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha" readonly>
                        <label for="fecha" class="form-label">Fecha</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="button" aria-label="Close" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-info" id="btnAccion" type="submit">Guardar</button>
                    
                </div>
            </form>

        </div>
    </div>
</div>


</main>
<script src="assets/js/calendario_agenda.js"></script>

