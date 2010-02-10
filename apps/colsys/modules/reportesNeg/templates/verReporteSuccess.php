<?

?>
<script language="javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){
			document.getElementById('emailForm').style.display="inline"
		}else{
			document.getElementById('emailForm').style.display="none"
		}
	}
	
</script>
<div class="content" align="center">
<div id="emailForm"  style="display:none;">
    <form name="form1" id="form1" method="post" action="<?=url_for("reportesNeg/enviarReporteEmail?id=".$reporte->getCaIdreporte())?>" >
	<?
	
    //,"message"=>$mensaje,"contacts"=>$contactos
    $asunto = "Reporte de Negocio ".$reporte->getCaConsecutivo()." V.".$reporte->getCaVersion();
	include_component("email", "formEmail", array("subject"=>$asunto));
	
	?>
	<br />
    <div align="center"><input type="submit" name="commit" value="Enviar" class="button" /></div><br /><br />
    </form>

</div>
	
<?
if( $reporte->getCaUsuanulado()){
    ?>
    <div style="width:830px" class="box1">
    <? //image_tag("16x16/info.gif")?> Reporte anulado por <?=$reporte->getCaUsuanulado()?> <?=Utils::fechaMes($reporte->getCaFchanulado())?>

    <br />
    <b>Motivo:</b> <?=$reporte->getCaDetanulado()?>
    <br />
    <?
    if( $reporte->getCaUsuanulado()==$user->getUserId() ){
        echo link_to("Haga click aca para revivir este reporte", "reportesNeg/revivirReporte?id=".$reporte->getCaIdreporte(), array("confirm"=>"Esta seguro?"));
    }
    ?>
    </div>
    <br />
    <?
}
?>
<iframe src="<?=url_for("reportesNeg/generarPDF?id=".$reporte->getCaIdreporte()."&token=".md5(time()))?>" width="830px" height="650px"></iframe>
</div>

<?
include_component("kbase","tooltipById", array("idcategory"=>18));
if( $opcion=="ayudas" ){
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
}
?>