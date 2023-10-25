<?php
    include("database/connection.php");
    include("database/auth.php");

    $id = $_GET["cod_permiso"];

    $query = "SELECT * FROM permiso WHERE cod_permiso=" . $id . ";";
    $result =  mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row["nombre_permiso"];
        $descripcion = $row["descripcion_permiso"];
        $id = $row["cod_permiso"];
    } else {
        header("Location: index.php?p=permiso/index");
    }
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/permiso/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_permiso" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre del permiso</label>
                        <input type="text" class="form-control" id="name" name="nombre_permiso" placeholder="Permiso" value="<?php echo $nombre ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Descripción del permiso</label>
                        <textarea class="form-control" id="name" name="descripcion_permiso" placeholder="Descripción"><?php echo $descripcion ?></textarea>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>