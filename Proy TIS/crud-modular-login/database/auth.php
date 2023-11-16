<?php
    require("database/connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rut = mysqli_real_escape_string($connection, $_POST["rut_usuario"]);
        $nombre = mysqli_real_escape_string($connection, $_POST["nombre_usuario"]);

        $query = "SELECT * FROM usuario WHERE rut_usuario = '$rut'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);

            if ($user && password_verify($nombre, $user["nombre_usuario"])) {
                // Autenticación exitosa
                session_start();
                $_SESSION["rut_usuario"] = $rut;
                header("Location: index.php?p=home");
            } else {
                // Contraseña incorrecta
                echo "Nombre incorrecto";
            }
        } else {
            // Rut no encontrado en la base de datos
            echo "Rut no encontrado";
        }
    } elseif (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $allowed_pages = array("home", "tickets/view"); // Agrega "home" a la lista de páginas permitidas

    // Comprueba si el usuario está logueado solo si no está en una página permitida
    if(!isset($_SESSION["rut_usuario"]) && !in_array($_GET['p'], $allowed_pages)){
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
                header("Location: index.php?p=auth/login"); // Ajusta la redirección según sea necesario
            }
        }
    }
?>
