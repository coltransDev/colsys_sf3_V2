
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

<h3 align="center">SEGUIMIENTO DE CARGA</h3>
<?
echo $status->getCaIntroduccion();
?>
<table border="1" cellspacing="0" width="600" cellpadding="3" class="tableList">
<tr>
	<td colspan="3"><center><b>INFORMACI&Oacute;N DEL EMBARQUE</b></center></td>
</tr>
<tr>
	<td width="216"><strong>Cotizaci&oacute;n No.:</strong></td>
	<td width="176"><?=$reporte->getCaIdcotizacion()!=0?$reporte->getCaIdcotizacion():""?></td>
	<td width="186"><strong>Su Orden:</strong>		<?=$reporte->getCaOrdenClie()?></td>
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
		<td><?=Utils::replace($proovedor->getCaNombre()) ?></td>
		<td><strong>Orden No.:</strong>			<?=$ordenesProv[$i++]?></td>
	</tr>
	<?	
	}
}

$array = explode("|",$reporte->getCaIncoterms());
$array = array_unique( $array );
$incoterms = implode(" ", $array );
?>		
<tr>
	<td><strong>T�rmino de Negociaci&oacute;n:</strong></td><td colspan="2"><?=$incoterms?>&nbsp;</td>
</tr>
<tr>
	<td><strong>Puerto de Origen:</strong></td>
	<td><?=$reporte->getOrigen()?></td>
	<td><?
	if( $status->getCaFchsalida() ){
	?>
		<strong>Fecha de salida :</strong><br />
		<?=$status->getCaFchsalida()?>
		<?
	}else{
		echo "&nbsp;";
	}
	?></td>
</tr>
<tr>
	<td><strong>Puerto de Destino:</strong></td>
	<td><?=$reporte->getDestino()?></td>
	<td><?
	if( $status->getCaFchllegada() ){
	?>
		<strong>Estimada de Llegada:</strong><br />
		<?=$status->getCaFchllegada()?>
		<?
	}else{
		echo "&nbsp;";
	}
	?></td>
</tr>
<?		 
if( $reporte->getCaContinuacion()!="N/A" ){
	?>
	<tr>
		<td><strong>Continuaci&oacute;n de Viaje:</strong></td>
		<td><?=$reporte->getCaContinuacion()." -> ".$reporte->getDestinoCont()?></td>								
		<td><?
	if( $status->getCaFchcontinuacion() ){
	?>
			<strong>Estimada de Llegada:</strong><br />
			<?=$status->getCaFchcontinuacion()?>
			<?
	}else{
		echo "&nbsp;";
	}
	?></td>
	</tr>
	<?
} 

if( $status->getCaDoctransporte() || $status->getCaIdnave() ){
?>
<tr>
	<td>
	<?
	if( $status->getCaDoctransporte() && $status->getCaDoctransporte()!="''" ){
		if( $reporte->getcaTransporte()=="Mar�timo" ){
			?>
			<strong>No. Hbl:</strong><br />
			<?
			}else{
			?>
			<strong>HAWB:</strong><br />
			<?	
			}			
		?>
		<?=$status->getCaDoctransporte() ?>
	<?
	}else{
		echo "&nbsp;";
	}
	?>	</td>
	<td colspan="2">
		<?
		if( $status->getCaIdnave() ){
			if( $reporte->getcaTransporte()=="Mar�timo" ){
			?>
			<strong>Motonave:</strong><br />
			<?
			}else{
			?>
			<strong>Vuelo:</strong><br />
			<?	
			}
			?>
			<?=$status->getCaIdnave() ?>
		<?
		}else{
			echo "&nbsp;";
		}
		?>	</td>
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
		?>		</td>
	<td>
		<?
		if( substr($peso,0,1)!=0 ){				
			?>
			<strong>Peso:</strong><br />
			<?=$peso?>
		<?
		}else{
			echo "&nbsp;";
		}
		?>	</td>
	<td>
		<?
		if( $status->getCaPiezas() ){					
		?>
			<strong>Volumen:</strong><br />
			<?=$volumen?>
		<?
		}else{
			echo "&nbsp;";
		}
		?>		</td>
</tr>
<?
if( $reporte->getCaModalidad()=="FCL" ){
?>
<tr>
	<td colspan="3"><strong>Cantidad Equipos para el embarque:</strong><br />
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
	<td><strong>Mercancia:</strong></td>
	<td colspan="2"><?=$reporte->getCaMercanciaDesc()?></td>
</tr>
<? 
if( $reporte->getCaSeguro()== "S�"){
?>
	
	<tr>
		<td><strong>Carga Asegurada:</strong></td>
		<td colspan="2"><?=Utils::replace($reporte->getCaSeguro())?></td>	
	</tr>
<?	
}

if ( $reporte->getCaColmas()== "S�") {
?>
	<tr>
		<td><strong>Nacionalizaci�n Colmas SIA Ltda:</strong></td>
		<td colspan="2"><?=Utils::replace($reporte->getCaColmas())?></td>
	</tr> 
<?	
}
?>
			
<br />
<tr>
	<td colspan="3"><center><b>STATUS ASOCIADOS AL CASO</b></center></td>
</tr>
<?
			
$repStatuss = $reporte->getRepStatuss();
$statuss = $reporte->getHistorialStatus();					
foreach( $statuss as $timestamp=>$statusH ){

?>
	<tr>
		<td style="vertical-align:top;"><?=Utils::fechaMes(date("Y-m-d", $timestamp ))?></td>
		<td colspan="2"><?=nl2br($statusH["status"])?></td>
	</tr>
	<tr height="5"><td colspan="3">&nbsp;</td></tr>		
<?	
}
?>
</table>


	<?
	
	if( $reporte->getCaTransporte()=="A�reo" && ($status->getCaIdEtapa()=="IACAD" 
		|| $status->getCaIdEtapa()=="IACCR"
		|| $status->getCaIdEtapa()=="IACEM"
		|| $status->getCaIdEtapa()=="IACDE"
		|| $status->getCaIdEtapa()=="IACIM"
		|| $status->getCaIdEtapa()=="IACMV"	
		|| $status->getCaIdEtapa()=="IACTD"	)
		){
	?>
	De acuerdo a las condiciones del contrato de transporte, la persona con derecho a la entrega deber� reclamar por escrito al transportista en caso de da�o visible a la mercanc�a; a mas tardar a los catorce (14) d�as a partir de la fecha de manifiesto o llegada de la misma al pa�s. <br />

	<?
	}
	?>
	<?
	
	echo nl2br($status->getCaComentarios());
	?>
		<br />
		<br />
	
	
	Cordialmente,<br />
	<br />
	

	<?	
if( $user ){
	include_partial("traficos/firma", array( "user"=>$user ));
}
?>
	

		</p>
</div>