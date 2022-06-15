<?php
date_default_timezone_set("America/Mexico_City");
if ($peticionAjax) {
  require_once("../models/activosmodel.php"); //para ver las notificaciones
} else {
  require_once("./models/activosmodel.php");//para consultas
}
class activosController extends activosmodel
{

    ########################################################################
    #                           AGREGAR USUARIO                            #
    ########################################################################
    public function agregar_activo_controller(){
      $fecha_actual= date("Y-m-d H:i:s");
      $asset=Mainmodel::limpiar_cadena($_POST['asset_reg']);
      $desc=Mainmodel::limpiar_cadena($_POST['desc_reg']);
      $planta=Mainmodel::limpiar_cadena($_POST['planta_reg']);
      $columna=Mainmodel::limpiar_cadena($_POST['columna_reg']);
      $num_columna=Mainmodel::limpiar_cadena($_POST['num_col_reg']);
      $tipo_activo = '02';
      $tipo_poste = '01';
      $fecha=$fecha_actual;
      if (isset($_POST['serv_1_reg'])) {$serv1=Mainmodel::limpiar_cadena($_POST['serv_1_reg']);}else{$serv1='null';}
      if (isset($_POST['serv_2_reg'])) {$serv2=Mainmodel::limpiar_cadena($_POST['serv_2_reg']);}else{$serv2='null';}
      if (isset($_POST['serv_3_reg'])) {$serv3=Mainmodel::limpiar_cadena($_POST['serv_3_reg']);}else{$serv3='null';}
      if (isset($_POST['serv_4_reg'])) {$serv4=Mainmodel::limpiar_cadena($_POST['serv_4_reg']);}else{$serv4='null';}
      if (isset($_POST['serv_5_reg'])) {$serv5=Mainmodel::limpiar_cadena($_POST['serv_5_reg']);}else{$serv5='null';}

      
      $epc_poste='cad12014' . $tipo_poste . '00000000' . $planta . $columna . $num_columna;

      // ************COMPROBAR LOS CAMPOS VACIOS **********
      if($asset == "" || $planta == "" || $columna =="" || $num_columna ==""){
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No has llenado todos los campos que son obligatorios.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }



      // *************+COMPROBAR SI EL USUARIO EXISTE
      $check_epc = Mainmodel::ejecutar_cosulta_simple("SELECT top(1) TagEpc from tblCA order by DateInventory DESC");
      if($check_epc['TagEpc']==""){ //si la consulta devuelve vacio empezara a 1
        $consecutivo =  1;
        $length = 14;
        $string = substr(str_repeat(0, $length).$consecutivo, - $length);
        $epc_activo='cad12014'.$tipo_activo.$string;
      }else{
        $rest = substr($check_epc['TagEpc'],-14);
        $consecutivo = $rest + 1;
        $length = 14;
        $string = substr(str_repeat(0, $length).$consecutivo, - $length);
        $epc_activo='cad12014'.$tipo_activo.$string;

        // $alerta=[
        //   "Alerta" => "simple",
        //   "Titulo" => "EPC Y EPC UBICACION",
        //   "Texto"  => "El epc es: ".$epc_activo."y el epcubicacion: " . $epc_poste ,
        //   "Tipo"   => "success"
        // ];
        // echo json_encode($alerta);
        // exit();
      }

      

      $datos_activos_reg=[
        "asset"=>$asset,
        "desc"=>$desc,
        "epc_activo"=>$epc_activo,
        "epc_poste"=>$epc_poste,
        "fecha"=>$fecha,
        "serv1"=>$serv1,
        "serv2"=>$serv2,
        "serv3"=>$serv3,
        "serv4"=>$serv4,
        "serv5"=>$serv5,
      ];


      $agregar_activo = ActivosModel::agregar_activo_modelo($datos_activos_reg);

      if ($agregar_activo) {
        $alerta=[
          "Alerta" => "limpiar",
          "Titulo" => "Activo Registrado",
          "Texto"  => "Los datos del activo han sido registrado con exito.",
          "Tipo"   => "success"
        ];
      } else {
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No se ha podido registrar el activo.",
          "Tipo"   => "error"
        ];
      }
    
      echo json_encode($alerta);
      

    }// ****FIN DEL CONTROLADOR***
}
