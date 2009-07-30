<?
/*
* Muestra los resultados de la busqueda de la cotización
* @author Andres Botero
*/
?>
<div align="center">
<?
$url = "ids/busqueda?modo=".$modo."&criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".$cadena;
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
		<th width="57" scope="col">Identificacion</th>
		<th width="668" colspan="4" scope="col">Nombre</th>
	</tr>
	<?

	foreach( $pager->getResults() as $ids ){
		
	?>
	<tr>
	  <td  ><?=link_to( $ids->getCaId(), "ids/verIds?modo=".$modo."&id=".$ids->getCaId())?></td>
	  <td ><b><?=$ids->getCaNombre()?></b>
      
      </td>
     
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
