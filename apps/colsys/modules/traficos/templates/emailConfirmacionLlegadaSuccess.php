<?
$inoCliente = $reporte->getInoClientesSea();
$inoMaestra = $inoCliente->getInoMaestraSea();
$cliente = $inoCliente->getCliente();
?>

Señores:<br />
<b>
<?=strtoupper($cliente->getCaCompania())?>
</b><br />
<br />
<?=Utils::replace($status->getCaIntroduccion());?>
<br />


<table width="100%" cellspacing="1" border="1" class="tableList">
<?
if ( $status->getCaIdEtapa() == "IMCPD" ) { //confirmación de llegada
?>
	
	<?
					if ( $inoCliente->getCaNumorden() ) {
					?>
	<tr>
		<td width="23%"><b>Orden:</b></td>
		<td colspan="5"><?=$inoCliente->getCaNumorden()?></td>
	</tr>
	<?
					}
					?>
	<tr>
		<td><b>Proveedor:</b></td>
		<td colspan="3"><?=$inoCliente->getCaProveedor()?></td>
		<td><b>Referencia</b></td>
		<td><?=$inoMaestra->getCaReferencia()?></td>
	</tr>
	<tr>
		<td><b>Origen:</b></td>
		<td width="4%"><?=$inoMaestra->getOrigen()->getCaCiudad()?></td>
		<td width="23%"><b>Fch.Salida:</b></td>
		<td width="14%"><?=$inoMaestra->getCaFchembarque()?></td>
		<td width="28%"><b>Nombre del Buque:</b></td>
		<td width="5%"><?=$inoMaestra->getCaMnllegada()?></td>
	</tr>
	<tr>
		<td><b>Destino:</b></td>
		<td><?=$inoMaestra->getDestino()->getCaCiudad()?></td>
		<td><b>Fch.Llegada:</b></td>
		<td><?=$inoMaestra->getCaFchconfirmacion()?>
			<br />
			<b>Hora: </b>
			<?=$inoMaestra->getCaHoraconfirmacion()?>		</td>
		<?
					if ( $inoMaestra->getCaFchdesconsolidacion() ) {
					
				?>
		<td><b>Desconsolidación:</b></td>
		<td><?=$inoMaestra->getCaFchdesconsolidacion()?></td>
		<?	  
					} else {
					?>
		<td width="3%" colspan="2">&nbsp;</td>
		<?
					}
					?>
	</tr>
	<tr>
		<td><b>No.Piezas:</b></td>
		<td><?=Utils::formatNumber($inoCliente->getCaNumpiezas())?></td>
		<td><b>Volumen:</b></td>
		<td><?=Utils::formatNumber($inoCliente->getCaVolumen())?></td>
		<td><b>Peso:</b></td>
		<td><?=Utils::formatNumber($inoCliente->getCaPeso())?></td>
	</tr>
	<tr>
		<td><b>No. HBL:</b></td>
		<td><?=$inoCliente->getCaHbls()?></td>
		<td><b>Reg. Aduanero:</b></td>
		<td><?=$inoMaestra->getCaRegistroadu()?></td>
		<td><b>Fch.Registro:</b></td>
		<td><?=$inoMaestra->getCaFchregistroadu()?></td>
	</tr>
	<tr>
		<td><b>Reg. Capitania:</b></td>
		<td><?=$inoMaestra->getCaRegistrocap()?></td>
		<td><b>Bandera:</b></td>
		<td><?=$inoMaestra->getCaBandera()?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Mercanc&iacute;a</b></td>
		<td colspan="5"><?=$reporte->getCaMercanciaDesc()?></td>
	</tr>
	<?
	if ($status->getCaStatus() ){
	?>
	<tr>
		<td colspan="6"><b>Nota:</b><br/>
			<?=Utils::replace($status->getCaStatus())?></td>
	</tr>
	<?
	}	
	
	if( $inoMaestra->getCaModalidad()=="FCL" ){
		$equipos = $inoMaestra->getInoEquiposSeas();
		
		if (count($equipos)> 0){
		?>
		<tr>
			<td colspan="6"><table width="100%" cellspacing="1" border="1" class="tableList">
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
}else{

	
	if ( $inoCliente->getCaNumorden() ) {
	?>
	<tr>
		<td><b>Orden :</b></td>
		<td colspan="5"><?=$inoCliente->getCaNumorden()?>		</td>
	</tr>
	<?
	}
	?>
	<tr>
		<td><b>Proveedor :</b></td>
		<td colspan="5"><?=$inoCliente->getCaProveedor()?>		</td>
	</tr>
	<tr>
		<td><b>Origen:</b></td>
		<td><?=$inoMaestra->getOrigen()->getCaCiudad()?></td>
		<td><b>Destino:</b></td>
		<td><?=$inoMaestra->getDestino()->getCaCiudad()?></td>
		<td><b>Fch.Salida:</b></td>
		<td><?=$inoMaestra->getcaFchembarque()?></td>
	</tr>
	<?
	$c = new Criteria();
	$c->add( RepStatusPeer::CA_FCHENVIO , $status->getCaFchEnvio(), Criteria::LESS_EQUAL );
	$c->addDescendingOrderByColumn( RepStatusPeer::CA_FCHENVIO );
	$statusList = $reporte->getRepStatuss( $c );
	if( count( $statusList)>0 ){
	?>
	<tr>
		<td colspan="6"><table width="100%" cellspacing="1" border="1" class="tableList">
				<tr>
					<th colspan="2">Status del Embarque</th>
				</tr>
				<tr>
					<th width="24%">Fecha</th>
					<th width="76%">Status</th>
				</tr>				

				<?
				foreach( $statusList as $lstatus ){ 
				?>
				<tr>
					<td><?=$lstatus->getCaFchenvio()?></td>
					<td><?=Utils::replace($lstatus->getStatus())?></td>
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
</table>
<?=$inoCliente->getCaMensaje()?>
<br />
<?=$inoMaestra->getCaMensaje()?>
<br />
<br />
Nota: Estimado Cliente, le recordamos que el tiempo de permanencia de mercancìa en los depositos es de un (1) mes, contados desde la fecha de llegada de la mercancìa, y pueden solicitar una posible prorroga por un (1) mes adicional acorde al Decreto 2557 del 06 de Julio 2007 art. 10<br />
<br />
Gracias por contar con nuestro servicio.<br />
<br />
Cordial Saludo.<br />
<br />
<br />
<?
echo $user->getFirmaHTML();
?>