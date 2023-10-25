<?php
    include("../../../database/connection.php");

    $id = $_GET["cod_region"];

    $query = "DELETE FROM region WHERE cod_region=".$id.";";

    $result =  mysqli_query($connection2, $query);

    header("Location: ../../../index.php?p=region/index");
?>