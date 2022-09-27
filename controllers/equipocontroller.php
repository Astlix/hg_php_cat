<?php

if ($peticionAjax) {
  require_once("../models/equipomodel.php"); //para ver las notificaciones
} else {
  require_once("./models/equipomodel.php");//para consultas
}
class equipoController extends EquipoModel
{



    ########################################################################
    #                           ACTUALIZAR CUENTA DE CORREO                #
    ########################################################################
    public function actualizar_correo_controller()
    {  
      // CONSULTAMOS ID
      $id = $_POST['correo_id_upd'];
      $activo = CorreosModel::ver_un_correo($id);  

        $id = mainmodel::limpiar_cadena($_POST['correo_id_upd']);
        $nombre = mainmodel::limpiar_cadena($_POST['nombre_upd']);
        $apellidop = mainmodel::limpiar_cadena($_POST['apellidop_upd']);
        $apellidom = mainmodel::limpiar_cadena($_POST['apellidom_upd']);
        $correo = mainmodel::limpiar_cadena($_POST['correo_upd']);
        $estado = mainmodel::limpiar_cadena($_POST['estado_upd']);     
  
        //   VERIFICAMOS SI EL USUARIO TIENE LOS PERMISOS PARA EDITAR 
      session_start(['name' => 'SCA']);
      if ($_SESSION['rol_sca'] == 'Admin') {
  
        $datos_activos_upd = [
          "id" => $id,
          "nombre" => $nombre,
          "apellido_p" => $apellidop,
          "apellido_m" => $apellidom,
          "correo_electronico" => $correo,
          "estado" => $estado,
        ];
        $update_activo = CorreosModel::actualizar_correo_modelo($datos_activos_upd); //llamamos la funcion del modelo 
        if ($update_activo) {
          $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Cuenta de Correo Actualizado",
            "Texto"  => "Los datos del correo electrónico se han actualizado con exito.",
            "Tipo"   => "success"
          ];
        } else {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "No se ha podido actualizar la cuenta de correo, consulte al administrador del sistema.",
            "Tipo"   => "error"
          ];
        }
        echo json_encode($alerta);
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Accción Denegada",
          "Texto"  => "No tiene el permiso para actualizar cuentas de correo electrónico.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }
    } // ****FIN DEL CONTROLADOR***
    ########################################################################
    #                           AGREGAAR NUEVA HH                          #
    ########################################################################
    public function crear_HH_controller()
    { 
      $mac = mainmodel::limpiar_cadena($_POST['mac_hh_reg']);
      $marca = mainmodel::limpiar_cadena($_POST['marca_hh_reg']);   
      $modelo = mainmodel::limpiar_cadena($_POST['modelo_hh_reg']);
      
      $existe = EquipoModel::ver_hh_mac($mac);  

      if ($existe) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "La Handl Held con la MAC: ".$mac.' ya existe en la base de datos, por favor ingrese otro.',
            "Tipo"   => "error"
          ];
          echo json_encode($alerta);
          exit();
      }


        //   VERIFICAMOS SI EL USUARIO TIENE LOS PERMISOS PARA CREAR 
      session_start(['name' => 'SCA']);
      if ($_SESSION['rol_sca'] == 'Admin') {
  
        $datos_hh_new = [
          "mac" => $mac,
          "marca" => $marca,
          "modelo" => $modelo,
        ];
        $crear_hh = EquipoModel::agregar_hh_reg($datos_hh_new); //llamamos la funcion del modelo 
        if ($crear_hh) {
          $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Hand Held Agregado",
            "Texto"  => "La Hand Held se han agregado con exito.",
            "Tipo"   => "success"
          ];
        } else {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "No se ha podido agregar los datos, consulte al administrador del sistema.",
            "Tipo"   => "error"
          ];
        }
        echo json_encode($alerta);
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Accción Denegada",
          "Texto"  => "No tiene el permiso para crear cuentas de correo electrónico.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }
    } // ****FIN DEL CONTROLADOR***

     #######################################################################
    #                           Eliminar CUENTA DE CORREO                  #
    ########################################################################

    public function eliminar_hh_controller()
    {
  
      $id = $_POST['hh_id_delete'];
      $id = mainmodel::limpiar_cadena($id);
      // comprobamos privilegios
  
      session_start(['name' => 'SCA']);
      if ($_SESSION['rol_sca'] == 'Admin') {
        $eliminar_correo = EquipoModel::eliminar_hh_modelo($id);
        if ($eliminar_correo) {
          $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Hand Held",
            "Texto"  => "Los datos de la hand held se han eliminado con exito.",
            "Tipo"   => "success"
          ];
        } else {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "No se ha podido eliminar lso datos de la hand held, consulte al administrador del sistema.",
            "Tipo"   => "error"
          ];
        }
        echo json_encode($alerta);
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No tiene el permiso para eliminar datos de Hand Helds.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }
    } // ****FIN DEL CONTROLADOR***
 ########################################################################
    #                           ACTUALIZAR DATOS DE HH                           #
    ########################################################################
    public function actualizar_hh_controller()
    {  
      // CONSULTAMOS ID
      $id = $_POST['hh_id_upd'];
      $HH = EquipoModel::ver_hh_id($id);  

        $mac = mainmodel::limpiar_cadena($_POST['mac_upd']);
        $marca = mainmodel::limpiar_cadena($_POST['marca_upd']);
        $modelo = mainmodel::limpiar_cadena($_POST['modelo_upd']);
  
        //   VERIFICAMOS SI EL USUARIO TIENE LOS PERMISOS PARA EDITAR 
      session_start(['name' => 'SCA']);
      if ($_SESSION['rol_sca'] == 'Admin') {
  
        $datos_hh_upd = [
          "id" => $id,
          "mac" => $mac,
          "marca" => $marca,
          "modelo" => $modelo,
        ];
        $update_hh = EquipoModel::actualizar_hh_modelo($datos_hh_upd); //llamamos la funcion del modelo 
        if ($update_hh) {
          $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Hand Held",
            "Texto"  => "Los datos dela Hand Held se han actualizado con exito.",
            "Tipo"   => "success"
          ];
        } else {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "No se ha podido actualizar los datos de la Hand Held, consulte al administrador del sistema.",
            "Tipo"   => "error"
          ];
        }
        echo json_encode($alerta);
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Accción Denegada",
          "Texto"  => "No tiene el permiso para actualizar datos de Hand Helds.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }
    } // ****FIN DEL CONTROLADOR***

}
