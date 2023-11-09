<?php
    include("../../../database/connection.php");

    $cod_departamento = $_POST["cod_departamento"];
    $nombre_departamento = $_POST["nombre_departamento"];
    $telefono_departamento = $_POST["telefono_departamento"];
    $horario_atencion_inicio = $_POST["horario_atencion_inicio"];
    $horario_atencion_termino = $_POST["horario_atencion_termino"];
    $atencion_presencial = isset($_POST["atencion_presencial"]) ? 1 : 0; // Aquí usamos el mismo método que discutimos antes

    $query = "UPDATE departamento SET 
                nombre_departamento = '$nombre_departamento', 
                telefono_departamento = '$telefono_departamento',
                atencion_presencial = '$atencion_presencial',
                horario_atencion_inicio = '$horario_atencion_inicio',
                horario_atencion_termino = '$horario_atencion_termino'
                
              WHERE cod_departamento = '$cod_departamento';";

    $result = mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=departamentos/index");
?>
