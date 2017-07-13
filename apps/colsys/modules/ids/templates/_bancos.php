<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList alignLeft" width="100%" border="1">
    <tr class="row0">
        <td width="5%">
            <b>Código</b>
        </td>
        <td width="20%">
           <b>Entidad</b>
        </td>        
        <td width="20%">
           <b>Tipo Cuenta</b>
        </td>        
        <td width="20">
           <b>Número Cuenta</b>
        </td>        
        <td width="30%">
           <b>Observaciones</b>
        </td>        
        
        <td width="5%" align="center">
           <?
           if( $nivel>=4 ){ //Solo si es cabeza de banco
               echo link_to(image_tag("16x16/edit_add.gif"), "ids/formBancos?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nueva Cuenta"));
           }
           ?>
        </td>
    </tr>
    <?
    foreach( $bancos as $id ){
        if(!$id)
            continue;
    ?>
    <tr   >
        <td width="5%">
            <?=$id->getEntidad()->getCaIdent()?>
        </td>
        <td width="20%">
            <?=$id->getEntidad()->getCaValue()?>
        </td>
        <td width="20%">
            <?=$id->getCaTipoCuenta()?>
        </td>
        <td width="20%">
            <?=$id->getCaNumeroCuenta()?>
        </td>
        <td width="30%">
            <?=$id->getCaObservaciones()?>
        </td>

        <td align="center">
            <?
            if( $nivel>=1 ){
                echo link_to(image_tag("16x16/edit.gif"),"ids/formBancos?modo=".$modo."&idbanco=".$id->getCaIdbanco());
            }
            ?>
            <?=$id->getCaId()==$id->getCaIdbanco()?"Cabeza de banco":link_to(image_tag("16x16/delete.gif"), "ids/eliminarBanco?modo=".$modo."&id=".$ids->getCaId()."&idbanco=".$id->getCaIdbanco(), array("confirm"=>"Esta seguro?"))?>
        </td>
    </tr>
    <?
    }
    
    ?>
</table>