<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITULO; ?></title>
    <?php include './views/inc/estilos.php'; ?>

</head>

<body id="body-pd">
    <?php
    $peticionAjax = false;
    require_once "./controllers/viewcontroller.php";   
    require_once("./models/usermodel.php"); //para ver las notificaciones
    require_once("./models/activosmodel.php"); //para ver las notificaciones
    
    $iv = new viewController();
    $vistas = $iv->obtener_vistas_controlador();

    if ($vistas == 'login' || $vistas == "404") {
        require_once "./views/contenidos/" . $vistas . '_view.php';
    } else {
        session_start(['name' => 'SCA']); //iniciamos session para que nos muestre las variables
        require_once "./controllers/loginController.php";
        $lc = new loginController();
        if (!isset($_SESSION['token_sca']) 
        || !isset($_SESSION['nickname_sca']) 
        ||  !isset($_SESSION['rol_sca'])) {
            echo $lc->forzar_cierre_sesion_controller();
            exit();
        }
    ?>
        <?php include './views/inc/header.php'; ?>
        <?php include './views/inc/navlateral.php'; ?>

        <!--Container Main start-->
        <div class="height-100 bg-light">
            <?php include $vistas;?>
        </div>
        <!--Container Main end-->
    <?php
    include './views/inc/logout.php';
    }
    include './views/inc/script.php';
    ?>

</body>

</html>