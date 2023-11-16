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
                $("#myModal").modal("show");
                document.getElementById('fecha').value = info.dateStr;
            },
        });
        calendar.render();
    });