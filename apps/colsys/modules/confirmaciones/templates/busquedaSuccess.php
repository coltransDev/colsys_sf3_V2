<?
/*
* Muestra los resultados de la busqueda de la cotización 
* @author Andres Botero
*/	
?>
<div align="center">
<?
$url = "confirmaciones/busqueda?criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".str_replace(".", "-",$cadena);
}

if( $modo ){
	$url.="&modo=".$modo;
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
		<th width="57" scope="col">Referencia</th>
		<th width="668" scope="col">Linea</th>
	</tr>
	<?
	
	foreach( $pager->getResults() as $referencia ){	
		$linea = $referencia->getTransportador();
		$origen = $referencia->getOrigen();
		$destino = $referencia->getDestino();	
	?>
	<tr>
	  <td rowspan="2"  ><?=link_to($referencia->getCaReferencia(), "confirmaciones/consulta?referencia=".str_replace(".", "-", $referencia->getCaReferencia())."&modo=".$modo)?></td>
	  <td ><?=$linea->getCaNombre()?></td>
      </tr>
	<tr>
	  <td >
	  	<table class="tableList" width="100%" border="1">
       
        <tr>
        	<td class="listar" ><b>Trayecto</b></td>
        	<td class="listar"><b>Fch.Embarque</b></td>
        	<td class="listar"><b>Fch.Arrivo</b></td>
        	<td class="listar"><b>Motonave</b></td>
        	</tr>
        <tr>
          <td width="40%" class="listar" ><?=$origen->getTrafico()." ".$origen->getCaCiudad()?>
&raquo;
<?=$destino->getTrafico()." ".$destino->getCaCiudad()?></td>
          <td width="15%" class="listar"><?=$referencia->getCaFchembarque()?></td>
          <td width="11%" class="listar"><?=$referencia->getCaFcharribo()?></td>
          <td width="34%" class="listar"><?=$referencia->getCaMotonave()?></td>
          </tr>
      </table></td>
    </tr>
	
	<?
	}
	if( count($pager->getResults())==0 ){
	?>
	<tr>
		
		<td  colspan="2" scope="col"><div align="center">No hay resultados</div></td>
	</tr>
	<?
	}
	?>
</table>
<br />
<br />
</div>
