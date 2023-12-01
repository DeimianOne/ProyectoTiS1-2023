<?php
    include("../../../database/connection.php");

    $cod_departamento = $_POST["cod_departamento"];
    $cod_municipalidad = $_POST["cod_municipalidad"];
    $nombre_departamento = $_POST["nombre_departamento"];
    $telefono_departamento = $_POST["telefono_departamento"];
    $atencion_presencial = isset($_POST["atencion_presencial"]) ? 1 : 0;
    $horario_atencion_inicio = $_POST["horario_atencion_inicio"];
    $horario_atencion_termino = $_POST["horario_atencion_termino"];

    $query = "INSERT INTO departamento (cod_departamento, cod_municipalidad, nombre_departamento, telefono_departamento, atencion_presencial, horario_atencion_inicio, horario_atencion_termino) 
              VALUES ('$cod_departamento', '$cod_municipalidad', '$nombre_departamento', '$telefono_departamento', '$atencion_presencial', '$horario_atencion_inicio', '$horario_atencion_termino');";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=departamentos/index");
?>
