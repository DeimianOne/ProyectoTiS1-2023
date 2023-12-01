<?php
include("database/connection.php");
include("database/auth.php");


error_log("La sesión 'rut_usuario' está establecida: " . (isset($_SESSION["rol_usuario"]) ? 'true' : 'false'), 0);

if (isset($_SESSION['mensaje'])) {
    ?>
    <div class="alert alert-<?php echo ($_SESSION['mensaje'] == 'Respuesta enviada correctamente.') ? 'success' : 'danger'; ?>"
        role="alert">
        <?php echo $_SESSION['mensaje']; ?>
    </div>
    <?php
    unset($_SESSION['mensaje']);
}


// Obtener el código del ticket desde la URL
$id = $_GET["cod_ticket"];

// Consulta para obtener la información del ticket
$query = "SELECT ticket.*, estado.cod_estado, estado.nombre_estado, departamento.nombre_departamento
FROM ticket
LEFT JOIN estado_ticket ON ticket.cod_ticket = estado_ticket.cod_ticket
LEFT JOIN estado ON estado_ticket.cod_estado = estado.cod_estado
LEFT JOIN departamento ON ticket.cod_departamento = departamento.cod_departamento 
WHERE ticket.cod_ticket=" . $id . ";";
$result = mysqli_query($connection, $query);

