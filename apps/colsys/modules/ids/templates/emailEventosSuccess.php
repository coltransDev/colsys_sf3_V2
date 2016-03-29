<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div class="content" align="center">
    <h1>Evento registrado para el proveedor:  <?=  strtoupper($compania)?></h1>
    <br />
    <table class="tableList" width="80%">
        <tr>
            <th>Evento</th>
            <th>Documento</th>
            <th>Criterio</th>
        </tr>        
        <tr>
            <td><?=$evento?></td>
            <td><?=$documento?$documento:"No registra"?></td>
            <td><?=$criterio?></td>
        </tr>
    </table>
</div>