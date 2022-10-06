<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (isset($_POST['asset'])) {
        // INCLUIR CONTROLADOR
        require_once '../controllers/alarmacontroller.php';
        $ini_alarma = new alarmaController();
        //AGREGAR UN USUARIO
        if(isset($_POST['asset'])){
            echo $ini_alarma->consulta_activo_asset();
        }

    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }