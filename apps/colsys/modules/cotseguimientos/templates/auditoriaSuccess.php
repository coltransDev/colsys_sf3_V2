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
<h1>Cotizaciones </h1>
Datos basados en <?=$numcotizaciones?> cotizaciones
<br />
<table>
	<tr>
		<td valign="top">
			<table width="350" border="1" class="tableList">
				<tr>
					<th scope="col">Fecha</th>
					<th scope="col">Usuario</th>
					<th scope="col">No Cotizacion</th>
				</tr>
				<?
				foreach( $seguimientos as $row )
				{
				?>
				<tr>
					<td><?=$row["ca_fchcreado"]?></td>
					<td><?=$row["ca_usuario"] ."-". $row["ca_idsucursal"]?></td>
					<td><?=$row["ca_consecutivo"]?></td>
				</tr>
				<?
				}
				?>
			</table>
		</td>
	</tr>
</table>
</div>
