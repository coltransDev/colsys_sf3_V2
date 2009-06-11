<table class="tableList" >
	<tr>
		<th>Origen</th>
		<th>Destino</th>
		<th>Linea</th>
		<th>Conceptos</th>		
	</tr>
	<?
	foreach( $trayectos as $trayecto ){
		$transportador = $trayecto->getTransportador();	
		$fletes = $trayecto->getFletes();
	?>
	<tr>
		<td><?=$trayecto->getOrigen()?></td>
		<td><?=$trayecto->getDestino()?></td>
		<td><?=$transportador?$transportador->getCaNombre():""?></td>
		<td>
			<?
			foreach($fletes as $flete ){
				$concepto = $flete->getConcepto();
				echo "<b>".$concepto->getCaConcepto()."</b><br>";
				
				$recargos = $flete->getRecargoFletes();
				
				foreach( $recargos as $recargo ){
					echo "".$recargo->getTipoRecargo()->getCaRecargo()."<br>";
				}
			}
			?>
		</td>
	</tr>
	<?
	}
	?>
</table>

