<?php
    include("../../../database/connection.php");

    $cod_departamento = $_POST["cod_departamento"];
    $cod_municipalidad = $_POST["cod_municipalidad"];
    $nombre_departamento = $_POST["nombre_departamento"];
    $telefono_departamento = $_POST["telefono_departamento"];

    $query = "UPDATE departamento SET 
                cod_municipalidad = '$cod_municipalidad', 
                nombre_departamento = '$nombre_departamento', 
                telefono_departamento = '$telefono_departamento'
              WHERE cod_departamento = '$cod_departamento';";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=departamentos/index");
?>
