<?
$cotizacion = $sf_data->getRaw("cotizacion");
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
	<a href="http://www.coltrans.com.co/download/Aplicaciones/IE8-WindowsXP-x86-ESN.exe">
	<?=image_tag("22x22/alert.gif")?> Este modulo podria no funcionar correctamente con esta versión de Internet Explorer que esta usando actualmente<br/>
	por favor haga click aca
	</a>
	</div>
	<?
}
?>
<div id="panel1" align="left"></div>
<div id="panel2" align="left"></div>
<?

include_component("cotizaciones", "mainPanel", array("cotizacion"=>$cotizacion, "tarea"=>$tarea, "nivel"=>$nivel));
include_component("cotizaciones", "subPanel", array("cotizacion"=>$cotizacion, "tarea"=>$tarea, "nivel"=>$nivel));
?>
<script type="text/javascript">
Ext.onReady(function(){
	Ext.QuickTips.init();
	Ext.form.Field.prototype.msgTarget = 'side';
     window.alert = function(texto,titulo)
     {
        titulo=(titulo!="undefined")?titulo:'Alerta';
        Ext.MessageBox.alert(titulo, texto );
     }

     var mainPanel = new MainPanel();
     mainPanel.render("panel1");

     <?
     if( $cotizacion->getCaIdcotizacion() && $tarea  ){
     ?>
        var subPanel = new SubPanel();
        subPanel.render("panel2");
     <?
     }
     ?>
});
</script>
</div>