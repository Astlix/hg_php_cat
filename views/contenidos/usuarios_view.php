<?php
require_once ("./controllers/userController.php");
?>
<div id="seccion-wrap">
  <div class="box-cont-negro">
    
    <div class="box-cont-blanco titulo-box">
      <h4>Lista de Usuarios <hr> <small>Usuarios</small></h4>
    </div>
    
    <div class="box-cont-blanco" id="box">
    <button type="button" class="btn btn-warning" style="margin: 10px 0px; display: flex; align-items: center;">Agregar<i class='bx bxs-user-plus nav_icon' style="padding-left: 5px;"></i></button>

      <?php
        $tb = new Usercontroller();
        $tb -> tabla_usuarios();
      ?>
      
      
    </div>
  </div>
</div>