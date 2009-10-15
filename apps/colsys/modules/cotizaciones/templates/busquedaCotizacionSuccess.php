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

if( $seguimiento ){
	$url.="&seguimiento=".$seguimiento;
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
		<th width="57" scope="col">Consecutivo</th>
		<th width="668" colspan="4" scope="col">Cotizaci&oacute;n</th>
	</tr>
	<?
	
	foreach( $cotizaciones as $cotizacion ){
		$contacto = $cotizacion->getContacto();
		$cliente = $contacto->getCliente(); 
	?>
	<tr>
	  <td rowspan="2"  >
        <?=link_to("C".$cotizacion->getCaConsecutivo(), "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion())?>
          <?=$cotizacion->getCaFchanulado()?"<br />Anulada":""?>
      </td>
	  <td ><b>Fch.Cotizacion:</b><br />
      <?=$cotizacion->getCaFchcreado()?></td>
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
            <?=$producto->getCaImpoexpo()?>
            &raquo;			
            <?=$producto->getCaTransporte()?>
            &raquo;
            <?=$producto->getCaModalidad()?> [<?=$producto->getCaProducto()?>]</td>
          <td width="35%" class="listar"><?=$origen->getTrafico()." ".$origen->getCaCiudad()?>
            &raquo;
            <?=$destino->getTrafico()." ".$destino->getCaCiudad()?></td>
            <td width="35%" class="listar"><?=isset($estados[$producto->getCaEtapa()])?$estados[$producto->getCaEtapa()]:""?></td>
          </tr>
       
        <?
							}
						?>
      </table></td>
    </tr>
	
	<?
	}
	if( count($cotizaciones)==0 ){
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
