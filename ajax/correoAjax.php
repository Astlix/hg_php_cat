<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if(isset($_POST['correo_id_delete'])||isset($_POST['correo_id_upd'])||isset($_POST['nombre_reg'])||isset($_POST['apellidop_reg'])||isset($_POST['apellidom_reg'])){
        // INCLUIR CONTROLADOR
        require_once '../controllers/correosController.php';
        $id_correo = new correosController();
        //AGREGAR UN USUARIO
        if(isset($_POST['correo_id_upd'])){
            echo $id_correo->actualizar_correo_controller();
        }
        if(isset($_POST['nombre_reg'])||isset($_POST['apellidop_reg'])||isset($_POST['apellidom_reg'])||isset($_POST['correo_reg'])||isset($_POST['estado_reg'])){
            echo $id_correo->crear_correo_controller();
        }
        if(isset($_POST['correo_id_delete'])){
            echo $id_correo->eliminar_correo_controller();
        }

    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }