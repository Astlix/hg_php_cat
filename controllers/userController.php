<?php

if ($peticionAjax) {
  require_once("../models/usermodel.php"); //para ver las notificaciones
} else {
  require_once("./models/usermodel.php");//para consultas
}
class Usercontroller extends UserModel
{
  public function tabla_usuarios()
  {
    $rsp = UserModel::ver_usuarios();
    if (empty($rsp)) {
      $elemento  = '<div class="box-cont-negro titulo-box m-0">';
      $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Movimientos</small></h4>';
      $elemento .= '</div>';
      echo $elemento;
    } else {
      $tabla  = '<table class="table table-striped table-dark salidas-tabla dt_active">';
      $tabla .= '<thead>';
      $tabla .= '<tr>';
      $tabla .= '<th scope="col">#</th>';
      $tabla .= '<th scope="col">Nombre</th>';       // Fecha
      $tabla .= '<th scope="col">Usuario</th>';        // Tipo
      $tabla .= '<th scope="col">Email</th>';        // Tipo
      $tabla .= '<th scope="col">Rol</th>';     // Nombre
      $tabla .= '<th scope="col">Fecha</th>';          // Nombre
      $tabla .= '<th scope="col">Acciones</th>';          // Nombre
      $tabla .= '</tr>';
      $tabla .= '</thead>';
      $tabla .= '<tbody>';
      $i = 0;

      foreach ($rsp as $dato) {
        $i++;
        $tabla .= '<tr class="elemento">';
        $tabla .= '<td scope="col">' . $i . '</td>';
        $tabla .= '<td scope="col" class="salida">' . $dato['UserName'] . '</td>';
        $tabla .= '<td scope="col" class="lote">' . $dato['UserNickname'] . '</td>';
        $tabla .= '<td scope="col" class="lote">' . $dato['UserEmail'] . '</td>';
        $tabla .= '<td scope="col" class="lote">' . $dato['UserRole'] . '</td>';
        $tabla .= '<td scope="col" class="lote">' . $dato['FechaCreacion'] . '</td>';
        $tabla .= '<td><a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" href="' . SERVERURL . 'editarusuario/"><i class="bx bx-edit nav_icon" aria-hidden="true" style="font-size:20px"></i></a></td>';

        $tabla .= '</tr>';
      }
      $tabla .= '</tbody>';
      $tabla .= '</table>';
      echo $tabla;
    }
  }

    ########################################################################
    #                           AGREGAR USUARIO                            #
    ########################################################################
    public function agregar_usuario_controller(){
      $fecha_actual= date("Y/m/d");
      $name=Mainmodel::limpiar_cadena($_POST['name_reg']);
      $nickname=Mainmodel::limpiar_cadena($_POST['nickname_reg']);
      $email=Mainmodel::limpiar_cadena($_POST['email_reg']);
      $rol=Mainmodel::limpiar_cadena($_POST['rol_reg']);
      $fecha=$fecha_actual;
      $pass=Mainmodel::limpiar_cadena($_POST['pass_reg']);
      $cpass=Mainmodel::limpiar_cadena($_POST['cpass_reg']);

      

      // ************COMPROBAR LOS CAMPOS VACIOS **********
      if($name == "" || $pass == "" || $nickname =="" || $cpass =="" || $email == ""){
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No has llenado todos los campos que son obligatorios.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }

      // ************VERIFICACION DE DATOS **********

      if (Mainmodel::verificar_datos("[a-zA-Z].{1,}",$name)) {
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "El nombre no coincide con el formato solicitado.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      } 
      if (Mainmodel::verificar_datos("[a-zA-Z$@.-].{7,}",$pass)) {
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "La contraseña debe tener: \nMin 8 caracteres \nUn numero\n Una letra en mayúscula\n Una letra minúscula \nUn carácter especial (!#$%&'()=@) ".$pass.$cpass."",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      } 
      if ($pass!=$cpass) {

        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "Las contraseñas no coinciden.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        
        exit();
      }else{
        $password=Mainmodel::encryption($pass);
      }

      // *************+COMPROBAR SI EL USUARIO EXISTE
      $check_user = Mainmodel::ejecutar_cosulta_simple("SELECT UserName from tblUser where UserName ='$name'");
      if(is_array($check_user)){
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "El usuario ya se encuentra registrado en el sistema",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }

      // ******COMRPOVANDO ROL
      if ($rol<1 || $rol>3) {
        
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "EL rol seleccionado no es valido.".$check_user,
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }

      $datos_usuario_reg=[
        "name"=>$name,
        "password"=>$password,
        "email"=>$email,
        "rol"=>$rol,
        "fecha"=>$fecha,
        "nickname"=>$nickname,
        "password"=>$password,
        "cuenta"=>'activa'   
      ];
      $agregar_usuario = UserModel::agregar_usuario_modelo($datos_usuario_reg);

      if ($agregar_usuario) {
        $alerta=[
          "Alerta" => "limpiar",
          "Titulo" => "Usuario Registrado",
          "Texto"  => "Los datos del usuario han sido registrado con exito.",
          "Tipo"   => "success"
        ];
      } else {
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No se ha podido registrar el usuario.",
          "Tipo"   => "error"
        ];
      }
    
      echo json_encode($alerta);
      

    }// ****FIN DEL CONTROLADOR***

