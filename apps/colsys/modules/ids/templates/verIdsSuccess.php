<?php
/* 
*
*/

?>

<div align="center" class="content">
    <table  class="tableList" width="80%">
        <thead>
            <tr>
                <th colspan="4"><div align="left"><b>Datos Basicos</b></div></th>
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
            
            
            <?
            $sucursal = $ids->getSucursalPrincipal();
            include_partial("ids/verSucursal", array("sucursal"=>$sucursal, "modo"=>$modo, "nivel"=>$nivel ));
            ?>
            <tr class="row0">
                 <td colspan="3" ><div align="left"><b>Contactos</b></div></td>
                 <td ><div align="right"><?=link_to(image_tag("16x16/add_user.gif")." Nuevo contacto", "ids/formContactosIds?idsucursal=".$sucursal->getCaidsucursal()."&modo=".$modo)?></div></td>
            </tr>
            <?
            $contactos = $sucursal->getIdsContactos();
            include_partial("ids/verContactos", array("contactos"=>$contactos, "modo"=>$modo, "nivel"=>$nivel ));
            ?>
            
        </tbody>
    </table>
</div>


