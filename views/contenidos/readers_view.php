<div id="seccion-wrap">
    <div class="box-cont-negro">
        <div class="box-cont-blanco titulo-box">
            <h1> <i class='bx bx-cast'></i> Portales</h1>
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
            $tabla  = '<table id="nombre" data-nombre="portales" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
            $tabla .= '<thead>';
            $tabla .= '<tr class="bg-warning">';
            $tabla .= '<th scope="col">Index</th>';       
            $tabla .= '<th scope="col">Locación</th>';   
            $tabla .= '<th scope="col">Ubicación</th>';        
            $tabla .= '<th scope="col">Ping</th>';   
            $tabla .= '<th scope="col">Intensidad</th>'; 
            $tabla .= '<th scope="col">Estado</th>'; 
            $tabla .= '</tr>';
            $tabla .= '</thead>';
            $tabla .= '<tbody>';
            $i = 0;

            foreach ($rsp as $dato) {
                if ($dato['Estado'] == 1) {
                    $linea = '<td scope="col" class="lote"><p hidden>Activo</p> <i class="bx bx-devices nav_icon"  style="color:green;font-size:30px;" title="Activo"></td>';
                }else{
                    $linea = '<td scope="col" class="lote"><p hidden>Activo</p> <i class="bx bx-devices nav_icon"  style="color:red;font-size:30px;" title="Inactivo"></td>'; 
                }
                // echo $planta.$columna.$num_columna.'<br>';
                $i++;
                $tabla .= '<tr class="elemento">';
                $tabla .= '<td scope="col" class="salida">'. $i . '</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Locacion'] .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['Planta'] . $dato['Columna']  .'</td>';
                $tabla .= '<td scope="col" class="lote">'. $dato['TxPower'] .'</td>';
                $tabla .= '<td scope="col" class="lote"><p hidden>Buena</p> <i class="bx bx-signal-5 nav_icon"  style="color:green;font-size:30px;" title="Buena"></td>';
                $tabla .= $linea;
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






