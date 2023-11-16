<?php
include '../../database/connection.php';
$query_agenda = "SELECT cod_agenda, rut_usuario,fecha, DATE_FORMAT(hora,'%H:%i') as hora FROM agenda";
$result_agenda = $connection->query($query_agenda);
$resultado_total = array();
while($fila = $result_agenda->fetch_assoc())
{
    $hora = $fila['hora'];
    $hora = date('H:i', strtotime($hora . ' + 30 minutes'));
    $resultado_total[] = array(
        'id'=>$fila['cod_agenda'],
        'title' => $fila['rut_usuario'],
        'start' => $fila['fecha'].'T'.$fila['hora'],
        'end' => $fila['fecha'].'T'.$hora
    );
}
echo json_encode($resultado_total);
?>



