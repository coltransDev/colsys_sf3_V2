<?
echo form_tag("general/buscarCotizacion");
?>	
	<table width="450" border="0" cellspacing="1" cellpadding="5">
		<tr>
			<th colspan="4" style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</th>
		</tr>
		<tr>
			<th rowspan="2">&nbsp;</th>
			<td class="listar" rowspan="2">
				<b>Buscar por:</b><br />
				<?=select_tag("modalidad",  options_for_select(array("Mis Cotizaciones"=>"Mis Cotizaciones","Nombre del Cliente"=>"Nombre del Cliente" ), "Mis Cotizaciones" ), "size=4" );	?>
				<!--<select name='modalidad' size="4">
					<option value='Mis Cotizaciones' selected="selected">Mis Cotizaciones </option>
					<option value='Nombre del Cliente'>Nombre del Cliente </option>
					<option value='Nombre del Contacto'>Nombre del Contacto </option>
					<option value='Asunto'>Asunto </option>
					<option value='Por Vendedor'>Por Vendedor </option>
					<option value='Nro.de Cotizaci&oacute;n'>Nro.de Cotización </option>
				</select>-->
			
			</td>
			<td class="listar"><b>Que contenga la cadena:</b><br />
				<?=input_tag("criterio" , null, "size=60")?>
				</td>
			<th rowspan="2">
				
			<?=submit_tag("Buscar")?>
			</th>
		</tr>
		<tr>
			<td class="listar"></td>
		</tr>
		<tr height="5">
			<td class="captura" colspan="4"></td>
		</tr>
	</table>
	<table cellspacing="10">
		<tr>
			<th><input class="button" type='button' name='accion' value='Cancelar' onclick="javascript:window.parent.frames.cuadroBusqueda.style.display = 'none'" /></th>
		</tr>
	</table>
</form>
