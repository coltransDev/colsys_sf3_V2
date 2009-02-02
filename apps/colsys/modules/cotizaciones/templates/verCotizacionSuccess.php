<?
use_helper("Javascript");

$enBlanco = $cotizacion->enBlanco();


$transport = array('foot', 'bike', 'car', 'plane');
$mode = current($transport); // $mode = 'foot';
$mode = next($transport);    // $mode = 'bike';
$mode = next($transport);    // $mode = 'car';
$mode = prev($transport);    // $mode = 'bike';
$mode = end($transport);     // $mode = 'plane';

?>

<div align="center">
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
<div id="emailForm"  style="display:<?=$enBlanco?"inline":"none"?>;">
	<?
	//echo form_tag( "cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion() ); 
	echo form_remote_tag(array("url"=>"cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion(), 
								"update"=>"emailForm",
								 'loading'  => visual_effect('appear', 'indicator'),
							    'complete' => visual_effect('fade', 'indicator')							
							
						 ));
						 
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
	
	
	<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableForm">	
		<tr>
			<td><div align="left"><strong>Adjuntos:</strong> 
			</div></td>
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
		foreach($archivos as $archivo ){					
		
		?>
		<tr>
			<td>
				<div align="left">
					<input type="checkbox" name="attachments[]" value="<?=$archivo->getCaIdarchivo()?>" checked="checked"> <?=$archivo->getCaNombre()?>
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
