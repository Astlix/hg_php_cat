<?php
date_default_timezone_set('America/Mexico_City');
require_once "../models/alarmamodel.php";
require_once "../models/correosmodel.php";
require_once "../models/equipomodel.php";

//////////////////////////////LIBRERIAS ENVIAR EL CORREO ELECTRONICO
require '../include/Exception.php';
require '../include/PHPMailer.php';
require '../include/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();

//INFORMACIÓN

//Configuracion servidor mail
$mail->setFrom('ventas@astlix.com', 'SISTEMA CENTRAL'); //remitente
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto


$mail->Username   = "ventas@astlix.com";
$mail->Password   = "DrUf1421";

$rsp = CorreosModel::ver_correos2();

//////////////////////////////FINAL DATOS PARA ENVIAR EL CORREO ELECTRONICO


if (isset($_POST)) {

	$datosRecibidos = file_get_contents("php://input");
	$xspan = json_decode($datosRecibidos, true);

	$auth = $xspan['auth'];
	$serial = $xspan['serial'];
	$id_reader = $xspan['id_reader'];
	$gpio = $xspan['gpio'];
	$puerta = $xspan['puerta'];
	$lecturas = $xspan['lecturas'];
	$fechaactual = date('Y-m-d H:i:s');


	$longitud = count($lecturas);

	if (empty($lecturas) || $longitud == 0) {
		$output = json_encode(array('result' => 'ok nuevo'));
		die($output); 
       }


	// ***************
	// $auth = filter_var($xspan["auth"], FILTER_SANITIZE_STRING);
	$salt = substr($auth, 0, 13);
	$authcheck = crypt("impinj", $salt);
	if ($auth != $authcheck) {

		$rsp2 = EquipoModel::ver_reader_general_id($id_reader); //verificamos si existe la puerta registrada en la BD
        
		if ($rsp2) {

			foreach ($lecturas as $lectura) {
				//ReportType:
				// ENTRY_REPORT(0),
				// UPDATE_REPORT(1),
				// EXIT_REPORT(2);
				// **********************TODOS LOS TAGS QUE NOS MANDA LA XSPAN SON NO RECONOCIDOS**********
				if ($lectura['reportType'] == 1 && ($lectura['transitionId'] == 3)) { //si existe la variable

					if ($lectura['transitionId'] == 3) {
						$tipotrans = 'Salida';
					}

					//CUERPO DEL CORREO
					$mensajeCliente = ' 
									<html> 
									<body style:"background-color:red"> 
									<h1>¡ ALERTA !</h1>
									<p> 
									El sistema ha detectado la activacion de alarma con los siguientes datos:<br>
									<strong>Asset: </strong> ' . $lectura['epc'] . '<br> 
									<strong>Fecha: </strong> ' . $fechaactual . '<br> 
									<strong>Lugar: </strong> ' . trim($rsp2['Locacion']) . '<br> 
									<strong>Tipo de movimiento: </strong> ' . $tipotrans . '<br>

									<br>  
									Revisar de inmediato las puertas.
									</p> 
									</body> 
									</html> 
									';

					//Agregar destinatario
					$mail->isHTML(true);
					foreach ($rsp as $dato) {
						$mail->AddAddress($dato['CorreoElectronico'], $dato['Nombre']);
					}
					$mail->Subject = 'ALARMA | MOVIMIENTO NO REGISTRADO';
					$mail->Body = $mensajeCliente;

					//Avisar si fue enviado o no y dirigir al index
					if ($mail->Send()) {
					} else {
					}
					$mail->smtpClose();
					///FIN DEL CORREO ELETRÓNICO


					$data = array(
						"asset"  => $lectura['epc'],
						"fecha" => $fechaactual,
						"id_puerta" => $id_reader
					);
					$rsp = AlarmaModel::agregarAlarma($data);
					if ($rsp) {
						//echo $serie;
						$output = json_encode(array('result' => 'ok'));
						die($output);
					} else {
						//error -> No se pudo registrar el movimiento
						$output = json_encode(array('result' => 'error'));
						die($output);
					}
				}
			}
		} else {
			//error 2 -> No existe el arco
			$output = json_encode(array('result' => 'error','id' => '2'));
			die($output);
		}
	} else {
		//error 1 -> El auth no es el mismo
		$output = json_encode(array('result' => 'error','id' => '1'));
		die($output);
	}
}	
//error 3 -> no existe post
$output = json_encode(array('result' => 'No hay post'));
die($output);
