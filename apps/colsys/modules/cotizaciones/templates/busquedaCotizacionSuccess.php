<?
/*
* Muestra los resultados de la busqueda de la cotización 
* @author Andres Botero
*/	
?>
<div align="center">
<?
$url = "cotizaciones/busquedaCotizacion?criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".$cadena;
}

if( $login ){
	$url.="&login=".$login;
}

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

<table class="tableList" width="800px" border="1" id="mainTable">
	<tr>
		<th width="57" scope="col">Consecutivo</th>
		<th width="668" colspan="4" scope="col">Cotizaci&oacute;n</th>
	</tr>
	<?
	
	foreach( $pager->getResults() as $cotizacion ){
		$contacto = $cotizacion->getContacto();
		$cliente = $contacto->getCliente(); 
	?>
	<tr>
	  <td rowspan="2"  ><?=link_to("C".$cotizacion->getCaConsecutivo(), "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion())?></td>
	  <td ><b>Fch.Cotizacion:</b><br />
      <?=$cotizacion->getCaFchCreado()?></td>
      <td ><b>Cliente:</b><br />
      <?=$cliente?></td>
      <td ><b>Contacto:</b><br />
      <?=$contacto->getNombre()?></td>
	  <td ><b>Vendedor:</b><br />
        <?=$cotizacion->getCaUsuario()?></td>
	</tr>
	<tr>
	  <td colspan="4" >
	  	<b>Trayectos:</b>
	  	<table class="tableList" width="100%" border="1">
        <? 
						foreach( $cotizacion->getCotProductos() as $producto ){
							$origen = $producto->getOrigen();
							$destino = $producto->getDestino();
						?>
        <tr>
          <td width="33%" class="listar" >
            <?=$producto->getCaImpoExpo()?>
            &raquo;
			
            <?=$producto->getCaTransporte()?>
            &raquo;
            <?=$producto->getCaModalidad()?> [<?=$producto->getCaProducto()?>]</td>
          <td width="35%" class="listar"><?=$origen->getTrafico()." ".$origen->getCaCiudad()?>
            &raquo;
            <?=$destino->getTrafico()." ".$destino->getCaCiudad()?></td>
          </tr>
       
        <?
							}
						?>
      </table></td>
    </tr>
	
	<?
	}
	if( count($pager->getResults())==0 ){
	?>
	<tr>
		
		<td  colspan="5" scope="col"><div align="center">No hay resultados</div></td>
	</tr>
	<?
	}
	?>
	
	
</table>
<br />
<br />
</div>
