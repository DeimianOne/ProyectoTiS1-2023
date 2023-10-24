<?php
    require('database/connection.php');

    if (isset($_POST['username'])) {

        $username = stripslashes($_REQUEST['username']); // removes backslashes
        $username = mysqli_real_escape_string($connection, $username); //escapes special characters in a string
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($connection, $password);

        //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username' and password='" . md5($password) . "'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }

        $user = mysqli_num_rows($result);
        
        if ($user == 1) {
            $_SESSION['username'] = $username;
            header("Location: index.php?p=home"); // Redirect user to index.php
        } else {
            echo "<div class='form'><h3>Usuario/Contraseña Incorrecto</h3><br/>Haz click aquí para <a href='index.php?p=auth/login'>Logearte</a></div>";
        }
    } else {
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center">Inicia Sesión</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" name="login">
                                <div class="form-group mb-3">
                                    <label for="username">Usuario</label>
                                    <input type="text" name="username" class="form-control" placeholder="Ingresa tu usuario" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required />
                                </div>
                                <div class="form-group d-flex justify-content-center my-2">
                                    <button name="submit" type="submit" class="btn btn-dark btn-block">Entrar</button>
                                </div>
                            </form>
                            <p class="text-center">¿No estás registrado aún? <a href='index.php?p=auth/register'>Regístrate aquí</a></p>
                            <a class="text-center nav-link" href='index.php?p=auth/loginAdmin'>Acceso Administrador</a>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } 
?>