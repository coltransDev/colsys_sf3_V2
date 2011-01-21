<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="content" align="center">
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
        </tr>
        <?
        foreach( $referencias as $referencia ){
            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia->getCaReferencia());

            if( $format ){
                $url.="&format=".$format;
            }

        ?>
        <tr>
            <td  >
                <?=link_to($referencia->getCaReferencia(), $url)?>
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
                <?=$referencia->getCaMotonave()?>
            </td>
            <td  >
                <?=$referencia->getCaFchembarque()?>
            </td>
            <td  >
                <?=$referencia->getCaFcharribo()?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>
</div>