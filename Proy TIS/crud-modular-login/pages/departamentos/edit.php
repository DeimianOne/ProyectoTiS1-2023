<?php
    include("database/connection.php");
    include("database/auth.php");

    $cod_departamento = $_GET["id"];

    $query = "SELECT * FROM Departamento WHERE cod_departamento=" . $cod_departamento . ";";
    $result = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $cod_municipalidad = $row["cod_municipalidad"];
        $nombre_departamento = $row["nombre_departamento"];
        $telefono_departamento = $row["telefono_departamento"];
    } else {
        header("Location: index.php?p=departamentos/index");
    }
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición de Departamento</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <form action="pages/departamentos/actions/update.php" method="POST">
            <div class="card-body">
                <div class="row">
                    <input type="text" class="d-none" name="cod_departamento" value="<?php echo $cod_departamento ?>">

                    <div class="col-md-12 mb-3">
                        <label for="cod_municipalidad" class="form-label">Código de la Municipalidad</label>
                        <input type="text" class="form-control" id="cod_municipalidad" name="cod_municipalidad" value="<?php echo $cod_municipalidad ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="nombre_departamento" class="form-label">Nombre del Departamento</label>
                        <input type="text" class="form-control" id="nombre_departamento" name="nombre_departamento" value="<?php echo $nombre_departamento ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="telefono_departamento" class="form-label">Teléfono del Departamento</label>
                        <input type="tel" class="form-control" id="telefono_departamento" name="telefono_departamento" value="<?php echo $telefono_departamento ?>">
                    </div>
                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</main>
