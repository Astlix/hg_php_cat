<?php

require_once 'mainmodel.php';

class EquipoModel extends MainModel{
 ########################################################################
    #                           Consulta un Equipos                             #
    ########################################################################
    public static function ver_hh_mac($mac){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where MAC = :mac");
        $stmp -> bindParam(":mac", $mac);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();      
      }
    public static function ver_hh_id($id){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where idHandheld = :id");
        $stmp -> bindParam(":id", $id);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();      
      }
    public static function ver_reader_esp($id){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblReaders where idReader = :id");
        $stmp -> bindParam(":id", $id);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();      
      }

      public static function ver_hh_general(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblHandhelds");
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
    #                           AGREGAR Hand Held                             #
    ########################################################################
    public static function agregar_hh_reg($datos){
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblHandhelds 
        (MAC,Modelo,Marca)
         values 
        (:mac,:modelo,:marca)");
        
        $sql->bindParam(":mac",$datos['mac']);
        $sql->bindParam(":marca",$datos['marca']);
        $sql->bindParam(":modelo",$datos['modelo']);
     
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
    #                           Actualziar hand held                            #
    ########################################################################
  
    public static function actualizar_hh_modelo($datos){
      $sql = Mainmodel::conectar()->prepare('UPDATE tblHandhelds set MAC = :mac,
      Modelo = :modelo, Marca = :marca where idHandheld = :id ');
      $sql->bindParam(":id",$datos['id']);
      $sql->bindParam(":mac",$datos['mac']);
      $sql->bindParam(":marca",$datos['marca']);
      $sql->bindParam(":modelo",$datos['modelo']);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }

}