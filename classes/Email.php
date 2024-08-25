<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
   public $email;
   public $nombre;
   public $token;
   
    public function __construct($email, $nombre, $token)
   {
      $this->email = $email;
      $this->nombre = $nombre;
      $this->token = $token;

   }

   public function enviarConfirmacion(){
            // Crear el objeto de Email
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '79b206265392cd';
            $mail->Password = 'd12c5a5f28e257';
 
        $mail->setFrom("cuentas@appsalon.com");
        $mail->addAddress("cuentas@appsalon.com", "AppSalon.com");
        $mail->Subject = "Confirma tu Cuenta";
 
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";
 
        $contenido = "<html>";
        $contenido.= "<p><strong>Hola " . $this->nombre . "</strong> Has Creado tu Cuenta en App
        Salon, solo debes confirmala presionando el siguiente enlace</p>";
        $contenido.= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" 
        . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido.= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido.= "</html>";
        $mail->Body = $contenido;
 
        // Enviar el Email
        $mail->send();
    

   }

   public function enviarInstrucciones(){
        // Crear el objeto de Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '79b206265392cd';
        $mail->Password = 'd12c5a5f28e257';

    $mail->setFrom("cuentas@appsalon.com");
    $mail->addAddress("cuentas@appsalon.com", "AppSalon.com");
    $mail->Subject = "Reestablezca su contraseña";

    // Set HTML
    $mail->isHTML(TRUE);
    $mail->CharSet = "UTF-8";

    $contenido = "<html>";
    $contenido.= "<p><strong>Hola " . $this->nombre . "</strong> Ha solicitado reestablecer
    su contraseña, siga el siguiente link para hacerlo.</p>";
    $contenido.= "<p>Presione aquí: <a href='http://localhost:3000/recuperar?token=" 
   . $this->token . "'>Reestablecer Contraseña</a> </p>";
    $contenido.= "<p>Si usted no solicitó este cambio, puedes ignorar el mensaje</p>";
    $contenido.= "</html>";
    $mail->Body = $contenido;

    // Enviar el Email
    $mail->send();

   }

 }
