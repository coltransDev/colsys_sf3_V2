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
<?
if( $status->getCaEtapa()=="Carga con Reserva" ){
?>
<h3 align="center" >PREAVISO A&Eacute;REO DE CARGA</h3>
<?
}

if( $status->getCaEtapa()=="Carga en Aeropuerto de Destino" ){
?>
<h3 align="center" >CONFIRMACI&Oacute;N DE LLEGADA</h3>
<?
}



?>
<?
echo nl2br($status->getCaIntroduccion());

?><br /><br />



	<table border="0" cellspacing="1" width="600" cellpadding="3" class="tableList" >
		<tr>
			<td width="31%"><strong>Cotizaci&oacute;n No.:</strong></td>
			<td width="27%">&nbsp;</td>
			<td colspan="2"><strong>Su Orden:</strong> <?=$reporte->getCaOrdenClie()?></td>
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
			<td colspan="2"><strong>Orden No.:</strong>				<?=$ordenesProv[$i++]?></td>
		</tr>
		<?
		}
	}						
	?>
		<tr>
			<td><strong>T&eacute;rmino de Negociaci&oacute;n:</strong></td>
			<td colspan="3"><?=$reporte->getCaIncoterms()?></td>
		</tr>
		<tr>
			<td><strong>Aeropuerto de Origen:</strong></td>
			<td><?=$origen?></td>
			<td><strong>
				<?				
				if( $status->getCaFchsalida() ){
				
					if( $status->getCaEtapa()=="Carga con Reserva" ){
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
					?>				</td>
			<td><?
				if( $status->getCaHorasalida() ){
					?>
				<strong>Hora</strong><br />
				<?
					echo $status->getCaHorasalida();
				}else{
					echo "&nbsp;";
				}
					?></td>
		</tr>
		<tr>
			<td><strong>Aeropuerto de Destino:</strong></td>
			<td><?=$destino?></td>
			<td width="30%">
				<strong>
				<?
				if( $status->getCaFchllegada() ){
					if( $status->getCaEtapa()=="Carga en Aeropuerto de Destino" ){
						echo "Fecha de llegada:";						
					}else{
						echo "Estimado de llegada:";

					}
				?>
				</strong><br />
					<?=$status->getCaFchllegada()?>
				<?
				}else{
					echo "&nbsp;";
				}
				?>				</td>
			<td width="12%">
				<?
				if( $status->getCaHorallegada() ){
					?>
					<strong>Hora</strong><br />
					<?
					echo $status->getCaHorallegada();
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
			<td colspan="2"><strong>Estimada de Llegada:</strong><br />
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
				?>				</td>
			<td>
				<?
				if( substr($peso,0,1)!=0 ){				
					?>
					<strong>Peso:</strong><br />
					<?=$peso?>
				<?
				}
				?>			</td>
			<td colspan="2">
				<?
				if( substr($volumen,0,1)!=0 ){					
				?>
					<strong>Volumen:</strong><br />
					<?=$volumen?>
				<?
				}
				?>				</td>
		</tr>
		<tr>
			<td>
				<?
				if( $status->getCaDoctransporte()!="''" ){
					?>
					<strong>No. Guia:</strong>&nbsp;<br />
					<?=$status->getCaDoctransporte() ?>
				<?
				}
				?>				</td>
			<td colspan="3">
				<?
				if( $status->getCaIdnave() ){
				?>
					<strong>Vuelo:</strong><br />
					<?=$status->getCaIdnave() ?>
				<?
				}else{
					echo "&nbsp;";
				}
				?>				</td>
		</tr>
		
		<tr>
			<td><strong>Transladar a:</strong> </td>
			<td colspan="3"><?=$reporte->getNombreBodega()?></td>
		</tr>
		<tr>
			<td><strong>Mercanc&iacute;a:</strong></td>
			<td colspan="3"><?=$reporte->getCaMercanciaDesc()?></td>
		</tr>
		<?
		if( $reporte->getCaSeguro()== "Sí"){
		?>
		<tr>
			<td><strong>Carga Asegurada:</strong></td>
			<td colspan="3"><?=Utils::replace($reporte->getCaSeguro())?></td>
		</tr>
		<?
		}
		if ( $reporte->getCaColmas()== "Sí") {
		?>
		<tr>
			<td><strong>Nacionalización Colmas SIA Ltda:</strong></td>
			<td colspan="3"><?=Utils::replace($reporte->getCaColmas())?></td>
		</tr>
		<?
		}
		?>
	</table>
	<br /><br />
	<?=$status->getCaStatus()?><br />
	<?
	echo $status->getCaComentarios()?"<strong>NOTA</strong><br />".Utils::replace($status->getCaComentarios()):"";
	?>
	<br />
	<br />
	<?
	
	if( $status->getCaEtapa()=="Carga en Aeropuerto de Destino" 
		|| $status->getCaEtapa()=="Carga con Reserva"
		|| $status->getCaEtapa()=="Carga Embarcada"
		|| $status->getCaEtapa()=="Carga con Demora"
		|| $status->getCaEtapa()=="Carga Movilizada"
		|| $status->getCaEtapa()=="Carga Inmovilizada"	
		|| $status->getCaEtapa()=="Carga en Tránsito a Destino"	
		){
	?>
	De acuerdo a las condiciones del contrato de transporte, la persona con derecho a la entrega deberá reclamar por escrito al transportista en caso de daño visible a la mercancía; a mas tardar a los catorce (14) días a partir de la fecha de manifiesto o llegada de la misma al país. 
	<?
	}
	?>
	<br /><br /><br />
<?	
if( $user ){
	include_partial("traficos/firma", array( "user"=>$user ));
}
?>
</div>