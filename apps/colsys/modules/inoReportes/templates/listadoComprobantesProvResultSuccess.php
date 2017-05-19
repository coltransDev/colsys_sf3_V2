<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
$comps = $sf_data->getRaw("comps");
?>
<div class="content" align="center" >
    <table width="90%" class="tableList"  >
        <tr>
           <th>Referencia</th>
           <th>Impo/Expo</th>
           <th>Transporte</th>
           <th>Modalidad</th>
           <th>Comprobante</th>
           <th>Fch. Comprobante</th>           
           <th>Emitido Por</th>   
           <th>Doc. Transporte</th>
           <th>Valor </th>
            <th>Cambio </th>
            <th>Cambio USD</th>
            <th>Moneda </th>
            <th>Valor  <?=$monedaLocal?></th>            
           <th>Observaciones</th>
         </tr>                 
         <?
         foreach( $comps as $c ){
         ?>
         <tr>
             <td><?=link_to($c["InoMaster"]["ca_referencia"], "inoF/verReferenciaExt4?idmaster=".$c["InoMaster"]["ca_idmaster"], array("target"=>"_blank"))?></td>                               
             <td><?=$c["InoMaster"]["ca_impoexpo"]?></td>       
             <td><?=$c["InoMaster"]["ca_transporte"]?></td>       
             <td><?=$c["InoMaster"]["ca_modalidad"]?></td>       
             <td><?=$c["ca_factura"]?></td>             
             <td><?=$c["ca_fchfactura"]?></td>    
             
             <td><?=$c["Ids"]["ca_nombre"]?></td>
             <td><?=$c["InoMaster"]["ca_master"]?></td> 
             <td><div align="right"><?= Utils::formatNumber($c["ca_neto"], 2) ?> </div></td>
             <td><div align="right"><?= Utils::formatNumber($c["ca_tcambio"], 2) ?> </div></td>
             <td><div align="right"><?= Utils::formatNumber($c["ca_tcambio_usd"], 2) ?> </div></td>
             <td><div align="right"><?= $c["ca_idmoneda"] ?></div></td>               
             <td><div align="right"><?= Utils::formatNumber(round($c["ca_tcambio"]*$c["ca_neto"]/$c["ca_tcambio_usd"]), 2) ?> </div></td>             
             <td><?=$c["InoMaster"]["ca_observaciones"]?></td>       
         </tr>
         <?
         }
         ?>
    </table>
</div>   
<?    


?>