<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<table class="tableList" width="100%">
    <tr>
        <th colspan="3">Cuadro de ingresos de la referencia</th>
        <th><div align="center" ><?=link_to(image_tag("16x16/edit_add.gif"), "ino/formComprobante?id=".$referencia->getCaIdmaestra())?></div></th>
    </tr>
    <tr class="row0">
        <td><b>Comprobante</b></td>
        <td><b>Fecha</b></td>
        <td><b>Valor</b></td>        
        <td>&nbsp;</td>
    </tr>
</table>