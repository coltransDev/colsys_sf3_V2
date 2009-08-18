<div class="content" align="center">	
	

	<table width='830' cellspacing="1" border="0">
		<tr>
			<td class="partir" style='text-align:center; font-weight:bold; background:#FF0000;' >Favor Imprimir en Tama�o <b>CARTA</b>. Configure su impresora 8,5 x 11 pulg. � 216 mm x 279 mm</td>
		</tr>
	</table>
	
	<iframe src ='/colsys_php/reporteneg.php?id=<?=$reporte->getCaIdreporte()?>' width='830' height='650' ></iframe>
	<br />
	<br />
	<?
	
	if( $asignaciones || $reporte->getCaIdTareaRext()){
	?>
	<table width="50%" border="0" class="tableList">
		<tr>			
			<th width="28%" scope="col"><b>Acci&oacute;n<b></th>
			<th width="11%" scope="col"><b>Terminada</b></th>
			<th width="31%" scope="col"><b>Usuario</b></th>
			<th width="30%" scope="col"><b>e-mail</b></th>
		</tr>
		<?	
		if( $asignaciones ){	
			foreach( $asignaciones as $asignacion ){	
				$tarea = $asignacion->getNotTarea();	
				$asignacionesTarea  = $tarea->getNotTareaAsignacions();
				foreach( $asignacionesTarea as $asignacionTarea ){		
					$usuario = UsuarioPeer::retrieveByPk( $asignacionTarea->getCaLogin() );
					?>		
					<tr>
										
						<td>Ver reporte</td>
						<td><?=$tarea->getCaFchterminada()?image_tag("16x16/button_ok.gif"):image_tag("16x16/button_cancel.gif")?></td>	
						<td><?
								echo $usuario->getCaNombre();				
							?></td>
						<td><?
								echo $usuario->getCaEmail();				
							?></td>
					</tr>
					<?
				}
			}
		}
		
		if( $reporte->getCaIdTareaRext() ){
			$tarea = NotTareaPeer::retrieveByPk( $reporte->getCaIdTareaRext() );
			$asignacionesTarea  = $tarea->getNotTareaAsignacions();
			$i=0;
			foreach( $asignacionesTarea as $asignacionTarea ){
					
				$usuario = UsuarioPeer::retrieveByPk( $asignacionTarea->getCaLogin() );
				?>		
			<tr>
				<?
				if( $i==0 ){
				?>				
				<td rowspan="<?=count($asignacionesTarea )?>">Crear reporte al exterior</td>
				<td rowspan="<?=count($asignacionesTarea )?>"><?=$tarea->getCaFchterminada()?image_tag("16x16/button_ok.gif"):image_tag("16x16/button_cancel.gif")?></td>	
				<?
				}
				?>
				<td><?
						echo $usuario->getCaNombre();				
					?></td>
				<td><?
						echo $usuario->getCaEmail();				
					?></td>
			</tr>
		<?
                $i++;
            }
		}
        ?>
        </table>
        <?
	}
	if( count( $logs )>0  ){
	?>
	<br />
	<a href="#registro_aperturas" onclick="document.getElementById('registro_aperturas').style.display=''">Ver registro de aperturas</a>
	<br />
	<div id="registro_aperturas" style="max-height:150px; width:830px; overflow:auto; display:none" >
	<h3>Registro de aperturas</h3>
	<br />
	<table width='800' cellspacing="1" border="0" class="tableList">
		<tr>
			<th width="311" >Usuario </th>
			<th width="270" >Abierto</th>
			
		</tr>
		<?		
		foreach( $logs as $log ){
			$usuario = $log->getUsuario();			
		?>
		<tr>
			<td ><?=Utils::replace($usuario->getCaNombre())?></td>
			<td ><?=Utils::fechaMes($log->getCaFchEvento("Y-m-d"))." ".$log->getCaFchEvento("H:i:s")?></td>
		</tr>
		<?
		}
		?>
	</table>
	<?
	}
	?>
	</div>
	<br>
	
</div>