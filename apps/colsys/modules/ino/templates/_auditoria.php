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
        <th><div align="center" ><?=link_to(image_tag("16x16/edit_add.gif"), "ino/formAuditoria?modo=".$modo."&id=".$referencia->getCaIdmaestra())?></div></th>
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
    /*foreach( $inoClientes as $inoCliente ){
        ?>
        <tr >
            <td><?=$inoCliente->getIds()->getCaIdalterno()?></td>
            <td><?=$inoCliente->getIds()->getCaNombre()?></td>
            <td><?=$inoCliente->getCaVendedor()?></td>
            <td><?=$inoCliente->getCaIdreporte()?></td>
            <td><?=$inoCliente->getCaDoctransporte()?></td>
            <td><?=$inoCliente->getCaNumpiezas()?></td>
            <td><?=$inoCliente->getCaPeso()?></td>
            <td><?=$inoCliente->getCaVolumen()?></td>
            <td><?=$inoCliente->getProveedor()->getCaNombre()?></td>
            <td> <?=link_to(image_tag("16x16/edit.gif"), "ino/formClientes?modo=".$modo."&id=".$referencia->getCaIdmaestra()."&idinocliente=".$inoCliente->getCaIdinocliente())?> </td>
        </tr>
        <?
    }*/
    ?>
</table>


