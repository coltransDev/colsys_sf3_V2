<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>


<table class="tableList" width="100%">
            <tr>
                <th colspan="3">
                    Informaci&oacute;n
                </th>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Master:</b> <?=$master?>
                </td>
            </tr>
            <tr>
                <th>
                    Reporte
                </th>
                <th>
                    Cliente
                </th>
                <th>
                    Proveedor
                </th>
            </tr>

        <?
        foreach( $reportes as $reporte ){
        ?>
            <tr>
                <td>
                    <?=$reporte->getCaConsecutivo()?>
                </td>
                <td>
                    <?=$reporte->getCliente()?>
                </td>
                <td>
                    <?=$reporte->getProveedoresStr()?>
                </td>
            </tr>
        <?
        }
        ?>
        </table>