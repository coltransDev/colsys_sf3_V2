<?
use_helper("Javascript","Popup");

$fileIdx = 0;

?>
<script language="javascript">
	function actualizar( referencia , factura )  { 
				
		<?=remote_function(	array('update'   => 'workPanel',
									'url'      => "digitalFile/verReferencia",
									'with'	=>  "'referencia='+referencia+'&factura='+factura",
									'loading'  => visual_effect('appear', 'indicator'),
									'complete' => visual_effect('fade', 'indicator'),
									'script' => true,
																	) )?>;
		
		
	}
</script>
<div id="workPanel">
<table width="90%" border="1" class="table1">
	<tr>
		<th width="100%"><?=$referencia->getCaReferencia()?></th>
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
			if( $factura && $ingreso->getCaFactura()!=$factura ){
				continue;
			}
		
		?>
		<tr class="row0">
			<td colspan="3" class="mostrar"><?=$ingreso->getCliente()->getCaCompania()?></td>
		</tr>
		<tr class="row0">
			<td width="46%" class="mostrar"><div align="left"><b>Factura</b><br />
				<?=$ingreso->getCaFactura()?>
			</div></td>
			<td colspan="2" class="mostrar"><div align="left"><b>Fecha factura</b><br />
				<?=$ingreso->getCaFchfactura()?>
			</div></td>
		</tr>
		<tr class="row1">
			<td colspan="3" class="mostrar"><b>Imagen de la factura </b></td>
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
																		'url'      => "digitalFile/eliminarArchivo?referencia=".str_replace(".","|",$numReferencia)."&idx=".$fileIdx,
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator')."actualizar( '".str_replace(".","|",$numReferencia)."', '$factura' );",
																		'confirm' => "Esta seguro que desea borrar el archivo?"
																		) );
																		
					$fileIdx++;
				}else{
					echo image_tag("22x22/alert.gif")." No ha cargado la factura<br />";
					
					echo link_to_remote("Haga click aqui para cargarla", array('update'   => 'cargarFactura'.$ingreso->getCaFactura(),
																		'url'      => "digitalFile/cargarArchivoForm?referencia=".str_replace(".","|",$numReferencia)."&factura=".urlencode($ingreso->getCaFactura())."&tipo=FACT",
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
			<td width="46%" class="mostrar"><div align="left"><b>Factura</b><br />
				<?=$ingreso->getCaFactura()?>
			</div></td>
			<td colspan="2" class="mostrar"><div align="left"><b>Fecha factura</b><br />
				<?=$ingreso->getCaFchfactura()?>
			</div></td>
		</tr>
		<tr class="row1">
			<td colspan="3" class="mostrar"><b>Imagen de la factura </b></td>
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
																		'url'      => "digitalFile/eliminarArchivo?referencia=".str_replace(".","|",$numReferencia)."&idx=".$fileIdx,
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator')."actualizar( '".str_replace(".","|",$numReferencia)."' );",
																		'confirm' => "Esta seguro que desea borrar el archivo?"
																		) );
																		
					$fileIdx++;
				}else{
					echo image_tag("22x22/alert.gif")." No ha cargado la factura<br />";
					
				/*	echo link_to_remote("Haz click aqui para cargarla", array('update'   => 'cargarFactura'.$ingreso->getCaFactura(),
																		'url'      => "digitalFile/cargarArchivoForm?referencia=".$numReferencia."&factura=".urlencode($ingreso->getCaFactura())."&tipo=FACT",
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator'),
																		) );
					*/	
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

<br />
<input type="button" value="Volver" onClick="document.location= '/inosea.php?boton=Consultar&id=<?=$numReferencia?>'" />
