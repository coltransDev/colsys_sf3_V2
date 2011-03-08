<?
include_component("cotizaciones", "formCotizacionPanel");
?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
Ext.QuickTips.init();
Ext.form.Field.prototype.msgTarget = 'side';
    var formPanel = new FormCotizacionPanel({
        title: "Sistema de cotizaciones Coltrans",
        idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
        renderTo:'panel'
    });
});
</script>
