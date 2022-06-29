<?php

require_once 'mainmodel.php';

class ActivosModel extends MainModel{
    ########################################################################
    #                           Consulta Todos los activos                             #
    ########################################################################
    public static function ver_activos(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblCA");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
      }
    public static function ver_activos2(){
      $datos='010101';
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where TagSite like '%cad120140100000000".$datos."%'");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
      }

    ########################################################################
    #                           Consulta un activo solamente                             #
    ########################################################################
    public static function ver_un_activo($id){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblCA where idCA = :id");
        $stmp -> bindParam(":id", $id);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();
      
      }
    public static function ver_un_activo2($id){
        $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where idCA = :id");
        $stmp -> bindParam(":id", $id);
        $stmp->execute();
        return $stmp->fetch();
        $stmp->close();      
      }
    public static function ver_un_activos_especifico($datos){
      $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where TagSite like '%cad120140100000000".$datos."%'");
      $stmp->execute();
      return $stmp->fetchAll();
      $stmp->close();
      }

       ########################################################################
    #                           AGREGAR activo                            #
    ########################################################################
    public static function agregar_activo_modelo($datos){
     
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblCA 
        (Asset
           ,Description
           ,TagEpc
           ,TagSite
           ,Inventory
           ,DateInventory
           ,Service001
           ,Service002
           ,Service003
           ,Service004
           ,Service005)
         values 
        (:asset,:desc,:epc_activo,:epc_poste,:inventario,:fecha,:serv1,:serv2,:serv3,:serv4,:serv5)");
        
        $sql->bindParam(":asset",$datos['asset']);
        $sql->bindParam(":desc",$datos['desc']);
        $sql->bindParam(":epc_activo",$datos['epc_activo']);
        $sql->bindParam(":epc_poste",$datos['epc_poste']);
        $sql->bindParam(":inventario",$datos['inventario']);
        $sql->bindParam(":fecha",$datos['fecha']);
        $sql->bindParam(":serv1",$datos['serv1']);
        $sql->bindParam(":serv2",$datos['serv2']);
        $sql->bindParam(":serv3",$datos['serv3']);
        $sql->bindParam(":serv4",$datos['serv4']);
        $sql->bindParam(":serv5",$datos['serv5']);
     
        if($sql->execute()){
          return true;
        } else {
          return false;
        }

      }
    ########################################################################
    #                           Eliminar activo                            #
    ########################################################################
  
    public static function eliminar_activo_modelo($id){
      $sql = Mainmodel::conectar()->prepare('DELETE from tblCA where idCA = :id');
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
  
    public static function actualizar_activo_modelo($datos){
      $sql = Mainmodel::conectar()->prepare('UPDATE tblCA set Asset = :asset,
      Description = :description, SerialNumber = :serialnumber,
      TagEpc = :epc_tag,
      TagSiteFound = :epc_tagsitefound,
      Inventory = :inventory,
      Service001 = :s1,Service002 = :s2,Service003 = :s3,
      Service004 = :s4,Service005 = :s5 where idCA = :id ');
      $sql->bindParam(":id",$datos['id']);
      $sql->bindParam(":asset",$datos['asset']);
      $sql->bindParam(":description",$datos['description']);
      $sql->bindParam(":serialnumber",$datos['serialnumber']);
      $sql->bindParam(":epc_tag",$datos['epc_tag']);
      $sql->bindParam(":epc_tagsitefound",$datos['epc_tagsitefound']);
      $sql->bindParam(":inventory",$datos['inventory']);
      $sql->bindParam(":s1",$datos['s1']);
      $sql->bindParam(":s2",$datos['s2']);
      $sql->bindParam(":s3",$datos['s3']);
      $sql->bindParam(":s4",$datos['s4']);
      $sql->bindParam(":s5",$datos['s5']);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }
}