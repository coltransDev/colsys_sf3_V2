<div class="htmlContent">
<?
$reporte = $status->getReporte();
$cliente = $reporte->getCliente();
?>
<div align="center"><h3>SEGUIMIENTO DE CARGA</h3></div>
<div align="left">
	

	Señores:<br />
	<b>
	<?=strtoupper($cliente->getCaCompania())?>
	</b><br />
	<br />
	
	<br />
	<?=Utils::replace($status->getCaIntroduccion());?>
	<br />
	<table width="100%" cellspacing="0" border="1" class="tableList">
	<tr>
		<td width="21%"><b>Orden:</b></td>
		<td colspan="5"><?=$reporte->getCaOrdenClie()?></td>
	</tr>
	<tr>
		<td><b>Proveedor:</b></td>
		<td colspan="3"><?=$reporte->getProveedoresStr()?></td>
		<td width="37%"><b><?=$reporte->getCaOrdenProv()?"Orden Proveedor":"&nbsp;"?></b></td>
		<td width="6%"><?=$reporte->getCaOrdenProv()?$reporte->getCaOrdenProv():"&nbsp;"?></td>
	</tr>
	<tr>
		<td><b>Origen:</b></td>
		<td width="5%"><?=$reporte->getOrigen()->getCaCiudad()?></td>
		<td width="25%"><b>Fch.Salida:</b></td>
		<td width="6%"><?=$status->getCaFchsalida()?$status->getCaFchsalida():"&nbsp;"?></td>
		<td><b>Nombre del Buque:</b></td>
		<td><?=$status->getCaIdnave()?></td>
	</tr>
	<tr>
		<td><b>Destino:</b></td>
		<td><?=$reporte->getDestino()->getCaCiudad()?></td>
		<td><b>Fch.Llegada:</b></td>
		<td><?=$status->getCaFchllegada()?$status->getCaFchllegada():"&nbsp;"?></td>		
		<td colspan="2">&nbsp;</td>		
	</tr>
	<tr>
		<td><b>No.Piezas:</b></td>
		<td><?=$status->getCaPiezas()?Utils::formatNumber($status->getCaPiezas()):"&nbsp;"?></td>
		<td><b>Volumen:</b></td>
		<td><?=$status->getCaVolumen()?Utils::formatNumber($status->getCaVolumen()):"&nbsp;"?></td>
		<td><b>Peso:</b></td>
		<td><?=$status->getCaPeso()?Utils::formatNumber($status->getCaPeso()):"&nbsp;"?></td>
	</tr>
	<tr>
		<td><b>No. HBL:</b></td>
		<td><?=$status->getCaDoctransporte()?$status->getCaDoctransporte():"&nbsp;"?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
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
			?>
		</td>
	</tr>
	<?
	}

?>
</table>

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