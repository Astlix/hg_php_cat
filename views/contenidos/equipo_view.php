<div id="seccion-wrap">
    <div class="box-cont-negro">

        <div class="box-cont-blanco titulo-box">
            <h1> <i class='bx bx-mobile-alt '></i> Equipos</h1>
            </div>
            
            <hr class="my-2">
            <h4> Equipo Hand Held</h4>

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
            $tabla  = '<table id="nombre" data-nombre="handhelds" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
            $tabla .= '<thead>';
            $tabla .= '<tr class="bg-warning">';
            $tabla .= '<th scope="col">Index</th>';      
            $tabla .= '<th scope="col">MAC</th>';        
            $tabla .= '<th scope="col">Marca</th>';       
            $tabla .= '<th scope="col">Modelo</th>';      
            $tabla .= '<th scope="col">Opciones</th>';    
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
                                        <li><a class="dropdown-item" type="button" id="ver_dato_hh" style="text-align:center;"
                                        data-id="'.trim($dato['idHandheld']).'"
                                        data-mac="'.trim($dato['MAC']).'"
                                        data-marca="'.trim($dato['Marca']).'"
                                        data-modelo="'.trim($dato['Modelo']).'"                    
                                        ><i class="bx bx-pencil" style="color:blue;"></i> Editar</a></li>                                        
                                        <li><hr class="dropdown-divider"></li>
                                        <form action="' . SERVERURL . 'ajax/equipoAjax.php" class="FormularioAjax" method="post" data-form="delete">
                                        <input type="hidden" name="hh_id_delete" value="'.$dato['idHandheld'].'">
                                        <button type="submit" class="btn btn-secondary" style="background-color:transparent; color:black; border-color:transparent;width:100%;"><i class="bx bx-trash" style="color:red;"></i> Eliminar</button>
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
        <hr class="my-2">
        <div class="box-cont-blanco titulo-box">
            <h4> Equipo Readers</h4>
        </div>

        <div class="botones" style="width:100%;display: flex;justify-content:space-between; ">
                <div class="btn1" style="display: flex;width:100%; justify-content:space-between;">
                    <a type="button" id="crear_reader" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Agregar<i class='bx bx-add-to-queue nav_icon' style="padding-left: 5px;"></i></a>
                </div>                
            </div>
        <?php
        $rsp = EquipoModel::ver_reader_general();


        if (empty($rsp)) {
            $elemento  = '<div class="box-cont-negro titulo-box m-0">';
            $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Equipos</small></h4>';
            $elemento .= '</div>';
            echo $elemento;
        } else {
            $tabla  = '<table id="nombre2" data-nombre="readers" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active2">';
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
            $tabla .= '<th scope="col">Opciones</th>'; 
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
                $tabla .= '<td>
                <div class="btn-group">
                <button type="button" stlyle="width:50px;" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" type="button" id="ver_dato_reader" style="text-align:center;"
                        data-id="'.trim($dato['idReader']) .'"                   
                        data-mac="'.trim($dato['MAC']) .'"                   
                        data-dns="'.trim($dato['DNSName']) .'"                   
                        data-ip="'.trim($dato['IPAddress']) .'"                   
                        data-mask="'.trim($dato['SubnetMask']) .'"                   
                        data-planta="'.trim($dato['Planta']) .'"                   
                        data-columna="'.trim($dato['Columna']) .'"                   
                        data-app="'.trim($dato['App']) .'"                   
                        data-app="'.trim($dato['App']) .'"                   
                        data-marca="'.trim($dato['Marca']) .'"                   
                        data-modelo="'.trim($dato['Modelo']) .'"                   
                        data-loc="'.trim($dato['Locacion']) .'"                   
                        data-gateway="'.trim($dato['Gateway']) .'"                   
                        data-tx="'.trim($dato['TxPower']) .'"                   
                        ><i class="bx bx-pencil" style="color:blue;"></i> Editar</a></li>
                        <li style="text-align:center;"><a type="button" target="_blank" style="text-align:center;color:black;" href="http://'.trim($dato['IPAddress']) .':8080"><i class="bx bx-cog" style="color:gray;"></i> Configurar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <form action="' . SERVERURL . 'ajax/equipoAjax.php" class="FormularioAjax" method="post" data-form="delete">
                        <input type="hidden" name="reader_id_delete" value="'.$dato['idReader'].'">
                        <button type="submit" class="btn btn-secondary" style="background-color:transparent; color:black; border-color:transparent;width:100%;"><i class="bx bx-trash" style="color:red;"></i> Eliminar</button>
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

<!-- Modal Crear Reader -->
<div class="modal fade hh" id="modal_crear_reader" tabindex="-1" aria-labelledby="crear_read" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="crear_read">Agregar Reader </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/equipoAjax.php" method="POST" data-form="save">
          <div class="row">
            <div class="col-md-12">
              <label for="nombre">MAC</label>
              <input type="text" class="form-control" id="modal_mac_read_reg" name="mac_read_reg" title="MAC" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">DNSName</label>
              <input type="text" class="form-control" id="modal_dns_read_reg" name="dns_read_reg" title="Marca" required>
            </div>
            <!-- //ubicacion -->
            <div class="row"> 
              <label for="nombre">Ubicación</label>
              <div class="col-md-6">
                <select class="form-control" id="modal_planta_read_reg" name="planta_read_reg" title="Planta" required>
                  <option value="f1">Finsa 1</option>
                  <option value="f3">Finsa 3</option>
                  <option value="or">Oradel</option>
                  <option value="cls">CLS</option>
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-control" id="modal_planta_read_reg" name="columna_read_reg" title="Planta" required>
                <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                  <option value="G">G</option>
                  <option value="H">H</option>
                  <option value="I">I</option>
                  <option value="J">J</option>
                  <option value="L">L</option>
                  <option value="M">M</option>
                  <option value="N">N</option>
                  <option value="O">O</option>
                  <option value="P">P</option>
                  <option value="Q">Q</option>
                  <option value="R">R</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <label for="nombre">Locación</label>
              <input type="text" class="form-control" id="modal_loc_read_reg" name="loc_read_reg" title="Locación" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">IPAdress</label>
              <input type="text" class="form-control" id="modal_ip_read_reg" name="ip_read_reg" title="IpAddress" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">SubnetMask</label>
              <input type="text" class="form-control" id="modal_mask_read_reg" name="mask_read_reg" title="SubnetMask" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Gateway</label>
              <input type="text" class="form-control" id="modal_gateway_read_reg" name="gateway_read_reg" title="Gateway" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">App</label>
              <input type="text" class="form-control" id="modal_app_read_reg" name="app_read_reg" title="App" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Tx Power</label>
              <input type="text" class="form-control" id="modal_tx_read_reg" name="tx_read_reg" title="TxPower" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Marca</label>
              <input type="text" class="form-control" id="modal_marca_read_reg" name="marca_read_reg" title="Marca" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Modelo</label>
              <input type="text" class="form-control" id="modal_modelo_read_reg" name="modelo_read_reg" title="Modelo" required>
            </div>
              <br><br>
            <div class="row justify-content-around">
                <button type="submit" id="btn_agregar_read_reg" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around; margin-top:10px">Agregar </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





