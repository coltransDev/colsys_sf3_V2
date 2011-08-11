<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

if( $param=="Software" ){
    $cols = 10;
}elseif( $param=="Hardware" ){
    $cols = 21;
}else{
    $cols = 11;
}
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
                Vlr. Reposici&oacute;n
            </th>
            <th>
                Serial
            </th>
            <th>
                Proveedor
            </th>
            <?
            if( $param!="Software" ){
            ?>
            <th>
                Asignado a
            </th>
            <th>
                Ubicaci�n
            </th>
            <?
            }
            ?>
            <th>
                Sucursal
            </th>
            <?
            if( $param=="Software" ){
            ?>
            <th>
                Cantidad
            </th>
            
            <?
            }
            if( $param=="Hardware" ){
            ?>
            <th>
                Mantenimiento
            </th>
            <th>
                Procesador
            </th>
            <th>
                Memoria
            </th>
            <th>
                Disco
            </th>
            <th>
                Un. Optica
            </th>
            <th>
                Direcci�n IP
            </th>
            <th>
                S.O. (OEM)
            </th>
            <th>
                Serial
            </th>
            <th>
                Office (OEM)
            </th>
            <th>
                Serial
            </th>
            <?
            }
            ?>
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
                <td colspan="<?=$cols?>"><b><?=($parent?$parent->getCaName()." - ":"").$cat->getCaName()?></b></td>
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
                <div align="right"><?=Utils::formatNumber($activo->getCaReposicion())?></div>
            </td>
            <td>
                <?=$activo->getCaSerial()?>
            </td>
            <td>
                <?=$activo->getCaProveedor()?>
            </td>
            <?
            if( $param!="Software" ){
            ?>
            <td>
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaNombre():"&nbsp;"?>
            </td>
            <td>
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaDepartamento():"&nbsp;"?>
            </td>
            <?
            }
            ?>
            <td>
                <?=$activo->getSucursal()?$activo->getSucursal()->getCaNombre():"&nbsp;"?>
            </td>
            <?
            if( $param=="Software" ){
            ?>
            <td>
                <div align="right"><?=$activo->getCaCantidad()?></div>
            </td>
            
            <?
            }            
            if( $param=="Hardware" ){
            ?>
            <td>
                <?=$activo->getCaMantenimiento()?>
            </td>
            <td>
                <?=$activo->getCaProcesador()?>
            </td>
            <td>
                <?=$activo->getCaMemoria()?>
            </td>
            <td>
                <?=$activo->getCaDisco()?>
            </td>
            <td>
                <?=$activo->getCaOptica()?>
            </td>
            <td>
                <?=$activo->getCaIpaddress()?>
            </td>
            <td>
                <?=$activo->getCaSo()?>
            </td>
            <td>
                <?=$activo->getCaSoSerial()?>
            </td>
            <td>
                <?=$activo->getCaOffice()?>
            </td>
            <td>
                <?=$activo->getCaOfficeSerial()?>
            </td>
            <?
            }
            ?>
            
            
        </tr>
        <?
    }
    ?>
    </table>    
</div>