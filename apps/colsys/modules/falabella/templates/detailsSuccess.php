<?
use_helper("Javascript","Object");
?>

<script language='JavaScript' type='text/JavaScript'>
function recalcular_tot(){
	var var_element = document.getElementById('tot_carga');
	var_element.value = 0;
	for (cont=0; cont<form_details.elements.length; cont++) {
		if (form_details.elements[cont].name.substring(0, 13) == 'num_unidades_') {
			var_element.value = Math.round(var_element.value) + Math.round(form_details.elements[cont].value);
		}
	}
	var_element = document.getElementById('por_diferencia');
	var_element.value = 100-(Math.round(document.getElementById('tot_carga').value / document.getElementById('tot_pedido').value * 100));
}

function repeat_cont(object){
	var sku = object.name.substring(object.name.lastIndexOf('_')+1);
	var source = document.getElementById('repeat_' + sku);
	for (cont=0; cont<form_details.elements.length; cont++) {
		var target = form_details.elements[cont];
		if (target.type != 'checkbox' && target.type != 'select-one') {
			continue;
		}else if (target.checked || target.selected){
			var src_name = source.value;
			var trg_name = target.value;
			var src_element1 = document.getElementById('cont_part1_' + src_name);
			var trg_element1 = document.getElementById('cont_part1_' + trg_name);
			trg_element1.value = src_element1.value; 
			var src_element2 = document.getElementById('cont_part2_' + src_name);
			var trg_element2 = document.getElementById('cont_part2_' + trg_name);
			trg_element2.value = src_element2.value; 
			var src_element3 = document.getElementById('cont_sell_' + src_name);
			var trg_element3 = document.getElementById('cont_sell_' + trg_name);
			trg_element3.value = src_element3.value;
			var src_element4 = document.getElementById('container_iso_' + src_name);
			var trg_element4 = document.getElementById('container_iso_' + trg_name);
			trg_element4.selectedIndex = src_element4.selectedIndex;
			var objname = document.getElementById('cont_part1_' + trg_name).name;
			sku = objname.substring(objname.lastIndexOf('_')+1);
			update_record(sku, trg_element1.value, trg_element2.value, trg_element3.value, trg_element4.value);
		}
	}
}

function update_record(sku , part1 , part2, sell, cont){
	<?
	echo remote_function(array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$fala_header->getCaIddoc()."&sku='+sku+'&cont_part1='+part1+'&cont_part2='+part2+'&cont_sell='+sell+'&container_iso='+cont" ));
	?>
}

function export_file(){
	if (Math.round(document.getElementById('por_diferencia').value) >= 20) {
		if (confirm('¿Desea generar una nueva order de pedido con la cantidad de productos faltantes?')) {
			document.location='<?=url_for("falabella/generarNuevaOrden?iddoc=".$fala_header->getCaIddoc())?>';
		}
	}else {
		document.location='<?=url_for("falabella/generarArchivo?iddoc=".$fala_header->getCaIddoc())?>';
	}
}
</script>

