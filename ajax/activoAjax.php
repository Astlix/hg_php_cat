<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (isset($_POST['asset_reg'])) {
        // INCLUIR CONTROLADOR
        require_once '../controllers/activoscontroller.php';
        $ins_usuario = new activosController();
        //AGREGAR UN USUARIO
        if(isset($_POST['asset_reg']) && isset($_POST['planta_reg'])&& isset($_POST['columna_reg'])&& isset($_POST['num_col_reg'])){
            echo $ins_usuario->agregar_activo_controller();
        }

    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }