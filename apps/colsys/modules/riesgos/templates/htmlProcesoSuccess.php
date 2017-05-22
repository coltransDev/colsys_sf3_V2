<?
$proceso = $sf_data->getRaw("proceso");
$responsables = $sf_data->getRaw("responsables");
?>
<link rel="stylesheet" type="text/css" media="screen" href="/css/coltrans.css" />
<style>

    
</style>

<table style="background-color: #FFFFFF;
	padding: 0px;
	border: 1px solid #CCCCCC;
	border-spacing: 0px;
	border-collapse: collapse;" width="100%" border="1" cellspacing="1" cellpadding="2"  >
    <tr>
        <th colspan="1" style="padding: 4px;color:#333333;">
            <table cellpadding="3" cellspacing="2" border="0" style="font-size: 22px;" >
                <tr><td colspan="2"><table><tr><td><img src="<?= $proceso->getDepartamento()->getEmpresa()->getLogoHtml() ?>" /></td></tr>
                                                         
                                                </table></td></tr>
            </table>
        </th>
        <th colspan="8" align="cenTER"><h1>EVALUACION DE RIESGOS: PROCESO <?= strtoupper($proceso->getCaNombre()) ?></h1></th>
    </tr>
    <tr>
        <th colspan="9" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;	border:1px solid #D0D0D0;">RIESGOS</th>
    </tr>    
    <?
        $uno = true;
        foreach ($riesgos as $riesgo) {
            $rowspan = 2;
            if($riesgo->getCaImpresion()>0)
                $rowspan++;
            $eventos = $riesgo->getIdgEventos();
            if(count($eventos)>0)
                $rowspan = $rowspan+count($eventos)+2;            
            ?>
            <tr>
                <th colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">ID</th>
                <th colspan="2" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">RIESGO</th>
                <th colspan="2" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">CAUSAS</th>
                <th colspan="2" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">CONTROLES</th>
                <th colspan="1" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">AP</th>
                <th colspan="1" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">PLAN CONTINGENCIA</th>
            </tr>
            <tr>
                <td rowspan="<?=$rowspan?>"><h3><?= html_entity_decode($riesgo->getCaCodigo()) ?></h3></td>
                <td colspan="2" style="font-size:25px;">                                                                
                        <b><i>RIESGO:</i></b><br><?= html_entity_decode($riesgo->getCaRiesgo()) ?><br><br>
                        <b><i>FACTOR GENERADOR:</i></b><br>
                        <?
                        $factores = $riesgo->getIdgFactor();
                        foreach ($factores as $factor) {
                            echo html_entity_decode($factor->getCaFactor()) . "<br/>";
                        }
                        ?><br>
                        <b><i>ETAPA DEL PROCESO:</i></b><br><?= html_entity_decode($riesgo->getCaEtapa()) ?><br><br>
                        <b><i>FACTOR POTENCIADOR ENTORNO (normativos, sociales, etc):</i></b><br><?= html_entity_decode($riesgo->getCaPotenciador()) ?><br><br>                    
                </td>
                <td colspan="2" style="font-size:25px;">
                        <?
                        $causas = $riesgo->getIdgCausas();
                        $i = 1;
                        foreach ($causas as $causa) {
                            $end_ts = $causa->getMaxFchCreado($riesgo->getCaIdriesgo());                            
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($end_ts, "%d-%d-%d %d:%d:%d");                            
                            $start_ts = date("Y-m-d H:i:s", mktime($hor, $min, $seg, $mes, $dia - 1, $ano));
                            $user_ts = $causa->getCaFchcreado();

                            if ($user_ts == $end_ts) {
                                $color = "red";
                            } else {
                                $color = "black";
                            }
                            echo "<span style='color:" . $color . ";'>" . $i . ") " . html_entity_decode($causa->getCaCausa()) . "</span><br/>";
                            $i++;
                        }
                        ?>                    
                </td>
                <td colspan="2" style="font-size:25px;"><?= html_entity_decode($riesgo->getCaControles()) ?></td>
                <td style="font-size:25px;"><?= html_entity_decode($riesgo->getCaAp()) ?></td>
                <td style="font-size:25px;"><?= html_entity_decode($riesgo->getCaContingencia()) ?></td>
            </tr>
            <tr>
                <th colspan="2" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">VALORACION</th>
                <td colspan="6" style="font-size:25px;">
                    <?
                    $valores = $riesgo->getIdgValoracion();
                    foreach($valores as $valor){
                        $impacto = ($valor->getCaOperativo()*10*0.01)+($valor->getCaLegal()*30*0.01)+($valor->getCaEconomico()*40*0.01)+($valor->getCaComercial()*20*0.01)
                        ?>                                                 
                        <span>ANO:</span><b><?=$valor->getCaAno()?></b>
                        <span>POSIBILIDAD: </span><b><?=$valor->getCaPeso()?></b>
                        <span>OPERATIVO (10%): </span><b><?=$valor->getCaOperativo()?></b>
                        <span>LEGAL (30%): </span><b><?=$valor->getCaLegal()?></b>
                        <span>ECONOMICO (40%): </span><b><?=$valor->getCaEconomico()?></b>
                        <span>COMERCIAL (20%): </span><b><?=$valor->getCaComercial()?></b>
                        <span style="color:blue;">IMPACTO: </span><b><?=$impacto?></b>
                        <span style="color:blue;">SCORE PxI: </span><b><?=$impacto*$valor->getCaPeso()?></b><br/>                        
                        <?
                    }
                    ?>
                </td>
            </tr>
            <?  
            if(count($eventos)>0){
                ?>
                <tr>
                    <th colspan="8" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">EVENTOS</th>
                </tr>
                <tr>
                    <th colspan="2" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">FCH. EVENTO</th>
                    <th colspan="2" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">EVENTO</th>
                    <th colspan="2" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">CLIENTE</th>
                    <th align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">DOCUMENTO</th>
                    <th align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">PA</th>
                </tr> 
                <?
                foreach($eventos as $evento){
                    ?>
                    <tr>
                        <td colspan="2" style="font-size:25px;"><?=$evento->getCaFchevento()?></td>
                        <td colspan="2" style="font-size:25px;"><?=html_entity_decode($evento->getCaDescripcion())?></td>
                        <td colspan="2" style="font-size:25px;"><?=$evento->getCliente()->getIds()->getCaNombre()?></td>
                        <td style="font-size:25px;"><?=$evento->getCaDocumento()?></td>
                        <td style="font-size:25px;"><?=$evento->getCaPa()?></td>
                    </tr>
                    <?                                            
                }
            }
            if($riesgo->getCaImpresion()>0){
                ?>
                <tr>
                    <td colspan="8" height="<?=$riesgo->getCaImpresion()?>" align="rigth" valign="bottom" style="font-size:20px;">
                        <b>Proceso:</b><?=$proceso->getCaNombre()?>&nbsp;<b>Fecha de Impresión:</b><?=date("Y-m-d H:i:s")?>&nbsp;<b>Usuario Impresión:</b><?=$user->getNombre()?>&nbsp;<b>Riesgo&nbsp;<?=$nriesgo?>&nbsp;de&nbsp;<?=$triesgoss?></b><br/>

                    </td>
                </tr>
                <?
            }
        }
        ?>         
</table>