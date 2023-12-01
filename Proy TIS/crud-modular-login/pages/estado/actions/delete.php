<?php
    include("../../../database/connection.php");

    $id = $_GET["cod_estado"];

    if ($id != 0){

        $query = "DELETE FROM estado WHERE cod_estado=".$id.";";

        $result =  mysqli_query($connection, $query);

    }

    header("Location: ../../../index.php?p=estado/index");
?>