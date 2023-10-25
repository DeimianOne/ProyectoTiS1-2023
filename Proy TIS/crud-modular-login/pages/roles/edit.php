<?php
    include("database/connection.php");
    include("database/auth.php");

    $id = $_GET["cod_rol"];

    $query = "SELECT * FROM rol WHERE cod_rol=" . $id . ";";
    $result =  mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_rol = $row["nombre_rol"];
        $cod_rol = $row["cod_rol"];
    } else {
        header("Location: index.php?p=roles/index");
    }
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/roles/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_rol" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre del rol</label>
                        <input type="text" class="form-control" id="name" name="nombre_rol" placeholder="Rol" value="<?php echo $nombre_rol ?>" required>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>