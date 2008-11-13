<?
/*
* Muestra los resultados de la busqueda del reporte de negocios 
* @author Carlos G. López
*/	
?>

<?
$url = "cotizaciones/busquedaCotizacion?criterio=".$criterio."&cadena=".$cadena;

if ($pager->haveToPaginate()):   
	if ($pager->getPage() != 1):				
		 echo link_to(image_tag("first.png"), $url.'&page=1',"border=0 ") ;	
		 echo link_to(image_tag("previous.png"), $url.'&page='.$pager->getPreviousPage(),"border=0 ");									
	endif;		
   
	
  	foreach ($pager->getLinks() as $page): 
  		if( $page == $pager->getPage() ){
			echo $page;
		}else{
			echo link_to($page, $url.'&page='.$page	);	
		}
				
    	echo ($page != $pager->getCurrentMaxLink()) ? '-' : ''; 
  	endforeach; 
	if ($pager->getPage() != $pager->getLastPage() ):			
		 echo link_to(image_tag("next.png"), $url.'&page='.$pager->getNextPage(), "border=0 ");	
		 echo link_to(image_tag("last.png"), $url.'&page='.$pager->getLastPage(), "border=0 ");		
		
		
  	endif;
endif; 
?>
<br />
<br />

<table class="tableForm" width="800px" border="1" id="mainTable">
	<tr>
		<th width="57" scope="col">Consecutivo</th>
		<th width="668" scope="col">Cotizaci&oacute;n</th>
	</tr>
	<?
	
	foreach( $pager->getResults() as $cotizacion ){
		$contacto = $cotizacion->getContacto();
		$cliente = $contacto->getCliente(); 
	?>
	<tr>
		<td class="listar"><?=link_to("C".$cotizacion->getCaConsecutivo(), "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion())?></td>
		<td class="invertir">
			<table class="tableForm" width="100%" border="0">
				<tbody>
					<tr>
						<td width="10%" class="listar"><b>Fch.Cotizacion:</b><br /><?=$cotizacion->getCaFchCreado()?></td>
						<td width="45%" class="listar"><b>Cliente:</b><br /><?=$cliente?></td>
						<td width="45%" class="listar"><b>Contacto:</b><br /><?=$contacto->getNombre()?></td>
						<td class="listar">&nbsp;</td>
					</tr>
					<tr>
						<td class="listar"><b>Solicitud:</b><br /><?=$cotizacion->getCaFchSolicitud()."<br />".$cotizacion->getCaHoraSolicitud()?></td>
						<td class="listar"><b>Asunto:</b><br /><?=$cotizacion->getCaAsunto()?></td>
						<td class="listar"><b>Vendedor:</b><br />
						<?=$cotizacion->getCaUsuario()?></td>
						<td class="listar">&nbsp;</td>
					</tr>

					<tr>
						<td class="listar" colspan="4"><table class="tableForm" width="100%" border="0">
						<? 
						foreach( $cotizacion->getCotProductos() as $producto ){
							$origen = $producto->getOrigen();
							$destino = $producto->getDestino();
						?>
						<tr>
							<td class="listar"><b><?=$producto->getCaImpoExpo()?></b></td>
							<td class="listar" colspan=3><b><?=$producto->getCaProducto()?></b></td>
							<td class="listar"><b><?=$producto->getCaTransporte()?></b></td>
						</tr>
						<tr>
							<td class="invertir"><?=$producto->getCaModalidad()?></td>
							<td class="invertir"><?=$origen->getTrafico()?></td>
							<td class="invertir"><?=$origen->getCaCiudad()?></td>
							<td class="invertir"><?=$destino->getTrafico()?></td>
							<td class="invertir"><?=$destino->getCaCiudad()?></td>
						</tr>
						<tr>
							<td class="invertir" colspan=5></td>
						</tr>
						<?
							}
						?>
						</table></td>
					</tr>
				</tbody>
			</table></td>
	</tr>
	<?
		}
	?>
</table>
<br />
<br />
