<link rel="stylesheet" href="./public/css/activos.css">
<!-- PRIMERA GRAFICA -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- SEGUNDO GRAFICA -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/plugins/exporting.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


  <div class="box-cont-negro">

    <div class="box-cont-blanco titulo-box">
      <h1><i class='bx bxs-package'></i> Activos</h1>
    </div>
    <?php
    $rsp = ActivosModel::ver_activos();
    $finsa1 = $finsa1_st = $finsa1_ct = 0;
    $finsa3 = $finsa3_st = $finsa3_ct = 0;
    $oradel = $oradel_st = $oradel_ct = 0;
    $total_ct = $total_st = 0;
    $cls = $cls_st = $cls_ct = 0;
    $total=0;
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
    $total = $total + 1;
  }
  if ($planta == '02') {
    $finsa3 = $finsa3 + 1;
    $total = $total + 1;
  }
  if ($planta == '03') {
    $oradel = $oradel + 1;
    $total = $total + 1;
  }
  if ($planta == '04') {
    $cls = $cls + 1;
    $total = $total + 1;
  }
}else{
  if ($planta2 == 1) {
    $finsa1 = $finsa1 + 1;
    $total = $total + 1;
  }
  if ($planta2 == 2) {
    $finsa3 = $finsa3 + 1;
    $total = $total + 1;
  }
  if ($planta2 == 3) {
    $oradel = $oradel + 1;
    $total = $total + 1;
  }
  if ($planta2 == 4) {
    $cls = $cls + 1;
    $total = $total + 1;
  }
}

    }
    ?>
    <div class="box-cont-blanco" id="box">
      <div id="cabecera-activos">

        <div id="card" class="card col-md-3" style="height:auto;align-items: center;">
          <div class="card-header text-dark bg-warning" style="width:100%;">
            <h5 style="width:100%;">Dashboard 1</h5>
          </div>
          <canvas id="myChart" style="max-width:320px;max-height: 350px;"></canvas>
          <h3>Total: <?php echo $total;?></h3>
        </div>

        <div id="card" class="card col-md-4">
          <div class="card-header text-dark bg-warning" style="text-align:center;">
            <h5>Search</h5>
          </div>
            <form>
              <label for="" class="form-label">Find Asset:</label>
              <input type="text" class="form-control" name="filtro_asset" id="filtro_asset" aria-describedby="helpId" placeholder="">

                <label for="" class="form-label">Site:</label>
                <select class="form-select" name="filtro_planta" id="filtro_planta">
                  <option value="" selected>Todos</option>
                  <option value="RH">RH</option>
                  <option value="Ventas">Ventas</option>
                  <option value="Compras">Compras</option>
                  <option value="Software">Software</option>
                </select>

                <label for="" class="form-label">EPC:</label>
                <select class="form-select" name="filtro_epc" id="filtro_epc">
                  <option value="" selected>Todos</option>
                  <option value="cad1201402">Con EPC</option>
                  <option value="No asignado">Sin EPC</option>
                </select>
            </form>
            <!-- CARGA MASIVA DE ACTIVOS -->
            <div class="card-header text-dark bg-warning" style="text-align:center;margin: 20px 0px;">
              <h5>Load Template</h5>
            </div>
            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/activoAjax.php" method="post" style="display:flex;flex-direction: column; align-items: center;" enctype="multipart/form-data">
              <input type="file" class="form-control-file" id="exampleFormControlFile1" accept=".xlsx" name="nombre_doc">
              <button type="submit" class="btn btn-success" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Importar<i class='bx bxs-file-import' style="padding-left: 5px;"></i></button>
            </form>

        </div>

        <div id="card" class="card col-md-5">
          <div class="card-header text-dark bg-warning" style="text-align:center;">
            <h5>Dashboard 2</h5>
          </div>

          <div id="chartdiv"></div>

        </div>


        <div class="botones" style="width:100%;display: flex;justify-content:space-between; ">
          <div class="btn1" style="display: flex;">
            <!-- <a href="<?php echo SERVERURL; ?>crearactivos" type="button" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Agregar<i class='bx bx-add-to-queue nav_icon' style="padding-left: 5px;"></i></a> -->
            <a href="<?php echo SERVERURL; ?>inventario" type="button" class="btn btn-warning" style="margin: 10px 15px 10px 0px; display: flex; align-items: center; width: auto;">Inventario<i class='bx bx-list-check nav_icon' style="padding-left: 5px;"></i></a>
          </div>
        </div>

        <?php
        $rsp = ActivosModel::ver_activos();
        if (empty($rsp)) {
          $elemento  = '<div class="box-cont-negro titulo-box m-0">';
          $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Activos</small></h4>';
          $elemento .= '</div>';
          echo $elemento;
        } else {
          $tabla  = '<table id="nombre" data-nombre="activos" style="border-radius:10px; text-align:center;"  class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
          $tabla .= '<thead>';
          $tabla .= '<tr class="bg-warning">';
          $tabla .= '<th scope="col">ID</th>';
          $tabla .= '<th scope="col">Descripción</th>';
          $tabla .= '<th scope="col">Serial</th>';
          $tabla .= '<th scope="col">EPC</th>';
          $tabla .= '<th scope="col">Fecha Inventario</th>';
          $tabla .= '<th scope="col">Departamento</th>';
          $tabla .= '<th scope="col">Acciones</th>';
          $tabla .= '</tr>';
          $tabla .= '</thead>';
          $tabla .= '<tbody>';
          $i = 0;

          foreach ($rsp as $dato) {
            $planta2 = $dato['Service002'];
            $locacion = $dato['Service003'];
            // REVISAMOS SI ESTA LLENO EL TAGSITEFOUND SINO TOMA EL TAG SITE
            if ($dato['TagSiteFound'] == '') {
              $site = $dato['TagSite'];
            }else{
              $site = $dato['TagSiteFound'];
            }
            if ($dato['TagSite'] == '') {
              $tagsite = 'No asignado';
            }else{
              $tagsite = $dato['TagSite'];
            }

              $planta = substr($site, 18, -4);
              $columna = substr($site, 20, -2);
              $num_columna = substr($site, -2);


            $col = substr(trim($locacion),0,1);
            $columna2 = ActivosModel::ver_columna($col);

            $num_columna2 = substr(trim($locacion),-2);


            //FILTROO PARA SABER QUE TIPO DE FORMATO ES LA IMAGEN

            $img = $dato['Asset'];
            $searchString = " ";
            $replaceString = "";
            $newimg = str_replace($searchString, $replaceString, $img);
            $RUTA_IMG = dirname(__FILE__,3).'/public/img/activos/';
            
            $filejpg = $RUTA_IMG . $newimg . '.jpg';
            $filejpeg =$RUTA_IMG . $newimg . '.jpeg';
            $filepng =$RUTA_IMG . $newimg . '.png';


            $formato =  "";
            $f1 = $f2 = $f3 = true;

            if (file_exists($filejpg)) {$formato = 'jpg';}
            elseif (file_exists($filejpeg)) {$formato = 'jpeg';}
            elseif (file_exists($filepng)) {$formato = 'png';}else{$formato = 'error';}


            // FIN DEL FILTRO PARA SABER EL FORMATO DE LA IMAGEN

            $ubi = ActivosModel::ver_ubicacion_activo($columna);

            $i++;
            $tabla .= '<tr class="elemento">';
            $tabla .= '<td scope="col" class="salida">' . $dato['Asset'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['desc_corta'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['SerialNumber'] . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $tagsite . '</td>';
            $tabla .= '<td scope="col" class="lote">' . $dato['DateInventory'] . '</td>';
            if ($planta == 01 || $planta2 == 1) {
              $tabla .= '<td scope="col" class="lote">Rh</td>';
            } elseif ($planta == 02 || $planta2 == 2) {
              $tabla .= '<td scope="col" class="lote">Ventas</td>';
            } elseif ($planta == 03 || $planta2 == 3) {
              $tabla .= '<td scope="col" class="lote">Compras</td>';
            } elseif ($planta == 04 || $planta2 == 4) {
              $tabla .= '<td scope="col" class="lote">Software</td>';
            } else {
              $tabla .= '<td scope="col" class="lote">No asignado</td>';
            }
            
            $tabla .= '<td>
                <div class="btn-group">
                  <button type="button" stlyle="width:50px;" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" id="ver_registro_act" style="cursor:pointer;text-align:center;"
                    data-id="' . $dato['idCA'] . '"
                    data-asset="' . $dato['Asset'] . '"
                    data-description="' . $dato['desc_corta'] . '"
                    data-epc="' . $dato['TagEpc'] . '"
                    data-serial="' . $dato['SerialNumber'] . '"
                    data-site="' . $dato['TagSite'] . '"
                    data-tagfind="' . $dato['TagSiteFound'] . '"
                    data-inventario="' . $dato['Inventory'] . '"
                    data-fecha="' . $dato['DateInventory'] . '"
                    data-s1="' . $dato['Service001'] . '"
                    data-s2="' . $dato['Service002'] . '"
                    data-empleado="' . $dato['Service003'] . '"
                    data-desclarga="' . $dato['desc_larga'] . '"
                    data-modelo="' . $dato['marca_modelo'] . '"
                    data-numalterno="' . $dato['num_alterno'] . '"
                    data-proveedor="' . $dato['proveedor'] . '"
                    data-planta="' . $planta . '"
                    data-columna="' . $columna . '"
                    data-num="' . $num_columna . '"
                    data-planta2="' . trim($planta2) . '"
                    data-columna2="' . $columna2 . '"
                    data-num2="' . $num_columna2 . '"
                    data-img="' . $formato . '"

                    ><i class="bx bx-show" style="color:blue"></i> Ver</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <form action="' . SERVERURL . 'ajax/activoAjax.php" class="FormularioAjax" method="post" data-form="delete">
                    <input type="hidden" name="activo_id_delete" value="' . Mainmodel::encryption($dato['idCA']) . '">
                    <button type="submit" class="btn btn-secondary" style="background-color:transparent; color:black; border-color:transparent;width:100%;"><i class="bx bx-trash" style="color:crimson;"></i> Eliminar</button>
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

  <script>

          // GRAFICA DONUT
          const data = {
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

          const config = {
            type: 'doughnut',
            data: data,
          };

          const myChart = new Chart(
            document.getElementById('myChart'),
            config
          );

          // FIN GRAFICA DONUT

          // SEGUNDA GRAFICA
      am5.ready(function() {


      // Create root element
      // https://www.amcharts.com/docs/v5/getting-started/#Root_element
      var root = am5.Root.new("chartdiv");


      // Set themes
      // https://www.amcharts.com/docs/v5/concepts/themes/
      root.setThemes([
        am5themes_Animated.new(root)
      ]);


      // Create chart
      // https://www.amcharts.com/docs/v5/charts/xy-chart/
      var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: false,
        panY: false,
        wheelX: "panY",
        wheelY: "zoomY",
        layout: root.verticalLayout
      }));

      // Add scrollbar
      // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
      chart.set("scrollbarY", am5.Scrollbar.new(root, {
        orientation: "vertical"
      }));

      var data = [{
        "planta": "Software",
        "SinEPC": <?php echo $finsa1_st;?>,
        "ConEPC": <?php echo $finsa1_ct;?>
      }, {
        "planta": "Compras",
        "SinEPC": <?php echo $finsa3_st;?>,
        "ConEPC": <?php echo $finsa3_ct;?>
      }, {
        "planta": "Ventas",
        "SinEPC": <?php echo $oradel_st;?>,
        "ConEPC": <?php echo $oradel_ct;?>
      }, {
        "planta": "RH",
        "SinEPC": <?php echo $cls_st;?>,
        "ConEPC": <?php echo $cls_ct;?>
      }]


      // Create axes
      // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
      var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "planta",
        renderer: am5xy.AxisRendererY.new(root, {}),
        tooltip: am5.Tooltip.new(root, {})
      }));

      yAxis.data.setAll(data);

      var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
        min: 0,
        renderer: am5xy.AxisRendererX.new(root, {})
      }));


      // Add legend
      // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
      var legend = chart.children.push(am5.Legend.new(root, {
        centerX: am5.p50,
        x: am5.p50
      }));


      // Add series
      // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
      function makeSeries(name, fieldName) {
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          name: name,
          stacked: true,
          xAxis: xAxis,
          yAxis: yAxis,
          baseAxis: yAxis,
          valueXField: fieldName,
          categoryYField: "planta"
        }));

        series.columns.template.setAll({
          tooltipText: "{name}, {categoryY}: {valueX}",
          tooltipY: am5.percent(90)
        });
        series.data.setAll(data);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear();

        series.bullets.push(function () {
          return am5.Bullet.new(root, {
            sprite: am5.Label.new(root, {
              text: "{valueX}",
              fill: root.interfaceColors.get("alternativeText"),
              centerY: am5.p50,
              centerX: am5.p50,
              populateText: true
            })
          });
        });

        legend.data.push(series);
      }

      makeSeries("Sin EPC: <?php echo $total_st;?>", "SinEPC");
      makeSeries("Con EPC: <?php echo $total_ct;?>", "ConEPC");


      // Make stuff animate on load
      // https://www.amcharts.com/docs/v5/concepts/animations/
      chart.appear(1000, 100);

      //exportar
      let exporting = am5plugins_exporting.Exporting.new(root, {
        menu: am5plugins_exporting.ExportingMenu.new(root, {})
      });

      }); // end am5.ready()
  </script>

