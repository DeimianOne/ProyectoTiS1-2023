<?php
    include("../../../database/connection.php");
    
    if($_GET["cod_rol"] != 1 and $_GET["cod_rol"] != 2){
        $cod_rol = $_GET["cod_rol"];

        $query = "DELETE FROM rol_permiso WHERE cod_rol=".$cod_rol.";";

        $result = mysqli_query($connection, $query);

        $query2 = "DELETE FROM rol WHERE cod_rol=".$cod_rol.";";

        $result2 =  mysqli_query($connection, $query2);
    }

    header("Location: ../../../index.php?p=roles/index");
?>