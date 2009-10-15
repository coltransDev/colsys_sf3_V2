<?


?>
<div align="center">
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

<table width="300" border="1" class="tableList">
	<tr>
		<th scope="col">Estado</th>
		<th scope="col">Cantidad de trayectos</th>
	</tr>
	<?
	$total = 0;
	foreach( $rows as $row ){
        
	?>	
	<tr>
		<td><?=$estados[$row["p_ca_etapa"]]?></td>
		<td><?=$row["p_count"]?></td>
	</tr>	
	<?	
	$total+=$row["p_count"];
	}
	?>
	
	<tr>
		<td><b>Total</b></td>
		<td><?=$total?></td>
	</tr>
</table>
</div>