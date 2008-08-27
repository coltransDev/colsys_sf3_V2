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
		<td >
			<div align="left">
				<? if( $editable ){ ?>
					<?=form_error("producto");?>
					<?include_component("cotizaciones", "comboProductos", array("cotizacion"=>$cotizacion, "id"=>$producto->getCaIdproducto()));?>
					<input type="text" id="combo_productos_<?=$producto->getCaIdproducto();?>" size="20" value="<?=$producto->getCaProducto();?>" />
				<? } else { ?>
					<?=$producto->getCaProducto()?>
				<? } ?>
			</div>
		</td>
		<td >
			<div align="left">
				<? if( $editable ){ ?>
					<?=form_error("impoexpo");?>
					<?include_component("general", "comboImpoexpo", array("id"=>$producto->getCaIdproducto()));?>
					<input type="text" id="combo_impoexpo_<?=$producto->getCaIdproducto();?>" size="10" value="<?=$producto->getCaImpoexpo();?>" />
				<? } else { ?>
					<?=$producto->getCaImpoexpo()?>
				<? } ?>
			</div>
		</td>
		<td >
			<div align="left">
				<? if( $editable ){ ?>
					<?=form_error("incoterms");?>
					<?include_component("general", "comboIncoterms", array("id"=>$producto->getCaIdproducto()));?>
					<input type="text" id="combo_incoterms_<?=$producto->getCaIdproducto();?>" size="25" value="<?=$producto->getCaIncoterms();?>" />
				<? } else { ?>
					<?=$producto->getCaIncoterms()?>
				<? } ?>
			</div>
		</td>
		<td >
			<div align="left">
				<? if( $editable ){ ?>
					<?=form_error("transporte");?>
					<?include_component("general", "comboTransporte", array("id"=>$producto->getCaIdproducto()));?>
					<input type="text" id="combo_transporte_<?=$producto->getCaIdproducto();?>" size="8" value="<?=$producto->getCaTransporte();?>" />
				<? } else { ?>
					<?=$producto->getCaTransporte()?>
				<? } ?>
			</div>
		</td>
		<td >
			<div align="left">
				<? if( $editable ){ ?>
					<?=form_error("modalidad");?>
					<input type="text" id="combo_modalidad_<?=$producto->getCaIdproducto();?>" size="8" value="<?=$producto->getCaModalidad();?>" />
				<? } else { ?>
					<?=$producto->getCaModalidad()?>
				<? } ?>
			</div>
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
				<div align="left">
					<?=form_error("producto");?>
					<?include_component("cotizaciones", "comboProductos", array("cotizacion"=>$cotizacion));?>
					<input type="text" id="combo_productos" size="20"/>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("impoexpo");?>
					<?include_component("general", "comboImpoexpo");?>
					<input type="text" id="combo_impoexpo" size="10"/>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("incoterms");?>
					<?include_component("general", "comboIncoterms");?>
					<input type="text" id="combo_incoterms" size="25"/>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("transporte");?>
					<?include_component("general", "comboTransporte");?>
					<input type="text" id="combo_transporte" size="8"/>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("modalidad");?>
					<input type="text" id="combo_modalidad" size="8"/>
				</div>
			</td>

			<td >
				<div align="left">
					<?=form_error("TraOrigen");?>
					<?//include_component("general", "comboTraOrigen", array("modo"=>"importacion"));?>
					<input type="text" id="combo_traorigen" size="10"/>
				</div>
			</td>
			<td >
				<div align="left">
					<?=form_error("CiuOrigen");?>
					<input type="text" id="combo_ciuorigen" size="10"/>
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