<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("reportesNeg", "formReportePanelOtmmin",array("reporte"=>$reporte,"idreporte"=>$reporte->getCaIdreporte(),"permiso"=>$permiso));

?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
Ext.QuickTips.init();
    var formPanel = new FormReportePanelOtmmin({
        title: "Reportes de Negocio OTM simplificado <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?> ",

        idreporte:'<?=$reporte->getCaIdreporte()?>',
        renderTo:'panel'
    });
});
</script>