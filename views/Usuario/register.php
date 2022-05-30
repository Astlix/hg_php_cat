<?php
$ruta = dirname(__FILE__,3);//C:\xampp\htdocs\hg_php_cat
// echo $ruta;
require_once ($ruta . "/Models/usuario_model.php");
require_once ($ruta . "/Controllers/userController.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <title>CAT | CREAR USUARIO</title>
</head>
<body>
<div id="seccion-wrap">
  <div class="box-cont-negro">

    <div class="box-cont-blanco" id="box">
      <?php
        $form = new Usercontroller();
        $form -> formularioUsuario();
        $form -> agregarusuario();
      ?>
      
    </div>
  </div>
</div>
</body>
</html>