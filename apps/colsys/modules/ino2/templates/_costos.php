<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList" width="100%">
    <tr>
        <th colspan="3">Cuadro de costos de la referencia</th>
        <th><?=link_to(image_tag("16x16/edit_add.gif"),"inocomprobantes/formComprobante?tipo=P")?></th>
    </tr>
    <tr class="row0">
        <td><b>Costo</b></td>
        <td><b>Proveedor</b></td>
        <td><b>Comprobante</b></td>
        <td align="right"><b>Valor</b></td>
    </tr>
    <?
    foreach( $costos as $costo ){
    ?>
    <tr >
        <td><b><?=$costo["con_ca_concepto"]?></b></td>
        <td><?=$costo["id_ca_nombre"]?></td>
        <td><?=link_to($costo["tp_ca_tipo"].str_pad($costo["tp_ca_comprobante"],3, "0", STR_PAD_LEFT)."-".str_pad($costo["c_ca_consecutivo"],7, "0", STR_PAD_LEFT), "inocomprobantes/formComprobante?idcomprobante=".$costo["c_ca_idcomprobante"]."&idmaster=".$referencia->getCaIdmaster())?></td>
        <td align="right"><?=$costo["t_ca_valor"]." ".($costo["t_ca_db"]?"D":"C")?></td>
    </tr>
    <?
    }
    ?>
</table>