<?php 
require_once ('mainmodel.php');

class CorreosModel extends MainModel{
    ########################################################################
    #                           Consulta Todos los correos                 #
    ########################################################################
    public static function ver_correos(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblcorreo");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
      }
    public static function ver_correos2(){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblcorreo");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
      }

    ########################################################################
    #                           Consulta un correo solamente               #
    ########################################################################
    public static function ver_un_correo($id){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblcorreo where idCorreo = :id");
        $stmp -> bindParam(":id", $id);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();
      
      }
    public static function ver_correo_por_correo($correo){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblcorreo where CorreoElectronico = :correo");
        $stmp -> bindParam(":correo", $correo);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();
      
      }

       #####################################################################
    #                           AGREGAR activo                             #
    ########################################################################
    public static function agregar_correo_modelo($datos){
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblcorreo 
        (Nombre,ApellidoP,ApellidoM,CorreoElectronico,Estado,Planta,Cargo)
         values 
        (:nombre,:apellido_p,:apellido_m,:correo_electronico,:estado,:planta,:cargo)");
        
        $sql->bindParam(":nombre",$datos['nombre']);
        $sql->bindParam(":apellido_p",$datos['apellido_p']);
        $sql->bindParam(":apellido_m",$datos['apellido_m']);
        $sql->bindParam(":correo_electronico",$datos['correo_electronico']);
        $sql->bindParam(":estado",$datos['estado']);
        $sql->bindParam(":planta",$datos['planta']);
        $sql->bindParam(":cargo",$datos['cargo']);
     
        if($sql->execute()){
          return true;
        } else {
          return false;
        }

      }
    ########################################################################
    #                           Eliminar activo                            #
    ########################################################################
  
    public static function eliminar_correo_modelo($id){
      $sql = Mainmodel::conectar()->prepare('DELETE from tblcorreo where idCorreo = :id');
      $sql->bindParam(":id",$id);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }
    ########################################################################
    #                           Actualziar activo                            #
    ########################################################################
  
    public static function actualizar_correo_modelo($datos){
      $sql = Mainmodel::conectar()->prepare('UPDATE tblcorreo set Nombre = :nombre,
      ApellidoP = :apellido_p, ApellidoM = :apellido_m, CorreoElectronico = :correo_electronico,
      Estado = :estado,Planta =:planta, Cargo =:cargo where idCorreo = :id');
      $sql->bindParam(":id",$datos['id']);
      $sql->bindParam(":nombre",$datos['nombre']);
      $sql->bindParam(":apellido_p",$datos['apellido_p']);
      $sql->bindParam(":apellido_m",$datos['apellido_m']);
      $sql->bindParam(":correo_electronico",$datos['correo_electronico']);
      $sql->bindParam(":estado",$datos['estado']);
      $sql->bindParam(":planta",$datos['planta']);
      $sql->bindParam(":cargo",$datos['cargo']);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }
}
