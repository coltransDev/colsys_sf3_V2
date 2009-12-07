<?
/*
* Muestra los resultados de la busqueda de la cotización 
* @author Andres Botero
*/	
?>
<div align="center">
<?
$url = "ino/busqueda?modo=".$modo."&criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".$cadena;
}


$pagerLayout = new Doctrine_Pager_Layout(
      $pager,
      new Doctrine_Pager_Range_Sliding(array(
            'chunk' => 5
      )),
      url_for($url)."?page={%page_number}"
);

$pagerLayout->setTemplate('<a href="{%url}">{%page}</a> ');
$pagerLayout->setSelectedTemplate('{%page}');


$idsList = $pager->execute();

$pagerLayout->display();


?>
<br />
<br />

<table class="tableList" width="800px" border="1" id="mainTable">
	<tr>
		<th width="57" scope="col">Referencia</th>
		<th width="668" colspan="4" scope="col">Detalles</th>
	</tr>
	<?
	
	foreach( $refList as $referencia ){
		
	?>
	<tr>
	  <td rowspan="2"  >
        <?=link_to($referencia->getCaReferencia(), "ino/verReferencia?modo=".$modo."&id=".$referencia->getCaIdmaestra())?>
          <?=$referencia->getCaFchanulado()?"<br />Anulada":""?>
      </td>
	  <td ><b>Fch :</b><br />
      &nbsp;</td>
      <td ><b>Cliente:</b><br />
      &nbsp;</td>
      <td ><b> </b><br />
      &nbsp;</td>
	  <td ><b>Vendedor:</b><br />
        &nbsp;</td>
	</tr>
	<tr>
	  <td colspan="4" >
          &nbsp;
	  	</td>
    </tr>
	
	<?
	}
	if( count($refList)==0 ){
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
