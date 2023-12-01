<?php
include '../../database/connection.php';
$query_agenda = "SELECT * FROM proyecto";
$result_agenda = $connection->query($query_agenda);
$resultado_total = array();
while($fila = $result_agenda->fetch_assoc())
{
    $resultado_total[] = array(
        'id'=>$fila['cod_proyecto'],
        'title' => $fila['nombre_proyecto'],
        'start' => $fila['fecha_inicio_proyecto'],
        'end' => $fila['fecha_termino_estimada_proyecto'],
        'description' => $fila['descripcion_proyecto']
    );
}
echo json_encode($resultado_total, JSON_UNESCAPED_UNICODE);
?>
