<?php
    include("../../../database/connection.php");

    $cod_proyecto = $_POST["cod_proyecto"];
    $cod_departamento = $_POST["cod_departamento"];
    $nombre_proyecto = $_POST["nombre_proyecto"];
    $descripcion_proyecto = $_POST["descripcion_proyecto"];
    $fecha_inicio_proyecto = $_POST["fecha_inicio_proyecto"];
    $fecha_termino_estimada_proyecto = $_POST["fecha_termino_estimada_proyecto"];

    $query = "INSERT INTO proyecto (cod_proyecto, cod_departamento, nombre_proyecto, descripcion_proyecto, fecha_inicio_proyecto, fecha_termino_estimada_proyecto) 
              VALUES ('$cod_proyecto', '$cod_departamento', '$nombre_proyecto', '$descripcion_proyecto', '$fecha_inicio_proyecto', '$fecha_termino_estimada_proyecto');";

    $result = mysqli_query($connection, $query);

    // Asegúrate de cambiar la dirección de redireccionamiento si es necesario
    header("Location: ../../../index.php?p=proyectos/index");
?>
