<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (isset($_POST['token'])  && isset($_POST['usuario'])) {
         // INCLUIR CONTROLADOR
         require_once '../controllers/loginController.php';
         $ins_login = new loginController();

        echo $ins_login->cierre_sesion_controlador();
    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }