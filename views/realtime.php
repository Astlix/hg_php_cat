<?php
date_default_timezone_set('America/Mexico_City');

require '../models/equipomodel.php';
require '../models/alarmamodel.php';

$action = $_POST['status'];
if($action == 'readers'){
            $rsp = EquipoModel::ver_reader_general2();


            if (empty($rsp)) {
                $elemento  = '<div class="box-cont-negro titulo-box m-0">';
                $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Equipos</small></h4>';
                $elemento .= '</div>';
                $datos = $elemento;
            } else {
                $tabla  = '<table id="nombre" data-nombre="portales" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
                $tabla .= '<thead>';
                $tabla .= '<tr class="bg-warning">';
                $tabla .= '<th scope="col">Index</th>';       
                $tabla .= '<th scope="col">Locación</th>';   
                $tabla .= '<th scope="col">Ubicación</th>';        
                $tabla .= '<th scope="col">Potencia</th>';   
                $tabla .= '<th scope="col">Intensidad</th>'; 
                $tabla .= '<th scope="col">Estado</th>'; 
                $tabla .= '</tr>';
                $tabla .= '</thead>';
                $tabla .= '<tbody>';
                $i = 0;

                foreach ($rsp as $dato) {
                    if ($dato['TxPower'] > 0 && $dato['TxPower'] < 5.7 && $dato['Estado'] == 1) {
                        $señal = '<td scope="col" class="lote"><p hidden>Buena</p> <i class="bx bx-signal-1 nav_icon"  style="color:green;font-size:30px;" title="Muy Bajo"></td>';
                    }
                    if ($dato['TxPower'] > 5.8 && $dato['TxPower'] < 11.4 && $dato['Estado'] == 1) {
                        $señal = '<td scope="col" class="lote"><p hidden>Buena</p> <i class="bx bx-signal-2 nav_icon"  style="color:green;font-size:30px;" title="Bajo"></td>';
                    }
                    if ($dato['TxPower'] > 11.5 && $dato['TxPower'] < 17.5 && $dato['Estado'] == 1) {
                        $señal = '<td scope="col" class="lote"><p hidden>Buena</p> <i class="bx bx-signal-3 nav_icon"  style="color:green;font-size:30px;" title="Normal"></td>';
                    }
                    if ($dato['TxPower'] > 17.6 && $dato['TxPower'] < 22.8 && $dato['Estado'] == 1) {
                        $señal = '<td scope="col" class="lote"><p hidden>Buena</p> <i class="bx bx-signal-4 nav_icon"  style="color:green;font-size:30px;" title="Alto"></td>';
                    }
                    if ($dato['TxPower'] > 22.9 && $dato['TxPower'] < 28.5 && $dato['Estado'] == 1) {
                        $señal = '<td scope="col" class="lote"><p hidden>Buena</p> <i class="bx bx-signal-5 nav_icon"  style="color:green;font-size:30px;" title="Muy Alto"></td>';
                    }

                    if ($dato['Estado'] == 1) {
                        $linea = '<td scope="col" class="lote"><p hidden>Activo</p> <i class="bx bx-devices nav_icon"  style="color:green;font-size:30px;" title="Activo"></td>';
                    }else{
                        $linea = '<td scope="col" class="lote"><p hidden>Inactivo</p> <i class="bx bx-devices nav_icon"  style="color:red;font-size:30px;" title="Inactivo"></td>'; 
                        $señal = '<td scope="col" class="lote"><p hidden>No Signal</p> <i class="bx bx-no-signal nav_icon"  style="color:red;font-size:30px;" title="No Signal"></td>';
                    }
                    // echo $planta.$columna.$num_columna.'<br>';
                    $i++;
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">'. $i . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $dato['Locacion'] .'</td>';
                    $tabla .= '<td scope="col" class="lote">'. $dato['Planta'] . $dato['Columna']  .'</td>';
                    $tabla .= '<td scope="col" class="lote">'. $dato['TxPower'] .'</td>';
                    $tabla .= $señal;
                    $tabla .= $linea;
                    $tabla .= '</tr>';
                }           

                //falta agregar cls
                $tabla .= '</tbody>';
                $tabla .= '</table>';


                $outArr = array("datos" => $tabla);
                $jsonResponse = json_encode($outArr);
                die($jsonResponse);
            }
 }


 if ($action == 'keep_alive') {
    $rsp = EquipoModel::ver_reader_general2();

    foreach($rsp as $dato){
	    $fechaactual = date('Y-m-d H:i:s');  
        $hoy = date("H:i:s");
        $fecha_final = explode(" ", trim($dato['Fecha']));
        $fecha_final2 = explode(".", $fecha_final[1]);


        $start = strtotime($fecha_final2[0]);
        $end = strtotime($hoy);
        $segundos = ($end - $start);
        if ($segundos > 25) {
            $data = array(
                "id"  => $dato['idReader'],
                "fecha" => $fechaactual,
                "estado" => '0'
            );
            $query = AlarmaModel::tempo($data);

            $valor = 0; //0 significa que no hay señal del xportal y lo mandamos en json
            $outArr = array("datos" => $valor);
            $jsonResponse = json_encode($outArr);
            die($jsonResponse);
        }

    }
 }