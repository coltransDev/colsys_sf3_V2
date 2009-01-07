<? 
Use_helper("Popup");
$fileIdx = 0;
foreach( $referenciasCliente as $referencia ){
	$maestra = $referencia->getInoMaestraAir();
?>
	<table width="90%" border="0" class="table1">
		<tr>
			<th colspan="5" scope="col">REFERENCIA 
			<?=$referencia->getCaReferencia();?></th>
		</tr>
		<tr>
			<td colspan="3">
				<div align="left"><strong>Proveedor</strong><br />
					<?
			$tercero =$referencia->getTercero();
			if( $tercero ){
				echo $tercero->getCaNombre();
			}else{
				echo "&nbsp;";
			}
			?>
				</div></td>
			<td width="19%"><div align="left"><strong>Origen</strong><br />
				<?=$maestra->getOrigen()?>
			</div></td>
			<td width="21%"><div align="left"><strong>Destino</strong><br />
				<?=$maestra->getDestino()?>		
			</div></td>
		</tr>
		<tr>
			<td width="19%"><div align="left"><strong>HAWB</strong> <br />
				<?=$referencia->getCaHawb()?>			
			</div></td>
			<td colspan="2"><div align="left"><strong>Piezas</strong> <br />
				<?=Utils::formatNumber($referencia->getCaNumpiezas())?>			
			</div></td>
			<td><div align="left"><strong>Peso Neto </strong> <br />
				<?=Utils::formatNumber($referencia->getCaPeso())?>			
			</div></td>
			<td><div align="left"><strong>Volumen </strong><br />
				<?=Utils::formatNumber($referencia->getCaVolumen())?>			
			</div></td>
		</tr>
		<?		
		$ingresos = $referencia->getInoIngresosAirs();
		foreach( $ingresos as $ingreso ){
		?>
		 
		<tr class="row0">
			<td><div align="left"><strong>Factura</strong><br />
				<?=$ingreso->getCaFactura()?>
			</div></td>
			<td width="22%"><div align="left"><strong>Valor factura</strong><br />
				<?=$ingreso->getCaValor()?>
			</div></td>
			<td width="19%"><div align="left"><strong>Tasa de cambio </strong><br />
				<?=$ingreso->getCaTcalaico()?>
			</div></td>
			<td width="19%"><div align="left"><strong>Fecha factura</strong><br />
					<?=$ingreso->getCaFchfactura()?>
</div></td>
			<td><div align="left"><strong>Recibo de caja </strong><br />
					<?=$ingreso->getCaReccaja()?$ingreso->getCaReccaja():"&nbsp;"?>
</div></td>
			
		</tr>
			<?
			$imagen = $ingreso->getImagenFactura();
					
			if( $imagen ){
			?>
		
		<tr class="row0">
			<td colspan="6"><?			
				
			$user->addFile( $imagen );					
			echo link_popup(image_tag("22x22/pdf.gif")."Haga click aca para ver la factura","general/fileViewer?idx=".$fileIdx,"800","600");
			$fileIdx++;
				
				?></td>
		</tr>		
		<?
			}	
		}
		?>
	</table>
	<br />
<?
}
?>
