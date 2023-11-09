<?php
    require("database/connection.php");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $paginas = array("home"); // Agrega "home" a la lista de páginas permitidas

    // Comprueba si el usuario está logueado solo si no está en una página permitida
    if(!isset($_SESSION["rut_usuario"]) && !in_array($_GET['p'], $paginas)){
        header("Location: index.php?p=home"); // Cambia a la página a la que deseas redirigir cuando no hay sesión
    } else {
        // Obtener el nombre de usuario de la sesión si está disponible
        $rut = isset($_SESSION["rut_usuario"]) ? $_SESSION["rut_usuario"] : null;

        if ($rut) {
            $sql = "SELECT * FROM usuario WHERE rut_usuario = '$rut'";
            $result = mysqli_query($connection, $sql);

            // Verifica si el usuario existe
            if (mysqli_num_rows($result) == 0) {
                session_destroy();
                // User does not exist, redirect to login page
                header("Location: auth/login.php"); // Ajusta la redirección según sea necesario
            }
        }
    }
?>
