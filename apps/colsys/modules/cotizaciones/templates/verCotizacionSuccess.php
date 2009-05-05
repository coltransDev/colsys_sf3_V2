<?
use_helper( "MimeType");

$enBlanco = $cotizacion->enBlanco();

?>

<div align="center">
<script language="javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){ 
			document.getElementById('emailForm').style.display="inline"
		}else{
			document.getElementById('emailForm').style.display="none"
		}
	}
</script>
<div id="emailForm"  style="display:<?=$enBlanco?"inline":"none"?>;">
	<form name="form1" id="form1" method="post" action="<?=url_for("cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion())?>">
	<?
	//echo form_tag( "cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion() ); 
	/*echo form_remote_tag(array("url"=>"cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion(), 
								"update"=>"emailForm",
								 'loading'  => visual_effect('appear', 'indicator'),
							    'complete' => visual_effect('fade', 'indicator')							
							
						 ));*/
						 
	$contactos = $cotizacion->getContacto()->getCaEmail();					 
		
	if( $contactos &&  $cotizacion->getCliente()->getCaConfirmar() ){
		$contactos .= ","; 
	}
	if( $cotizacion->getCliente()->getCaConfirmar() ){
		$contactos .=  $cotizacion->getCliente()->getCaConfirmar();
	}
	
	include_component("general", "formEmail", array("subject"=>$asunto,"message"=>$mensaje,"contacts"=>$contactos));
	?>
	<br />
	
	
	<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">	
		<tr>
			<th><div align="left"><strong>Adjuntos:</strong> 
			</div></th>
		</tr>
		<?php 
		if( !$enBlanco ){
		?>
		<tr>
			<td>
				<div align="left">
					<input type="checkbox" name="incluirPDF" value="PDF" checked="checked" > Cotización en PDF
				</div>
			</td>
		</tr>
		<?php 
		}
		
		$archivos = $cotizacion->getCotArchivos();
		foreach( $archivos as $archivo ){					
		
		?>
		<tr>
			<td>
				<div align="left">
					<input type="checkbox" name="attachments[]" value="<?=$archivo->getCaIdarchivo()?>" checked="checked"> <a href="#" onclick="window.open('<?=url_for("cotizaciones/verArchivo?idcotizacion=".$cotizacion->getCaIdcotizacion()."&idarchivo=".$archivo->getCaIdarchivo())?>')"><?=$archivo->getCaNombre()?></a>
				</div>
			</td>
		</tr>
		<?php 
		}
		?>
	</table>	
	<div align="center"><input type="submit" name="commit" value="Enviar" /></div><br /><br />
	
</div>


<? 
if( !$enBlanco ){
?>	
<iframe src="<?=url_for("cotizaciones/generarPDF?id=".$cotizacion->getCaIdcotizacion()."&token=".md5(time()))?>" width="830px" height="650px"></iframe>

<?
}
if( count($emails)>0 ){
?>
<br />
<br />

<table class="tableList">
	<tr >
		<th>Fecha Envio</th>			
		<th>Asunto</th>			
		<th>Destinatarios</th>			
	</tr>
<?
	foreach( $emails as $email ){
		?>
		<tr >
			<td><?=$email->getCaFchEnvio()?></td>			
			<td><?=$email->getCaSubject()?></td>			
			<td><?=$email->getCaAddress()?></td>			
		</tr>
		<?
	}
?>
</table>
<?

}
?>
<br />
</div>
