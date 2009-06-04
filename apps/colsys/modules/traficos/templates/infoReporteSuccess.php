<?
use_helper("Javascript", "Popup", "MimeType");

$statuss = $reporte->getRepStatuss();
$avisos = $reporte->getRepAvisos();

?>
<div class="grey">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="26%"><strong>Informaci&oacute;n</strong></td>
			<td width="44%"><div align="center"><strong>Historia</strong></div></td>
			<td width="30%"><strong>Gestion documental </strong></td>
		</tr>
		<tr>
			<td rowspan="2" valign="top"><div align="left">
					<?
					if( $reporte->getEsAG() ){
						echo "<strong>Reporte AG<br /></strong>";
					}
										
					if( $reporte->getCaUsuAnulado() ){
						echo "<strong>Anulado por:</strong> ".$reporte->getCaUsuAnulado()." ".$reporte->getCaFchAnulado();
					}
					?>
				     <?=!$reporte->getEsAG()&&$reporte->getCaImpoExpo()=="Importación"&&!$reporte->getReporteExterior()?"<strong>No se ha creado reporte al exterior<br /></strong>":""?>					
					<strong>Transporte:</strong> <?=$reporte->getCaTransporte()?><br />
					<strong>Modalidad:</strong> <?=$reporte->getCaModalidad()?><br />					
					<strong>Orden:</strong> <?=$reporte->getCaOrdenClie()?>				
				<?
					$numReferencia = $reporte->getNumReferencia();
					if( $numReferencia ){
						echo "<br /><strong>Referencia:</strong> ".$numReferencia; 						
					}				
				?><br />
				
					<strong>ETS:</strong> <?=$reporte->getETS("d.m.y")?><br />			
					<strong>ETA:</strong> <?=$reporte->getETA("d.m.y")?><br />
					<strong>Piezas:</strong> <?=$reporte->getPiezas()?><br />
					<strong>Peso:</strong> <?=$reporte->getPeso()?><br />
					<strong>Volumen:</strong> <?=$reporte->getVolumen()?><br />
					<strong>HBL:</strong> <?=$reporte->getDocTransporte()?><br />	
					<strong>MN:</strong> <?=$reporte->getIdNave()?><br />					
				
			</div></td>
			<td valign="top">
				<div align="left">
					
				<ul>
						<?
				$statuss = $reporte->getHistorialStatus();	
				
				foreach( $statuss as $timestamp=>$status ){
					?>
					<li>
					<strong>
						<?
						
						$txt = Utils::fechaMes(date("Y-m-d", $timestamp ))." ".date("h:i A", $timestamp )."&gt;&gt;".$status["etapa"];
						if( $status["emailid"] ){
							?>
							<a href='#' onClick='window.open("/general/verEmail/id/<?=$status["emailid"]?>")' ><?=$txt?></a> 			
							<?			
						}else{
							echo $txt;
						}
							
						?>							
					</strong> 
					
					<br />
					<?=substr($status["status"],0,300)?> 
					<?=strlen( $status["status"] )>300?"...":""?>
					</li>
					<?
				}
					
				?>
				</ul>
			</div></td>
			<td rowspan="2" valign="top">
				<div align="left">		
					<ul><li>
				<?
				if( $reporte->getCaImpoexpo()=="Exportación"){	
					$url = url_for("reportes/generarPDF?reporteId=".$reporte->getCaIdReporte()."&token=".md5(time().basename($reporte->getCaIdReporte())));
				}else{				
					$url = "/colsys_php/reporteneg.php?id=".$reporte->getCaIdReporte();
				}
				
				echo mime_type_icon( "pdf" );
				?>
				<a onclick="popup('<?=$url?>')" id="50440', '800', '600' , 'myWindow')" href="#">Reporte</a>
				</li></ul>
				<?
				include_component("gestDocumental", "verArchivosReporte", array("reporte"=>$reporte));
				?>
					
				</div>
			</td>
		</tr>
		<tr>
			<td valign="top"><strong>
				<?
				if( $reporte->getCaTransporte()=="Marítimo" ){
					echo link_popup(image_tag("22x22/edit_add.gif"),"traficos/nuevoMensaje?reporteId=".$reporte->getCaIdreporte()."&tipo=aviso&token=".md5(time()."aviso"), 800, 600);
					echo "Avisos";
				}
				?>

<?=link_popup(image_tag("22x22/edit_add.gif"),"traficos/nuevoMensaje?reporteId=".$reporte->getCaIdreporte()."&tipo=status&token=".md5(time()."status"), 800, 600)?>
Status </strong></td>
		</tr>
	</table>

</div>

<?
$class = $reporte->getColorStatus(); 

?>
<script language="javascript">
	
	document.getElementById("tr_<?=$reporte->getCaIdReporte()?>").className="<?=$class?>";
</script> 