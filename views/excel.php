<?php
$planta = $_POST['tabla'];
include("../models/activosmodel.php"); //para consultas
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$planta.'.xls');
$finsa1 = 1;
$finsa3 = 2;
$oradel = 3;
$cls = 4;
$f1_tab = ActivosModel::ver_activo_inv($finsa1);
$f3_tab = ActivosModel::ver_activo_inv($finsa3);
$oradel_tab = ActivosModel::ver_activo_inv($oradel);
$cls_tab = ActivosModel::ver_activo_inv($cls);

switch ($planta) {
    case 'finsa1':
            echo '
            <table class="default">
            <caption>Activos faltantes</caption>
            <tr>
                <th>Asset</th>
                <th>Description</th>
                <th>Lugar</th>
            </tr>
            ';
            foreach ($f1_tab as $dato){
            $asset = $dato['Asset'];
            $desc = $dato['Description'];
            $lugar = $dato['Service002'];
            echo'
            <tr>
                <td>'.$asset.'</td>
                <td>'.$desc.'</td>
                <td>Finsa 1</td>
            </tr>';
            }
            echo '</table>';
        break;

    case 'finsa3':
        echo '
        <table class="default">
        <caption>Activos faltantes</caption>
        <tr>
            <th>Asset</th>
            <th>Description</th>
            <th>Lugar</th>
        </tr>
        ';
        foreach ($f3_tab as $dato){
        $asset = $dato['Asset'];
        $desc = $dato['Description'];
        $lugar = $dato['Service002'];
        echo'
        <tr>
            <td>'.$asset.'</td>
            <td>'.$desc.'</td>
            <td>Finsa 3</td>
        </tr>';
        }
        echo '</table>';
        break;

    case 'oradel':
        echo '
        <table class="default">
        <caption>Activos faltantes</caption>
        <tr>
            <th>Asset</th>
            <th>Description</th>
            <th>Lugar</th>
        </tr>
        ';
        foreach ($oradel_tab as $dato){
        $asset = $dato['Asset'];
        $desc = $dato['Description'];
        $lugar = $dato['Service002'];
        echo'
        <tr>
            <td>'.$asset.'</td>
            <td>'.$desc.'</td>
            <td>Oradel</td>
        </tr>';
        }
        echo '</table>';
        break;
        
    case 'cls':
        echo '
        <table class="default">
        <caption>Activos faltantes</caption>
        <tr>
            <th>Asset</th>
            <th>Description</th>
            <th>Lugar</th>
        </tr>
        ';
        foreach ($cls_tab as $dato){
        $asset = $dato['Asset'];
        $desc = $dato['Description'];
        $lugar = $dato['Service002'];
        echo'
        <tr>
            <td>'.$asset.'</td>
            <td>'.$desc.'</td>
            <td>Cls</td>
        </tr>';
        }
        echo '</table>';
        break;
    
    default:
        # code...
        break;
}


?>

