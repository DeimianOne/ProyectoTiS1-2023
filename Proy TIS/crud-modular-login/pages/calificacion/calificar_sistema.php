<?php
include("database/auth.php");
include("database/connection.php");  // Incluye la conexión

$cod_ticket = $_GET["cod_ticketx"];
$query = "  SELECT * 
                FROM ticket 
                left join respuesta on (ticket.cod_ticket = respuesta.cod_ticket)
                WHERE ticket.cod_ticket=" . $cod_ticket . ";";
$result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Calificar sistema</h2>
    </div>
</div>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="container my-3 mx-3">

                        <div class="d-flex justify-content-start">
                            <div class="col-md-12 mb-3 d-flex justify-content-start">
                                <?php
                                while ($fila = mysqli_fetch_array($result)): ?>
                                    <div style="text-align: justify;">
                                        <span>
                                            <h4>En relación al ticket N°:
                                                <?= $fila['cod_ticket'] ?>
                                            </h4>
                                        </span>
                                        <div>
                                            <h4>Asunto:
                                                <?= $fila['asunto_ticket'] ?>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <div>
                            <form action="pages/calificacion/actions/storeCalificacionSis.php" method="POST">
                                <div style="text-align: justify;">
                                    <span>
                                        <h4>Califique la facilidad del sistema para ofrecer retroalimentación.</h4>
                                    </span>
                                </div>

                                <input type="hidden" name="cod_ticket" value="<?= $cod_ticket ?>" />

                                <div class="rating my-3 col-md-7">
                                    <input type="radio" id="star5" name="calificacion_sistema" value="5" /> <label
                                        class="full" for="star5" title="Excelente - 5 stars"></label>
                                    <input type="radio" id="star4half" name="calificacion_sistema" value="4 y medio" />
                                    <label class="half" for="star4half" title="Muy Buena - 4.5 stars"></label>
                                    <input type="radio" id="star4" name="calificacion_sistema" value="4" /> <label
                                        class="full" for="star4" title="Buena - 4 stars"></label>
                                    <input type="radio" id="star3half" name="calificacion_sistema" value="3 y medio" />
                                    <label class="half" for="star3half" title="Sobresaliente - 3.5 stars"></label>
                                    <input type="radio" id="star3" name="calificacion_sistema" value="3" /> <label
                                        class="full" for="star3" title="Aceptable - 3 stars"></label>
                                    <input type="radio" id="star2half" name="calificacion_sistema" value="2 y medio" />
                                    <label class="half" for="star2half" title="Regular - 2.5 stars"></label>
                                    <input type="radio" id="star2" name="calificacion_sistema" value="2" /> <label
                                        class="full" for="star2" title="Deficiente - 2 stars"></label>
                                    <input type="radio" id="star1half" name="calificacion_sistema" value="1 y medio" />
                                    <label class="half" for="star1half" title="Mala - 1.5 stars"></label>
                                    <input type="radio" id="star1" name="calificacion_sistema" value="1" /> <label
                                        class="full" for="star1" title="Muy mala - 1 star"></label>
                                    <input type="radio" id="starhalf" name="calificacion_sistema" value="medio" />
                                    <label class="half" for="starhalf" title="Pésima - 0.5 stars"></label>
                                </div>
                                <br><br><br>
                                <div style="align-content: start;">
                                    <span>
                                        <h4>Por favor, detalle su experiencia utilizando la plataforma.</h4>
                                    </span>
                                </div>
                                <textarea class="form-control" id="comentario_sistema"
                                    name="comentario_sistema"></textarea>

                                <div class="card-footer text-body-secondary text-end">
                                    <button type="submit" class="btn btn-primary">Calificar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>