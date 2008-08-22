<?
if( count($productos)>0 || $editable ){
?>
<script type="text/javascript">
	function editarTransporte(id){
		editarGrilla('transporte_'+id);
		editarGrilla('modalidad_'+id);
	}

	function soltarTransporte(id){
		actualizarGrilla('transporte_'+id);
		actualizarGrilla('modalidad_'+id);
	}

</script>
<div id="result"></div>
<table width="100%" border="0" id="mainTable">
	<tr>
		<th scope="col">Producto</th>
		<th scope="col">Impo/Expo</th>
		<th scope="col">Incoterms</th>
		<th scope="col">Transporte</th>		
		<th scope="col">Modalidad</th>
		<th scope="col">Origen</th>
		<th scope="col">Destino</th>
		<th scope="col">Imprimir</th>
		<th scope="col">Observaciones</th>
	</tr>
	<?		
	foreach( $productos as $producto ){
	?>
	<tr style='background:#F0F0F0' >
		<td ><strong><?=$producto->getCaProducto()?></strong></td>	
		<td >
			<div id="impoexpo_<?=$producto->getCaIdproducto()?>_div" align="center" style="display:inline" 
				<? if( $editable ){ ?>
					onclick="editarGrilla('impoexpo_<?=$producto->getCaIdproducto()?>')"
				<? } ?>
				> <?=$producto->getCaImpoexpo()?>
			</div>
			<? if( $editable ){	?>
				<div id="impoexpo_<?=$producto->getCaIdproducto()?>_div_hd" align="center" style="display:none">
					<?=select_tag("impoexpo_".$producto->getCaIdproducto(), options_for_select(array("Importación"=>"Importaci&oacute;n","Exportación"=>"Exportaci&oacute;n"), $producto->getCaImpoexpo(), "include_blank=true"), "onBlur=actualizarGrilla('impoexpo_".$producto->getCaIdproducto()."')" ); ?>
				</div>
				<?  echo observe_field("impoexpo_".$producto->getCaIdproducto(), array('update' => 'result',
															'url' => 'cotizaciones/observeProductos?cotizacionId='.$cotizacion->getCaIdcotizacion().'&productoId='.$producto->getCaIdproducto()."&token=".md5(time()),
															'with' => "'impoexpo='+value",
															) );
				}
			?>	
		</td>
		<td >
			<div id="incoterms_<?=$producto->getCaIdproducto()?>_div" align="center" style="display:inline" 
				<? if( $editable ){ ?>
					onclick="editarGrilla('incoterms_<?=$producto->getCaIdproducto()?>')"
				<? } ?>
				> <?=$producto->getCaIncoterms()?>
			</div>
			<? if( $editable ){	?>
				<div id="incoterms_<?=$producto->getCaIdproducto()?>_div_hd" align="center" style="display:none">
					<?=select_tag("incoterms_".$producto->getCaIdproducto(), objects_for_select($incoterms, "getCavalor", "getCavalor", $producto->getCaIncoterms()), "onBlur=actualizarGrilla('incoterms_".$producto->getCaIdproducto()."')" ); ?>
				</div>
				<?  echo observe_field("incoterms_".$producto->getCaIdproducto(), array('update' => 'result',
															'url' => 'cotizaciones/observeProductos?cotizacionId='.$cotizacion->getCaIdcotizacion().'&productoId='.$producto->getCaIdproducto()."&token=".md5(time()),
															'with' => "'incoterms='+value",
															) );
				}
			?>	
		</td>
		<td >
			<div id="transporte_<?=$producto->getCaIdproducto()?>_div" align="center" style="display:inline" 
				<? if( $editable ){ ?>
					onclick="editarTransporte('<?=$producto->getCaIdproducto()?>')"
				<? } ?>
				> <?=$producto->getCaTransporte()?>
			</div>
			<? if( $editable ){	?>
				<div id="transporte_<?=$producto->getCaIdproducto()?>_div_hd" align="center" style="display:none">
				
					
					<?=select_tag("transporte_".$producto->getCaIdproducto(), objects_for_select($transporte, "getCavalor", "getCavalor", $producto->getCaTransporte()), "onBlur=getElementById('modalidad_".$producto->getCaIdproducto()."').focus;" ); ?>
				</div>
				<?  echo observe_field("transporte_".$producto->getCaIdproducto(), array('update' => 'result',
															'url' => 'cotizaciones/observeProductos?cotizacionId='.$cotizacion->getCaIdcotizacion().'&productoId='.$producto->getCaIdproducto()."&token=".md5(time()),
															'with' => "'transporte='+value",
															) );
				}
			?>	
		</td>


		<td >
			<div id="modalidad_<?=$producto->getCaIdproducto()?>_div" align="center" style="display:inline" 
				<? if( $editable ){ ?>
					onclick="editarGrilla('modalidad_<?=$producto->getCaIdproducto()?>')"
				<? } ?>
				> <?=$producto->getCaModalidad()?>
			</div>
			<? if( $editable ){	?>
				<div id="modalidad_<?=$producto->getCaIdproducto()?>_div_hd" align="center" style="display:none">
					<?=select_tag("modalidad_".$producto->getCaIdproducto(), objects_for_select($modalidades, "getCavalor", "getCavalor", $producto->getCaModalidad()), "onBlur=soltarTransporte('".$producto->getCaIdproducto()."')" ); ?>
				</div>
				<?  echo observe_field("modalidad_".$producto->getCaIdproducto(), array('update' => 'result',
															'url' => 'cotizaciones/observeProductos?cotizacionId='.$cotizacion->getCaIdcotizacion().'&productoId='.$producto->getCaIdproducto()."&token=".md5(time()),
															'with' => "'modalidad='+value",
															) );
				}
			?>	
		</td>


		<td>
			<?
			if( $editable ){					
			/*	echo link_to_remote(image_tag("16x16/delete.gif"), array("url"=>"cotizaciones/eliminarProducto?cotizacionId=".$cotizacion->getCaIdcotizacion()."&productoId=".$cotizacion->getCaIdproducto()."&token=".md5(time().$cotizacion->getCaIdproducto()), 
																	"update"=>"embarque" ,
																	"script"=>true,
																	"confirm"=>"Esta seguro que desea eliminar este item?",
																	));*/
			}
			?>
		</td>
	</tr>
	<?
	}
	if( $editable ){
		?>
		<tr style='background:#F0F0F0' >
			<td>
				<div align="center">
					<?=form_error("producto")?>
					<?=input_tag("producto", $sf_params->get('producto'), "size=15 maxlength=50")?>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("impoexpo");?>
					<?=select_tag("impoexpo", options_for_select(array("Importación"=>"Importación","Exportación"=>"Exportación"), "", "include_blank=true") ); ?>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("incoterms");?>
					<?=select_tag("incoterms", objects_for_select($incoterms, "getCavalor", "getCavalor"), "", "include_blank=true"); ?>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("transporte");?>
					<?
					include_component("general", "comboTransporte");
					?>
					<input type="text" id="transporte" size="8"/>
					<?
					//select_tag("transporte", objects_for_select($transporte, "getCavalor", "getCavalor"), "", "include_blank=true"); ?>
				</div>
			</td>
			<td >
				<div align="left">
					<input type="text" id="modalidad" size="8"/>
					<?=form_error("modalidad");?>
					<?//=select_tag("modalidad", objects_for_select($modalidades, "getCavalor", "getCavalor"), "", "include_blank=true"); ?>
				</div>
			</td>
			<td >
				<?				
				echo submit_tag("Guardar");
				?>
			</td>
		</tr>
		<?
	}
	?>
</table>  


<?
}else{
?>
	<div align="center">
		No se han definido productos para la cotizaci&oacute;n
	</div>
<?
}
?>