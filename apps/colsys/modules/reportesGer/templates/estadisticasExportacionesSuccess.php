<style>
    input#bigbutton {
        width:500px;
        background: #638CC2; /*the colour of the button*/
        padding: 8px 14px 10px; /*apply some padding inside the button*/
        border:1px solid #638CC2; /*required or the default border for the browser will appear*/
        cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
        /*style the text*/
        font-size:1.5em;
        font-family:Oswald, sans-serif; /*Oswald is available from http://www.google.com/webfonts/specimen/Oswald*/
        letter-spacing:.1em;
        text-shadow: 0 -1px 0px rgba(0, 0, 0, 0.3); /*give the text a shadow - doesn't appear in Opera 12.02 or earlier*/
        color: #fff;
        font-weight:  bold;
        /*use box-shadow to give the button some depth - see cssdemos.tupence.co.uk/box-shadow.htm#demo7 for more info on this technique*/
        -webkit-box-shadow: inset 0px 1px 0px #638CC2, 0px 5px 0px 0px #454C76, 0px 10px 5px #999;
        -moz-box-shadow: inset 0px 1px 0px #638CC2, 0px 5px 0px 0px #454C76, 0px 10px 5px #999;
        box-shadow: inset 0px 1px 0px #638CC2, 0px 5px 0px 0px #454C76, 0px 10px 5px #999;
        /*give the corners a small curve*/
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        }
        /***SET THE BUTTON'S HOVER AND FOCUS STATES***/
        input#bigbutton:hover, input#bigbutton:focus {
        color:#dfe7ea;
        /*reduce the size of the shadow to give a pushed effect*/
        -webkit-box-shadow: inset 0px 1px 0px #638CC2, 0px 2px 0px 0px #454C76, 0px 2px 5px #999;
        -moz-box-shadow: inset 0px 1px 0px #638CC2, 0px 2px 0px 0px #454C76, 0px 2px 5px #999;
        box-shadow: inset 0px 1px 0px #638CC2, 0px 2px 0px 0px #454C76, 0px 2px 5px #999;
}
    
    
</style>

<?php
include_component("reportesGer", "formMenuEstadisticasExportaciones");
$grid = $sf_data->getRaw("grid");
$tipo = $sf_data->getRaw("tipo");
$origen = $sf_data->getRaw("origen");
$cliente = $sf_data->getRaw("cliente");
$resumen = $sf_data->getRaw("resumen");
$traficos = $sf_data->getRaw("traficos");
$sea = $sf_data->getRaw("sea");
$air = $sf_data->getRaw("air");
$vendedores = $sf_data->getRaw("vendedores");

//echo "<pre>";print_r($vendedores);echo "</pre>";
$mm = array();
if($nmm){
    foreach ($nmm as $m) {
        if ($m != "Todos los meses")
            $mm[] = str_pad($m, 2, "0", STR_PAD_LEFT);
    }
}
if (count($mm) > 0) {
    $Mes = "";
    for ($i = 0; $i < count($mm); $i++) {
        $Mes.= Utils::getMonth($mm[$i]) . ",";
    }
}
?>

<div align="center" id="container" ></div>

