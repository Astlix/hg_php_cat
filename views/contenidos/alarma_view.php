<div id="seccion-wrap">
    <div class="box-cont-negro">

        <div class="box-cont-blanco titulo-box">
            <h1>Alarmas</h1>
            </div>
            
            <hr class="my-2">
            <h4><i class='bx bx-time-five'></i> Registro de Alarmas</h4>

        <?php
        $rsp = AlarmaModel::ver_alarma_general();


        if (empty($rsp)) {
            $elemento  = '<div class="box-cont-negro titulo-box m-0">';
            $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Alarmas</small></h4>';
            $elemento .= '</div>';
            echo $elemento;
        } else {
            $tabla  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
            $tabla .= '<thead>';
            $tabla .= '<tr class="bg-warning">';
            $tabla .= '<th scope="col">Indice</th>';       
            $tabla .= '<th scope="col">Asset</th>';       
            $tabla .= '<th scope="col">Comentario</th>';        
            $tabla .= '<th scope="col">Fecha de Alarma</th>';          
            $tabla .= '<th scope="col">Opciones</th>';         
            $tabla .= '</tr>';
            $tabla .= '</thead>';
            $tabla .= '<tbody>';
            $i = 0;

            foreach ($rsp as $dato) {
              if ($dato['FechaAlarma']=='') {
                continue;
              }

              $sql = AlarmaModel::ver_un_activos_por_asset2(trim($dato['Asset']));
              if ($sql) {
                $descripcion = $sql['Description'];
                $tag_activo = $sql['TagEpc'];
                $tag_ubicacion = $sql['TagSite'];
                $tag_nueva_ubicacion = $sql['TagSiteFound'];
                $s1 = $sql['Service001'];
                $inventory = $sql['DateInventory'];
              }else{
                $descripcion = 'n/a';
                $tag_activo = 'n/a';
                $tag_ubicacion = 'n/a';
                $tag_nueva_ubicacion = 'n/a';
                $s1 = 'n/a';
                $inventory = 'n/a';
              }

              //FILTRO PARA SABER SI YA HAY COMENTARIOS DE LA ALARMA O NO 
              if(trim($dato['Comentarios'])!='Sin registro'){
                $linea = '<td style="cursor:not-allowed;">
                                  <div class="btn-group" >
                                  <button type="button" style="width:50px;cursor: not-allowed;pointer-events: none;" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" type="button" id="ver_dato_alarma" 
                                          data-id="'.trim($dato['idBitacora']).'"
                                          data-asset="'.trim($dato['Asset']).'"
                                          data-comentario="'.trim($dato['Comentarios']).'"
                                          data-tipo="'.trim($dato['TipoSalida']).'"
                                          data-description="'.$descripcion.'"                    
                                          data-tagepc="'.$tag_activo.'"                    
                                          data-tagsite="'.$tag_ubicacion.'"                    
                                          data-tagsitefound="'.$tag_nueva_ubicacion.'"                    
                                          data-s1="'.$s1.'"                    
                                          data-inventory="'.$inventory.'"                    
                                          ><i class="bx bx-message-dots" style="color:blue;margin-right:15px;"></i> Crear Comentario</a></li>
                                          
                                      </ul>
                                  </div>
                          </td>';
              }else{
                $linea = '<td>
                              <div class="btn-group">
                              <button type="button" stlyle="width:50px;" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                                  <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" type="button" id="ver_dato_alarma" 
                                      data-id="'.trim($dato['idBitacora']).'"
                                      data-asset="'.trim($dato['Asset']).'"
                                      data-comentario="'.trim($dato['Comentarios']).'"
                                      data-tipo="'.trim($dato['TipoSalida']).'"
                                      data-description="'.$descripcion.'"                    
                                      data-tagepc="'.$tag_activo.'"                    
                                      data-tagsite="'.$tag_ubicacion.'"                    
                                      data-tagsitefound="'.$tag_nueva_ubicacion.'"                    
                                      data-s1="'.$s1.'"                    
                                      data-inventory="'.$inventory.'"                    
                                      ><i class="bx bx-message-dots" style="color:blue;margin-right:15px;"></i> Crear Comentario</a></li>
                                      
                                  </ul>
                              </div>
                          </td>';
              }

                // echo $planta.$columna.$num_columna.'<br>';
                $i++;
                $tabla .= '<tr class="elemento">';
                $tabla .= '<td scope="col" class="salida">'. $i . '</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Asset'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Comentarios'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['FechaAlarma'] .'</td>';
                $tabla .= $linea;
                $tabla .= '</tr>';
            }           

            //falta agregar cls
            $tabla .= '</tbody>';
            $tabla .= '</table>';
            echo $tabla;
        }        

      require 'modal.php';

        ?>

     </div>
</div>

<!-- Modal Crear Hand Held -->
<div class="modal fade hh" id="modal_reg_inc_alarma" tabindex="-1" aria-labelledby="ver_alarma" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="ver_registro">Crear Bitacora de Alarma </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alarmaAjax.php" method="POST" data-form="save">
                    <div class="col-md-12">
                      <label for="nombre">Aseet</label>
                      <input type="hidden" id="id_alarma" name="id_alarma">
                      <input  type="text" class="form-control" id="modal_asset_reg_alarm" name="asset_reg_alarm" title="Asset" required readonly> </input>
                    </div>
                    <div class="col-md-12">
                      <label for="nombre">Descripción</label>
                      <input  type="text" class="form-control" id="modal_description_reg" title="Descripcion" required readonly> </input>
                    </div>
                    <div class="col-md-12">
                      <label for="nombre">Tag activo</label>
                      <input  type="text" class="form-control" id="modal_tagepc_reg" title="tagepc" required readonly> </input>
                    </div>
                    <div class="col-md-12">
                      <label for="nombre">Tag ubicación</label>
                      <input  type="text" class="form-control" id="modal_tagsite_reg" title="tagsite" required readonly> </input>
                    </div>
                    <div class="col-md-12">
                      <label for="nombre">Tag nueva ubicación</label>
                      <input  type="text" class="form-control" id="modal_tagsitefound_reg" title="tagsitefound" required readonly> </input>
                    </div>
                    <div class="col-md-12">
                      <label for="nombre">Fecha de ultimo inventario</label>
                      <input  type="text" class="form-control" id="modal_inventory_reg" title="inventory" required readonly> </input>
                    </div>
                    <hr>
                    <div class="col-md-12">
                      <label for="nombre">Tipo de salida</label>
                        <select class="form-select" id="modal_tipo_alarma" name="tipo_alarma" aria-label="Default select example" title="Tipo de salida" >
                            <option value=""selected disabled>Seleccione un Tipo de Salida</option>
                            <option value="1">Mantenimiento</option>
                            <option value="2">Reparación</option>
                            <option value="3">Traspaso</option>
                            <option value="4">Baja</option>                      
                        </select>
                    </div>
                    <div class="col-md-12">
                      <label for="nombre">Comentarios</label>
                      <textarea  type="text" class="form-control" id="modal_comentarios_alarma" name="comentarios_alarma" value="" title="Comentarios" required> </textarea>
                    </div>
                      <br>

                    <div class="row justify-content-around">
                      <button type="submit" id="btn_crear_incidencias_alarma" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around;">Crear</button>
                    </div>
              </form>
      </div>
    </div>
  </div>
</div>





