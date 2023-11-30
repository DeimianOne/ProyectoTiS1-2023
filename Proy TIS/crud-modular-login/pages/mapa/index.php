<?php
include("database/auth.php");
include("database/connection.php");
?>


<h1><span>Sufrimiento</span></h1>

<div class="container">
    <div id="mapContainer">
        <div id="map" class="container" style="height: 650px; width: 75%;"></div>
    </div>
</div>

<?php

$query = "
    SELECT 
        m.cod_municipalidad, 
        m.nombre_municipalidad, 
        m.direccion_municipalidad, 
        m.correo_municipalidad, 
        m.latitud, 
        m.longitud, 
        c.nombre_comuna, 
        COUNT(d.cod_departamento) AS num_departamentos
    FROM municipalidad m
    LEFT JOIN comuna c ON m.cod_comuna = c.cod_comuna
    LEFT JOIN departamento d ON m.cod_municipalidad = d.cod_municipalidad
    GROUP BY m.cod_municipalidad
";
$result = mysqli_query($connection, $query);

$locations = array();
while ($row = mysqli_fetch_assoc($result)) {
    $locations[] = $row;
}
?>

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