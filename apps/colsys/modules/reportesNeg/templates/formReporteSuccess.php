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
Ext.form.Field.prototype.msgTarget = 'side';
    var formPanel = new FormReportePanel({
        title: "Reportes de Negocio <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?> - <?=$impoexpo?> - <?=$modo?>    ",
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
//echo $permiso;
if( $permiso=="3" ) {
    include_component("kbase","tooltipCreator", array("idcategory"=>$idcategory));
}
?>