<?php
    include("../../../database/connection.php");

    // obtener los datos del formulario
    $id= $_POST["id"];
    $username = $_POST["username"];
    $email = $_POST["email"];

    // actualizar los datos en la base de datos
    $query = "UPDATE users SET username = '$username', email='$email' WHERE id = ".$id.";";

    // ejecutar la consulta
    $result =  mysqli_query($connection, $query);

    // redireccionar a la pagina de usuarios
    header("Location: ../../../index.php?p=users/index");
?>