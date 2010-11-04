<?

$festivos = TimeUtils::getFestivos();

if( count($listaTareas)>0 ){
?>
<div class="content-box">
<h5>TAREAS PENDIENTES</h5>
    <div class="content-box">
        <p>Usted tiene las siguientes tareas:</p>
<?
	foreach( $listaTareas as $lista ){
		$tareas = $lista->getTareasPendientes( $user );	
	?>
	<br />
	
	<div class="taskListHead_<?=count($listaTareas)==1?"expanded":"collapsed"?>" onclick="expandCollapse( this, 'taskListBody_<?=$lista->getCaIdlistatarea()?>', 'taskListHead')">
        <div class="qtip" title="<?=$lista->getCaDescripcion()?>">
            <b><?=$lista->getCaNombre()?> (<?=count($tareas)?> Tarea<?=count($tareas)!=1?"s":""?>)</b>
        </div>
	</div>	
	<div class="nota"></div>
	<br />	
	
	<div id="taskListBody_<?=$lista->getCaIdlistatarea()?>" style="display:<?=count($listaTareas)==1?"inline":"none"?>">
	<table width="100%" border="0"  >
		
		<?
		
		foreach( $tareas as $tarea ){
		?>
		<tr>
			<td width="75%"><div class="qtip" title="<?=$tarea->getCaTexto()?>"><?=link_to( $tarea->getCaTitulo(), "notificaciones/realizarTarea?id=".$tarea->getCaIdtarea() )?></div></td>
			
			<td width="25%"><?=Utils::fechaMes($tarea->getCaFchcreado())?></td>
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
	</div>
 </div>
<?
}
?>