<?
use_helper("Javascript");
?>
<script language="javascript">
	function actualizar( referencia )  { 
				
		<?=remote_function(	array('update'   => 'workPanel',
									'url'      => "digitalFile/verArchivos",
									'with'	=>  "'referencia='+referencia",
									'loading'  => visual_effect('appear', 'indicator'),
									'complete' => visual_effect('fade', 'indicator'),
									'script' => true,
																	) )?>;
		
		
	}
		
</script>
<table width="95%" border="0" class="table1">
	<tr>
		<td width="40%" valign="top">

		<?=form_remote_tag(   array('update'   => 'referencias',
    						'url'      => "digitalFile/busquedaReferencia",
							'loading'  => visual_effect('appear', 'indicator'),
						    'complete' => visual_effect('fade', 'indicator'),
							))?>
		
		<table width="90%" border="1">
			<tr>
				<th colspan="2">Busqueda</th>
				</tr>
			<tr>
				<td width="66%" class="mostrar">Tipo de busqueda </td>
				<td width="34%" class="mostrar"><b>Buscar por:</b><br />
					<select size="4" name="opcion">
						<option value="ca_referencia" selected="selected">N&uacute;mero de Referencia</option>
						
						<option value="ca_factura" selected="selected">N&uacute;mero de Factura</option>
					</select></td>
				</tr>
			<tr>
				<td class="mostrar">Criterio</td>
				<td class="mostrar"><?=input_tag("criterio")?></td>
				</tr>
			<tr>
				<td colspan="2" align="center" class="mostrar" ><?=submit_tag("Buscar", "class=button")?></td>
				</tr>
		</table>
		</form>		</td>
		<td width="19%" valign="top"><div id="referencias" style="overflow:auto; max-height:500px; ">
		<?=include_partial("digitalFile/verDirectorios",array( "referencias"=>$referencias ))?>
						</div>		</td>
		<td width="41%" valign="top"><div id="panelArchivos"></div></td>
	</tr>
</table>
