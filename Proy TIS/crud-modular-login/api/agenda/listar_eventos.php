<?php
include '../../database/connection.php';
$query_agenda = "SELECT * FROM agenda";
$result_agenda = mysqli_query($connection, $query_agenda);
$fila = $result_agenda->fetch_all();
print_r($fila);
echo json_encode($result_agenda, JSON_UNESCAPED_UNICODE);
//die();
?>



