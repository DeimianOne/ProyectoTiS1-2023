<?php
    include("../../../database/connection.php");

    $id = $_GET["cod_permiso"];

    $query = "DELETE FROM permiso WHERE cod_permiso=".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=permiso/index");
?>