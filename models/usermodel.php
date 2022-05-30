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
        $qry = file_get_contents("./views/resources/".$archivo.".sql");
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
      // ========================= Buscar Usuario ========================== //
   

}