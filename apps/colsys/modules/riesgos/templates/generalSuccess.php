<?
if(!$riesgo->getCaAprobado()){
    ?>
    <div class='rojo b'>PENDIENTE DE APROBACI&Oacute;N</div><br/>
    <?   
}
?>
<div class='azul b'>DESCRIPCI&Oacute;N DEL RIESGO</div>
<div>
    <b><i>RIESGO:</i></b><br><?=strip_tags(html_entity_decode($riesgo->getCaRiesgo()),"<font>")?><br><br>
    <b><i>EMPRESA:</i></b><br><?=$riesgo->getRsgoProcesos()->getCaIdempresa()?$riesgo->getRsgoProcesos()->getEmpresa()->getCaNombre():"Transversales"?><br><br>
    <b><i>CLASIFICACI&Oacute;N:</i></b><br><?=html_entity_decode($riesgo->getClasificacion())?><br>
    <!--<b><i>RIESGO:</i></b><br><?=html_entity_decode($riesgo->getCaRiesgo())?><br><br>-->
    <b><i>FACTOR GENERADOR:</i></b><br>
    <?
    $factores = $riesgo->getRsgoFactor();
    foreach($factores as $factor){        
        echo html_entity_decode($factor->getCaFactor())."<br/>";        
    }            
    ?><br>
    <b><i>ETAPA DEL PROCESO:</i></b><br><?=html_entity_decode($riesgo->getCaEtapa())?><br><br>
    <b><i>FACTOR POTENCIADOR ENTORNO (normativos, sociales, etc):</i></b><br><?=html_entity_decode($riesgo->getCaPotenciador())?><br><br>
</div>
<div class='azul b'>POSIBLES CAUSAS O VULNERABILIDADES ACTUALES</div>
<div>
    <?
        $causas = $riesgo->getRsgoCausas();
        foreach($causas as $causa){
            $color = "black";
            if($causa->getCaNueva())
                $color = "red";
            echo "<span style='color:$color;'>".$causa->getCaOrden().". ".html_entity_decode($causa->getCaCausa())."</span><br/>";
        }            
    ?>
</div><br>
<div class='azul b'>CONTROLES ACTUALES</div>
<div><?=html_entity_decode($riesgo->getCaControles())?></div><br>
<div class='azul b'>AP O PM PROPUESTOS</div>
<div><?=html_entity_decode($riesgo->getCaAp())?></div><br>
<div class='azul b'>CONTINGENCIA O  MITIGACION DE IMPACTO</div>
<div><?=html_entity_decode($riesgo->getCaContingencia())?></div><br>