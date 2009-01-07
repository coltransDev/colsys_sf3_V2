<div align="center">

<h3>Por favor coloque los criterios de busqueda</h3>
<br />

<form action="<?=url_for("buscar/buscar")?>" method="post">
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
	<!--<tr>
		<td><div align="right">Buscar por </div></td>
		<td><div align="left">
			<?
			//select_tag("buscar_por", options_for_select(array("no_pedido"=>"No. de Pedido", "proveedor"=>"Proveedor",  "hbl_hawb"=>"HBL - HAWB",  "reporte"=>"Reporte"), "no_referencia"))?>
		</div></td>
	</tr>-->
	<tr>
		<td colspan="2"><div align="center"><input type="submit" value="Buscar" class="button" /></div></td>
	</tr>
</table>
</form>
</div>