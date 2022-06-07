<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (isset($_POST['name_reg'])) {
        // INCLUIR CONTROLADOR
        require_once '../controllers/userController.php';
        $ins_usuario = new userController();
        //AGREGAR UN USUARIO
        if(isset($_POST['name_reg']) && isset($_POST['pass_reg'])&& isset($_POST['cpass_reg'])){
            echo $ins_usuario->agregar_usuario_controller();
        }

    }else{
        session_start(['name'=>'HG']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }