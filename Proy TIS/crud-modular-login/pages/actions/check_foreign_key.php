<?php
include("../../database/connection.php");

function getDependentTables($value, $checks)
{
    global $connection;

    $dependentTables = [];

    foreach ($checks as $check) {
        if (!isset($check['table']) || !isset($check['field'])) {
            continue; // Se pasa al siguiente check
        }

        $table = $check['table'];
        $field = $check['field'];

        $query = "SELECT COUNT(*) as count FROM $table WHERE $field = '$value'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row['count'] > 0) {
                $dependentTables[] = $table;
            }
        } else {
            continue; // Se pasa al siguiente check
        }
    }

    return $dependentTables;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requestData = json_decode(file_get_contents("php://input"), true);

    if ($requestData && is_array($requestData)) {
        $value = $requestData['value'];
        $checks = $requestData['checks'];

        $dependentTables = getDependentTables($value, $checks);

        // Devolver el resultado como JSON con una clave específica
        echo json_encode($dependentTables);
    }
}
?>