<table width="100%" border="0">
	<tr>
		<td width="26%" valign="top">
		<div class="post-info" align="left">
		 	<b>Informaci&oacute;n general</b><br />				
			<?					
					if( $reporte->getCaUsuAnulado() ){
						echo "<b>Anulado por:</b> ".$reporte->getCaUsuAnulado()." ".$reporte->getCaFchAnulado();
					}
					?>					
					<b>Transporte:</b> <?=$reporte->getCaTransporte()?><br />
					<b>Modalidad:</b> <?=$reporte->getCaModalidad()?><br />					
					<b>Orden:</b> <?=$reporte->getCaOrdenClie()?>				
				<?
					$numReferencia = $reporte->getNumReferencia();
					if( $numReferencia ){
						echo "<br /><b>Referencia:</b> ".$numReferencia; 						
					}				
				?><br />
					<?
					if( $reporte->getETS() ){
					?>	
					<b>ETS:</b> <?=Utils::fechaMes($reporte->getETS("Y-m-d"))?><br />
					<?
					}
					if( $reporte->getETA() ){
					?>			
					<b>ETA:</b> <?=Utils::fechaMes($reporte->getETA("Y-m-d"))?><br />
					<?
					}
					?>
					<b>Piezas:</b> <?=$reporte->getPiezas()?><br />
					<b>Peso:</b> <?=$reporte->getPeso()?><br />
					<b>Volumen:</b> <?=$reporte->getVolumen()?><br />
					<b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"HBL:":"HAWB:"?></b> <?=$reporte->getDocTransporte()?><br />	
					<b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"MN:":"Vuelo:"?></b> <?=$reporte->getIdNave()
										
					?><br />
			
		</div>
		<br />
		<div class="post-info" align="left">
		<b>Seguimientos</b><br />	
		<?
		$tarea = $reporte->getNotTarea();
		
		$url = "/traficos/formSeguimiento?modo=".$modo."&reporte=".$reporte->getCaConsecutivo();
		
		if( $tarea && !$tarea->getCaFchterminada() ){
			echo Utils::fechaMes($tarea->getCaFchvencimiento("Y-m-d"))."<br />";
			echo $tarea->getCaTexto()."<br />";
			echo link_to(image_tag("22x22/todo.gif")." Editar", $url);		
		}else{
			echo "No se ha creado ning&uacute;n seguimiento.<br />";
			echo link_to(image_tag("22x22/todo.gif")." Nuevo", $url);
		}
			
		?>	
		</div>
		<br />
		
		<?
		if( $reporte->getCaImpoexpo()==Constantes::IMPO ){
		?>
		<div class="post-info" align="left">
		<b>Reportes al exterior</b><br />	
		<?
			if( $reportesExt ){
				foreach( $reportesExt as $reporteExt ){
					$txt = 	$reporteExt->getCausuenvio()." ".$reporteExt->getCaFchenvio();
				?>
				<a href='#' onClick='window.open("<?=url_for("general/verEmail?id=".$reporteExt->getCaIdemail())?>")' ><b><?=$txt?></b></a>
				<br />
				<?=$reporteExt->getCaSubject()?>
				<br /><br />
				<?	
				}
			}else{
				echo "No se han creado reportes al exterior<br />";
			}
			
			
			echo link_to(image_tag("22x22/edit_add.gif")." Rep. Exterior","reporteExt/crearReporte?idreporte=".$reporte->getCaIdreporte() );
				
				
		?>
		</div>
		<?
		}
		?>
		
		<a href="#" onClick="actualizar(<?=$reporte->getCaIdreporte()?>)">Actualizar</a>
		
		</td>
		<td width="46%" valign="top">
			<div class="post-info" align="left">
				<b>Historial</b><br />
				<div id="hist_<?=$reporte->getCaIdreporte()?>">
				<?
				include_component("traficos", "historialStatus", array("reporte"=>$reporte));
				?>
				</div>		
										
				<br />
				<?
				
				if( $nivel>0 ){
					if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
						echo link_to(image_tag("22x22/edit_add.gif")." Aviso" ,"traficos/nuevoStatus?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo."&tipo=aviso&token=".md5(time()));
						
					}
					echo link_to(image_tag("22x22/edit_add.gif")." Status","traficos/nuevoStatus?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo."&tipo=status&token=".md5(time()));
					
					
									
				}	
				?>
			</div>
		
		</td>
		<td width="28%" valign="top">
			<div class="post-info" align="left">
		 	<b>Documentos</b><br />	
				
			<?
				if( $reporte->getCaImpoexpo()==Constantes::EXPO ){	
					$url = url_for("reportes/generarPDF?reporteId=".$reporte->getCaIdReporte()."&token=".md5(time().basename($reporte->getCaIdReporte())));
				}else{				
					$url = "/colsys_php/reporteneg.php?id=".$reporte->getCaIdReporte();
				}
				
				echo mime_type_icon( "pdf" );
				?>
				<a onclick="popup('<?=$url?>')" id="50440', '800', '600' , 'myWindow')" href="#">Reporte</a>
				</li></ul>
				<div id="archivosReporte_<?=$reporte->getCaIdReporte()?>" >
				<?
				include_component("traficos", "verArchivosReporte", array("reporte"=>$reporte, "nivel"=>$nivel));				
				?>
				</div>
				
			
		</div>
		<br />
		
		
		</td>
	</tr>
</table>
