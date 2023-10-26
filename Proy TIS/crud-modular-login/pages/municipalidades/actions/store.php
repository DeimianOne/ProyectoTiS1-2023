<?php
    include("../../../database/connection.php");

    $nombre_municipalidad = $_POST["nombre_municipalidad"];
    $cod_comuna = $_POST["cod_comuna"];
    $direccion_municipalidad = $_POST["direccion_municipalidad"];
    $correo_municipalidad = $_POST["correo_municipalidad"];

    $query = "INSERT INTO municipalidad (nombre_municipalidad, cod_comuna, direccion_municipalidad, correo_municipalidad) 
              VALUES ('$nombre_municipalidad', '$cod_comuna', '$direccion_municipalidad', '$correo_municipalidad');";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=municipalidades/index");
?>
