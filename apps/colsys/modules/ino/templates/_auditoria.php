<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList" width="100%">
    <tr>
        <th colspan="7">Cuadro de auditoria</th>
        <th><div align="center" ><?=link_to(image_tag("16x16/edit_add.gif"), "ino/formAuditoria?modo=".$modo."&id=".$referencia->getCaIdmaster())?></div></th>
    </tr>
    <tr class="row0">
        <td><b>Fecha</b></td>
        <td><b>Tipo</b></td>
        <td><b>Cliente</b></td>
        <td><b>Asunto</b></td>
        <td><b>Sucursal</b></td>
        <td><b>Recuperacion/Otro</b></td>
        <td><b>Estado</b></td>
        <td>&nbsp;</td>
    </tr>
    <?
    /*foreach( $InoHouses as $InoHouse ){
        ?>
        <tr >
            <td><?=$InoHouse->getIds()->getCaIdalterno()?></td>
            <td><?=$InoHouse->getIds()->getCaNombre()?></td>
            <td><?=$InoHouse->getCaVendedor()?></td>
            <td><?=$InoHouse->getCaIdreporte()?></td>
            <td><?=$InoHouse->getCaDoctransporte()?></td>
            <td><?=$InoHouse->getCaNumpiezas()?></td>
            <td><?=$InoHouse->getCaPeso()?></td>
            <td><?=$InoHouse->getCaVolumen()?></td>
            <td><?=$InoHouse->getProveedor()->getCaNombre()?></td>
            <td> <?=link_to(image_tag("16x16/edit.gif"), "ino/formClientes?modo=".$modo."&id=".$referencia->getCaIdmaster()."&idInoHouse=".$InoHouse->getCaIdInoHouse())?> </td>
        </tr>
        <?
    }*/
    ?>
</table>


