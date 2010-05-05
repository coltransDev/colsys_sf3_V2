<?
$user = $sf_data->getRaw("user");
$status = $sf_data->getRaw("status");
$etapa = $sf_data->getRaw("etapa");
?>

<div class="htmlContent">
<?
$reporte = $status->getReporte();
$cliente = $reporte->getCliente();

?>

<div align="center"><h3><?=($etapa&&$etapa->getCaTitle())?$etapa->getCaTitle():"SEGUIMIENTO DE CARGA"?></h3></div>

<div align="left">
	

	Señores:<br />
	<b>
	<?=strtoupper($cliente->getCaCompania())?>
	</b><br />
	<br />
	
	<br />
	<?=$status->getCaIntroduccion()?>
	<br />
	<br />
	<table width="100%" cellspacing="0" border="1" class="tableList">
	<tr>
		<td width="13%"><b>Orden:</b></td>
		<td ><?=$reporte->getCaOrdenClie()?></td>
		<td><b>T&eacute;rmino de Negociaci&oacute;n:</b></td>
		<td>
		<?
		$array = explode("|",$reporte->getCaIncoterms());
		$array = array_unique( $array );
		$incoterms = implode(" ", $array );
		echo $incoterms;
		?>
		</td>
        <?
        //Ticket # 938
        ?>
        <td><b>Cotizaci&oacute;n:</b></td>
		<td>
		<?=$reporte->getCaIdcotizacion()?$reporte->getCaIdcotizacion():"&nbsp;"?>
		</td>
	</tr>
	<tr>
		<td><b>Proveedor:</b></td>
		<td colspan="3"><?=$reporte->getProveedoresStr()?></td>
		<td width="20%"><b><?=$reporte->getCaOrdenProv()?"Orden Proveedor":"&nbsp;"?></b></td>
		<td width="22%"><?=$reporte->getCaOrdenProv()?$reporte->getCaOrdenProv():"&nbsp;"?></td>
	</tr>
	
	<tr>
		<td><b>Origen:</b></td>
		<td width="13%"><?=$reporte->getOrigen()->getCaCiudad()?></td>
		<td width="15%"><b>Fch.Salida:</b></td>
		<td width="17%"><?=$status->getCaFchsalida()?$status->getCaFchsalida()." ".$status->getCaHorasalida():"&nbsp;"?></td>
		<td><b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"Motonave:":"Vuelo:"?></b></td>
		<td><?=$status->getCaIdnave()?></td>
	</tr>
	<tr>
		<td><b>Destino:</b></td>
		<td><?=$reporte->getDestino()->getCaCiudad()?></td>
		<td><b>Fch.Llegada:</b></td>
		<td><?=$status->getCaFchllegada()?$status->getCaFchllegada():"&nbsp;"?></td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>
	</tr>
	<?				
	if( $reporte->getCaContinuacion()!="N/A" ){
	?>
	<tr>
		<td><b>Destino:</b></td>
		<td><?=$reporte->getCaContinuacion()." -> ".$reporte->getDestinoCont()?>	</td>
		<td><b>Fch.Llegada:</b></td>
		<td><?=$status->getCaFchcontinuacion()?$status->getCaFchcontinuacion():"&nbsp;"?></td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>
	</tr>
	<?
	}
	?>	
	<tr>
		<td><b>No.Piezas:</b></td>
		<td><?=$status->getCaPiezas()?str_replace("|", " ", $status->getCaPiezas()):"&nbsp;"?></td>
		<td><b>Peso:</b></td>
		<td><?=$status->getCaPeso()?str_replace("|", " ",$status->getCaPeso()):"&nbsp;"?></td>
		<td><b>Volumen:</b></td>
		<td><?=$status->getCaVolumen()?str_replace("|", " ",$status->getCaVolumen()):"&nbsp;"?></td>
	</tr>
	<tr>
		<td><b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"HBL:":"HAWB:"?></b></td>
		<td><?=$status->getCaDoctransporte()?$status->getCaDoctransporte():"&nbsp;"?></td>
		<td><?=$reporte->getCaModalidad()=="FCL"&&$status->getCaDocmaster()?"<b>Master:</b>":"&nbsp;"?></td>
		<td><?=$reporte->getCaModalidad()=="FCL"&&$status->getCaDocmaster()?$status->getCaDocmaster():"&nbsp;"?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
    <?
    if($reporte->getCaTransporte()==Constantes::AEREO && ($reporte->getCaImpoexpo()==Constantes::IMPO||$reporte->getCaImpoexpo()==Constantes::TRIANGULACION)){
        //Ticket # 1921
        $bodega2 = Doctrine::getTable("Bodega")->find( $reporte->getCaIdbodega() );
    ?>
    <tr>
		<td><b>Trasladar a:</b></td>
		<td colspan="5"><?=$bodega2->getCaTipo()." ".$bodega2->getCaNombre()?></td>
	</tr>
    <?
    }
    ?>
	<tr>
		<td><b>Mercanc&iacute;a</b></td>
		<td colspan="5"><?=$reporte->getCaMercanciaDesc()?></td>
	</tr>
	<?
	$inoCliente = $reporte->getInoClientesSea();
	if( $inoCliente ){		
	?>
	<tr>
		<td><b>Referencia</b></td>
		<td colspan="5"><?=$inoCliente->getCaReferencia()?></td>	
	</tr>
    <?
    }
    if($reporte->getCaImpoexpo()==Constantes::EXPO){
        $repexpo = $reporte->getRepexpo();
    ?>
    <tr>
		<td><b>Inspección Fisica</b></td>
		<td colspan="5"><?=$repexpo->getCaInspeccionFisica()?"Sí":"No"?></td>
	</tr>

	<?
	}
	$bodega =  $status->getBodega();
	if($bodega){
	?>
	<tr>
		<td><b>Bodega</b></td>
		<td colspan="5"><?=$bodega->getCaNombre()?></td>
	</tr>
	<?	
	}
	
	if( $reporte->getCaSeguro()== "Sí"){
	?>
		<tr>
			<td><strong>Carga Asegurada:</strong></td>
			<td colspan="5"><?=Utils::replace($reporte->getCaSeguro())?></td>	
		</tr>
	<?	
	}
	
	if ( $reporte->getCaColmas()== "Sí") {
	?>
		<tr>
			<td><strong>Nacionalización Colmas SIA Ltda:</strong></td>
			<td colspan="5"><?=Utils::replace($reporte->getCaColmas())?></td>
		</tr> 
	<?	
	}
		
	
	if( $reporte->getCaModalidad()=="FCL" ){
		if( $inoCliente ){		
			$referencia = $inoCliente->getInoMaestraSea();
			$equipos = $referencia->getInoEquiposSea();
			?>
			<tr>
				<td colspan="6">
					<table width="100%" cellspacing="0" border="1" class="tableList">
						<tr>
							<th colspan="4">Relación de Contenedores</th>
						</tr>
						<tr>
							<th>Concepto</th>
							<th>Cantidad</th>
							<th>ID Equipo</th>
							<th>Observaciones</th>
						</tr>
						<?				
						foreach( $equipos as $equipo ){
						?>
						<tr>
							<td><?=$equipo->getConcepto()->getCaConcepto()?></td>
							<td><?=$equipo->getCaCantidad()?></td>
							<td><?=$equipo->getCaIdequipo()?></td>
							<td><?=$equipo->getCaObservaciones()?$equipo->getCaObservaciones():"&nbsp;"?></td>
						</tr>
						<?
						}
						?>
					</table></td>
			</tr>
			<?
		}else{
	
			$equipos = $reporte->getRepEquipos();
			
			if (count($equipos)> 0){
			?>
			<tr>
				<td colspan="6">
					<table width="100%" cellspacing="0" border="1" class="tableList">
						<tr>
							<th colspan="4">Relación de Contenedores</th>
						</tr>
						<tr>
							<th>Concepto</th>
							<th>Cantidad</th>
							<?
							if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
							?>
							<th>Serial</th>
							<?
							}
							?>
							<th>Observaciones</th>
						</tr>
						<?				
						foreach( $equipos as $equipo ){
						?>
						<tr>
							<td><?=$equipo->getConcepto()->getCaConcepto()?></td>
							<td><?=$equipo->getCaCantidad()?></td>
							<?
							if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
							?>
							<td><?=$equipo->getCaIdequipo()?></td>
							<?
							}
							?>
							<td><?=$equipo->getCaObservaciones()?$equipo->getCaObservaciones():"&nbsp;"?></td>
						</tr>
						<?
						}
						?>
					</table></td>
			</tr>
			<?
			}
		}
	}
		
	$statusList = $reporte->getRepStatus( );
	if( count( $statusList)>0 ){
	?>
	<tr>
		<td colspan="6">
			<?
			include_component("traficos", "listaStatus", array("reporte"=>$reporte, "endDate"=>$status->getCaFchenvio()));
			?>		</td>
	</tr>
	<?
	}

