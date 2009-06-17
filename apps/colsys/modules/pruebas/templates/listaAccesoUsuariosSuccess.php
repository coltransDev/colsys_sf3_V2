<?

?>

<div class="content" align="center">

<h3 ><?=$rutina->getCaOpcion()?></h3>

<?=$rutina->getCaDescripcion()?>
<br>


<br>

<table width="100%" border="0" class="tableList">
	<tr>
		<th>Nombre</th>
		<th>Cargo</th>
		<th>Departamento</th>
		<th>Sucursal</th>
	</tr>
	<?
	foreach( $usuarios as $usuario ){
	?>
	<tr>
		<td><?=$usuario->getCaNombre()?></td>
		<td><?=$usuario->getCaCargo()?></td>
		<td><?=$usuario->getCaDepartamento()?></td>
		<td><?=$usuario->getSucursal()->getCaNombre()?></td>
	</tr>
	<?
	}
	?>	
</table>
</div>