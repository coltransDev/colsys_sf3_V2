<table cellspacing="1" border="1">
	<tr>
		<th class="titulo" colspan="7">Consulta a Maestra de Cotizaciones</th>
	</tr>
	<tr>
		<th>Cotizaci&oacute;n</th>
		<th>Nombre del Cliente</th>
		<th>Contacto</th>
		<th>Trayecto</th>
		<th>&nbsp;</th>
	</tr>
	<?
	foreach( $cotizaciones as $cotizacion ){	
		$contacto = $cotizacion->getContacto();
		$cliente = $contacto->getCliente();
		
		$productos = $cotizacion->getCotProductos();
		foreach( $productos as $producto ){
			
		/*
		
		* */
	?>	
	<tr onclick="javascript:seleccionCotizacion('expoReporteForm',  '<?=$producto->getCaIdCotizacion()?>', '<?=$producto->getId()?>');" >
		
		<td style='vertical-align:top;'><?=$cotizacion->getId()?></td>
		<td style='vertical-align:top;'><?=$cliente->getCaCompania()?>				</td>
		<td style='vertical-align:top;'><?=$contacto->getNombre()?></td>
		<td style='vertical-align:top;'>
			<?=substr($producto->getCaModalidad(),0,4)?>&raquo;
			<?=$producto->getOrigen()?> - <?=$producto->getDestino()?>
			<br />
			<?=$producto->getCaTransporte()?>
		</td>
		<?
		}	
		$url = 'https://www.coltrans.com.co/cotizacion.php?id='.$cotizacion->getId();			
		?>
		<td style='vertical-align:top;'>
			<?
			image_tag("24x24/pdf.gif",  "onClick=window.open(\"$url\")") 
			?> </td>
	</tr>
	<?
	}
	?>	
</table>
<br />
<table cellspacing="10">
	<tr>
		<th><?=button_to( "Regresar", "general/buscarCotizacion")?></th>
	</tr>
</table>
</form>

