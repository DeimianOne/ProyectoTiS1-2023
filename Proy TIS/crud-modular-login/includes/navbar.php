
<?php if (!$_SESSION['is_ajax_request']): ?>

<?php
include("database/connection.php");

if (isset($_SESSION['rol_usuario'])) {
    $queryRoles = "SELECT permiso.*, rol_permiso.cod_rol AS cod_rol FROM permiso JOIN rol_permiso ON permiso.cod_permiso = rol_permiso.cod_permiso WHERE rol_permiso.cod_rol =".$_SESSION['rol_usuario'];
    $resultRoles = mysqli_query($connection, $queryRoles);

    // Inicializar un array para almacenar los cod_permiso
    $codPermisoArray = array();

    // Recorrer los resultados y almacenar los cod_permiso en el array
    while ($row = mysqli_fetch_assoc($resultRoles)) {
        $codPermisoArray[] = $row['cod_permiso'];
    }
}
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
        <div class="container-fluid">
        <button onclick="cambiarTema()" class="btn rounded-fill"><i id="d1-icon" class="bi bi-moon-fill"></i></button>
            <a class="navbar-brand" href="#"><span><strong>Retroalimentación Ciudadana</strong></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
            if (isset($_SESSION["rut_usuario"]) && $_SESSION["rol_usuario"] == 2) {
            ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'tickets') !== false) ? 'active' : null ?>" href="index.php?p=tickets/index">Mis tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'tickets_publicos') !== false) ? 'active' : null ?>" href="index.php?p=tickets_publicos/index">Tickets Públicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'users') !== false) ? 'active' : null ?>" href="index.php?p=users/index">Calendario de Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'calificacion') !== false) ? 'active' : null ?>" href="index.php?p=calificacion/index">Calificacion Sistema</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" hidden href="">Mapa de estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" hidden href="#">Archivo de Tickets</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="index.php?p=auth/profile" class="btn btn-sm btn-outline-primary me-2">Perfil</a>
                    <a href="pages/auth/actions/logout.php" class="btn btn-sm btn-outline-danger">Cerrar Sesión</a>
                </div>
                <!-- <a href="pages/auth/actions/logout.php">Cerrar Sesión</a> -->
            <?php
            } elseif (isset($_SESSION["rut_usuario"]) && $_SESSION["rol_usuario"] == 1) {
            ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'tickets') !== false) ? 'active' : null ?>" href="index.php?p=tickets/index">Archivo de Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'users') !== false) ? 'active' : null ?>" href="index.php?p=users/index">Calendario de Proyectos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mantenedores</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'departamento') !== false) ? 'active' : null ?>" href="index.php?p=departamentos/index">Departamentos</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'municipalidad') !== false) ? 'active' : null ?>" href="index.php?p=municipalidades/index">Municipalidad</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'comuna') !== false) ? 'active' : null ?>" href="index.php?p=comuna/index">Comuna</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'region') !== false) ? 'active' : null ?>" href="index.php?p=region/index">Región</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'roles') !== false) ? 'active' : null ?>" href="index.php?p=roles/index">Roles</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'proyectos') !== false) ? 'active' : null ?>" href="index.php?p=proyectos/index">Proyectos</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'estado') !== false) ? 'active' : null ?>" href="index.php?p=estado/index">Estados Ticket</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'palabrasofensivas') !== false) ? 'active' : null ?>" href="index.php?p=palabrasofensivas/index">Palabras Ofensivas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'estadisticas') !== false) ? 'active' : null ?>" href="index.php?p=estadisticas/index">Estadisticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" hidden>Mapa de estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" hidden>Archivo de Tickets</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="index.php?p=auth/profile" class="btn btn-sm btn-outline-primary me-2">Perfil</a>
                    <a href="pages/auth/actions/logout.php" class="btn btn-sm btn-outline-danger">Cerrar Sesión</a>
                </div>
                <!-- <a href="pages/auth/actions/logout.php">Cerrar Sesión</a> -->
            <?php
            } else {
            ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'tickets_publicos') !== false) ? 'active' : null ?>" href="index.php?p=tickets_publicos/index">Tickets Públicos</a>
                    </li>
                    <?php if (isset($_SESSION["rol_usuario"])): ?>
                    <?php if (in_array(11,$codPermisoArray)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'tickets') !== false) ? 'active' : null ?>" href="index.php?p=tickets/index">Archivo de Tickets</a>
                        </li>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION["rol_usuario"])): ?>
                    <?php if (in_array(1,$codPermisoArray)): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mantenedores</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'departamento') !== false) ? 'active' : null ?>" href="index.php?p=departamentos/index">Departamentos</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'municipalidad') !== false) ? 'active' : null ?>" href="index.php?p=municipalidades/index">Municipalidad</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'comuna') !== false) ? 'active' : null ?>" href="index.php?p=comuna/index">Comuna</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'region') !== false) ? 'active' : null ?>" href="index.php?p=region/index">Región</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'roles') !== false) ? 'active' : null ?>" href="index.php?p=roles/index">Roles</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'proyectos') !== false) ? 'active' : null ?>" href="index.php?p=proyectos/index">Proyectos</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'estado') !== false) ? 'active' : null ?>" href="index.php?p=estado/index">Estados Ticket</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'palabrasofensivas') !== false) ? 'active' : null ?>" href="index.php?p=palabrasofensivas/index">Palabras Ofensivas</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>

                </ul>
                <?php if (!isset($_SESSION["rut_usuario"])): ?>
                <div class="d-flex">
                    <a href="index.php?p=auth/login" class="btn btn-sm btn-outline-primary me-2">Iniciar Sesión</a>
                    <a href="index.php?p=auth/register" class="btn btn-sm btn-outline-success">Registrarse</a>
                </div>
                <?php endif; ?>
                <?php if (isset($_SESSION["rut_usuario"])): ?>
                <div class="d-flex">
                    <a href="index.php?p=auth/profile" class="btn btn-sm btn-outline-primary me-2">Perfil</a>
                    <a href="pages/auth/actions/logout.php" class="btn btn-sm btn-outline-danger">Cerrar Sesión</a>
                </div>
                <?php endif; ?>
            <?php
            }
            ?>
        </div>
    </nav>


<?php endif; ?>
