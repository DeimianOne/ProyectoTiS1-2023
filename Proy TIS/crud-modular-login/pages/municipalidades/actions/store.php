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
$queryDireccion = "INSERT INTO direccion (direccion, latitud, longitud) VALUES ('$direccion_municipalidad', '$latitud', '$longitud')";
$resultDireccion = mysqli_query($connection, $queryDireccion);

// Obtén la clave primaria generada automáticamente
$cod_direccion = mysqli_insert_id($connection);

// Asegúrate de que tu consulta SQL incluya latitud y longitud
$query = "INSERT INTO municipalidad (nombre_municipalidad, cod_comuna, cod_direccion, correo_municipalidad)
    VALUES ('$nombre_municipalidad', '$cod_comuna', '$cod_direccion', '$correo_municipalidad')";

$result = mysqli_query($connection, $query);

header("Location: ../../../index.php?p=municipalidades/index");
?>