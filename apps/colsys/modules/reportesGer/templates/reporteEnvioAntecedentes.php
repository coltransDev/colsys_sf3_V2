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
            <th>FCH. RN</th>
            <th>RN</th>
            <th>VER.</th>
            <th>MBL</th>
            <th>HBL</th>
            <th>FCH. SALIDA</th>
            <th>FCH. ARRIBO</th>
            <th>DIAS</th>
            <th>FCH. LIMITE</th>            
        </tr>
    <?
    foreach($cargas as $carga){        
        if($sucursal != $carga["ca_sucursal"]){
            ?>
            <th colspan="14"><?=$carga["ca_sucursal"]?></th>
            <?
        }
        $puerto = $carga["ca_sucursal"];        
        
        ?>
        <tr class="<?=$color?>">
            <td><?=$carga["ca_traorigen"]?></td>
            <td><?=$carga["ca_ciuorigen"]?></td>
            <td><?=$carga["ca_ciudestino"]?></td>
            <td><?=$carga["ca_modalidad"]?></td>
            <td><?=$carga["ca_compania"]?></td>
            <td><?=$carga["ca_fchreporte"]?></td>
            <td><?=$carga["ca_consecutivo"]?></td>
            <td><?=$carga["ca_version"] ?></td>
            <td><?=$carga["ca_docmaster"]?></td>
            <td><?=$carga["ca_doctransporte"]?></td>
            <td><?=$carga["ca_fchsalida"]?></td>
            <td><?=$carga["ca_fchllegada"]?></td>
            <td><?=$carga["ca_dias"]?></td>
            <td><?=$carga["ca_fchlimite"]?></td>            
        </tr>
        <?        
    }
    ?>
    </table>
    <br/><br/>
    <h2>CONVENCIONES</h2><br/>
    <table class="tableList">        
        <tr class="orange"><td>CARGAS SIN LIBERACION DE CARTERA</td></tr>
        <tr class="pink"><td>CARGAS CERRADAS SIN LIBERACION POR PUERTO</td></tr>
        <tr class="green"><td>CARGAS EN OTM</td></tr>
    </table>
</div>