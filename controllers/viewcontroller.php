<?php

require_once './models/viewmodels.php';

class viewController extends viewModels{

    // *********************CONTROLADOR OBTENER PLANTILLAS**********
    public function obtener_plantilla_controlador(){
        return require_once './views/template.php';
    }
    // *********************CONTROLADOR OBTENER VISTAS**********
    public static function obtener_vistas_controlador(){
        if (isset($_GET['action'])) {
            $ruta = explode("/",$_GET['action']);
            $respuesta = viewModels::obtener_vistas_modelo($ruta[0]);
        } else {
            $respuesta = "login";
        }
        return $respuesta;
    }
}