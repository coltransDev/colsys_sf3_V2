<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>

<div class="content" align="center">

    <h2>IDG Satisfacción del Usuario</h2>
    <br />

    <table class="tableList alignLeft" width="50%">
        <thead>
            <tr>
                <th>Informes disponibles</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?=link_to("Informe Promedio usuarios Tickets","idgsistemas/informePromedioTicketsForm")?>
                </td>
            </tr>
            <tr>
                <td> <?=link_to("Informe Listado Evaluaciones","idgsistemas/informeListadoEvaluacionesForm")?>
                </td>
            </tr>      
            <tr>
                <td> <?=link_to("Reporte IDG Help Desk","idgsistemas/reporteIdgSistemas")?>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>
