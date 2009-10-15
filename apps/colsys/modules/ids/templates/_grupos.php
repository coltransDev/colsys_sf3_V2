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
            <b>Identificacion</b>
        </td>
        <td width="60%">
           <b>Nombre</b>
        </td>        
        
        <td width="20%" align="center">
           <?
           if( $nivel>=4 && $ids->getCaId()==$ids->getCaIdgrupo() ){ //Solo si es cabeza de grupo
               echo link_to(image_tag("16x16/edit_add.gif"), "ids/formGrupos?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nuevo transportista"));
           }
           ?>
        </td>
    </tr>
    <?
    $tipo = null;

    if( $ids->getCaId()!=$ids->getCaIdgrupo() ){
        $grupos = array($cabezaGrupo);
    }
    
    foreach( $grupos as $id ){
    ?>
    <tr   >
        <td width="20%">
           <?=link_to($id->getCaIdalterno()?$id->getCaIdalterno()." ".$id->getCaDv():$id->getCaId(), "ids/verIds?modo=".$modo."&id=".$id->getCaId())?>
        </td>
        <td width="20%">
            <?=$id->getCaNombre()?>
        </td>

        <td align="center">

          <?=$id->getCaId()==$id->getCaIdgrupo()?"Cabeza de grupo":link_to(image_tag("16x16/delete.gif"), "ids/eliminarGrupo?modo=".$modo."&id=".$ids->getCaId()."&idgrupo=".$id->getCaId(), array("confirm"=>"Esta seguro?"))?>
        </td>
    </tr>
    <?
    }
    
    ?>
</table>