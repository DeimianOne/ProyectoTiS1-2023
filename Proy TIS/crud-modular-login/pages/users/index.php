<?php
include("database/auth.php");
include("database/connection.php");

$query_proyecto = "SELECT * FROM proyecto";
$result_proyecto = mysqli_query($connection, $query_proyecto);

?>

<main class="container mt-5">
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <div id='calendar'></div>
        </div>
    </div>

    <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="titulo">Registro de eventos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span hidden>&times;</span>
                </button>
            </div>
            <form id="formulario">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="hidden" class="form-control" id="cod_proyecto" readonly>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="evento">
                        <label for="evento" class="form-label">Nombre del evento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="descripcion">
                        <label for="descripcion" class="form-label">descripcion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha_inicio" readonly>
                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                    </div>
                    <div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha_termino" readonly>
                        <label for="fecha_termino" class="form-label">Fecha de termino</label>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </form>

        </div>
    </div>
</div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "es",
            events:'api/agenda/listar_proyectos.php',
            eventClick: function(info) {
                console.log(info.event.description);    
                document.getElementById('cod_proyecto').value = info.event.id;
                document.getElementById('evento').value = info.event.title;
                document.getElementById('descripcion').value = info.event.extendedProps.description;
                document.getElementById('fecha_inicio').value = info.event.startStr;
                document.getElementById('fecha_termino').value = info.event.endStr;
                $("#myModal").modal("show");
            },
        });
        calendar.render();
    });
</script>