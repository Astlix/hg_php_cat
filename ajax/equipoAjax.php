<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if(isset($_POST['hh_id_delete'])||isset($_POST['hh_id_upd'])||isset($_POST['mac_hh_reg'])||isset($_POST['marca_hh_reg'])||isset($_POST['modelo_hh_reg'])){
        // INCLUIR CONTROLADOR
        require_once '../controllers/equipoController.php';
        $id_equipo = new equipoController();
        //ACCIONES DE HH
        if(isset($_POST['hh_id_upd'])){
            echo $id_equipo->actualizar_hh_controller();
        }        
        if(isset($_POST['marca_hh_reg'])||isset($_POST['modelo_hh_reg'])||isset($_POST['mac_hh_reg'])){
            echo $id_equipo->crear_HH_controller();
        }
        if(isset($_POST['hh_id_delete'])){
            echo $id_equipo->eliminar_hh_controller();
        }

        //ACCIONES DE READERS


    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }