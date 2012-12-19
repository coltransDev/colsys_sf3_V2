<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>
<div class="content" align="center">
    <table class="tableList" width="50%">
        <tr>
            <th><b>Datos de la Bodega</b></th>
        </tr>
        <?
        if( $noeditable ) {
            ?>
        <tr>
            <td><div class="error">No se puede editar el registro</div></td>
        </tr>
            <?
        }
        ?>
        <tr>
            <td><b>Nombre:</b> <?=$bodega->getCaNombre()?></td>
        </tr>
        <tr>
            <td><b>Dirección:</b> <?=$bodega->getCaDireccion()?></td>
        </tr>
        <tr>
            <td><b>Tipo:</b> <?=$bodega->getCaTipo()?></td>
        </tr>
        <tr>
            <td><b>Transporte:</b> <?=$bodega->getCaTransporte()?></td>
        </tr>
        <tr>
            <td><?=link_to("Editar", "bodegas/edit?ca_idbodega=".$bodega->getCaIdbodega())?></td>
        </tr>
    </table>
</div>