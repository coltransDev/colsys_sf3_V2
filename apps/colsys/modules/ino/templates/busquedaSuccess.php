<?
/*
* Muestra los resultados de la busqueda de la cotización 
* @author Andres Botero
*/
?>

<?
if( $message ){
?>
<div align="center">
    <span class="rojo"><?=$message?></span>
</div>
<?
}
?>

<?

include_component("ino","panelFiltro", array("modo"=>$modo));
?>


<div align="center">
    
<?
$url = "ino/busqueda?modo=".$modo->getCaIdmodo()."&criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".$cadena;
}

if( $cadena ){
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

}

?>
<br />
<br />

<table class="tableList" width="800px" border="1" id="mainTable">
	<tr>
		<th width="57" scope="col">Referencia</th>
		<th width="668" colspan="4" scope="col">Detalles</th>
	</tr>
	<?
	if( isset($refList) ){
        foreach( $refList as $referencia ){

        ?>
        <tr style="border-bottom: #A0A0A0 solid 2px">
          <td >
            <?=link_to($referencia->getCaReferencia(), "ino/verReferencia?modo=".$modo->getCaIdmodo()."&idmaster=".$referencia->getCaIdmaster())?>
              <?=$referencia->getCaFchanulado()?"<br /><span class='rojo'>Anulada</span>":""?>
          </td>
          <td width="100%">
              <table width="100%">
                  <tr>
                      <td >
                          <b><?=$referencia->getIdsProveedor()->getIds()->getCaNombre()?></b>
                      </td>
                  </tr>
                  <tr>
                      <td width="100%" >
                          <table width="100%">
                              <tr style="font-weight: bold;background:#D2D2D2;"><td width="20%">Origen</td><td width="20%">Destino</td><td width="20%">Fech.Embarque</td><td width="20%">Fch.Arribo</td><td width="20%">Motonave</td><tr>
                                  <tr>
                                      <td><?=$referencia->getOrigen()->getCaCiudad()?></td>
                                      <td><?=$referencia->getDestino()->getCaCiudad()?></td>
                                      <td><?=$referencia->getCaFchsalida()?></td>
                                      <td><?=$referencia->getCaFchllegada()?></td>
                                      <td><?=$referencia->getCaIdnave()?></td>
                                  <tr>
                          </table>
                      </td>
                  </tr>
              </table>
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
    }
	?>
	
	
</table>
<br />
<br />
</div>
