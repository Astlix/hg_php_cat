<?php

require_once 'mainmodel.php';

class AlarmaModel extends MainModel{
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
      public static function ver_un_activos_por_asset($asset){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where Asset = :asset");
        $stmp -> bindParam(":asset", $asset);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();
        }

      public static function ver_alarma_general(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblComentariosAlarma");
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
    #                           AGREGAR Reader                             #
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
    public static function agregar_reader_reg($datos){
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblReaders 
            ([MAC]
           ,[DNSName]
           ,[Planta]
           ,[Columna]
           ,[IPAddress]
           ,[SubnetMask]
           ,[Gateway]
           ,[App]
           ,[TxPower]
           ,[Marca]
           ,[Modelo]
           ,[Locacion])
         values 
        (:mac,:dns,:planta,:columna,:ip,:mask,:gateway,:app,
        :tx,:marca,:modelo,:loc)");
        
        $sql->bindParam(":mac",$datos['mac']);
        $sql->bindParam(":dns",$datos['dns']);
        $sql->bindParam(":planta",$datos['planta']);
        $sql->bindParam(":columna",$datos['columna']);
        $sql->bindParam(":loc",$datos['loc']);
        $sql->bindParam(":ip",$datos['ip']);
        $sql->bindParam(":mask",$datos['mask']);
        $sql->bindParam(":gateway",$datos['gateway']);
        $sql->bindParam(":app",$datos['app']);
        $sql->bindParam(":tx",$datos['tx']);
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
    public static function actualizar_reader_modelo($datos){
      $sql = Mainmodel::conectar()->prepare('UPDATE tblReaders set MAC = :mac,
      Modelo = :modelo, Marca = :marca, DNSName = :dns,
      Planta = :planta, Columna = :columna, Locacion = :loc,
      IPAddress = :ip, SubnetMask = :mask, Gateway = :gateway,
      App = :app, TxPower = :tx where idReader = :id ');
      $sql->bindParam(":id",$datos['id']);
      $sql->bindParam(":mac",$datos['mac']);
      $sql->bindParam(":dns",$datos['dns']);
      $sql->bindParam(":planta",$datos['planta']);
      $sql->bindParam(":columna",$datos['columna']);
      $sql->bindParam(":loc",$datos['loc']);
      $sql->bindParam(":ip",$datos['ip']);
      $sql->bindParam(":mask",$datos['mask']);
      $sql->bindParam(":gateway",$datos['gateway']);
      $sql->bindParam(":app",$datos['app']);
      $sql->bindParam(":tx",$datos['tx']);
      $sql->bindParam(":marca",$datos['marca']);
      $sql->bindParam(":modelo",$datos['modelo']);
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

}