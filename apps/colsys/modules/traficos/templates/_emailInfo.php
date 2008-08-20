<h3><?=$email->getCaSubject()?></h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableList">
	<?
	if($email->getCaAddress()){
	?>
	<tr>
		<td><strong>Para</strong><br><?=$email->getCaAddress()?></td>
	</tr>
	<?
	}
	if( $email->getCaCc() ){
	?>
	<tr>
		<td><strong>CC</strong>
			<br>
		<?=$email->getCaCc()?></td>
	</tr>
	<?
	}
	?>
	
	
</table>
<hr />