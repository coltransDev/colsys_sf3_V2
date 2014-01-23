<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($reportes);
?>

<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>

<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>APROBACION DTM Y CONTINUACION DE VIAJE</caption>        
        <tr style ="text-align:center"><th >Reporte</th><th>Nit</th><th  >Cliente</th><th  >Origen</th><th  >Destino</th> <th>Continuacion</th> <th>DTM</th></tr>
        
        <?
        foreach($reportes as $r)
        {
        ?>
        <tr ><td ><?=$r["ca_consecutivo"]?></td><td><?=$r["ca_idalterno"]?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_origen"]?></td><td><?=$r["ca_destino"]?></td>
            <td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/OTM" target="_blank">Ver</a></td><td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/DTM" target="_blank">Ver</a></td>
        </tr>
        <?
        }
        ?>
</table>
    


