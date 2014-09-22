<?
use_helper("MimeType");
$email = $sf_data->getRaw("email");
?>
<div class="content" align="center">
<b><?=$email->getCaSubject()?></b>
<br />
<table width="90%" border="0" cellspacing="0" cellpadding="0" class="tableList">
	<tr>
		<td><div align="left">
                <?
                if($email->getCaFchenvio()){
                ?>
                <b>Enviado: </b><br> <?=$user->getCaNombre()?> el <?=Utils::fechaMes( $email->getCaFchenvio() )?></div>
                <?
                }else{
                ?>
                <b>Mensaje en Cola</b></div>
                <?
                }
                ?>
        </td>

	</tr>
    <?
	if($email->getCaAddress()){
	?>
	<tr>
		<td><div align="left"><b>Para</b><br><?=$email->getCaAddress()?></div></td>
	</tr>
	<?
	}
	if( $email->getCaCc() ){
	?>
	<tr>
		<td><div align="left"><b>CC</b>
			<br>
		<?=$email->getCaCc()?></div></td>
	</tr>
	<?
	}
	?>
		<tr>
			<td><div align="left">
					<?=$email->getCaBodyhtml()?$email->getCaBodyhtml():$email->getCaBody()?>
			</div></td>
		</tr>		
		<?
		if( $email->getCaAttachment() ){
            $attachments = explode("|",$email->getCaAttachment());
		?>
		<tr>
			<td><b>Adjuntos:</b>
				<table cellspacing="1" width="95%">
					<tbody>
						<tr>
							<td>
							<?
							foreach( $attachments as $attachment ){
                            if( substr($attachment, -3,3)==".gz"){
                                $nombreArchivo = substr($attachment,0, strlen($attachment)-3);
                            }else{
                                $nombreArchivo = $attachment;
                            }
								echo link_to(mime_type_icon(basename($nombreArchivo))." ".basename($nombreArchivo), "gestDocumental/verArchivo?idarchivo=".base64_encode($nombreArchivo))."<br />";
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