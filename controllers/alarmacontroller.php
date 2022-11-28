<?php
date_default_timezone_set("America/Mexico_City");
require '../include/Exception.php';
require '../include/PHPMailer.php';
require '../include/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;

if ($peticionAjax) {
  require_once("../models/alarmamodel.php"); //para ver las notificaciones
} else {
  require_once("./models/alarmamodel.php");//para consultas
}
class alarmacontroller extends AlarmaModel{

public static function consulta_activo_asset(){
    $asset = $_POST['asset'];

    $sql = AlarmaModel::ver_un_activos_por_asset($asset);

    $description = trim($sql['Description']); 
    $dateinventory = trim($sql['DateInventory']);

  $outArr = array("description" => $description,"dateinventory" => $dateinventory);
  $jsonResponse = json_encode($outArr);
  die($jsonResponse);
}

public static function registro_incidencia_alarma(){
  $asset       = mainmodel::limpiar_cadena($_POST['asset_reg']);
  $tipo        = mainmodel::limpiar_cadena($_POST['tipo_reg']);
  $comentarios = mainmodel::limpiar_cadena($_POST['comentarios_reg']);
  $fecha = date("Y-m-d H:i:s");


     //   VERIFICAMOS SI EL USUARIO TIENE LOS PERMISOS PARA CREAR 
     session_start(['name' => 'SCA']);
     if ($_SESSION['rol_sca'] == 'Admin') {
 
       $datos_inc = [
         "asset" => $asset,
         "tipo" => $tipo,
         "comentarios" => $comentarios,
         "fecha" => $fecha
       ];
       $agregar_incidencia = AlarmaModel::agregar_incidencias($datos_inc); //llamamos la funcion del modelo 
       if ($agregar_incidencia) {
         $alerta = [
           "Alerta" => "recargar",
           "Titulo" => "Incidencia Creada",
           "Texto"  => "La incidencia se ha creado de manera exitosa.",
           "Tipo"   => "success"
         ];
       } else {
         $alerta = [
           "Alerta" => "simple",
           "Titulo" => "Ocurrio un error inesperado",
           "Texto"  => "No se ha podido crear la incidencia, consulte al administrador del sistema.",
           "Tipo"   => "error"
         ];
       }
       echo json_encode($alerta);
     } else {
       $alerta = [
         "Alerta" => "simple",
         "Titulo" => "Accción Denegada",
         "Texto"  => "No tiene el permiso para crear incidencias en asset.",
         "Tipo"   => "error"
       ];
       echo json_encode($alerta);
       exit();
     }



}
public static function crear_comentario_alarma(){
  $id          = mainmodel::limpiar_cadena($_POST['id_alarma']);
  $asset       = mainmodel::limpiar_cadena($_POST['asset_reg_alarm']);
  $tipo        = mainmodel::limpiar_cadena($_POST['tipo_alarma']);
  $comentarios = mainmodel::limpiar_cadena($_POST['comentarios_alarma']);
  $fecha = date("Y-m-d H:i:s");


     //   VERIFICAMOS SI EL USUARIO TIENE LOS PERMISOS PARA CREAR 
     session_start(['name' => 'SCA']);
     if ($_SESSION['rol_sca'] == 'Admin') {
 
       $datos_inc = [
         "id" => $id,
         "asset" => $asset,
         "tipo" => $tipo,
         "comentarios" => $comentarios,
         "fecha" => $fecha
       ];
       $crear_comentario_alarma = AlarmaModel::comentario_alarma($datos_inc); //llamamos la funcion del modelo 
       if ($crear_comentario_alarma) {
         $alerta = [
           "Alerta" => "recargar",
           "Titulo" => "Incidencia Creada",
           "Texto"  => "La incidencia se ha creado de manera exitosa.",
           "Tipo"   => "success"
         ];
       } else {
         $alerta = [
           "Alerta" => "simple",
           "Titulo" => "Ocurrio un error inesperado",
           "Texto"  => "No se ha podido crear la incidencia, consulte al administrador del sistema.",
           "Tipo"   => "error"
         ];
       }
       echo json_encode($alerta);
     } else {
       $alerta = [
         "Alerta" => "simple",
         "Titulo" => "Accción Denegada",
         "Texto"  => "No tiene el permiso para crear incidencias en asset.",
         "Tipo"   => "error"
       ];
       echo json_encode($alerta);
       exit();
     }



}
public static function mandar_correo_alarma(){
 
  $id          = mainmodel::limpiar_cadena($_POST['id_alarma']);
  $asset       = mainmodel::limpiar_cadena($_POST['asset_reg_alarm']);
  $tipo        = mainmodel::limpiar_cadena($_POST['tipo_alarma']);
  $comentarios = mainmodel::limpiar_cadena($_POST['comentarios_alarma']);
  $fecha = date("Y-m-d H:i:s");


  //Create a new PHPMailer instance
  $mail = new PHPMailer();
  $mail->IsSMTP();

  //INFORMACIÓN

  //Configuracion servidor mail
  $mail->setFrom('hgalvez@astlix.com', 'SISTEMA CENTRAL | RFID'); //remitente
  $mail->Mailer = "smtp";
  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls'; //seguridad
  $mail->Host = "smtp.gmail.com"; // servidor smtp
  $mail->Port = 587; //puerto


  $mail->Username   = "hgalvez@astlix.com";
  $mail->Password   = "ocsbelppmcaqwipv"; //cotnraseña de google 

  //CUERPO DEL CORREO
  $mensajeCliente = ' 
  <html> 
  <body style:"background-color:red"> 
  <h1>¡ COMENTARIO DE UNA ALERTA !</h1>
  <p> 
  El sistema ha registrado un comentario para la activación de este movimiento:<br>
  <strong>Asset: </strong> ' . $asset. '<br> 
  <strong>Fecha: </strong> ' . $fecha. '<br> 
  <strong>Tipo: </strong> ' . $tipo. '<br> 
  <strong>Comentario: </strong> ' . $comentarios . '<br>

  <br>  
  Sistema Central.
  </p> 
  </body> 
  </html> 
  ';

    $rsp = AlarmaModel::ver_correos();
    
    //Agregar destinatario
    $mail->isHTML(true);
    foreach ($rsp as $dato) {
      $mail->AddAddress($dato['CorreoElectronico'], $dato['Nombre']);
      } 
    $mail->Subject = 'SISTEMA CAT RFID | COMENTARIO DE ALARMA';
    $mail->Body = $mensajeCliente; 

    //Avisar si fue enviado o no y dirigir al index
    if ($mail->Send()) {

      $alerta = [
        "Alerta" => "recargar",
        "Titulo" => "Incidencia Creada",
        "Texto"  => "La incidencia se ha creado de manera exitosa.",
        "Tipo"   => "success"
      ];
      
    }else{
    echo '<script type="text/javascript">
    alert("Error al enviar el correo");
      </script>';
    } 

    $mail->smtpClose();       



}
public static function update_comentario_alarma(){
  $id          = mainmodel::limpiar_cadena($_POST['upd_id']);
  $comentario  = mainmodel::limpiar_cadena($_POST['comentario_upd']);
  $tipo        = mainmodel::limpiar_cadena($_POST['tipo_upd']);
  $fecha = date("Y-m-d H:i:s");

  session_start(['name' => 'SCA']);
  if ($_SESSION['rol_sca'] == 'Admin') {

    $datos_inc = [
      "id" => $id,
      "tipo" => $tipo,
      "comentarios" => $comentario,
      "fecha" => $fecha
    ];

    $update_comentario_alarma = AlarmaModel::upd_comentario_alarma($datos_inc); //llamamos la funcion del modelo 
    if ($update_comentario_alarma) {
      $alerta = [
        "Alerta" => "recargar",
        "Titulo" => "Incidencia Actualizada",
        "Texto"  => "La incidencia se ha actualizado de manera exitosa.",
        "Tipo"   => "success"
      ];
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => "No se ha podido actualizar la incidencia, consulte al administrador del sistema.",
        "Tipo"   => "error"
      ];
    }
    echo json_encode($alerta);
  } else {
    $alerta = [
      "Alerta" => "simple",
      "Titulo" => "Accción Denegada",
      "Texto"  => "No tiene el permiso para actualizar incidencias en asset.",
      "Tipo"   => "error"
    ];
    echo json_encode($alerta);
    exit();
  }


}

 }