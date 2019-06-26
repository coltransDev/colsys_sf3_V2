<?

$solicitud = $sf_data->getRaw("solicitud");
$cotizacion = $sf_data->getRaw("cotizacion");
$ruta = $solicitud["trayecto"]["ruta"];

$trayectos = $cotizacion["trayectos"];
$equipos = $cotizacion["equipos"];


$ncolumns = count($equipos)+3;
$widthCol = (55/count($equipos))
        
?>
<div style="padding: 10px;">
    <table class="tableList" style="width:100%;">
        <tr>
            <th colspan="<?=$ncolumns?>" style="text-align: center;">COTIZACION DE TARIFAS TICKET No <?=$ticket->getCaIdticket()?></th>
        </tr>
        <tr>
            <td>
                <?    
                foreach($trayectos as $idtrayecto => $gridTipos){
                    $i = $idtrayecto;
                    ?>
                    <table style="border: 0; width: 100%; margin-bottom: 20px;">
                        <tr class="blue">
                            <td colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center;">TRAYECTO # <?=$idtrayecto+1?></td>
                        </tr>
                        <tr>
                            <td colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>">
                                <table class="tableList" style="width: 100%">
                                    <tr>
                                        <th style="width:25%">MODALIDAD</th><td style="width:25%"><?=$ruta[$i]["modalidad"]?></td><th style="width:25%">LINEA</th><td style="width:25%"><?=  $ruta[$i]["linea"]?></td>
                                    </tr>
                                    <tr>
                                        <th>CIU ORIGEN</th><td><?= utf8_decode($solicitud["trayecto"]["origen"]["ciudad"][$i])?></td><th>CIU DESTINO</th><td><?=$solicitud["trayecto"]["destino"]["ciudad"][$i]?></td>                    
                                    </tr>
                                    <tr>
                                        <th>FRECUENCIA</th><td><?=$ruta[$i]["frecuencia"]?></td><th>TIEMPO DE TRANSITO</th><td><?=$ruta[$i]["ttransito"]?></td>                    
                                    </tr>
                                    <tr>
                                        <th>CONTRATO</th><td><?=$ruta[$i]["ncontrato"]?></td><th>CERRADA POR</th><td><?=$ruta[$i]["cerradapor"]?></td>                    
                                    </tr>
                                    <tr>
                                        <th>VIGENCIA INICIAL</th><td><?=$ruta[$i]["vigenciaIni"]?></td><th>VIGENCIA FINAL</th><td><?=$ruta[$i]["vigenciaEnd"]?></td>                    
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center;">TARIFA DE FLETE INTERNACIONAL</th>
                        </tr>
                        <tr>
                            <th style=" width: 25%">Concepto</th>
                            <? 
                            foreach($equipos as $idequipo => $nombreEquipo){
                                ?>
                            <th style="text-align: center; width: <?=$widthCol."%"?>"><?=  $nombreEquipo?></th>
                                <?
                            }
                            ?>
                            <th style=" width: 5%; text-align: center;">Moneda</th>
                            <?
                            if($ruta[$i]["modalidad"]=="LCL"){
                                ?>
                                <th style=" width: 5%; text-align: center;">Aplicacion</th>
                                <?
                            }
                            ?>
                            <th style=" width: 15%; text-align: center;">Observ.</th>
                        </tr>
                        <?
                        $ltipo = null;
                        foreach($gridTipos as $tipo => $gridCantidad){            
                            foreach($gridCantidad as $gridConceptos ){
                                foreach($gridConceptos as $concepto => $gridEquipos ){
                                    ?>
                                    <tr>
                                        <td><?=utf8_decode($concepto)?></td>
                                        <?
                                        foreach($gridEquipos as $key => $equipoPropiedades ){
                                            ?>
                                            <td style="text-align: right;"><?=$equipoPropiedades["ca_vlrrecargo"]?></td>
                                            <?
                                            $moneda = $equipoPropiedades["ca_moneda"];
                                            $observaciones = $equipoPropiedades["observaciones"];
                                            $aplicacion = $equipoPropiedades["aplicacion"];
                                            $totalFlete[$idtrayecto][$tipo][$key]+=$equipoPropiedades["ca_vlrrecargo"];
                                        }
                                        ?>
                                        <td style="text-align: right;"><?=$moneda?></td>
                                        <?
                                        if($ruta[$i]["modalidad"]=="LCL"){
                                            ?>
                                            <td style="text-align: right;"><?=$aplicacion?></td>
                                            <?
                                        }
                                        ?>
                                        <td style="text-align: right;"><?=$observaciones?></td>
                                    </tr>
                                    <?
                                }                        
                            }
                            switch($tipo){
                                case "Flete":
                                    $titleTotal = "Total Flete Marítimo";
                                    break;
                                case "Recargos Locales":
                                    $titleTotal = "Total Recargos Locales";
                                    break;
                            } 
                            if($ruta[$i]["modalidad"]!="LCL"){
                                if($tipo == "Flete" || $tipo == "Recargos Locales"){
                                    ?>                
                                    <tr>
                                        <th><?=$titleTotal?></th>
                                        <?
                                        for($m=0; $m<count($equipos);$m++){
                                            ?>
                                            <th style="text-align: right;"><?=$totalFlete[$idtrayecto][$tipo][$m]?></th>                
                                            <?
                                            $total[$idtrayecto][$m]+=$totalFlete[$idtrayecto][$tipo][$m];
                                        }            
                                        ?>
                                        <th style="text-align: right;"><?=$moneda?></th>    
                                        <th></th>
                                    </tr>
                                    <?
                                    $ntipos = count($gridTipos);
                                    if($tipo == "Recargos Locales" || ($tipo == "Flete" && $ntipos==1)){
                                        ?>                
                                        <tr class="green">
                                            <th>GRAN TOTAL</th>
                                            <?
                                            for($m=0; $m<count($equipos);$m++){
                                                ?>
                                                <td style="text-align: right;"><?=$ntipos==1?$totalFlete[$idtrayecto][$tipo][$m]:$total[$idtrayecto][$m]?></td>                
                                                <?
                                            }            
                                            ?>
                                            <td style="text-align: right;"><?=$moneda?></td>                                        
                                        </tr>                    
                                        <?
                                    }
                                    if($tipo === "Recargos Locales" && $ntipos>2){
                                        ?>
                                        <tr>
                                            <th colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center">CONDICIONES EN DESTINO</th>
                                        </tr>
                                        <?
                                    }
                                }
                            }
                            $ltipo = $tipo;
                        }
                        ?>
                        <tr>
                            <th colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center">OBSERVACIONES</th>                    
                        </tr>
                        <tr>
                            <td colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>"><?=utf8_decode($ruta[$i]["observaciones"])?></td>
                        </tr> 
                    </table>
                    <?
                }    
                ?>
            </td>
        </tr>
    </table>
</div>