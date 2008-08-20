<?
use_helper("Validation");
echo form_tag("cuenta/cambiarClave");
?>
<table width="70%" border="0" cellspacing="0" cellpadding="0" class="table1">
	<tr>
		<th colspan="2" scope="col">Cambio de clave </th>
	</tr>
	<tr>
		<td width="50%"><div align="right"><strong>Clave anterior </strong></div></td>
		<td width="50%"><div align="left"><?=form_error("clave_ant")?><?=input_tag("clave_ant", "", "type=password")?></div></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Nueva clave </strong></div></td>
		<td><div align="left"><?=form_error("clave")?><?=input_tag("clave", "", "type=password")?></div></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Confirme la nueva clave </strong></div></td>
		<td><div align="left"><?=form_error("clave2")?><?=input_tag("clave2", "", "type=password")?></div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><?=submit_tag("Continuar", "class=button")?></div></td>
	</tr>
</table>
</form>