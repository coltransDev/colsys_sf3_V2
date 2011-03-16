<? 
	
?>
<table width="90%" border="0" class="table1">
	<tr>
		<th colspan="4" scope="col">REFERENCIA 
		<?=$referencia->getCaReferencia();?></th>
	</tr>
	<tr>
		<td colspan="2">
			<div align="left"><strong>Cliente</strong><br />
				<?
		$cliente =$referencia->getCliente();
		if( $cliente ){
			echo $cliente->getCaCompania();
		}
		?>		
		</div></td>
		<td width="28%"><div align="left"><strong>Origen</strong><br />
				<?=$referencia->getOrigen()?>		
		</div></td>
		<td width="32%"><div align="left"><strong>Destino</strong><br />
				<?=$referencia->getDestino()?>		
		</div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="left"><strong>Mercancia</strong> <br />
				<?=$referencia->getCaMercancia()?>
		</div></td>
		<td colspan="2">
			<div align="left"><strong>Proveedor </strong> <br />
				<?=$referencia->getCaProveedor()?>			
		</div></td>
	</tr>
	<tr>
		<td width="19%"><div align="left"><strong>Piezas</strong>
				<br />
				<?=$referencia->getCaPiezas()?>		
		</div></td>
		<td width="21%"><div align="left"><strong>Peso</strong>
				<br />
				<?=$referencia->getCaPeso()?>		
		</div></td>
		<td><div align="left"><strong>Fecha estimada de arribo </strong><br />
				<?=$referencia->getCaFchArribo()?Utils::fechaMes($referencia->getCaFchArribo()):"Sin definir"?>		
		</div></td>
		<td><div align="left"><strong>Pedido</strong><br />
				<?=$referencia->getCaPedido()?>
		</div></td>
	</tr>
</table>
<br />

<table width="90%" border="1" class="table1">
	<tr>
		<th colspan="2" scope="col">Eventos de la referencia </th>
	</tr>
	<tr class="row0">
		<td width="23%"><strong>Fecha/Hora</strong></td>
		<td><strong>Evento</strong></td>
	</tr>
	
	<?
	if( count($eventos)==0 ){
	?>
	<tr class="row1">
		<td colspan="2"><strong>No se han creado eventos para esta referencia</strong></td>
	</tr>
	<?	
	}
	foreach( $eventos as $evento ){
	?>
	<tr class="row1">
		<td><div align="left">
			<?=Utils::fechaMes(substr($evento->getCaFchevento(),0,10))." ".substr($evento->getCaFchevento(),10) ?>
		</div></td>
		<td><div align="left">
			<?=$evento->getEvento()." ". $evento->getCaNotas()?>
		</div></td>
	</tr>
	<?
	}
	?>
</table>

<br />


<table width="90%" border="1" class="table1">
	<tr>
		<th colspan="2" scope="col">Eventos extra de la referencia </th>
	</tr>
	<tr class="row0">
		<td width="23%"><strong>Fecha/Hora</strong></td>
		<td><strong>Evento</strong></td>
	</tr>
	
	<?
	if( count($eventosExtra)==0 ){
	?>
	<tr class="row1">
		<td colspan="2"><strong>No se han creado eventos extra para esta referencia</strong></td>
	</tr>
	<?	
	}
	foreach( $eventosExtra as $evento ){
	?>
	<tr class="row1">
		<td><div align="left">
			<?=Utils::fechaMes(substr($evento->getCaFchcreado(),0,10))." ".substr($evento->getCaFchcreado(),10) ?>
		</div></td>
		<td><div align="left">
			<?=$evento->getCaTexto()?>
		</div></td>
	</tr>
	<?
	}
	?>
</table>

