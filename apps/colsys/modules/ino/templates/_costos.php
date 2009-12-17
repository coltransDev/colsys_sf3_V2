<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList" width="100%">
    <tr>
        <th colspan="5">Cuadro de costos de la referencia</th>
        
    </tr>
    <tr class="row0">
        <td><b>Costo</b></td>
        <td><b>Proveedor</b></td>
        <td><b>Comprobante</b></td>
        <td><b>Valor</b></td>
    </tr>
    <?
    foreach( $costos as $costo ){
    ?>
    <tr >
        <td><?=$costo["con_ca_concepto"]?></td>
        <td><?=$costo["id_ca_nombre"]?></td>
        <td><?=$costo["tp_ca_tipo"].str_pad($costo["tp_ca_comprobante"],3, "0", STR_PAD_LEFT)."-".str_pad($costo["c_ca_consecutivo"],7, "0", STR_PAD_LEFT)?></td>
        <td><?=$costo["t_ca_valor"]?></td>
    </tr>
    <?
    }
    ?>
</table>