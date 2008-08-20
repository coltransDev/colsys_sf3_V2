<?
echo form_tag("buscar/buscar");
?>
<table width="70%" border="1" class="table1">
	<tr>
		<th colspan="2" scope="col">Por favor coloca los criterios de busqueda </th>
	</tr>
	<tr>
		<td width="50%"><div align="right">Criterio</div></td>
		<td width="50%"><div align="left">
			<?=input_tag("criterio")?>
		</div></td>
	</tr>
	<tr>
		<td><div align="right">Buscar por </div></td>
		<td><div align="left">
			<?=select_tag("buscar_por", options_for_select(array("no_pedido"=>"No. de Pedido", "proveedor"=>"Proveedor",  "hbl_hawb"=>"HBL - HAWB",  "reporte"=>"Reporte"), "no_referencia"))?>
		</div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><?=submit_tag("Buscar","class=button")?></div></td>
	</tr>
</table>
</form>