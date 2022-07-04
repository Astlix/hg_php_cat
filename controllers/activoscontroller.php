<?php
date_default_timezone_set("America/Mexico_City");
if ($peticionAjax) {
  require_once("../models/activosmodel.php"); //para ver las notificaciones
} else {
  include("./models/activosmodel.php"); //para consultas
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
    if(end($partes) != 'csv'){
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
        $existe="";

        $datos = explode(",", $linea);

        /////VERIFICAMOS QUE EL DOCUMENTO TENGA LAS COLUMNAS IGUALES A LA BD
        $tamaño_arreglo = count($datos); 
        if ($tamaño_arreglo > 11 || $tamaño_arreglo < 11) {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Error de Archivo",
            "Texto"  => "Verifique que el archivo .csv tenga el formato correspondiente asi como las columnas.",
            "Tipo"   => "error"
          ];
          echo json_encode($alerta);
          exit();
        }
        ////FIN DE LA VERIFICACION

        $asset               = !empty($datos[0])  ? ($datos[0]) : '';
        $desc                = !empty($datos[1])  ? ($datos[1]) : '';
        $serial              = !empty($datos[2])  ? ($datos[2]) : '';
        $epc_activo          = !empty($datos[3])  ? ($datos[3]) : '';
        $epc_poste           = !empty($datos[4])  ? ($datos[4]) : '';
        $fecha               = date("Y-m-d H:i:s");
        $inventario          = !empty($datos[5])  ? ($datos[5]) : '0';
        $serv1               = !empty($datos[6])  ? ($datos[6]) : '';
        $serv2               = !empty($datos[7])  ? ($datos[7]) : '';
        $serv3               = !empty($datos[8])  ? ($datos[8]) : '';
        $serv4               = !empty($datos[9])  ? ($datos[9]) : '';
        $serv5               = !empty($datos[10])  ? ($datos[10]) : '';
        $ruta                = '../public/img/activos/cat.png';
        if ($i > 1) {
          $activo_asset = ActivosModel::ver_un_activos_por_asset($asset);
          if ($activo_asset) {
            $existe=true;
          } else {
            $existe=false;
          }

          ///////////////VERIFICAMOS SI EXISTE EL ACTIVO EN LA BD
          if ($epc_activo != '') {
            $tag_existe = ActivosModel::ver_un_activos_por_epc($epc_activo);
            if ($tag_existe) {
             $tag_esite=true;
            }else{$tag_esite=false;}
          }

          if (strlen($inventario) > 1) {//tiene que ser mayor a 1 para que no tome en cuenta el encabezado del archivo csv
            
            $alerta = [
              "Alerta" => "limpiar",
              "Titulo" => "Error de registro",
              "Texto"  => "Error en la fila " . $i . ' de tu archivo csv.',
              "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();

          } elseif($existe==true || $tag_existe==true) { //validamos si ya existe en la BD true = existe, false = no existe            

            $id = $activo_asset['idCA'];
            if (isset($asset))      {$asset_upd = mainmodel::limpiar_cadena($asset);} else {$asset_upd = $activo_asset['Asset'];}
            if (isset($desc))       {$desc_upd = mainmodel::limpiar_cadena($desc);} else {$desc_upd = $activo_asset['Description'];}
            if (isset($serial))       {$serial_upd = mainmodel::limpiar_cadena($serial);} else {$serial_upd = $activo_asset['SerialNumber'];}
            if (isset($epc_activo)) {$epc_activo_upd = mainmodel::limpiar_cadena($epc_activo);} else {$epc_activo_upd = $activo_asset['TagEpc'];}
            if (isset($epc_poste))  {$epc_poste_upd = mainmodel::limpiar_cadena($epc_poste);} else {$epc_poste_upd = $activo_asset['TagSite'];}
            // if (isset($fecha))      {$fecha_upd = mainmodel::limpiar_cadena($fecha);} else {$fecha_upd = $activo_asset['DateInventory'];}
            if (isset($inventario)) {$inventario_upd = mainmodel::limpiar_cadena($inventario);} else {$inventario_upd = $activo_asset['Inventory'];}
            if (isset($serv1)) {$serv1_upd = mainmodel::limpiar_cadena($serv1);} else {$serv1_upd = $activo_asset['Service001'];}
            if (isset($serv2)) {$serv2_upd = mainmodel::limpiar_cadena($serv2);} else {$serv2_upd = $activo_asset['Service002'];}
            if (isset($serv3)) {$serv3_upd = mainmodel::limpiar_cadena($serv3);} else {$serv3_upd = $activo_asset['Service003'];}
            if (isset($serv4)) {$serv4_upd = mainmodel::limpiar_cadena($serv4);} else {$serv4_upd = $activo_asset['Service004'];}
            if (isset($serv5)) {$serv5_upd = mainmodel::limpiar_cadena($serv5);} else {$serv5_upd = $activo_asset['Service005'];}
            if (isset($ruta)) {$ruta_upd = $ruta;} else {$ruta_upd = $activo_asset['Ruta'];}
            

          $datos_activos_upd = [
            "id" => $id,
            "asset" => $asset_upd,
            "description" => $desc_upd,
            "serialnumber" => $serial_upd,
            "epc_tag" => $epc_activo_upd,
            "epc_tagsitefound" => $epc_poste_upd,
            "inventory" => $inventario_upd,
            "s1" => $serv1_upd,
            "s2" => $serv2_upd,
            "s3" => $serv3_upd,
            "s4" => $serv4_upd,
            "s5" => $serv5_upd,
            "ruta" => $ruta_upd,
          ];
          $update_activo = ActivosModel::actualizar_activo_modelo($datos_activos_upd); //llamamos la funcion del modelo 
           $actualizados = $actualizados + 1;

          }else{
          //  echo "Nuevo ".$asset;
            $datos_activos_reg = [
              "asset" => $asset,
              "desc" => $desc,
              "epc_activo" => $epc_activo,
              "epc_poste" => $epc_poste,
              "fecha" => $fecha,
              "inventario" => $inventario,
              "serv1" => $serv1,
              "serv2" => $serv2,
              "serv3" => $serv3,
              "serv4" => $serv4,
              "serv5" => $serv5,
              "ruta" => $ruta,
            ];    
            $agregar_activo = ActivosModel::agregar_activo_modelo($datos_activos_reg);
            $agregados = $agregados + 1;
          } 
          
        }
      }
      // *******ALERTA DE SE AGREGO O NO LOS ACTIVOS 
      if (isset($agregar_activo) || isset($update_activo)) {
        $alerta = [
          "Alerta" => "limpiar",
          "Titulo" => "Activo Registrado",
          "Texto"  => "Se han agregado " . $agregados . " activos y se han actualizado ".$actualizados." registros en el sistema.",
          "Tipo"   => "success"
        ];
      }else{ 
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Error de archivo",
          "Texto"  => "No se ha podido registrar los activos, revise el formato y que sea extensión .csv",
          "Tipo"   => "error"
        ];
      }
      echo json_encode($alerta);
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
    if (isset($_POST['serv_2_reg'])) {
      $serv2 = Mainmodel::limpiar_cadena($_POST['serv_2_reg']);
    } else {
      $serv2 = 'null';
    }
    if (isset($_POST['serv_3_reg'])) {
      $serv3 = Mainmodel::limpiar_cadena($_POST['serv_3_reg']);
    } else {
      $serv3 = 'null';
    }
    if (isset($_POST['serv_4_reg'])) {
      $serv4 = Mainmodel::limpiar_cadena($_POST['serv_4_reg']);
    } else {
      $serv4 = 'null';
    }
    if (isset($_POST['serv_5_reg'])) {
      $serv5 = Mainmodel::limpiar_cadena($_POST['serv_5_reg']);
    } else {
      $serv5 = 'null';
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



    // *************+COMPROBAR SI EL USUARIO EXISTE
    $check_epc = Mainmodel::ejecutar_cosulta_simple("SELECT top(1) TagEpc from tblCA order by TagEpc DESC");
    if ($check_epc['TagEpc'] == "") { //si la consulta devuelve vacio empezara a 1
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
      "serv1" => $serv1,
      "serv2" => $serv2,
      "serv3" => $serv3,
      "serv4" => $serv4,
      "serv5" => $serv5,
      "ruta" => $ruta,
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
    // $id = Mainmodel::decryption($_POST['activo_id_upd']);
    $id = $_POST['activo_id_upd'];
    // $id = mainmodel::limpiar_cadena($id);
    $activo = ActivosModel::ver_un_activo2($id);


    // RECOPILAMOS LOS DATOS SINO TIENE DATOS DEL FORMULARIO SE QUEDA CON EL DE LA BD
    $fecha_actual = date("Y-m-d H:i:s");
    $tipo_poste = '01';
    $fecha = $fecha_actual;

    $temporal = $_FILES['avatar']['tmp_name'];
    $nombre_img = $_FILES['avatar']['name'];
    $carpeta = '../public/img/activos';
    $ruta = $carpeta . '/' . $nombre_img;

    if ($ruta == $activo['Ruta']) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => " Ya existe un nombre de imagen existente en la base de datos, cambia el nombre de la imagen.",
        "Tipo"   => "error"
      ];
    } else {
      move_uploaded_file($temporal, $ruta);
    }


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
    if (isset($_POST['planta_upd']) && isset($_POST['columna_upd']) && isset($_POST['num_col_upd'])) {
      $planta_upd = mainmodel::limpiar_cadena($_POST['planta_upd']);
      $columna_upd = mainmodel::limpiar_cadena($_POST['columna_upd']);
      $num_col_upd = mainmodel::limpiar_cadena($_POST['num_col_upd']);
      $epc_poste = 'cad12014' . $tipo_poste . '00000000' . $planta_upd . $columna_upd . $num_col_upd;
    } else {
      $epc_poste = $activo['TagSite'];
    }
    $inv_upd = mainmodel::limpiar_cadena($_POST['inv_upd']);
    if (isset($_POST['date_upd'])) {
      $date_upd = mainmodel::limpiar_cadena($_POST['date_upd']);
    } else {
      $date_upd = $activo['DateInventory'];
    }
    $s1 = mainmodel::limpiar_cadena($_POST['serv_1_upd']);
    $s2 = mainmodel::limpiar_cadena($_POST['serv_2_upd']);
    $s3 = mainmodel::limpiar_cadena($_POST['serv_3_upd']);
    $s4 = mainmodel::limpiar_cadena($_POST['serv_4_upd']);
    $s5 = mainmodel::limpiar_cadena($_POST['serv_5_upd']);


    session_start(['name' => 'SCA']);
    if ($_SESSION['rol_sca'] == 'Admin') {

      $datos_activos_upd = [
        "id" => $id,
        "asset" => $asset_upd,
        "description" => $desc_upd,
        "serialnumber" => $num_serial,
        "epc_tag" => $epc,
        "epc_tagsitefound" => $epc_poste,
        "inventory" => $inv_upd,
        "s1" => $s1,
        "s2" => $s2,
        "s3" => $s3,
        "s4" => $s4,
        "s5" => $s5,
        "ruta" => $ruta,
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
