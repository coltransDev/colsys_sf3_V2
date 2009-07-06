<div class="htmlContent">
<?
$reporte = $status->getReporte();
$cliente = $reporte->getCliente();

?>

<div align="center"><h3><?=($etapa&&$etapa->getCaTitle())?$etapa->getCaTitle():"SEGUIMIENTO DE CARGA"?></h3></div>

<div align="left">
	

	Se�ores:<br />
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
		<td colspan="5"><?=$reporte->getCaOrdenClie()?></td>
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
		<td><b>Nombre del Buque:</b></td>
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
	<tr>
		<td><b>No.Piezas:</b></td>
		<td><?=$status->getCaPiezas()?str_replace("|", " ", $status->getCaPiezas()):"&nbsp;"?></td>
		<td><b>Volumen:</b></td>
		<td><?=$status->getCaVolumen()?str_replace("|", " ",$status->getCaVolumen()):"&nbsp;"?></td>
		<td><b>Peso:</b></td>
		<td><?=$status->getCaPeso()?str_replace("|", " ",$status->getCaPeso()):"&nbsp;"?></td>
	</tr>
	<tr>
		<td><b>No. HBL:</b></td>
		<td><?=$status->getCaDoctransporte()?$status->getCaDoctransporte():"&nbsp;"?></td>
		<td><?=$reporte->getCaModalidad()=="FCL"&&$status->getCaDocmaster()?"<b>Master:</b>":"&nbsp;"?></td>
		<td><?=$reporte->getCaModalidad()=="FCL"&&$status->getCaDocmaster()?$status->getCaDocmaster():"&nbsp;"?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>		
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
	$bodega =  $status->getBodega();
	if($bodega){
	?>
	<tr>
		<td><b>Bodega</b></td>
		<td colspan="5"><?=$bodega->getCaNombre()?></td>
	</tr>
	<?	
	}		
	
	if( $reporte->getCaModalidad()=="FCL" ){
		if( $inoCliente ){		
			$referencia = $inoCliente->getInoMaestraSea();
			$equipos = $referencia->getInoEquiposSeas();
			?>
			<tr>
				<td colspan="6">
					<table width="100%" cellspacing="0" border="1" class="tableList">
						<tr>
							<th colspan="4">Relaci�n de Contenedores</th>
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
							<th colspan="4">Relaci�n de Contenedores</th>
						</tr>
						<tr>
							<th>Concepto</th>
							<th>Cantidad</th>
							<?
							if( $reporte->getCaImpoExpo()==Constantes::EXPO ){
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
							if( $reporte->getCaImpoExpo()==Constantes::EXPO ){
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
	?>
	
	<?
	$c = new Criteria();
	$c->add( RepStatusPeer::CA_FCHENVIO , $status->getCaFchEnvio(), Criteria::LESS_EQUAL );
	$c->addDescendingOrderByColumn( RepStatusPeer::CA_FCHENVIO );
	$statusList = $reporte->getRepStatuss( $c );
	if( count( $statusList)>0 ){
	?>
	<tr>
		<td colspan="6">
			<?
			include_component("traficos", "listaStatus", array("reporte"=>$reporte, "endDate"=>$status->getCaFchEnvio()));
			?>		</td>
	</tr>
	<?
	}

?>
</table>
<br />
<br />
<?

if( $reporte->getCaTransporte()==Constantes::AEREO && ($status->getCaIdEtapa()=="IACAD" 
	|| $status->getCaIdEtapa()=="IACCR"
	|| $status->getCaIdEtapa()=="IACEM"
	|| $status->getCaIdEtapa()=="IACDE"
	|| $status->getCaIdEtapa()=="IACIM"
	|| $status->getCaIdEtapa()=="IACMV"	
	|| $status->getCaIdEtapa()=="IACTD"	)
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

<br />
Gracias por contar con nuestro servicio.<br />
<br />
Cordial Saludo.<br />
<br />
<br />
<?
echo $user->getFirmaHTML();
?>
	
	
</div>
</div>