<?=form_tag( "falabella/details", "name=form_details" )?>
<table width="80%" border="0" cellspacing="0" cellpadding="0">
	
	<tr>
		<td colspan="6"><strong>Proovedor:</strong><br /><?php echo $fala_header->getCaNombreProveedor() ?></td>
	</tr>
	<tr>
		<td><strong>Traer reporte:</strong><br /><?=input_tag("reporte", $fala_header->getCaReporte())?>
		<?=button_to_remote("Buscar",array("url"=>"falabella/buscarReporte", 
											"update"=>"resultadoReporte",
											"with"=>"'iddoc=".$fala_header->getCaIddoc()."&reporte='+document.getElementById('reporte').value",
											'loading'  => visual_effect('appear', 'indicator'),
										    'complete' => visual_effect('fade', 'indicator')
											)
											)?><br />
			<div id="resultadoReporte"></div>		</td>
		<td><strong>Número del Viaje:</strong><br /><?
			echo input_tag("num_viaje", $fala_header->getCaNumViaje(), "size=12");
			echo observe_field("num_viaje", array("url"=>"falabella/observeHeader",
												"update"=>"result",
												"with"=>"'iddoc=".$fala_header->getCaIddoc()."&num_viaje='+document.getElementById('num_viaje').value",
												'loading'  => visual_effect('appear', 'indicator'),
												'complete' => visual_effect('fade', 'indicator')
												)
												)?></td>

		<td><strong>Codigo estandard Transportista:</strong><br /><?
			echo input_tag("cod_carrier", $fala_header->getCaCodCarrier(), "size=4 readOnly=true");
			echo observe_field("cod_carrier", array("url"=>"falabella/observeHeader",
												"update"=>"result",
												"with"=>"'iddoc=".$fala_header->getCaIddoc()."&cod_carrier='+document.getElementById('cod_carrier').value",
												'loading'  => visual_effect('appear', 'indicator'),
												'complete' => visual_effect('fade', 'indicator')
												)
												)?></td>

		<td><strong>Container Mode:</strong><br /><?
			echo select_tag("container_mode", options_for_select(array("LCL","CY/CY","CFS/CFS","CFS/CY"), $fala_header->getCaContainerMode(), "include_blank=true") );
			echo observe_field("container_mode", array("url"=>"falabella/observeHeader",
												"update"=>"result",
												"with"=>"'iddoc=".$fala_header->getCaIddoc()."&container_mode='+document.getElementById('container_mode').value",
												'loading'  => visual_effect('appear', 'indicator'),
												'complete' => visual_effect('fade', 'indicator')
												)
												)?></td>

		<td><strong>Numero de Factura:</strong><br /><?
			echo input_tag("numero_invoice", $fala_header->getCaProformaNumber(), "size=25 readOnly=true");
			echo observe_field("numero_invoice", array("url"=>"falabella/observeHeader",
												"update"=>"result",
												"with"=>"'iddoc=".$fala_header->getCaIddoc()."&numero_invoice='+document.getElementById('numero_invoice').value",
												'loading'  => visual_effect('appear', 'indicator'),
												'complete' => visual_effect('fade', 'indicator')
												)
												)?></td>

		<td><strong>Monto de Factura:</strong><br /><?
			echo input_tag("monto_invoice", $fala_header->getCaMontoInvoiceMiles(), "size=18");
			echo observe_field("monto_invoice", array("url"=>"falabella/observeHeader",
												"update"=>"result",
												"with"=>"'iddoc=".$fala_header->getCaIddoc()."&monto_invoice='+document.getElementById('monto_invoice').value",
												'loading'  => visual_effect('appear', 'indicator'),
												'complete' => visual_effect('fade', 'indicator')
												)
												)?></td>
	</tr>
</table>
<br />


<table width="80%" border="1" bordercolor="000000" cellspacing="0" cellpadding="0">
	<tr>
		<th scope="col">SKU</th>
		<th scope="col">Descripcion</th>
		<th scope="col">#u.pedidas </th>
		<th scope="col">#unidades </th>
		<th scope="col">#paquetes</th>
		<th scope="col">Peso</th>
		<th scope="col">Volumen</th>
		<th scope="col">Rep</th>
		<th scope="col" colspan=2>#Contenedor</th>
		<th scope="col">#Sello</th>
		<th scope="col">Tipo</th>
		<th scope="col">Dup</th>
	</tr>
