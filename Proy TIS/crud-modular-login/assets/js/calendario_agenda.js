let frm = document.getElementById('formulario');
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "es",
            dateClick: function(info) {
                $("#myModal").modal("show");
                document.getElementById('fecha').value = info.dateStr;
            }
        });
        calendar.render();
        frm.addEventListener('submit', function(e) {
            e.preventDefault();
            const nombre = document.getElementById('nombre').value;
            const rut = document.getElementById('rut').value;
            const fecha = document.getElementById('fecha').value;
            if (nombre == '' || rut == '' || fecha == '') {
                Swal.fire({
                    title: "Aviso",
                    text: "Todo los campos son requeridos",
                    icon: "warning"
                });
            } 
        })
    });