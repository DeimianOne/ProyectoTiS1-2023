const formulario = document.querySelector("#formulario");
    formulario.addEventListener("submit", (event) => {
        // Prevenir el comportamiento predeterminado del formulario al enviarlo
        event.preventDefault();

        // Obtener los valores del formulario
        const nombre = document.querySelector("#nombre").value;
        const rut = document.querySelector("#rut").value;
        const fecha = document.querySelector("#fecha").value;
        const hora = document.querySelector("#hora").value;

        console.log(nombre, rut, fecha, hora);
        if (nombre == '' || rut == '' || fecha == '') {
            Swal.fire({
                title: "Aviso",
                text: "Todo los campos son requeridos",
                icon: "warning"
            });

        } else {
            $.ajax({
                url: "api/agenda/agendar_hora.php",
                method: "POST",
                data: {
                    nombre: nombre,
                    rut: rut,
                    fecha: fecha,
                    hora: hora,
                },
            }).done(function(response) {
                const result = JSON.parse(response);
                console.log(result);
                   if (result.success) {
                     Swal.fire({
                       icon: "success",
                       title: "¡Éxito!",
                       text: result.message,
                       showConfirmButton: false,
                       timer: 1500,
                     }).then(() => {
                       location.reload();
                     });
                   } else {
                     Swal.fire({
                       icon: "error",
                       title: "¡Error!",
                       text: result.message,
                       showConfirmButton: false,
                       timer: 1500,
                     });
                   }
            });
        }

    });