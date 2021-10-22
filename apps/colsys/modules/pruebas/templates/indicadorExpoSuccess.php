<?php

/* 
 * To cha$row["ca_referencia"] = $master->getCaReferencia();            
            $row["ca_transporte"] = $master->getCaTransporte();
            $row["ca_modalidad"] = $master->getCaModalidad();
            $row["ca_aplicaidg"] = $aplicaidg;
            $row["ca_idcomprobante"] = $comprobante?$comprobante->getCaIdcomprobante():null;
            $row["ca_factura"] = $comprobante?$comprobante->getCaConsecutivo():null;
            $row["ca_fchini"] = $comprobante?$options["fchini"]:null;
            $row["ca_fchend"] = $comprobante?$fchend:null;
            $row["ca_idg"] = $comprobante?$calculo:null;
            $row["ca_estado"] = $comprobante?$estado:null;
            $row["ca_idexclusion"] = $comprobante?$idexclusion:null;            
            $row["ca_observaciones"] = $options["observaciones"];nge this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($idg);
$idg = $sf_data->getRaw("idg");
?>

<table cellspacing="1" border="1" class="tableList">
    <tr>
        <th>Sucursal</th>
        <th>Referencia</th>
        <th>Transporte</th>
        <th>Modalidad</th>
        <th>Aplica Idg</th>        
        <th>Id Comprobante</th>
        <th>Id Idg</th>
        <th>Factura</th>
        <th>Fch. Ini.</th>
        <th>Fch. Fin</th>
        <th>Idg</th>
        <th>Estado</th>
        <th>Exclusion</th>
        <th>Eventos</th>
        <th>Observaciones</th>        
    </tr>
<?
    foreach ($idg as $i){
        ?>
        <tr bgcolor="<?=$i["ca_color"]?>">
            <td><?=$i["ca_sucursal"]?></td>
            <td><?=$i["ca_referencia"]?></td>
            <td><?=$i["ca_transporte"]?></td>
            <td><?=$i["ca_modalidad"]?></td>
            <td><?=$i["ca_aplicaidg"]?></td>
            <td><?=$i["ca_idcomprobante"]?></td>
            <td><?=$i["ca_id"]?></td>
            <td><?=$i["ca_factura"]?></td>
            <td><?=$i["ca_fchini"]?></td>
            <td><?=$i["ca_fchend"]?></td>
            <td><?=$i["ca_idg"]?></td>
            <td><?=$i["ca_estado"]?></td>
            <td><?=$i["ca_idexclusion"]?></td>
            <td><?=$i["ca_eventos"]?></td>
            <td><?=$i["ca_observaciones"]?></td>            
        </tr>
        <?
    }
    ?>
</table>
