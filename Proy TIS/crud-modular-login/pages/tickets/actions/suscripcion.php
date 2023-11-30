<?php
    include("../../../database/connection.php");
    
    $suscripcion = $_POST["suscripcion"];
    $rut_suscriptor = $_POST["rut_usuario"];
    $cod_ticket = $_POST["cod_ticket"];

    if ($suscripcion == false) {
        $query = "INSERT INTO suscripcion (cod_ticket, rut_usuario) VALUES ('$cod_ticket', '$rut_suscriptor');";

        $result =  mysqli_query($connection, $query);
    } else {
        $query = "DELETE FROM suscripcion WHERE cod_ticket = ".$cod_ticket." AND rut_usuario = ".$rut_suscriptor;

        $result =  mysqli_query($connection, $query);
    }

    header("Location: ../../../index.php?p=tickets/view&cod_ticket=$cod_ticket");
?>