<?
if ($opcion) {
    if(count($resul)<=0){
    ?>  
    <div align="center"><br />
        <div style="text-align: center; text-decoration-color: #0000FF; font-size: 18px;"><b><?echo "NO EXISTEN DATOS QUE CUMPLAN CON ESTOS CRITERIOS"?></div>
    </div><br />
    <?
    }else{
    ?>
    <table style="font-size: 10" width="90%" border="1" class="tableList" align="center">
        <tr>
            <th style="text-align: center" colspan="21"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                </b></th>
        </tr>    
        <tr>
            <th scope="col" style=" text-align: center">A&ntilde;o</th>
            <th scope="col" style=" text-align: center">Mes</th>
            <th scope="col" style=" text-align: center">Referencia</th>
            <th scope="col" style=" text-align: center">Rep. Negocio</th>
            <th scope="col" style=" text-align: center;width: 300px">Cliente</th>
            <? if (!$agente) { ?><th scope="col" style=" text-align: center;width: 250px">Agente</th><? } ?>
            <th scope="col" style=" text-align: center">Ciudad Origen</th>
            <th scope="col" style=" text-align: center">Pais Destino</th>
            <th scope="col" style=" text-align: center">Ciudad Destino</th>
            <? if ($transporte=="Todos") { ?><th scope="col" style=" text-align: center">Transporte</th><? } ?>
            <? if (($transporte!="Todos" && !$modalidad && $transporte != "Aereo" && $transporte != "Terrestre") || ($transporte=="Todos")) { ?><th scope="col" style=" text-align: center">Modalidad</th><? } ?>
            <th scope="col" style=" text-align: center">Peso</th>
            <th scope="col" style=" text-align: center">Peso Volumen</th>
            <? if ($transporte == "Todos" || $transporte == "Aereo") { ?>
                <th scope="col" style=" text-align: center;width: 200px">Aerol&iacute;nea</th>
            <? }
            if ($transporte=="Todos" || $transporte == "Maritimo") {
                ?>
                <th scope="col" style=" text-align: center;width: 200px">Naviera</th>
                <th scope="col" style=" text-align: center;width: 130px">Concepto</th>
                <th scope="col" style=" text-align: center">TEUS</th>
                <? 
                } 
            ?>
            <th scope="col" style=" text-align: center;width: 140px">Comercial</th>
            <?
            if(!$sucursal){
                ?>
                <th scope="col" style=" text-align: center;width: 140px">Sucursal</th>
                <?
            }
            ?>
            <th scope="col" style=" text-align: center;width: 70px">INO</th>
            <th scope="col" style=" text-align: center;width: 70px">Estado</th>
        </tr>
        
        <?
        $color="#FFFFFF";
        foreach ($resul as $r) {
            if($r["ca_anulado"]){
                $color = "#FAA6A6";
            }
            ?>
            <tr>
                <td><?= $r["ano"] ?></td>
                <td><?= $r["mes"] ?></td>
                <td style=" background-color: <?=$color?>"><a href="/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=<?= $r["referencia"] ?>&consulta="><?= $r["referencia"] ?></a></td>
                <td><a href="/reportesNeg/verReporte/id/<?= $r["idreporte"] ?>/impoexpo/Exportación/modo/<?= $r["via"] ?>"><?= $r["rn"] ?></a></td>
                <td><?= $r["cliente"] ?></td>
                <? if (!$agente) { ?><td><?= $r["agente"] ?></td><? } ?>
                <td><?= $r["ciuorigen"] ?></td>
                <td><?= $r["tradestino"] ?></td>
                <td><?= $r["ciudestino"] ?></td>
                <? if ($transporte=="Todos") { ?><td><?= $r["via"] ?></td><? }
                if (($transporte!="Todos" && !$modalidad && $transporte != "Aereo" && $transporte != "Terrestre") || ($transporte=="Todos")) {
                ?><td><?= $r["modalidad"] ?></td><? } ?>
                <td style=" text-align: right"><?= $r["peso"] ?></td>
                <td style=" text-align: right"><?= $r["peso_volumen"] ?></td>
                <? if ($transporte=="Todos" || $transporte == "Aereo") { ?>
                    <td><?= $r["aerolinea"] ?></td>
                <? }
                if ($transporte=="Todos" || $transporte == "Maritimo") {
                    ?>
                    <td><?= $r["naviera"] ?></td>
                    <td><?= $r["concepto"] ?></td>
                    <td><?= $r["teus"] ?></td>
                    <? } ?>
                    <td><?= $r["comercial"] ?></td>
                    <?
            if(!$sucursal){
                ?>
                <td><?= $r["sucursal"] ?></td>
                <?
            }
            ?>
                <td style=" text-align: right"><?= "$" . Utils::formatNumber($r["ca_ino"]) ?></td>
                <td style=" text-align: right"><?= $r["case"] ?></td>
            </tr>
            <?
            $peso+=$r["peso"] ;
            $volumen+=$r["peso_volumen"] ;
            $teus+=$r["teus"] ;
            $ino+=$r["ca_ino"] ;
            $color="";
        }        
        ?>
            <tr><th colspan="20" style=" text-align: center; font-size: 12px">Totales => Peso: <?=Utils::formatNumber($peso)?>  Volumen: <?=Utils::formatNumber($volumen)?>  Teus: <?=$teus?>  INO: $<?=Utils::formatNumber($ino)?><th></tr>
    </table>
    
    <div align= "center" style="margin: 10px;">
        <input style=" width: 120px; color: #638CC2; font-size: 9px; background-color: #FFF; text-shadow: 0 0px 0px #638CC2;" id="bigbutton" type="submit" value="Contraer Todos" onclick="ocultar()"/> 
        <input style=" width: 120px; color: #638CC2; font-size: 9px; background-color: #FFF; text-shadow: 0 0px 0px #638CC2;" id="bigbutton" type="submit" value="Expandir Todos" onclick="mostrarTodos()"/>         
    </div>
    
    <div align= "center" style="margin: 10px; font-weight:bold;"><input id="bigbutton" type="submit" value="Total de Casos" onclick="mostrar('total_casos')"/></div>
    <div id="total_casos">
        <!--Total de Casos-->
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    TOTAL DE CASOS x SUCURSAL<br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b></th>
            </tr>
            <tr style ="text-align:center">
                <th>TRANSPORTE</th>
                <th>SUCURSAL</th>
                <?
                foreach ($tipo as $trans => $gridSucursal) {
                    $serieTrans[] = $trans;
                    foreach ($gridSucursal as $suc => $gridMes) {
                        if (!in_array($suc, $serieSuc))
                            $serieSuc[] = $suc;
                        foreach ($gridMes as $mes => $data) {
                            if (!in_array($mes, $serieX))
                                $serieX[] = $mes;
                        }
                    }
                }
                asort($serieSuc);
                sort($serieX);
                $nmeses = count($serieX);
                $nsuc = count($serieSuc);
                $ntrans = count($serieTrans);

                foreach ($serieX as $k => $mes) {
                    echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                }            
                ?>
                <th style ='text-align:center'>Total</th>
            </tr>    
            <?
            $style = "style ='text-align:right'";
            foreach ($serieTrans as $t => $transp) {
                echo "<tr><td rowspan=" . $nsuc . " style='vertical-align: text-top;'>" . $transp . "</td>";
                foreach ($serieSuc as $s => $suc) {
                    if($suc)
                        echo "<td>" . $suc . "</td>";
                    else
                        echo "<td>Sin Facturar</td>";
                    foreach ($serieX as $k => $mes) {
                        if ($tipo[$transp][$suc][$mes] == '')
                            echo "<td> </td>";
                        else
                            echo "<td style ='text-align:center'>" . $tipo[$transp][$suc][$mes] . "</td>";

                        $tipo[$suc]+=$tipo[$transp][$suc][$mes];
                        $tipo_mes[$transp][$mes]+=$tipo[$transp][$suc][$mes];
                    }
                    echo "<th style ='text-align:right'><b>" . $tipo[$suc] . "</b></th></tr>";
                    $tipo_nal[$transp]+=$tipo[$suc];
                    $tipo[$suc] = 0;                
                }
                echo "</tr><tr><th colspan='2' $style>Total " . $transp . "</th>";
                foreach ($serieX as $k => $mes) {
                    echo "<th style ='text-align:center'><b>" . $tipo_mes[$transp][$mes] . "</b></th>";
                }
                echo "<th $style><b>" . $tipo_nal[$transp] . "</b></th></tr>";
            }

            echo "</tr><tr><th colspan='2' $style>Total Nacional</th>";
            foreach ($tipo_mes as $tr => $gridMes) {
                foreach ($gridMes as $mes => $data) {
                    $tmes[$mes]+=$data;
                }
            }
            foreach ($serieX as $k => $mes) {
                echo "<th style ='text-align:center'><b>" . $tmes[$mes] . "</b></th>";
            }
            foreach ($tipo_nal as $tr => $data) {
                $tnal+=$data;
            }

            echo "<th $style><b>" . $tnal . "</b></th></tr>";
        ?>
        </table>
    </div>
    
    <div align= "center" style="margin: 10px;"><input id="bigbutton" type="submit" value="Consolidado de Peso, Volumen y Teus" onclick="mostrar('consolidado')"/></div>
    <div id="consolidado">
        <!--Consolidado de Peso, Volumen y Teus-->
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    CONSOLIDADO PESO , VOLUMEN, TEUS x SUCURSAL <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b></th>
            </tr>
            <tr style ="text-align:center">
                <th style="text-align: center">SUCURSAL</th>
                <th style="text-align: center">MES</th>
                <th style="text-align: center">PESO</th>
                <th style="text-align: center">VOLUMEN</th>
                <th style="text-align: center">TEUS</th>
            </tr>

            <?
            $lastSuc="-";

            ksort($resumen);
            foreach ($resumen as $suc => $gridMes) {
                if($suc)                
                    echo "<tr><td>" . $suc . "</td><td colspan='4'></td></tr>";
                else
                    echo "<td>Sin Facturar</td></tr>";
                foreach ($gridMes as $mes => $gridData) {
                    echo "<tr>";
                    if($lastSuc!=$suc){                
                        echo "<td></td>";
                    }
                    echo "<td>$mes</td>";
                    foreach($gridData as $data => $valor){
                        echo "<td $style>".Utils::formatNumber($valor)."</td>";                    
                        $total[$suc][$data]+=$valor;
                        $total[$data]+=$valor;
                    }
                    echo "</tr>";                                
                }
                $lastSuc = $suc;
                echo '<tr><th colspan="2">Total '.$suc.'</th><th style ="text-align:right">'.Utils::formatNumber($total[$suc]["peso"]).'</th><th style ="text-align:right">'.Utils::formatNumber($total[$suc]["volumen"]).'</th><th style ="text-align:right">'.$total[$suc]["teus"].'</th></tr>';            
            }
            echo '<tr><th colspan="2">Total </th><th style ="text-align:right">'.Utils::formatNumber($total["peso"]).'</th><th style ="text-align:right">'.Utils::formatNumber($total["volumen"]).'</th><th style ="text-align:right">'.$total["teus"].'</th></tr>';            
            ?>
        </table>    
    </div>
    
    <div align= "center" style="margin: 10px;"><input id="bigbutton" type="submit" value="Operaciones x Tráfico de Origen" onclick="mostrar('por_trafico')"/> </div>
    <div id="por_trafico">
        <!--Operaciones x Trafico de Origen-->
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    OPERACIONES X TRAFICO ORIGEN <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b></th>
            </tr>
            <tr style ="text-align:center;">
                <th>TRANSPORTE</th>
                <th>ORIGEN</th>
                <th>DESTINO</th>
                <?
                foreach ($serieX as $k => $mes) {
                    echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                }            
                ?>
                <th style ='text-align:center'>Total</th>
            </tr>    

            <?
            foreach ($traficos as $transp => $gridTransp) {
                $ntransp[$transp] = count($gridTransp);
                foreach($gridTransp as $ciuorigen => $gridDestino){
                    $norigen[$transp][$ciuorigen] = count($gridDestino);
                    $nfilas[$transp]+=$norigen[$transp][$ciuorigen];
                }
            }

            ksort($traficos);

            foreach ($traficos as $transp => $gridTransp) {
                ksort($gridTransp);
                echo "<tr><td rowspan=" . ($nfilas[$transp]+$ntransp[$transp]) . " style='vertical-align: text-top;'>" . $transp . "</td>";
                foreach ($gridTransp as $ciuorigen => $gridDestino) {
                    ksort($gridDestino);
                    echo "<td rowspan=" . $norigen[$transp][$ciuorigen] . " style='vertical-align: text-top;'>" . $ciuorigen . "</td>";
                    foreach($gridDestino as $destino => $gridMes ){                    
                        echo "<td>" . $destino . "</td>";
                        foreach ($serieX as $k => $mes) {                    
                            if ($gridMes[$mes] == '')
                                echo "<td> </td>";
                            else 
                                echo "<td>" . $gridMes[$mes] . "</td>";
                                $tot[$destino]+=$gridMes[$mes];
                        }   
                        echo "<td>$tot[$destino]</td></tr>";
                        $subtotal[$transp][$ciuorigen]+=$tot[$destino];
                        $tot[$destino]=0;
                    }
                    $total[$transp]+=$subtotal[$transp][$ciuorigen];
                    echo "<tr><th colspan='14'>Total $ciuorigen</th><th>".$subtotal[$transp][$ciuorigen]."</th></tr>";
                }
                $totalGnral+=$total[$transp];
                echo "<tr><th colspan='15'>Total $transp</th><th>".$total[$transp]."</th></tr>";
            }
            echo "<tr><th colspan='15'>Total General</th><th>".$totalGnral."</th></tr>";            
        ?>
        </table>
    </div>
    
    <div align= "center" style="margin: 10px;"><input id="bigbutton" type="submit" value="Operaciones Marítimas" onclick="mostrar('maritimo')"/> </div>
    <div id="maritimo">
        <!--Operaciones MARITIMAS-->
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    OPERACIONES MARITIMAS <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b></th>
            </tr>
            <tr style ="text-align:center">
                <th style="text-align: center">MODALIDAD</th>
                <th style="text-align: center">NAVIERA</th>            
                <th style="text-align: center">MES</th>
                <th style="text-align: center">OPERACIONES</th>
                <th style="text-align: center">PESO</th>
                <th style="text-align: center">VOLUMEN</th>
                <th style="text-align: center">TEUS</th>
            </tr>

            <?
            foreach ($sea as $mod => $gridLinea) {
                $nLinea[$mod] = count($gridLinea);
                foreach($gridLinea as $linea => $gridMes){
                    $nMod[$mod][$linea] = count($gridMes);
                    $nfilasMod[$mod]+=$nMod[$mod][$linea];
                }
            }

            ksort($sea);
            $total = array();
            $totalGnral = array();        

            foreach ($sea as $mod => $gridLinea) {
                if($mod)                
                    echo "<tr><td rowspan=" . ($nfilasMod[$mod]+$nLinea[$mod]). " style='vertical-align: text-top;'>" . $mod . "</td>";
                else
                    echo "<td rowspan=" . ($nfilasMod[$mod]+$nLinea[$mod]) . " style='vertical-align: text-top;'>Sin Modalidad</td>";
                ksort($gridLinea);
                foreach ($gridLinea as $linea => $gridMes) {                
                    echo "<td rowspan=" . ($nMod[$mod][$linea]) . " style='vertical-align: text-top;'>$linea</td>";
                    foreach($gridMes as $mes => $gridData){
                        echo "<td>$mes</td>";
                        foreach($gridData as $data => $valor){
                            echo "<td $style>".Utils::formatNumber($valor)."</td>";
                            $total[$mod][$linea][$data]+=$valor;
                            $totalMod[$mod][$data]+=$valor;
                            $totalGnral[$data]+=$valor;
                        }
                        echo "</tr>";

                    }
                    echo '<tr><th colspan="2">Total '.$linea.'</th><th style ="text-align:right">'.$total[$mod][$linea]["casos"].'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($total[$mod][$linea]["peso"]).'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($total[$mod][$linea]["volumen"]).'</th>'
                            . '<th style ="text-align:right">'.$total[$mod][$linea]["teus"].'</th></tr>';            
                }
                echo '<tr><th colspan="3">Total '.$mod.'</th><th style ="text-align:right">'.$totalMod[$mod]["casos"].'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($totalMod[$mod]["peso"]).'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($totalMod[$mod]["volumen"]).'</th>'
                            . '<th style ="text-align:right">'.$totalMod[$mod]["teus"].'</th></tr>';         
            }
            echo '<tr><th colspan="3">Total General</th><th style ="text-align:right">'.$totalGnral["casos"].'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($totalGnral["peso"]).'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($totalGnral["volumen"]).'</th>'
                            . '<th style ="text-align:right">'.$totalGnral["teus"].'</th></tr>';             
        ?>
        </table>
    </div>
    
    <div align= "center" style="margin: 10px;"><input id="bigbutton" type="submit" value="Operaciones Aéreas" onclick="mostrar('aereo')"/> </div>
    <div id="aereo">
        <!--Operaciones AEREAS-->
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    OPERACIONES AEREAS <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b></th>
            </tr>
            <tr style ="text-align:center">
                <th style="text-align: center">AEROLINEA</th>            
                <th style="text-align: center">MES</th>
                <th style="text-align: center">OPERACIONES</th>
                <th style="text-align: center">PESO</th>
                <th style="text-align: center">VOLUMEN</th>
            </tr>

            <?

            ksort($air);        
            foreach ($air as $linea => $gridMes) {
                $nairLinea[$linea] = count($gridMes);

            }

            $total = array();
            $totalGnral = array();        

            foreach ($air as $linea => $gridMes) {                
                echo "<td rowspan=" . ($nairLinea[$linea]) . " style='vertical-align: text-top;'>$linea</td>";
                foreach($gridMes as $mes => $gridData){
                    echo "<td>$mes</td>";
                    foreach($gridData as $data => $valor){
                        echo "<td $style>".Utils::formatNumber($valor)."</td>";
                        $total[$linea][$data]+=$valor;                    
                        $totalGnral[$data]+=$valor;
                    }
                    echo "</tr>";                    
                }
                echo '<tr><th colspan="2">Total '.$linea.'</th><th style ="text-align:right">'.$total[$linea]["casos"].'</th>'
                        . '<th style ="text-align:right">'.Utils::formatNumber($total[$linea]["peso"]).'</th>'
                        . '<th style ="text-align:right">'.Utils::formatNumber($total[$linea]["volumen"]).'</th></tr>';

            }
            echo '<tr><th colspan="2">Total General</th><th style ="text-align:right">'.$totalGnral["casos"].'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($totalGnral["peso"]).'</th>'
                            . '<th style ="text-align:right">'.Utils::formatNumber($totalGnral["volumen"]).'</th></tr>';                                     
        ?>
        </table>
    </div>
    
    <div align= "center" style="margin: 10px;"><input id="bigbutton" type="submit" value="Total INO" onclick="mostrar('ino')"/> </div>
    <div id="ino">
        <!--Total INO-->
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    Total INO <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b></th>
            </tr>
            <tr style ="text-align:center">
                <th>TRANSPORTE</th>
                <th>SUCURSAL</th>
                <?
                foreach ($serieX as $k => $mes) {
                    echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                }            
                ?>
                <th style ='text-align:center'>Total</th>
            </tr>    

            <?
            $tmes  = array();        
            $origen_mes = array();
            $origen_nal = array();

            $tnal = 0;
            //echo "<pre>";print_r($origen);echo "</pre>";
            foreach ($serieTrans as $t => $transp) {
                echo "<tr><td rowspan=" . $nsuc . " style='vertical-align: text-top;'>" . $transp . "</td>";
                foreach ($serieSuc as $s => $suc) {
                    if($suc)
                        echo "<td>" . $suc . "</td>";
                    else
                        echo "<td>Sin Facturar</td>";
                    foreach ($serieX as $k => $mes) {
                        if ($origen[$transp][$suc][$mes]["ino"] == '')
                            echo "<td> </td>";
                        else 
                            echo "<td $style>" . number_format($origen[$transp][$suc][$mes]["ino"],0,".",",") . "</td>";                       

                        $origen[$suc]+=$origen[$transp][$suc][$mes]["ino"];
                        $origen_mes[$transp][$mes]+=$origen[$transp][$suc][$mes]["ino"];
                    }
                    echo "<th $style><b>" . number_format($origen[$suc],0,".",",") . "</b></th></tr>";
                    $origen_nal[$transp]+=$origen[$suc];
                    $origen[$suc] = 0;
                    $origen_mes[$transp][$mes]["ino"] = 0;
                }
                echo "</tr><tr><th colspan='2' $style>Total " . $transp . "</th>";
                foreach ($serieX as $k => $mes) {
                    echo "<th $style><b>" . number_format($origen_mes[$transp][$mes],0,".",",") . "</b></th>";
                }
                echo "<th $style><b>" . number_format($origen_nal[$transp],0,".",",") . "</b></th></tr>";
            }

            echo "</tr><tr><th colspan=2 $style>Total Nacional</th>";
            foreach ($origen_mes as $tr => $gridMes) {
                foreach ($gridMes as $mes => $data) {
                    $tmes[$mes]+=$data;
                }
            }
            foreach ($serieX as $k => $mes) {
                echo "<th $style><b>" . number_format($tmes[$mes],0,".",",") . "</b></th>";
            }
            foreach ($origen_nal as $tr => $data) {
                $tnal+=$data;
            }

            echo "<th $style><b>" . number_format($tnal,0,".",",") . "</b></th></tr>";
        ?> 
        </table>
    </div>
    
    <div align= "center" style="margin: 10px;"><input id="bigbutton" type="submit" value="Resumen x Comercial" onclick="mostrar('comercial')"/> </div>
    <div id="comercial">
        <!--Resumen x Vendedor-->
        <table style="font-size: 10" width="80%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    RESUMEN POR VENDEDOR <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b></th>
            </tr>
            <tr>
                <th rowspan="2" style="text-align: center;">COMERCIAL</th>
                <th rowspan="2" style="text-align: center;">TRANSPORTE</th>
                <th rowspan="2" style="text-align: center;">CLIENTE</th>
                <th colspan="<?=count($serieX)?>" style="text-align: center;">MES</th>
                <th rowspan="2" style="text-align: center;">TOTAL</th>
            </tr>
            <tr>
                <?
                foreach ($serieX as $k => $mes) {
                    echo "<th style ='text-align:center'>" . Utils::getMonth($mes) . "</th>";
                } 
                ?>
            </tr>
            <?
            $total=array();
            $totalGnral=array();
            
            ksort($vendedores);
            foreach ($vendedores as $vendedor => $gridTransp) {
                $nvendedor[$vendedor] = count($gridTransp);
                foreach($gridTransp as $transp => $gridCliente){
                    $ncliente[$vendedor][$transp] = count($gridCliente);                    
                    $nfilasVen[$vendedor]+=$ncliente[$vendedor][$transp];
                }
            }
            
            foreach($vendedores as $vendedor => $gridTransp){
                echo "<tr><td rowspan=" . ($nfilasVen[$vendedor]) . " style='vertical-align: text-top;'>$vendedor</td>";
                ksort($gridTransp);
                foreach($gridTransp as $transp => $gridCliente){
                    echo "<td rowspan=" . $ncliente[$vendedor][$transp] . " style='vertical-align: text-top;'>$transp</td>";
                    ksort($gridCliente);
                    foreach($gridCliente as $client =>$gridMes){
                        echo "<td>$client</td>";
                        foreach ($serieX as $k => $mes) {
                            if ($gridMes[$mes] == '' || !$gridMes[$mes])
                                echo "<td></td>";
                            else
                                echo "<td $style>" . number_format($gridMes[$mes],0,".",",") . "</td>";
                            $total[$transp][$client]+=$gridMes[$mes];
                            $total_mes[$vendedor][$mes]+=$gridMes[$mes];                            
                        }
                        echo "<th $style>".number_format($total[$transp][$client],0,".",",")."</th>";
                        echo "</tr>";                        
                    }
                }
                echo "<tr><th colspan='3' $style>Total " . $vendedor . "</th>";
                foreach ($serieX as $k => $mes) {
                    echo "<th $style><b>" .number_format($total_mes[$vendedor][$mes],0,".",",") . "</b></th>";
                    $total_comercial[$vendedor]+=$total_mes[$vendedor][$mes];
                    $totalGnral[$mes]+=$total_mes[$vendedor][$mes];
                }
                echo "<th $style>" . number_format($total_comercial[$vendedor],0,".",",") . "</th>";
                echo "</tr>";
                
            }
            echo "<tr><th colspan='3' $style>Total General </th>";
            foreach ($serieX as $k => $mes) {
                echo "<th $style><b>" .number_format($totalGnral[$mes],0,".",",") . "</b></th>";
                $totalFinal+=$totalGnral[$mes];
            }
            echo "<th $style>" . number_format($totalFinal,0,".",",") . "</th>";
            echo "</tr>";            
            ?>
        </table>
    </div>
    
    <div align= "center" style="margin: 10px;"><input id="bigbutton" type="submit" value="Resumen x Cliente" onclick="mostrar('cliente')"/> </div>
    <div id="cliente">
        <!--Resumen por Cliente-->
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
            <tr>
                <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    RESUMEN POR CLIENTE <br />
                    <?= $Mes?$Mes . " de ":"" ?><?=$aa . "<br />"?>
                    <?= $transporte!="Todos" ? $transporte . "<br/>" : "" ?>&nbsp;<?= $modalidad ? $modalidad . "<br/>" : "" ?>
                    <?= $agente ? "AGENTE: " . $agente . "<br/>" : "" ?>
                    <?= $sucursal ? "SUCURSAL: " . $sucursal . "<br/>" : "" ?>
                    </b>
                </th>
            </tr>        
            <tr>
                <th rowspan="2" style="text-align: center">SUCURSAL</th>
                <th rowspan="2" style="text-align: center">CLIENTE</th>
                <th rowspan="2">MES</th>
                <th colspan="<?=$ntrans?>" style="text-align: center">TRANSPORTE</th><th style ='text-align:center' rowspan="2">Total</th></tr>
            <tr>
                <?
                foreach ($serieTrans as $t => $transp) {
                    echo "<th style='text-align: center'>" . $transp . "</th>";
                }
                ?>
            </tr>

            <?
            $j=0;
            $k=0;
            $tot_mes=array();

            foreach ($serieSuc as $s => $suc){
                ksort($cliente[$suc]);
            }

            foreach ($serieSuc as $s => $suc){
                if($suc)
                    echo "<tr><td>" . $suc . "</td>";
                else
                    echo "<td>Sin Facturar</td>";
                foreach ($cliente[$suc] as $cli => $gridMonth){
                    if($k>0)
                        echo "<td></td>";
                    echo "<td> $cli </td>";
                    foreach ($serieX as $k => $mes) {                    
                        foreach ($gridMonth as $month => $gridTrans){
                            if($month == $mes){
                                if($j>0)
                                    echo "<td></td><td></td>";
                                echo "<td>" . $month . "</td>";
                                foreach ($gridTrans as $tran => $data){                                    
                                    foreach ($serieTrans as $t => $transp) {
                                        if($tran==$transp){
                                            echo "<td $style> ".number_format($data,0,".",",")." </td>";
                                            $tot_mes[$cli][$month]+=$data;
                                            break;
                                        }
                                    }
                                }
                                echo "<th $style>".number_format($tot_mes[$cli][$month],0,".",",")."</th></tr>";                                
                                $tot_cli[$cli]+=$tot_mes[$cli][$month];
                                $tot_mes[$cli][$month]=0;
                                $j++;
                            }
                        }                    
                    }                
                    echo "<tr><td></td><th $style colspan=".($ntrans+2).">Total ".$cli."</th><th $style>" .number_format($tot_cli[$cli],0,".",",")."</th></tr>";
                    $tot_suc[$suc]+=$tot_cli[$cli];
                    $tot_cli[$cli]=0;
                    $j=0;
                    $k++;
                }
                $k=0;
                echo "<tr><th $style colspan=".($ntrans+3).">Total ".$suc."</th><th $style>" .number_format($tot_suc[$suc],0,".",",")."</th></tr>";
                $tot_nal+=$tot_suc[$suc];
            }
            echo "<tr><th $style colspan=".($ntrans+3).">Total Nacional</th><th $style>" .number_format($tot_nal,0,".",",")."</th></tr>";        
            ?>
        </table>
    </div>
    <?
    }
}
    ?>
    <script language="javascript">

        var tabs = new Ext.FormPanel({
            labelWidth: 75,
            border: true,
            fame: true,
            width: 600,
            standardSubmit: true,
            id: 'formPanel',
            items: {
                xtype: 'tabpanel',
                activeTab: 0,
                defaults: {autoHeight: true, bodyStyle: 'padding:10px'},
                id: 'tab-panel',
                items: [
                    new FormMenuEstadisticasExportaciones()
                ]
            },
            buttons: [
                {
                    text: 'Continuar',
                    handler: function() {
                        var tp = Ext.getCmp("tab-panel");

                        var owner = Ext.getCmp("formPanel");
                        if (tp.getActiveTab().getId() == "estadisticas") {
                            owner.getForm().getEl().dom.action = '<?= url_for("reportesGer/estadisticasExportaciones") ?>';
                        }
                        owner.getForm().submit();
                    }
                }]
        });
        tabs.render("container");
        
        function ocultar(){
            document.getElementById('total_casos').style.display = 'none';
            document.getElementById('consolidado').style.display = 'none';
            document.getElementById('por_trafico').style.display = 'none';
            document.getElementById('maritimo').style.display = 'none';
            document.getElementById('aereo').style.display = 'none';
            document.getElementById('ino').style.display = 'none';
            document.getElementById('cliente').style.display = 'none';
            document.getElementById('comercial').style.display = 'none';
        }
        
        function mostrar(id){
            document.getElementById(id).style.display = 'inline';
        }
        
        function mostrarTodos(){
            document.getElementById('total_casos').style.display = 'inline';
            document.getElementById('consolidado').style.display = 'inline';
            document.getElementById('por_trafico').style.display = 'inline';
            document.getElementById('maritimo').style.display = 'inline';
            document.getElementById('aereo').style.display = 'inline';
            document.getElementById('ino').style.display = 'inline';
            document.getElementById('cliente').style.display = 'inline';
            document.getElementById('comercial').style.display = 'inline';
        }
        
        window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
            ocultar();/* "contenido_a_mostrar" es el nombre de la etiqueta DIV que deseamos mostrar */
        }


    </script>