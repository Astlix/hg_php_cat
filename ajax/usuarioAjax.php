<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (isset($_POST['name_reg'])||isset($_POST['id_update'])||isset($_POST['id_delete'])) {
        // INCLUIR CONTROLADOR
        require_once '../controllers/userController.php';
        $ins_usuario = new userController();
        //AGREGAR UN USUARIO
        if(isset($_POST['name_reg'])&&isset($_POST['nickname_reg']) && isset($_POST['rol_reg']) 
        && isset($_POST['pass_reg'])&& isset($_POST['cpass_reg'])&& isset($_POST['email_reg'])){
            echo $ins_usuario->agregar_usuario_controller();
        }
        if(isset($_POST['id_update'])||isset($_POST['nickname_upd']) 
        || isset($_POST['rol_update'])|| isset($_POST['name_upd'])
        || isset($_POST['email_upd'])){
            echo $ins_usuario->update_usuario_controller();
        }
        if(isset($_POST['id_delete'])){
            echo $ins_usuario->delete_usuario_controller();
        }

    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }