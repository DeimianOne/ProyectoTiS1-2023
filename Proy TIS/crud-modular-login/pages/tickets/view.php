<?php
include("database/connection.php");
include("database/auth.php");

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


} else {
    // Si el ticket no existe, redirigir al índice
    header("Location: index.php?p=brands/index");
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
            <h3>Detalles del Ticket</h3>
        </div>
        <div class="card-body">
            <p class="text-muted mb-0">Solicitud:
                <?php echo ucfirst($tipo_solicitud); ?>
            </p>
            <p class="text-muted mb-0">Estado:
                <?php echo ucfirst($nombre_estado); ?>
            </p>
            <p class="text-muted mb-0">Departamento:
                <?php echo ucfirst($nombre_departamento); ?>
            </p>
            <?php if ($_SESSION['rol_usuario'] == '1'): ?>
            <p class="text-muted mb-0">Visibilidad:
                <?= $visibilidad_solicitud ? "Público" : "Privado" ?>
            </p>
            <?php endif; ?>
            <br>
            <p class="text-muted mb-0 fw-bold">Datos del Remitente</p>
            <?php
            $queryUsuario = "SELECT * FROM usuario WHERE rut_usuario = '" . $rut_usuario . "'";
            $resultUsuario = mysqli_query($connection, $queryUsuario);
            echo '<p class="text-muted mb-0">Nombre: ' . mysqli_fetch_assoc($resultUsuario)['nombre_usuario'] . '</p>';
            ?>
            <p class="text-muted mb-0">Rut:
                <?php echo $rut_usuario; ?>
            </p>
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
        </div>
    </div>

    <!-- Detalles de las respuestas -->
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
                    echo '<p class="text-muted mb-0">Remitente: ' . mysqli_fetch_assoc($resultUsuarios)['nombre_usuario'] . '</p>';
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


    <!-- RESPONDER Ticket, solo lo ve rol 1 -->
    <?php if ($_SESSION['rol_usuario'] == '1'): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h3>Responder Ticket</h3>
            </div>
            <form action="pages/tickets/actions/store_respuesta.php" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="detalles_respuesta" class="form-label">Detalles de Respuesta:</label>
                            <textarea class="form-control" id="detalles_respuesta" name="detalles_respuesta"
                                required></textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="cod_estado" class="form-label">Cambiar Estado:</label>
                            <select class="form-select" id="cod_estado" name="cod_estado">
                                <?php foreach ($estados as $codEstado => $nombreEstado): ?>
                                    <!-- @formatter:off -->
                                    <option value="<?= $codEstado ?>" <?php echo ($codEstado == $cod_estado) ? 'selected' : ''; ?>>
                                        <?= $nombreEstado ?>
                                    </option>
                                    <!-- @formatter:on -->
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <input type="hidden" name="cod_ticket" value="<?= $cod_ticket ?>">

                        <div>
                            <button type="submit" id="btnEnviarRespuesta" class="btn btn-sm btn-success" role="button"
                                disabled>Enviar Respuesta</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php endif; ?>


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

    echo '</ul></section>';
    ?>
    </div>

</main>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Seleccionar el área de texto y el botón
        var detallesSolicitud = document.getElementById("detalles_respuesta");
        var btnEnviarRespuesta = document.getElementById("btnEnviarRespuesta");

        // Agregar un evento de entrada al área de texto
        detallesSolicitud.addEventListener("input", function () {
            // Habilitar el botón si el área de texto tiene contenido, de lo contrario, deshabilitarlo
            btnEnviarRespuesta.disabled = detallesSolicitud.value.trim() === "";
        });
    });
</script>