<?
$tot_pedido = 0;
$tot_carga = 0;
foreach( $details as $detail ){
	$tot_pedido+= $detail->getCaCantidadPedido();
	$tot_carga+= $detail->getCaCantidadMiles();
?>

	<tr>
		<td align="left"><?=$detail->getCaSku()?></td>
		<td align="left"><?=$detail->getCaDescripcionItem()?></td>
		<td><?=$detail->getCaCantidadPedido()?></td>
		<td><div align="right">
			<?
			echo input_tag("num_unidades_".$detail->getCaSku(), $detail->getCaCantidadMiles(), "size=2 onchange='recalcular_tot();'");
			echo observe_field("num_unidades_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&num_unidades='+value" ));			

			echo select_tag("uni_unidades_".$detail->getCaSku(), options_for_select(array("PC"=>"Uni"), $detail->getCaUnidadMedidadCantidad(), "include_blank=true") );
			echo observe_field("uni_unidades_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&uni_unidades='+value" ));
			
			?>		
		</div></td>
		<td>
			<div align="right">
				<?
			echo input_tag("num_paquete_".$detail->getCaSku(), $detail->getCaCantidadPaquetesMiles(), "size=2");
			echo observe_field("num_paquete_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&num_paquetes='+value" ));
			
			echo select_tag("paq_unidades_".$detail->getCaSku(), options_for_select(array("CT"=>"Ctns"), $detail->getCaUnidadMedidaPaquetes(), "include_blank=true") );
			
			echo observe_field("paq_unidades_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&paq_unidades='+value" ));
			
			?>		
		</div></td>
		<td><div align="right">
			<?
			echo input_tag("peso_".$detail->getCaSku(), $detail->getCaCantidadPesoMiles(), "size=2");
			echo observe_field("peso_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&peso='+value" ));
			
			echo select_tag("pes_unidades_".$detail->getCaSku(), options_for_select(array("KG"=>"Kgs"), $detail->getCaUnidadMedidaPeso(), "include_blank=true") );
			
			echo observe_field("pes_unidades_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&pes_unidades='+value" ));
			
			?>
		</div></td>
		<td><div align="right">
			<?
			echo input_tag("volumen_".$detail->getCaSku(), $detail->getCaCantidadVolumenMiles(), "size=2");
			echo observe_field("volumen_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&volumen='+value" ));
			
			echo select_tag("vol_unidades_".$detail->getCaSku(), options_for_select(array("CR"=>"M&sup3;"), $detail->getCaUnidadMedidaVolumen(), "include_blank=true") );
			
			echo observe_field("vol_unidades_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&vol_unidades='+value" ));
			?>
		</div></td>
		<td><div align="right">
			<?
			echo checkbox_tag("repeat_".$detail->getCaSku(), $detail->getCaSku());
			?>
		</div></td>
		<td><div align="right">
			<?
			echo input_tag("cont_part1_".$detail->getCaSku(), $detail->getCaNumContPart1(), "size=4 onchange='repeat_cont(this);'");
			echo observe_field("cont_part1_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&cont_part1='+value" ));
			?>
		</div></td>
		<td><div align="right">
			<?
			echo input_tag("cont_part2_".$detail->getCaSku(), $detail->getCaNumContPart2(), "size=10 onchange='repeat_cont(this);'");
			echo observe_field("cont_part2_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&cont_part2='+value" ));
			?>
		</div></td>
		<td><div align="right">
			<?
			echo input_tag("cont_sell_".$detail->getCaSku(), $detail->getCaNumContSell(), "size=10 onchange='repeat_cont(this);'");
			echo observe_field("cont_sell_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&cont_sell='+value" ));
			?>
		</div></td>
		<td><div align="right">
			<?
			echo select_tag("container_iso_".$detail->getCaSku(), objects_for_select($container, "getCaValor2", "getCaValor", $detail->getCaContainerIso(), "include_blank=true"), array("onchange" => "repeat_cont(this);"));
			echo observe_field("container_iso_".$detail->getCaSku(), array("url"=>"falabella/observeDetail", "update"=>"result", "with"=>"'iddoc=".$detail->getCaIddoc()."&sku=".$detail->getCaSku()."&container_iso='+value" ));
			?>
		</div></td>
		<td><div align="right">
			<?
			echo link_to(image_tag("22x22/copy_newv.gif", "alt=Duplicar Registro size=22x22"), "falabella/duplicateRecord?iddoc=".urlencode($detail->getCaIddoc())."&sku=".$detail->getCaSku()."&container_iso='+value", "confirm='¿Esta seguro que desea duplicar el registro?'");
			?>
		</div></td>

</tr>
<?	
}
?>
<tr>
	<td colspan=2>Total Unidades<div align="right"></div></td>
	<td><div align="right">
		<?
		echo input_tag("tot_pedido", $tot_pedido, "size=10 readonly");
		?>
	</div></td>
	<td><div align="right">
		<?
		echo input_tag("tot_carga", $tot_carga, "size=10 readonly");
		?>
	</div></td>
	<td colspan=2><div align="left">
		<?
		echo input_tag("por_diferencia", (100-round($tot_carga/$tot_pedido * 100,0)), "size=3 readonly");
		?> % Faltante
	</div></td>
</tr>
</table>
</form>

<div id="result"></div>
