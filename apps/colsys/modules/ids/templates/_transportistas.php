<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList" width="100%" border="1">
    <tr class="row0">

        <td width="20%">
           <b>Nombre</b>
        </td>
        <td width="20%">
            <b>Sigla</b>
        </td>
        <td width="20%">
            <b>Transporte</b>
        </td>  
        <td width="20%">
            <b>Estado</b>
        </td>
        <td width="20%" align="center">
           <?=link_to(image_tag("16x16/edit_add.gif"), "ids/formTransportista?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nuevo transportista"))?>

        </td>
    </tr>
    <?
    $tipo = null;
    foreach( $transportistas as $transportista ){

    ?>
    <tr   >
        <td width="20%">
           <?=$transportista->getCaNombre()?>
        </td>
        <td width="20%">
            <?=$transportista->getCaSigla()?>
        </td>
        <td width="20%">
            <?=$transportista->getCatransporte()?>
        </td>
        <td width="20%">
            <?=$transportista->getCaActivo()?"Activo":"Inactivo"?>
        </td>
        <td align="center">
           <?=link_to(image_tag("16x16/edit.gif"),"ids/formTransportista?modo=".$modo."&idlinea=".$transportista->getCaIdLinea())?>
        </td>
    </tr>
    <?
    }
    ?>
</table>