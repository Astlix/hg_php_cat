<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>
<div id="seccion-wrap">
    <div class="box-cont-negro">

        <div class="box-cont-blanco titulo-box">
            <h1>Inventario</h1>
        </div>

        <hr class="my-2">
        <!-- REINICIAR INVENTARIO -->
        <div class="row" style="width:100%;display:flex;justify-content: space-around;">

            <div class="card col-md-3" style="height:250px;">
                <div class="card-header text-dark bg-warning" style="text-align:center;">
                    <h5>Reiniciar Inventario</h5>
                </div>
                <div class="card-body" style="display:flex;flex-flow: row wrap;">
                    <h5 class="card-title" style="width:50%;">Finsa 1</h5><button type="button" class="btn btn-primary" style="margin: 2px 0px;"><i class='bx bx-reset'></i></button>
                    <h5 class="card-title" style="width:50%;">Finsa 3</h5><button type="button" class="btn btn-primary" style="margin: 2px 0px;"><i class='bx bx-reset'></i></button>
                    <h5 class="card-title" style="width:50%;">Oradel</h5><button type="button" class="btn btn-primary" style="margin: 2px 0px;"><i class='bx bx-reset'></i></button>
                    <h5 class="card-title" style="width:50%;">CLS</h5><button type="button" class="btn btn-primary" style="margin: 2px 0px;"><i class='bx bx-reset'></i></button>
                </div>
            </div>
            <!--  INVENTARIO ACTUAL -->
            <div class="card  col-md-3" style="margin: 0px 10px;height:250px;">
                <div class="card-header text-dark bg-warning" style="text-align:center;">
                    <h5>Inventario Actual</h5>
                </div>
                <table class="table">
                    <?php
                    $rsp = ActivosModel::ver_activos();
                    $finsa1 = 0;
                    $finsa3 = 0;
                    $oradel = 0;
                    $cls = 0;
                    foreach ($rsp as $dato) {
                        $site = $dato['TagSite'];
                        $planta = substr($site, 18, -4);
                        $columna = substr($site, 20, -2);
                        $num_columna = substr($site, -2);
                        if ($planta == '01') {
                            $finsa1 = $finsa1 + 1;
                        }
                        if ($planta == '02') {
                            $finsa3 = $finsa3 + 1;
                        }
                        if ($planta == '03') {
                            $oradel = $oradel + 1;
                        }
                        if ($planta == '04') {
                            $cls = $cls + 1;
                        }
                    }
                    ?>

                    <thead>
                        <tr>
                            <th scope="col">Planta</th>
                            <th scope="col">Fisicos</th>
                            <th scope="col">Hand Held</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Finsa 1</th>
                            <td><?php echo $finsa1; ?></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">Finsa 3</th>
                            <td><?php echo $finsa3; ?></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">Oradel</th>
                            <td><?php echo $oradel; ?></td>
                            <td>0</td>
                        </tr>
                        </tr>
                        <tr>
                            <th scope="row">CLS</th>
                            <td><?php echo $cls; ?></td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- REPORTE INVENTARIO -->
            <div class="card col-md-3" style="margin: 0px 10px;height:250px;">
                <div class="card-header text-dark bg-warning" style="text-align:center;">
                    <h5>Reporte Inventario</h5>
                </div>
                <div class="card-body" style="display:flex;flex-flow: row wrap;">
                    <h5 class="card-title" style="width:50%;">Finsa 1</h5><button type="button" class="btn btn-success" style="margin: 2px 0px;"><i class='bx bxs-file'></i></button>
                    <h5 class="card-title" style="width:50%;">Finsa 3</h5><button type="button" class="btn btn-success" style="margin: 2px 0px;"><i class='bx bxs-file'></i></button>
                    <h5 class="card-title" style="width:50%;">Oradel</h5><button type="button" class="btn btn-success" style="margin: 2px 0px;"><i class='bx bxs-file'></i></button>
                    <h5 class="card-title" style="width:50%;">CLS</h5><button type="button" class="btn btn-success" style="margin: 2px 0px;"><i class='bx bxs-file'></i></button>
                </div>
            </div>
        </div>

        <!-- HTML -->
        <div id="chartdiv"></div>

    </div>
</div>
</div>


