<?

?>
<table width="90%" border="0" class="table1">
	<tr>
		<th  scope="col">Email</th>
	</tr>
	<tr>
		<td ><div align="left"><strong>Fecha</strong><br />
				<?=$email->getCaFchEnvio()?>
		</div></td>
	</tr>
	<tr>
		<td ><div align="left"><strong>Enviado por:</strong><br />
				<?=$email->getCaFromname()?>
				&lt;
				<?=$email->getCaFrom()?>
			&gt;</div></td>
	</tr>
	<tr>
		<td ><div align="left"><strong>Destinatarios</strong>:<br />
				<?=$email->getCaAddress()?>
		</div></td>
	</tr>
	<tr>
		<td ><div align="left"><strong>CC:</strong><br />
				<?=$email->getCaCc()?>
		</div></td>
		
	</tr>
	<tr>
		<td ><div align="left"><strong>Asunto:</strong>
				<br />
				<?=Utils::replace($email->getCaSubject())?>
		</div></td>
	</tr>
	<tr>
		<td ><div align="left"><strong>Mensaje:</strong><br />
		</div>
			<div style="max-height: 350px; overflow:auto ">
			<?=$email->getCaBody()?>
			</div>
		</td>
	</tr>
	
</table>
