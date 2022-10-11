<?php

require_once 'mainmodel.php';

class AlarmaModel extends MainModel{
 ########################################################################
    #                           Consulta un Equipos                             #
    ########################################################################

    public static function ver_hh_id($id){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where idHandheld = :id");
        $stmp -> bindParam(":id", $id);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();      
      }
      public static function ver_un_activos_por_asset($asset){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where Asset = :asset");
        $stmp -> bindParam(":asset", $asset);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();
        }
      public static function ver_un_activos_por_asset2($asset){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblCA where Asset = :asset");
        $stmp -> bindParam(":asset", $asset);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();
        }

      public static function ver_alarma_general(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT idBitacora,Asset,isnull(TipoSalida,'5') as TipoSalida, isnull(Comentarios,'Sin registro') as Comentarios, 
                                                FechaRegistro,FechaAlarma,Ubicacion FROM tblBitacora");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
        }
      public static function ver_reader_general(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblReaders");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
        }

        
    #####################################################################
    #                           AGREGAR alarma                             #
    ########################################################################
    public static function agregarAlarma($datos){
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblBitacora 
        (Asset,FechaAlarma,Ubicacion)
         values 
        (:asset,:fecha,:id_puerta)");
        
        $sql->bindParam(":asset",$datos['asset']);
        $sql->bindParam(":fecha",$datos['fecha']);
        $sql->bindParam(":id_puerta",$datos['id_puerta']);
     
        if($sql->execute()){
          return true;
        } else {
          return false;
        }
      }

    public static function agregar_incidencias($datos){
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblBitacora 
        (Asset,TipoSalida,Comentarios,FechaRegistro)
         values 
        (:asset,:tipo,:comentarios,:fecha)");
        
        $sql->bindParam(":asset",$datos['asset']);
        $sql->bindParam(":tipo",$datos['tipo']);
        $sql->bindParam(":comentarios",$datos['comentarios']);
        $sql->bindParam(":fecha",$datos['fecha']);
     
        if($sql->execute()){
          return true;
        } else {
          return false;
        }
      }
   
      ########################################################################
    #                           Eliminar HH                            #
    ########################################################################
  
    public static function eliminar_hh_modelo($id){
      $sql = Mainmodel::conectar()->prepare('DELETE from tblHandhelds where idHandheld = :id');
      $sql->bindParam(":id",$id);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }
 ########################################################################
    #                      Agregar Comentario de Alarma                 #
    ########################################################################
  
    public static function comentario_alarma($datos){
      $sql = Mainmodel::conectar()->prepare('UPDATE tblBitacora set Asset = :asset,
      TipoSalida = :tipo, Comentarios = :comentarios, FechaRegistro = :fecha where idBitacora = :id ');
      $sql->bindParam(":id",$datos['id']);
      $sql->bindParam(":asset",$datos['asset']);
      $sql->bindParam(":tipo",$datos['tipo']);
      $sql->bindParam(":comentarios",$datos['comentarios']);
      $sql->bindParam(":fecha",$datos['fecha']);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }
    public static function eliminar_reader_modelo($id){
      $sql = Mainmodel::conectar()->prepare('DELETE from tblReaders where idReader = :id');
      $sql->bindParam(":id",$id);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }

    public static function ver_correos(){
      $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCorreo");
      $stmp->execute();
      return $stmp->fetchAll();
      $stmp->close();
    }

}