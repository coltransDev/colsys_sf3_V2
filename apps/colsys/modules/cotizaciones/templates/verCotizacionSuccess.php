<?
use_helper( "MimeType");

$enBlanco = $cotizacion->enBlanco();

?>

<div align="center" class="content">  
<?

?>
<script language="javascript" type="text/javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){ 
			document.getElementById('emailForm').style.display="inline"
		}else{
			document.getElementById('emailForm').style.display="none"
		}
	}
	
	function verificarInfo(){
		if( document.getElementById("checkObservaciones").value == "1" ){
			if( document.getElementById("observaciones_idg").value =="" ){
				alert( "Por favor indique el motivo por el cual sobrepaso el limite de tiempo establecido" );
				return false;
			}
		}
		return  true;
	}
	
</script>
<?
if( !$cotizacion->getCaUsuanulado() ){
?>
<div id="emailForm"  style="display:<?=$enBlanco?"inline":"none"?>;">
	<form name="form1" id="form1" method="post" action="<?=url_for("cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion())?>" onsubmit="return verificarInfo()">
		<input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
	
	<?					 
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
			<th><div align="left"><b>Adjuntos:</b> 
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
	<br />
	<?	 
	if( $tarea ){
		if( !$tarea->getCafchterminada() ){
		?>
		<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">	
			<tr>
				<th><div align="left"><b>IDG Oferta y Contrataci&oacute;n:</b> 
				</div></th>
			</tr>		
			<tr>
				<td><b>Fecha de solicitud:</b>
					<?=Utils::fechaMes( $tarea->getCafchcreado("Y-m-d") ) ?>
					<?=$tarea->getCafchcreado("H:i:s")?></td>
			</tr>
			<tr>
				<td>
					Tiempo restante
					<?			
					$festivos = Utils::getFestivos();
					$diff = $tarea->getTiempoRestante( $festivos );					
					if( substr($diff, 0,1)=="-" ){
						echo "<span class='rojo'>".$diff."</span>";
						?>
						<script language="javascript" type="text/javascript">
							document.getElementById("checkObservaciones").value = "1";
						</script>
						<?
					}else{
						echo $diff;			
					}
					?>				</td>
			</tr>
			<tr>
				<td>
					Observaciones
					<input type="text" value="<?=$tarea->getCaObservaciones()?>" name="observaciones_idg" id="observaciones_idg" size="100" />				</td>
			</tr>		
		</table>	
		<br />
		<?
		}else{
		?>
		<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">	
			<tr>
				<th><div align="left"><b>IDG Oferta y Contrataci&oacute;n:</b> 
				</div></th>
			</tr>		
			<tr>
				<td>					
					<b>Fecha de solicitud:</b> <?=Utils::fechaMes( $tarea->getCafchcreado("Y-m-d") ) ?>  <?=$tarea->getCafchcreado("H:i:s")?>
					<br />
					<b>Fecha de presentaci&oacute;n:</b> <?=Utils::fechaMes( $tarea->getCafchterminada("Y-m-d") ) ?> <?=$tarea->getCafchterminada("H:i:s")?>	
					<br />
					<b>Horas habiles:</b> 
					<?
					$festivos = Utils::getFestivos();
					echo $tarea->getTiempo( $festivos );				
					?>
									
				</td>
			</tr>
			<?
			if($tarea->getCaObservaciones() ){
			?>
			<tr>
				<td>
					Observaciones: 
					<?=$tarea->getCaObservaciones()?>
				</td>
			</tr>
			<?
			}
			?>		
		</table>	
		<br />
		<?		
		}
	}
	?>

	<div align="center"><input type="submit" name="commit" value="Enviar" /></div><br /><br />
	
</div>


<? 
}
if( !$enBlanco ){
?>	
<iframe src="<?=url_for("cotizaciones/generarPDF?id=".$cotizacion->getCaIdcotizacion()."&token=".md5(time()))?>" width="830px" height="650px"></iframe>

<?
}else{
	if( $cotizacion->getCaUsuanulado() ){
	?>
		<h3>ANULADO</h3>
	<?
	}
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
		<th>Email</th>			
	</tr>
<?
	foreach( $emails as $email ){
		?>
		<tr >
			<td><?=$email->getCaFchEnvio()?></td>			
			<td>			
			<?=$email->getCaSubject()?></td>			
			<td><?=$email->getCaAddress()?></td>
			
			<td>
				<a href='#' onClick=window.open('<?=url_for("general/verEmail?id=".$email->getCaIdemail())?>')><?=image_tag("22x22/email.gif")?></a>
			</td>			
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
