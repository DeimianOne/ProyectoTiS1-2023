<?php
include("database/connection.php");  // Incluye la conexión
include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

$rut = isset($_SESSION["rut_usuario"]) ? $_SESSION["rut_usuario"] : null;

// Verifica si hay una sesión activa
if ($rut) {
    $query = "SELECT * FROM usuario WHERE rut_usuario = '$rut'";
    $result = mysqli_query($connection, $query);
    $nombre_usuario = mysqli_fetch_assoc($result)["nombre_usuario"] ?? null;
} else {
    // Si no hay sesión, establece el nombre de usuario como nulo
    $nombre_usuario = null;
}

$query_tickets = "SELECT * FROM ticket";
$result_tickets = mysqli_query($connection, $query_tickets);

?>


<script>
    function buscarTicketSinSesion() {
        var numeroIngreso = document.getElementById("numeroIngreso").value;


        // Verifica si el valor ingresado está en la columna "cod_ticket" de $result_tickets
        var ticketEncontrado = false;
        <?php
        while ($row = mysqli_fetch_assoc($result_tickets)) {
            echo "if ('" . $row['cod_ticket'] . "' === numeroIngreso) { if(" . $row['visibilidad_solicitud'] . ") { ticketEncontrado = true; } }";
        }
        $result_tickets = mysqli_query($connection, $query_tickets);
        ?>

        // Realiza la consulta solo si el ticket se encuentra en $result_tickets
        if (ticketEncontrado) {
            // Redirigir a index.php con el código del ticket como parámetro
            window.location.href = 'index.php?p=tickets/view&cod_ticket=' + numeroIngreso;
        } else {
            // Manejo del error cuando el ticket no se encuentra
            alert("El número de ingreso no corresponde a un ticket válido.");
        }
    }
</script>
<script>
    function buscarTicketConSesion() {
        var numeroIngreso = document.getElementById("numeroIngreso").value;

        // Verifica si el valor ingresado está en la columna "cod_ticket" de $result_tickets
        var ticketEncontrado = false;
        <?php
        while ($row = mysqli_fetch_assoc($result_tickets)) {
            echo "if ('" . $row['cod_ticket'] . "' === numeroIngreso) { if(" . $row['visibilidad_solicitud'] . " || " . $row['rut_usuario'] . " === " . $_SESSION["rut_usuario"] . " || " . $_SESSION["rol_usuario"] . " === 1) { ticketEncontrado = true; } }";
        }
        $result_tickets = mysqli_query($connection, $query_tickets);
        ?>

        // Realiza la consulta solo si el ticket se encuentra en $result_tickets
        if (ticketEncontrado) {
            // Redirigir a index.php con el código del ticket como parámetro
            window.location.href = 'index.php?p=tickets/view&cod_ticket=' + numeroIngreso;
        } else {
            // Manejo del error cuando el ticket no se encuentra
            alert("El número de ingreso no corresponde a un ticket válido.");
        }
    }
</script>

<div class="container-fluid my-3">
    <div class="row d-flex justify-content-end align-items-center">
        <div class="col-auto">
            <span class="text-body-secondary">Seguimiento por código de ticket</span>
        </div>
        <div class="col-auto">
            <input type="text" class="form-control" id="numeroIngreso" placeholder="Número de ingreso">
        </div>
        <?php if (isset($_SESSION["rut_usuario"])): ?>
            <div class="col-auto">
                <button type="button" class="btn btn-outline-primary" onclick="buscarTicketConSesion()">Buscar</button>
            </div>
        <?php else: ?>
            <div class="col-auto">
                <button type="button" class="btn btn-outline-primary" onclick="buscarTicketSinSesion()">Buscar</button>
            </div>
        <?php endif; ?>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="px-2 py-2 my-2 text-center">
                <img class="d-block mx-auto mb-4" src='./media/logoGov.png' height="100px" width="100px">
                <h1 class="display-5 fw-bold">
                    <?php if($nombre_usuario != null): ?>
                        ¡Bienvenido/a, <?php echo $nombre_usuario;?>!
                    <?php else:?>
                        ¡Bienvenido/a!
                    <?php endif;?>
                </h1>
                <div class="col-lg-12 mx-auto">
                    <p class="my-3">¡Tu opinión cuenta! Ahorra tiempo y esfuerzo visitando nuestra página de
                        retroalimentación municipal en línea. Comparte tus ideas y preocupaciones desde la comodidad de
                        tu hogar, ayudándonos a mejorar nuestra ciudad de manera eficiente. Tu participación es clave
                        para construir un futuro mejor sin la necesidad de desplazamientos presenciales.</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-evenly align-items-center">
                        <a class="btn-lg px-4 btn btn-primary" href="index.php?p=tickets/create" role="button">Crear
                            Nuevo Ticket</a>
                        <a href="index.php?p=agenda/create" role="button"
                            class="btn btn-outline-secondary btn-lg px-4">Agendar Visita</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>