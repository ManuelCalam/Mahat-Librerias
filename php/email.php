<?php


session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$CorreoSesion = $_SESSION['correo'];
$Carrito_PDF =  $_SESSION['filename'];
// echo $CorreoSesion;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'Mahat.librerias@gmail.com';                     //SMTP username
    $mail->Password   = 'zfje bctt mufs thjg';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mahat.librerias@gmail.com', 'Mahat Librerias');
    $mail->addAddress($CorreoSesion, 'Manuel Calam');     //Add a recipient;

    //Attachments
    $mail->addAttachment($Carrito_PDF, 'Doc.pdf');   //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Esto es el asunto';
    $mail->Body    = 'Este es un mensaje de prueba';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}