    ########################################################################
    #                           UPDATE USUARIO                            #
    ########################################################################
    public static function update_usuario_controller(){
      $name=Mainmodel::limpiar_cadena($_POST['name_upd']);
      $nickname=Mainmodel::limpiar_cadena($_POST['nickname_upd']);
      $email=Mainmodel::limpiar_cadena($_POST['email_upd']);
      $rol=Mainmodel::limpiar_cadena($_POST['rol_update']);
      $fecha = date("Y/m/d");
      $pass=Mainmodel::limpiar_cadena($_POST['pass_upd']);
      $cpass=Mainmodel::limpiar_cadena($_POST['cpass_upd']);        
      $id=Mainmodel::limpiar_cadena($_POST['id_update']);        

      if (Mainmodel::verificar_datos("[a-zA-Z].{1,}",$name)) {
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "El nombre no coincide con el formato solicitado.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      } 

      // ******COMRPOVANDO ROL
      if ($rol<1 || $rol>3) {
        
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "EL rol seleccionado no es valido.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }

     // SELECCIONAR SI SE ACCTUALIZAR CON CONTRASEÑA Y SIN CONTRASEÑA

      if ($pass == '') {
        $datos_usuario_upd=[
          "id_update"=>$id,
          "name"=>$name,
          "email"=>$email,
          "rol"=>$rol,
          "fecha"=>$fecha,
          "nickname"=>$nickname,
          "cuenta"=>'activa'   
        ]; 
        $upd_usuario = UserModel::update_usuario_controller_sp($datos_usuario_upd);
      }else{
        if (Mainmodel::verificar_datos("[a-zA-Z$@.-].{7,}",$pass)) {
          $alerta=[
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "La contraseña debe tener: \nMin 8 caracteres \nUn numero\n Una letra en mayúscula\n Una letra minúscula \nUn carácter especial (!#$%&'()=@) ".$pass.$cpass."",
            "Tipo"   => "error"
          ];
          echo json_encode($alerta);
          exit();
        }
        if ($pass!=$cpass) {
  
          $alerta=[
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "Las contraseñas no coinciden.",
            "Tipo"   => "error"
          ];
          echo json_encode($alerta);        
          exit();
        }else{
          $pass=Mainmodel::encryption($pass);
          $datos_usuario_upd=[
            "id_update"=>$id,
            "name"=>$name,
            "password"=>$pass,
            "email"=>$email,
            "rol"=>$rol,
            "fecha"=>$fecha,
            "nickname"=>$nickname,
            "cuenta"=>'activa'   
          ]; 
        }
        $upd_usuario = UserModel::update_usuario_controller_cp($datos_usuario_upd);
      }



      if ($upd_usuario) {
        $alerta=[
          "Alerta" => "limpiar",
          "Titulo" => "Usuario Actualizado",
          "Texto"  => "Los datos del usuario han sido actualizados con exito.",
          "Tipo"   => "success"
        ];
      } else {
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Error de Actualización",
          "Texto"  => "No se ha podido actualizar el usuario.",
          "Tipo"   => "error"
        ];
      }
    
      echo json_encode($alerta);
      

    }// ****FIN DEL CONTROLADOR***

    public static function delete_usuario_controller(){
      $id=Mainmodel::limpiar_cadena($_POST['id_delete']); 
      
      session_start(['name' => 'SCA']);
      if ($_SESSION['rol_sca'] == 'Admin') {
        $delete_user = UserModel::delete_user_modelo($id);
        if ($delete_user) {
          $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Usuario Eliminado",
            "Texto"  => "El usuario se han eliminado con exito.",
            "Tipo"   => "success"
          ];
        } else {
          $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto"  => "No se ha podido eliminar el usuario, consulte al administrador del sistema.",
            "Tipo"   => "error"
          ];
        }
        echo json_encode($alerta);
      } else {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "No tiene el permiso para eliminar el usuario.",
          "Tipo"   => "error"
        ];
        echo json_encode($alerta);
        exit();
      }

    }
}
