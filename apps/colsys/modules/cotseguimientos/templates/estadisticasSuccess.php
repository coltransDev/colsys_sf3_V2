<?


?>
<br>
<h3>Estadisticas de cotizaciones <?=$fechaInicial?> <?=$fechaFinal?> <br>
<?
if( $usuario ){
	echo "Vendedor: ".$usuario->getCaNombre();
}
if( $sucursal ){
	echo " Sucursal: ".$sucursal;
}
?>
</h3>
<br>
<br>

<table width="200" border="1" class="tableList">
	<tr>
		<th scope="col">Estado</th>
		<th scope="col">Motivo</th>
		<th scope="col">Cantidad</th>
	</tr>
	<?
	$total = 0;
	while( $rs->next() ){
	
	?>	
	<tr>
		<td><?=$rs->getString("ca_estado")?></td>
		<td><?=$rs->getString("ca_motivonoaprobado")?></td>
		<td><?=$rs->getInt("count")?></td>
	</tr>	
	<?	
	$total+=$rs->getInt("count");
	}
	?>
	
	<tr>
		<td><strong>Total</strong></td>
		<td>&nbsp;</td>
		<td><?=$total?></td>
	</tr>
</table>
