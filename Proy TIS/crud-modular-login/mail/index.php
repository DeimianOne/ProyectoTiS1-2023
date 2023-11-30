<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';



function enviarCorreoRespuesta($destinatario_correo, $destinatario_nombre, $cod_ticket, $estado_actual)
{
    $mail = new PHPMailer(true);

    try {
        //Configuración del servidor
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        //Correo y clave de gmail
        $mail->Username = 'retroalimentacionciudadana@gmail.com';
        $mail->Password = 'tumddnwgcscieoja';


        //Recipients
        $mail->setFrom('retroalimentacionciudadana@gmail.com', 'Retroalimentacion Ciudadana');
        $mail->addAddress($destinatario_correo, $destinatario_nombre);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Actualizacion de tu Retroalimentacion Ciudadana - Solicitud #'.$cod_ticket;

        $mensaje = '<p>Estimado/a <strong>' . $destinatario_nombre . '</strong>, queremos informarte que hemos recibido y procesado tu retroalimentación ciudadana con el número de solicitud #<strong>' . $cod_ticket . '</strong>.</p>';

        $mensaje .= "<p>Estado Actual de la Solicitud: <strong>" . $estado_actual . "</strong></p>";
        $mensaje .= "<p>Código de Solicitud: #<strong>" . $cod_ticket . "</strong></p>";
    
        $mensaje .= "<p>Estamos comprometidos a brindarte la mejor atención posible y a resolver cualquier inquietud que puedas tener. Agradecemos tu paciencia y colaboración en este proceso.</p>";
        $mensaje .= "<p>Si tienes alguna pregunta adicional o necesitas más información, no dudes en responder a este correo electrónico. Estamos aquí para ayudarte.</p>";
        $mensaje .= "<p>Agradecemos tu participación y contribución a mejorar nuestros servicios.</p>";
    
        $mensaje .= "<p>Saludos cordiales,<br>Retroalimentación Ciudadana</p>";


        $mail->Body = $mensaje;
        $mail->AltBody = $mensaje;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>