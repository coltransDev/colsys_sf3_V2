<div align="center">

<h3>Por favor coloque los criterios de busqueda</h3>
<br />

<form action="<?=url_for("buscar/index")?>" method="post">
<table width="50%" border="1" class="table1">
	<tr>
		<th colspan="2" scope="col">&nbsp; </th>
	</tr>
	<tr>
		<td width="50%"><div align="right">Criterio</div></td>
		<td width="50%"><div align="left">
			<input type="text" name="criterio" />
		</div></td>
	</tr>
	<tr>
		<td><div align="right">Buscar por </div></td>
		<td><div align="left">
			<select name="buscar_por" id="buscar_por">
                <option value="hbl_hawb">HBL</option>
                <option value="reporte">Reporte</option>
				<option value="no_pedido">No. de Orden/Pedido</option>
				<option value="proveedor">Proveedor</option>
			</select>
		</div></td>
	</tr>	
	<tr>
		<td colspan="2"><div align="center"><input type="submit" value="Buscar" class="button" /></div></td>
	</tr>
</table>
</form>
</div>