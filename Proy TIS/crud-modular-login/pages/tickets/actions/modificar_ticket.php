<?php
include("../../../database/connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cod_ticket = $_POST["id"];
    $visibilidad_solicitud = $_POST["visibilidad_solicitud"];
    $cod_estado = $_POST["cod_estado"];
    $cod_departamento = $_POST["cod_departamento"];


    $query = "UPDATE ticket SET
    visibilidad_solicitud = '$visibilidad_solicitud',
    cod_departamento = '$cod_departamento'
    WHERE cod_ticket = '$cod_ticket';";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['modal'] = "Ticket modificado correctamente.";

        $query_r_estado = "DELETE FROM estado_ticket WHERE cod_ticket='" . $cod_ticket . "';";
        $result_r_estado = mysqli_query($connection, $query_r_estado);

        if ($result_r_estado) {
            $query = "INSERT INTO estado_ticket(cod_ticket, cod_estado) VALUES ('$cod_ticket', '$cod_estado')";
            $result = mysqli_query($connection, $query);
        }

        include("../../registro_tickets\actions\store_register.php");
        insertar_registro($cod_ticket);

    } else {
        $_SESSION['modal'] = "Error al modificar el ticket: " . mysqli_error($connection);
    }

} else {
    $_SESSION['modal'] = "Error al modificar el ticket: " . mysqli_error($connection);
}

?>