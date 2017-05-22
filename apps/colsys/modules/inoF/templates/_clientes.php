<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<table class="tableList" width="100%">
    <tr>
        <th colspan="9">Cuadro de clientes de la referencia</th>
        <th><div align="center" ><?=link_to(image_tag("16x16/add_user.gif"), "inoF/formClientes?modo=".$modo."&id=".$referencia->getCaIdmaestra())?></div></th>
    </tr>
    <tr class="row0">
        <td><b>Id Cliente</b></td>
        <td><b>Cliente</b></td>
        <td><b>Vendedor</b></td>
        <td><b>Reporte</b></td>
        <td><b>HBL</b></td>
        <td><b>Piezas</b></td>
        <td><b>Peso</b></td>
        <td><b>Volumen</b></td>
        <td><b>Proveedor</b></td>
        <td>&nbsp;</td>
    </tr>
    <?
    foreach( $inoClientes as $inoCliente ){
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
            <td> <?=link_to(image_tag("16x16/edit.gif"), "inoF/formClientes?modo=".$modo."&id=".$referencia->getCaIdmaestra()."&idinocliente=".$inoCliente->getCaIdinocliente())?> </td>
        </tr>
        <?
    }
    ?>
</table>