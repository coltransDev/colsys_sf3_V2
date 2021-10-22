<?php
    $cargas = $sf_data->getRaw("cargas");   
?>
<div class="content" align="center">
    <h2>REPORTE ENVIO DE ANTECEDENTES</h2><br/>
    <table class="tableList"  border="1" id="mainTable">
        <tr>
            <th>TRA. ORIGEN</th>
            <th>ORIGEN</th>
            <th>DESTINO</th>
            <th>MODALIDAD</th>
            <th>CLIENTE</th>
            <!--<th>FCH. RN</th>-->
            <th>RN</th>
            <th>VER.</th>
            <th>MBL</th>
            <th>HBL</th>
            <th>MOTONAVE</th>
            <th>FCH. SALIDA</th>
            <th>FCH. ARRIBO</th>
            <th>DIAS</th>
            <th>FCH. LIMITE</th>            
            <th>STATUS</th>
            <th>ANTECEDENTE</th>
        </tr>
    <?
    foreach($cargas as $carga){        
        if($sucursal != $carga["ca_sucursal"]){
            ?>
            <th colspan="16"><b><?=$carga["ca_sucursal"]?></b></th>
            <?
        }
        $sucursal = $carga["ca_sucursal"];        
        $color = $carga["ca_color"];
        
        ?>
        <tr class="<?=$color?>">
            <td><?=$carga["ca_traorigen"]?></td>
            <td><?=$carga["ca_ciuorigen"]?></td>
            <td><?=$carga["ca_ciudestino"]?></td>
            <td><?=$carga["ca_modalidad"]?></td>
            <td><?=$carga["ca_compania"]?></td>
            <!--<td><?=$carga["ca_fchreporte"]?></td>-->
            <td><a href="/reportesNeg/consultaReporte/id/<?=$carga["ca_idreporte"]?>/modo/Mar%EDtimo/impoexpo/Importaci%F3n" target="_blank"><?=$carga["ca_consecutivo"]?></td>
            <td><?=$carga["ca_version"] ?></td>
            <td><?=$carga["ca_docmaster"]?></td>
            <td><?=$carga["ca_doctransporte"]?></td>
            <td><?=$carga["ca_motonave"]?></td>
            <td><?=$carga["ca_fchsalida"]?></td>
            <td><?=$carga["ca_fchllegada"]?></td>            
            <td><?=$carga["ca_dias"]?></td>
            <td><?=Utils::parseDate($carga["ca_fchlimite"])?></td>            
            <td><a href="/traficos/listaStatus/modo/maritimo?reporte=<?=$carga["ca_consecutivo"]?>" target="_blank">Ver Status</a></td>
            <?if($carga["ca_color"] == "green"){?>
                <td><a href="/antecedentes/verPlanilla/idmaster/<?=$carga["ca_idmaster"]?>" target="_blank">Ver Antecedente</a></td>
            <?}else{?>
                <td>&nbsp;</td>
            <?}?>
        </tr>
        <?        
    }
    ?>
    </table>
    <br/><br/>
    <h2>CONVENCIONES</h2><br/>
    <table class="tableList">        
        <tr class="yellow"><td>RN PENDIENTES POR ENVIO DE ANTECEDENTES</td></tr>
        <tr class="pink"><td>RN QUE REQUIEREN ENVIO URGENTE DE ANTECEDENTES</td></tr>
        <tr class="green"><td>RN PENDIENTES POR DESBLOQUEAR</td></tr>
    </table>
</div>