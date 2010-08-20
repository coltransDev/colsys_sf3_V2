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
        <th><div align="center" ><a href="#" onclick="newHouse( <?=$referencia->getCaIdmaster()?> )"><?=image_tag("16x16/add_user.gif")?></a></div></th>
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
    
    foreach( $inoHouses as $inoHouse ){
        ?>        
        <tr >
            <td><?=$inoHouse->getCliente()->getCaIdcliente()?></td>
            <td><?=$inoHouse->getCliente()->getCaCompania()?></td>
            <td><?=$inoHouse->getCaVendedor()?></td>
            <td><?=$inoHouse->getCaIdreporte()?></td>
            <td><?=$inoHouse->getCaDoctransporte()?></td>
            <td><?=$inoHouse->getCaNumpiezas()?></td>
            <td><?=$inoHouse->getCaPeso()?></td>
            <td><?=$inoHouse->getCaVolumen()?></td>
            <td><?=$inoHouse->getProveedor()->getCaNombre()?></td>
            <td> <a href="#" onclick="editHouse( <?=$referencia->getCaIdmaster()?>, <?=$inoHouse->getCaIdhouse()?> )" ><?=image_tag("16x16/edit.gif")?></a> </td>
        </tr>
        <?
    }
    ?>
</table>