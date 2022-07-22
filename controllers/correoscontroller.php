<?php

if ($peticionAjax) {
  require_once("../models/correosmodel.php"); //para ver las notificaciones
} else {
  require_once("./models/correosmodel.php");//para consultas
}
class correosController extends CorreosModel
{



    ########################################################################
    #                           ACTUALIZAR CUENTA DE CORREO                            #
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
    #                           CREAR CUENTA DE CORREO                            #
    ########################################################################
    public function crear_correo_controller()
    { 
      $nombre = mainmodel::limpiar_cadena($_POST['nombre_reg']);
      $apellidop = mainmodel::limpiar_cadena($_POST['apellidop_reg']);
      $apellidom = mainmodel::limpiar_cadena($_POST['apellidom_reg']);
      $correo = mainmodel::limpiar_cadena($_POST['correo_reg']);
      $estado = mainmodel::limpiar_cadena($_POST['estado_reg']);     
      
      $existe = CorreosModel::ver_correo_por_correo($correo);  

      if ($existe) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "El correo ".$correo.' ya existe en la base de datos, por favor ingrese otro.',
            "Tipo"   => "error"
          ];
          echo json_encode($alerta);
          exit();
      }


        //   VERIFICAMOS SI EL USUARIO TIENE LOS PERMISOS PARA CREAR 
      session_start(['name' => 'SCA']);
      if ($_SESSION['rol_sca'] == 'Admin') {
  
        $datos_activos_upd = [
          "nombre" => $nombre,
          "apellido_p" => $apellidop,
          "apellido_m" => $apellidom,
          "correo_electronico" => $correo,
          "estado" => $estado,
        ];
        $update_activo = CorreosModel::agregar_correo_modelo($datos_activos_upd); //llamamos la funcion del modelo 
        if ($update_activo) {
          $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Cuenta de Correo Creada",
            "Texto"  => "La cuenta de correo electrónico se han creado con exito.",
            "Tipo"   => "success"
          ];
        } else {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "No se ha podido crear la cuenta de correo, consulte al administrador del sistema.",
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

     ########################################################################
    #                           Eliminar CUENTA DE CORREO                            #
    ########################################################################

    public function eliminar_correo_controller()
    {
  
      $id = $_POST['correo_id_delete'];
      $id = mainmodel::limpiar_cadena($id);
      // comprobamos privilegios
  
      session_start(['name' => 'SCA']);
      if ($_SESSION['rol_sca'] == 'Admin') {
        $eliminar_correo = CorreosModel::eliminar_correo_modelo($id);
        if ($eliminar_correo) {
          $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Cuenta de Correo Eliminado",
            "Texto"  => "La cuenta de correo electrónico se han eliminado con exito.",
            "Tipo"   => "success"
          ];
        } else {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "No se ha podido eliminar la cuenta de correo, consulte al administrador del sistema.",
            "Tipo"   => "error"
          ];
        }
        echo json_encode($alerta);
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No tiene el permiso para eliminar cuentas de correo electrónicos.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }
    } // ****FIN DEL CONTROLADOR***


}
