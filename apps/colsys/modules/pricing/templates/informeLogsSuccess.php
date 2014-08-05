<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<?
$grid = $sf_data->getRaw("grid");
include_component("pricing", "filtrosInformeLogs");
$tipoInforme = $typetar==1?"TARIFAS ACTUALES":"TARIFAS HISTORICAS";
$periodo = $fechaInicial?"Periodo: $fechaInicial a $fechaFinal":"FASFDASD";
//$colspan = $typelog
?>

<? if ($opcion) { ?>
    <table border="1" class="tableList" align="center" style="font-size: 10; width: 95%" >
        <th style="text-align: center" colspan="19">ESTADISTICAS DE TARIFAS <br /> TIPO: <?=$tipoInforme?><br /><b><?=$periodo?></b><br />Generado el <?=date('Y-m-d H:i:s')?></th>
        <tr>
            <th scope="col" style=" text-align: center"><b>Tipo</b></th>
            <th scope="col" style=" text-align: center"><b>Transporte</b></th>
            <th scope="col" style=" text-align: center"><b>Modalidad</b></th>
            <?
            switch ($typelog) {
                case 1:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Línea</b></th>
                    <th scope="col" style=" text-align: center"><b>Origen</b></th>
                    <th scope="col" style=" text-align: center"><b>Destino</b></th>
                    <th scope="col" style=" text-align: center"><b>Concepto</b></th>
                    <th scope="col" style=" text-align: center"><b>Fch. Creado</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr. Neto</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr. Sugerido</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación</b></th>
                    <?
                    $numcolumnas = 15;
                    break;
                case 2:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Tráfico</b></th>
                    <th scope="col" style=" text-align: center"><b>Ciudad</b></th>
                    <th scope="col" style=" text-align: center; width: 100px;"><b>Recargo</b></th>
                    <th scope="col" style=" text-align: center; width: 150px;"><b>Fch. Creado</b></th>
                    <th scope="col" style=" text-align: center; width: 20px;"><b>Vlr/Rec</b></th>
                    <th scope="col" style=" text-align: center; width: 70px;"><b>Aplicación</b></th>
                    <th scope="col" style=" text-align: center; width: 20px;"><b>Vlr/Mín</b></th>
                    <th scope="col" style=" text-align: center; width: 70px;"><b>Aplicación Min</b></th>
                    <th scope="col" style=" text-align: center; width: 150px;"><b>Observaciones</b></th>

                    <?
                    $numcolumnas = 16;
                    break;
                case 3:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Línea</b></th>
                    <th scope="col" style=" text-align: center"><b>Origen</b></th>
                    <th scope="col" style=" text-align: center"><b>Destino</b></th>
                    <th scope="col" style=" text-align: center"><b>Concepto</b></th>
                    <th scope="col" style=" text-align: center; width: 150px;"><b>Recargo</b></th>
                    <th scope="col" style=" text-align: center;"><b>Fch. Creado</b></th>
                    <th scope="col" style=" text-align: center; width: 20px;"><b>Vlr/Rec</b></th>
                    <th scope="col" style=" text-align: center; width: 70px;"><b>Aplicación</b></th>
                    <th scope="col" style=" text-align: center; width: 20px;"><b>Vlr/Mín</b></th>
                    <th scope="col" style=" text-align: center; width: 70px;"><b>Aplicación Min</b></th>
                    <th scope="col" style=" text-align: center; width: 150px;"><b>Observaciones</b></th>
                    <?
                    $numcolumnas = 18;
                    break;
                case 4:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Línea</b></th>
                    <th scope="col" style=" text-align: center"><b>Tráfico</b></th>
                    <th scope="col" style=" text-align: center"><b>Concepto</b></th>
                    <th scope="col" style=" text-align: center"><b>Recargo</b></th>
                    <th scope="col" style=" text-align: center; width: 150px;"><b>Fch. Creado</b></th>
                    <th scope="col" style=" text-align: center; width: 20px;"><b>Vlr/Rec</b></th>
                    <th scope="col" style=" text-align: center; width: 70px;"><b>Aplicación</b></th>
                    <th scope="col" style=" text-align: center; width: 20px;"><b>Vlr/Mín</b></th>
                    <th scope="col" style=" text-align: center; width: 70px;"><b>Aplicación Min</b></th>
                    <th scope="col" style=" text-align: center; width: 150px;"><b>Observaciones</b></th>
                    <?
                    $numcolumnas = 17;
                    break;
                case 5:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Línea</b></th>
                    <th scope="col" style=" text-align: center"><b>Origen</b></th>
                    <th scope="col" style=" text-align: center"><b>Destino</b></th>
                    <th scope="col" style=" text-align: center; vertical-align: top; width: 150px;"><b>Fch. Creado</b></th>
                    <th scope="col" style=" text-align: center"><b>Frecuencia</b></th>
                    <th scope="col" style=" text-align: center"><b>T. Transito</b></th>
                    <th scope="col" style=" text-align: center; vertical-align: top; width: 250px;"><b>Observ. 1</b></th>
                    <th scope="col" style=" text-align: center"><b>Activo</b></th>
                    <th scope="col" style=" text-align: center"><b>N Contrato</b></th>
                    <th scope="col" style=" text-align: center; vertical-align: top; width: 250px;"><b>Observ. 2</b></th>
                    <?
                    $numcolumnas = 13;
                    break;
            }
            if ($typelog != 5) {
                ?>
                <th scope="col" style=" text-align: center"><b>Moneda</b></th>
                <th scope="col" style=" text-align: center"><b>Fch. Inicio</b></th>
                <th scope="col" style=" text-align: center"><b>Fch. V/mto</b></th>
            <? } ?>
                <th scope="col" style=" text-align: center"><b>Usu. Creado</b></th>
            <? if ($typelog != 5) { ?>
                <th scope="col" style=" text-align: center"><b>Fch. Eliminado</b></th>
            <? } ?>
        </tr><br /><br />
        
        <?
        
        /*foreach ($grid as $impoexpo=>$gridTransporte){
            echo "<tr><td>" . $impoexpo. "</td>";
            for($i=0;$i<($numcolumnas);$i++){
                echo "<td></td>";
            }
            echo "</tr>";
            foreach($gridTransporte as $transporte=>$gridModalidad){
                echo "<tr><td></td><td>" . $transporte. "</td>";
                for($i=0;$i<($numcolumnas-1);$i++){
                    echo "<td></td>";
                }
                echo "</tr>";
                foreach($gridModalidad as $modalidad=>$gridLinea){
                    echo "<tr><td></td><td></td><td>" . $modalidad. "</td>";
                    for($i=0;$i<($numcolumnas-2);$i++){
                        echo "<td></td>";
                    }
                    echo "</tr>";
                    foreach($gridLinea as $linea=>$gridOrigen){
                        echo "<tr><td></td><td></td><td></td><td>" . $linea. "</td>";
                        for($i=0;$i<($numcolumnas-3);$i++){
                            echo "<td></td>";
                        }
                        echo "</tr>";
                        foreach($gridOrigen as $origen=>$gridDestino){
                            echo "<tr><td></td><td></td><td></td><td></td><td>" . $origen. "</td>";
                            for($i=0;$i<($numcolumnas-4);$i++){
                                echo "<td></td>";
                            }
                            echo "</tr>";
                            foreach($gridDestino as $destino=>$gridConcepto){
                                echo "<tr><td></td><td></td><td></td><td></td><td></td><td>" . $destino. "</td>";
                                for($i=0;$i<($numcolumnas-5);$i++){
                                    echo "<td></td>";
                                }
                                echo "</tr>";
                                if($typelog==1 || $typelog==4){
                                    foreach($gridConcepto as $fchcreado=>$gridFecha){
                                        echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td style='width: 150px;'>" . $fchcreado. "</td>";
                                        for($i=0;$i<($numcolumnas-6);$i++){
                                            echo "<td></td>";
                                        }
                                        echo "</tr>";
                                        foreach($gridFecha as $concepto=>$gridDatos){
                                            echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>" . $concepto. "</td>";
                                            foreach($gridDatos as $key=>$val){
                                                echo "<td>" . $val. "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                }
                                if($typelog==3){
                                    foreach($gridConcepto as $fchcreado=>$gridFecha){
                                        echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td style='width: 150px;'>" . $fchcreado. "</td>";
                                        for($i=0;$i<($numcolumnas-6);$i++){
                                            echo "<td></td>";
                                        }
                                        echo "</tr>";
                                        foreach($gridFecha as $concepto=>$gridRecargo){
                                            echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='width: 150px;'>" . $concepto. "</td>";
                                            for($i=0;$i<($numcolumnas-7);$i++){
                                                echo "<td></td>";
                                            }
                                            echo "</tr>";
                                            foreach($gridRecargo as $recargo=>$gridDatos){
                                                echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>" . $recargo. "</td>";
                                                foreach($gridDatos as $key=>$val){
                                                    echo "<td>" . $val. "</td>";
                                                }
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                }
                                if($typelog==2 || $typelog==5){
                                    foreach($gridConcepto as $concepto=>$gridDatos){
                                        echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>" . $concepto. "</td>";
                                        foreach($gridDatos as $key=>$val){
                                            echo "<td>" . $val. "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                    }
                }
            }            
        }*/
        
        //echo "<pre>";print_r($grid);echo "</pre>";
        
        foreach ($grid as $key1 => $gridData1 ){
            $nfilas1[$key1]=count($gridData1);            
            foreach ($gridData1 as $key2 => $gridData2){
                $nfilas2[$key1][$key2] = count($gridData2);                
                foreach ($gridData2 as $key3 => $gridData3){
                    $nfilas3[$key1][$key2][$key3] = count($gridData3);                
                    foreach ($gridData3 as $key4 => $gridData4) {
                        $nfilas4[$key1][$key2][$key3][$key4] = count($gridData4);
                        foreach ($gridData4 as $key5 => $gridData5) {
                            $nfilas5[$key1][$key2][$key3][$key4][$key5] = count($gridData5);
                            foreach ($gridData5 as $key6 =>$gridData6){
                                $nfilas6[$key1][$key2][$key3][$key4][$key5][$key6] = count($gridData6);
                                if($typelog==2 || $typelog==5){
                                    $ntotal1[$key1]+=$nfilas6[$key1][$key2][$key3][$key4][$key5][$key6];
                                    $ntotal2[$key1][$key2]+=$nfilas6[$key1][$key2][$key3][$key4][$key5][$key6];
                                    $ntotal3[$key1][$key2][$key3]+=$nfilas6[$key1][$key2][$key3][$key4][$key5][$key6];
                                    $ntotal4[$key1][$key2][$key3][$key4]+=$nfilas6[$key1][$key2][$key3][$key4][$key5][$key6];
                                    $ntotal5[$key1][$key2][$key3][$key4][$key5]+=$nfilas6[$key1][$key2][$key3][$key4][$key5][$key6];
                                    $ntotal6[$key1][$key2][$key3][$key4][$key5][$key6]+=$nfilas6[$key1][$key2][$key3][$key4][$key5][$key6];
                                }
                                foreach ($gridData6 as $key7 => $gridData7) {
                                    if($typelog==1 || $typelog==4){
                                        $nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7] = count($gridData7);
                                        $ntotal1[$key1]+=$nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7];
                                        $ntotal2[$key1][$key2]+=$nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7];
                                        $ntotal3[$key1][$key2][$key3]+=$nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7];
                                        $ntotal4[$key1][$key2][$key3][$key4]+=$nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7];
                                        $ntotal5[$key1][$key2][$key3][$key4][$key5]+=$nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7];
                                        $ntotal6[$key1][$key2][$key3][$key4][$key5][$key6]+=$nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7];
                                        $ntotal7[$key1][$key2][$key3][$key4][$key5][$key6][$key7]+=$nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7];
                                    }
                                    if($typelog==3){
                                        $nfilas7[$key1][$key2][$key3][$key4][$key5][$key6][$key7] = count($gridData7);
                                        foreach ($gridData7 as $key8 => $gridData8) {
                                            $nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8] = count($gridData8);
                                            $ntotal1[$key1]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];
                                            $ntotal2[$key1][$key2]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];
                                            $ntotal3[$key1][$key2][$key3]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];
                                            $ntotal4[$key1][$key2][$key3][$key4]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];
                                            $ntotal5[$key1][$key2][$key3][$key4][$key5]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];
                                            $ntotal6[$key1][$key2][$key3][$key4][$key5][$key6]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];
                                            $ntotal7[$key1][$key2][$key3][$key4][$key5][$key6][$key7]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];                                        
                                            $ntotal8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8]+=$nfilas8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8];                                        
                                        }
                                        
                                    }                                                                    
                                }
                            }
                        }
                    }
                }
            }
        }
        //echo "<pre>";print_r($grid); echo "</pre>";
                
        foreach ($grid as $key1 => $gridData1 ){
            echo "<td rowspan=".$ntotal1[$key1]." style='vertical-align: text-top;'>$key1</td>";
            ksort($gridData1);
            foreach ($gridData1 as $key2 => $gridData2){
                echo "<td rowspan=".$ntotal2[$key1][$key2]." style='vertical-align: text-top;'>$key2</td>";
                ksort($gridData2);
                foreach ($gridData2 as $key3 => $gridData3){
                    echo "<td rowspan=".$ntotal3[$key1][$key2][$key3]." style='vertical-align: text-top;'>$key3</td>";
                    ksort($gridData3);
                    foreach ($gridData3 as $key4 => $gridData4) {
                        echo "<td rowspan=".$ntotal4[$key1][$key2][$key3][$key4]." style='vertical-align: text-top;'>$key4</td>";
                        ksort($gridData4);
                        foreach ($gridData4 as $key5 => $gridData5) {
                            echo "<td rowspan=".$ntotal5[$key1][$key2][$key3][$key4][$key5]." style='vertical-align: text-top;'>$key5</td>";
                            ksort($gridData5);
                            foreach ($gridData5 as $key6 =>$gridData6){
                                echo "<td rowspan=".$ntotal6[$key1][$key2][$key3][$key4][$key5][$key6]." style='vertical-align: text-top;'>$key6</td>";
                                if($typelog==1 || $typelog==4){
                                    ksort($gridData6);
                                    foreach ($gridData6 as $key7 => $gridData7) {
                                        echo "<td rowspan=".$ntotal7[$key1][$key2][$key3][$key4][$key5][$key6][$key7]." style='vertical-align: text-top;'>$key7</td>";
                                        ksort($gridData7);
                                        foreach ($gridData7 as $key8 => $gridData8) {
                                            echo "<td style='vertical-align: text-top;'>$key8</td>";
                                            foreach ($gridData8 as $key9 => $data) {
                                                if(!data)
                                                    echo "<td></td>";
                                                else
                                                    echo "<td style='vertical-align: text-top;'>$data</td>";
                                            }
                                            echo "</tr>";
                                        }                                    
                                    }
                                }
                                if($typelog==3){
                                    ksort($gridData6);
                                    foreach ($gridData6 as $key7 => $gridData7) {
                                        echo "<td rowspan=".$ntotal7[$key1][$key2][$key3][$key4][$key5][$key6][$key7]." style='vertical-align: text-top;'>$key7</td>";
                                        ksort($gridData7);
                                        foreach ($gridData7 as $key8 => $gridData8) {
                                            echo "<td rowspan=".$ntotal8[$key1][$key2][$key3][$key4][$key5][$key6][$key7][$key8]." style='vertical-align: text-top;'>$key8</td>";
                                            ksort($gridData8);
                                            foreach ($gridData8 as $key9 => $gridData9) {
                                                echo "<td style='vertical-align: text-top;'>$key9</td>";
                                                foreach ($gridData9 as $key10 => $data) {
                                                    if(!data)
                                                        echo "<td></td>";   
                                                    else
                                                        echo "<td style='vertical-align: text-top;'>$data</td>";
                                                }
                                                echo "</tr>";
                                            }                                            
                                        }                                    
                                    }                                    
                                }
                                if($typelog==2 || $typelog==5){
                                    ksort($gridData6);
                                    foreach ($gridData6 as $key7 => $gridData7) {
                                        echo "<td style='vertical-align: text-top;'>$key7</td>";
                                        foreach ($gridData7 as $key8 => $data) {
                                            if(!data)
                                                echo "<td></td>";   
                                            else
                                                echo "<td style='vertical-align: text-top;'>$data</td>";
                                        }
                                        echo "</tr>";
                                    }                                   
                                }
                            }                            
                        }
                    }
                }
            }
        }        
        ?>
    </table>
<? } ?>
<script>
function imprimir(){
            $(".esconder").hide();
            $(".mostrar").show();
            Ext.getCmp("formPanel").hidden=true;
            window.print();
        }
</script>