<div id="seccion-wrap">
  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h1>Lista de Correos</h1>
    </div>

    <div class="box-cont-blanco" id="box">

      <div class="botones" style="width:100%;display: flex;justify-content:space-between; ">
        <div class="btn1" style="display: flex;width:100%; justify-content:space-between;">
          <a type="button" id="crear_cuenta_correo" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;" data-bs-toggle="modal" data-bs-target="#crear_correo">Agregar<i class='bx bx-add-to-queue nav_icon' style="padding-left: 5px;"></i></a>
          <a href="<?php echo SERVERURL; ?>views/enviaremail.php" type="button" id="verificar_correo" class="btn btn-primary" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Enviar Correo de Prueba<i class='bx bx-mail-send nav_icon' style="padding-left: 5px;"></i></a>
        </div>
        
      </div>
      <hr class="my-2">

      <?php
      $rsp = CorreosModel::ver_correos();
      if (empty($rsp)) {
        $elemento  = '<div class="box-cont-negro titulo-box m-0">';
        $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros Correos en el Sistema</small></h4>';
        $elemento .= '</div>';
        echo $elemento;
      } else {
        $tabla  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active2">';
        $tabla .= '<thead>';
        $tabla .= '<tr class="bg-warning">';
        $tabla .= '<th scope="col">#</th>';
        $tabla .= '<th scope="col">Nombre</th>';       
        $tabla .= '<th scope="col">Apellido Paterno</th>';       
        $tabla .= '<th scope="col">Apellido Materno</th>';       
        $tabla .= '<th scope="col">Correo Electrónico</th>';    
        $tabla .= '<th scope="col">Estado</th>';          
        $tabla .= '<th scope="col">Acciones</th>';          
        $tabla .= '</tr>';
        $tabla .= '</thead>';
        $tabla .= '<tbody>';
        $i = 0;

        foreach ($rsp as $dato) {
          
          $i++;
          $tabla .= '<tr class="elemento">';
          $tabla .= '<td scope="col">' . $i . '</td>';
          $tabla .= '<td scope="col" class="salida">' . $dato['Nombre'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['ApellidoP'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['ApellidoM'] . '</td>';
          $tabla .= '<td scope="col" class="lote">' . $dato['CorreoElectronico'] . '</td>';
          if ($dato['Estado']=='1') {
              $tabla .= '<td scope="col" class="lote"><i class="bx bx-check-circle" style="font-size:25px;color:green"></i></td>';
            }else{
              $tabla .= '<td scope="col" class="lote"><i class="bx bx-block" style="font-size:25px;color:red"></i></td>';
          }
          $tabla .= '<td>
                <div class="btn-group">
                  <button type="button" stlyle="width:50px;" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" type="button" id="ver_registro_correo" 
                    data-id="'.$dato['idCorreo'].'"
                    data-nombre="'.$dato['Nombre'].'"
                    data-apellidop="'.$dato['ApellidoP'].'"
                    data-apellidom="'.$dato['ApellidoM'].'"
                    data-correo="'.$dato['CorreoElectronico'].'"
                    data-estado="'.$dato['Estado'].'"                    
                    ><i class="bx bx-pencil"></i> Editar</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <form action="' . SERVERURL . 'ajax/correoAjax.php" class="FormularioAjax" method="post" data-form="delete">
                    <input type="hidden" name="correo_id_delete" value="'.$dato['idCorreo'].'">
                    <button type="submit" class="btn btn-secondary" style="background-color:transparent; color:black; border-color:transparent;width:100%;">Eliminar</button>
                    </form>
                  </ul>
                </div>
          </td>';
          $tabla .= '</tr>';

        }
        $tabla .= '</tbody>';
        $tabla .= '</table>';
        echo $tabla;
      }
      
      require_once 'modal.php';
      ?>


    </div>
  </div>
</div>

<!-- Modal Crear Correo -->
<div class="modal fade" id="crear_correo" tabindex="-1" aria-labelledby="ver_registro" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="ver_registro">Crear Cuenta de Correo Electrónico </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/equipoAjax.php" method="POST" data-form="save">
          <div class="row">
            <div class="col-md-12">
              <label for="nombre">Nombre (s)</label>
              <input type="text" class="form-control" id="modal_nombre_reg" name="nombre_reg" title="Nombre(s)" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Apellido Paterno</label>
              <input type="text" class="form-control" id="modal_apellidop_reg" name="apellidop_reg" title="Apellido Paterno" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Apellido Materno</label>
              <input type="text" class="form-control" id="modal_apellidom_reg" name="apellidom_reg" value="" title="Apellido Materno" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Correo Electrónico</label>
              <input type="email" class="form-control" id="modal_correo_reg" name="correo_reg" value="" title="Correo Electrónico" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Estado</label>
              <div class="col-md-12">
                <select class="form-select" id="modal_estado_reg" name="estado_reg" aria-label="Default select example" title="Estado" required>
                  <option value="1">Activo </option>
                  <option value="0">Bloqueado</option>
                </select>
              </div>
              <br>

              <div class="row justify-content-around">
                <button type="submit" id="btn_crear_correo_reg" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around;">Crear </button>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>