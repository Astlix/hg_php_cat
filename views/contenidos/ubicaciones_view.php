<div id="seccion-wrap">
    <div class="box-cont-negro">

        <div class="box-cont-blanco titulo-box">
            <h1> <i class='bx bx-radar' ></i> Ubicaciones</h1>
        </div>

        <hr class="my-2">
        <?php
        $rsp = ActivosModel::ver_activos();

        $finsa1 = 0;
        $finsa3 = 0;
        $oradel = 0;

        // ARREGLOS DE LAS UBICACIONES
        $A1 = $B1 = $C1 = $D1 = $E1 = $F1 = $G1 = $H1 = $I1 = $J1 = $K1 = $L1 = $M1 = $N1 = $O1 = $P1 = $Q1 = $R1 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //NUMERO DE UBICACION que son 9
        $A2 = $B2 = $C2 = $D2 = $E2 = $F2 = $G2 = $H2 = $I2 = $J2 = $K2 = $L2 = $M2 = $N2 = $O2 = $P2 = $Q2 = $R2 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //NUMERO DE UBICACION que son 9
        $A3 = $B3 = $C3 = $D3 = $E3 = $F3 = $G3 = $H3 = $I3 = $J3 = $K3 = $L3 = $M3 = $N3 = $O3 = $P3 = $Q3 = $R3 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //NUMERO DE UBICACION que son 9
        $A4 = $B4 = $C4 = $D4 = $E4 = $F4 = $G4 = $H4 = $I4 = $J4 = $K4 = $L4 = $M4 = $N4 = $O4 = $P4 = $Q4 = $R4 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //NUMERO DE UBICACION que son 9
        $AA1 = $BB1 = $CC1 = $DD1 = $EE1 = $FF1 = $GG1 = $HH1 = $II1 = $JJ1 = $KK1 = $LL1 = $MM1 = $NN1 = $OO1 = $PP1 = $QQ1 = $RR1 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //CONTADOR que estara suamando el total de los elementos 
        $AA2 = $BB2 = $CC2 = $DD2 = $EE2 = $FF2 = $GG2 = $HH2 = $II2 = $JJ2 = $KK2 = $LL2 = $MM2 = $NN2 = $OO2 = $PP2 = $QQ2 = $RR2 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //CONTADOR que estara suamando el total de los elementos 
        $AA3 = $BB3 = $CC3 = $DD3 = $EE3 = $FF3 = $GG3 = $HH3 = $II3 = $JJ3 = $KK3 = $LL3 = $MM3 = $NN3 = $OO3 = $PP3 = $QQ3 = $RR3 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //CONTADOR que estara suamando el total de los elementos 
        $AA4 = $BB4 = $CC4 = $DD4 = $EE4 = $FF4 = $GG4 = $HH4 = $II4 = $JJ4 = $KK4 = $LL4 = $MM4 = $NN4 = $OO4 = $PP4 = $QQ4 = $RR4 = [0,0,0, 0, 0, 0, 0, 0, 0, 0]; //CONTADOR que estara suamando el total de los elementos 
        $plantas = [0,0,0,0,0];

        if (empty($rsp)) {
            $elemento  = '<div class="box-cont-negro titulo-box m-0">';
            $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Activos</small></h4>';
            $elemento .= '</div>';
            echo $elemento;
        } else {
            $tabla  = '<table id="nombre" data-nombre="ubicaciones" style="border-radius:10px; text-align:center;" class="table  rounded table-bordered table-striped table-hover salidas-tabla dt_active">';
            $tabla .= '<thead>';
            $tabla .= '<tr class="bg-warning">';
            $tabla .= '<th scope="col">Ubicación</th>';       //ubicacion
            $tabla .= '<th scope="col">Cantidad</th>';        // cantidad
            $tabla .= '<th scope="col">Acciones</th>';          // ver mas
            $tabla .= '</tr>';
            $tabla .= '</thead>';
            $tabla .= '<tbody>';
            $i = 0;

            foreach ($rsp as $dato) {
                if (trim($dato['TagSiteFound']) == '') {
                 
                    $site = $dato['TagSite'];              
                    $identificador = 'site';
                  }else{
                    $site = $dato['TagSiteFound'];
                    $identificador = 'found';
                  }
                $planta = substr($site, 18, -4);
                $columna = substr($site, 20, -2);
                $num_columna = substr($site, -2);

             

                // echo $planta.$columna.$num_columna.'<br>';
                $i++;

                    
                    for ($i = 1; $i <= 18; $i++) {//NUMERO DE UBICACIONES
                        for ($x = 1; $x <= 9; $x++) { //NUMERO DE COLUMNA
                            // COMPROBACION DE UBICACION
                            if ($planta == '01' && $columna == $i && $num_columna == $x) {   
                                //para los Planta 01 y sus ubicaciones con numero de columna                                               
                                for ($a=1; $a <= 9 ; $a++) { 
                                        if ($x == $a && $i == 1 ) {$AA1[$a] = $AA1[$a]+1; $A1[$a] = $a;}
                                        if ($x == $a && $i == 2 ) {$BB1[$a] = $BB1[$a]+1; $B1[$a] = $a;}
                                        if ($x == $a && $i == 3 ) {$CC1[$a] = $CC1[$a]+1; $C1[$a] = $a;}
                                        if ($x == $a && $i == 4 ) {$DD1[$a] = $DD1[$a]+1; $D1[$a] = $a;}
                                        if ($x == $a && $i == 5 ) {$EE1[$a] = $EE1[$a]+1; $E1[$a] = $a;}
                                        if ($x == $a && $i == 6 ) {$FF1[$a] = $FF1[$a]+1; $F1[$a] = $a;}
                                        if ($x == $a && $i == 7 ) {$GG1[$a] = $GG1[$a]+1; $G1[$a] = $a;}
                                        if ($x == $a && $i == 8 ) {$HH1[$a] = $HH1[$a]+1; $H1[$a] = $a;}
                                        if ($x == $a && $i == 9 ) {$II1[$a] = $II1[$a]+1; $I1[$a] = $a;}
                                        if ($x == $a && $i == 10 ) {$JJ1[$a] = $JJ1[$a]+1; $J1[$a] = $a;}
                                        if ($x == $a && $i == 11 ) {$KK1[$a] = $KK1[$a]+1; $K1[$a] = $a;}
                                        if ($x == $a && $i == 12 ) {$LL1[$a] = $LL1[$a]+1; $L1[$a] = $a;}
                                        if ($x == $a && $i == 13 ) {$MM1[$a] = $MM1[$a]+1; $M1[$a] = $a;}
                                        if ($x == $a && $i == 14 ) {$NN1[$a] = $NN1[$a]+1; $N1[$a] = $a;}
                                        if ($x == $a && $i == 15 ) {$OO1[$a] = $OO1[$a]+1; $O1[$a] = $a;}
                                        if ($x == $a && $i == 16 ) {$PP1[$a] = $PP1[$a]+1; $P1[$a] = $a;}
                                        if ($x == $a && $i == 17 ) {$QQ1[$a] = $QQ1[$a]+1; $Q1[$a] = $a;}
                                        if ($x == $a && $i == 18 ) {$RR1[$a] = $RR1[$a]+1; $R1[$a] = $a;}
                                   }
                                   
                            } 
                            
                            // **********PLANTA FINMSA3*******                          
                            if ($planta == '02' && $columna == $i && $num_columna == $x) {    
                                // echo 'Planta 02 '; 
                                //para los Planta 01 y sus ubicaciones con numero de columna                                               
                                for ($a=1; $a <= 9 ; $a++) { 
                                        if ($x == $a && $i == 1) {$AA2[$a] = $AA2[$a]+1; $A2[$a] = $a;}
                                        if ($x == $a && $i == 2) {$BB2[$a] = $BB2[$a]+1; $B2[$a] = $a;}
                                        if ($x == $a && $i == 3) {$CC2[$a] = $CC2[$a]+1; $C2[$a] = $a;}
                                        if ($x == $a && $i == 4) {$DD2[$a] = $DD2[$a]+1; $D2[$a] = $a;}
                                        if ($x == $a && $i == 5) {$EE2[$a] = $EE2[$a]+1; $E2[$a] = $a;}
                                        if ($x == $a && $i == 6) {$FF2[$a] = $FF2[$a]+1; $F2[$a] = $a;}
                                        if ($x == $a && $i == 7) {$GG2[$a] = $GG2[$a]+1; $G2[$a] = $a;}
                                        if ($x == $a && $i == 8) {$HH2[$a] = $HH2[$a]+1; $H2[$a] = $a;}
                                        if ($x == $a && $i == 9) {$II2[$a] = $II2[$a]+1; $I2[$a] = $a;}
                                        if ($x == $a && $i == 10) {$JJ2[$a] = $JJ2[$a]+1; $J2[$a] = $a;}
                                        if ($x == $a && $i == 11) {$KK2[$a] = $KK2[$a]+1; $K2[$a] = $a;}
                                        if ($x == $a && $i == 12) {$LL2[$a] = $LL2[$a]+1; $L2[$a] = $a;}
                                        if ($x == $a && $i == 13) {$MM2[$a] = $MM2[$a]+1; $M2[$a] = $a;}
                                        if ($x == $a && $i == 14) {$NN2[$a] = $NN2[$a]+1; $N2[$a] = $a;}
                                        if ($x == $a && $i == 15) {$OO2[$a] = $OO2[$a]+1; $O2[$a] = $a;}
                                        if ($x == $a && $i == 16) {$PP2[$a] = $PP2[$a]+1; $P2[$a] = $a;}
                                        if ($x == $a && $i == 17) {$QQ2[$a] = $QQ2[$a]+1; $Q2[$a] = $a;}
                                        if ($x == $a && $i == 18) {$RR2[$a] = $RR2[$a]+1; $R2[$a] = $a;}
                                   }
                                   
                            }                           
                            // **********PLANTA ORADEL*******                          
                            if ($planta == '03' && $columna == $i && $num_columna == $x) {    
                                //para los Planta 01 y sus ubicaciones con numero de columna                                               
                                for ($a=1; $a <= 9 ; $a++) { 
                                        if ($x == $a && $i == 1) {$AA3[$a] = $AA3[$a]+1; $A3[$a] = $a;}
                                        if ($x == $a && $i == 2) {$BB3[$a] = $BB3[$a]+1; $B3[$a] = $a;}
                                        if ($x == $a && $i == 3) {$CC3[$a] = $CC3[$a]+1; $C3[$a] = $a;}
                                        if ($x == $a && $i == 4) {$DD3[$a] = $DD3[$a]+1; $D3[$a] = $a;}
                                        if ($x == $a && $i == 5) {$EE3[$a] = $EE3[$a]+1; $E3[$a] = $a;}
                                        if ($x == $a && $i == 6) {$FF3[$a] = $FF3[$a]+1; $F3[$a] = $a;}
                                        if ($x == $a && $i == 7) {$GG3[$a] = $GG3[$a]+1; $G3[$a] = $a;}
                                        if ($x == $a && $i == 8) {$HH3[$a] = $HH3[$a]+1; $H3[$a] = $a;}
                                        if ($x == $a && $i == 9) {$II3[$a] = $II3[$a]+1; $I3[$a] = $a;}
                                        if ($x == $a && $i == 10) {$JJ3[$a] = $JJ3[$a]+1; $J3[$a] = $a;}
                                        if ($x == $a && $i == 11) {$KK3[$a] = $KK3[$a]+1; $K3[$a] = $a;}
                                        if ($x == $a && $i == 12) {$LL3[$a] = $LL3[$a]+1; $L3[$a] = $a;}
                                        if ($x == $a && $i == 13) {$MM3[$a] = $MM3[$a]+1; $M3[$a] = $a;}
                                        if ($x == $a && $i == 14) {$NN3[$a] = $NN3[$a]+1; $N3[$a] = $a;}
                                        if ($x == $a && $i == 15) {$OO3[$a] = $OO3[$a]+1; $O3[$a] = $a;}
                                        if ($x == $a && $i == 16) {$PP3[$a] = $PP3[$a]+1; $P3[$a] = $a;}
                                        if ($x == $a && $i == 17) {$QQ3[$a] = $QQ3[$a]+1; $Q3[$a] = $a;}
                                        if ($x == $a && $i == 18) {$RR3[$a] = $RR3[$a]+1; $R3[$a] = $a;}
                                   }
                                   
                            }                           
                            // **********PLANTA CLS*******                          
                            if ($planta == '04' && $columna == $i && $num_columna == $x) {    
                                //para los Planta 01 y sus ubicaciones con numero de columna                                               
                                for ($a=1; $a <= 9 ; $a++) { 
                                        if ($x == $a && $i == 1) {$AA4[$a] = $AA4[$a]+1; $A4[$a] = $a;}
                                        if ($x == $a && $i == 2) {$BB4[$a] = $BB4[$a]+1; $B4[$a] = $a;}
                                        if ($x == $a && $i == 3) {$CC4[$a] = $CC4[$a]+1; $C4[$a] = $a;}
                                        if ($x == $a && $i == 4) {$DD4[$a] = $DD4[$a]+1; $D4[$a] = $a;}
                                        if ($x == $a && $i == 5) {$EE4[$a] = $EE4[$a]+1; $E4[$a] = $a;}
                                        if ($x == $a && $i == 6) {$FF4[$a] = $FF4[$a]+1; $F4[$a] = $a;}
                                        if ($x == $a && $i == 7) {$GG4[$a] = $GG4[$a]+1; $G4[$a] = $a;}
                                        if ($x == $a && $i == 8) {$HH4[$a] = $HH4[$a]+1; $H4[$a] = $a;}
                                        if ($x == $a && $i == 9) {$II4[$a] = $II4[$a]+1; $I4[$a] = $a;}
                                        if ($x == $a && $i == 10) {$JJ4[$a] = $JJ4[$a]+1; $J4[$a] = $a;}
                                        if ($x == $a && $i == 11) {$KK4[$a] = $KK4[$a]+1; $K4[$a] = $a;}
                                        if ($x == $a && $i == 12) {$LL4[$a] = $LL4[$a]+1; $L4[$a] = $a;}
                                        if ($x == $a && $i == 13) {$MM4[$a] = $MM4[$a]+1; $M4[$a] = $a;}
                                        if ($x == $a && $i == 14) {$NN4[$a] = $NN4[$a]+1; $N4[$a] = $a;}
                                        if ($x == $a && $i == 15) {$OO4[$a] = $OO4[$a]+1; $O4[$a] = $a;}
                                        if ($x == $a && $i == 16) {$PP4[$a] = $PP4[$a]+1; $P4[$a] = $a;}
                                        if ($x == $a && $i == 17) {$QQ4[$a] = $QQ4[$a]+1; $Q4[$a] = $a;}
                                        if ($x == $a && $i == 18) {$RR4[$a] = $RR4[$a]+1; $R4[$a] = $a;}
                                   }
                                   
                            }                           
                        }
                    }            
            }

// *********IMPRESION DE FINMSA1*******
            for ($z = 1; $z <= 9 ; $z++) { 
                if ($A1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1A' . $A1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $AA1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="01" data-numcolumna="0'.$z.'" data-identificador="'.$identificador.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($B1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1B' . $B1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $BB1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="02" data-numcolumna="0'.$z.'" data-identificador="'.$identificador.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($C1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1C' . $C1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $CC1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="03" data-numcolumna="0'.$z.'" data-identificador="'.$identificador.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($D1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1D' . $D1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $DD1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="04" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($E1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1E' . $E1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $EE1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="05" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($F1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1F' . $F1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $FF1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="06" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($G1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1G' . $G1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $GG1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="07" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($H1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1H' . $H1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $HH1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="08" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($I1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1I' . $I1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $II1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="09" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($J1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1J' . $J1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $JJ1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="10" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($K1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1K' . $K1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $KK1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="11" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($L1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1L' . $L1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $LL1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="12" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($M1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1M' . $M1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $MM1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="13" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($N1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1N' . $N1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $NN1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="14" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($O1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1O' . $O1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $OO1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="15" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($P1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1P' . $P1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $PP1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="16" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($Q1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1Q' . $Q1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $QQ1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="17" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($R1[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F1R' . $R1[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $RR1[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="01" data-ubicacion="18" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
            }
// *********IMPRESION DE FINMSA3*******
            for ($z = 1; $z <= 9 ; $z++) { 
                if ($A2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3A' . $A2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $AA2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="01" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($B2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3B' . $B2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $BB2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="02" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($C2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3C' . $C2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $CC2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="03" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($D2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3D' . $D2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $DD2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="04" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($E2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3E' . $E2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $EE2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="05" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($F2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3F' . $F2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $FF2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="06" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($G2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3G' . $G2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $GG2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="07" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($H2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3H' . $H2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $HH2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="08" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($I2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3I' . $I2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $II2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="09" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($J2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3J' . $J2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $JJ2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="10" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($K2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3K' . $K2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $KK2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="11" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($L2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3L' . $L2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $LL2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="12" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($M2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3M' . $M2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $MM2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="13" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($N2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3N' . $N2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $NN2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="14" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($O2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3O' . $O2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $OO2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="15" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($P2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3P' . $P2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $PP2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="16" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($Q2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3Q' . $Q2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $QQ2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="17" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($R2[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">F3R' . $R2[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $RR2[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="02" data-ubicacion="18" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
               
            }
// *********IMPRESION DE ORADEL*******
            for ($z = 1; $z <= 9 ; $z++) { 
                if ($A3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1A' . $A3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $AA3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="01" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($B3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1B' . $B3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $BB3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="02" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($C3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1C' . $C3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $CC3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="03" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($D3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1D' . $D3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $DD3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="04" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($E3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1E' . $E3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $EE3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="05" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($F3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1F' . $F3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $FF3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="06" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($G3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1G' . $G3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $GG3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="07" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($H3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1H' . $H3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $HH3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="08" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($I3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1I' . $I3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $II3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="09" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($J3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1J' . $J3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $JJ3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="10" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($K3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1K' . $K3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $KK3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="11" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($L3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1L' . $L3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $LL3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="12" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($M3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1M' . $M3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $MM3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="13" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($N3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1N' . $N3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $NN3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="14" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($O3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1O' . $O3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $OO3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="15" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($P3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1P' . $P3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $PP3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="16" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($Q3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1Q' . $Q3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $QQ3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="17" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($R3[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">O1R' . $R3[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $RR3[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="03" data-ubicacion="18" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
               
            }
// *********IMPRESION DE CLS*******
            for ($z = 1; $z <= 9 ; $z++) { 
                if ($A4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1A' . $A4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $AA4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="01" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($B4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1B' . $B4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $BB4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="02" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($C4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1C' . $C4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $CC4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="03" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($D4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1D' . $D4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $DD4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="04" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($E4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1E' . $E4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $EE4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="05" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($F4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1F' . $F4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $FF4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="06" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($G4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1G' . $G4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $GG4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="07" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($H4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1H' . $H4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $HH4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="08" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($I4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1I' . $I4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $II4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="09" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($J4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1J' . $J4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $JJ4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="10" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($K4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1K' . $K4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $KK4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="11" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($L4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1L' . $L4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $LL4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="12" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($M4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1M' . $M4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $MM4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="13" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($N4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1N' . $N4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $NN4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="14" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($O4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1O' . $O4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $OO4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="15" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($P4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1P' . $P4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $PP4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="16" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($Q4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1Q' . $Q4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $QQ4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="17" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
                if ($R4[$z] == $z) {
                    $tabla .= '<tr class="elemento">';
                    $tabla .= '<td scope="col" class="salida">C1R' . $R4[$z] . '</td>';
                    $tabla .= '<td scope="col" class="lote">'. $RR4[$z] .'</td>';
                    $tabla .= '<td style="width:20%;display:flex;justify-content:center;width:auto;"><a type="button" id="btn_detalles_activo" class="btn btn-success" data-planta="04" data-ubicacion="18" data-numcolumna="0'.$z.'" style="margin:0px; display: flex; height:30px align-items: center; justify-content: center; max-width: 150px;">Ver más</a></td>';
                    $tabla .= '</tr>';
                }
               
            }
            

            //falta agregar cls
            $tabla .= '</tbody>';
            $tabla .= '</table>';
            echo $tabla;
        }
        include 'modal.php';
        ?>
    </div>
</div>