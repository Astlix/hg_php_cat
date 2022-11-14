<?php
include_once '../models/activosmodel.php';

$planta = $_POST['planta'];
$ubicacion = $_POST['columna'];
$num_ubicacion = $_POST['num_columna'];
$identificador = $_POST['identificador'];
$datos = $planta.$ubicacion.$num_ubicacion;
if ($identificador == 'site') {
  $rsp = ActivosModel::ver_un_activos_especifico_tagfound($datos);
}
if ($identificador == 'found') {
  $rsp = ActivosModel::ver_un_activos_especifico($datos);
}
if (empty($rsp)) {
    $tabla  = '<div class="box-cont-negro titulo-box m-0">';
    $tabla .= '<h5>'.$datos.'No hay activos<hr><small>Esperando registros de ctivos en esta ubicación</small></h5>';
    $tabla .= '</div>';
  } else {
    $tabla  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
    $tabla .= '<thead>';
    $tabla .= '<tr class="bg-warning">';
    $tabla .= '<th scope="col">#</th>';
    $tabla .= '<th scope="col">Asset</th>';       // aseet
    $tabla .= '<th scope="col">Descripción</th>';        // Descripcion
    $tabla .= '</tr>';
    $tabla .= '</thead>';
    $tabla .= '<tbody>';
    $i = 0;

    foreach ($rsp as $dato) {
     
     
      $i++;
      $tabla .= '<tr class="elemento">';
      $tabla .= '<td scope="col">' . $i . '</td>';
      $tabla .= '<td scope="col" class="salida">' . $dato['Asset'] . '</td>';
      $tabla .= '<td scope="col" class="lote">' . $dato['Description'] . '</td>';
      $tabla .= '</tr>';

    }
    $tabla .= '</tbody>';
    $tabla .= '</table>';
  }

$resp=$tabla;

$outArr = array("resp" => $resp);
$jsonResponse = json_encode($outArr);
die($jsonResponse);




?>