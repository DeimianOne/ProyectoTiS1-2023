<?php
include("database/connection.php");
include("database/auth.php");

$cod_municipalidad = $_GET["id"];

$query = "SELECT * FROM municipalidad WHERE cod_municipalidad=" . $cod_municipalidad . ";";
$result = mysqli_query($connection, $query);

$queryComuna = "SELECT * FROM comuna";
$resultComuna = mysqli_query($connection, $queryComuna);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre_municipalidad = $row["nombre_municipalidad"];
    $municipalidad_comuna = $row["cod_comuna"];
    $correo_municipalidad = $row["correo_municipalidad"];
} else {
    header("Location: index.php?p=municipalidades/index");
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Edición de Municipalidad</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/municipalidades/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_municipalidad" value="<?php echo $cod_municipalidad ?>">

                    <div class="col-md-12 mb-3">
                        <label for="nombre_municipalidad" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_municipalidad" name="nombre_municipalidad"
                            pattern="[A-Za-z0-9\s'áéíóúÁÉÍÓÚüÜñÑ]{1,50}"
                            title="Solo se permiten letras, letras con tilde, números y el signo ' (comilla simple), máximo 50 caracteres"
                            value="<?php echo $nombre_municipalidad ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Comuna</label>
                        <select class="form-control" id="origin" name="cod_comuna">
                            <?php
                            // Iterar a través de los resultados y crear opciones para el select
                            while ($fila = $resultComuna->fetch_assoc()) {
                                $cod_comuna = $fila["cod_comuna"];
                                $nombre_comuna = $fila["nombre_comuna"];
                                $selected = ($cod_comuna == $municipalidad_comuna) ? 'selected' : '';
                                echo "<option value=\"$cod_comuna\" $selected>$nombre_comuna</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" id="address" name="direccion_municipalidad" class="form-control"
                                    placeholder="Ingrese la dirección precisa" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" onclick="geocodeAddress()">Buscar
                                    dirección</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" id="locationButton" class="btn btn-success"
                                    onclick="toggleMap(event)">Seleccionar ubicación manualmente</button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="hidden" name="latitud" id="lat" class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="longitud" id="lng" class="form-control" readonly>
                            </div>
                        </div>

                        <div id="mapContainer" style="display: none;">
                            <div id="map" class="container" style="height: 450px; width: 75%;"></div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="correo_municipalidad" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo_municipalidad" name="correo_municipalidad"
                            value="<?php echo $correo_municipalidad ?>">
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
    var map, marker, geocoder;

    function initCreateMap() {
        geocoder = new google.maps.Geocoder();

        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -32.94630768405489, lng: -70.73575459886952 },
            zoom: 4,
            mapId: '5ea9ce137bbd703d',
            gestureHandling: 'greedy', // Esto permite el scroll sin necesidad de presionar CTRL
            fullscreenControl: false
        });

        map.addListener('click', function (e) {
            placeMarkerAndPanTo(e.latLng, map);
        });

        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
    }

    function placeMarkerAndPanTo(latLng, map) {
        if (marker) {
            marker.setPosition(latLng);
        } else {
            marker = new google.maps.Marker({
                position: latLng,
                map: map,
                draggable: true
            });
        }

        map.panTo(latLng);
        document.getElementById('lat').value = latLng.lat();
        document.getElementById('lng').value = latLng.lng();

        google.maps.event.addListener(marker, 'dragend', function () {
            document.getElementById('lat').value = marker.getPosition().lat();
            document.getElementById('lng').value = marker.getPosition().lng();
        });
    }

    function toggleMap() {
        var mapContainer = document.getElementById('mapContainer');
        mapContainer.style.display = mapContainer.style.display === "none" ? "block" : "none";
    }

    function geocodeAddress() {
        var mapContainer = document.getElementById('mapContainer');
        if (mapContainer.style.display === "none") {
            toggleMap();
        }
        var address = document.getElementById('address').value;
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                placeMarkerAndPanTo(results[0].geometry.location, map);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("No se encontraron detalles para: '" + place.name + "'");
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        if (marker) {
            marker.setPosition(place.geometry.location);
        } else {
            marker = new google.maps.Marker({
                position: place.geometry.location,
                map: map,
                draggable: true
            });
        }

        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();
    });

</script>