<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (isset($_POST['asset_reg']) || isset($_POST['activo_id_delete']) || isset($_POST['activo_id_upd']) || $_FILES["name_doc"]) {
        // INCLUIR CONTROLADOR
        require_once '../controllers/activoscontroller.php';
        $ins_usuario = new activosController();
        //AGREGAR UN USUARIO
        if(isset($_POST['asset_reg']) && isset($_POST['planta_reg'])&& isset($_POST['columna_reg'])&& isset($_POST['num_col_reg'])){
            echo $ins_usuario->agregar_activo_controller();
        }
        if(isset($_POST['activo_id_delete'])){
            echo $ins_usuario->eliminar_activo_controller();
        }
        if(isset($_POST['activo_id_upd'])){
            echo $ins_usuario->actualizar_activo_controller();
        }
        // print_r ($_FILES["name_doc"]);
        if(isset($_FILES["name_doc"])){//si exiaste el archivo de csv hara lo siguiente 
            // echo $ins_usuario->agregar_activo__masivo_controller();
            echo $ins_usuario->cargar_masivo_controller();
        }
        
    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }