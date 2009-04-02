<div align="center">
<table class="tableList">
	<tr>
		<th>Grupo</th>
		<th>Rutina</th>
		<th>Opcion</th>
	</tr>	
<?
foreach( $rutinas as $rutina ){
?>
	<tr>
		<td><?=$rutina->getCaGrupo()?></td>
		<td><?=$rutina->getCaRutina()?></td>
		<td><?=$rutina->getCaOpcion()?></td>
		<td><?=$rutina->getCaPrograma()?></td>
	</tr>
<?
}
?>

</table>
</div>