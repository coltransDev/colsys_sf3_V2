<?

$solicitud = $sf_data->getRaw("solicitud");
$cotizacion = $sf_data->getRaw("cotizacion");
$ruta = $solicitud["trayecto"]["ruta"];

$trayectos = $cotizacion["trayectos"];
//$equipos = $cotizacion["equipos"];
//echo gettype($equipos);
//print_r(sort($equipos));
//echo "<pre>";print_r($equipos);echo "</pre>";
foreach($trayectos as $idtrayecto => $gridTipos){
    foreach($gridTipos as $tipo => $gridCantidad){            
        foreach($gridCantidad as $gridConceptos ){
            foreach($gridConceptos as $concepto => $gridEquipos ){
                foreach($gridEquipos as $key => $equipoPropiedades ){
                    $equipos[$equipoPropiedades["ca_idequipo"]] = $equipoPropiedades["ca_equipo"];
                }
            }
        }
    }
}
//echo gettype($equipos);
//print_r($ruta);
//echo utf8_decode(utf8_decode($ruta[0]["observaciones"]));

$ncolumns = count($equipos)+3;
$widthCol = (55/count($equipos))
        
?>
<div style="padding: 5px;">
    <table style="background-color:#FFFFFF; padding: 0px; border: 1px solid #CCCCCC; border-spacing: 0px; border-collapse: collapse; font-family: verdana,arial,helvetica,serif;font-size: 10px; width:100%;">
        <tr>
            <th colspan="<?=$ncolumns?>" style="text-align: center; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333;">COTIZACION DE TARIFAS TICKET No <?=$ticket->getCaIdticket()?></th>
        </tr>
        <tr>
            <td style="color: #333333; border-bottom: 1px solid #e5e5e5; padding: 4px; margin: 0;">
                <?    
                foreach($trayectos as $idtrayecto => $gridTipos){
                    $i = $idtrayecto;
                    ?>
                    <table style="background-color:#FFFFFF; border: 0; font-family: verdana,arial,helvetica,serif;font-size: 10px; width:100%;">
                        <tr style="background-color: #CEE7FF;">
                            <td colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center; border-bottom: 1px solid #e5e5e5; padding: 4px; margin: 0;">TRAYECTO # <?=$idtrayecto+1?></td>
                        </tr>
                        <tr>
                            <td colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center; border-bottom: 1px solid #e5e5e5; padding: 4px; margin: 0;">
                                <table style=" background-color: #FFFFFF; padding: 0px; border: 1px solid #CCCCCC; border-spacing: 0px; border-collapse: collapse; width:100%; font-family: verdana,arial,helvetica,serif;font-size: 10px;">
                                    <tr>
                                        <th style="width:25%; text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">MODALIDAD</th>
                                        <td style="width:25%; border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$ruta[$i]["modalidad"]?></td>
                                        <th style="width:25%; text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">LINEA</th>
                                        <td style="width:25%; border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=  $ruta[$i]["linea"]?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal; ">CIU ORIGEN</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?= utf8_decode($solicitud["trayecto"]["origen"]["ciudad"][$i])?></td>
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">CIU DESTINO</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$solicitud["trayecto"]["destino"]["ciudad"][$i]?></td>                    
                                    </tr>
                                    <tr style="border-spacing: 0px;border-collapse: collapse; font-family: verdana,arial,helvetica,serif;font-size: 10px;">
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">FRECUENCIA</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$ruta[$i]["frecuencia"]?></td>
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">TIEMPO DE TRANSITO</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$ruta[$i]["ttransito"]?></td>                    
                                    </tr>
                                    <tr style="border-spacing: 0px;border-collapse: collapse; font-family: verdana,arial,helvetica,serif;font-size: 10px;">
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">CONTRATO</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$ruta[$i]["ncontrato"]?></td>
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">CERRADA POR</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$ruta[$i]["cerradapor"]?></td>                    
                                    </tr>
                                    <tr style="border-spacing: 0px;border-collapse: collapse; font-family: verdana,arial,helvetica,serif;font-size: 10px;">
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">VIGENCIA INICIAL</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$ruta[$i]["vigenciaIni"]?></td>
                                        <th style="text-align:left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">VIGENCIA FINAL</th>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$ruta[$i]["vigenciaEnd"]?></td>                    
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333;  font-weight: normal;">TARIFA DE FLETE INTERNACIONAL</th>
                        </tr>
                        <tr>
                            <th style=" width: 25%; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">Concepto</th>
                            <? 
                            foreach($equipos as $idequipo => $nombreEquipo){
                                ?>
                                <th style="text-align: center; width: <?=$widthCol."%"?>; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;"><?=  $nombreEquipo?></th>
                                <?
                            }
                            ?>
                            <th style=" width: 5%; text-align: center; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">Moneda</th>
                            <?
                            if($ruta[$i]["modalidad"]=="LCL"){
                                ?>
                                <th style="width: 5%; text-align: center; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">Aplicacion</th>
                                <?
                            }
                            ?>
                            <th style=" width: 15%; text-align: center; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">Observ.</th>
                        </tr>
                        <?
                        $ltipo = null;
                        foreach($gridTipos as $tipo => $gridCantidad){            
                            foreach($gridCantidad as $gridConceptos ){
                                foreach($gridConceptos as $concepto => $gridEquipos ){
//                                    echo "<pre>";print_r($gridEquipos);echo "</pre>";
                                    ?>
                                    <tr>
                                        <td style="border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=utf8_decode($concepto)?></td>
                                        <?
                                        foreach($gridEquipos as $key => $equipoPropiedades ){
                                            ?>
                                            <td style="text-align: right; border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$equipoPropiedades["ca_vlrrecargo"]?></td>
                                            <?
                                            $moneda = $equipoPropiedades["ca_moneda"];
                                            $observaciones = $equipoPropiedades["observaciones"];
                                            $aplicacion = $equipoPropiedades["aplicacion"];
                                            $totalFlete[$idtrayecto][$tipo][$key]+=$equipoPropiedades["ca_vlrrecargo"];
                                        }
                                        ?>
                                        <td style="text-align: right; border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$moneda?></td>
                                        <?
                                        if($ruta[$i]["modalidad"]=="LCL"){$ruta
                                            ?>
                                            <td style="text-align: right; border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$aplicacion?></td>
                                            <?
                                        }
                                        ?>
                                        <td style="text-align: right; border-bottom: 1px solid #e5e5e5; padding: 4px; color:#333333;"><?=$observaciones?></td>
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
                                        <th style="text-align: left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;"><?=$titleTotal?></th>
                                        <?
                                        for($m=0; $m<count($equipos);$m++){
                                            ?>
                                            <th style="text-align: right; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;"><?=$totalFlete[$idtrayecto][$tipo][$m]?></th>                
                                            <?
                                            $total[$idtrayecto][$m]+=$totalFlete[$idtrayecto][$tipo][$m];
                                        }            
                                        ?>
                                        <th style="text-align: right; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;"><?=$moneda?></th>    
                                        <th style="margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;"></th>
                                    </tr>
                                    <?
                                    $ntipos = count($gridTipos);
                                    if($tipo == "Recargos Locales" || ($tipo == "Flete" && $ntipos==1)){
                                        ?>                
                                        <tr style="background-color: #CEFFCE;">
                                            <th style="text-align: left; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">GRAN TOTAL</th>
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
                                        <tr style="border-spacing: 0px;border-collapse: collapse;">
                                            <th colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">CONDICIONES EN DESTINO</th>
                                        </tr>
                                        <?
                                    }
                                }
                            }
                            $ltipo = $tipo;
                        }
                        ?>
                        <tr>
                            <th colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>" style="text-align: center; margin: 0px; padding: 6px 4px 2px 4px; background: transparent url(https://www.colsys.com.co/images/layout/panel/white-top-bottom.gif) repeat-x scroll 0 -1px; border: 1px solid #D0D0D0; color: #333333; font-weight: normal;">OBSERVACIONES</th>                    
                        </tr>
                        <tr>
                            <td colspan="<?=$ruta[$i]["modalidad"]=="LCL"?$ncolumns+1:$ncolumns?>"><?= utf8_decode(utf8_decode($ruta[$i]["observaciones"]))?></td>
                        </tr> 
                    </table>
                    <?
                }    
                ?>
            </td>
        </tr>
    </table>
</div>