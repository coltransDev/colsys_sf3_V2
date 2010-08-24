<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("reportesNeg", "formReportePanel",array("reporte"=>$reporte,"idreporte"=>$reporte->getCaIdreporte(),"modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
include_component("widgets", "widgetTercero");

?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
Ext.QuickTips.init();
    var formPanel = new FormReportePanel({
        title: "Reportes de Negocio <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?>",
        editable: <?=$editable?"true":"false"?>,
        nuevaVersion: <?=$nuevaVersion?"true":"false"?>,
        copiar: <?=$copiar?"true":"false"?>,
        idreporte:'<?=$reporte->getCaIdreporte()?>',
        renderTo:'panel'
    });
});
</script>
<?
/*
* Modulos de Tooltips
*/
if( $opcion=="ayudas" ) {
    include_component("kbase","tooltipCreator", array("idcategory"=>$idcategory));
}
?>