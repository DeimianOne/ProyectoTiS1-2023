<?php
include("../../../database/connection.php");

$cod_municipalidad = $_POST["cod_municipalidad"];
$nombre_municipalidad = $_POST["nombre_municipalidad"];
$cod_comuna = $_POST["cod_comuna"];
$direccion_municipalidad = $_POST["direccion_municipalidad"];
$latitud = $_POST["latitud"];
$longitud = $_POST["longitud"];
$correo_municipalidad = $_POST["correo_municipalidad"];

// Primero, obtén el cod_direccion actual para esta municipalidad
$queryGetDireccion = "SELECT cod_direccion FROM municipalidad WHERE cod_municipalidad = '$cod_municipalidad'";
$resultGetDireccion = mysqli_query($connection, $queryGetDireccion);
$row = mysqli_fetch_assoc($resultGetDireccion);
$cod_direccion = $row['cod_direccion'];

// Actualiza la tabla direccion
$queryDireccion = "UPDATE direccion SET 
                    direccion = '$direccion_municipalidad', 
                    latitud = '$latitud', 
                    longitud = '$longitud' 
                    WHERE cod_direccion = '$cod_direccion';";

$resultDireccion = mysqli_query($connection, $queryDireccion);

// Ahora actualiza la tabla municipalidad
$queryMunicipalidad = "UPDATE municipalidad SET 
                        nombre_municipalidad = '$nombre_municipalidad', 
                        cod_comuna = '$cod_comuna', 
                        correo_municipalidad = '$correo_municipalidad'
                        WHERE cod_municipalidad = '$cod_municipalidad';";

$resultMunicipalidad = mysqli_query($connection, $queryMunicipalidad);

header("Location: ../../../index.php?p=municipalidades/index");
?>
