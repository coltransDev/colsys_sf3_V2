<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="content" align="center">
    <table border="1" class="tableList" width="70%">
        <thead>
            <tr>
                <th align="center">Fch. Liberacion</th>
                <th>Liberacion realizada por</th>
                <th>Referencia</th>
                <th>Nit</th>
                <th>Cliente</th>
                <th>Factura</th>
                <th>Hbls</th>
                <th>Nota Liberacion</th>
            </tr>
            <?
        foreach ($listado as $lista){
            ?>
            <tr>
                <td><?=$lista['ca_fchliberacion']?></td>
                <td width="135"><?=$lista['ca_nombre']?></td>
                <td><a href="/colsys_php/inosea.php?boton=Consultar&id=<?=$lista['ca_referencia']?>"><?=$lista['ca_referencia']?></a></td>
                <td><?=$lista['ca_idcliente']?></td>
                <td><?=$lista['ca_compania']?></td>
                <td><?=$lista['ca_factura']?></td>
                <td><?=$lista['ca_hbls']?></td>
                <td><?=$lista['ca_notaliberacion']?></td>
            </tr>
    <?
    }
    ?>
        </thead>
    </table>
</div>