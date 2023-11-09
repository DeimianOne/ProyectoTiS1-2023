<?php
    include("database/auth.php");
    include("database/connection.php");  // Incluye la conexión

    // Fetching the departments for the dropdown
    $query = "SELECT * FROM ticket"; 
    $result = mysqli_query($connection, $query);
?>

<div class="container-fluid border-bottom border-top bg-body-tertiary">
    <div class="p-5 rounded text-center">
        <h2 class="fw-normal">Calificar sistema</h2>
    </div>
</div>

<main class="container mt-5">
    <div class="card ">
        <form action="pages/calificacion/actions/store.php" method="POST">
            <div class="card-body d-flex justify-content-evenly">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <span><h4>En relación al ticket N°:</h4></span>
                    </div>

                    <div class="col-md-12 mb-3">
                        <span><h4>Califique el sistema.</h4></span>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5"                  /><label class="full" for="star5" title="Awesome - 5 stars"             ></label>
                            <input type="radio" id="star4half" name="rating" value="4 and a half"   /><label class="half" for="star4half" title="Pretty good - 4.5 stars"   ></label>
                            <input type="radio" id="star4" name="rating" value="4"                  /><label class="full" for="star4" title="Pretty good - 4 stars"         ></label>
                            <input type="radio" id="star3half" name="rating" value="3 and a half"   /><label class="half" for="star3half" title="Meh - 3.5 stars"           ></label>
                            <input type="radio" id="star3" name="rating" value="3"                  /><label class="full" for="star3" title="Meh - 3 stars"                 ></label>
                            <input type="radio" id="star2half" name="rating" value="2 and a half"   /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"     ></label>
                            <input type="radio" id="star2" name="rating" value="2"                  /><label class="full" for="star2" title="Kinda bad - 2 stars"           ></label>
                            <input type="radio" id="star1half" name="rating" value="1 and a half"   /><label class="half" for="star1half" title="Meh - 1.5 stars"           ></label>
                            <input type="radio" id="star1" name="rating" value="1"                  /><label class="full" for="star1" title="Sucks big time - 1 star"       ></label>
                            <input type="radio" id="starhalf" name="rating" value="half"            /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars" ></label>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <span><h4>Por favor detalle su experiencia utilizando la plataforma.</h4></span>
                        <textarea class="form-control" id="comentario_sistema" name="comentario_sistema"></textarea>
                    </div>

                </div>
            </div>

            <div class="card-footer text-body-secondary text-end">
                <button type="submit" class="btn btn-dark disabled">Guardar</button>
            </div>
        </form>
    </div>
</main>
