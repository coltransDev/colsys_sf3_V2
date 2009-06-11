<table width="100%" border="0">
	<tr>
		<td width="26%" valign="top">
		<div class="post-info">
		 	<b>Informaci&oacute;n general</b><br />				
			<?
					if( $reporte->getEsAG() ){
						echo "<b>Reporte AG<br /></b>";
					}
										
					if( $reporte->getCaUsuAnulado() ){
						echo "<b>Anulado por:</b> ".$reporte->getCaUsuAnulado()." ".$reporte->getCaFchAnulado();
					}
					?>
				     <?=!$reporte->getEsAG()&&$reporte->getCaImpoExpo()=="Importación"&&!$reporte->getReporteExterior()?"<b>No se ha creado reporte al exterior<br /></b>":""?>					
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
					<b>HBL:</b> <?=$reporte->getDocTransporte()?><br />	
					<b>MN:</b> <?=$reporte->getIdNave()?><br />
			
		</div>
		</td>
		<td width="46%" valign="top">
			<div class="post-info">
				<b>Historial</b><br />
				<?
				foreach( $statusList as $status ){
					$txt = "<b>".Utils::fechaMes( $status->getCaFchstatus("Y-m-d") )." ".$status->getCaFchstatus("h:i A" )."&gt;&gt;". $status->getTrackingEtapa()->getCaEtapa()."</b>
					";
					if( $status->getCaIdemail() ){
						?>
						<a href='#' onClick='window.open("<?=url_for("general/verEmail?id=".$status->getCaIdemail())?>")' ><?=$txt?></a>	
						<?			
					}else{
						echo $txt;
					}
					
					$statusTxt = $status->getStatus();					
					?>
					<br />
					<?=$status->getStatus()?> 
					
					<br />
					<?
				}
				?>
			</div>
		
		</td>
		<td width="28%" valign="top">
			<div class="post-info">
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
				include_component("traficos", "verArchivosReporte", array("reporte"=>$reporte));				
				?>
				</div>
				
			
		</div>
		</td>
	</tr>
</table>
