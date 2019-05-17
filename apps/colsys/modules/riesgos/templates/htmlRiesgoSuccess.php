<?
$proceso = $sf_data->getRaw("proceso");
$riesgo = $sf_data->getRaw("riesgo");
$user = $sf_data->getRaw("user");
$val = $sf_data->getRaw("val");
$nriesgo = $sf_data->getRaw("nriesgo");
$triesgos = $sf_data->getRaw("triesgos");
$tipo = $sf_data->getRaw("tipo");
$version = $sf_data->getRaw("version");

$operativo = $sf_data->getRaw("operativo");
$legal = $sf_data->getRaw("legal");
$economico = $sf_data->getRaw("economico");
$comercial = $sf_data->getRaw("comercial");

?>
<link rel="stylesheet" type="text/css" media="screen" href="/css/coltrans.css" />

<table style="background-color: #FFFFFF;
	padding: 0px;
	border: 1px solid #CCCCCC;
	border-spacing: 0px;
	border-collapse: collapse;" width="100%" border="1" cellspacing="1" cellpadding="2"  >
        <tr>
            <th colspan="1" style="padding: 3px;color:#333333;">
                <table cellpadding="3" cellspacing="2" border="0" style="font-size: 22px;" >
                    <tr><td colspan="2"><table><tr><td><img src="<?= $proceso->getDepartamento()->getEmpresa()->getLogoHtml() ?>" /></td></tr>

                                                    </table></td></tr>
                </table>
            </th>
            <?if($tipo=="repos"){
                $repos = '<span style="color:blue">Ver. '.$version->getCaVersion().'</span><br><span style="color:blue; font-size:18px;">Usuario: '.$version->getCaUsucreado().' Fecha: '.$version->getCaFchcreado().'</span>';
                $observaciones = '<tr><th colspan="8" align="left" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; font-size:18px; color: blue; border:1px solid #D0D0D0;">Notas de la versión:<br>'.$version->getCaObservaciones().'</th></tr>'; 
            }else{
                $repos = "";
                $observaciones = "";
            }
            ?>
            <th colspan="7" align="cenTER"><h1>EVALUACION DE RIESGOS: PROCESO <?= strtoupper($proceso->getCaNombre()) ?>&nbsp;<?=$repos?></h1></th>
        </tr>        
        <tr>
            <th colspan="8" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;	border:1px solid #D0D0D0;">RIESGO: <span style="font-weight: bold;"><?=$riesgo->getCaCodigo()?></span></th>
        </tr> 
        <?=$observaciones?>
    <?
        
        $uno = true;        
        //foreach ($riesgos as $riesgo) {
            
            $rowspan = 2;
            /*if($riesgo->getCaImpresion()>0)
                $rowspan++;*/
            //$eventos = $riesgo->getIdgEventos();
            if(count($eventos)>0)
                $rowspan = $rowspan+count($eventos)+2;            
            ?>
            <tr>
                <!--<th colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">ID</th>-->
                <th width="30%" rowspan="2" colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">RIESGO</th>
                <th width="20%" rowspan="2" colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">CAUSAS</th>
                <th width="20%" rowspan="2" colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">CONTROLES</th>
                <th width="30%" colspan="5" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">VALORACION</th>                
                
                <!--<th colspan="1" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">AP</th>
                <th colspan="1" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">PLAN CONTINGENCIA</th>-->
                
            </tr>            
            <tr>
                <th width="5%" colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">P</th>                
                <th width="20%" colspan="3" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">IMPACTO</th>                
                <th width="5%" colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;font-size:20px;">SCORE PXI</th>                
            </tr>
            <tr>
                <!--<td rowspan="<?=$rowspan?>"><h3><?= html_entity_decode($riesgo->getCaCodigo()) ?></h3></td>-->
                <td colspan="1" rowspan="8" style="font-size:25px; vertical-align:top;">                                                                
                        <b><i>RIESGO:</i></b><br><?= strip_tags(html_entity_decode($riesgo->getCaRiesgo()),'<font><br>') ?><br><br>
                        <b><i>FACTOR GENERADOR:</i></b><br>
                        <?
                        $factores = $riesgo->getIdgFactor();
                        foreach ($factores as $factor) {
                            echo html_entity_decode($factor->getCaFactor()) . "<br/>";
                        }
                        ?><br>                        
                        <b><i>ETAPA DEL PROCESO:</i></b><br><?= html_entity_decode($riesgo->getCaEtapa()) ?><br><br>
                        <b><i>FACTOR POTENCIADOR ENTORNO (normativos, sociales, etc):</i></b><br><?= html_entity_decode($riesgo->getCaPotenciador()) ?><br>                    
                </td>
                <td colspan="1" rowspan="8" style="font-size:25px; vertical-align:top;">
                    <?
                        $causas = $riesgo->getIdgCausas();                        
                        foreach($causas as $causa){
                            $color = "black";
                            if($causa->getCaNueva()){
                                $color = "red";
                            }
                            ?>
                            <span style="color:<?=$color?>"><?=$causa->getCaOrden()?>.&nbsp;<?=html_entity_decode($causa->getCaCausa())?></span><br/>
                            <?                                    
                        }        
                    ?>                    
                </td>
                <td rowspan="8" colspan="1" style="font-size:25px; vertical-align:top;"><?= strip_tags(html_entity_decode($riesgo->getCaControles()),'<font><div><br>') ?></td>                <?
                
                if($val){
                $impacto = (($val->getCaOperativo()*10*0.01)+($val->getCaLegal()*30*0.01)+($val->getCaEconomico()*40*0.01)+($val->getCaComercial()*20*0.01));
                $score = $impacto * $val->getCaPeso();
                
                
                $color = 'black';
                
                switch($score){
                    case $score<=5.9:
                        $color = '#3366FF';
                        break;
                    case $score>=6 && $score<= 24.9:
                        $color = '#008000';
                        break;
                    case $score>=25 && $score<= 59.9:
                        $color = '#FFCC00';
                        break;
                    case $score>=60 && $score<=100:
                        $color = '#FF0000';
                }
                
                ?>
                <td colspan="1" rowspan= "8" style="font-size:25px;" align="center" ><?= html_entity_decode($val->getCaPeso()) ?></td>
                <td width="14%" colspan="1" style="font-size:25px;">OPERATIVO</td>
                <td width="3%" colspan="1" style="font-size:25px;">10%</td>
                <td width="3%" colspan="1" rowspan= "8" style="font-size:25px;" align="center"><?=$impacto?></td>
                <td colspan="1" rowspan= "8" style="background-color:<?=$color?>; font-size:30px;" align="center"><?=$score?></td>
                <?}?>
            </tr>
            <?
            if($val){
            ?>
            <tr>
                <td colspan="1" style="font-size:25px;"><?=$operativo?></td>
                <td colspan="1" style="font-size:25px;"><?=$val->getCaOperativo()?></td>
            </tr>
            <tr>
                <td colspan="1" style="font-size:25px;">LEGAL</td>
                <td colspan="1" style="font-size:25px;">30%</td>
            </tr>            
            <tr>
                <td colspan="1" style="font-size:25px;"><?=$legal?></td>
                <td colspan="1" style="font-size:25px;"><?=$val->getCaLegal()?></td>
            </tr>
            <tr>
                <td colspan="1" style="font-size:25px;">ECONOMICO</td>
                <td colspan="1" style="font-size:25px;">40%</td>
            </tr>
            <tr>
                <td colspan="1" style="font-size:25px;"><?=$economico?></td>
                <td colspan="1" style="font-size:25px;"><?=$val->getCaEconomico()?></td>
            </tr>
            <tr>
                <td colspan="1" style="font-size:25px;">COMERCIAL</td>
                <td colspan="1" style="font-size:25px;">20%</td>
            </tr>
            <tr>
                <td colspan="1" style="font-size:25px;"><?=$comercial?></td>
                <td colspan="1" style="font-size:25px;"><?=$val->getCaComercial()?></td>
            </tr>
            <?}?>
            <tr>
                <th colspan="2" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">AP</th>
                <th colspan="6" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;border:1px solid #D0D0D0;">PLAN CONTINGENCIA</th>
            </tr>
            <tr>
                <td colspan="2" style="font-size:25px;"><?= strip_tags(html_entity_decode($riesgo->getCaAp()),'<font><div><br>') ?></td>
                <td colspan="6" style="font-size:25px;"><?= strip_tags(html_entity_decode($riesgo->getCaContingencia()),'<font><div><br>') ?></td>
            </tr>
            <tr>
                <td colspan="8" align="rigth" valign="bottom" style="font-size:20px;">
                    <b>Fecha de Impresión:</b><?=date("Y-m-d H:i:s")?>&nbsp;<b>Usuario Impresión:</b><?=$user->getNombre()?>&nbsp;<b>Riesgo&nbsp;<?=$nriesgo?>&nbsp;de&nbsp;<?=$triesgos?></b>
                </td>
            </tr>
            
            <!--<tr>
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
            </tr>-->
            <?  
            /*if(count($eventos)>0){
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
                        <b>Proceso:</b><?=$proceso->getCaNombre()?>&nbsp;<b>Fecha de Impresión:</b><?=date("Y-m-d H:i:s")?>&nbsp;<b>Usuario Impresión:</b><?=$user->getNombre()?><br/>

                    </td>
                </tr>
                <?
            }*/
        //}
        ?>         
</table>