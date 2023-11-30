<?php
    include("../../../database/connection.php");

    // Recoge los datos del formulario, incluyendo latitud y longitud
    $nombre_municipalidad = $_POST["nombre_municipalidad"];
    $cod_comuna = $_POST["cod_comuna"];
    $direccion_municipalidad = $_POST["direccion_municipalidad"];
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];
    $correo_municipalidad = $_POST["correo_municipalidad"];

    // Asegúrate de que tu consulta SQL incluya latitud y longitud
    $query = "INSERT INTO municipalidad (nombre_municipalidad, cod_comuna, direccion_municipalidad, latitud, longitud, correo_municipalidad) 
              VALUES ('$nombre_municipalidad', '$cod_comuna', '$direccion_municipalidad', '$latitud', '$longitud', '$correo_municipalidad');";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=municipalidades/index");
?>
