<?			
$origen = $reporte->getOrigen();
$destino = $reporte->getDestino();


?>


<div class="htmlContent">

<?
if( $header ){
?>
	<div id="emailInfo">
		<?=include_partial("emailInfo", array("email"=>$status->getEmail()) )?>
	</div>
<?
}

?>
<h3 align="center" >AVISO MAR&Iacute;TIMO DE CARGA</h3>

<?
echo nl2br($status->getCaIntroduccion());

?><br /><br />



	<table border="1" cellspacing="0" width="600" cellpadding="3" class="tableList" >
		<tr>
			<td width="31%"><strong>Cotizaci&oacute;n No.:</strong></td>
			<td width="27%">&nbsp;</td>
			<td width="42%"><strong>Su Orden:</strong> <?=$reporte->getCaOrdenClie()?></td>
		</tr>
		<?
	$ordenesProv = explode("|",$reporte->getCaOrdenProv());			
	$proovedores = $reporte->getProovedores();
	$i=0;
	foreach( $proovedores as $proovedor ){		
		if( $proovedor ){
			?>
		<tr>
			<td><strong>Proveedor(s) :</strong></td>
			<td><?=Utils::replace($proovedor->getCaNombre())?></td>
			<td><strong>Orden No.:</strong>				<?=$ordenesProv[$i++]?></td>
		</tr>
		<?
		}
	}						
	?>
		<tr>
			<td><strong>T&eacute;rmino de Negociaci&oacute;n:</strong></td>
			<td colspan="2"><?=$reporte->getCaIncoterms()?></td>
		</tr>
		<tr>
			<td><strong>Puerto de Origen:</strong></td>
			<td><?=$origen?></td>
			<td><strong>
				<?				
				if( $status->getCaFchsalida() ){
				
					if( $status->getCaIdetapa()=="IMCCR" ){
						echo "Estimado de Salida:";
					}else{
						echo "Fecha de Salida:";
					}
					?>
					</strong><br />
					<?=$status->getCaFchsalida()?>
						<?
					}else{
						echo "&nbsp;";
					}
					?>
			</td>
		</tr>
		<tr>
			<td><strong>Puerto de Destino:</strong></td>
			<td><?=$destino?></td>
			<td>
				<?
				if( $status->getCaFchllegada() ){
				?>
					<strong>Estimada de Llegada:</strong><br />
					<?=$status->getCaFchllegada()?>
				<?
				}else{
					echo "&nbsp;";
				}
				?>
			</td>
		</tr>
		<?	
	if( $reporte->getCaContinuacion()!="N/A" ){
	?>
		<tr>
			<td><strong>Continuaci&oacute;n de Viaje:</strong></td>
			<td><?=$reporte->getCaContinuacion()." -> ".$reporte->getDestinoCont()?></td>
			<td><strong>Estimada de Llegada:</strong><br />
				<?=$status->getCaFchcontinuacion()?></td>
		</tr>
		<?		
	}
	$piezas = str_replace("|", " ", $status->getCaPiezas());
	$peso = str_replace("|", " ", $status->getCaPeso());
	$volumen = str_replace("|", " ", $status->getCaVolumen());
	?>
		<tr>
			<td>
				<?
				if( substr($piezas,0,1)!=0 ){
				?>
					<strong>Piezas:</strong><br />
					<?=$piezas?>
				<?
				}else{
					echo "&nbsp;";
				}
				?>
			</td>
			<td>
				<?
				if( substr($peso,0,1)!=0 ){				
					?>
					<strong>Peso:</strong><br />
					<?=$peso?>
				<?
				}
				?>	
			</td>
			<td>
				<?
				if( substr($volumen,0,1)!=0 ){					
				?>
					<strong>Volumen:</strong><br />
					<?=$volumen?>
				<?
				}
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?
				if( $status->getCaDoctransporte()!="''" ){
					?>
					<strong>No. Hbl:</strong>&nbsp;<br />
					<?=$status->getCaDoctransporte() ?>
				<?
				}
				?>
			</td>
			<td colspan="2">
				<?
				if( $status->getCaIdnave() ){
				?>
					<strong>Motonave:</strong><br />
					<?=$status->getCaIdnave() ?>
				<?
				}
				?>
			</td>
		</tr>
		<?
		if( $reporte->getCaModalidad()=="FCL" ){
		?>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2"><strong>Cantidad Equipos para el embarque:</strong><br />
				<table>
			<?
			$repequipos = $reporte->getRepEquipos();
			foreach( $repequipos as $equipo ){				
			?>
			<tr>				
				<td><?=$equipo->getCaCantidad()?> x <?=$equipo->getConcepto()->getCaConcepto()?></td>
				<td><?=$equipo->getCaIdEquipo()?></td>
			</tr>
			<?
			}
			?>
			
			
				</table></td>
		</tr>
		<?
		}
		?>
		<tr>
			<td><strong>Mercanc&iacute;a:</strong></td>
			<td colspan="2"><?=$reporte->getCaMercanciaDesc()?></td>
		</tr>
		<?
		if( $reporte->getCaSeguro()== "Sí"){
		?>
		<tr>
			<td><strong>Carga Asegurada:</strong></td>
			<td colspan="2"><?=Utils::replace($reporte->getCaSeguro())?></td>
		</tr>
		<?
		}
		if ( $reporte->getCaColmas()== "Sí") {
		?>
		<tr>
			<td><strong>Nacionalización Colmas SIA Ltda:</strong></td>
			<td colspan="2"><?=Utils::replace($reporte->getCaColmas())?></td>
		</tr>
		<?
		}
		?>
	</table>
	<br /><br />
	<?=nl2br($status->getCaStatus())?><br />
	<?
	echo nl2br($status->getCaComentarios())?"<strong>NOTA</strong><br />".Utils::replace(nl2br($status->getCaComentarios())):"";
	?>
	<br /><br /><br />
	
<?
if( $user ){
	include_partial("traficos/firma", array( "user"=>$user ));
}
?>
</div>