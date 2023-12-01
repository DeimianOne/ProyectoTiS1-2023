<?php
include("database/auth.php");
include("database/connection.php");  // Incluye la conexión

// Fetching the departments for the dropdown
$query = "SELECT * FROM departamento";
$result = mysqli_query($connection, $query);

$queryMuni = "SELECT * FROM municipalidad";
$resultMuni = mysqli_query($connection, $queryMuni);

// Fetching the ENUM values for 'tipo_solicitud'
$enumQuery = "SHOW COLUMNS FROM ticket WHERE Field='tipo_solicitud'";
$enumResult = mysqli_query($connection, $enumQuery);
$row = $enumResult->fetch_assoc();
$type = $row['Type'];
$matches = array();
preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
$enum_values = explode("','", $matches[1]);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Añadir Ticket</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/tickets/actions/store.php" method="POST">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="tipo_solicitud" class="form-label">Tipo de Solicitud</label>
                        <select class="form-control" id="tipo_solicitud" name="tipo_solicitud">
                            <?php
                            foreach ($enum_values as $value) {
                                echo "<option value=\"" . ucfirst($value) . "\">" . ucfirst($value) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="asunto_ticket" class="form-label">Asunto Ticket</label>
                        <input type="text" class="form-control" id="asunto_ticket" name="asunto_ticket"
                            placeholder="Asunto" required maxlength="50">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="detalles_solicitud" class="form-label">Detalles de Solicitud</label>
                        <textarea class="form-control" id="detalles_solicitud" name="detalles_solicitud"
                            required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button type="button" id="locationButton" class="btn btn-success"
                                onclick="toggleMap(event)">Adjuntar Ubicación</button>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="ticketAddress" class="form-control"
                                placeholder="Ingrese la dirección del ticket">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" id="botonBuscar"
                                onclick="geocodeTicketAddress()">Buscar
                                dirección</button>
                        </div>
                    </div>

                    <div id="mapContainer" style="display: none;">
                        <div id="map" style="height: 450px; width: 100%;"></div>
                        <input type="hidden" name="latitud" id="lat" class="form-control" readonly>
                        <input type="hidden" name="longitud" id="lng" class="form-control" readonly>
                    </div>

                    <hr>

                    <div class="col-md-12 mb-3">
                        <label for="municipalidad" class="form-label">Municipalidad</label>
                        <select class="form-control" id="municipalidad" name="cod_municipalidad">
                            <?php
                            while ($fila = $resultMuni->fetch_assoc()) {
                                $cod_municipalidad = $fila["cod_municipalidad"];
                                $nombre_municipalidad = $fila["nombre_municipalidad"];
                                echo "<option value=\"$cod_municipalidad\">$nombre_municipalidad</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-control" id="departamento" name="cod_departamento">
                            <?php
                            while ($fila = $result->fetch_assoc()) {
                                $cod_departamento = $fila["cod_departamento"];
                                $nombre_departamento = $fila["nombre_departamento"];
                                echo "<option value=\"$cod_departamento\">$nombre_departamento</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>

<script type="text/javascript">
    var ticketMap, ticketMarker, ticketGeocoder;

    function initTicketMap() {
        ticketGeocoder = new google.maps.Geocoder();

        ticketMap = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -32.94630768405489, lng: -70.73575459886952 },
            zoom: 4,
            mapId: '5ea9ce137bbd703d'
        });

        ticketMap.addListener('click', function (e) {
            placeMarkerAndPanTo(e.latLng, ticketMap);
        });

        // Corrección aquí: Cambiar 'address' a 'ticketAddress'
        var input = document.getElementById('ticketAddress');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', ticketMap);

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("No se encontraron detalles para: '" + place.name + "'");
                return;
            }

            if (place.geometry.viewport) {
                ticketMap.fitBounds(place.geometry.viewport);
            } else {
                ticketMap.setCenter(place.geometry.location);
                ticketMap.setZoom(17);
            }

            if (ticketMarker) {
                ticketMarker.setPosition(place.geometry.location);
            } else {
                ticketMarker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: ticketMap,
                    draggable: true
                });
            }

            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();
        });
    }

    function placeMarkerAndPanTo(latLng, map) {
        if (ticketMarker) {
            ticketMarker.setPosition(latLng);
        } else {
            ticketMarker = new google.maps.Marker({
                position: latLng,
                map: map,
                draggable: true
            });
        }

        map.panTo(latLng);
        document.getElementById('lat').value = latLng.lat();
        document.getElementById('lng').value = latLng.lng();

        google.maps.event.addListener(ticketMarker, 'dragend', function () {
            document.getElementById('lat').value = ticketMarker.getPosition().lat();
            document.getElementById('lng').value = ticketMarker.getPosition().lng();
        });
    }

    function toggleMap(callback) {
        var mapContainer = document.getElementById('mapContainer');
        var isMapHidden = mapContainer.style.display === "none";

        if (isMapHidden) {
            mapContainer.style.display = "block";
            if (typeof callback === 'function') {
                callback();
            }
        }
        // No cerrar el mapa si ya está abierto
    }

    function geocodeTicketAddress() {
        var address = document.getElementById('ticketAddress').value;
        ticketGeocoder.geocode({ 'address': address }, function (results, status) {
            if (status === 'OK') {
                ticketMap.setCenter(results[0].geometry.location);
                placeMarkerAndPanTo(results[0].geometry.location, ticketMap);
            } else {
                alert('La geocodificación no fue exitosa por el siguiente motivo: ' + status);
            }
        });
    }

    // Modifica el evento onclick del botón de búsqueda de dirección
    document.getElementById('botonBuscar').onclick = function () {
        // Llama a toggleMap solo si el mapa está oculto
        if (document.getElementById('mapContainer').style.display === "none") {
            toggleMap(geocodeTicketAddress);
        } else {
            geocodeTicketAddress();
        }
    };



    // Asegúrate de que esta función se llame en el callback de carga del mapa en el footer
    // Por ejemplo: if (typeof initTicketMap === 'function') { initTicketMap(); }
</script>