<?php
require('database/connection.php');

if (isset($_POST['rut_usuario']) && isset($_POST['password_usuario'])) {
    $rut_usuario = mysqli_real_escape_string($connection, stripslashes($_POST['rut_usuario']));
    $password_usuario = $_POST['password_usuario'];
    //$password_usuari = mysqli_real_escape_string($connection, $password_usuario); // Fixed the variable name here

    // The SQL query should only select the needed columns, in this case, password and role
    $query = "SELECT usuario.password_usuario, usuario_rol.cod_rol FROM usuario JOIN usuario_rol ON usuario.rut_usuario = usuario_rol.rut_usuario WHERE usuario.rut_usuario = '$rut_usuario'";
    
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    /*if ($user = mysqli_fetch_assoc($result)){
        echo "<script>alert('Usuario encontrado');</script>";
        echo $user['password_usuario'];
    }*/

    if ($user = mysqli_fetch_assoc($result)) {
        $user_HashedPassword = $user['password_usuario'];
        if (password_verify($password_usuario, $user_HashedPassword)) {
            // Password is correct
            $_SESSION['rut_usuario'] = $rut_usuario;
            $_SESSION['rol_usuario'] = $user['cod_rol'];
            header("Location: index.php"); // Redirect to user dashboard or any desired page
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Contraseña incorrecta o rut no válido');</script>";
            echo $password_usuario;
            echo "Holalalala";
            echo $user_HashedPassword;
            echo "===";
            echo $user['password_usuario'];

            if( password_verify($password_usuario, $user['password_usuario'])){
                echo "Coinciden";
            }else{
                echo "No coincidens";
            }

            
            //echo "<script>setTimeout(function(){ window.location.href = 'index.php?p=auth/login'; }, 250);</script>";
        }
    } else {
        // RUT not found or other login error
        echo "<script>alert('Rut no encontrado o error de login');</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'index.php?p=auth/login'; }, 250);</script>";
    }
} else {
    // The login form HTML part remains mostly unchanged, except for the password field
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
                                    <label for="rut_usuario">RUT</label>
                                    <input type="text" name="rut_usuario" class="form-control" pattern="[0-9]+" title="Solo numeros" placeholder="Ingresa tu RUT" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password_usuario">Contraseña</label>
                                    <input type="password" name="password_usuario" class="form-control" placeholder="Ingresa tu contraseña" required />
                                </div>
                                <div class="form-group d-flex justify-content-center my-2">
                                    <button name="submit" type="submit" class="btn btn-dark btn-block">Entrar</button>
                                </div>
                            </form>
                            <p class="text-center">¿No estás registrado aún? <a href='index.php?p=auth/register'>Regístrate aquí</a></p>
                            <!-- <a class="text-center nav-link" href='index.php?p=auth/loginAdmin'>Acceso Administrador</a> -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } 
?>