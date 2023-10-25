<<<<<<< HEAD
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><span><strong>Retroalimentación Ciudadana</strong></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <?php
            if (isset($_SESSION["username"])) {
            ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'brands') !== false) ? 'active' : null ?>" href="index.php?p=brands/index">Mis tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'region') !== false) ? 'active' : null ?>" href="index.php?p=region/index">Regiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'comuna') !== false) ? 'active' : null ?>" href="index.php?p=comuna/index">Comunas</a>
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
            } else {
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
=======
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
                        <a class="nav-link <?php echo (strpos($pagina, 'brands') !== false) ? 'active' : null ?>" href="index.php?p=brands/index">Mis tickets</a>
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
                        <a class="nav-link <?php echo (strpos($pagina, 'brands') !== false) ? 'active' : null ?>" href="index.php?p=brands/index">Mis tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'users') !== false) ? 'active' : null ?>" href="index.php?p=users/index">Calendario de Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'municipalidad') !== false) ? 'active' : null ?>" href="index.php?p=municipalidades/index">Insertar Municipalidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'departamento') !== false) ? 'active' : null ?>" href="index.php?p=departamentos/index">Insertar Depa</a>
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
>>>>>>> felipe-arrans
</nav>