<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
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
        var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "none",
                wheelY: "none"
            })
        );

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);

        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
            text: "{realName}"
        });

        var xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
                maxDeviation: 0,
                categoryField: "category",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{realName}"
                })
            })
        );

        var yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: am5xy.AxisRendererY.new(root, {})
            })
        );

        var yAxis2 = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                syncWithAxis: yAxis,
                renderer: am5xy.AxisRendererY.new(root, {
                    opposite: true
                })
            })
        );

        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(
            am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis2,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "category",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{provider} {realName}: {valueY}"
                })
            })
        );

        series.columns.template.setAll({
            fillOpacity: 0.9,
            strokeOpacity: 0
        });
        series.columns.template.adapters.add("fill", (fill, target) => {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", (stroke, target) => {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        var lineSeries = chart.series.push(
            am5xy.LineSeries.new(root, {
                name: "Series 2",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "quantity",
                sequencedInterpolation: true,
                stroke: chart.get("colors").getIndex(13),
                fill: chart.get("colors").getIndex(13),
                categoryXField: "category",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            })
        );

        lineSeries.strokes.template.set("strokeWidth", 2);

        lineSeries.bullets.push(function() {
            return am5.Bullet.new(root, {
                locationY: 1,
                locationX: undefined,
                sprite: am5.Circle.new(root, {
                    radius: 5,
                    fill: lineSeries.get("fill")
                })
            });
        });

        // when data validated, adjust location of data item based on count
        lineSeries.events.on("datavalidated", function() {
            am5.array.each(lineSeries.dataItems, function(dataItem) {
                // if count divides by two, location is 0 (on the grid)
                if (
                    dataItem.dataContext.count / 2 ==
                    Math.round(dataItem.dataContext.count / 2)
                ) {
                    dataItem.set("locationX", 0);
                }
                // otherwise location is 0.5 (middle)
                else {
                    dataItem.set("locationX", 0.5);
                }
            });
        });

        var chartData = [];

        // Set data
        var data = {
            "Finsa 1": {
                "Fisico": <?php echo $finsa1; ?>,
                "Hand Held": 0,
                quantity: <?php echo $finsa1; ?>
            },
            "Finsa 3": {
                "Fisico": <?php echo $finsa3; ?>,
                "Hand Held": 0,
                quantity: <?php echo $finsa3; ?>
            },
            "Oradel": {
                "Fisico": <?php echo $oradel; ?>,
                "Hand Held": 0,
                quantity: <?php echo $oradel; ?>
            },
            "CLS": {
                "Fisico": <?php echo $cls; ?>,
                "Hand Held": 0,
                quantity: <?php echo $cls; ?>
            }
        };

        // process data ant prepare it for the chart
        for (var providerName in data) {
            var providerData = data[providerName];

            // add data of one provider to temp array
            var tempArray = [];
            var count = 0;
            // add items
            for (var itemName in providerData) {
                if (itemName != "quantity") {
                    count++;
                    // we generate unique category for each column (providerName + "_" + itemName) and store realName
                    tempArray.push({
                        category: providerName + "_" + itemName,
                        realName: itemName,
                        value: providerData[itemName],
                        provider: providerName
                    });
                }
            }
            // sort temp array
            tempArray.sort(function(a, b) {
                if (a.value > b.value) {
                    return 1;
                } else if (a.value < b.value) {
                    return -1;
                } else {
                    return 0;
                }
            });

            // add quantity and count to middle data item (line series uses it)
            var lineSeriesDataIndex = Math.floor(count / 2);
            tempArray[lineSeriesDataIndex].quantity = providerData.quantity;
            tempArray[lineSeriesDataIndex].count = count;
            // push to the final data
            am5.array.each(tempArray, function(item) {
                chartData.push(item);
            });

            // create range (the additional label at the bottom)

            var range = xAxis.makeDataItem({});
            xAxis.createAxisRange(range);

            range.set("category", tempArray[0].category);
            range.set("endCategory", tempArray[tempArray.length - 1].category);

            var label = range.get("label");

            label.setAll({
                text: tempArray[0].provider,
                dy: 30,
                fontWeight: "bold",
                tooltipText: tempArray[0].provider
            });

            var tick = range.get("tick");
            tick.setAll({
                visible: true,
                strokeOpacity: 1,
                length: 50,
                location: 0
            });

            var grid = range.get("grid");
            grid.setAll({
                strokeOpacity: 1
            });
        }

        // add range for the last grid
        var range = xAxis.makeDataItem({});
        xAxis.createAxisRange(range);
        range.set("category", chartData[chartData.length - 1].category);
        var tick = range.get("tick");
        tick.setAll({
            visible: true,
            strokeOpacity: 1,
            length: 50,
            location: 1
        });

        var grid = range.get("grid");
        grid.setAll({
            strokeOpacity: 1,
            location: 1
        });

        xAxis.data.setAll(chartData);
        series.data.setAll(chartData);
        lineSeries.data.setAll(chartData);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>