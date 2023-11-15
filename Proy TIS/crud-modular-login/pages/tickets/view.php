<?php
include("database/connection.php");
include("database/auth.php");

// Obtener el código del ticket desde la URL
$id = $_GET["cod_ticket"];

// Consulta para obtener la información del ticket
$query = "SELECT * FROM ticket WHERE cod_ticket=" . $id . ";";
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
} else {
    // Si el ticket no existe, redirigir al índice
    header("Location: index.php?p=brands/index");
    exit(); // Asegurar que el script se detenga después de redirigir
}
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Formulario de edición</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Detalles del Ticket</h3>
        </div>
        <div class="card-body">
            <h4 class="card-title">Asunto:
                <?php echo $asunto_ticket; ?>
            </h4>
            <h5 class="card-title">Tipo de Solicitud:
                <?php echo $tipo_solicitud; ?>
            </h5>
            <p class="card-text">Detalles:
                <?php echo $detalles_solicitud; ?>
            </p>
            <p class="card-text">Fecha y Hora de Envío:
                <?php echo $fecha_hora_envio; ?>
            </p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h3>Seguimiento</h3>
        </div>
    </div>

    <!-- TIMELINE -->
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
        $hora = date("H:i", strtotime($fecha_hora_registro));

        // Obtener valores actuales
        $current_values = array(
            "estado" => $row_entrada["nombre_estado"],
            "remitido" => $row_entrada["nombre_departamento"],
            "visibilidad" => ($row_entrada["visibilidad_solicitud"]) ? "Privado" : "Público"
            // Añadir más columnas según sea necesario
        );

        // Mostrar el subtítulo solo para la primera entrada
        $subtitulo = ($first_entry) ? " - Creación del Ticket" : "";

        // Verificar si la fecha es la misma que la anterior
        if ($fecha === $prev_fecha) {
            // Agregar la información a la entrada anterior
            echo '<p class="text-muted mb-0 fw-bold">' . $hora . '</p>';

            foreach ($current_values as $column => $value) {
                if (!isset($prev_values[$column]) || $prev_values[$column] !== $value) {
                    echo '<p class="text-muted mb-0">' . ucfirst($column) . ': ' . $value . '</p>';
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

            if ($first_entry) {
                // Imprimir la primera entrada del timeline
                echo '<p class="text-muted mb-0">' . ucfirst("estado") . ': ' . $current_values["estado"] . '</p>';

            } else {
                foreach ($current_values as $column => $value) {
                    if (!isset($prev_values[$column]) || $prev_values[$column] !== $value) {
                        echo '<p class="text-muted mb-0">' . ucfirst($column) . ': ' . $value . '</p>';
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