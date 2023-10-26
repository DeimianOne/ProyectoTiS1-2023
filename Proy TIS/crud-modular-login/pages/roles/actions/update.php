<?php
    include("../../../database/connection.php");
    
    $codigo = $_POST["cod_rol"];
    $nombre = $_POST["nombre_rol"];
    
    $query = "UPDATE rol SET nombre_rol = '$nombre' 
              WHERE cod_rol = ".$codigo.";";

    $result =  mysqli_query($connection, $query);

    header("Location: ../../../index.php?p=roles/index");
?>