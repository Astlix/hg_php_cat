<?php
date_default_timezone_set('America/Mexico_City');
require_once "../models/equipomodel.php";
require_once "../models/alarmamodel.php";


if (isset($_POST)) {   

	$datosRecibidos = file_get_contents("php://input");
	$xarray = json_decode($datosRecibidos, true);

	$ip = trim($xarray['ip_reader']);
	$fechaactual = date('Y-m-d H:i:s');  
    $potencia = $xarray['potencia'];

  

		$rsp = EquipoModel::ver_reader_general_ip($ip); //verificamos si existe la puerta registrada en la BD
        //VERIFICAMOS SI EXISTE EL READER EN LA BASE DE DATOS
        if ($rsp) {
                 
                $data = array(
                    "id"  => $rsp['idReader'],
                    "fecha" => $fechaactual,
                    "potencia" => $potencia,
                    "estado" => '1'
                );
                
            $rsp = AlarmaModel::keep($data);
            if ($rsp) {
                //echo $serie;
                $output = json_encode(array('result' => 'ok'));
                die($output);
            } else {
                //error -> No se pudo registrar el keep
                $output = json_encode(array('result' => 'error'));
                die($output);
            }


        }else{
            //error 2 -> No existe el xportal
			$output = json_encode(array('result' => 'error','id' => '2'));
			die($output);
        }


}//error 3 -> no existe post
$output = json_encode(array('result' => 'No hay post'));
die($output);


    ?>
