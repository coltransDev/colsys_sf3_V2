<?
if( count($productos)>0 || $editable ){
?>
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
			<div id="result"></div>
			<div id="impoexpo_<?=$producto->getCaIdproducto()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){
				?>
					onclick="editarGrilla('impoexpo_<?=$producto->getCaIdproducto()?>')"
				<?
				}
				?>
				>
				<?=$producto->getCaImpoexpo()?>
			</div>
			
			<?
			if( $editable ){			
				?>
				<div id="impoexpo_<?=$producto->getCaIdproducto()?>_div_hd" align="center" style="display:none">
					<?=select_tag("impoexpo_".$producto->getCaIdproducto(), options_for_select(array("Importaci&oacute;n"=>"Importaci&oacute;n","Exportaci&oacute;n"=>"Exportaci&oacute;n"), $producto->getCaImpoexpo(), "include_blank=true") ); ?>
				</div>
				<?
				echo observe_field("impoexpo_".$producto->getCaIdproducto(), array('update' => 'result',
															'url' => 'cotizaciones/observeProductos?cotizacionId='.$cotizacion->getCaIdcotizacion().'&productoId='.$producto->getCaIdproducto()."&token=".md5(time()),
															'with' => "'impoexpo='+value",
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
		No se han definido productos para la cotizaci&oacuoten
	</div>
<?
}
?>