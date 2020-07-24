<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div align="center">
<?
/*$url = "antecedentes/busquedaReferencia?criterio=".$criterio;
if( $cadena ){
	$url.="&cadena=".$cadena;
}


$pagerLayout = new Doctrine_Pager_Layout($pager,new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),url_for($url)."?page={%page_number}");
$pagerLayout->setTemplate('<a href="{%url}">{%page}</a> ');
$pagerLayout->setSelectedTemplate('{%page}');
$idsList = $pager->execute();

$pagerLayout->display();*/
?>
<br />
<br />

    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Master</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
        </tr>
        <?
        foreach( $referencias as $referencia ){
        ?>
        <tr>
            <td  >
                <?=link_to($referencia->getCaReferencia(), "antecedentes/verPlanilla?idmaster=".$referencia->getCaIdmaster())?>
            </td>
            <td  >
                <?=$referencia->getCaModalidad()?>
            </td>
            <td  >
                <?=$referencia->getOrigen()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getDestino()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getCaMaster()?>
            </td>
            <td  >
                <?=$referencia->getCaMotonave()?>
            </td>
            <td  >
                <?=$referencia->getCaFchsalida()?>
            </td>
            <td  >
                <?=$referencia->getCaFchllegada()?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>

</div>