<?php
    include("database/connection.php");
    include("database/auth.php");

    $id = $_GET["id"];

    $query = "SELECT * FROM marcas WHERE id=" . $id . ";";
    $result =  mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row["nombre"];
        $origen = $row["origen"];
        $logo = $row["logo"];
        $id = $row["id"];
    } else {
        header("Location: index.php?p=brands/index");
    }
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h1>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/brands/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="id" value="<?php echo $id ?>">

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="nombre" placeholder="Japón" value="<?php echo $nombre ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="origin" class="form-label">Origen</label>
                        <select class="form-control" id="origin" name="origen">
                            <option value="Japón" <?php echo $origen == "Japón" ? "selected" : null ?>>Japón</option>
                            <option value="China" <?php echo $origen == "China" ? "selected" : null ?>>China</option>
                            <option value="Francia" <?php echo $origen == "Francia" ? "selected" : null ?>>Francia</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="text" class="form-control" id="logo" name="logo" value="<?php echo $logo ?>">
                    </div>
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</main>