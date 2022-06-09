<?php

    $peticionAjax=true;
    require_once '../config/config.php';//para poder incluir el SERVERURL

    if (true) {
        
    }else{
        session_start(['name'=>'HG']);
        session_unset();
        session_destroy();
        header("Location: ". SERVERURL . "login");
        exit();
    }