<?php
/* 
*
*/

?>

<div align="center" class="content">
    <table  class="tableList" width="80%">
        <thead>
            <tr>
                <th colspan="4"><div align="left">Datos Basicos</div></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="25%">
                    <div align="left"><b>Identificaci&oacute;n</b></div>
                </td>
                <td width="25%">
                    <div align="left"><?=$ids->getCaId()?> <?=$ids->getCaDv()?></div>
                </td>
                <td width="25%">
                    <div align="left"><b><?=$ids->getCaIdalterno()?"Identificaci&oacute;n Alterna":"&nbsp;"?></b></div>
                </td>
                <td width="25%">
                    <div align="left"><?=$ids->getCaIdalterno()?$ids->getCaIdalterno():"&nbsp;"?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="left"><b>Nombre</b></div>
               </td>
               <td>
                   <div align="left"><?=$ids->getCaNombre()?></div>
               </td>
               <td>
                   <div align="left"><b>Website</b></div>
               </td>
               <td>
                   <div align="left"><?=$ids->getCaWebsite()?></div>
               </td>
            </tr>
            <tr>
                <th colspan="4"><div align="left">Oficina Principal</div></th>
            </tr>
            <?
            $sucursal = $ids->getSucursalPrincipal();
            include_partial("ids/verSucursal", array("sucursal"=>$sucursal ));
            ?>
             
            
        </tbody>
    </table>
</div>
