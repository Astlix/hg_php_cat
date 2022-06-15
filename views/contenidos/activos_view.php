
<div id="seccion-wrap">
  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h4>Lista de Activos
      </h4>
    </div>

    <div class="box-cont-blanco" id="box">
      
      <div class="botones" style="width:100%;display: flex; ">
          <a href="<?php echo SERVERURL; ?>crearactivos" type="button" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: 100px;">Agregar<i class='bx bxs-package nav_icon' style="padding-left: 5px;"></i></a>
          <form action="" method="post">
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
            <a href="subir_csv_activos.php" type="button" class="btn btn-success" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Importar CSV<i class='bx bxs-file-import' style="padding-left: 5px;"></i></a>
          </form>
        </div>
      <hr class="my-2">

      <?php
      $rsp = ActivosModel::ver_activos();
      if (empty($rsp)) {
        $elemento  = '<div class="box-cont-negro titulo-box m-0">';
        $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Activos</small></h4>';
        $elemento .= '</div>';
        echo $elemento;
      } else {
        $tabla  = '<table style="border-radius:10px" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
        $tabla .= '<thead>';
        $tabla .= '<tr class="bg-warning">';
        $tabla .= '<th scope="col">#</th>';
        $tabla .= '<th scope="col">Asset</th>';       // Fecha
        $tabla .= '<th scope="col">Descripción</th>';        // Tipo
        $tabla .= '<th scope="col">EPC</th>';        // Tipo
        $tabla .= '<th scope="col">EPC Ubicación</th>';     // Nombre
        $tabla .= '<th scope="col">Inventario</th>';          // Nombre
        $tabla .= '<th scope="col">Fecha Inventario</th>';          // Nombre
        $tabla .= '<th scope="col">Acciones</th>';          // Nombre
        $tabla .= '</tr>';
        $tabla .= '</thead>';
        $tabla .= '<tbody>';
        $i = 0;

        foreach ($rsp as $dato) {
          $i++;
          $tabla .= '<tr class="elemento">';
          $tabla .= '<td scope="col">' . $i . '</td>';
          $tabla .= '<td scope="col" class="salida">' . $dato['Asset'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['Description'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['TagEpc'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['TagSite'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['Inventory'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['DateInventory'] . '</td>';
          $tabla .= '<td>
                <div class="btn-group">
                  <button type="button" stlyle="width:50px;" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ver_registro" href="#">Ver</a></li>
                    <li><a class="dropdown-item" href="#">Editar</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Eliminar</a></li>
                  </ul>
                </div>
          </td>';
          $tabla .= '</tr>';
        }
        $tabla .= '</tbody>';
        $tabla .= '</table>';
        echo $tabla;
      }
      ?>


    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ver_registro" tabindex="-1" aria-labelledby="ver_registro" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ver_registro">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update">

          <div class="form-group">
            <label for="nombre">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nickname" name="nickname_reg" required>
            <small id="emailHelp" class="form-text text-muted">Alias que se usara en la plataforma.</small>
          </div>
          <div class="form-group">
            <label for="nombre">Nombre Completo</label>
            <input type="text" class="form-control" pattern="[a-zA-Z].{1,}" title="El nombre debe ser minusculas o mayusculas." maxlength="35" id="nombre" name="name_reg" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email_reg" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Rol</label>
            <!-- <input type="text" class="form-control" id="rol" name="rol_reg" autocomplete="off"> -->
            <select class="form-control" name="rol_reg" aria-label="Default select example">
              <option selected disabled>Seleccione</option>
              <option value="1">Admin</option>
              <option value="2">Guest</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input type="password" class="form-control" name="pass_reg" id="pass1" pattern='[a-zA-Z0-9!#$%&"()=@].{7,}' required>
            <small class="form-text text-muted">Min 8 caracteres | Un numero | Un caracter especial | Mayusculas | Minusculas</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Repetir Contraseña</label>
            <input type="password" class="form-control" name="cpass_reg" pattern='[a-zA-Z0-9!#$%&"()=@].{7,}' id="cpass_reg" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>