// Verificar si el ticket existe
if ($row = mysqli_fetch_assoc($result)) {
    $cod_ticket = $row["cod_ticket"];
    $cod_departamento = $row["cod_departamento"];
    $rut_usuario = $row["rut_usuario"];
    $tipo_solicitud = $row["tipo_solicitud"];
    $asunto_ticket = $row["asunto_ticket"];
    $detalles_solicitud = $row["detalles_solicitud"];
    $fecha_hora_envio = $row["fecha_hora_envio"];
    $visibilidad_solicitud = $row["visibilidad_solicitud"];
    $cod_estado = $row["cod_estado"];
    $nombre_estado = $row["nombre_estado"];
    $nombre_departamento = $row["nombre_departamento"];


    $queryRespuestas = "SELECT * FROM respuesta WHERE cod_ticket = " . $id . ";";
    $resultRespuestas = mysqli_query($connection, $queryRespuestas);

    $respuestas = array();
    if ($resultRespuestas) {
        // Itera sobre los resultados y almacena cada respuesta en el array
        while ($row = mysqli_fetch_assoc($resultRespuestas)) {
            $respuestas[] = $row;
        }
    } else {
        // Manejo de errores si la consulta falla
        echo "Error en la consulta de respuestas: " . mysqli_error($connection);
    }

    // Obtener los estados de solicitud
    $queryEstados = "SELECT * FROM estado";
    $resultEstados = mysqli_query($connection, $queryEstados);

    $estados = array();
    while ($filaEstado = mysqli_fetch_array($resultEstados)) {
        $estados[$filaEstado['cod_estado']] = $filaEstado['nombre_estado'];
    }

    // Obtener departamentos de solicitud
    $queryDepartamentos = "SELECT * FROM departamento";
    $resultDepartamentos = mysqli_query($connection, $queryDepartamentos);

    $departamentos = array();
    while ($filaDepartamento = mysqli_fetch_array($resultDepartamentos)) {
        $departamentos[$filaDepartamento['cod_departamento']] = $filaDepartamento['nombre_departamento'];
    }


    // Revisar si el usuario actualmente en sesion esta suscrito al ticket
    if (isset($_SESSION['rut_usuario'])){
        $querySuscripcion = "SELECT * FROM suscripcion WHERE rut_usuario = ".$_SESSION['rut_usuario']." AND cod_ticket = ".$cod_ticket;
        $resultSuscripcion = mysqli_query($connection, $querySuscripcion);
    
    
        if ($row = mysqli_fetch_assoc($resultSuscripcion)) {
            $suscripcion = true;
        } else {
            $suscripcion = false;
        }
    } else {
        $suscripcion = false;
    }


} else {
    // Si el ticket no existe, redirigir al índice
    echo '<script>window.location.href = "index.php?p=home";</script>';
    exit(); // Asegurar que el script se detenga después de redirigir
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Vista de Ticket</h2>
    </div>
</div>

<main class="container mt-5">
    <!-- Detalles del Ticket -->
    <div class="card">
        <div class="card-header">
            <h3>Detalles</h3>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Codigo de Seguimiento:
                    <?php echo $id; ?>
                </strong>
            </p>
            <p class="text-muted mb-0">Solicitud:
                <?php echo ucfirst($tipo_solicitud); ?>
            </p>
            <p class="text-muted mb-0">Estado:
                <?php echo ucfirst($nombre_estado); ?>
            </p>
            <p class="text-muted mb-0">Departamento:
                <?php echo ucfirst($nombre_departamento); ?>
            </p>
            
            <?php if (isset($_SESSION["rol_usuario"])): ?>
            <?php if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?>
                <p class="text-muted mb-0">Visibilidad:
                    <?= $visibilidad_solicitud ? "Público" : "Privado" ?>
                </p>
            <?php endif; ?>
            <?php endif; ?>
            <br>
            <p class="text-muted mb-0 fw-bold">Datos del Remitente</p>
            <?php
            $queryUsuario = "SELECT * FROM usuario WHERE rut_usuario = '" . $rut_usuario . "'";
            $resultUsuario = mysqli_query($connection, $queryUsuario);
            $usuario = mysqli_fetch_assoc($resultUsuario);
            echo '<p class="text-muted mb-0">Nombre: ' . $usuario['nombre_usuario'] . '</p>';
            echo '<p class="text-muted mb-0">Rut: ' . $rut_usuario . '</p>';
            echo '<p class="text-muted mb-0">Correo: ' . $usuario['correo_electronico_usuario'] . '</p>';
            ?>
            <hr>

            <p class="card-title"><strong>Asunto:</strong>
                <?php echo $asunto_ticket; ?>
            </p>
            <p class="card-text">
                <?php echo $detalles_solicitud; ?>
            </p>
            <p class="text-muted mb-0 fw-bold">Fecha y Hora de Envío:
                <?php echo $fecha_hora_envio; ?>
            </p>
            <?php if (isset($_SESSION["rol_usuario"]) && $cod_estado != 2): ?>
            <?php if ($_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?>
                <hr>
                <?php if ($_SESSION['rol_usuario'] == '1' || in_array(6,$codPermisoArray) || in_array(7,$codPermisoArray)): ?>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-cod-ticket="<?= $cod_ticket ?>">Modificar Detalles
                </button>
                <?php endif;?>
                <?php if ($_SESSION['rol_usuario'] == '1' || in_array(8,$codPermisoArray)): ?>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2"
                    data-cod-ticket="<?= $cod_ticket ?>">Derivar a otro Departamento
                </button>
                <?php endif;?>
                <?php if ($_SESSION['rol_usuario'] == '1' || in_array(12,$codPermisoArray)): ?>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#warningModal"
                    data-cod-ticket="<?= $cod_ticket ?>">Cerrar Ticket
                </button>
                <?php endif;?>
            <!-- SUSCRIBIRSE PARA RECIBIR NOTIFICACIONES -->
            <?php else: ?>
                <?php if ($_SESSION['rut_usuario'] != $rut_usuario && !in_array(11,$codPermisoArray)): ?>
                    <?php if (!$suscripcion): ?>
                    <hr>

                    <form action="pages/tickets/actions/suscripcion.php" method="POST">
                        <input type="hidden" name="suscripcion" value="<?php echo $suscripcion; ?>">
                        <input type="hidden" name="rut_usuario" value="<?php echo $_SESSION['rut_usuario']; ?>">
                        <input type="hidden" name="cod_ticket" value="<?php echo $cod_ticket; ?>">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Recibir Notificaciones
                        </button>
                    </form>

                    <div id="descripcion_modal_help" class="form-text">Si desea recibir notificaciones, se le notificará mediante correo electrónico cada vez que se actualice este ticket.</div>

                    <?php else: ?>
                    <hr>

                    <form action="pages/tickets/actions/suscripcion.php" method="POST">
                        <input type="hidden" name="suscripcion" value="<?php echo $suscripcion; ?>">
                        <input type="hidden" name="rut_usuario" value="<?php echo $_SESSION['rut_usuario']; ?>">
                        <input type="hidden" name="cod_ticket" value="<?php echo $cod_ticket; ?>">
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            Dejar de Recibir Notificaciones
                        </button>
                    </form>
                    <div id="descripcion_modal_help" class="form-text">Actualmente está recibiendo notificaciones. Se le notificará mediante correo electrónico cada vez que se actualice este ticket.</div>

                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Detalles de las respuestas -->
    <?php if (isset($_SESSION['rol_usuario'])): ?>
    <?php if (!empty($respuestas) || $_SESSION['rol_usuario'] == '1' || in_array(11,$codPermisoArray)): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h3>Respuestas</h3>
            </div>
            <div class="card-body">
                <?php
                // Itera sobre cada respuesta y muestra los detalles
                foreach ($respuestas as $key => $respuesta) {
                    echo '<div class="respuesta">';
                    $queryUsuarios = "SELECT * FROM usuario WHERE rut_usuario = '" . $respuesta['rut_usuario'] . "'";
                    $resultUsuarios = mysqli_query($connection, $queryUsuarios);
                    $usuario = mysqli_fetch_assoc($resultUsuarios);
                    echo '<p class="text-muted mb-0">Remitente: ' . $usuario['nombre_usuario'] . '</p>';
                    echo '<p class="text-muted mb-0">' . $usuario['correo_electronico_usuario'] . '</p>';
                    echo '<br>';
                    echo '<p><strong>Detalles:</strong> ' . $respuesta['detalles_respuesta'] . '</p>';
                    echo '<p class="text-muted mb-0 fw-bold">' . $respuesta['fecha_hora_envio'] . '</p>';
                    if ($key != array_key_last($respuestas)) {
                        echo '<hr>';
                    }
                    echo '</div>';
                }
                ?>

                <!-- ESCRIBIR RESPUESTAS -->
                <?php if (isset($_SESSION["rol_usuario"]) && $cod_estado != 2): ?>
                <?php if ($_SESSION['rol_usuario'] == '1' || in_array(5,$codPermisoArray)): ?>
                    <?php if (!empty($respuestas)): ?>
                        <hr>
                    <?php endif; ?>
                    <form id="respuestaForm" action="pages/tickets/actions/store_respuesta.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="detalles_respuesta" class="form-label">Escribir Nueva Respuesta:</label>
                                    <textarea class="form-control" id="detalles_respuesta" name="detalles_respuesta"
                                        required></textarea>
                                </div>

                                <?php if ($_SESSION['rol_usuario'] == '1' || in_array(6,$codPermisoArray)): ?>
                                <div class="col-md-4 mb-3">
                                    <label for="cod_estado" class="form-label">Cambiar Estado:</label>
                                    <select class="form-select" id="cod_estado" name="cod_estado">
                                        <?php foreach ($estados as $codEstado => $nombreEstado): ?>
                                            <?php if ($codEstado != 2 && $codEstado != 3): ?>
                                            <option value="<?= $codEstado ?>" <?php echo ($codEstado == $cod_estado) ? 'selected' : ''; ?>>
                                                <?= $nombreEstado ?>
                                            </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php endif; ?>

                                <input type="hidden" name="cod_ticket" value="<?= $cod_ticket ?>">
                                
                                <?php if ($_SESSION['rol_usuario'] == '1' || (in_array(5,$codPermisoArray))): ?>
                                <div>
                                    <div>
                                        <button type="submit" id="btnEnviarRespuesta" class="btn btn-sm btn-success" role="button" disabled>Enviar Respuesta</button>
                                    </div>

                                    <?php if ($_SESSION['rol_usuario'] == '1' || in_array(12,$codPermisoArray)): ?>
                                    <br>
                                    <div>
                                        <button type="button" id="btnEnviarRespuestaCerrar" class="btn btn-sm btn-danger" role="button" disabled data-bs-toggle="modal" data-bs-target="#warningModalResponder">
                                            Enviar Respuesta y Cerrar Ticket
                                        </button>
                                        <div id="descripcion_modal_help" class="form-text">Se enviará la respuesta, pero el estado elegido se ignorará y se pondrá en estado cerrado.</div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                

                            </div>
                        </div>
                    </form>
                <?php endif; ?>
                <?php endif; ?>


            </div>
        </div>
    <?php endif; ?>
    <!-- SI NO HAY SESION INICIADA SIMPLEMENTE MUESTRA LAS RESPUESTAS -->
    <?php else: ?>
    <?php if (!empty($respuestas)): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h3>Respuestas</h3>
            </div>
            <div class="card-body">
                <?php
                // Itera sobre cada respuesta y muestra los detalles
                foreach ($respuestas as $key => $respuesta) {
                    echo '<div class="respuesta">';
                    $queryUsuarios = "SELECT * FROM usuario WHERE rut_usuario = '" . $respuesta['rut_usuario'] . "'";
                    $resultUsuarios = mysqli_query($connection, $queryUsuarios);
                    $usuario = mysqli_fetch_assoc($resultUsuarios);
                    echo '<p class="text-muted mb-0">Remitente: ' . $usuario['nombre_usuario'] . '</p>';
                    echo '<p class="text-muted mb-0">' . $usuario['correo_electronico_usuario'] . '</p>';
                    echo '<br>';
                    echo '<p><strong>Detalles:</strong> ' . $respuesta['detalles_respuesta'] . '</p>';
                    echo '<p class="text-muted mb-0 fw-bold">' . $respuesta['fecha_hora_envio'] . '</p>';
                    if ($key != array_key_last($respuestas)) {
                        echo '<hr>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    <?php endif; ?>
    <?php endif; ?>

    <!-- Warning Modal -->
    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white text-center">
                    <h1 class="modal-title fs-5" id="warningModalLabel">
                        Advertencia
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p><strong>¿Seguro que deseas cerrar el ticket?</strong> <br> Esto pondrá el ticket en estado <strong>Cerrado</strong> y no se podrán realizar más modificaciones ni respuestas.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No Cerrar Ticket</button>
                    <button type="button" class="btn btn-danger" id="cerrarRespuesta">Deseo Cerrar el Ticket</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Modal Responder -->
    <div class="modal fade" id="warningModalResponder" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white text-center">
                    <h1 class="modal-title fs-5" id="warningModalLabel">
                        Advertencia
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p><strong>¿Seguro que deseas responder y cerrar el ticket?</strong> <br> Se enviará la respuesta, pero el estado elegido se ignorará y se cambiará el estado del ticket a <strong>Cerrado</strong>. <br> No se podrán realizar más modificaciones ni respuestas.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmRespuestaCerrar">Deseo Responder y Cerrar el Ticket</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modificar Detalles -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p><strong>Código de Ticket: <span>
                            <?php echo $id; ?>
                        </span></strong></p>
                    <div id="detalleTicket"></div>
                    

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault"
                        <?php if (!$_SESSION['rol_usuario'] == '1' && !in_array(7,$codPermisoArray)): ?>
                            hidden
                        <?php endif;?>
                        >Público</label>
                    </div>

                    <div class="mb-3"
                    <?php if (!$_SESSION['rol_usuario'] == '1' && !in_array(6,$codPermisoArray)): ?>
                        hidden
                    <?php endif;?>>
                        <label for="estadoDropdown" class="form-label">Estado</label>
                        <select class="form-select" id="estadoDropdown">
                            <?php
                            foreach ($estados as $id_estado => $n_estado) {
                                if ($id_estado != 2 && $id_estado != 3) {
                                    echo "<option value='$id_estado'>$n_estado</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardarCambiosBtn" data-bs-dismiss="modal">Guardar
                        cambios</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal Derivar a Departamento -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Código de Ticket: <span>
                            <?php echo $id; ?>
                        </span></strong></p>
                    <div id="detalleTicket"></div>
                    <div class="mb-3">
                        <label for="departamentoDropdown" class="form-label">Seleccione Departamento a Derivar</label>
                        <select class="form-select" id="departamentoDropdown">
                            <?php
                            foreach ($departamentos as $id_departamento => $n_departamento) {
                                echo "<option value='$id_departamento'>$n_departamento</option>";
                            }
                            ?>
                        </select>
                        <div id="descripcion_modal_help" class="form-text">Los tickets derivados cambian automaticamente su estado a "Remitido".</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="derivar" data-bs-dismiss="modal">Derivar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- TIMELINE -->
    <div class="card mt-3">
        <div class="card-header">
            <h3>Seguimiento</h3>
        </div>
    </div>
    <?php
    // Consulta para obtener todas las entradas asociadas al ticket ordenadas por fecha_hora_registro
    $query_entradas = "SELECT registro_ticket.*, estado.nombre_estado, departamento.nombre_departamento
        FROM registro_ticket
        LEFT JOIN estado ON registro_ticket.cod_estado = estado.cod_estado
        LEFT JOIN departamento ON registro_ticket.cod_departamento = departamento.cod_departamento
        WHERE cod_ticket=" . $id . " ORDER BY fecha_hora_registro;";
    $result_entradas = mysqli_query($connection, $query_entradas);

    // Imprimir el timeline
    echo '<section class="py-5"><ul class="timeline">';

    $first_entry = true;
    $new_item = true;
    $prev_values = array(); // Almacena los valores anteriores para comparación
    $prev_fecha = null; // Almacena la fecha anterior
    
    while ($row_entrada = mysqli_fetch_assoc($result_entradas)) {
        $fecha_hora_registro = $row_entrada["fecha_hora_registro"];
        $dia = date("d", strtotime($fecha_hora_registro));
        $meses = array(
            null,
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre'
        );
        $mes = $meses[date("m", strtotime($fecha_hora_registro))];
        $año = date("Y", strtotime($fecha_hora_registro));
        $fecha = "$dia " . ucfirst($mes) . " $año";
        $hora = date("H:i:s", strtotime($fecha_hora_registro));

        // Obtener valores actuales
        $current_values = array(
            "estado" => $row_entrada["nombre_estado"],
            "respuesta" => $row_entrada["cod_respuesta"],
            "remitido" => $row_entrada["nombre_departamento"],
            "visibilidad" => ($row_entrada["visibilidad_solicitud"]) ? "Público" : "Privado"
            // Añadir más columnas según sea necesario
        );

        // Mostrar el subtítulo solo para la primera entrada
        $subtitulo = ($first_entry) ? " - Creación del Ticket" : "";

        // Verificar si la fecha es la misma que la anterior
        if ($fecha === $prev_fecha) {
            // Agregar la información a la entrada anterior
            echo '<p class="text-muted mb-0 fw-bold">' . $hora . '</p>';

            if (!empty($current_values["respuesta"])) {
                echo '<p class="text-muted mb-0">Ticket Respondido</p>';
            }

            foreach ($current_values as $column => $value) {
                if (!isset($prev_values[$column]) || $prev_values[$column] !== $value) {
                    if ($column != 'respuesta') {
                        echo '<p class="text-muted mb-0">' . ucfirst($column) . ': ' . $value . '</p>';
                    }
                }
            }
        } else {

            if (!$new_item) {
                echo '</li>';
                $new_item = true;
            }
            $new_item = false;

            // Imprimir una nueva entrada
            echo '<li class="timeline-item mb-5">
                <h5 class="fw-bold">' . $fecha . '</h5>
                <p class="text-muted mb-0 fw-bold">' . $hora . '' . $subtitulo . '</p>';

            if (!empty($current_values["respuesta"])) {
                echo '<p class="text-muted mb-0">Respondido</p>';
            }

            if ($first_entry) {
                // Imprimir la primera entrada del timeline
                echo '<p class="text-muted mb-0">' . ucfirst("estado") . ': ' . $current_values["estado"] . '</p>';

            } else {
                foreach ($current_values as $column => $value) {
                    if (!isset($prev_values[$column]) || $prev_values[$column] !== $value) {
                        if ($column != 'respuesta') {
                            echo '<p class="text-muted mb-0">' . ucfirst($column) . ': ' . $value . '</p>';
                        }
                    }
                }
            }
        }
        $first_entry = false;

        // Guardar la fecha y los valores actuales como valores previos para la próxima iteración
        $prev_fecha = $fecha;
        $prev_values = $current_values;
    }
    if ($cod_estado == 2) {
        echo '<p class="text-muted mb-0 fw-bold">Ticket Cerrado</p>';
    }

    echo '</ul></section>';
    ?>
    </div>

</main>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Seleccionar el área de texto y el botón
        var detallesSolicitud = document.getElementById("detalles_respuesta");
        var btnEnviarRespuesta = document.getElementById("btnEnviarRespuesta");
        var btnEnviarRespuestaCerrar = document.getElementById("btnEnviarRespuestaCerrar");

        // Agregar un evento de entrada al área de texto
        detallesSolicitud.addEventListener("input", function () {
            // Habilitar el botón si el área de texto tiene contenido, de lo contrario, deshabilitarlo
            btnEnviarRespuesta.disabled = detallesSolicitud.value.trim() === "";
            btnEnviarRespuestaCerrar.disabled = detallesSolicitud.value.trim() === "";
        });
    });
</script>

<script>
    $(document).ready(function () {


        $('#confirmRespuestaCerrar').on('click', function () {
            $('#cod_estado').val(2);
            $('form#respuestaForm').submit();
        });

        // Variables para almacenar los valores iniciales
        var checkboxInicial, estadoInicial, departamentoInicial;

        // Al abrir el modal 1
        $("#exampleModal").on("show.bs.modal", function () {
            // Establecer las opciones predeterminadas al abrir el modal
            $("#flexCheckDefault").prop("checked", <?php echo $visibilidad_solicitud ? 'true' : 'false'; ?>);
            $("#estadoDropdown").val(<?php echo $cod_estado; ?>);
            $("#departamentoDropdown").val(<?php echo $cod_departamento; ?>);

            // Actualizar los valores iniciales
            checkboxInicial = $("#flexCheckDefault").prop("checked");
            estadoInicial = $("#estadoDropdown").val();
            departamentoInicial = $("#departamentoDropdown").val();

            // Deshabilitar el botón "Guardar cambios" inicialmente
            $("#guardarCambiosBtn").prop("disabled", true);
        });

        // Al abrir el modal 2
        $("#exampleModal2").on("show.bs.modal", function () {
            // Establecer las opciones predeterminadas al abrir el modal
            $("#flexCheckDefault").prop("checked", <?php echo $visibilidad_solicitud ? 'true' : 'false'; ?>);
            $("#estadoDropdown").val(<?php echo $cod_estado; ?>);
            $("#departamentoDropdown").val(<?php echo $cod_departamento; ?>);

            // Actualizar los valores iniciales
            checkboxInicial = $("#flexCheckDefault").prop("checked");
            estadoInicial = $("#estadoDropdown").val();
            departamentoInicial = $("#departamentoDropdown").val();

            // Deshabilitar el botón "Guardar cambios" inicialmente
            $("#derivar").prop("disabled", true);
        });

        // Al cambiar el estado del checkbox o los dropdowns
        $(".form-check-input, .form-select").change(function () {
            // Obtener los valores actuales
            var checkboxActual = $("#flexCheckDefault").prop("checked");
            var estadoActual = $("#estadoDropdown").val();
            var departamentoActual = $("#departamentoDropdown").val();

            // Habilitar o deshabilitar el botón según si hay cambios
            $("#guardarCambiosBtn").prop("disabled", checkboxActual === checkboxInicial && estadoActual === estadoInicial && departamentoActual === departamentoInicial);
            $("#derivar").prop("disabled", checkboxActual === checkboxInicial && estadoActual === estadoInicial && departamentoActual === departamentoInicial);
        });

        // Boton de modificar detalles
        $("#guardarCambiosBtn").click(function () {

            var checkboxValue = $("#flexCheckDefault").is(":checked") ? 1 : 0;
            var ticketId = "<?php echo $id; ?>";
            var estadoSeleccionado = $("#estadoDropdown").val();
            var departamentoSeleccionado = $("#departamentoDropdown").val();

            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "pages/tickets/actions/modificar_ticket.php",
                data: {
                    id: ticketId,
                    visibilidad_solicitud: checkboxValue,
                    cod_estado: estadoSeleccionado,
                    cod_departamento: departamentoSeleccionado
                },
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    console.log(response);
                    // Actualizar la página
                    location.reload();
                },
                error: function (error) {
                    // Manejar errores si es necesario
                    console.error("Error en la solicitud AJAX: ", error);
                }
            });
        });

        // Boton de derivar
        $("#derivar").click(function () {

            var checkboxValue = "<?php echo $visibilidad_solicitud; ?>";
            var ticketId = "<?php echo $id; ?>";
            var estadoSeleccionado = 3
            var departamentoSeleccionado = $("#departamentoDropdown").val();

            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "pages/tickets/actions/modificar_ticket.php",
                data: {
                    id: ticketId,
                    visibilidad_solicitud: checkboxValue,
                    cod_estado: estadoSeleccionado,
                    cod_departamento: departamentoSeleccionado
                },
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    console.log(response);
                    // Actualizar la página
                    location.reload();
                },
                error: function (error) {
                    // Manejar errores si es necesario
                    console.error("Error en la solicitud AJAX: ", error);
                }
            });
        });

        // Boton de cerrar
        $("#cerrarRespuesta").click(function () {

            var checkboxValue = "<?php echo $visibilidad_solicitud; ?>";
            var ticketId = "<?php echo $id; ?>";
            var estadoSeleccionado = 2
            var departamentoSeleccionado = "<?php echo $cod_departamento; ?>";

            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "pages/tickets/actions/modificar_ticket.php",
                data: {
                    id: ticketId,
                    visibilidad_solicitud: checkboxValue,
                    cod_estado: estadoSeleccionado,
                    cod_departamento: departamentoSeleccionado
                },
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    console.log(response);
                    // Actualizar la página
                    location.reload();
                },
                error: function (error) {
                    // Manejar errores si es necesario
                    console.error("Error en la solicitud AJAX: ", error);
                }
            });
        });
        

    });
</script>