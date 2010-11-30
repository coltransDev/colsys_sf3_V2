<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("reportesNeg", "formReportePanelOs",array("reporte"=>$reporte,"idreporte"=>$reporte->getCaIdreporte(),"modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
include_component("widgets", "widgetTercero");
?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
Ext.QuickTips.init();
    var formPanel = new FormReporteOsPanel({
        title: "Reportes de Negocio Servicios <?=$reporte->getCaConsecutivo()?>  -  <?=$modo?> ",
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
//if( $permiso=="3" ) {
//    include_component("kbase","tooltipCreator", array("idcategory"=>$idcategory));
//}
?>