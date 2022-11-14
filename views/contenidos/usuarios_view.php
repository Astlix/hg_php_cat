
<div id="seccion-wrap">
  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h1><i class="bx bx-user"></i> Lista de Usuarios</h1>
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
        $tabla  = '<table id="nombre" data-nombre="usuarios" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
        $tabla .= '<thead>';
        $tabla .= '<tr class="bg-warning">';
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
          if (trim($dato['UserRole'])=='1') {
            $rol = 'Admin';
          }else{
            $rol = 'Guess';
          }

          $i++;
          $tabla .= '<tr class="elemento">';
          $tabla .= '<td scope="col">' . $i . '</td>';
          $tabla .= '<td scope="col" class="salida">' . $dato['UserName'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['UserNickname'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['UserEmail'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $rol . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['FechaCreacion'] . '</td>';
          $tabla .= '<td style="display:flex; justify-content:space-around;"><a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar" id="editar_user"
                      data-id="'.trim($dato['idUser']).'"
                      data-name="'.trim($dato['UserName']).'"
                      data-email="'.trim($dato['UserEmail']).'"
                      data-role="'.trim($dato['UserRole']).'"
                      data-cuenta="'.trim($dato['cuenta']).'"
                      data-nickname="'.trim($dato['UserNickname']).'"
                      ><i class="bx bx-edit nav_icon" aria-hidden="true" style="font-size:20px"></i></a>
                      <form action="' . SERVERURL . 'ajax/usuarioAjax.php" class="FormularioAjax" method="post" data-form="delete">
                      <input type="hidden" name="id_delete" value="'.$dato['idUser'].'">
                      <button type="submit" class="btn btn-secondary" style="color:white; border-color:transparent;background-color:crimson;" title="Borrar"><i class="bx bx-trash" style="color:white;font-size:20px;"></i></button>
                      </form>
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
<div class="modal fade" id="editarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title " id="exampleModalLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update">

          <div class="form-group">
            <label for="nombre">Nombre de Usuario</label>
            <input type="hidden" class="form-control" id="id_update" name="id_update" >
            <input type="text" class="form-control" id="nickname" name="nickname_upd" required>
            <small id="emailHelp" class="form-text text-muted">No se permite numeros.</small>
          </div>
          <div class="form-group">
            <label for="nombre">Nombre Completo</label>
            <input type="text" class="form-control" pattern="[a-zA-Z].{1,}" title="El nombre debe ser minusculas o mayusculas." maxlength="35" id="nombre" name="name_upd" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email_upd" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Rol</label>
            <!-- <input type="text" class="form-control" id="rol" name="rol_reg" autocomplete="off"> -->
            <select class="form-control" name="rol_update" id="rol_reg" aria-label="Default select example">
              <option selected disabled>Seleccione</option>
              <option value="1">Admin</option>
              <option value="2">Guest</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input type="password" class="form-control" name="pass_upd" id="pass_upd" pattern='[a-zA-Z0-9!#$%&"()=@].{7,}' autocomplete="new-password">
            <small class="form-text text-muted">Min 8 caracteres | Un numero | Un caracter especial | Mayusculas | Minusculas</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Repetir Contraseña</label>
            <input type="password" class="form-control" name="cpass_upd" pattern='[a-zA-Z0-9!#$%&"()=@].{7,}' id="cpass_reg" autocomplete="new-password">
          </div>
          <div class="modal-footer" style="margin-top:15px;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>