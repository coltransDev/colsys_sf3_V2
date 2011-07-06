<?
include_component("cotizaciones", "formCotizacionPanel", array("cotizacion"=>$cotizacion, "tarea"=>$tarea));
include_component("cotizaciones", "subPanel", array("cotizacion"=>$cotizacion));
?>
<div class="content">

    <?
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ie6 = false;
    if( strpos($user_agent , "MSIE 6")!==false ){
        $ie6 = true;
    }
    if( $ie6 ){
        ?>
        <div align="center">
        <a href="http://www.coltrans.com.co/download/Aplicaciones/navegadores/IE8-WindowsXP-x86-ESN.exe">
        <?=image_tag("22x22/alert.gif")?> Este modulo podria no funcionar correctamente con esta versión de Internet Explorer que esta usando actualmente<br/>
        por favor haga click aca
        </a>
        </div>
        <?
    }
    ?>
    <div id="panel"></div>
    <div id="subpanel"></div>
</div>

<script type="text/javascript">
    Ext.onReady(function(){
        Ext.QuickTips.init();
        Ext.form.Field.prototype.msgTarget = 'side';

        new FormCotizacionPanel({
            title: "Sistema de cotizaciones Coltrans",
            idcotizacion:'<?=$cotizacion->getCaIdcotizacion() ?>',
            renderTo:'panel'
        });
        <?
        if( $cotizacion->getCaIdcotizacion() && $tarea  ){
        ?>
            var subPanel = new SubPanel();
            subPanel.render("subpanel");
        <?
        }
        ?>
    });
</script>
