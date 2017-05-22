<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="content" align="center">

    <table class="tableList alignLeft" width="500px;">
        <tr>
            <th colspan="2">
                &nbsp;
            </th>
        </tr>
        <tr>
            <td>
                <b>Facturación Clientes:</b> 
            </td>
            <td>
                <?=$totales["factCliente"]?>
            </td>
        </tr>
        <tr>
            <td>
                Costo Neto Embarque:
            </td>
            <td>
                <?=$totales["costo"]?>
            </td>
        </tr>
        <tr>
            <td>
                Menos Deducciones: ??
            </td>
        </tr>
        
        <tr>
            <td>
                INO Coltrans:
            </td>
        </tr>
        <tr>
            <td>
                INO Comisionable:
            </td>
        </tr>
        <tr>
            <td>
                Sobreventa:
            </td>
        </tr>
        <tr>
            <td>
                INO No Comisionable:
            </td>
        </tr>
    </table>
</div>
