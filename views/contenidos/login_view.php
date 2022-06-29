<link rel="stylesheet" href="./public/css/login.css">


<img src="./public/img/astlix.png" id="astlix" alt="">
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Icon -->
        <div class="fadeIn first">
            <img src="./public/img/logo2.png" id="icon" alt="User Icon" />
            <p>Astlix 2022 ©</p>
        </div>


        <!-- Login Form -->
        <form method="post" action="" autocomplete="off">
            <input type="text" id="user" class="fadeIn second" pattern="[A-Za-z]+" name="user_login" placeholder="Usuario">
            <input type="password" id="pass" class="fadeIn third"  name="pass_login" placeholder="Contraseña">
            <input type="submit" class="fadeIn fourth" value="Ingresar">
        </form>

        <!-- Remind Passowrd -->
        <!-- <div id="formFooter">
            <a class="underlineHover" href="#">Olvide mi contraseña?</a>
        </div> -->

    </div>
</div>
<?php
if (isset($_POST['user_login']) && isset($_POST['pass_login'])) {
    require_once "./controllers/loginController.php";
    $ins_login = new loginController();
    echo $ins_login->inciciar_sesion_controller();
}
?>