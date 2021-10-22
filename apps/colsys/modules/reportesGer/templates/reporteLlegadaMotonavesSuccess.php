<?php
    $cargas = $sf_data->getRaw("cargas");   
?>
<div class="content" align="center">
    <h2>REPORTE LLEGADA MOTONAVES ULTIMOS 90 DIAS</h2><br/>
    <table class="tableList"  border="1" id="mainTable">
        <tr>
            <th>REFERENCIA</th>
            <th>ORIGEN</th>
            <th>DESTINO</th>
            <th>DOC. TRANSPORTE</th>
            <th>R.N.</th>
            <th>MASTER</th>
            <th>FCH. LLEGADA</th>            
            <th>BANDERA</th>
            <th>CICLO</th>            
            <th>MOTONAVE</th>
            <th>FCH. REGISTRO ADU</th>
            <th>REGISTRO ADU</th>
            <th>MUELLE</th>
            <th>FCH. VACIADO</th>
            <th>STATUS</th>
        </tr>
    <?
    foreach($cargas as $carga){        
        ?>
        <tr>
            <td><?=$carga["ca_referencia"]?></td>
            <td><?=$carga["ca_origen"]?></td>
            <td><?=$carga["ca_destino"]?></td>
            <td><?=$carga["ca_doctransporte"]?></td>            
            <td><a href="/reportesNeg/verReporte/id/<?=$carga["ca_idreporte"]?>/modo/Mar%EDtimo/impoexpo/Importaci%F3n" target="_blank"><?=$carga["ca_consecutivo"]?></td>            
            <td><?=$carga["ca_master"]?></td>            
            <td><?=$carga["ca_fchllegada"]?>&nbsp;<?=$carga["ca_horallegada"]?></td>
            <td><?=$carga["ca_bandera"]?></td>
            <td><?=$carga["ca_ciclo"]?></td>
            <td><?=$carga["ca_motonave"]?></td>
            <td><?=$carga["ca_fchregistroadu"]?></td>
            <td><?=$carga["ca_registroadu"]?></td>
            <td><?=$carga["ca_muelle"]?></td>
            <td><?=$carga["ca_fchvaciado"]?>&nbsp;<?=$carga["ca_horavaciado"]?></td>            
            <td><a href="/traficos/listaStatus/modo/maritimo?reporte=<?=$carga["ca_consecutivo"]?>" target="_blank">Ver Status</a></td>            
        </tr>
        <?        
    }
    ?>
    </table>
    <br/><br/>    
</div>