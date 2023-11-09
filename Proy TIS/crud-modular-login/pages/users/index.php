<?php
include("database/auth.php");
include("database/connection.php");
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
                        <input type="text" class="form-control" id="evento">
                        <label for="evento" class="form-label">Nombre del evento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="descripcion">
                        <label for="descripcion" class="form-label">descripcion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha_evento" readonly>
                        <label for="fecha_evento" class="form-label">Fecha</label>
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
            dateClick: function(info) {
                $("#myModal").modal("show");
                document.getElementById('fecha_evento').value = info.dateStr;
            }
        });
        calendar.render();
    });
</script>