
<div id="seccion-wrap">
  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h4>Lista de Usuarios
        <hr> <small>Usuarios</small>
      </h4>
    </div>

    <div class="box-cont-blanco" id="box">
      <a href="<?php echo SERVERURL; ?>crearusuarios" type="button" class="btn btn-success" style="margin: 10px 0px; display: flex; align-items: center; width: 100px;">Agregar<i class='bx bxs-user-plus nav_icon' style="padding-left: 5px;"></i></a>

      <?php
      $rsp = UserModel::ver_usuarios();
      if (empty($rsp)) {
        $elemento  = '<div class="box-cont-negro titulo-box m-0">';
        $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Usuarios</small></h4>';
        $elemento .= '</div>';
        echo $elemento;
      } else {
        $tabla  = '<table class="table table-striped table-dark salidas-tabla dt_active">';
        $tabla .= '<thead>';
        $tabla .= '<tr>';
        $tabla .= '<th scope="col">#</th>';
        $tabla .= '<th scope="col">Nombre</th>';       // Fecha
        $tabla .= '<th scope="col">Usuario</th>';        // Tipo
        $tabla .= '<th scope="col">Email</th>';        // Tipo
        $tabla .= '<th scope="col">Rol</th>';     // Nombre
        $tabla .= '<th scope="col">Fecha</th>';          // Nombre
        $tabla .= '<th scope="col">Acciones</th>';          // Nombre
        $tabla .= '</tr>';
        $tabla .= '</thead>';
        $tabla .= '<tbody>';
        $i = 0;

        foreach ($rsp as $dato) {
          $i++;
          $tabla .= '<tr class="elemento">';
          $tabla .= '<td scope="col">' . $i . '</td>';
          $tabla .= '<td scope="col" class="salida">' . $dato['UserName'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['UserNickname'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['UserEmail'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['UserRole'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['FechaCreacion'] . '</td>';
          $tabla .= '<td><a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" data-bs-toggle="modal" data-bs-target="#editarusuario"><i class="bx bx-edit nav_icon" aria-hidden="true" style="font-size:20px"></i></a></td>';
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
<div class="modal fade" id="editarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
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