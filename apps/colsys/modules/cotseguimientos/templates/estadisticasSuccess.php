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
<br />
<br />
<h1>Cotizaciones con trayectos</h1>
Datos basados en <?=$numcotizaciones?> cotizaciones
<br />
<table width="350" border="1" class="tableList">
	<tr>
		<th scope="col">Estado</th>
		<th scope="col">Cantidad de trayectos</th>
        <th scope="col">Cantidad de trayectos con seguimientos</th>
        <th scope="col">Seguimiento</th>
	</tr>
	<?
	$total = 0;
    $total2 = 0;
    echo count($rows);
	foreach( $rows as $row ){
	?>	
	<tr>
		<td><?=$estados[$row["p_ca_etapa"]]?></td>
		<td><?=$row["p_count"]?></td>
        <td><?=$row["s_conseg"]?></td>
        <td><?=$row["s_seguimiento"]?></td>
	</tr>	
	<?	
	$total+=$row["p_count"];
    $total2+=$row["s_conseg"];
	}
	?>	
	<tr>
		<td><b>Total</b></td>
		<td><?=$total?></td>
        <td><?=$total2?></td>
	</tr>
</table>


<br />
<br />
<h1>Cotizaciones sin trayectos</h1>
<br />
<table width="350" border="1" class="tableList">
	<tr>
		<th scope="col">Estado</th>
		<th scope="col">Cantidad de cotizaciones</th>
        <th scope="col">Cantidad de cotizaciones con seguimientos</th>
	</tr>
	<?
	$total = 0;
    $total2 = 0;
	foreach( $rows2 as $row ){
	?>
	<tr>
		<td><?=$estados[$row["c_ca_etapa"]]?></td>
		<td><?=$row["c_count"]?></td>
        <td><?=$row["s_conseg"]?></td>
	</tr>
	<?
	$total+=$row["c_count"];
    $total2+=$row["s_conseg"];
	}
	?>

	<tr>
		<td><b>Total</b></td>
		<td><?=$total?></td>
        <td><?=$total2?></td>
	</tr>
</table>
</div>