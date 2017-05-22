<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("ordenes", "formOrdenPanel",array("reporte"=>$reporte,"idreporte"=>$reporte->getCaIdreporte(),"permiso"=>"4"));

?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
Ext.QuickTips.init();
    var formPanel = new FormOrdenPanel({
        title: "Orden de servicio <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?> ",
        idreporte:'<?=$reporte->getCaIdreporte()?>',
        renderTo:'panel'
    });
});
</script>