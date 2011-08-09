<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<div class="content" align="center">
    <h2>Listados de Activos</h2>
    <br />
    <table class="tableList alignLeft">
        <tr>
            <th>
                Id
            </th>
            <th>
                Marca
            </th>
            <th>
                Modelo
            </th>
            <th>
                Fch. Compra
            </th>
            <th>
                Factura
            </th>
            <th>
                Serial
            </th>
            <th>
                Proveedor
            </th>
            <th>
                Asignado a
            </th>
            <th>
                Ubicación
            </th>
            <th>
                Sucursal
            </th>
        </tr>
     
    <?
    $lastCat = null;
    foreach( $activos as $activo ){
        if( $lastCat!=$activo->getcaIdcategory() ){
            $lastCat=$activo->getcaIdcategory();
            $cat = $activo->getInvCategory();
            $parent = $cat->getParent();
            ?>
            <tr class="row0">
                <td colspan="10"><b><?=($parent?$parent->getCaName()." - ":"").$cat->getCaName()?></b></td>
            </tr>
            <?
        }
        ?>
        <tr>
            <td>
                <?=$activo->getCaIdentificador()?>
            </td>
            <td>
                <?=$activo->getCaMarca()?>
            </td>
            <td>
                <?=$activo->getCaModelo().($activo->getCaVersion()?" ".$activo->getCaVersion():"")?>
            </td>
            <td>
                <?=$activo->getCaFchcompra()?>
            </td>
            <td>
                <?=$activo->getCaFactura()?>
            </td>
            <td>
                <?=$activo->getCaSerial()?>
            </td>
            <td>
                <?=$activo->getCaProveedor()?>
            </td>
            <td>
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaNombre():"&nbsp;"?>
            </td>
            <td>
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaDepartamento():"&nbsp;"?>
            </td>
            <td>
                <?=$activo->getSucursal()?$activo->getSucursal()->getCaNombre():"&nbsp;"?>
            </td>
        </tr>
        <?
    }
    ?>
    </table>    
</div>