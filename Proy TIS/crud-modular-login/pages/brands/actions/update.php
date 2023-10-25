<?php
    include("../../../database/connection.php");
    
    $nombre = $_POST["nombre"];
    $origen= $_POST["origen"];
    $logo = $_POST["logo"];
    $id= $_POST["id"];
    
    $query = "UPDATE marcas SET nombre = '$nombre', origen= '$origen', logo='$logo' WHERE id = ".$id.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=brands/index");
?>