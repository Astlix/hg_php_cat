<?php
include_once '../models/activosmodel.php';

$planta = $_POST['planta'];
$ubicacion = $_POST['columna'];
$num_ubicacion = $_POST['num_columna'];
$identificador = $_POST['identificador'];
$datos = $planta.$ubicacion.$num_ubicacion;


  $rsp = ActivosModel::ver_un_activos_especifico($datos);
  $rsp2 = ActivosModel::ver_un_activos_especifico_tagfound($datos);
  $i = 0;

  $header = '<table style="border-radius:10px; text-align:center;margin:0px;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
  $header .= '<tr class="bg-warning">';
  $header .= '<th scope="col" style="width:10%;">Indice</th>';
  $header .= '<th scope="col" class="salida" style="width:30%;"> Asset </th>';
  $header .= '<th scope="col" class="lote" style="width:60%;">Descripción</th>';
  $header .= '</tr>';
  $header .= '</table>';


if (empty($rsp)) {
    $tabla  = '<div class="box-cont-negro titulo-box m-0">';
    $tabla .= '</div>';
  } else {
    $tabla  = '<table style="border-radius:10px; text-align:center;margin:0px;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
    $tabla .= '<tbody>';

  foreach ($rsp as $dato) { 
    if ($dato['TagSiteFound'] != '') {
      continue;
    }
    $i++;
    $tabla .= '<tr class="elemento">';
    $tabla .= '<td scope="col" style="width:10%;">' . $i . '</td>';
    $tabla .= '<td scope="col" class="salida" style="width:30%;">' . $dato['Asset'] . '</td>';
    $tabla .= '<td scope="col" class="lote" style="width:60%;">' . $dato['Description'] . '</td>';
    $tabla .= '</tr>';
  }
    $tabla .= '</tbody>';
    $tabla .= '</table>';
  }

if (empty($rsp2)) {
    $tabla2  = '<div class="box-cont-negro titulo-box m-0">';
    $tabla2 .= '</div>';
  } else {
    $tabla2  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
    $tabla2 .= '<tbody>';

  foreach ($rsp2 as $dato) {    
    $tabla2 .= '<tr class="elemento">';
    $i++;
    $tabla2 .= '<td scope="col"  style="width:10%;">' . $i . '</td>';
    $tabla2 .= '<td scope="col" class="salida" style="width:30%;">' . $dato['Asset'] . '</td>';
    $tabla2 .= '<td scope="col" class="lote" style="width:60%;">' . $dato['Description'] . '</td>';
    $tabla2 .= '</tr>';
  }
    $tabla2 .= '</tbody>';
    $tabla2 .= '</table>';
  }

$resp=$header.$tabla.$tabla2;

$outArr = array("resp" => $resp);
$jsonResponse = json_encode($outArr);
die($jsonResponse);




?>