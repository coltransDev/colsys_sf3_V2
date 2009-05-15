<div class="content">
<?
foreach( $listaTareas as $lista ){
?>
<h3><?=$lista->getCaNombre()?></h3>
<br />
<table width="100%" border="1" class="tableList" >	
	<tr>
		<th width="25%" >Tarea</th>
		<th width="8%" >Enlace</th>
		<th width="22%" >Fecha Creaci&oacute;n</th>
		<th width="15%" >Vencimiento</th>
		<th width="14%" >Tiempo restante </th>
		<th width="16%" >Prioridad</th>
	</tr>
	<?
	$tareas = $lista->getTareasPendientes();	
	foreach( $tareas as $tarea ){
	?>
	<tr>
		<td><?=$tarea->getCaTitulo()?></td>
		<td><?=$tarea->getCaUrl()?></td>
		<td><?=$tarea->getCaFchcreado()?></td>
		<td><?=$tarea->getCaFchvencimiento()?></td>
		<td>&nbsp;</td>
		<td><?=$tarea->getCaPrioridad()?></td>
	</tr>
	<?
	}
	?>
</table>
<?
}
?>
</div>