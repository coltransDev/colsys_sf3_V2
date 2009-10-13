<?

$festivos = Utils::getFestivos();

if( count($listaTareas)>0 ){
	foreach( $listaTareas as $lista ){
		$tareas = $lista->getTareasPendientes( $user );	
	?>
	<br />
	
	<div class="taskListHead_<?=count($listaTareas)==1?"expanded":"collapsed"?>" onclick="expandCollapse( this, 'taskListBody_<?=$lista->getCaIdlistatarea()?>', 'taskListHead')">
	<h3><?=$lista->getCaNombre()?> (<?=count($tareas)?> Tarea<?=count($tareas)!=1?"s":""?>)</h3>
	</div>	
	<div class="nota"><?=$lista->getCaDescripcion()?></div>
	<br />	
	
	<div id="taskListBody_<?=$lista->getCaIdlistatarea()?>" style="display:<?=count($listaTareas)==1?"inline":"none"?>">
	<table width="100%" border="1" class="tableList" >	
		<tr>
			<th width="42%" >Tarea</th>
			<th width="9%" >Enlace</th>
			<th width="23%" >Creada</th>
			<th width="18%" >Tiempo restante *</th>
			<th width="8%" >Prioridad</th>
		</tr>
		<?
		
		foreach( $tareas as $tarea ){
		?>
		<tr>
			<td><?=$tarea->getCaTitulo()?></td>
			<td><a href="<?=url_for("notificaciones/realizarTarea?id=".$tarea->getCaIdtarea())?>">Click aca</a></td>
			<td><?=Utils::fechaMes($tarea->getCaFchcreado("Y-m-d"))." ".$tarea->getCaFchcreado("H:i:s")?></td>
			<td>
				<?			
				/*$diff = $tarea->getTiempoRestante( $festivos  );
				if( substr($diff, 0,1)=="-" ){
					echo "<span class='rojo'>".$diff."</span>";
				}else{
					echo $diff;			
				}*/
				?></td>
			<td><?=$tarea->getPrioridad()?></td>
		</tr>
		<?
		}
		?>
	</table>	
	</div>
	<?
	}
	?>
	<br />
	<br />
	<div class="nota">* Tiempo restante teniendo en cuenta las horas habiles.</div>
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