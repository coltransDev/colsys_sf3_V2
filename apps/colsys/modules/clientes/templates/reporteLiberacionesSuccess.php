<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="content" align="center">
    Listado de Liberaciones <b><?=strtoupper($cliente)?></b><br />
    Periodo: <b><?=$inicio?></b> a <b><?=$final?></b><br />
    <table border="1" class="tableList" width="70%">
        <thead>
            <tr>
                <th align="center">Fch. Liberacion</th>
                <th>Referencia</th>
                <th>Factura</th>
                <th>Hbls</th>
                <th>Nota Liberacion</th>
            </tr>
            <?
        foreach ($listado as $lista){
            ?>
            <tr>
                <td><?=$lista['ca_fchliberacion']?></td>
                <td><a href="/colsys_php/inosea.php?boton=Consultar&id=<?=$lista['ca_referencia']?>"><?=$lista['ca_referencia']?></a></td>
                <td><?=$lista['ca_factura']?></td>
                <td><?=$lista['ca_hbls']?></td>
                <td><?=$lista['ca_notaliberacion']?></td>
            </tr>
    <?
    }
    ?>
        </thead>
    </table>
    <a href="listadoLiberaciones">Regresar</a>
</div>