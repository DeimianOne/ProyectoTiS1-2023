<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><span><strong>Retroalimentación Ciudadana</strong></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <?php
            if (isset($_SESSION["rut_usuario"]) && $_SESSION["rol_usuario"] == 2 ) {
            ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'tickets') !== false) ? 'active' : null ?>" href="index.php?p=tickets/index">Mis tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'users') !== false) ? 'active' : null ?>" href="index.php?p=users/index">Calendario de Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Mapa de estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Archivo de Tickets</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="index.php?p=auth/profile" class="btn btn-sm btn-outline-primary me-2">Perfil</a>
                    <a href="pages/auth/actions/logout.php" class="btn btn-sm btn-outline-danger">Cerrar Sesión</a>
                </div>
                <!-- <a href="pages/auth/actions/logout.php">Cerrar Sesión</a> -->
            <?php
            } elseif( isset($_SESSION["rut_usuario"]) && $_SESSION["rol_usuario"] == 1 ){
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'tickets') !== false) ? 'active' : null ?>" href="index.php?p=tickets/index">Tickets Asignados a mí</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'users') !== false) ? 'active' : null ?>" href="index.php?p=users/index">Calendario de Proyectos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mantenedores</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'estado') !== false) ? 'active' : null ?>" href="index.php?p=estado/index">Estados Ticket</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'departamento') !== false) ? 'active' : null ?>" href="index.php?p=departamentos/index">Departamentos</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'municipalidad') !== false) ? 'active' : null ?>" href="index.php?p=municipalidades/index">Municipalidad</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'direccion') !== false) ? 'active' : null ?>" href="index.php?p=direccion/index">Dirección</a>
                            </li>
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
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'permiso') !== false) ? 'active' : null ?>" href="index.php?p=permiso/index">Permisos</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item <?php echo (strpos($pagina, 'proyectos') !== false) ? 'active' : null ?>" href="index.php?p=proyectos/index">Proyectos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Mapa de estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Archivo de Tickets</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="index.php?p=auth/profile" class="btn btn-sm btn-outline-primary me-2">Perfil</a>
                    <a href="pages/auth/actions/logout.php" class="btn btn-sm btn-outline-danger">Cerrar Sesión</a>
                </div>
                <!-- <a href="pages/auth/actions/logout.php">Cerrar Sesión</a> -->
            <?php
            }
            
            
            else {
            ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="index.php?p=auth/login" class="btn btn-sm btn-outline-primary me-2">Iniciar Sesión</a>
                    <a href="index.php?p=auth/register" class="btn btn-sm btn-outline-success">Registrarse</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</nav>