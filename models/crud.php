<?php
require_once 'mainmodel.php';

class Sql extends Mainmodel{

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



}