<?php
    include("../../../database/connection.php");

    // obtener los datos del formulario
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // insertar los datos en la base de datos
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    // ejecutar la consulta
    $result =  mysqli_query($connection, $query);

    // redireccionar a la pagina de usuarios
    header("Location: ../../../index.php?p=users/index");
?>
