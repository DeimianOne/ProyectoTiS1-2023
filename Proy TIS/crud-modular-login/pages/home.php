<?php
// Descomentar linea 3 si es que se quiere usar la autenticación para esta página
// require("database/auth.php");
?>

<div class="container-fluid my-3">
        <div class="row justify-content-end">
            <div class="col-auto d-flex justify-content-center align-items-center">
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
    <div class="col-md-6">
        <div class="px-2 py-2 my-2 text-center">
            <img class="d-block mx-auto mb-4" src='./media/logoGov.png' height="100px" width="100px">
            <h1 class="display-5 fw-bold">¡Bienvenido, <?php echo $_SESSION['rut_usuario'] ?? null ?>!</h1>
            <div class="col-lg-12 mx-auto">
                <p class="my-3">"¡Tu opinión cuenta! Ahorra tiempo y esfuerzo visitando nuestra página de retroalimentación municipal en línea. Comparte tus ideas y preocupaciones desde la comodidad de tu hogar, ayudándonos a mejorar nuestra ciudad de manera eficiente. Tu participación es clave para construir un futuro mejor sin la necesidad de desplazamientos presenciales."</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Ingresar Ticket</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">Agendar Visita</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <main class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center">
                                <span> <strong>Últimos Tickets Resueltos</strong></span>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive ">
                    <table class="table table-hover">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Código Ticket</th>
                                <th scope="col">Tipo Ticket</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Asunto</th>
                                <th scope="col">Fecha Ingreso</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </main>
    </div>
  </div>
</div>





