<?

$festivos = Utils::getFestivos();

if( count($listaTareas)>0 ){
	foreach( $listaTareas as $lista ){
	?>
	<br />
	<h3><?=$lista->getCaNombre()?></h3>
	
	<?=$lista->getCaDescripcion()?>
	<br />
	<br />
	<table width="100%" border="1" class="tableList" >	
		<tr>
			<th width="22%" >Tarea</th>
			<th width="11%" >Enlace</th>
			<th width="19%" >Fecha Creaci&oacute;n</th>
			<th width="18%" >Vencimiento</th>
			<th width="21%" >Tiempo restante *</th>
			<th width="9%" >Prioridad</th>
		</tr>
		<?
		$tareas = $lista->getTareasPendientes( $user );	
		foreach( $tareas as $tarea ){
		?>
		<tr>
			<td><?=$tarea->getCaTitulo()?></td>
			<td><a href="<?=$tarea->getCaUrl()?>">Click aca</a></td>
			<td><?=Utils::fechaMes($tarea->getCaFchcreado("Y-m-d"))." ".$tarea->getCaFchcreado("H:i:s")?></td>
			<td><?=Utils::fechaMes($tarea->getCaFchvencimiento("Y-m-d"))." ".$tarea->getCaFchvencimiento("H:i:s")?></td>
			<td>
				<?			
				$diff = $tarea->getTiempoRestante( $festivos  );					
				if( substr($diff, 0,1)=="-" ){
					echo "<span class='rojo'>".$diff."</span>";
				}else{
					echo $diff;			
				}
				?></td>
			<td><?=$tarea->getPrioridad()?></td>
		</tr>
		<?
		}
		?>
	</table>	
	<?
	}
	?>
	<br />
	<br />
	* Tiempo restante teniendo en cuenta las horas habiles.
	<?
}else{
?>
<br />
<br />
<br />


<div align="center">
<h3>No tiene tareas pendientes en este momento</h3>
</div>
<br>

<?	
}
?>