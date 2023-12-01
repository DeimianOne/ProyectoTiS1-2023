<?php
    include("../../../database/connection.php");
    
    $calle = $_POST["calle"];
    $comuna = $_POST["cod_comuna"];
    $numero = $_POST["numero"];
    $id= $_POST["id"];
    if (isset($_POST['numero_departamento']) && !empty($_POST['numero_departamento'])) {
        $numero_departamento = $_POST['numero_departamento'];
        $query = "UPDATE direccion SET calle = '$calle', cod_comuna = '$comuna', numero = '$numero', numero_departamento = '$numero_departamento' WHERE cod_direccion = ".$id.";";

    } else {
        $query = "UPDATE direccion SET calle = '$calle', cod_comuna = '$comuna', numero = '$numero', numero_departamento = NULL WHERE cod_direccion = ".$id.";";
    }

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=direccion/index");
?>