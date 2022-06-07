<?php
require_once 'mainmodel.php';

class UserModel extends Mainmodel{

    // *************REVISAR CONEXION A BD ***************
    public function checarConexion(){
        if(Mainmodel::conectar() != ''){
          return true;
        }
      }

      ########################################################################
    #                         Jalar Query de Archivo                       #
    ########################################################################
    private function llamarQuery($archivo){
        $qry = file_get_contents("../views/resources/".$archivo.".sql");
        return $qry;
      }

  ########################################################################
    #                           Consulta Todos los Usuarios                             #
    ########################################################################
    public function ver_usuarios(){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblUser");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
      }

    ########################################################################
    #                           AGREGAR USUARIO                            #
    ########################################################################
    public static function agregar_usuario_modelo($datos){
      // echo $datos['name'].'|'.$datos['password'].'|'.$datos['email'].'|'.$datos['rol'].'|'.$datos['fecha'].'|'.$datos['nickname'].'|'.$datos['cuenta'];

        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblUser (UserName,UserPassword,UserEmail,UserRole,FechaCreacion,UserNickname,cuenta,pass1) values 
        (:name,:pass,:email,:rol,:fecha,:nickname,:cuenta,:pass2)");
        
        $sql->bindParam(":name",$datos['name']);
        $sql->bindParam(":pass",$datos['password']);
        $sql->bindParam(":email",$datos['email']);
        $sql->bindParam(":rol",$datos['rol']);
        $sql->bindParam(":fecha",$datos['fecha']);
        $sql->bindParam(":nickname",$datos['nickname']);
        $sql->bindParam(":cuenta",$datos['cuenta']);
        $sql->bindParam(":pass2",$datos['password']);
     
        if($sql->execute()){
          return true;
        } else {
          return false;
        }
      }

}