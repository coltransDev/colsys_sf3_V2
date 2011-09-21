<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
$refs = $sf_data->getRaw("refs");
?>
<div class="content" align="center" >
    <table width="90%" class="tableList"  >
        <tr>
           <th>Referencia</th>
           <th>Origen</th>
           <th>Destino</th>
           <th >Linea</th>
           <th>Peso</th>
           <th>Volumen</th>
           <th>Facturaci&oacute;n Clientes : </th>
           <th>Costo Neto: </th>
           <th>Deducciones: </th>
           <th>INO: </th>
           <th>INO Comisionable: </th>
           <th>INO No comisionable: </th>
         </tr>
         
         <?
         foreach( $refs as $r ){            
         ?>
         <tr>
           <td><?=link_to($r["ca_referencia"], "ino/verReferencia?idmaster=".$r["ca_idmaster"], array("target"=>"_blank"))?></td>
           <td><?=$r["Origen"]["ca_ciudad"]?></td>
           <td><?=$r["Destino"]["ca_ciudad"]?></td>
           <td><?=$r["IdsProveedor"]["Ids"]["ca_nombre"]?></td>
           <td><?=$r["ca_peso"]?></td>
           <td><?=$r["ca_volumen"]?></td>
           <td><?=$r["InoViIngreso"]["ca_valor"]?></td>
           <td><?=$r["InoViCosto"]["ca_valor"]?></td>
           <td>Deducciones: </td>
           <td><?=$r["InoViCosto"]["ca_venta"]-$r["InoViCosto"]["ca_valor"]?> </td>
           <td>INO Comisionable: </td>
           <td>INO No comisionable: </td>
         </tr>
         <?
         }
         ?>

    </table>    
</div>