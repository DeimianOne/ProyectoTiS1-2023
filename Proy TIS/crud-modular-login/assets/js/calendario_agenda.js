var fechaSelecionada;
let frm = document.getElementById('formulario');
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: "es",
            events:'api/agenda/listar_eventos.php',
            dateClick: function(info) {
                fechaSelecionada = info.date;
                var fechaActual = new Date();

                if(fechaSelecionada < fechaActual.setDate(fechaActual.getDate() - 1)){
                    console.log("antes de mostrar la alerta");
                    Swal.fire({
                        title: "Aviso",
                        text: "No puede agendar una hora en una fecha anterior a la actual",
                        icon: "warning"
                    });
                }
                else
                {
                    $("#myModal").modal("show");
                    document.getElementById('fecha').value = info.dateStr;
                    
                }
            },
        });
        calendar.render();
    });