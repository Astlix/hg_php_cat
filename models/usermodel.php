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
    public static function ver_usuarios(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tbluser");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
      }

    ########################################################################
    #                           AGREGAR USUARIO                            #
    ########################################################################
    public static function agregar_usuario_modelo($datos){
      // echo $datos['name'].'|'.$datos['password'].'|'.$datos['email'].'|'.$datos['rol'].'|'.$datos['fecha'].'|'.$datos['nickname'].'|'.$datos['cuenta'];
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tbluser 
        (UserName,UserPassword,UserEmail,UserRole,FechaCreacion,UserNickname,cuenta) values 
        (:name,:pass,:email,:rol,:fecha,:nickname,:cuenta)");
        
        $sql->bindParam(":name",$datos['name']);
        $sql->bindParam(":pass",$datos['password']);
        $sql->bindParam(":email",$datos['email']);
        $sql->bindParam(":rol",$datos['rol']);
        $sql->bindParam(":fecha",$datos['fecha']);
        $sql->bindParam(":nickname",$datos['nickname']);
        $sql->bindParam(":cuenta",$datos['cuenta']);
     
        if($sql->execute()){
          return true;
        } else {
          return false;
        }
      }
    public static function update_usuario_controller_cp($datos){
      // echo $datos['name'].'|'.$datos['password'].'|'.$datos['email'].'|'.$datos['rol'].'|'.$datos['fecha'].'|'.$datos['nickname'].'|'.$datos['cuenta'];
        $sql = Mainmodel::conectar()->prepare("UPDATE tbluser SET
        UserName = :name_update,UserPassword = :pass,UserEmail = :email, 
        UserRole = :rol_upd,FechaUpdate = :fecha_upd,UserNickname = :nickname 
        where idUser = :id_upd");
        
        $sql->bindParam(":name_update",$datos['name']);
        $sql->bindParam(":pass",$datos['password']);
        $sql->bindParam(":email",$datos['email']);
        $sql->bindParam(":rol_upd",$datos['rol']);
        $sql->bindParam(":fecha_upd",$datos['fecha']);
        $sql->bindParam(":nickname",$datos['nickname']); 
        $sql->bindParam(":id_upd",$datos['id_update']); 
     
        if($sql->execute()){
          return true;
        } else {
          return false;
        }
      }

      public static function update_usuario_controller_sp($datos){
        // echo $datos['name'].'|'.$datos['email'].'|'.$datos['rol'].'|'.$datos['fecha'].'|'.$datos['nickname'].'|'.$datos['id_update'];
        $sql = Mainmodel::conectar()->prepare("UPDATE tbluser SET
        UserName = :name_update,UserEmail = :email,UserRole = :rol_upd,
        FechaUpdate = :fecha_upd,UserNickname = :nickname 
        where idUser = :id_upd");
        
        $sql->bindParam(":name_update",$datos['name']);
        $sql->bindParam(":email",$datos['email']);
        $sql->bindParam(":rol_upd",$datos['rol']);
        $sql->bindParam(":fecha_upd",$datos['fecha']);
        $sql->bindParam(":nickname",$datos['nickname']); 
        $sql->bindParam(":id_upd",$datos['id_update']); 
        
        if($sql->execute()){
          return true;
        } else {
          return false;
        }
      }

      public static function delete_user_modelo($id){
        $sql = Mainmodel::conectar()->prepare('DELETE from tbluser where idUser = :id');
        $sql->bindParam(":id",$id);
        if($sql->execute()){
          return true;
        } else {
          return false;
        }
      }

    }

    