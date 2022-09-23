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
    ########################################################################
    #                           Saber de que Ubicacion es el activo        #
    ########################################################################
    public static function ver_ubicacion_activo($dato){
        if($dato=='01'){return 'A';}
        if($dato=='02'){return 'B';}
        if($dato=='03'){return 'C';}
        if($dato=='04'){return 'D';}
        if($dato=='05'){return 'E';}
        if($dato=='06'){return 'F';}
        if($dato=='07'){return 'G';}
        if($dato=='08'){return 'H';}
        if($dato=='09'){return 'I';}
        if($dato=='10'){return 'J';}
        if($dato=='11'){return 'K';}
        if($dato=='12'){return 'L';}
        if($dato=='13'){return 'M';}
        if($dato=='14'){return 'N';}
        if($dato=='15'){return 'O';}
        if($dato=='16'){return 'P';}
        if($dato=='17'){return 'Q';}
        if($dato=='18'){return 'R';}else{return 'No asignado';}
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
    public static function ver_un_activos_por_asset($asset){
      $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where Asset = :asset");
      $stmp -> bindParam(":asset", $asset);
      $stmp->execute();
      return $stmp->fetch();
      $stmp->close();
      }
    public static function ver_un_activos_por_epc($epc){
      $stmp = Mainmodel::conectar()->prepare("SELECT * FROM tblCA where TagEpc = :epc");
      $stmp -> bindParam(":epc", $epc);
      $stmp->execute();
      return $stmp->fetch();
      $stmp->close();
      }
      public static function ver_activo_inv($dato){
        $stmp = Mainmodel::conectar()->prepare("  select * from tblCA where TagEpc = 'No asignado' and Service002 = ".$dato."");
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
           ,Service001)
         values 
        (:asset,:desc,:epc_activo,:epc_poste,:inventario,:fecha,:serv1)");
        
        $sql->bindParam(":asset",$datos['asset']);
        $sql->bindParam(":desc",$datos['desc']);
        $sql->bindParam(":epc_activo",$datos['epc_activo']);
        $sql->bindParam(":epc_poste",$datos['epc_poste']);
        $sql->bindParam(":inventario",$datos['inventario']);
        $sql->bindParam(":fecha",$datos['fecha']);
        $sql->bindParam(":serv1",$datos['serv1']);
     
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
  ########################################################################
    #                           Actualziar activo masivo                         #
    ########################################################################
  
    public static function actualizar_activo_masivo_modelo($datos){
      $sql = Mainmodel::conectar()->prepare('UPDATE tblCA set Asset = :asset,
      Description = :description, DateInventory = :date_inventory,
      Service002 = :site, TagEpc= :epc where idCA = :id');
      $sql->bindParam(":id",$datos['id']);
      $sql->bindParam(":asset",$datos['asset']);
      $sql->bindParam(":description",$datos['description']);
      $sql->bindParam(":date_inventory",$datos['date_inventory']);
      $sql->bindParam(":site",$datos['site']);
      $sql->bindParam(":epc",$datos['epc']);
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }


  ########################################################################
    #                           AGREGAR activo  masivo                          #
    ########################################################################
    public static function agregar_activo_masivo_modelo($datos){
      $sql = Mainmodel::conectar()->prepare("INSERT INTO tblCA 
      (Asset
         ,Description
         ,DateInventory
         ,Service002,TagEpc)
       values 
      (:asset,:desc,:fecha,:planta,:epc)");
      
      $sql->bindParam(":asset",$datos['asset']);
      $sql->bindParam(":desc",$datos['description']);
      $sql->bindParam(":fecha",$datos['date_inventory']);
      $sql->bindParam(":planta",$datos['site']);
      $sql->bindParam(":epc",$datos['epc']);
   
      if($sql->execute()){
        return true;
      } else {
        return false;
      }
    }

}