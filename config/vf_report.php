<?php
date_default_timezone_set('America/Mexico_City');
require_once "../models/equipomodel.php";
require_once "../models/activosmodel.php";
require_once "../models/alarmamodel.php";
require_once "../models/correosmodel.php";

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
$mail->setFrom('hgalvez@astlix.com', 'SISTEMA CENTRAL'); //remitente
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto


$mail->Username   = "hgalvez@astlix.com";
$mail->Password   = "ocsbelppmcaqwipv"; //contraseña hecha por google

$rsp = CorreosModel::ver_correos2();

//////////////////////////////FINAL DATOS PARA ENVIAR EL CORREO ELECTRONICO


if (isset($_POST)) {   

	$datosRecibidos = file_get_contents("php://input");
	$xspan = json_decode($datosRecibidos, true);

	$auth = $xspan['auth'];
	$ip_reader = trim($xspan['ip_reader']);
	$lecturas = $xspan['lecturas'];
	$fechaactual = date('Y-m-d H:i:s');

	
	// SI LAS LECTURAS ESTAN VACIAS 
	$longitud = count($lecturas);

	if (empty($lecturas) || $longitud == 0) {
		$output = json_encode(array('result' => 'ok'));
		die($output); 
       }


	$salt = trim($auth);
	$pass="astliximpinj";
	$authcheck = crypt("impinj", $salt);
	// VERIFICAMOS QUE COICIDAN LA AUTORIZACION
	if ($pass == $auth) {

		$rsp2 = EquipoModel::ver_reader_general_ip($ip_reader); //verificamos si existe la puerta registrada en la BD
        
		if ($rsp2) {

			foreach ($lecturas as $lectura) {
				
				// VERIFICAMOS QUE EL EPC EXISTA
					$rsp3 = ActivosModel::ver_un_activos_por_epc(trim($lectura['epc'])); //verificamos si existe la puerta registrada en la BD

					if ($rsp3) {

						// VERIFICAMOS SI EL ACTIVO ESTA VINCULADO CON EL EPC
						$rsp4 = ActivosModel::ver_un_activo2(trim($rsp3['idCA']));
						if ($rsp4) {
							$rsp5 = AlarmaModel::ver_alarma_tiposalida(trim($rsp4['Asset']));
							// Si existe en bitacora 
							
								if ($rsp5) {
	
									$output = json_encode(array('code' =>'0','result' => 'Activo registrado en bitacora'.trim($rsp5['Asset'])));
									die($output);
	
									}else{
										# code...
										//CORREO ELECTRONICO
										$mensajeCliente = ' 
										<html> 
										<body style:"background-color:red"> 
										<h1>¡ ALERTA !</h1>
										<p> 
										El sistema ha detectado la activacion de alarma con los siguientes datos:<br>
										<strong>Epc: </strong> ' . trim($lectura['epc']) . '<br> 
										<strong>Asset: </strong> ' . trim($rsp4['Asset']) . '<br> 
										<strong>Fecha: </strong> ' . $fechaactual . '<br> 
										<strong>Planta: </strong> ' . trim($rsp2['Planta']) . '<br> 
										<strong>Lugar: </strong> ' . trim($rsp2['Locacion']) . '<br> 
		
										<br>  
										Se recomienda revisar las puertas.
										</p> 
										</body> 
										</html> 
										';
		
										//Agregar destinatario
										$mail->isHTML(true);
										foreach ($rsp as $dato) {
											if (trim($dato['Estado']) == 0) {
												//No enviara el correo cuando el valor es 0
											}else{
												$mail->AddAddress($dato['CorreoElectronico'], $dato['Nombre']);
											}
										}
										$mail->Subject = 'SISTEMA CAT RFID | ALARMA | MOVIMIENTO NO REGISTRADO';
										$mail->Body = $mensajeCliente;
										
										//Avisar si fue enviado o no y dirigir al index
										if ($mail->Send()) {
										} else {
										}
										$mail->smtpClose();
										///FIN DEL CORREO ELETRÓNICO
										$data = array(
											"asset"  => $rsp4['Asset'],
											"fecha" => $fechaactual,
											"id_puerta" => $ip_reader,
											"planta" => trim($rsp2['Planta'])
										);
										$rsp = AlarmaModel::agregarAlarma($data);
										if ($rsp) {
											//echo $serie;
											$output = json_encode(array('code' =>'2','result' => 'ok'));
											die($output);
										} else {
											//error -> No se pudo registrar el movimiento
											$output = json_encode(array('code' =>'2','result' => 'error'));
											die($output);
										}
									
								}
							

							
						}else{
							$output = json_encode(array('code' =>'1','result' => 'No existe asset con ese epc'));
							die($output);
						}
					}else{
						$output = json_encode(array('code' =>'1','result' => 'No existe epc'));
						die($output);
					}

					
				
			}
		} else {
			//error 2 -> No existe el arco
			$output = json_encode(array('code' =>'3','result' => 'error'));
			die($output);
		}
	} else {
		//error 1 -> El auth no es el mismo
		$output = json_encode(array('code' =>'3','result' => 'error'));
		die($output);
	}
}	
//error 3 -> no existe post
$output = json_encode(array('code' =>'3','result' => 'No hay post'));
die($output);
