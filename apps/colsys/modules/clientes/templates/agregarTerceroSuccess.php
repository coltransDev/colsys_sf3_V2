<?
use_helper("Object");
use_helper("Modalbox");
use_helper("Validation");

echo form_tag("clientes/guardarTercero?tipo=".$tipo, "name=form1 id=form1");
	echo input_hidden_tag("formName",$formName );
	echo input_hidden_tag("id",$tercero->getCaIdTercero() );
?>
<table width="90%" border="1">
	<tr>
		<th colspan="2">Nuevo <?=$tipo ?></th>		
	</tr>
	<tr>
		<td width="50%"><div align="right"><b>Nombre</b></div></td>
		<td width="50%"><?=form_error("nombre")?><?=input_tag("nombre", $tercero->getCaNombre(), "maxlength=80")?></td>
	</tr>
	<tr>
		<td><div align="right"><b>Identificaci&oacute;n (RUC)</b></div></td>
		<td><?=form_error("identificacion")?><?=input_tag("identificacion", $tercero->getCaIdentificacion(), "maxlength=25")?></td>
	</tr>
	<tr>
		<td><div align="right"><b>Direcci&oacute;n</b></div></td>
		<td><?=form_error("direccion")?><?=input_tag("direccion", $tercero->getCaDireccion(), "maxlength=255")?></td>
	</tr>
	<tr>
		<td><div align="right"><b>Telefono</b></div></td>
		<td><?=form_error("telefono")?><?=input_tag("telefono", $tercero->getCaTelefonos(), "maxlength=30")?></td>
	</tr>
	<tr>
		<td><div align="right"><b>Fax</b></div></td>
		<td><?=form_error("fax")?><?=input_tag("fax", $tercero->getCaFax(), "maxlength=30")?></td>
	</tr>
	<tr>
		<td><div align="right"><b>e-mail</b></div></td>
		<td><?=form_error("email")?><?=input_tag("email", $tercero->getCaEmail(), "maxlength=250")?></td>
	</tr>
	<tr>
		<td><div align="right"><b>Contacto</b></div></td>
		<td><?=form_error("contacto")?><?=input_tag("contacto", $tercero->getCaContacto(), "maxlength=60")?></td>
	</tr>
	<tr>
		<td><div align="right"><b>Ciudades</b></div></td>
		<td><?=form_error("ciudad")?><?=select_tag("ciudad", objects_for_select($ciudades, "getId", "getPaisCiudad", $tercero->getCaIdCiudad()) )?></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center">
		<?=$tipo?>
			<?=m_submit_tag("Crear", "form1", "clientes/guardarTercero?tipo=".$tipo)?>
		&nbsp;
			<input onclick="Modalbox.hide();" type="button" value="Cancelar" name="accion" />
		</div></td>
	</tr>
</table>
</form>

