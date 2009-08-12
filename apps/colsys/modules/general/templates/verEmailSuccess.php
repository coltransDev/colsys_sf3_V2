<?
use_helper("MimeType");
?>

<div class="content" align="center">
<h3><?=$email->getCaSubject()?></h3>
<br />
<table width="90%" border="0" cellspacing="0" cellpadding="0" class="tableList">
	<tr>
		<td><b>Enviado: </b><br> <?=$user->getCaNombre()?> el <?=$email->getCaFchenvio()?> </td>
	</tr>
    <?
	if($email->getCaAddress()){
	?>
	<tr>
		<td><b>Para</b><br><?=$email->getCaAddress()?></td>
	</tr>
	<?
	}
	if( $email->getCaCc() ){
	?>
	<tr>
		<td><b>CC</b>
			<br>
		<?=$email->getCaCc()?></td>
	</tr>
	<?
	}
	?>


		<tr>
			<td><div align="left">
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
	
</table>


</div>