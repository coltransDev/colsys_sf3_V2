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
	

<iframe src="<?=url_for("reportesNeg/generarPDF?id=".$reporte->getCaIdreporte()."&token=".md5(time()))?>" width="830px" height="650px"></iframe>
</div>