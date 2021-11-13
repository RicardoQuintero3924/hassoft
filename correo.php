<?php
require_once 'control/controlUsuario.php';
require_once 'control/controlPersona.php';
$cedula = $_POST['cedula'];
$controlUsuario = new ControlUsuario();
$usuario = $controlUsuario->consultaUsuarioPorCedula($cedula);
foreach($usuario as $user){
    $nombre = $user->nombre;
    $clave = $user->clave;
}
$controlPersona = new controlPersona();
$persona = $controlPersona->consultaPersonaPorId($cedula);
foreach($persona as $per){
    $correo = $per->correo;
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hassoft7@gmail.com';                     //SMTP username
    $mail->Password   = 'hassoft1234';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hassoft7@gmail.com', 'HASSOFT');
    $mail->addAddress($correo);   
    
     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperación Cuenta Hassoft (Ver en privado)';
    $mail->Body    = "$nombre su clave de acceso es: $clave ";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script type="text/javascript"> alert("Mensaje enviado con éxito a su correo electrónico")
    window.history.go(-1);
    </script>';
    // header("location:index.php");
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}