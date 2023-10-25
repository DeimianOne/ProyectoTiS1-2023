<?php
    include("../../../database/connection.php");

    $id = $_GET["id"];

    $query = "DELETE FROM users WHERE id=".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=users/index");
?>