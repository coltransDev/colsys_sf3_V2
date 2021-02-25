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

$valores = $sf_data->getRaw("valores");
//echo "<pre>";print_r($valores);echo "</pre>";
//exit;
$rowsVal = count($valores);
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
                    <tr><td colspan="2"><table><tr><td><img src="<?= $proceso->getCaIdempresa()?$proceso->getEmpresa()->getLogoHtml():'https://www.coltrans.com.co/logosoficiales/coltrans/LogoGrupoEmpresarialColtransMed.png' ?>" /></td></tr></table></td></tr>
                </table>
            </th>
            <?
            if($tipo=="repos"){
                $repos = '<span style="color:blue">Ver. '.$version->getCaVersion().'</span><br><span style="color:blue; font-size:18px;">Usuario: '.$version->getCaUsucreado().' Fecha: '.$version->getCaFchcreado().'</span>';
                $observaciones = '<tr><th colspan="8" align="left" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; font-size:18px; color: blue; border:1px solid #D0D0D0;">Notas de la versión:<br>'.$version->getCaObservaciones().'</th></tr>'; 
            }else{
                $repos = "";
                $observaciones = "";
            }
            ?>
            <th colspan="12" align="center"><h1>F_277_Versión_01_Vigencia_29_01_2021. EVALUACION DE RIESGOS: PROCESO <?= strtoupper($proceso->getCaNombre()) ?>&nbsp;<?=$repos?></h1></th>
        </tr>        
        <tr>
            <th colspan="13" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;text-align:center;"><b>INFORMACI&Oacute;N GENERAL</b></th>
        </tr>
        <tr>
            <th colspan="7" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; text-align:center;"><b>RIESGO</b></th>
            <th colspan="2" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; text-align:center;"><b>EMPRESA</b></th>
            <th colspan="1" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; text-align:center;"><b>CODIGO</b></th>
            <th colspan="3" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; text-align:center;"><b>CLASIFICACION</b></th>
        </tr> 
        <tr>
            <td colspan="7" align="center" style="font-size:25px; vertical-align:center;"><?= strip_tags(html_entity_decode($riesgo->getCaRiesgo()),'<font><br>')?></td>
            <td colspan="2" align="center" style="font-size:25px; vertical-align:center;"><?=$proceso->getCaIdempresa()?$proceso->getEmpresa()->getCaNombre():"TRANSVERSALES"?></td>
            <td colspan="1" align="center" style="font-size:25px; vertical-align:center;"><?=$riesgo->getCaCodigo()?></td>
            <td colspan="3" align="center" style="font-size:25px; vertical-align:center;"><?=!$riesgo->getCaAprobado()?'<div style="color: #FF0000;">PENDIENTE DE APROBACI&Oacute;N</div><br/>':''?><?=$riesgo->getClasificacion()?></td>
        </tr> 
        <?=$observaciones?>
        <tr>
            <th width="30%" rowspan="1" colspan="5" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;"><b>FACTOR GENERADOR</b></th>
            <th width="20%" rowspan="1" colspan="4" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;"><b>CAUSAS</b></th>
            <th width="50%" rowspan="1" colspan="4" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;"><b>CONTROLES</b></th>            
        </tr>            
        
        <tr>
            <td colspan="5" rowspan="1" style="font-size:25px; vertical-align:top;"><?$factores = $riesgo->getRsgoFactor();
                    foreach ($factores as $factor) {
                        echo $factor->getCaFactor(). "<br/>";
                    }?></td>
            <td colspan="4" rowspan="3" style="font-size:25px; vertical-align:top;"><?$causas = $riesgo->getRsgoCausas();                      
                    foreach($causas as $causa){
                        $color = "black";
                        if($causa->getCaNueva()){
                            $color = "red";
                        }
                        ?><span style="color:<?=$color?>"><?=$causa->getCaOrden()?>.&nbsp;<?=html_entity_decode($causa->getCaCausa())?></span><br/><?
                    }?></td>
            <td colspan="4" rowspan="3" style="font-size:25px; vertical-align:top;"><?= html_entity_decode($riesgo->getCaControles()) ?></td>                
            
        </tr>
        <tr>
            <th width="30%" colspan="5" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;"><b>ETAPA DEL PROCESO</b></th>
        </tr>
        <tr>
            <td colspan="5" rowspan="1" style="font-size:25px; vertical-align:top;"><?= html_entity_decode($riesgo->getCaEtapa())?></td>
        </tr>
        <tr>    
            <th width="100%" colspan="13" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;"><b>FACTOR POTENCIADOR ENTORNO (normativos, sociales, etc)</b></th>
        </tr>
        <tr>
            <td colspan="13" style="font-size:25px; vertical-align:top;"><?= html_entity_decode($riesgo->getCaPotenciador()) ?></td>
        </tr>                
        <tr>
            <th width="100%" colspan="13" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;text-align:center;"><b>PLAN DE CONTINGENCIA</b></th>
        </tr>
        <tr>
            <td colspan="13" style="font-size:25px;"><?= html_entity_decode($riesgo->getCaContingencia()) ?></td>
        </tr>
        <tr>
            <th width="60%" colspan="10" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;text-align:center;"><b>VALORACION</b></th>            
            <th width="40%" colspan="3" align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3;text-align:center;"><b>AP</b></th>            
        </tr>
        <?
        if($val && count($valores)>0){
            ?>
        <tr>
            <th colspan="1" rowspan="2" width=1% align="center" style="font-size:15px; background-color: #E3E3E3; ">A&Ntilde;O</th>
            <th colspan="1" rowspan="2" width=5% align="center" style="font-size:15px; background-color: #E3E3E3; ">SUCURSAL</th>            
            <th colspan="1" rowspan="2" width=1% align="center" style="font-size:15px; background-color: #E3E3E3; ">PROBABILIDAD DE OCURRENCIA</th>
            <th colspan="5" align="center" style="font-size:15px; background-color: #E3E3E3;">IMPACTO</th> 
            <th colspan="1" rowspan="2" width=5% align="center" style="font-size:15px; background-color: #E3E3E3; ">SCORE</th>
            <th colspan="1" rowspan="2" width=8% align="center" style="font-size:30px; background-color: #E3E3E3; ">SCORE PXI</th>                
            <td colspan="3" rowspan="<?=$rowsVal+2?>" width=40% style="font-size:25px;"><?= strip_tags(html_entity_decode($riesgo->getCaAp()),'<font><div><br>') ?></td>            
        </tr>        
        <tr>
            <th colspan="1" align="center" width=8% style="font-size:15px; background-color: #E3E3E3; ">OPERATIVO 10%</th>
            <th colspan="1" align="center" width=5% style="font-size:15px; background-color: #E3E3E3; ">LEGAL 30%</th>
            <th colspan="1" align="center" width=8% style="font-size:15px; background-color: #E3E3E3; ">ECON&Oacute;MICO 40%</th>
            <th colspan="1" align="center" width=8% style="font-size:15px; background-color: #E3E3E3; ">COMERCIAL 20%</th>
            <th colspan="1" align="center" width=5% style="font-size:15px; background-color: #E3E3E3; ">TOT</th>
            
        </tr>

            <!--<td align="center" style="font-size:15px; margin: 0px; padding: 6px 4px 2px 4px; background-color: #3366FF;border:1px solid #D0D0D0; text-align:center;">LO QUE SSEA</td>-->
            <?
            $i=0;
            $nsucursales = count($valores);
            foreach($valores as $key => $valor){

                $score = $valor["promedioscorexano"];
                switch($score){
                    case $score < 6:
                        $color = '#3366FF';
                        break;
                    case $score>=6 && $score < 25:
                        $color = '#008000';
                        break;

                    case $score>=25 && $score < 60:
                        $color = '#FFCC00';
                        break;
                    case $score>=60 && $score<=100:
                        $color = '#FF0000';
                        break;
                    default:
                        $color = "#FFFFFF";
                        break;
                }
                ?>
                <tr>
                    <td align="center" style="font-size:25px; vertical-align:top;"><?= utf8_decode($valor["ano"])?></td>
                    <td style="font-size:25px; vertical-align:top;"><?= utf8_decode($valor["sucursal"])?></td>
                    <td align="center" style="font-size:25px; vertical-align:top;"><?=$valor["peso"]?></td>
                    <td align="center" style="font-size:25px; vertical-align:top;"><?=$valor["operativo"]?></td>
                    <td align="center" style="font-size:25px; vertical-align:top;"><?=$valor["legal"]?></td>                                
                    <td align="center" style="font-size:25px; vertical-align:top;"><?=$valor["economico"]?></td>                                
                    <td align="center" style="font-size:25px; vertical-align:top;"><?=$valor["comercial"]?></td>                                
                    <td align="center" style="font-size:25px; vertical-align:top;"><?=$valor["impacto"]?></td>
                    <td align="center" style="font-size:25px; vertical-align:top;"><?=$valor["score"]?></td>
                    <?
                    if($i==0){?>
                    <td rowspan="<?=$nsucursales?>" align="center" style="background-color:<?=$color?>; font-size:30px; vertical-align:center; "><?=$valor["promedioscorexano"]?></td>                
                        <?                            
                    }
                    $i++;
                    ?>
                </tr>                                            
                <?                    
            }                    
        }else{
            ?>
                <tr>
                    <td colspan="10" align="center" style="font-size:25px; background-color: red;">NO HAY VALORACIONES PARA EL A&Ntilde;O SOLICITADO</td>
                    <td colspan="3" width=40% style="font-size:25px;"><?= strip_tags(html_entity_decode($riesgo->getCaAp()),'<font><div><br>') ?></td>            
                </tr>
            <?
        }
        ?>              
        <tr>
            <td colspan="13" align="rigth" valign="bottom" style="font-size:20px;">
                <b>Fecha de Impresión:</b><?=date("Y-m-d H:i:s")?>&nbsp;<b>Usuario Impresión:</b><?=$user->getNombre()?>&nbsp;<b>Riesgo&nbsp;<?=$nriesgo?>&nbsp;de&nbsp;<?=$triesgos?></b>
            </td>
        </tr>
</table>
