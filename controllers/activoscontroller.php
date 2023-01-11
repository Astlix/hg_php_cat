<?php
date_default_timezone_set("America/Mexico_City");
if ($peticionAjax) {
  require_once("../models/activosmodel.php"); //para ver las notificaciones
  require_once('../excel/excel_reader2.php');
  require_once('../excel/SpreadsheetReader.php');
} else {
  include("./models/activosmodel.php"); //para consultas
  require_once('./excel/excel_reader2.php');
  require_once('./excel/SpreadsheetReader.php');
}
class activosController extends activosmodel
{

  
  ########################################################################
  #                           AGREGAR ACTIVOS EN CSV                     #
  ########################################################################
  public function agregar_activo__masivo_controller()
  {
    $temporal = $_FILES['name_doc']['tmp_name'];
    $tamaño = $_FILES['name_doc']['size'];
    $nombre_archivo = $_FILES['name_doc']['name'];
    $partes = explode(".", $nombre_archivo);
    if (end($partes) != 'csv') {
      $alerta = [
        "Alerta" => "limpiar",
        "Titulo" => "Error de Archivo",
        "Texto"  => "El archivo que intentas insertar no es CSV.",
        "Tipo"   => "error"
      ];
      echo json_encode($alerta);
      exit();
    }


    if ($nombre_archivo != '') {
      $lineas = file($temporal);
      $i = 0;
      $agregados = 0;
      $actualizados = 0;
      foreach ($lineas as $linea) {
        $cantidad_registros = count($lineas);
        // $cantidad_reg_agregados = ($cantidad_registros - 1);
        $i = $i + 1; //contador de lineas en caso qeu este mal un registro, le diga al usuaraio en que linea esta mal.
        $existe = "";

        $datos = explode(",", $linea);

        /////VERIFICAMOS QUE EL DOCUMENTO TENGA LAS COLUMNAS IGUALES A LA BD
        $tamaño_arreglo = count($datos);
        if ($tamaño_arreglo != 5) {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Error de Archivo",
            "Texto"  => "Verifique que el archivo tenga el formato correspondiente asi como las columnas. Error en linea: ".$i."",
            "Tipo"   => "error"  
          ];
          echo json_encode($alerta);
          exit();
        }
        ////FIN DE LA VERIFICACION


        if ($i > 1) {
          $asset               = !empty($datos[0])  ? ($datos[0]) : '';
          $desc                = !empty($datos[1])  ? ($datos[1]) : '';
          $date                = !empty($datos[2])  ? ($datos[2]) : '';
          $site                = !empty($datos[3])  ? ($datos[3]) : '';
          $locacion            = !empty($datos[4])  ? ($datos[4]) : '';

          $datearray = explode("/", trim($date));
          $dia = $datearray[0];
          $mes = $datearray[1];
          $año = $datearray[2];
          $newdate = $año . '-' . $mes . '-' . $dia;
          $update_activo = $agregar_activo = false;

          $activo_asset = ActivosModel::ver_un_activos_por_asset($asset);
          if ($activo_asset) {
            $existe = true;
          } else {
            $existe = false;
          }


          if ($existe == true) { //validamos si ya existe en la BD true = existe, false = no existe            

            $id = $activo_asset['idCA'];
            $epc = trim($activo_asset['TagEpc']);

            if (isset($asset)) {
              $asset_upd = mainmodel::limpiar_cadena($asset);
            }
            if (isset($desc)) {
              $desc_upd = mainmodel::limpiar_cadena($desc);
            }
            if (isset($date)) {
              $date_upd = mainmodel::limpiar_cadena($newdate);
            }
            if (isset($site)) {
              $site_upd = mainmodel::limpiar_cadena($site);
            }
            if (isset($locacion)) {
              $locacion_upd = mainmodel::limpiar_cadena($locacion);
            }
            if ($epc == 'No asignado') {
                          $datos_activos_upd = [
                            "id" => $id,
                            "asset" => $asset_upd,
                            "description" => $desc_upd,
                            "date_inventory" => $date_upd,
                            "site" => $site_upd,
                            "locacion" => $locacion_upd,
                          ];
                $update_activo = ActivosModel::actualizar_activo_masivo_modelo($datos_activos_upd); //llamamos la funcion del modelo 
                if ($update_activo) {
                  $actualizados = $actualizados + 1;
                } 
            }else{  
              $datos_activos_upd = [
                "id" => $id,
                "asset" => $asset_upd,
                "description" => $desc_upd,
                "date_inventory" => $date_upd,
                "site" => $site_upd,
                "locacion" => $locacion_upd
              ];
              $update_activo = ActivosModel::actualizar_activo_masivo_modelo_sin_epc($datos_activos_upd); //llamamos la funcion del modelo 
              if ($update_activo ) {
                $actualizados = $actualizados + 1;
              } 
            }

          } else {
            // echo "Nuevo ".$locacion;
            $datos_activos_reg = [
              "asset" => $asset,
              "description" => $desc,
              "date_inventory" => $newdate,
              "site" => $site,
              "locacion" => $locacion,
            ];
            $agregar_activo = ActivosModel::agregar_activo_masivo_modelo($datos_activos_reg);
            if ($agregar_activo) {
              $agregados = $agregados + 1;
            }
          }
        }
      }
      // *******ALERTA DE SE AGREGO O NO LOS ACTIVOS 
      if ($agregar_activo == true || $update_activo == true) {
        $alerta = [
          "Alerta" => "limpiar",
          "Titulo" => "Activo Registrado",
          "Texto"  => "Se han agregado " . $agregados . " activos y se han actualizado " . $actualizados . " registros en el sistema.",
          "Tipo"   => "success"
        ];
      } 
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error de archivo",
        "Texto"  => "No has seleccionado un archivo.",
        "Tipo"   => "error"
      ];
      echo json_encode($alerta);
    }
  }


  public function cargar_masivo_controller(){
    $error = false;
      $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
      if(in_array($_FILES["name_doc"]["type"],$allowedFileType)){
        
        $ruta = "../excel/formatos/" . $_FILES['name_doc']['name'];
        move_uploaded_file($_FILES['name_doc']['tmp_name'], $ruta);
        $Reader = new SpreadsheetReader($ruta);
        $sheetCount = count($Reader->sheets());
        $agregar_activo = $update_activo = false;
        $actualizados = $agregados = 0;
        
        $nombre_doc = $_FILES['name_doc']['name']; //nombre del documento excel

        for($i=0;$i<$sheetCount;$i++){ //leemos linea por linea
          $primera = true;
              foreach ($Reader as $Row) {                  
                // Evitamos la primer linea
                if($primera){
                    $primera = false;
                    continue;
                }
              $asset               = $Row[0];
              $desc                = $Row[1];
              $date                = $Row[2];
              $site                = $Row[3];
              $locacion            = $Row[4];

              $datearray = explode("/", trim($date));
              $dia = $datearray[0];
              $mes = $datearray[1];
              $año = $datearray[2];
              $newdate = $año . '-' . $mes . '-' . $dia;

              // echo 'Asset:'.$asset . 'Desc:' . $desc .'Date:' . $newdate .'Site:'. $site.'Locacion:'. $locacion.'<br>';

                  // Obtenemos informacion
                  if (isset($Row[5])) { //VERIFICAMOS QUE NO EXISTA UNA COLUMAN MAS AL DOCUMENTO
                    $alerta = [
                      "Alerta" => "simple",
                      "Titulo" => "Error de Archivo",
                      "Texto"  => "Verifique que el archivo tenga el formato correspondiente asi como las columnas.",
                      "Tipo"   => "error"  
                    ];
                    echo json_encode($alerta);
                    exit();
                  }

                  //revisamos si ya existe el activo
                  $activo_asset = ActivosModel::ver_un_activos_por_asset(trim($Row[0]));
                  if ($activo_asset) {
                    $existe = 1;
                  } else {
                    $existe = 0;
                  }

                if ($existe == 1) { //validamos si ya existe en la BD true = existe, false = no existe            
            
                  $id = $activo_asset['idCA'];
                  $epc = trim($activo_asset['TagEpc']);
        
                    if (isset($asset)) {
                      $asset_upd = mainmodel::limpiar_cadena($asset);
                    }
                    if (isset($desc)) {
                      $desc_upd = mainmodel::limpiar_cadena($desc);
                    }
                    if (isset($date)) {
                      $date_upd = mainmodel::limpiar_cadena($newdate);
                    }
                    if (isset($site)) {
                      $site_upd = mainmodel::limpiar_cadena($site);
                    }
                    if (isset($locacion)) {
                      $locacion_upd = mainmodel::limpiar_cadena($locacion);
                    }

                    
                    if ($epc == 'No asignado') {
                      $datos_activos_upd = [
                        "id" => $id,
                        "asset" => $asset_upd,
                        "description" => $desc_upd,
                        "date_inventory" => $date_upd,
                        "site" => $site_upd,
                        "locacion" => $locacion_upd,
                      ];
                      $update_activo = ActivosModel::actualizar_activo_masivo_modelo($datos_activos_upd); //llamamos la funcion del modelo 
                      if ($update_activo) {
                        $actualizados = $actualizados + 1;
                      } 
                    }else{  
                      // echo 'id:'.$id.'Asset:'.$asset_upd . 'Desc:' . $desc_upd .'Date:' . $date_upd .'Site:'. $site_upd.'Locacion:'. $locacion_upd.'EPC:'.$epc.'<br>';
                      $datos_activos_upd = [
                        "id" => $id,
                        "asset" => $asset_upd,
                        "description" => $desc_upd,
                        "date_inventory" => $date_upd,
                        "site" => $site_upd,
                        "locacion" => $locacion_upd
                      ];
                      $update_activo = ActivosModel::actualizar_activo_masivo_modelo_sin_epc($datos_activos_upd); //llamamos la funcion del modelo 
                      if ($update_activo ) {
                        $actualizados = $actualizados + 1;
                      } 
                      
                    }
        
                  } else {
                    
                    // echo 'Asset:'.$asset . 'Desc:' . $desc .'Date:' . $newdate .'Site:'. $site.'Locacion:'. $locacion.'<br>';
                    $datos_activos_reg = [
                      "asset" => $asset,
                      "description" => $desc,
                      "date_inventory" => $newdate,
                      "site" => $site,
                      "epc" => '',
                      "locacion" => $locacion,
                    ];
                    $agregar_activo = ActivosModel::agregar_activo_masivo_modelo($datos_activos_reg);
                    if ($agregar_activo) {
                      $agregados = $agregados + 1;
                    }
                  }             
                } 
                // *******ALERTA DE SE AGREGO O NO LOS ACTIVOS 
                if ($agregar_activo == 1 || $update_activo == 1) {
                  $alerta = [
                    "Alerta" => "limpiar",
                    "Titulo" => "Activo Registrado",
                    "Texto"  => "Se han agregado " . $agregados . " activos y se han actualizado " . $actualizados . " registros en el sistema.",
                    "Tipo"   => "success"
                  ];
                  echo json_encode($alerta);
                  exit();
              }
        }


      }else{
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Error de Archivo",
          "Texto"  => "Verifique que el archivo tenga el formato correspondiente asi como las columnas.",
          "Tipo"   => "error"  
        ];
        echo json_encode($alerta);
        exit();
      }
 }
  ########################################################################
  #                           AGREGAR ACTIVO                            #
  ########################################################################
  public function agregar_activo_controller()
  {

    $fecha_actual = date("Y-m-d H:i:s");

    $temporal = $_FILES['avatar']['tmp_name'];
    $nombre_img = $_FILES['avatar']['name'];
    $carpeta = '../public/img/activos';
    $ruta = $carpeta . '/' . $nombre_img;
    move_uploaded_file($temporal, $ruta);

    $asset = Mainmodel::limpiar_cadena($_POST['asset_reg']);
    $desc = Mainmodel::limpiar_cadena($_POST['desc_reg']);
    $planta = Mainmodel::limpiar_cadena($_POST['planta_reg']);
    $columna = Mainmodel::limpiar_cadena($_POST['columna_reg']);
    $num_columna = Mainmodel::limpiar_cadena($_POST['num_col_reg']);
    $tipo_activo = '02';
    $tipo_poste = '01';
    $fecha = $fecha_actual;
    $inventario = '0';
    if (isset($_POST['serv_1_reg'])) {
      $serv1 = Mainmodel::limpiar_cadena($_POST['serv_1_reg']);
    } else {
      $serv1 = 'null';
    }


    $epc_poste = 'cad12014' . $tipo_poste . '00000000' . $planta . $columna . $num_columna;

    // ************COMPROBAR LOS CAMPOS VACIOS **********
    if ($asset == "" || $planta == "" || $columna == "" || $num_columna == "") {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => "No has llenado todos los campos que son obligatorios.",
        "Tipo"   => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
    // *************+COMPROBAR SI EL Asset existe EXISTE
    $check_asset = ActivosModel::ver_un_activos_por_asset($asset);
    if ($check_asset) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => "El Asset que  quieres registrar, ya se encuentra en el sistema, revisa nuevamente.",
        "Tipo"   => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
    // ****FIN DEL CONTROLADOR***


    // *************+COMPROBAR SI EL USUARIO EXISTE
    $check_epc = Mainmodel::ejecutar_cosulta_simple("SELECT top(1) TagEpc from tblCA order by TagEpc ASC");
    $epc = Mainmodel::limpiar_cadena($check_epc['TagEpc']);
    if ($epc == "No asignado") { //si la consulta devuelve vacio empezara a 1
      $consecutivo =  1;
      $length = 14;
      $string = substr(str_repeat(0, $length) . $consecutivo, -$length);
      $epc_activo = 'cad12014' . $tipo_activo . $string;
    } else {
      $rest = substr($check_epc['TagEpc'], -14);
      $consecutivo = $rest + 1;
      $length = 14;
      $string = substr(str_repeat(0, $length) . $consecutivo, -$length);
      $epc_activo = 'cad12014' . $tipo_activo . $string;

      // $alerta=[
      //   "Alerta" => "simple",
      //   "Titulo" => "EPC Y EPC UBICACION",
      //   "Texto"  => "El epc es: ".$epc_activo."y el epcubicacion: " . $epc_poste ,
      //   "Tipo"   => "success"
      // ];
      // echo json_encode($alerta);
      // exit();
    }

    $datos_activos_reg = [
      "asset" => $asset,
      "desc" => $desc,
      "epc_activo" => $epc_activo,
      "epc_poste" => $epc_poste,
      "fecha" => $fecha,
      "inventario" => $inventario,
      "serv1" => $serv1
    ];

    $agregar_activo = ActivosModel::agregar_activo_modelo($datos_activos_reg);

    if ($agregar_activo) {
      $alerta = [
        "Alerta" => "limpiar",
        "Titulo" => "Activo Registrado",
        "Texto"  => "Los datos del activo han sido registrado con exito.",
        "Tipo"   => "success"
      ];
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => "No se ha podido registrar el activo.",
        "Tipo"   => "error"
      ];
    }
    echo json_encode($alerta);
  } // ****FIN DEL CONTROLADOR***

  ########################################################################
  #                           Eliminar Activo                            #
  ########################################################################

  public function eliminar_activo_controller()
  {

    $id = Mainmodel::decryption($_POST['activo_id_delete']);
    $id = mainmodel::limpiar_cadena($id);

    // comprobar que no sea el activo principal
    // if ($id == 1) {
    //   $alerta=[
    //     "Alerta" => "simple",
    //     "Titulo" => "Ocurrio un error inesperado",
    //     "Texto"  => "No sepuede eliminar el superusuario principal del sistema.",
    //     "Tipo"   => "error"
    //   ];
    //   echo json_encode($alerta);
    //   exit();
    // }

    // comprobamos privilegios

    session_start(['name' => 'SCA']);
    if ($_SESSION['rol_sca'] == 'Admin') {
      $eliminar_activo = ActivosModel::eliminar_activo_modelo($id);
      if ($eliminar_activo) {
        $alerta = [
          "Alerta" => "recargar",
          "Titulo" => "Activo Eliminado",
          "Texto"  => "Los datos del activo se han eliminado con exito.",
          "Tipo"   => "success"
        ];
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No se ha podido eliminar el activo, consulte al administrador del sistema.",
          "Tipo"   => "error"
        ];
      }
      echo json_encode($alerta);
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => "No tiene el permiso para eliminar activos.",
        "Tipo"   => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  } // ****FIN DEL CONTROLADOR***

  ########################################################################
  #                           Actualizar Activo                            #
  ########################################################################

  public function actualizar_activo_controller()
  {

    // CONSULTAMOS ID
    $id = $_POST['activo_id_upd'];
    // $id = mainmodel::limpiar_cadena($id);
    $activo = ActivosModel::ver_un_activo2($id);


    // RECOPILAMOS LOS DATOS SI NO TIENE DATOS DEL FORMULARIO SE QUEDA CON EL DE LA BD
    $tipo_poste = '01';
    $fecha = date("Y-m-d H:i:s");

    // $temporal = $_FILES['avatar']['tmp_name'];
    // $nombre_img = $_FILES['avatar']['name'];
    // $carpeta = '../public/img/activos';
    // $ruta = $carpeta . '/' . $nombre_img;

    // if ($ruta == $activo['Ruta']) {
    //   $alerta = [
    //     "Alerta" => "simple",
    //     "Titulo" => "Ocurrio un error inesperado",
    //     "Texto"  => " Ya existe un nombre de imagen existente en la base de datos, cambia el nombre de la imagen.",
    //     "Tipo"   => "error"
    //   ];
    // } else {
    //   move_uploaded_file($temporal, $ruta);
    // }


    if (isset($_POST['asset_upd'])) {
      $asset_upd = mainmodel::limpiar_cadena($_POST['asset_upd']);
    } else {
      $asset_upd = $activo['Asset'];
    }
    if (isset($_POST['desc_upd'])) {
      $desc_upd = mainmodel::limpiar_cadena($_POST['desc_upd']);
    } else {
      $desc_upd = $activo['Description'];
    }
    if (isset($_POST['num_serial_upd'])) {
      $num_serial = mainmodel::limpiar_cadena($_POST['num_serial_upd']);
    } else {
      $num_serial = $activo['SerialNumber'];
    }
    $epc = $activo['TagEpc'];
    // COPARAMOS SI TIENE TAG PARA ACTUALIZAR EL EPC O SINO SOLO SERVICE003
    if ($activo['TagSite']=='') {
      $planta_upd = mainmodel::limpiar_cadena($_POST['planta_upd']);
      $columna_upd = mainmodel::limpiar_cadena($_POST['columna_upd']);
      $num_col_upd = mainmodel::limpiar_cadena($_POST['num_col_upd']);
      $planta = substr($planta_upd,-1);
      $columna2 = ActivosModel::ver_ubicacion_activo($columna_upd);

      $service003 = $columna2 . $num_col_upd;
      $epc_poste = $activo['TagSite'];
    }else{
      if (isset($_POST['planta_upd']) && isset($_POST['columna_upd']) && isset($_POST['num_col_upd'])) {
        $planta_upd = mainmodel::limpiar_cadena($_POST['planta_upd']);
        $columna_upd = mainmodel::limpiar_cadena($_POST['columna_upd']);
        $num_col_upd = mainmodel::limpiar_cadena($_POST['num_col_upd']);
        $planta = substr($planta_upd,-1);
        $columna2 = ActivosModel::ver_ubicacion_activo($columna_upd);
        $service003 = $columna2 . $num_col_upd;
        $epc_poste = 'cad12014' . $tipo_poste . '00000000' . $planta_upd . $columna_upd . $num_col_upd;
      } else {
        $epc_poste = $activo['TagSite'];
      }

    }
    
    if (isset($_POST['date_upd'])) {
      $date_upd = mainmodel::limpiar_cadena($_POST['date_upd']);
    } else {
      $date_upd = $activo['DateInventory'];
    }
    


    session_start(['name' => 'SCA']);
    if ($_SESSION['rol_sca'] == 'Admin') {

      $datos_activos_upd = [
        "id" => $id,
        "asset" => $asset_upd,
        "description" => $desc_upd,
        "serialnumber" => $num_serial,
        "epc_tag" => $epc,
        "epc_tagsitefound" => $epc_poste,
        "s2" => $planta,
        "s3" => $service003
      ];
      $update_activo = ActivosModel::actualizar_activo_modelo($datos_activos_upd); //llamamos la funcion del modelo 
      if ($update_activo) {
        $alerta = [
          "Alerta" => "recargar",
          "Titulo" => "Activo Actualizado",
          "Texto"  => "Los datos del activo se han actualizado con exito.",
          "Tipo"   => "success"
        ];
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => $activo['idCA'] . " No se ha podido actualizar el activo, consulte al administrador del sistema.",
          "Tipo"   => "error"
        ];
      }
      echo json_encode($alerta);
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => "No tiene el permiso para eliminar activos.",
        "Tipo"   => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  } // ****FIN DEL CONTROLADOR***

}
