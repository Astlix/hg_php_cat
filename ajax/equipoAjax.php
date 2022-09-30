<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if(isset($_POST['hh_id_delete'])||isset($_POST['hh_id_upd'])||isset($_POST['mac_hh_reg'])||isset($_POST['marca_hh_reg'])||isset($_POST['modelo_hh_reg'])
    ||isset($_POST['mac_read_reg'])||isset($_POST['mac_read_upd'])||isset($_POST['reader_id_delete'])){
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
        if(isset($_POST['mac_read_reg'])||isset($_POST['modelo_read_reg'])||isset($_POST['marca_read_reg'])){
            echo $id_equipo->crear_reader_controller();
        }
        if(isset($_POST['reader_id_delete'])){
            echo $id_equipo->eliminar_reader_controller();
        }

        if( isset($_POST['mac_read_upd'])||
            isset($_POST['id_reader_upd'])||
            isset($_POST['dns_read_upd'])||
            isset($_POST['planta_read_upd'])||
            isset($_POST['columna_read_upd'])||
            isset($_POST['loc_read_upd'])||
            isset($_POST['ip_read_upd'])||
            isset($_POST['gateway_read_upd'])||
            isset($_POST['app_read_upd'])||
            isset($_POST['marca_read_upd'])||
            isset($_POST['tx_read_upd'])||
            isset($_POST['modelo_read_upd'])        
        ){
            echo $id_equipo->actualizar_reader_controller();
        }        

    }else{
        session_start(['name'=>'SCA']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }