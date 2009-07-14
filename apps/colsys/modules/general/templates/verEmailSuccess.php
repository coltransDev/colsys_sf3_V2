<?
use_helper("MimeType");
?>
<div class="content" align="center">
<table border="1" cellspacing="1" width="90%" class="tableList">
	<tbody>
		<tr>
			<th colspan="2">CORREO ELECTR&Oacute;NICO ENVIADO</th>
		</tr>
		<tr>
			<td><div align="left"><b>Fecha de Enviado:</b><br>
					<?=$email->getCaFchenvio()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><b>Usuario que Envi&oacute;:</b><br>
					<?=$email->getCaUsuenvio()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><b>Nombre del Usuario:</b><br>
					<?=$user->getCaNombre()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><b>Email del Usuario:</b><br>
					<?=$user->getCaEmail()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><b>Destinatarios:</b><br>
					<?=$email->getCaAddress()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><b>CC.:</b><br>
						<?=$email->getCaCc()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><b>Asunto:</b><br>
					<?=$email->getCaSubject()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><b>Mensaje:</b><br>
					<?=$email->getCaBodyHtml()?$email->getCaBodyHtml():$email->getCaBody()?>
			</div></td>
		</tr>
		
		<?
		
		$attahcments = $email->getEmailAttachments();
		if( count($attahcments)>0 || $email->getCaAttachment() ){
		?>
		<tr>
			<td><b>Adjuntos:</b>
				<table cellspacing="1" width="95%">
					<tbody>
						<tr>
							<td>
							<?
							
							foreach( $attahcments as $attahcment ){
								echo link_to(mime_type_icon($attahcment->getCaHeaderFile())." ".$attahcment->getCaHeaderFile(), "general/verAttachmentDB?id=".$attahcment->getCaIdattachment())."<br />";
							}
							?>
							</td>
						</tr>
					</tbody>
				</table></td>
		</tr>
		<?
		}
		?>
	</tbody>
</table>


</div>