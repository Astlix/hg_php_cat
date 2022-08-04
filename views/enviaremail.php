<?php
require '../include/Exception.php';
require '../include/PHPMailer.php';
require '../include/SMTP.php';
require_once("../models/correosmodel.php"); //para ver las notificaciones
require_once '../config/config.php';//para poder incluir el SERVERURL
?>

<link rel="stylesheet" href="../public/css/sweetalert2.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->IsSMTP();
  
        //INFORMACIÓN
          

            //Configuracion servidor mail
            $mail->setFrom('ventas@astlix.com', 'SISTEMA CAT'); //remitente
            $mail->Mailer = "smtp";
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls'; //seguridad
            $mail->Host = "smtp.gmail.com"; // servidor smtp
            $mail->Port = 587; //puerto
  
  
            $mail->Username   = "ventas@astlix.com";
            $mail->Password   = "DrUf1421";
  
            //CUERPO DEL CORREO
            $mensajeCliente = ' 
                <html> 
                <body> 
                <h1>CUENTA DE CORREO PARA ALERTAS</h1>
                <p> 
                Este correo es para probar que las notificaciones se enviarán correctamente.<br> 
                </p> 
                <br>  
                </body> 
                </html> 
                ';
  
                $rsp = CorreosModel::ver_correos2();
                
                //Agregar destinatario
                $mail->isHTML(true);
                foreach ($rsp as $dato) {
                  $mail->AddAddress($dato['CorreoElectronico'], $dato['Nombre']);
                 } 
              $mail->Subject = 'SISTEMA CAT | CUENTA DE CORREO';
              $mail->Body = $mensajeCliente; 
  
            //Avisar si fue enviado o no y dirigir al index
            if ($mail->Send()) {
                echo '<script type="text/javascript">
                    alert("Correo enviado");                                    
                  </script>';
                  header("Location: ". SERVERURL . "correos");
            }else{
              echo '<script type="text/javascript">
              alert("Error al enviar el correo");
                  </script>';
            } 
        
        $mail->smtpClose();       
        
  



