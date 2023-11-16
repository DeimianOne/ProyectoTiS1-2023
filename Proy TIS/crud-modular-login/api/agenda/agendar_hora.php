<?php
include '../../database/connection.php';

try {

    if (isset($_POST['nombre']) && isset($_POST['rut']) && isset($_POST['fecha']) && isset($_POST['hora'])) {
        $nombre = $_REQUEST['nombre'];
        $rut = $_REQUEST['rut'];
        $fecha = $_REQUEST['fecha'];
        $hora = $_REQUEST['hora'];

        $query = "INSERT INTO agenda(rut_usuario, fecha, hora) VALUES (".$rut.", '".$fecha."', '".$hora."')";

        $result = mysqli_query($connection, $query);

        // $result = false;

        if (!$result) {
            $response = array(
                'success' => false,
                'message' => 'Error al ingresar los datos',
            );
        } else {
            $response = array(
                'success' => true,
                'message' => 'Registro exitoso'
            );
        }

    } else {
        $response = array(
            'success' => false,
            'message' => 'Error en los datos recibidos'
        );
    }
} catch (PDOException $e) {

    $response = array(
        'success' => false,
        'message' => 'Error en el servidor. Intente de nuevo más tarde.'
    );
}

echo json_encode($response); 

