<?php
    include("../../../database/connection.php");

    $id = $_GET["cod_comuna"];

    $query = "DELETE FROM comuna WHERE cod_comuna=".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=comuna/index");
?>