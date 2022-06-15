<?php

require_once 'mainmodel.php';

class ActivosModel extends MainModel{
    ########################################################################
    #                           Consulta Todos los Usuarios                             #
    ########################################################################
    public static function ver_activos(){
        $stmp = Mainmodel::conectar2()->prepare("SELECT * FROM tblCA");
        $stmp->execute();
        return $stmp->fetchAll();
        $stmp->close();
      }

       ########################################################################
    #                           AGREGAR USUARIO                            #
    ########################################################################
    public static function agregar_activo_modelo($datos){
     
        $sql = Mainmodel::conectar()->prepare("INSERT INTO tblCA 
        (Asset
           ,Description
           ,TagEpc
           ,TagSite
           ,DateInventory
           ,Service001
           ,Service002
           ,Service003
           ,Service004
           ,Service005)
         values 
        (:asset,:desc,:epc_activo,:epc_poste,:fecha,:serv1,:serv2,:serv3,:serv4,:serv5)");
        
        $sql->bindParam(":asset",$datos['asset']);
        $sql->bindParam(":desc",$datos['desc']);
        $sql->bindParam(":epc_activo",$datos['epc_activo']);
        $sql->bindParam(":epc_poste",$datos['epc_poste']);
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
}