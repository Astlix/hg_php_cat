<link rel="stylesheet" href="./public/css/home.css">
<!-- PRIMERA GRAFICA -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h1><i class='bx bx-home-alt-2'></i> Home</h1>
    </div>
    <?php

    // PRIEMRA GGRAFICA
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


<!-- DATOS PARA LA SEGUNDA GRAFICAA  -->
<?php
    $rsp = ActivosModel::ver_activos();
    $finsa1 = $finsa1_st = $finsa1_ct = 0;
    $finsa3 = $finsa3_st = $finsa3_ct = 0;
    $oradel = $oradel_st = $oradel_ct = 0;
    $total_ct = $total_st = 0;
    $cls = $cls_st = $cls_ct = 0;
    $total1=$total2=0;
    foreach ($rsp as $dato) {
      $planta2 = $dato['Service002'];
      $site = $dato['TagSite'];
      $epc = trim($dato['TagEpc']);
      $planta = substr($site, 18, -4);
      $columna = substr($site, 20, -2);
      $num_columna = substr($site, -2);

      // EVALUAMOS SI TIENEN TAG Y CATEGORIAS
      if ($site == '' && $planta2 == 1 && $epc == '') {$finsa1_st++; $total_st++;}
      if ($site != '' && $planta == '01' && $epc == '') {$finsa1_st++; $total_st++;}

      if ($site != '' && $planta == '01' && $epc != '') {$finsa1_ct++; $total_ct++;}

      if ($site == '' && $planta2 == 2 && $epc == '') {$finsa3_st++;$total_st++;}
      if ($site != '' && $planta == '02' && $epc == '') {$finsa3_st++;$total_st++;}
      if ($site != '' && $planta == '02' && $epc != '') {$finsa3_ct++;$total_ct++;}
      
      if ($site == '' && $planta2 == 3 && $epc == '') {$oradel_st++;$total_st++;}
      if ($site != '' && $planta == '03' && $epc == '') {$oradel_st++;$total_st++;}
      if ($site != '' && $planta == '03' && $epc != '') {$oradel_ct++;$total_ct++;}
      
      if ($site == '' && $planta2 == 4 && $epc == '') {$cls_st++;$total_st++;}
      if ($site != '' && $planta2 == 4 && $epc == '') {$cls_st++;$total_st++;}
      if ($site != '' && $planta == '04' && $epc != '') {$cls_ct++;$total_ct++;}

         // FIN DE EVALUAMOS SI existe valor el tagsite sino tomara el valor de service 002
if ($site != '') {
  if ($planta == '01') {
    $finsa1 = $finsa1 + 1;
    $total2 = $total2 + 1;
  }
  if ($planta == '02') {
    $finsa3 = $finsa3 + 1;
    $total2 = $total2 + 1;
  }
  if ($planta == '03') {
    $oradel = $oradel + 1;
    $total2 = $total2 + 1;
  }
  if ($planta == '04') {
    $cls = $cls + 1;
    $total2 = $total2 + 1;
  }
}else{
  if ($planta2 == 1) {
    $finsa1 = $finsa1 + 1;
    $total2 = $total2 + 1;
  }
  if ($planta2 == 2) {
    $finsa3 = $finsa3 + 1;
    $total2 = $total2 + 1;
  }
  if ($planta2 == 3) {
    $oradel = $oradel + 1;
    $total2 = $total2 + 1;
  }
  if ($planta2 == 4) {
    $cls = $cls + 1;
    $total2 = $total2 + 1;
  }
}
      
    }
    ?>


    <div class="box-cont-blanco" id="box">
      <div id="cabecera-activos">

        <div id="card" class="card col-md-4" style="height:auto;align-items: center;">
          <div class="card-header text-dark bg-warning" style="width:100%;">
            <h5 style="width:100%;">Bitacora de Activos</h5>
          </div>
          <canvas id="myChart" style="max-width:95%;height: 330px;"></canvas>
          <h3>Total: <?php echo $total;?></h3>
        </div>
        
        <div id="card" class="card col-md-5" style="overflow:auto;" >
            <div class="card-header text-dark bg-warning" style="text-align:center;">
                <h5>Historial de Alarmas</h5>
            </div>
            <?php
              $rsp = AlarmaModel::ver_alarma_general();


              if (empty($rsp)) {
                  $elemento  = '<div class="box-cont-negro titulo-box m-0">';
                  $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Alarmas</small></h4>';
                  $elemento .= '</div>';
                  echo $elemento;
              } else {
                  $tabla  = '<table id="nombre" data-nombre="alarmas" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
                  $tabla .= '<thead>';
                  $tabla .= '<tr class="bg-warning">';
                  $tabla .= '<th scope="col">Indice</th>';       
                  $tabla .= '<th scope="col">Asset</th>';             
                  $tabla .= '<th scope="col">Fecha de Alarma</th>';  
                  $tabla .= '</tr>';
                  $tabla .= '</thead>';
                  $tabla .= '<tbody style="font-size:12px;">';
                  $i = 0;

                  foreach ($rsp as $dato) {
                    if ($dato['FechaAlarma']=='') {
                      continue;
                    }

                      
                      $sql2 = AlarmaModel::ver_reader(trim($dato['Ubicacion']));
                      $i++;
                      $tabla .= '<tr class="elemento">';
                      $tabla .= '<td scope="col" class="salida">'. $i . '</td>';
                      $tabla .= '<td scope="col" class="lote">'. $dato['Asset'] .'</td>';
                      $tabla .= '<td scope="col" class="lote">'. $dato['FechaAlarma'] .'</td>';
                      $tabla .= '</tr>';
                  }           

                  //falta agregar cls
                  $tabla .= '</tbody>';
                  $tabla .= '</table>';
                  echo $tabla;
              }        


              ?>
        </div>

        <div id="card" class="card col-md-3" style="height:auto;align-items: center;">
          <div class="card-header text-dark bg-warning" style="width:100%;">
            <h5 style="width:100%;">Activos Totales</h5>
          </div>
          <canvas id="myChart2" style="max-width:320px;max-height: 350px;"></canvas>
          <h3>Total: <?php echo $total2;?></h3>
        </div>



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
        'Baja',
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

     // FIN GRAFICA BARRAS  
   // GRAFICA DONUT
   const data2 = {
            labels: [
              'RH',
              'Ventas',
              'Compras',
              'Software'
            ],
            datasets: [{
              label: 'Activos',
              data: [<?php echo $finsa1; ?>, <?php echo $finsa3; ?>, <?php echo $oradel; ?>, <?php echo $cls; ?>],                           
              backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(55, 205, 95)'
              ],
              hoverOffset: 4,

            }]
          };
          

          const config2 = {
            type: 'doughnut',
            data: data2,
          };

          const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
          );


          // FIN GRAFICA DONUT

  </script>

