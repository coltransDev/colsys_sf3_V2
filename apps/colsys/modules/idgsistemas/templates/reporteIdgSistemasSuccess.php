<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_component("idgsistemas", "formIndicadoresGestionPanel",array("idetapa1"=>$idetapa1, "idetapa2"=>$idetapa2, "etapa1"=>$etapa1, "etapa2"=>$etapa2, "lcs"=>$lcs));

$array = $tiposa = array();
$cuantos_lcs = 0;
$cuantos_lci = 0;
$totales = $informexTipos = $empresas = array();
$total_ing = 0;
$promedio_ing = 0;
$festivos = TimeUtils::getFestivos();
$narea = $sf_data->getRaw("narea");
$colspan = 16;
if (in_array(25, $narea)) {     
    $colspan+=7;
}
if($checkboxStatus== "on"){
    $colspan+=3;
}
?>
<div align="center" >
    <br />
    <br />
</div>
<div align="center" id="container"></div>
<?
if (!$idgsistemas) {
    ?>  
    <div align="center"><br />
        <div style="text-align: center; text-decoration-color: #0000FF; font-size: 18px;"><b><? echo "NO EXISTEN DATOS QUE CUMPLAN CON ESTOS CRITERIOS" ?></div>
    </div><br />
    <?
} else {
    $es_auditoria = ($departamento->getCaIddepartamento() === 4) ? TRUE : FALSE;
    ?>
    <table width="80%" border="1" class="tableList" align="center">
        <tr>
            <th colspan="<?=$colspan?>" style="text-align: center"><b><? echo $type_est == 1 ? "IDG DPTO " . strtoupper($departamento->getCaNombre()) ." ".date("Y-m-d") : ($type_est == 2 ? "ESTADISTICA TICKETS CERRADOS " . date("Y-m-d") : "ESTADISTICA TICKETS ABIERTOS " . date("Y-m-d"));?></b></th>
        </tr>
        <tr>
            <th scope="col" style=" text-align: center"><b>Mes</b></th>
            <th scope="col" style=" text-align: center"><b>No. Ticket</b></th>            
            <th scope="col" style=" text-align: center"><b>Titulo</b></th>
            <? if ($type_est == 1) { ?>
                <th scope="col" style=" text-align: center"><b>Tipo</b></th>
                <th scope="col" style=" text-align: center"><b>Estado</b></th>
            <?}?>
            <th scope="col" style=" text-align: center"><b>Usuario Asignado</b></th>
            <th scope="col" style=" text-align: center;width: 110px"><b>Grupo</b></th>
            <th scope="col" style=" text-align: center"><b><?= ($es_auditoria) ? "Reportado a:" : "Reportado por:"; ?></b></th>
            <th scope="col" style=" text-align: center"><b>Sucursal</b></th>
            <th scope="col" style=" text-align: center"><b>Empresa</b></th>
            <th scope="col" style=" text-align: center"><b>Fecha Creado</b></th>
            <th scope="col" style=" text-align: center"><b>Hora Creado</b></th>
            <th scope="col" style=" text-align: center"><b><? echo $type_est == 1 ? "Fecha Respuesta" : ($type_est == 2 ? "Fecha Cierre" : "Fecha Ult. Seg."); ?></b></th>
            <th scope="col" style=" text-align: center"><b><? echo $type_est == 1 ? "Hora Respuesta" : ($type_est == 2 ? "Hora Cierre" : "Hora Ult. Seg."); ?></b></th>            
            <th scope="col" style=" text-align: center"><b><? echo $type_est == 1 ? "Cálculo IDG 1a Rta" : ($type_est == 2 ? "Cerrado" : "Abierto"); ?></b></th>
            <?if($checkboxStatus== "on"){?>
                <th scope="col" style=" text-align: center"><b>Etapa Inicial<br/>(<?=$etapa1?>)</b></th>
                <th scope="col" style=" text-align: center"><b>Etapa Final<br/>(<?=$etapa2?>)</b></th>
                <th scope="col" style=" text-align: center"><b>Cálculo IDG x Status</b></th>
            <?}?>
            <? if ($type_est == 3) { ?>
                <th scope="col" style=" text-align: center"><b>Sin seguimiento hace:</b></th>
                <th scope="col" style=" text-align: center"><b>Porcentaje</b></th>
            <? } ?>
                <? if ($type_est == 1) { ?><th scope="col"style=" text-align: center"><b>Observaciones</b></th><? } ?>
                
            <? if (in_array(25, $narea)) { ?>
                <th scope="col" style=" text-align: center"><b>Tra. Origen</b></th>
                <th scope="col" style=" text-align: center"><b>Ciu. Origen</b></th>
                <th scope="col" style=" text-align: center"><b>Tra. Destino</b></th>
                <th scope="col" style=" text-align: center"><b>Ciu. Destino</b></th>
                <th scope="col" style=" text-align: center"><b>Fcl</b></th>
                <th scope="col" style=" text-align: center"><b>Lcl</b></th>
                <th scope="col" style=" text-align: center"><b>BreakBulk</b></th>
                <th scope="col" style=" text-align: center"><b>Gastos EXW</b></th>
            <?}?>
        </tr>
        <?
        $estados = $tipos = array();
        foreach ($idgsistemas as $idgsistema) {
            //Cálculo de horas laborales
            
            if($idgsistema["ca_type"]== "Invalido")
                continue;

            $hoy = date("Y-m-d H:i:s");

            $group = $idgsistema["ca_name"];
            switch ($type_est) {
                case 1:
                    $fch_terminada = $idgsistema["ca_fchterminada"];
                    break;
                case 2:
                    $fch_terminada = $idgsistema["fch_close"];
                    break;
                case 3:
                    $fch_terminada = $idgsistema["fch_ultseg"];
                    break;
            }


            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($idgsistema["ca_fchcreado"], "%d-%d-%d %d:%d:%d");
            $inicio = mktime($hor, $min, $seg, $mes, $dia, $ano);

            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($fch_terminada, "%d-%d-%d %d:%d:%d");
            $final = mktime($hor, $min, $seg, $mes, $dia, $ano);

            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($hoy, "%d-%d-%d %d:%d:%d");
            $hoy = mktime($hor, $min, $seg, $mes, $dia, $ano);

            switch ($type_est) {
                case 1:
                    $calculo_seg = TimeUtils::calcDiff($festivos, $inicio, $final);
                    //Verifica si la tarea está terminada, predetermina un total de 8 horas para tickets abiertos al momento de generar el informe.
                    if ($fch_terminada == "") {
                        $calculo_seg = '28800';
                    } elseif ($calculo_seg == 0) {
                        $calculo_seg = '60';
                    }
                    if($checkboxStatus== "on"){
                        if($idgsistema["ca_status1"] != null && $idgsistema["ca_status2"] != null){
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($idgsistema["ca_status1"], "%d-%d-%d %d:%d:%d");
                            $etapaini = mktime($hor, $min, $seg, $mes, $dia, $ano);

                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($idgsistema["ca_status2"], "%d-%d-%d %d:%d:%d");
                            $etapafin = mktime($hor, $min, $seg, $mes, $dia, $ano);
                            
                            $calculo_etapas = TimeUtils::calcDiff($festivos, $etapaini, $etapafin);
                            $calculo_etapa_hms = TimeUtils::tiempoSegundos($calculo_etapas);
                            
                        }else{
                            $calculo_etapa_hms = null;
                        }
                    }
                    break;
                case 2:
                    $calculo_seg = TimeUtils::calcDiff($festivos, $inicio, $final);
                    break;
                case 3:
                    $calculo_seg = TimeUtils::calcDiff($festivos, $inicio, $hoy); // Tiempo que lleva el ticket abierto en seg
                    $calculoultsg_seg = TimeUtils::calcDiff($festivos, $final, $hoy); // Tiempo hasta la fecha sin seguimiento en seg
                    //Pasa los tiempos a formato HH:mm:ss
                    $calculoultsg_hms = TimeUtils::workDiff($festivos, $idgsistema["ult_fch"], date("Y-m-d")) . ' días';
                    break;
            }

            //Pasa los tiempos a formato HH:mm:ss
            $calculo_hms = TimeUtils::tiempoSegundos($calculo_seg);

            // Establece los límites de Control
            if ($calculo_hms > $lcs) {
                $array_lcs[] = $calculo_seg;
                $cuantos_lcs = count($array_lcs);
            } elseif ($calculo_hms < $lci) {
                $array_lci[] = $calculo_seg;
                $cuantos_lci = count($array_lci);
            }
            
            if($checkboxStatus== "on"){
                // Establece los límites de Control
                if ($calculo_etapa_hms > $lcs) {
                    $array_etapa_lcs[] = $calculo_etapa_hms;
                    $cuantos_etapa_lcs = count($array_etapa_lcs);
                } elseif ($calculo_etapa_hms < $lci) {
                    $array_etapa_lci[] = $calculo_etapa_hms;
                    $cuantos_etapa_lci = count($array_etapa_lci);
                }
                
                //Cálculo de Tiempo por Servicio
                $array_etapa[] = $calculo_etapas;
                $cuantos_etapa = count($array_etapa);
            }

            //Cálculo de Tiempo por Servicio
            $array[] = $calculo_seg;
            $cuantos = count($array);

            //Cálculo de Tiempo por Ingeniero Asignado
            if (!isset($totales[$idgsistema["ca_assignedto"]])) {
                $totales[$idgsistema["ca_assignedto"]] = array();
                $totales[$idgsistema["ca_assignedto"]]["total_tickets"] = 0;
                $totales[$idgsistema["ca_assignedto"]]["prom_tiempo"] = 0;
            }
            $totales[$idgsistema["ca_assignedto"]]["estado"][$idgsistema["ca_estado"]]++;
            $totales[$idgsistema["ca_assignedto"]]["total_tickets"] ++;
            $totales[$idgsistema["ca_assignedto"]]["prom_tiempo"]+=$calculo_seg;
            
            //Calculo de Tickes Abiertos / Cerrados
            $estados[$idgsistema["ca_estado"]]+=1;
            
            //Calculo de Tipos
            $tipos[$idgsistema["ca_type"]]+=1;
            
            $informexTipos[$idgsistema["ca_type"]][$idgsistema["ca_name"]][$idgsistema["ca_nombre"]][$idgsistema["empresa"]][$idgsistema["ca_estado"]]++;
            $informexGrupo[$idgsistema["ca_name"]][$idgsistema["ca_type"]][$idgsistema["ca_nombre"]][$idgsistema["empresa"]][$idgsistema["ca_estado"]]++;
            $informexUsuario[$idgsistema["ca_assignedto"]][$idgsistema["ca_type"]][$idgsistema["ca_name"]][$idgsistema["ca_estado"]][$idgsistema["ca_nombre"]][$idgsistema["empresa"]]++;
            
            if(!in_array($idgsistema["empresa"], $empresas))
                $empresas[] = $idgsistema["empresa"];
            
            if($es_auditoria){
                $tiposa[$idgsistema["ca_type"]][$idgsistema["ca_estado"]][$idgsistema["ca_name"]][$idgsistema["ca_nombre"]][$idgsistema["empresa"]]++;
            }
            
            ?>
            <tr>
                <td><?= $idgsistema["mes"] ?></td>
                <td><a href="<?= url_for("helpdesk/verTicket?id=" . $idgsistema["ca_idticket"]) ?>" target="_blank"><?= $idgsistema["ca_idticket"] ?></a></td>
                <td><?= $idgsistema["ca_title"] ?></td>
                <? if ($type_est == 1) { ?>
                    <td scope="col" style=" text-align: center"><?= $idgsistema["ca_type"] ?></td>
                    <td scope="col" style=" text-align: center"><?= $idgsistema["ca_estado"] ?></td>
                <?}?>
                <td><?= $idgsistema["ca_assignedto"] ?></td>
                <td><?= $idgsistema["ca_name"] ?></td>
                <td><?= $idgsistema["ca_login"] ?></td>
                <td><?= $idgsistema["ca_nombre"] ?></td>
                <td><?= $idgsistema["empresa"] ?></td>
                <td style=" background-color: #EEEEEE;"><?= $idgsistema["fechacreado"] ?></td>
                <td style=" background-color: #EEEEEE;"><?= $idgsistema["horacreado"] ?></td>
                <td style=" background-color: #EEEEEE;"><? echo $type_est == 1 ? $idgsistema["fechaterminada"] : ($type_est == 2 ? $idgsistema["close_fch"] : $idgsistema["ult_fch"]); ?></td>
                <td style=" background-color: #EEEEEE;"><? echo $type_est == 1 ? $idgsistema["horaterminada"] : ($type_est == 2 ? $idgsistema["close_hou"] : $idgsistema["ult_hou"]); ?></td>                
                <td style=" background-color: #EEEEEE; text-align: right"><font color="<? echo $calculo_hms > $lcs ? "red" : ($calculo_hms < $lci ? "orange" : "black") ?>"><?= $calculo_hms ?></font></td>
                <?if($checkboxStatus== "on"){?>
                    <td style="background-color:  #e7f0fc;"><?=$idgsistema["ca_status1"]?></td>
                    <td style="background-color:  #e7f0fc;"><?=$idgsistema["ca_status2"]?></td>                    
                    <td style="background-color:  #e7f0fc; text-align: right"><font color="<? echo $calculo_etapa_hms > $lcs ? "red" : ($calculo_etapa_hms < $lci ? "orange" : "black") ?>"><?= $calculo_etapa_hms ?></font></td>
                <?}?>
                <? if ($type_est == 3) { ?>
                    <td style=" text-align: right; width: 60px "><?= $calculoultsg_hms ?></td>
                    <td><?= $idgsistema["ca_percentage"] ?></td>
                <? } ?>
                <? if ($type_est == 1) { ?><td><?= $idgsistema["ca_observaciones"] ?></td>
                
                    <? if (in_array(25, $narea)) { ?>
                        <td><?= $idgsistema["ca_traorigen"] ?></td>
                        <td><?= $idgsistema["ca_ciuorigen"] ?></td>
                        <td><?= $idgsistema["ca_tradestino"] ?></td>
                        <td><?= $idgsistema["ca_ciudestino"] ?></td>
                        <td><?= $idgsistema["fcl"] ?></td>
                        <td><?= $idgsistema["lcl"] ?></td>
                        <td><?= $idgsistema["breakbulk"] ?></td>
                        <td><?= $idgsistema["exw"] ?></td>                    
                    <?}?>
                <? } ?>
                

            </tr>
            <?
        }
        
        $promedio_seg = TimeUtils::array_avg($array);
        $promedio_hms = TimeUtils::tiempoSegundos($promedio_seg);
        $porcentaje_lcs = @round($cuantos_lcs * 100 / $cuantos, 2);
        $porcentaje_lci = round($cuantos_lci * 100 / $cuantos, 2);                
//        echo "<pre>";echo TimeUtils::array_avg($array_etapa);echo "</pre>";
        if($checkboxStatus== "on"){
            $promedio_etapa_seg = TimeUtils::array_avg($array_etapa);
            $promedio_etapa_hms = TimeUtils::tiempoSegundos($promedio_etapa_seg);
            $porcentaje_etapa_lcs = @round($cuantos_etapa_lcs * 100 / $cuantos_etapa, 2);
            $porcentaje_etapa_lci = round($cuantos_etapa_lci * 100 / $cuantos_etapa, 2);
        }
        ?>

    </table>
    <??>
    <br />
    <table class="tableList" align="center" width="30%">
        <tr>
            <th colspan="4" style="text-align: center"><b>INDICADOR DE GESTION DPTO. <?= strtoupper($departamento->getCaNombre()) ?></b></th>
        </tr>
        <tr>
            <th colspan="1"><b>Indicador:</b></th>
            <td colspan="3"><? echo $type_est == 1 ? "Usuarios atendidos a tiempo" : ($type_est == 2 ? "Tickets Cerrados" : "Tickets Abiertos"); ?></td>
        </tr>
        <tr>
            <th colspan="1"><b>Periodo:</b></th>
            <td colspan="3"><b><?= $fechaInicial ?></b> al <b><?= $fechaFinal ?></b></td>
        </tr>
        <tr>
            <th colspan="1"><b>Grupo:</b></th>
            <td colspan="3"><?= $group ?></td>
        </tr>
        <tr>
            <th><b>Producto NO Conforme:</b></th>
            <th>No. Casos:&nbsp;<b><?= $cuantos_lcs ?></b></th>
            <th>LCs:&nbsp;<?= $lcs ?></th>
            <td><font color="red"><b><?= $porcentaje_lcs ?>%</b></font></td>
        </tr>
        <tr>
            <th><b>Promedio Ponderado:</b></th>
            <th>No. Casos:&nbsp;<b><?= $cuantos ?></b></th>
            <th>LC:&nbsp;&nbsp;<?= $lc ?></th>
            <td><b><?= $promedio_hms ?></b></td>
        </tr>
        <tr>
            <th><b>Registros inferiores a lci:</b></th>
            <th>No. Casos:&nbsp;<b><?= $cuantos_lci ?></b></th>
            <th>LCi:&nbsp;<?= $lci ?></th>
            <td><font color="orange"><b><?= $porcentaje_lci ?>%</b></font></td>
        </tr>
    </table>
    <br />
    <br />
    <? if ($checkboxStatus == "on") { ?>                   
        <table class="tableList" align="center" width="30%">
        <tr>
            <th colspan="4" style="text-align: center"><b>INDICADOR DE GESTION DPTO. <?= strtoupper($departamento->getCaNombre()) ?></b></th>
        </tr>
        <tr>
            <th colspan="1"><b>Indicador:</b></th>
            <td colspan="3"><? echo $type_est == 1 ? $etapa1." vs ".$etapa2 : ($type_est == 2 ? "Tickets Cerrados" : "Tickets Abiertos"); ?></td>
        </tr>
        <tr>
            <th colspan="1"><b>Periodo:</b></th>
            <td colspan="3"><b><?= $fechaInicial ?></b> al <b><?= $fechaFinal ?></b></td>
        </tr>
        <tr>
            <th colspan="1"><b>Grupo:</b></th>
            <td colspan="3"><?= $group ?></td>
        </tr>
        <tr>
            <th><b>Producto NO Conforme:</b></th>
            <th>No. Casos:&nbsp;<b><?= $cuantos_etapa_lcs ?></b></th>
            <th>LCs:&nbsp;<?= $lcs ?></th>
            <td><font color="red"><b><?= $porcentaje_etapa_lcs ?>%</b></font></td>
        </tr>
        <tr>
            <th><b>Promedio Ponderado:</b></th>
            <th>No. Casos:&nbsp;<b><?= $cuantos_etapa ?></b></th>
            <th>LC:&nbsp;&nbsp;<?= $lc ?></th>
            <td><b><?= $promedio_etapa_hms ?></b></td>
        </tr>
        <tr>
            <th><b>Registros inferiores a lci:</b></th>
            <th>No. Casos:&nbsp;<b><?= $cuantos_etapa_lci ?></b></th>
            <th>LCi:&nbsp;<?= $lci ?></th>
            <td><font color="orange"><b><?= $porcentaje_etapa_lci ?>%</b></font></td>
        </tr>
    </table>
    <br />
    <br />
    <?}?>

    <table class="tableList" align="center" width="20%" border="1">
        <tr>
            <th colspan="5" style="text-align: center"><b>ESTADISTICA POR USUARIO ASIGNADO</b></th>
        </tr>
        <tr>
            <th style="text-align: center"><b>Usuario</b></th>
            <th style="text-align: center"><b>No. Casos</b></th>
            <th style="text-align: center"><b>Abiertos</b></th>
            <th style="text-align: center"><b>Cerrados</b></th>
            <th style="text-align: center"><b>Promedio</b></th>
        </tr>
        <?
        foreach ($totales as $key => $val) {
            $promedio = $val["prom_tiempo"] / $val["total_tickets"];
            $promedio_ing = TimeUtils::tiempoSegundos($promedio);
            ?>
            <tr>
                <th><b><?= $key?$key:"Sin asignar" ?></b></th>
                <td align="center"><?= $val["total_tickets"] ?></td>
                <td align="center"><?= $val["estado"]["Abierto"]?$val["estado"]["Abierto"]:0 ?></td>
                <td align="center"><?= $val["estado"]["Cerrado"]?$val["estado"]["Cerrado"]:0 ?></td>
                <td align="center" style=" text-align: right"><? if ($promedio_ing > $lcs) { ?> <font color="red"><?= $promedio_ing ?></font><? } elseif ($promedio_ing < $lci) { ?><font color="orange"><?= $promedio_ing ?></font><? } else {
            echo $promedio_ing;
        } ?></td>
            </tr>
            <?
        }
        ?>
    </table>
    <br />
    <br />    
    <table class="tableList" align="center" width="20%" border="1">
        <tr>
            <th colspan="4" style="text-align: center"><b>ESTADISTICA POR ESTADO</b></th>
        </tr>
        <tr>
            <th style="text-align: center"><b>Estado del Ticket</b></th>
            <th style="text-align: center"><b>No. Casos</b></th>
            <th style="text-align: center"><b>Porcentaje</b></th>
        </tr>
        <?  
        ksort($estados);
        foreach ($estados as $key => $val) {
            ?>            
            <tr>
                <th><b><?= $key ?></b></th>
                <td align="center"><?=$val?></td>
                <td align="center"><?=round(($val*100)/array_sum($estados))?>%</td>                                
            </tr>
            <?
        }
        ?>
    </table>
    <br />
    <br />
    <table class="tableList" align="center" width="20%" border="1">
        <tr>
            <th colspan="4" style="text-align: center"><b>ESTADISTICA POR TIPO</b></th>
        </tr>
        <tr>
            <th style="text-align: center"><b>Tipo</b></th>
            <th style="text-align: center"><b>No. Casos</b></th>
            <th style="text-align: center"><b>Porcentaje</b></th>
        </tr>
        <?
        ksort($tipos);        
        foreach ($tipos as $key => $val) {
            ?>            
            <tr>
                <th><b><?= $key ?></b></th>
                <td align="center"><?=$val?></td>
                <td align="center"><?=round((($val*100)/array_sum($estados)),1)?>%</td>                
            </tr>
            <?
        }   
        ?>
    </table>
    <br />
    <br />
    <table class="tableList" align="center" width="80%" border="1">
        <tr>
            <th colspan="7" style="text-align: center"><b>INFORME DETALLADO X TIPO</b></th>
        </tr>
        <tr>
            <th rowspan="2" style="text-align: center"><b>Tipo</b></th>            
            <th rowspan="2" style="text-align: center"><b>Grupo</b></th>
            <th rowspan="2" style="text-align: center"><b>Sucursal</b></th>
            <th rowspan="2" style="text-align: center"><b>Empresa</b></th>            
            <th rowspan="1" colspan="2" style="text-align: center"><b>Estado</b></th>
            <th rowspan="2" style="text-align: center"><b>Total</b></th>
        </tr>
        <tr>
            <th rowspan="1" style="text-align: center"><b>Abierto</b></th>
            <th rowspan="1" style="text-align: center"><b>Cerrado</b></th>
        </tr>        
        <?
        foreach ($informexTipos as $tipo => $gridGrupo) {
            $nfilas1[$tipo]=count($gridGrupo);            
            foreach ($gridGrupo as $grupo => $gridSucursal) {
                $nfilas2[$tipo][$grupo] = count($gridSucursal);
                foreach ($gridSucursal as $sucursal => $gridEmpresa) {
                    $nfilas3[$tipo][$grupo][$sucursal] = count($gridEmpresa);
                    $ntotal1[$tipo]+=$nfilas3[$tipo][$grupo][$sucursal];
                    $ntotal2[$tipo][$grupo]+=$nfilas3[$tipo][$grupo][$sucursal];
                }
            }            
        }        
        $total= 0;
        foreach ($informexTipos as $tipo => $gridGrupo) {            
            ?>            
            <tr>
                <th rowspan="<?=$ntotal1[$tipo]?>"><b><?= $tipo ?></b></th>
                <?
                foreach ($gridGrupo as $grupo => $gridSucursal) {
                    ?>
                    <td rowspan="<?=$ntotal2[$tipo][$grupo]?>"><?=$grupo?></td>
                    <?
                    foreach ($gridSucursal as $sucursal => $gridEmpresa) {
                        ?>
                        <td ><?=$sucursal?></td>
                        <?
                        foreach ($gridEmpresa as $empresa => $gridEstado) {
                            ?>
                            <td><?=$empresa?></td>
                            <td style="text-align: center"><?=$gridEstado["Abierto"]?></td>
                            <td style="text-align: center"><?=$gridEstado["Cerrado"]?></td>
                            <td style="text-align: center"><?=array_sum($gridEstado)?></td>
                            <?
                            $total+=array_sum($gridEstado);
                            ?>
                            </tr>
                        <?
                        }                        
                    }
                }
                ?>            
            <?
        }   
        ?>
        <tr><th colspan="6" style="text-align: right"><b>TOTAL</b></th><th style="text-align: center"><b><?=$total?></b></th></tr>                                                                        
    </table>
    <br/>
    <br/>
    <table class="tableList" align="center" width="80%" border="1">
        <tr>
            <th colspan="7" style="text-align: center"><b>INFORME DETALLADO X GRUPO</b></th>
        </tr>
        <tr>
            <th rowspan="2" style="text-align: center"><b>Grupo</b></th>            
            <th rowspan="2" style="text-align: center"><b>Tipo</b></th>
            <th rowspan="2" style="text-align: center"><b>Sucursal</b></th>
            <th rowspan="2" style="text-align: center"><b>Empresa</b></th>            
            <th rowspan="1" colspan="2" style="text-align: center"><b>Estado</b></th>
            <th rowspan="2" style="text-align: center"><b>Total</b></th>
        </tr>
        <tr>
            <th rowspan="1" style="text-align: center"><b>Abierto</b></th>
            <th rowspan="1" style="text-align: center"><b>Cerrado</b></th>
        </tr>
        
        <?
        $ntotal1 = $ntotal2 = $nfilas1 = $nfilas2 = $nfilas3 = array();
        foreach ($informexGrupo as $grupo => $gridTipo) {
            $nfilas1[$grupo]=count($gridTipo);            
            foreach ($gridTipo as $tipo => $gridSucursal) {
                $nfilas2[$grupo][$tipo] = count($gridSucursal);
                foreach ($gridSucursal as $sucursal => $gridEmpresa) {
                    $nfilas3[$grupo][$tipo][$sucursal] = count($gridEmpresa);
                    $ntotal1[$grupo]+=$nfilas3[$grupo][$tipo][$sucursal];
                    $ntotal2[$grupo][$tipo]+=$nfilas3[$grupo][$tipo][$sucursal];
                }
            }            
        }
        
        $total= 0;
        foreach ($informexGrupo as $grupo => $gridTipo) {            
            ?>            
            <tr>
                <th rowspan="<?=$ntotal1[$grupo]?>"><b><?= $grupo ?></b></th>
                <?
                foreach ($gridTipo as $tipo => $gridSucursal) {
                    ?>
                    <td rowspan="<?=$ntotal2[$grupo][$tipo]?>"><?=$tipo?></td>
                    <?
                    foreach ($gridSucursal as $sucursal => $gridEmpresa) {
                        ?>
                        <td ><?=$sucursal?></td>
                        <?
                        foreach ($gridEmpresa as $empresa => $gridEstado) {
                            ?>
                            <td><?=$empresa?></td>
                            <td style="text-align: center"><?=$gridEstado["Abierto"]?></td>
                            <td style="text-align: center"><?=$gridEstado["Cerrado"]?></td>
                            <td style="text-align: center"><?=array_sum($gridEstado)?></td>
                            <?
                            $total+=array_sum($gridEstado);
                            ?>
                            </tr>
                        <?
                        }                        
                    }
                }
                ?>            
            <?
        }   
        
        ?>
        <tr><th colspan="6" style="text-align: right"><b>TOTAL</b></th><th style="text-align: center"><b><?=$total?></b></th></tr>                                                                        
    </table>
    <br/>
    <br/>
    <?
    $colTotal = 6 + count($empresas);
    ?>
    <table class="tableList" align="center" width="80%" border="1">
        <tr>
            <th colspan="<?=$colTotal?>" style="text-align: center"><b>INFORME DETALLADO X USUARIO</b></th>
        </tr>
        <tr>
            <th rowspan="2" style="text-align: center"><b>Usuario</b></th>            
            <th rowspan="2" style="text-align: center"><b>Tipo</b></th>
            <th rowspan="2" style="text-align: center"><b>Grupo</b></th>
            <th rowspan="2" style="text-align: center"><b>Estado</b></th>
            <th rowspan="2" style="text-align: center"><b>Sucursal</b></th>            
            <th rowspan="1" colspan="<?=count($empresas)?>" style="text-align: center"><b>Empresas</b></th>
            <th rowspan="2" style="text-align: center"><b>Total</b></th>
        </tr>
        <tr>
            <?
            foreach($empresas as $key => $empresa){
                ?>
                <th rowspan="1" style="text-align: center"><b><?=$empresa?></b></th>
                <?
            }
            ?>
        </tr>
        
        <?
        $ntotal1 = $ntotal2 = $ntotal3 = $ntotal4 = $nfilas1 = $nfilas2 = $nfilas3 = $nfilas4 = $nfilas5 = array();
        foreach ($informexUsuario as $usuario => $gridTipo) {
            $nfilas1[$usuario]=count($gridTipo);            
            foreach ($gridTipo as $tipo => $gridGrupo) {
                $nfilas2[$usuario][$tipo] = count($gridGrupo);
                foreach ($gridGrupo as $grupo => $gridEstado) {
                    $nfilas3[$usuario][$tipo][$grupo] = count($gridEstado);
                    foreach ($gridEstado as $estado => $gridSucursal) {
                        $nfilas4[$usuario][$tipo][$grupo][$estado] = count($gridSucursal);                        
                        $ntotal1[$usuario]+=$nfilas4[$usuario][$tipo][$grupo][$estado];
                        $ntotal2[$usuario][$tipo]+=$nfilas4[$usuario][$tipo][$grupo][$estado];
                        $ntotal3[$usuario][$tipo][$grupo]+=$nfilas4[$usuario][$tipo][$grupo][$estado];
                        $ntotal4[$usuario][$tipo][$grupo][$estado]+=$nfilas4[$usuario][$tipo][$grupo][$estado];                        
                    }
                }
            }            
        }        
        $total= 0;
        foreach ($informexUsuario as $usuario => $gridTipo) {            
            ?>            
            <tr>
                <th rowspan="<?=$ntotal1[$usuario]?>"><b><?= $usuario ?></b></th>
                <?
                foreach ($gridTipo as $tipo => $gridGrupo) {
                    ?>
                    <td rowspan="<?=$ntotal2[$usuario][$tipo]?>"><?=$tipo?></td>
                    <?
                    foreach ($gridGrupo as $grupo => $gridEstado) {
                        ?>
                        <td rowspan="<?=$ntotal3[$usuario][$tipo][$grupo]?>"><?=$grupo?></td>
                        <?
                        foreach ($gridEstado as $estado => $gridSucursal) {
                            ?>
                            <td rowspan="<?=$ntotal4[$usuario][$tipo][$grupo][$estado]?>"><?=$estado?></td>
                            <?
                            foreach ($gridSucursal as $sucursal => $gridEmpresa) {
                                ?>
                                <td><?=$sucursal?></td>
                                <?
                                foreach($empresas as $key => $empresa){
                                    ?>
                                    <td style="text-align: center"><?=$gridEmpresa[$empresa]?></td>
                                    <?
                                }
                                ?>
                                <td style="text-align: center"><?=array_sum($gridEmpresa)?></td>
                            <?
                            $total+=array_sum($gridEmpresa);
                            ?>
                            </tr>
                        <?
                        }   
                        }
                                                
                    }
                }
                ?>            
            <?
        }   
        
        ?>
        <tr><th colspan="<?=$colTotal-1?>" style="text-align: right"><b>TOTAL</b></th><th style="text-align: center"><b><?=$total?></b></th></tr>                                                                        
    </table>
    <?    
}
?>
<script language="javascript">

    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        border: true,
        fame: true,
        width: 650,
        standardSubmit: true,
        id: 'formPanel',
        items: {
            xtype: 'tabpanel',
            activeTab: 0,
            defaults: {autoHeight: true, bodyStyle: 'padding:10px'},
            id: 'tab-panel',
            items: [
                new FormIndicadoresGestionPanel()
            ]
        },
        buttons: [
            {
                text: 'Continuar',
                handler: function() {
                    
                    var owner = Ext.getCmp("formPanel");
                    var form = owner.getForm();

                    if (form.isValid()) {
                        form.submit({
                            url: '<?= url_for("idgsistemas/reporteIdgSistemas") ?>',
                            waitMsg: 'Generando Consulta...',
                            success: function(form, action) {

                                alert("porfin"),
                                        Ext.MessageBox.alert('Sistema de Seguimientos', 'El seguimiento se ha guardado correctamente');
                            },
                            failure: function(form, action) {
                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (action.result ? ": " + action.result.errorInfo : "") + " " + (action.response ? "\n Codigo HTTP " + action.response.status : ""));
                            }//end fail
                        });
                    } else {
                        Ext.MessageBox.alert('Estadísticas Help Desk', '¡Por favor complete los campos subrayados!');
                    }
                }
            }]
    });
    tabs.render("container");
    
</script>
