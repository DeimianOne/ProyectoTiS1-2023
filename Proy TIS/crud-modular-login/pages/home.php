<?php
include("database/connection.php");  // Incluye la conexión
include("database/auth.php");  // Comprueba si el usuario está logueado, sino lo redirige al login

$rut = isset($_SESSION["rut_usuario"]) ? $_SESSION["rut_usuario"] : null;

if ($rut) {
    $query = "SELECT * FROM usuario WHERE rut_usuario = '$rut'";
    $result = mysqli_query($connection, $query);
    $nombre_usuario = mysqli_fetch_assoc($result)["nombre_usuario"] ?? null;
} else {
    $nombre_usuario = null;
}

$query_tickets = "SELECT * FROM ticket";
$result_tickets = mysqli_query($connection, $query_tickets);

// Query para el módulo del mapa
$queryMap = "
    SELECT 
        m.cod_municipalidad, 
        m.nombre_municipalidad, 
        m.cod_direccion, 
        m.correo_municipalidad, 
        c.nombre_comuna, 
        di.direccion AS direccion_municipalidad, 
        di.latitud AS latitud, 
        di.longitud AS longitud, 
        COUNT(d.cod_departamento) AS num_departamentos
    FROM municipalidad m
    LEFT JOIN comuna c ON m.cod_comuna = c.cod_comuna
    LEFT JOIN departamento d ON m.cod_municipalidad = d.cod_municipalidad
    LEFT JOIN direccion di ON m.cod_direccion = di.cod_direccion
    GROUP BY m.cod_municipalidad
";
$resultMap = mysqli_query($connection, $queryMap);
$locations = array();
while ($row = mysqli_fetch_assoc($resultMap)) {
    $locations[] = $row;
}
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
        <div class="col-md-6 d-flex align-items-center justify-content-center px-4">
            <!-- Contenido de bienvenida con padding adicional -->
            <div class="text-center">
                <img class="d-block mx-auto mb-4" src='./media/logoGov.png' height="100px" width="100px">
                <h1 class="display-5 fw-bold">
                    <?php if($nombre_usuario != null): ?>
                        ¡Bienvenido/a, <?php echo $nombre_usuario;?>!
                    <?php else:?>
                        ¡Bienvenido/a!
                    <?php endif;?>
                </h1>
                <p>¡Tu opinión cuenta! Ahorra tiempo y esfuerzo visitando nuestra página de retroalimentación municipal
                    en línea...</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-evenly align-items-center">
                    <a class="btn-lg px-4 btn btn-primary" href="index.php?p=tickets/create" role="button">Crear
                        Nuevo Ticket</a>
                    <a href="index.php?p=agenda/create" role="button"
                        class="btn btn-outline-secondary btn-lg px-4">Agendar Visita</a>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 d-flex align-items-center justify-content-center px-4">
            <!-- Módulo del mapa en un contenedor tipo card con padding adicional -->
            <div class="card w-100">
                <div class="card-header">Municipalidades en el sistema</div>
                <div class="card-body">
                    <div id="map" style="height: 650px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function initLoadMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5, // El zoom inicial puede ser genérico, se ajustará automáticamente
            mapId: '5ea9ce137bbd703d'
        });

        var locations = <?php echo json_encode($locations); ?>;
        var bounds = new google.maps.LatLngBounds(); // Objeto para los límites del mapa
        var currentInfoWindow = null;

        locations.forEach(function (location) {
            if (!isNaN(parseFloat(location.latitud)) && !isNaN(parseFloat(location.longitud))) {
                var latLng = new google.maps.LatLng(parseFloat(location.latitud), parseFloat(location.longitud));
                bounds.extend(latLng); // Añade la ubicación al objeto bounds

                var dbMarker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });

                var infoWindowContent = `
                <div style='width:200px; text-align: justify;'>
                    <h4>${location.nombre_municipalidad}</h4>
                    <p>${location.direccion_municipalidad}<br>
                    Comuna: ${location.nombre_comuna}<br>
                    Email: ${location.correo_municipalidad}<br>
                    Departamentos: ${location.num_departamentos}</p>
                </div>`;

                var infoWindow = new google.maps.InfoWindow({
                    content: infoWindowContent
                });

                dbMarker.addListener('click', function () {
                    if (currentInfoWindow) {
                        currentInfoWindow.close();
                    }
                    infoWindow.open(map, dbMarker);
                    currentInfoWindow = infoWindow;
                });
            }
        });

        // Ajusta el mapa para que todos los límites sean visibles
        map.fitBounds(bounds);
    }
</script>