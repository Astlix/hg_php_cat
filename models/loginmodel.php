<?php
require_once 'mainmodel.php';

class loginModel extends Mainmodel{

// MODELO PARA INICIAR SESION
public static function iniciar_sesion_modelo($datos){
    $sql = Mainmodel::conectar2()->prepare("SELECT * FROM tblUser where 
    UserNickname = :Usuario and UserPassword = :Pass and cuenta = 'activa'");
    $sql->bindParam(":Usuario",$datos['usuario']);
    $sql->bindParam(":Pass",$datos['pass']);
    $sql->execute();
    return $sql->fetch();
    $sql->close();
}

}