?>
</table>
<br />
<br />
<?

if( $reporte->getCaTransporte()==Constantes::AEREO && ($status->getCaIdetapa()=="IACAD"
	|| $status->getCaIdetapa()=="IACCR"
	|| $status->getCaIdetapa()=="IACEM"
	|| $status->getCaIdetapa()=="IACDE"
	|| $status->getCaIdetapa()=="IACIM"
	|| $status->getCaIdetapa()=="IACMV"
	|| $status->getCaIdetapa()=="IACTD"	)
	){
	echo $textos['mensajeAereo']."<br />";
}
	

if( $status->getCaIdetapa()=="IMCCR" ){
	echo $textos['mensajeReservaMaritimo']."<br />";
}


if( $status->getCaIdetapa()=="IMETA" ){
	echo $textos['mensajeEmbarqueMaritimo'];
	
	if( $reporte->getCaContinuacion()=="OTM"  ){	
		echo $textos['mensajeEmbarqueOTM']."<br />";
	}
}
?>


<?
//Ticket # 1853
if($reporte->getCaTransporte()==Constantes::AEREO && ($status->getCaIdetapa()=="IACCR" || $status->getCaIdetapa()=="IACAD" || $status->getCaIdetapa()=="IACDE") ){
?>
<br />
La fecha de llegada de la mercancía es un estimado ya que puede variar por decisión de la aerolínea. 
<?
}
?>

<br />
Cualquier información adicional que ustedes requieran, con gusto le será suministrada.<br />
<br />
Cordial Saludo.<br />
<br />
<br />
<?
echo $user->getFirmaHTML();
?>
	
	
</div>
</div>
