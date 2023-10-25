<?php
    include("../../../database/connection.php");

    $cod_municipalidad = $_POST["cod_municipalidad"];
    $nombre_municipalidad = $_POST["nombre_municipalidad"];
    $cod_comuna = $_POST["cod_comuna"];
    $direccion_municipalidad = $_POST["direccion_municipalidad"];
    $correo_municipalidad = $_POST["correo_municipalidad"];

    $query = "UPDATE municipalidad SET 
                nombre_municipalidad = '$nombre_municipalidad', 
                cod_comuna = '$cod_comuna', 
                direccion_municipalidad = '$direccion_municipalidad', 
                correo_municipalidad = '$correo_municipalidad'
              WHERE cod_municipalidad = '$cod_municipalidad';";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=municipalidades/index");
?>
