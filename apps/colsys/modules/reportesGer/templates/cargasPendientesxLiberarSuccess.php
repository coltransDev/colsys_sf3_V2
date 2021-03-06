<?php
    $cargas = $sf_data->getRaw("cargas");   
?>
<div class="content" align="center">
    <h2>CARGAS PENDIENTES POR LIBERAR</h2><br/>
    <table class="tableList"  border="1" id="mainTable">
        <tr>
            <th>REFERENCIA</th>            
            <th>CLIENTE</th>            
            <th>MODALIDAD</th>
            <th width="100">ID CONTENEDOR</th>
            <th>SUCURSAL</th>
            <th>OTM</th>
            <th>OPERADOR</th>
            <th>FCH. ARRIBO</th>
            <th>FCH. LIBERACION<br/>CARTERA</th>
            <th>FCH. CIERRE<br/>REFERENCIA</th>
            <th>DIAS</th>
        </tr>
    <?
    foreach($cargas as $carga){        
        if(strpos($carga["ca_idetapa"], "OTTRA"))
            continue;
        if($puerto != $carga["destino"]){
            ?>
            <th colspan="14"><?=$carga["destino"]?></th>
            <?
        }
        $puerto = $carga["destino"];        
        $color = "";
        
        if($carga["ca_continuacion"]=="OTM"){
            $color = "green";
        }else if($carga["ca_fchliberacion"]==null){
            $color = "orange";        
        }else if($carga["ca_fchcerrado"] != null){
            $color = "pink";
        }
        ?>
        <tr class="<?=$color?>">
            <td><a href="/status/indexExt5/idmaster/<?=$carga["ca_idmaster"]?>" target="_blank"><?=$carga["ca_referencia"]?></a></td>            
            <td><?=$carga["ca_compania"]?></td>
            <td><?=$carga["ca_modalidad"]?></td>
            <td><?= $carga["ca_contenedores"] ?></td>
            <td><?=$carga["ca_sucursal"]?></td>
            <td><?=$carga["ca_continuacion"]?></td>
            <td><?=$carga["ca_bodega"]?></td>
            <td><?=$carga["ca_fcharribo"]?></td>
            <td><?=$carga["ca_fchliberacion"]?></td>
            <td><?=$carga["ca_fchcerrado"]?></td>
            <td><?=$carga["ca_dias"]?></td>
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