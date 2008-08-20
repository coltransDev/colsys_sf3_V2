<h3>Bienvenido al directorio de Coltrans S.A y Colmas SIA Ltda. </h3>
<form action="http://correo.coltrans.com.co/eGuide/servlet/eGuide" method="post" name="AuthForm" id="AuthForm" >
	<input value="qsmuYjqkcsLq" name="User.context" type="hidden" />
	<input value="eGuide.verifyCredentials" name="Action" type="hidden" />
	<input value="" name="Directory.uid" type="hidden" />
	<input value="" name="User.dn" type="hidden" />
	<table width="75%" border="0" cellpadding="0" cellspacing="0" class="tableForm">
		
		<tr height="20">
			<td width="25%" height="20" valign="bottom" nowrap="nowrap"><div align="left">
				<?=image_tag("logos/logoCOLTRANS316x60.png")?>
			</div></td>
			<td width="25%" rowspan="6" valign="top" nowrap="nowrap"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><h3 align="left" style="color:#FF0000">Importante</h3>
							<div align="left">Por favor tenga en cuenta las siguientes instrucciones para realizar llamadas a otras sucursales,<br />
							S&iacute; el servicio no esta disponible en su oficina, por favor utilice medios alternativos como <strong>Skype </strong>o<strong> Messenger </strong></div></td>
					</tr>
					<tr>
						<td><div align="left">Para llamar desde Bogot&aacute; a <br />
								<ul>
									<li><strong>Medellín:</strong> 804 44 + Ext.</li>
									<li><strong>Cali:</strong> 804 22 + Ext.</li>
									<li><strong>B/quilla.:</strong> 804 55 + Ext.</li>
								</ul>
						</div></td>
						<td><div align="left">Para llamar desde Medell&iacute;n a <br />
								<ul>
									<li><strong>Bogotá:</strong> 804 11 + Ext.</li>
									<li><strong>Cali:</strong> 804 22 + Ext.</li>
									<li><strong>B/quilla.:</strong> 804 55 + Ext.</li>
								</ul>
						</div></td>
					</tr>
					<tr>
						<td><div align="left">Para llamar desde Cali a <br />
								<ul>
									<li><strong>Bogotá:</strong> 804 11 + Ext.</li>
									<li><strong>Medell&iacute;n:</strong> 804 44 + Ext.</li>
									<li><strong>B/quilla.:</strong> 804 55 + Ext.</li>
								</ul>
						</div></td>
						<td><div align="left">Para llamar desde Barranquilla a <br />
								<ul>
									<li><strong>Bogot&aacute;:</strong> 711 11 + Ext.</li>
									<li><strong>Medell&iacute;n:</strong> 711 44 + Ext.</li>
									<li><strong>Cali.:</strong> 711 22 + Ext.</li>
								</ul>
						</div></td>
					</tr>
			</table></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><div align="left">Usuario:<br>
					<?=input_tag("Value1", $sf_user->getUserId())?>
			</div></td>
		</tr>
		<tr >
			<td valign="bottom" ><div align="left">Contrase&ntilde;a:<br>
					<?=input_tag("Value2", "", 'type=password')?>
			</div></td>
		</tr>
		<tr>
			<td><div align="left"></div></td>
		</tr>
		<tr >
			<td  valign="bottom">
				<div align="left">
					<?=submit_tag("Entrar")?>
				</div></td>
		</tr>
		<tr >
			<td  valign="bottom">&nbsp;</td>
		</tr>		
	</table>
</form>
