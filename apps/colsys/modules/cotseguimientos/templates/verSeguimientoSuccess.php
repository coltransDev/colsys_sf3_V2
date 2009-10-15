<div align="center" class="content">

<h3>Seguimientos Cotizaci&oacute;n No <?=$cotizacion->getCaConsecutivo()?></h3>

<br />
<table width="80%" border="0" class="tableList">
	
	<?
	foreach( $productos as $producto ){
	
		$tarea = $producto->getNotTarea();
		?>
		<tr>
			<th colspan="5"><div align="left">
				<b>Trayecto:</b>
				<?=Utils::replace($producto->__toString())?>
			</div></th>
		</tr>
		
		<tr class="row0">
			<td width="12%"><b>Etapa</b></td>
			<td width="14%"><b>Usuario</b></td>
			<td width="16%"><b>Fecha</b></td>
			<td width="39%"><b>Seguimiento</b></td>
			<td width="19%">
				<?
				
				echo link_to(image_tag("22x22/todo.gif")." Nuevo seguimiento", "cotseguimientos/formSeguimiento?idcotizacion=".$producto->getCaIdcotizacion()."&idproducto=".$producto->getCaIdproducto());
								
				?></td>
		</tr>				
		<?		
		$tarea = $producto->getNotTarea();
        
		if( $tarea && $tarea->getCaIdtarea() && !$tarea->getCaFchterminada() ){
		?>
		<tr class="row0">			
            <td colspan="5"><?=image_tag("22x22/alert.gif")?> Se le recordara hacer un seguimiento el d&iacute;a <?=Utils::fechaMes(Utils::parseDate($tarea->getCaFchvencimiento(),"Y-m-d"))?> </td>
		</tr>
		<?	
		}
		
		$seguimientos = $producto->getSeguimientos();		
		
		if( count($seguimientos)==0 ){
		?>
		<tr>			
			<td colspan="5">No se han creado seguimientos para este trayecto</td>			
		</tr>
		<?		
		}
				
		foreach( $seguimientos as $seguimiento ){		
		?>
		<tr>
			<td><?=$seguimiento->getEtapa();?></td>
			<td><?=$seguimiento->getUsuario()->getCaNombre()?></td>
			<td><?=Utils::fechaMes($seguimiento->getCaFchseguimiento())?></td>
			<td colspan="2">	
			<?=$seguimiento->getCaSeguimiento()?></td>
		</tr>
		<?
		}
	
	}
	?>	
</table>
</div>