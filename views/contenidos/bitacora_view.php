<link rel="stylesheet" href="./public/css/bitacora.css">
<!-- PRIMERA GRAFICA -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h1>Bitacora</h1>
    </div>
    <?php
    $rsp = ActivosModel::ver_activos();
 
    ?>
    <div class="box-cont-blanco" id="box">
      <div id="cabecera-activos">

        <div id="card" class="card col-md-3" style="height:auto;align-items: center;">
          <div class="card-header text-dark bg-warning" style="width:100%;">
            <h5 style="width:100%;">Dashboard 1</h5>
          </div>
          <canvas id="myChart" style="max-width:95%;max-height: auto;"></canvas>
          <h3>Total: 10</h3>
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
                            <td>5</td>
                        </tr>
                        <tr>
                            <th scope="row">Reparación</th>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">Traspaso</th>
                            <td>4</td>
                        </tr>
                        </tr>
                        <tr>
                            <th scope="row">Baja</th>
                            <td>10</td>
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
                <select class="form-select" name="filtro_epc" id="filtro_epc">
                  <option value="" selected>Todos</option>
                  <option value="1">Mantenimiento</option>
                  <option value="2">Reparación</option>
                  <option value="3">Traspaso</option>
                  <option value="4">Baja</option>
                </select>
            </form>
        </div>


        <div class="botones" style="width:100%;display: flex;justify-content:space-between; ">
            <div class="btn1" style="display: flex;">
                <a type="submit" class="btn btn-warning" id="boton_incidencia_activo" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Agregar<i class='bx bx-add-to-queue nav_icon' style="padding-left: 5px;"></i></a>
            </div>
        </div>

        <?php
        $rsp = ActivosModel::ver_activos();
        if (empty($rsp)) {
          $elemento  = '<div class="box-cont-negro titulo-box m-0">';
          $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Bitacora </small></h4>';
          $elemento .= '</div>';
          echo $elemento;
        } else {
          $tabla  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
          $tabla .= '<thead>';
          $tabla .= '<tr class="bg-warning">';
          $tabla .= '<th scope="col">Asset</th>';       
          $tabla .= '<th scope="col">Tipo de Salida</th>';        
          $tabla .= '<th scope="col">Comentarios</th>';        
          $tabla .= '<th scope="col">Fecha</th>';           
          $tabla .= '</tr>';
          $tabla .= '</thead>';
          $tabla .= '<tbody>';
          $i = 0;

          foreach ($rsp as $dato) {
           
            $i++;
            $tabla .= '<tr class="elemento">';
            $tabla .= '<td scope="col" class="salida">' . $dato['Asset'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['Description'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['SerialNumber'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['TagEpc'] . '</td>';
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
        data: [10, 15, 2, 5],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(55, 205, 95)'
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
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>alarma/equipoAjax.php" method="POST" data-form="save">
            <?php 
                        $rsp = ActivosModel::ver_activos();            
            ?>
              <div class="col-md-12">
                    <label for="nombre">Aseet</label>
                  <select class="form-select" id="modal_asset_reg" name="asset_reg" aria-label="Default select example" title="Asset" >
                    <option value=""selected disabled>Seleccione un Asset</option>
                      <?php 
                      foreach ($rsp as $data){
                          $asset = $data['Asset'];
                          echo '<option value="'.$asset.'">'.$asset.' </option> ';
                      }
                      ?>;
                  </select>
              </div>
            <div class="col-md-12">
              <label for="nombre">Descripción</label>
              <input type="text" class="form-control" id="modal_description_reg" name="description_reg" title="Description" value ="" >
            </div>
            <div class="col-md-12">
              <label for="nombre">Tipo de salida</label>
                <select class="form-select" id="modal_tipo_reg" name="tipo_reg" aria-label="Default select example" title="Tipo de salida" >
                    <option value=""selected disabled>Seleccione un Tipo de Salida</option>
                    <option value="0">Mantenimiento</option>
                    <option value="1">Reparación</option>
                    <option value="2">Traspaso</option>
                    <option value="3">Baja</option>                      
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