<?
use_helper("Javascript","Popup");

$fileIdx = 0;
?>
<div id="workPanel">
<table width="90%" border="1" class="table1">
	<tr>
		<th width="100%"><?=$numReferencia;?></th>
		</tr>
</table>



<?

//Muestra la opcion para cargar las facturas en Maritimo
if( $opcion=="maritimo" ){ 
	$ingresos = $referencia->getInoIngresosSeas();	
	?>
	<table width="90%" border="1">
		<?
		
		foreach( $ingresos as $ingreso ){
		?>
		<tr class="row0">
			<td colspan="3" class="mostrar"><?=$ingreso->getCliente()->getCaCompania()?></td>
		</tr>
		<tr class="row0">
			<td width="46%" class="mostrar"><div align="left"><strong>Factura</strong><br />
				<?=$ingreso->getCaFactura()?>
			</div></td>
			<td colspan="2" class="mostrar"><div align="left"><strong>Fecha factura</strong><br />
				<?=$ingreso->getCaFchfactura()?>
			</div></td>
		</tr>
		<tr class="row1">
			<td colspan="3" class="mostrar"><strong>Imagen de la factura </strong></td>
		</tr>
		<tr class="row1">
			<td colspan="3">
				<div id="cargarFactura<?=$ingreso->getCaFactura()?>">
					<?		
					
				$imagen = $ingreso->getImagenFactura();
				
				if( $imagen ){
					$user->addFile( $imagen );					
					echo link_popup(image_tag("22x22/pdf.gif")."Haz click aca para ver la factura","general/fileViewer?idx=".$fileIdx,"800","600");
					echo "&nbsp;&nbsp;&nbsp;&nbsp;";
					echo link_to_remote(image_tag("22x22/cancel.gif"), array('update'   => 'cargarFactura'.$ingreso->getCaFactura(),
																		'url'      => "digitalFile/eliminarArchivo?referencia=".$numReferencia."&idx=".$fileIdx,
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator')."actualizar( '$numReferencia' );",
																		'confirm' => "Esta seguro que desea borrar el archivo?"
																		) );
																		
					$fileIdx++;
				}else{
					echo image_tag("22x22/alert.gif")." No ha cargado la factura<br />";
					
					echo link_to_remote("Haz click aqui para cargarla", array('update'   => 'cargarFactura'.$ingreso->getCaFactura(),
																		'url'      => "digitalFile/cargarArchivoForm?referencia=".$numReferencia."&factura=".urlencode($ingreso->getCaFactura())."&tipo=FACT",
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator'),
																		) );
						
				}	
				?>
			</div></td>
		</tr>
		<?
		}
		?>
	</table>
<?
}



//Muestra la opcion para cargar las facturas en Maritimo
if( $opcion=="aereo" ){ 
	$ingresos = $referencia->getInoIngresosAirs();	
	?>
	<table width="90%" border="1">
		<?
		
		foreach( $ingresos as $ingreso ){
		?>
		<tr class="row0">
			<td colspan="3" class="mostrar"><?=$ingreso->getCliente()->getCaCompania()?></td>
		</tr>
		<tr class="row0">
			<td width="46%" class="mostrar"><div align="left"><strong>Factura</strong><br />
				<?=$ingreso->getCaFactura()?>
			</div></td>
			<td colspan="2" class="mostrar"><div align="left"><strong>Fecha factura</strong><br />
				<?=$ingreso->getCaFchfactura()?>
			</div></td>
		</tr>
		<tr class="row1">
			<td colspan="3" class="mostrar"><strong>Imagen de la factura </strong></td>
		</tr>
		<tr class="row1">
			<td colspan="3">
				<div id="cargarFactura<?=$ingreso->getCaFactura()?>">
					<?		
					
				$imagen = $ingreso->getImagenFactura();
				
				if( $imagen ){
					$user->addFile( $imagen );					
					echo link_popup(image_tag("22x22/pdf.gif")."Haz click aca para ver la factura","general/fileViewer?idx=".$fileIdx,"800","600");
					echo "&nbsp;&nbsp;&nbsp;&nbsp;";
					echo link_to_remote(image_tag("22x22/cancel.gif"), array('update'   => 'cargarFactura'.$ingreso->getCaFactura(),
																		'url'      => "digitalFile/eliminarArchivo?referencia=".$numReferencia."&idx=".$fileIdx,
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator')."actualizar( '$numReferencia' );",
																		'confirm' => "Esta seguro que desea borrar el archivo?"
																		) );
																		
					$fileIdx++;
				}else{
					echo image_tag("22x22/alert.gif")." No ha cargado la factura<br />";
					
					echo link_to_remote("Haz click aqui para cargarla", array('update'   => 'cargarFactura'.$ingreso->getCaFactura(),
																		'url'      => "digitalFile/cargarArchivoForm?referencia=".$numReferencia."&factura=".urlencode($ingreso->getCaFactura())."&tipo=FACT",
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator'),
																		) );
						
				}	
				?>
			</div></td>
		</tr>
		<?
		}
		?>
	</table>
<?
}
//Este codigo funciona pero no se va a ponera  funcionar todavia 
/*
?>
<table width="90%" border="1">
	<tr>
		<td width="49%">
		Otros archivos		</td>
		<td width="51%"><?=link_to_remote("Cargar archivo", array('update'   => 'workPanel',
																	'url'      => "digitalFile/cargarArchivoForm?referencia=".$numReferencia,
																	'loading'  => visual_effect('appear', 'indicator'),
																	'complete' => visual_effect('fade', 'indicator'),
																	) )?></td>
	</tr>
	<?	
	foreach( $files as $file ){
	?>
	<tr>
		<td colspan="2">
		<?
		$user->addFile( $file );	
	
		echo link_popup(basename($file),"general/fileViewer?idx=".$fileIdx,"800","600");
		$fileIdx++;
		?>			
		</td>
	</tr>
	<?
	}
	?>	
</table>
<?
*/
?>
</div>