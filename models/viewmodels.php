<?php
class viewModels{

    protected static function obtener_vistas_modelo($vistas){
        $listaBlanca=["activos","alarma","bitacora","correos","equipo","home","readers","ubicaciones","usuarios","crearusuarios"];
        if (in_array($vistas,$listaBlanca)) {
            if (is_file("./views/contenidos/" . $vistas . "_view.php")) {
                $contenido = "./views/contenidos/" . $vistas . "_view.php";
            }else{
                $contenido = "404";
            }
        }elseif($vistas=='login' || $vistas=='index'){
            $contenido="login";
        }else{
            $contenido = "404";
        }
        return $contenido;
    }
}
?>