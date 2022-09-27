<div id="seccion-wrap">
    <div class="box-cont-negro">

        <div class="box-cont-blanco titulo-box">
            <h1>Equipos</h1>
            </div>
            
            <hr class="my-2">
            <h4><i class='bx bx-devices'></i> Equipo Hand Held</h4>

            <div class="botones" style="width:100%;display: flex;justify-content:space-between; ">
                <div class="btn1" style="display: flex;width:100%; justify-content:space-between;">
                    <a type="button" id="crear_hh" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Agregar<i class='bx bx-add-to-queue nav_icon' style="padding-left: 5px;"></i></a>
                </div>                
            </div>
        <?php
        $rsp = EquipoModel::ver_hh_general();


        if (empty($rsp)) {
            $elemento  = '<div class="box-cont-negro titulo-box m-0">';
            $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Equipos</small></h4>';
            $elemento .= '</div>';
            echo $elemento;
        } else {
            $tabla  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
            $tabla .= '<thead>';
            $tabla .= '<tr class="bg-warning">';
            $tabla .= '<th scope="col">Index</th>';       //id
            $tabla .= '<th scope="col">MAC</th>';        // mac
            $tabla .= '<th scope="col">Marca</th>';          // marca
            $tabla .= '<th scope="col">Modelo</th>';          // modelo
            $tabla .= '<th scope="col">Opciones</th>';          // opciones
            $tabla .= '</tr>';
            $tabla .= '</thead>';
            $tabla .= '<tbody>';
            $i = 0;

            foreach ($rsp as $dato) {

                // echo $planta.$columna.$num_columna.'<br>';
                $i++;
                $tabla .= '<tr class="elemento">';
                $tabla .= '<td scope="col" class="salida">'. $i . '</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['MAC'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Marca'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Modelo'] .'</td>';
                $tabla .= '<td>
                                <div class="btn-group">
                                <button type="button" stlyle="width:50px;" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" type="button" id="ver_dato_hh" 
                                        data-id="'.trim($dato['idHandheld']).'"
                                        data-mac="'.trim($dato['MAC']).'"
                                        data-marca="'.trim($dato['Marca']).'"
                                        data-modelo="'.trim($dato['Modelo']).'"                    
                                        ><i class="bx bx-pencil"></i> Editar</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <form action="' . SERVERURL . 'ajax/equipoAjax.php" class="FormularioAjax" method="post" data-form="delete">
                                        <input type="hidden" name="hh_id_delete" value="'.$dato['idHandheld'].'">
                                        <button type="submit" class="btn btn-secondary" style="background-color:transparent; color:black; border-color:transparent;width:100%;"><i class="bx bx-trash"></i> Eliminar</button>
                                        </form>
                                    </ul>
                                </div>
                        </td>';
                $tabla .= '</tr>';
            }           

            //falta agregar cls
            $tabla .= '</tbody>';
            $tabla .= '</table>';
            echo $tabla;
        }        

      require 'modal.php';

        ?>

        <div class="box-cont-blanco titulo-box">
            <h4> <i class='bx bx-cast'></i> Equipo Readers</h4>
        </div>

        <hr class="my-2">
        <?php
        $rsp = EquipoModel::ver_reader_general();


        if (empty($rsp)) {
            $elemento  = '<div class="box-cont-negro titulo-box m-0">';
            $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Equipos</small></h4>';
            $elemento .= '</div>';
            echo $elemento;
        } else {
            $tabla  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
            $tabla .= '<thead>';
            $tabla .= '<tr class="bg-warning">';
            $tabla .= '<th scope="col">Index</th>';       //id
            $tabla .= '<th scope="col">MAC</th>';       //id
            $tabla .= '<th scope="col">DNSNAme</th>';        // mac
            $tabla .= '<th scope="col">IPAddress</th>';          // opciones
            $tabla .= '<th scope="col">SubnetMask</th>';          // opciones
            $tabla .= '<th scope="col">Pl</th>';          // marca
            $tabla .= '<th scope="col">Col</th>';          // modelo
            $tabla .= '<th scope="col">App</th>';          // opciones
            $tabla .= '<th scope="col">TxPower</th>';          // opciones
            $tabla .= '<th scope="col">Marca</th>';          // opciones
            $tabla .= '<th scope="col">Modelo</th>'; 
            // $tabla .= '<th scope="col">Opciones</th>'; 
            $tabla .= '</tr>';
            $tabla .= '</thead>';
            $tabla .= '<tbody>';
            $i = 0;

            foreach ($rsp as $dato) {

                // echo $planta.$columna.$num_columna.'<br>';
                $i++;
                $tabla .= '<tr class="elemento">';
                $tabla .= '<td scope="col" class="salida">'. $i . '</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['MAC'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['DNSName'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['IPAddress'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['SubnetMask'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Planta'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Columna'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['App'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['TxPower'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Marca'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Modelo'] .'</td>';
                // $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                $tabla .= '</tr>';
            }           

            //falta agregar cls
            $tabla .= '</tbody>';
            $tabla .= '</table>';
            echo $tabla;
        }
              
        ?>
     </div>
</div>

<!-- Modal Crear Hand Held -->
<div class="modal fade hh" id="modal_crear_hh" tabindex="-1" aria-labelledby="ver_registro" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="ver_registro">Agregar Hand Held </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/equipoAjax.php" method="POST" data-form="save">
          <div class="row">
            <div class="col-md-12">
              <label for="nombre">MAC</label>
              <input type="text" class="form-control" id="modal_mac_hh_reg" name="mac_hh_reg" title="MAC" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Marca</label>
              <input type="text" class="form-control" id="modal_marca_hh_reg" name="marca_hh_reg" title="Marca" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Modelo</label>
              <input type="text" class="form-control" id="modal_modelo_hh_reg" name="modelo_hh_reg" title="Modelo" required>
            </div>
              <br><br>
            <div class="row justify-content-around">
                <button type="submit" id="btn_agregar_hh_reg" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around; margin-top:10px">Crear </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





