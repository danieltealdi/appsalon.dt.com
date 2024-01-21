<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function enviarConfirmacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email, $this->nombre);
        //$mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Confirma tu cuenta';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace:<p>';
        $contenido .= '<p>Presiona aqui: <a href="' . $_ENV["URL"]   . '/confirmar-cuenta?token=" . $this->token . " >Reestablecer password<a></p>';
        $contenido .= '<p>Si tu no solicitaste reestablecer tu password, puedes ignorar el mensaje</p>';
        $contenido .= '<html>';
        $mail->Body    = $contenido;
        $resultado = $mail->send();
        if ($resultado === true) {
            $mensaje = 'exito';
        } else if (isset($resultado)) {
            $mensaje = 'error';
        }
        //echo $mensaje;
    }
    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email, $this->nombre);
        //$mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Restablece tu password';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.<p>';
        $contenido .= '<p>Presiona aqui: <a href="' . $_ENV["URL"]   . '/recuperar?token=' . $this->token . '" >Reestablecer Cuenta<a></p>';
        $contenido .= '<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>';
        $contenido .= '<html>';
        $mail->Body    = $contenido;
        $resultado = $mail->send();
        if ($resultado === true) {
            $mensaje = 'exito';
        } else if (isset($resultado)) {
            $mensaje = 'error';
        }
        //echo $mensaje;
       
    }
}
