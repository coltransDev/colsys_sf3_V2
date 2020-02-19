<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
//echo "<pre>";print_r($activos);echo "</pre>";

if( $param=="Software" ){
    $cols = 12;
}elseif( $param=="Hardware" ){
    $cols = 22;
}else{
    $cols = 12;
}

if( $bajasChkbox ){
    $cols++;
}

$granTotal = 0;
?>
<div class="content" align="center">
    <h2>Listados de Activos <br /> <?=$param?> <?=$sucursal?"Sucursal ".$sucursal->getCaNombre():""?> <?=$so?"S.O. ".$so:""?> <?=$office?"Office ".$office:""?> <?=$bajasChkbox?"Bajas desde ".$fchbajainicio." hasta ".$fchbajafinal:""?></h2>
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
            <?
            if( $param=="Software" ){
            ?>
            <th>
                Contrato
            </th>            
            <?
            }
            ?>
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
                Ubicación
            </th>
            <?
            }
            ?>
            <th>
                Empresa
            </th>
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
                Dirección IP
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
            if( $bajasChkbox ){
            ?>
            <th>
                Dado de baja
            </th>
            <?
            }
            
            ?>
        </tr>
     
    <?
    $lastCat = null;
    $cant = 0;
    $cantLicencias = 0;
    foreach( $activos as $activo ){
        if( $lastCat!=$activo->getcaIdcategory() ){
            
            if( $lastCat!==null ){
                ?>            
                <tr class="row0">
                    <td colspan="<?=$cols?>"><div align="right"><b>Total: <?=$cant?></b></div></td>
                </tr>
                <?   
                $granTotal+=$cant;
            }
            $lastCat=$activo->getcaIdcategory();
            $cat = $activo->getInvCategory();
            $parent = $cat->getParent();
            
            $cant = 0;
            ?>            
            <tr class="row0">
                <td colspan="<?=$cols?>"><b><?=($parent?$parent->getCaName()." - ":"").$cat->getCaName()?></b></td>
            </tr>
            <?
        }
        $cant++;
        $cantLicencias+=$activo->getCaCantidad();
        ?>
        <tr>
            <td>
                <?=link_to($activo->getCaIdentificador(), "inventory/detalleActivo?idactivo=".$activo->getCaIdactivo(), array("target"=>"_blank"))?>
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
            <?
            if( $param=="Software" ){
            ?>
            <td>
                <?= html_entity_decode($activo->getCaContrato())?>
            </td>            
            <?
            }
            ?>
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
                <?=$activo->getUsuario()?$activo->getUsuario()->getSucursal()->getEmpresa()->getCaNombre():"&nbsp;"?>
            </td>
            <td>
                <?=$activo->getUsuario()?$activo->getUsuario()->getSucursal()->getCaNombre():"&nbsp;"?>
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
            if( $bajasChkbox ){
            ?>
            <td>
                <?=Utils::fechaMes($activo->getCaFchbaja())?>
            </td>
            <?
            }
            ?>
            
            
        </tr>
        <?
    }
        $granTotal+=$cant;
    ?>
        <tr class="row0">
            <td colspan="<?=$cols?>"><div align="right"><b>Total: <?=$cant?></b></div></td>
        </tr>
        <?if($param=="Software"){?>
        <tr class="row0">
            <td colspan="<?=$cols?>"><div align="right"><b>Total Licencias: <?=$cantLicencias?></b></div></td>
        </tr>
        <?}?>
        <tr class="row0">
            <td colspan="<?=$cols?>"><div align="right"><b>Gran Total: <?=$granTotal?></b></div></td>
        </tr>
    </table>    
    
</div>