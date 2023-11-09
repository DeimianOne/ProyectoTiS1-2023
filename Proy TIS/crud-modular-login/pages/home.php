<?php
// Descomentar linea 3 si es que se quiere usar la autenticación para esta página
// require("database/auth.php");
?>

<div class="container-fluid my-3">
    <div class="row d-flex justify-content-end align-items-center">
        <div class="col-auto">
            <span class="text-body-secondary">Seguimiento por código de ticket</span>
        </div>
        <div class="col-auto">
            <input type="text" class="form-control" placeholder="Número de ingreso">
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-dark">Buscar</button>
        </div>
    </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-md-12">
        <div class="px-2 py-2 my-2 text-center">
            <img class="d-block mx-auto mb-4" src='./media/logoGov.png' height="100px" width="100px">
            <h1 class="display-5 fw-bold">¡Bienvenido, <?php echo $_SESSION['rut_usuario'] ?? null ?>!</h1>
            <div class="col-lg-12 mx-auto">
                <p class="my-3">¡Tu opinión cuenta! Ahorra tiempo y esfuerzo visitando nuestra página de retroalimentación municipal en línea. Comparte tus ideas y preocupaciones desde la comodidad de tu hogar, ayudándonos a mejorar nuestra ciudad de manera eficiente. Tu participación es clave para construir un futuro mejor sin la necesidad de desplazamientos presenciales.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-evenly align-items-center">
                    <a class="btn-lg px-4 btn btn-primary" href="index.php?p=tickets/create" role="button">Crear Nuevo Ticket</a>
                    <a href="index.php?p=agenda/create" role="button" class="btn btn-outline-secondary btn-lg px-4">Agendar Visita</a>
                </div>
            </div>
        </div>
    </div>
    
  </div>
</div>





