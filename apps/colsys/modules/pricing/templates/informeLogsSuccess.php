<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<?
include_component("pricing", "filtrosInformeLogs");
?>

<? if ($opcion) { ?>
    <table border="1" class="tableList" align="center" style="font-size: 10; width: 95%" >
        <th style="text-align: center" colspan="18"><b><? echo "ESTADISTICAS DE LOGS <br /> Periodo: " . $fechaInicial . " a " . $fechaFinal; ?></b></th>
        <tr>
            <th scope="col" style=" text-align: center"><b>Tipo</b></th>
            <th scope="col" style=" text-align: center"><b>Transporte</b></th>
            <th scope="col" style=" text-align: center"><b>Modalidad</b></th>
            <?
            switch ($typelog) {
                case 1:
                    ?>  
                    <th scope="col" style=" text-align: center"><b>Origen</b></th>
                    <th scope="col" style=" text-align: center"><b>Destino</b></th>
                    <th scope="col" style=" text-align: center"><b>Concepto</b></th>
                    <th scope="col" style=" text-align: center"><b>Línea</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr. Neto</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr. Sugerido</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación</b></th>
                    <?
                    break;
                case 2:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Tráfico</b></th>
                    <th scope="col" style=" text-align: center"><b>Ciudad</b></th>
                    <th scope="col" style=" text-align: center"><b>Recargo</b></th>
                    <th scope="col" style=" text-align: center"><b>Observaciones</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr/Rec</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr/Mín</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación Min</b></th>

                    <?
                    break;
                case 3:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Origen</b></th>
                    <th scope="col" style=" text-align: center"><b>Destino</b></th>
                    <th scope="col" style=" text-align: center"><b>Concepto</b></th>
                    <th scope="col" style=" text-align: center"><b>Recargo</b></th>
                    <th scope="col" style=" text-align: center"><b>Observaciones</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr/Rec</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr/Mín</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación Min</b></th>
                    <?
                    break;
                case 4:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Tráfico</b></th>
                    <th scope="col" style=" text-align: center"><b>Línea</b></th>
                    <th scope="col" style=" text-align: center"><b>Concepto</b></th>
                    <th scope="col" style=" text-align: center"><b>Recargo</b></th>
                    <th scope="col" style=" text-align: center"><b>Observaciones</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr/Rec</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación</b></th>
                    <th scope="col" style=" text-align: center"><b>Vlr/Mín</b></th>
                    <th scope="col" style=" text-align: center"><b>Aplicación Min</b></th>
                    <?
                    break;
                case 5:
                    ?>
                    <th scope="col" style=" text-align: center"><b>Origen</b></th>
                    <th scope="col" style=" text-align: center"><b>Destino</b></th>
                    <th scope="col" style=" text-align: center"><b>Línea</b></th>
                    <th scope="col" style=" text-align: center"><b>Frecuencia</b></th>
                    <th scope="col" style=" text-align: center"><b>T. Transito</b></th>
                    <th scope="col" style=" text-align: center; width: 80px;"><b>Observ. 1</b></th>
                    <th scope="col" style=" text-align: center"><b>Activo</b></th>
                    <th scope="col" style=" text-align: center"><b>N Contrato</b></th>
                    <th scope="col" style=" text-align: center"><b>Observ. 2</b></th>
                    <?
                    break;
            }
            if ($typelog != 5) {
                ?>

                <th scope="col" style=" text-align: center"><b>Moneda</b></th>
                <th scope="col" style=" text-align: center"><b>Fch. Inicio</b></th>
                <th scope="col" style=" text-align: center"><b>Fch. V/mto</b></th>
            <? } ?>
                <th scope="col" style=" text-align: center"><b>Fch. Creado</b></th>
                <th scope="col" style=" text-align: center"><b>Usu. Creado</b></th>
            <? if ($typelog != 5) { ?>
                <th scope="col" style=" text-align: center"><b>Fch. Eliminado</b></th>
            <? } ?>
        </tr><br /><br />
        <? foreach ($resul as $r) { ?>
            <tr>
                <td><?= $r["ca_impoexpo"] ?></td>
                <td><?= $r["ca_transporte"] ?></td>
                <td><?= $r["ca_modalidad"] ?></td>
                <?
                switch ($typelog) {
                    case 1:
                        ?> 
                        <td><?= $r["origen"] ?></td>
                        <td><?= $r["destino"] ?></td>
                        <td><?= $r["ca_concepto"] ?></td>
                        <td><?= $r["linea"] ?></td>
                        <td style=" text-align: right;"><?= $r["ca_vlrneto"] ?></td>
                        <td style=" text-align: right;"><?= $r["ca_vlrsugerido"] ?></td>
                        <td><?= $r["ca_aplicacion"] ?></td>
                        <?
                        break;
                    case 2:
                        ?>
                        <td><?= $r["trafico"] ?></td>
                        <td><?= $r["ciudad"] ?></td>
                        <td><?= $r["ca_concepto"] ?></td>
                        <td style="width: 30px"><?= $r["ca_observaciones"] ?></td>
                        <td style=" text-align: right;"><?= $r["ca_vlrrecago"]?></td>
                        <td><?= $r["ca_aplicacion"] ?></td>
                        <td style=" text-align: right;"><?= $r["ca_vlrminimo"]?></td>
                        <td><?= $r["ca_aplicacion_min"] ?></td>
                        <?
                        break;
                    case 3:
                        ?>
                        <td><?= $r["origen"] ?></td>
                        <td><?= $r["destino"] ?></td>
                        <td><?= $r["concepto"] ?></td>
                        <td><?= $r["recargo"] ?></td>
                        <td style="width: 100px;"><?= $r["ca_observaciones"] ?></td>
                        <td style=" text-align: right;"><?= number_format($r["ca_vlrrecargo"], 3) ?></td>
                        <td><?= $r["ca_aplicacion"] ?></td>
                        <td style=" text-align: right;"><?= $r["ca_vlrminimo"] ?></td>
                        <td><?= $r["ca_aplicacion_min"] ?></td>
                        <?
                        break;
                    case 4:
                        ?>
                        <td><?= $r["trafico"] ?></td>
                        <td><?= $r["linea"] ?></td>
                        <td><?= $r["concepto"] ?></td>
                        <td><?= $r["recargo"] ?></td>
                        <td style="width: 100px;"><?= $r["ca_observaciones"] ?></td>
                        <td style=" text-align: right;"><?= number_format($r["ca_vlrrecargo"], 3) ?></td>
                        <td><?= $r["ca_aplicacion"] ?></td>
                        <td style=" text-align: right;"><?= $r["ca_vlrminimo"] ?></td>
                        <td><?= $r["ca_aplicacion_min"] ?></td>
                        <?
                        break;
                    case 5:
                        ?>
                        <td><?= $r["origen"] ?></td>
                        <td><?= $r["destino"] ?></td>
                        <td><?= $r["linea"] ?></td>
                        <td><?= $r["ca_frecuencia"] ?></td>
                        <td><?= $r["ca_tiempotransito"] ?></td>
                        <td style="width: 120px;"><?= $r["obs1"] ?></td>
                        <td><?= $r["ca_activo"] ?></td>
                        <td><?= $r["ca_ncontrato"] ?></td>
                        <td style="width: 120px;"><?= $r["obs2"] ?></td>
                        <?
                        break;
                }
                if($typelog!=5){
            ?>
                <td><?= $r["ca_idmoneda"] ?></td>
                <td><?= $r["ca_fchinicio"] ?></td>
                <td><?= $r["ca_fchvencimiento"] ?></td>
                <?}?>
                <td><?= substr($r["fchcreado"], 0, 19) ?></td>
                <td><?= $r["ca_usucreado"] ?></td>
                <?if($typelog!=5){?>
                <td><?= substr($r["ca_fcheliminado"], 0, 19) ?></td>
                <?}?>
            </tr>      
        <? } ?>
    </table>
<? } ?>
<script>
function imprimir(){
            $(".esconder").hide();
            $(".mostrar").show();
            Ext.getCmp("formPanel").hidden=true;
            window.print();
        }
</script>

