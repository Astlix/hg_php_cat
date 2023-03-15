<link rel="stylesheet" href="./public/css/bitacora.css">
<!-- PRIMERA GRAFICA -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h1> <i class='bx bx-bar-chart-square'></i> Bitacora</h1>
    </div>
    <?php
    $sql = AlarmaModel::ver_alarma_general();
    $mantenimiento = $baja = $traspaso = $reparacion = $sin_registro = $default = 0;
    $total = 0;    

    foreach ($sql as $dato){
      if ($dato['FechaRegistro']=='') {
        continue;
      }
      switch (trim($dato['TipoSalida'])) {
        case '1':
          $mantenimiento = $mantenimiento + 1;
          $total = $total + 1;
          break;
        case '2':
          $reparacion = $reparacion + 1;
          $total = $total + 1;
          break;
        case '3':
          $traspaso = $traspaso + 1;
          $total = $total + 1;
          break;
          case '4':
          $baja = $baja + 1; 
          $total = $total + 1;
          break;
        case '5':
          $sin_registro = $sin_registro + 1;
          $total = $total + 1;
          break;
        
        default:
          $default = $default + 1;
          break;
      }
    }

 
    ?>
    <div class="box-cont-blanco" id="box">
      <div id="cabecera-activos">

        <div id="card" class="card col-md-3" style="height:auto;align-items: center;">
          <div class="card-header text-dark bg-warning" style="width:100%;">
            <h5 style="width:100%;">Dashboard 1</h5>
          </div>
          <canvas id="myChart" style="max-width:95%;max-height: auto;"></canvas>
          <h3>Total: <?php echo $total;?></h3>
        </div>

        <div id="card" class="card col-md-4">
            <div class="card-header text-dark bg-warning" style="text-align:center;margin: 0px 0px;">
              <h5>Datos Generales</h5>
            </div>
            <table class="table" style="margin:0px;">
                    <?php
                    // AQUI VAN LAS CONSUTLAS DE LAS ALARMAS 
                    date_default_timezone_set("America/Mexico_City");
                    $rsp = ActivosModel::ver_activos();
                   
                    ?>

                    <thead>
                        <tr>
                            <th scope="col">TIPO DE SALIDA</th>
                            <th scope="col">CANTIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Mantenimiento</th>
                            <td><?php echo $mantenimiento;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Reparación</th>
                            <td><?php echo $reparacion;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Traspaso</th>
                            <td><?php echo $traspaso;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Baja</th>
                            <td><?php echo $baja;?></td>
                        </tr>
                    </tbody>
                </table>

            
            <!-- <hr style="color:orange"> -->
                    
        </div>

        <div id="card" class="card col-md-4" >
            <div class="card-header text-dark bg-warning" style="text-align:center;">
                <h5>Search</h5>
            </div>
            <form>
                <label for="" class="form-label">Find Asset:</label>
                <input type="text" class="form-control" name="filtro_asset" id="filtro_asset" aria-describedby="helpId" placeholder="">
                                

                <label for="" class="form-label">Tipo de Salida:</label>
                <select class="form-select" name="filtro_tipo" id="filtro_tipo">
                  <option value="" selected>Todos</option>
                  <option value="Mantenimiento">Mantenimiento</option>
                  <option value="Reparación">Reparación</option>
                  <option value="Traspaso">Traspaso</option>
                  <option value="Baja">Baja</option>
                </select>
            </form>
        </div>


        <div class="botones" style="width:100%;display: flex;justify-content:space-between; ">
            <div class="btn1" style="display: flex;">
                <a type="submit" class="btn btn-warning" id="boton_incidencia_activo" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Agregar<i class='bx bx-add-to-queue nav_icon' style="padding-left: 5px;"></i></a>
            </div>
        </div>

        <?php
        $rsp = AlarmaModel::ver_alarma_general();
        if (empty($rsp)) {
          $elemento  = '<div class="box-cont-negro titulo-box m-0">';
          $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Bitacora </small></h4>';
          $elemento .= '</div>';
          echo $elemento;
        } else {
          $tabla  = '<table id="nombre" data-nombre="bitacora" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
          $tabla .= '<thead>';
          $tabla .= '<tr class="bg-warning">';
          $tabla .= '<th scope="col">Asset</th>';       
          $tabla .= '<th scope="col">Tipo de Salida</th>';        
          $tabla .= '<th scope="col">Comentarios</th>';     
          $tabla .= '<th scope="col">Fecha</th>';           
          $tabla .= '<th scope="col">Opciones</th>';           
          $tabla .= '</tr>';
          $tabla .= '</thead>';
          $tabla .= '<tbody>';
          $i = 0;

          foreach ($rsp as $dato) {
            if ($dato['FechaRegistro']=='') {
              continue;
            }
            if (trim($dato['Ubicacion'])==null) {
              $ubicacion = 'n/a';
            }else{
              $ubi = EquipoModel::ver_reader_general_ip2(trim($dato['Ubicacion']));
              $ubicacion = $ubi['Locacion'];
            }            

            $tipo = "";
            if($dato['TipoSalida']==1){$tipo = 'Mantenimiento';}
            if($dato['TipoSalida']==2){$tipo = 'Reparación';}
            if($dato['TipoSalida']==3){$tipo = 'Traspaso';}
            if($dato['TipoSalida']==4){$tipo = 'Baja';}
            if($dato['TipoSalida']==5){$tipo = 'Sin registro';}
           
            $i++;
            $tabla .= '<tr class="elemento" >';
            $tabla .= '<td scope="col" class="salida">' . $dato['Asset'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $tipo . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['Comentarios'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['FechaRegistro'] . '</td>';
            $tabla .= '<td scope="col" class="lote" style="display:flex;justify-content:center;"><a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar" id="editar_bitacora"
            data-id="'.trim($dato['idBitacora']).'"
            data-asset="'.trim($dato['Asset']).'"
            data-tipo="'.trim($dato['TipoSalida']).'"
            data-comentarios="'.trim($dato['Comentarios']).'"
            ><i class="bx bx-edit nav_icon" aria-hidden="true" style="font-size:20px"></i></a>
            <form action="' . SERVERURL . 'ajax/alarmaAjax.php" class="FormularioAjax" method="post" data-form="delete">
                      <input type="hidden" name="id_delete" value="'.$dato['idBitacora'].'">
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

  <script>

    // GRAFICA DE BARRAS
    
    const data = {
      labels: [
        'Mantenimiento',
        'Reparación',
        'Traspaso',
        'Baja'
      ],
      datasets: [{
        label: 'Bitacora de Activos',
        data: [<?php echo $mantenimiento;?>, <?php echo $reparacion;?>, <?php echo $traspaso;?>, <?php echo $baja;?>],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(55, 205, 95)',
          'rgb(172, 181, 241)'
        ],
        hoverOffset: 4,

      }]
    };

    const config = {
      type: 'bar',
      data: data,
      
    };

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

     // FIN GRAFICA DONUT

   
  </script>

 <!-- Modal Crear Bitadora -->
<div class="modal fade" id="modal_incidencia_activo" tabindex="-1" aria-labelledby="ver_registro" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="ver_registro">Crear Incidencia de Activo </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alarmaAjax.php" method="POST" data-form="save">
            <?php 
                        $rsp = ActivosModel::ver_activos();            
            ?>
              <div class="col-md-12">
                    <label for="nombre">Aseet</label>
                    <select type="text" class="form-control" id="+" name="asset_reg" aria-label="Default select example" title="Asset" >
                     <?php 
                      foreach($rsp as $dato){
                        echo '<option value="'.$dato['Asset'].'">'.$dato['Asset'].'</option>';
                      }
                     ?>
                    </select>
              </div>
              <div class="col-md-12">
                <label for="nombre">Descripción</label>
                <input  type="text" class="form-control" id="modal_description_reg" title="Descripcion" required readonly> </input>
              </div>
              <div class="col-md-12">
                <label for="nombre">Tipo de salida</label>
                  <select class="form-select" id="modal_tipo_reg" name="tipo_reg" aria-label="Default select example" title="Tipo de salida" required>
                      <option value=""selected disabled>Seleccione un Tipo de Salida</option>
                      <option value="1">Mantenimiento</option>
                      <option value="2">Reparación</option>
                      <option value="3">Traspaso</option>
                      <option value="4">Baja</option>                      
                  </select>
              </div>
              <div class="col-md-12">
                <label for="nombre">Comentarios</label>
                <textarea  type="text" class="form-control" id="modal_comentarios_reg" name="comentarios_reg" value="" title="Comentarios" required> </textarea>
              </div>
                <br>

              <div class="row justify-content-around">
                <button type="submit" id="btn_crear_incidencias_reg" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around;">Crear </button>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDITAR BITACORA -->
<div class="modal fade" id="modal_upd_bitacora" tabindex="-1" aria-labelledby="ver_registro" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="ver_registro">Editar Incidencia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alarmaAjax.php" method="POST" data-form="save">
        <div class="col-md-12">
                    <label for="nombre">Aseet</label>
                    <input type="hidden" id="modal_upd_id" name="upd_id">
                    <input type="text" class="form-control" id="modal_asset_upd" name="asset_upd" aria-label="Default select example" title="Asset" readonly></input>
              </div>
              <div class="col-md-12">
                <label for="nombre">Comentario</label>
                <input  type="text" class="form-control" id="modal_comentario_upd" title="Comentario" name="comentario_upd"> </input>
              </div>
              <div class="col-md-12">
                <label for="nombre">Tipo de salida</label>
                  <select class="form-select" id="modal_tipo_upd" name="tipo_upd" aria-label="Default select example" title="Tipo de salida" >
                      <option value=""selected disabled>Seleccione un Tipo de Salida</option>
                      <option value="1">Mantenimiento</option>
                      <option value="2">Reparación</option>
                      <option value="3">Traspaso</option>
                      <option value="4">Baja</option>                      
                  </select>
              </div>
                <br>

              <div class="row justify-content-around">
                <button type="submit" id="btn_incidencias_upd" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around;">Actualizar <i class='bx bx-reset nav_icon' aria-hidden="true" style="font-size:20px"></i></button>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>