<?
echo form_tag("traficos/verStatusCarga?modo=".$modo, "name=cuadroStatusForm id=cuadroStatusForm" );
?>
<div align="center">
<table width="50%" border="1" class="tableList">
	<tr>
		<th colspan="2" scope="col">Modulo de status de tr&aacute;ficos </th>
	</tr>

	<tr>
		<td><div align="right"><strong>Cliente:</strong></div></td>
		<td><span class="mostrar">
			<?=include_component("clientes", "comboClientes" )?>			
		</span></td>
	</tr>
	<tr>
		<td colspan="2" class="row1"><div align="center"><strong><?=radiobutton_tag("ver", "activos", true)?> Ver reportes activos: </strong></div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><strong>
			<?=radiobutton_tag("ver", "reporte", false)?>
Por n&uacute;mero de reporte </strong><br />
<?=input_tag("numreporte")?>
</div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><?=submit_tag("continuar", "class=button")?></div></td>
	</tr>
</table>
</div>
</form>
