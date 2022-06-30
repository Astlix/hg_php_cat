<div id="seccion-wrap">
  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h1>Lista de Activos</h1>
    </div>

    <div class="box-cont-blanco" id="box">

      <div class="botones" style="width:100%;display: flex;justify-content:space-between; ">
        <div class="btn1" style="display: flex;">
          <a href="<?php echo SERVERURL; ?>crearactivos" type="button" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Agregar<i class='bx bx-add-to-queue nav_icon' style="padding-left: 5px;"></i></a>
          <a href="<?php echo SERVERURL; ?>inventario" type="button" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Inventario<i class='bx bx-list-check nav_icon' style="padding-left: 5px;"></i></a>
        </div>
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/activoAjax.php" method="post" id="subirexcel" style="display:flex;justify-content: space-between; align-items: center;" enctype="multipart/form-data">
          <input type="file" class="form-control-file" id="exampleFormControlFile1" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="name_doc">
          <!-- <a  type="submit" class="btn btn-success" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Importar CSV<i class='bx bxs-file-import' style="padding-left: 5px;"></i></a> -->
          <button type="submit" class="btn btn-success" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Importar CSV<i class='bx bxs-file-import' style="padding-left: 5px;"></i></button>
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
        $tabla  = '<table style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
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
          $site = $dato['TagSite'];
          $planta= substr($site,18,-4);
          $columna= substr($site,20,-2);
          $num_columna= substr($site,-2);

          $searchString = " ";
          $replaceString = "";          
          $nombre_img = str_replace($searchString, $replaceString, $dato['Ruta']); 
          
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
                    <li><a class="dropdown-item" id="ver_registro_act" 
                    data-id="'.$dato['idCA'].'"
                    data-asset="'.$dato['Asset'].'"
                    data-description="'.$dato['Description'].'"
                    data-epc="'.$dato['TagEpc'].'"
                    data-serial="'.$dato['SerialNumber'].'"
                    data-site="'.$dato['TagSite'].'"
                    data-tagfind="'.$dato['TagSiteFound'].'"
                    data-inventario="'.$dato['Inventory'].'"
                    data-fecha="'.$dato['DateInventory'].'"
                    data-s1="'.$dato['Service001'].'"
                    data-s2="'.$dato['Service002'].'"
                    data-s3="'.$dato['Service003'].'"
                    data-s4="'.$dato['Service004'].'"
                    data-s5="'.$dato['Service005'].'"
                    data-planta="'.$planta.'"
                    data-columna="'.$columna.'"
                    data-num="'.$num_columna.'"
                    data-ruta="'.$nombre_img.'"
                    
                    ><i class="bx bx-show"></i> Ver</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <form action="' . SERVERURL . 'ajax/activoAjax.php" class="FormularioAjax" method="post" data-form="delete">
                    <input type="hidden" name="activo_id_delete" value="'.Mainmodel::encryption($dato['idCA']).'">
                    <button type="submit" class="btn btn-secondary" style="background-color:transparent; color:black; border-color:transparent;width:100%;">
                    <lord-icon
                        src="https://cdn.lordicon.com/dovoajyj.json"
                        trigger="loop-on-hover"
                        style="width:25px;height:25px">
                    </lord-icon> Eliminar</button>
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
      
      include 'modal.php';
      ?>


    </div>
  </div>
</div>

