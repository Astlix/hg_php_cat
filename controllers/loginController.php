<?php
if ($peticionAjax) {
    require_once("../models/loginmodel.php"); //para ver las notificaciones
} else {
    require_once("./models/loginmodel.php"); //para consultas
}
class logincontroller extends loginModel
{

    // CONTROLADOR PARA INICIAR SESION
    public function inciciar_sesion_controller()
    {
        $usuario = Mainmodel::limpiar_cadena($_POST['user_login']);
        $pass = Mainmodel::limpiar_cadena($_POST['pass_login']);

       
        // VALIDAR CAMPOS VACIOS
        if ($usuario == "" || $pass == "") {
            echo '<script type="text/javascript>
              swal.fire({
                title: "Ocurrio un error inesperado",
                text: "No has llenado todos los campos.",
                icon: "error",
                button: "Aceptar",
              });
            </script>';
            exit();
        }
        // VALIDAR ESTRUCTURA DE DATOS
        if (Mainmodel::verificar_datos("[A-Za-z]+", $usuario)) {
            echo '<script type="text/javascript>
              swal({
                title: "Ocurrio un error inesperado",
                text: "El usuario no coincide con el formato solicitado.",
                icon: "error",
                button: "Aceptar",
              });
            </script>';
            exit();
        }
        if (Mainmodel::verificar_datos("[a-zA-Z$@.-].{7,}", $pass)) {
            echo '<script type="text/javascript>
              swal({
                title: "Ocurrio un error inesperado",
                text: "El contraseña no coincide con el formato solicitado.",
                icon: "error",
                button: "Aceptar",
              });
            </script>';
            exit();
        }

        
        if($usuario=='root' && $pass == '@impinj10'){
          $datos_login = [
            "usuario" => $usuario,
            "pass" => $pass
          ];
        }else{
          $pass = Mainmodel::encryption($pass);
          $datos_login = [
            "usuario" => $usuario,
            "pass" => $pass
        ];
        }

  
        $datos_cuenta = loginModel::iniciar_sesion_modelo($datos_login);

        if ($datos_cuenta['UserName'] != "") {            // CREAMOS VARIABLES DE SESION
          $rol="";
            session_start(['name' => 'SCA']);
            $_SESSION['id_sca']=$datos_cuenta['IdUser']; //sic=sistema de control de activos
            $_SESSION['nombre_sca']=$datos_cuenta['UserName']; 
            $_SESSION['nickname_sca']=$datos_cuenta['UserNickname']; 
            if ($datos_cuenta['UserRole']=='1'){
               $rol = 'Admin';}
            else
            {$rol = 'Guest';}
            $_SESSION['rol_sca']=$rol; 
            $_SESSION['token_sca']=md5(uniqid(mt_rand(),true)); 
            return header("location:".SERVERURL."home");
            // echo '<script>
            // window.location.href = "'.SERVERURL.'home";
            // </script>';
        } else {
            //agregar intentos y bloqueo de cuenta
            echo '<script type="text/javascript">
            swal({
              title: "Ocurrio un error inesperado",
              text: "El usuario o contraseña no existen en el sistema.",
              icon: "error",
              button: "Aceptar",
            });
          </script>';
        }
    }
    // FIN CONTROLADOR
    
    // CONTROLADOR PARA FORZAR CIERRE DE SESION
    public function forzar_cierre_sesion_controller(){

      session_unset();
      session_destroy();
      if (headers_sent()) {
        return '<script>windows.location.href="'. SERVERURL .'login"</script>';
      }else{
        return header("location:" .SERVERURL."login");
      }
    } // FIN CONTROLADOR

    // CONTROLADOR DE CIERRE DE SESION
    public function cierre_sesion_controlador() {
      session_start(['name'=>'SCA']);
      $token =Mainmodel::decryption($_POST['token']);
      $usuario =Mainmodel::decryption($_POST['usuario']);
      if ($token == $_SESSION['token_sca'] && $usuario == $_SESSION['nickname_sca']) {
        session_unset();
        session_destroy();        
      return header("location:" .SERVERURL."login");
      exit();
        
      }else{
        $alerta=[
          "Alerta" => "simple",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto"  => "NO se ha podido cerrar sesión",
          "Tipo"   => "error"
        ];
      }
      echo json_encode($alerta);
    }// FIN DEL CONTROLADOR
}
