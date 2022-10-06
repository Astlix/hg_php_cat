<?php
date_default_timezone_set("America/Mexico_City");

$planta = trim($_POST['exampleRadios']);
$fecha_start = $_POST['startDateSelected'];
$fecha_end = $_POST['endDateSelected'];
include("../models/activosmodel.php"); //para consultas


if ($fecha_start > $fecha_end) {
    $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto"  => "La fecha inicial no puede ser mayor que la fecha final.",
        "Tipo"   => "error"
    ];
    echo json_encode($alerta);
    exit();
}else{

    header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
    header('Content-Disposition: attachment; filename='.$planta.'.xls');
    if ($planta=='finsa1') { $planta = 1;}
    if ($planta=='finsa3') { $planta = 2;}
    if ($planta=='oradel') { $planta = 3;}
    if ($planta=='cls') { $planta = 4;}
    
    $datos_reporte = [
        "fechasstart" => $fecha_start,
        "fechaend" => $fecha_end,
        "planta" => $planta
      ];
    
    $f1_tab = ActivosModel::ver_activo_inv($datos_reporte);
    $f3_tab = ActivosModel::ver_activo_inv($datos_reporte);
    $oradel_tab = ActivosModel::ver_activo_inv($datos_reporte);
    $cls_tab = ActivosModel::ver_activo_inv($datos_reporte);
    
    switch ($planta) {
        case '1':
                echo '
                <table class="default">
                <caption>Activos faltantes</caption>
                <tr>
                    <th>Asset</th>
                    <th>Description</th>
                    <th>Lugar</th>
                    <th>Fecha de Inventario</th>
    
                </tr>
                ';
                foreach ($f1_tab as $dato){
                $asset = $dato['Asset'];
                $desc = $dato['Description'];
                $lugar = $dato['Service002'];
                $fecha = $dato['DateInventory'];
    
                echo'
                <tr>
                    <td>'.$asset.'</td>
                    <td>'.$desc.'</td>
                    <td>'.$fecha.'</td>
                    <td>Finsa 1</td>
                </tr>';
                }
                echo '</table>';
            break;
    
        case '2':
            echo '
            <table class="default">
            <caption>Activos faltantes</caption>
            <tr>
                <th>Asset</th>
                <th>Description</th>
                <th>Lugar</th>
                <th>Fecha de Inventario</th>
    
            </tr>
            ';
            foreach ($f3_tab as $dato){
            $asset = $dato['Asset'];
            $desc = $dato['Description'];
            $lugar = $dato['Service002'];
            $fecha = $dato['DateInventory'];
    
            echo'
            <tr>
                <td>'.$asset.'</td>
                <td>'.$desc.'</td>
                <td>'.$fecha.'</td>
                <td>Finsa 3</td>
            </tr>';
            }
            echo '</table>';
            break;
    
        case '3':
            echo '
            <table class="default">
            <caption>Activos faltantes</caption>
            <tr>
                <th>Asset</th>
                <th>Description</th>
                <th>Lugar</th>
                <th>Fecha de Inventario</th>
    
            </tr>
            ';
            foreach ($oradel_tab as $dato){
            $asset = $dato['Asset'];
            $desc = $dato['Description'];
            $lugar = $dato['Service002'];
            $fecha = $dato['DateInventory'];
    
            echo'
            <tr>
                <td>'.$asset.'</td>
                <td>'.$desc.'</td>
                <td>'.$fecha.'</td>
                <td>Oradel</td>
            </tr>';
            }
            echo '</table>';
            break;
            
        case '4':
            echo '
            <table class="default">
            <caption>Activos faltantes</caption>
            <tr>
                <th>Asset</th>
                <th>Description</th>
                <th>Lugar</th>
                <th>Fecha de Inventario</th>
            </tr>
            ';
            foreach ($cls_tab as $dato){
            $asset = $dato['Asset'];
            $desc = $dato['Description'];
            $lugar = $dato['Service002'];
            $fecha = $dato['DateInventory'];
    
            echo'
            <tr>
                <td>'.$asset.'</td>
                <td>'.$desc.'</td>
                <td>'.$fecha.'</td>
                <td>Cls</td>
            </tr>';
            }
            echo '</table>';
            break;
        
        default:
           echo 'LA CONSULTA NO PRESENTA DATOS DE LA BASE DE DATOS, VERIFIQUE EL RANGO DE FECHAS';
            break;
    }

}




?>

