<?php
    include("../../../database/connection.php");

    $calle = $_POST["calle"];
    $comuna = $_POST["cod_comuna"];
    $numero = $_POST["numero"];
    if (isset($_POST['cod_comuna']) && !empty($_POST['cod_comuna'])){
        if (isset($_POST['numero_departamento']) && !empty($_POST['numero_departamento'])) {
            $numero_departamento = $_POST['numero_departamento'];
            $query = "INSERT INTO direccion (calle, cod_comuna, numero, numero_departamento) VALUES ('$calle', '$comuna', '$numero', '$numero_departamento');";
        } else {
            $query = "INSERT INTO direccion (calle, cod_comuna, numero) VALUES ('$calle', '$comuna', '$numero');";
        }

        $result =  mysqli_query($connection, $query);

        header("Location: ../../../index.php?p=direccion/index");
    } else {
        header("Location: ../../../index.php?p=direccion/index");
    }
?>
