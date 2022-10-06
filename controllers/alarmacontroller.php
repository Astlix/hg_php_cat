<?php

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

 }