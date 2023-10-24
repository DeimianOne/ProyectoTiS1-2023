<?php
    require('database/connection.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']); // removes backslashes
        $username = mysqli_real_escape_string($connection, $username); //escapes special characters in a string
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($connection, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($connection, $password);

        $trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '" . md5($password) . "', '$email', '$trn_date')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<div class='form'><h3>Te has registrado correctamente!</h3><br/>Haz click aquí para <a href='index.php'>Logearte</a></div>";
        }
    } else {
    ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center">Registrate Aquí</h1>
                        </div>
                        <div class="card-body">
                            <form name="registration" action="" method="post">
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label">Usuario</label>
                                    <input type="text" name="username" class="form-control" id="username" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Correo</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
?>