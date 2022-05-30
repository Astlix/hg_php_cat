<?php

require_once './config/config.php';
require_once './controllers/viewcontroller.php';

$plantilla = new viewController();
$plantilla->obtener_plantilla_controlador();