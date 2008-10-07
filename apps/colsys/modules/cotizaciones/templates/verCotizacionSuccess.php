<?
use_helper("Javascript", "Validation");
?>
<script language="javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){ 
			<?
			echo visual_effect('BlindDown', 'emailForm');
			?>
		}else{
			<?
			echo visual_effect('BlindUp', 'emailForm');
			?>
		}
	}
</script>
<div id="emailForm" align="left" style="display:none;">
	<?
	echo form_remote_tag(array("url"=>"cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion(), 
								"update"=>"emailForm",
								 'loading'  => visual_effect('appear', 'indicator'),
							    'complete' => visual_effect('fade', 'indicator')							
							
						 ));
	include_component("general", "formEmail");
	?>
	<br />
	<div align="left"><?=submit_tag("Enviar");?></div><br /><br />

</div>
	
<iframe src="<?=url_for("cotizaciones/generarPDF?id=".$cotizacion->getCaIdcotizacion())."&token=".md5(time())?>" width="830px" height="650px"></iframe>