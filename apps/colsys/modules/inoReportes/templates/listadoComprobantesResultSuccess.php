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
            <th>Emitido a</th>   
            <th>Doc. Transporte</th>
            <th>Valor </th>            
            <th>Cambio </th>
            <th>Moneda </th>
            <th>Valor <?=$monedaLocal?></th>            
            <th>Observaciones</th>
        </tr>                  
        <?
        foreach ($comps as $c) {
            ?>
            <tr>
                <td><?=link_to($c["InoHouse"]["InoMaster"]["ca_referencia"], "inoF/verReferenciaExt4?idmaster=".$c["InoHouse"]["InoMaster"]["ca_idmaster"], array("target"=>"_blank"))?></td>                
                <td><?= $c["InoHouse"]["InoMaster"]["ca_impoexpo"] ?></td>       
                <td><?= $c["InoHouse"]["InoMaster"]["ca_transporte"] ?></td>       
                <td><?= $c["InoHouse"]["InoMaster"]["ca_modalidad"] ?></td>       
                <td><?= $c["InoTipoComprobante"]["ca_tipo"].$c["InoTipoComprobante"]["ca_comprobante"]."-".$c["ca_consecutivo"] ?></td>    
                <td><?= $c["ca_fchcomprobante"] ?></td>             
                <td><?= $c["Ids"]["ca_nombre"] ?></td>
                <td><?= $c["InoHouse"]["ca_doctransporte"] ?></td>                
                <td><div align="right"><?= Utils::formatNumber($c["ca_valor"], 2) ?> </div></td>
                <td><div align="right"><?= Utils::formatNumber($c["ca_tcambio"], 2) ?> </div></td>
                <td><div align="right"><?= $c["ca_idmoneda"] ?></div></td>
                <td><div align="right"><?= Utils::formatNumber(round($c["ca_tcambio"]*$c["ca_valor"]), 2) ?> </div></td>                  
                <td><?= $c["InoHouse"]["InoMaster"]["ca_observaciones"] ?></td>
                
            </tr>
            <?
        }
        ?>
    </table>
</div>   
<?
?>