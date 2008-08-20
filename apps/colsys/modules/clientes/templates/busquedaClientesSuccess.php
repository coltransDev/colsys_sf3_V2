<?
use_helper("Javascript");
use_helper("Modalbox");

?>
<div align="center" id="resultados">
	<h3>Consulta a maestra de clientes</h3>
	<?=form_tag("clientes/busquedaClientes?formName=".$formName, "name=formBuscarCliente id=formBuscarCliente onSubmit='return false;'")?>	
	<?=input_hidden_tag("opcion", $opcion)?>
	<?=input_hidden_tag("modo", $modo)?>	
	<?=input_hidden_tag("formName", $formName)?>	
	<table cellspacing="1" cellpadding="5" width="450" border="0" class="tableForm">
			<tbody>
				<tr>
					<th colspan="3"><strong>Ingrese un criterio para realizar las busqueda</strong></th>
					<th>
					<?
					if( $opcion=="consignatario" || $opcion=="notify" ){
						echo m_link_to( image_tag("22x22/new.gif") , "clientes/agregarTercero?tipo=".$opcion."&formName=".$formName);
					}
					?>
					</th>
				</tr>
				<tr>
					<th rowspan="2">&nbsp;</th>
					<td rowspan="2"><strong>Buscar por:</strong><br />
						<?=select_tag("modalidad", options_for_select(array("tercero"=>"Nombre del Cliente","contacto"=>"Nombre del Contacto" ,"id"=>"Numero de identificacion" ), "tercero" ), "size=4" )?>						
						 
					</td>
					<td><strong>Que contenga la cadena:</strong><br />
						<?=input_tag("criterio", null, "size=60")?>
					</td>
					<th rowspan="2">
					<?=m_submit_tag("Buscar", "formBuscarCliente", "clientes/busquedaClientes")?></th>
				</tr>				
		</tbody>
	</table>
		<table cellspacing="10">
			<tbody>
				<tr>
					<th><input onclick="Modalbox.hide();" type="button" value="Cancelar" name="accion" /></th>
				</tr>
			</tbody>
	</table>
	</form>
</div>
