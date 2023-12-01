<?php
include("database/connection.php");
include("database/auth.php");

$id = $_GET["id"];

$query = "SELECT * FROM users WHERE id = " . $id . ";";
$result = mysqli_query($connection, $query);


if ($user = mysqli_fetch_assoc($result)) {
    $username = $user["username"];
    $email = $user["email"];
    $id = $user["id"];
} else {
    header("Location: index.php?p=brands/index");
}

?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de registro</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/users/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="id" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" id="username" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Correo electronico</label>
                        <input type="email" id="email" class="form-control" name="email" value="<?php echo $email ?>" required>
                    </div>

                    <!-- <div class="col-md-12 mb-3">
                        <label for="logo" class="form-label">Contraseña</label>
                        <input type="password" id="" class="form-control" name="password" value="">
                        <span class="text-muted">Complete este campo solo si desea cambiar la contraseña.</span>
                    </div> -->
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>