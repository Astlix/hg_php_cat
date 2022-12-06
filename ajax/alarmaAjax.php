<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (isset($_POST['id_alarma'])||isset($_POST['asset'])||isset($_POST['id_delete'])||isset($_POST['upd_id']) || isset($_POST['asset_reg']) || isset($_POST['tipo_reg']) || isset($_POST['comentarios_reg'])) {
        // INCLUIR CONTROLADOR
        require_once '../controllers/alarmacontroller.php';
        $ini_alarma = new alarmaController();
        //AGREGAR UN USUARIO
        if(isset($_POST['asset'])){
            echo $ini_alarma->consulta_activo_asset();
        }
        if(isset($_POST['asset_reg'])|| isset($_POST['tipo_reg']) || isset($_POST['comentarios_reg'])
        ){
            echo $ini_alarma->registro_incidencia_alarma();
        }
        if(isset($_POST['id_alarma'])||isset($_POST['asset_reg_alarm'])||isset($_POST['tipo_alarma'])||isset($_POST['comentarios_alarma'])){
            echo $ini_alarma->crear_comentario_alarma();
            echo $ini_alarma->mandar_correo_alarma();
        }
        if (isset($_POST['upd_id'])) {
            echo $ini_alarma->update_comentario_alarma();
        }
        if (isset($_POST['id_delete'])) {
            echo $ini_alarma->delete_bitacora_alarma();
        }
        
    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }