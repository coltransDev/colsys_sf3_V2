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
		<th>Nivel</th>
	</tr>
	<?
	foreach( $usuarios as $usuario ){
	$nivel = $usuario->getNivelAcceso( $rutina->getCaRutina() );
		
	if( isset( $rutinasNivel[ $nivel ] )){
		$acceso = $rutinasNivel[ $nivel ];
	}else{
		$acceso = $nivel;
	}
	
	?>
	<tr>
		<td><?=$usuario->getCaNombre()?></td>
		<td><?=$usuario->getCaCargo()?></td>
		<td><?=$usuario->getCaDepartamento()?></td>
		<td><?=$usuario->getSucursal()->getCaNombre()?></td>
		<td><?=$acceso?></td>
	</tr>
	<?
	}
	?>	
</table>
</div>