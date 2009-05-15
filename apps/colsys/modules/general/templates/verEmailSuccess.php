<div class="content" align="center">
<table border="1" cellspacing="1" width="90%" class="tableList">
	<tbody>
		<tr>
			<th colspan="2">CORREO ELECTR&Oacute;NICO ENVIADO</th>
		</tr>
		<tr>
			<td><div align="left"><strong>Fecha de Enviado:</strong><br>
					<?=$email->getCaFchenvio()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><strong>Usuario que Envi&oacute;:</strong><br>
					<?=$email->getCaUsuenvio()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><strong>Nombre del Usuario:</strong><br>
					<?=$user->getCaNombre()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><strong>Email del Usuario:</strong><br>
					<?=$user->getCaEmail()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><strong>Destinatarios:</strong><br>
					<?=$email->getCaAddress()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><strong>CC.:</strong><br>
						<?=$email->getCaCc()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><strong>Asunto:</strong><br>
					<?=$email->getCaSubject()?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"><strong>Mensaje:</strong><br>
					<?=$email->getCaBodyHtml()?$email->getCaBodyHtml():$email->getCaBody()?>
			</div></td>
		</tr>
		<tr height="5">
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>Ver Adjuntos:
				<table cellspacing="1" width="95%">
					<tbody>
						<tr>
							<td></td>
						</tr>
					</tbody>
				</table></td>
		</tr>
	</tbody>
</table>


</div>