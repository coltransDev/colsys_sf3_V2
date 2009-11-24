<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>

<div class="content" align="center">
<h1>Vista previa del comprobante <?=$comprobante->getCaConsecutivo()?></h1>
<br />
<br />

<table class="tableList" width="80%" >
    <tr class="row0">
        <td colspan="4">Transacciones</td>
    </tr>
    <tr>
        <td><b>C&oacute;digo</b></td>
        <td><b>Descripci&oacute;n</b></td>
        <td><b>Valor Dolar</b></td>
        <td><div align="right"><b>Valor Pesos</b></div></td>
    </tr>
    <?

    $lastIngresoPropio = null;
    $impuestos["iva"] = 0;
    $impuestos["retefte"] = 0;
    $totales = array();

    $totales["propios"] = 0;
    $totales["terceros"] = 0;

    foreach( $transacciones as $transaccion ){
        $concepto = $transaccion->getInoConcepto();
        $cuenta = $concepto->getInoCuenta();

        if( $lastIngresoPropio===null || $lastIngresoPropio!=$concepto->getCaIngresoPropio() ){
           $lastIngresoPropio=$concepto->getCaIngresoPropio();

           if( $lastIngresoPropio ){
           ?>
           <tr class="row0">
                <td colspan="4">Ingresos propios</td>
           </tr>
           <?
           }else{
           ?>
           <tr class="row0">
                <td colspan="4">Ingresos para terceros</td>
            </tr>
           <?
           }
        }

        if( $lastIngresoPropio ){
             $totales["propios"] += $transaccion->getCaDb();
        }else{
             $totales["terceros"] += $transaccion->getCaDb();
        }


        if( $concepto->getCaIva() ){
           $impuestos["iva"] += $transaccion->getCaDb()*$concepto->getCaIva();
        }

        ?>
        <tr>
            <td><?=$cuenta->getCaCuenta()?></td>
            <td><?=$cuenta->getCaDescripcion()?></td>
            <td>&nbsp;</td>
            <td><div align="right"><?=Utils::formatNumber($transaccion->getCaDb())?></div></td>
        </tr>
        <?
    }


    $totales["general"] = $totales["propios"]+$totales["terceros"];
    ?>

   <tr class="row0">
        <td>&nbsp;</td>
        <td>Total</td>
        <td>&nbsp;</td>
        <td><div align="right"><?=Utils::formatNumber($totales["general"])?></div></td>
    </tr>

    <?


    if( $impuestos["iva"]>0 ){
       ?>
        <tr>
            <td></td>
            <td>IVA</td>
            <td>&nbsp;</td>
            <td><div align="right"><?=Utils::formatNumber($impuestos["iva"])?></div></td>
        </tr>
        <?
        $totales["general"]+=$impuestos["iva"];

    }
    ?>
    <tr class="row0">
        <td>&nbsp;</td>
        <td>Total</td>
        <td>&nbsp;</td>
        <td><div align="right"><b><?=Utils::formatNumber($totales["general"])?></b></div></td>
    </tr>

</table>
</div>

