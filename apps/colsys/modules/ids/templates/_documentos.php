<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<table class="tableList" width="100%">
    <tr class="row0">
        <td>
            <b>Documento </b>
        </td>
        <td>
           <b>Inicio</b>
        </td>
        <td>
           <b>Vencimiento</b>
        <td>
        <td>
           <b>Imagen</b>
        </td>
        <td>
           <?=link_to(image_tag("16x16/edit_add.gif"), "ids/formDocumentos?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nuevo documento"))?>
        </td>
    </tr>
    <?
    foreach( $documentos as $documento ){
    ?>
    <tr>
        <td>
           <?=$documento->getIdsTipodocumento()?>
        </td>
        <td>
           <?=Utils::fechaMes($documento->getCaFchinicio() )?>
        </td>
        <td>
           <?=Utils::fechaMes($documento->getCaFchvencimiento() )?>
        <td>
        <td>
           Imagen
        </td>
        <td>
           <?

           //link_to(image_tag("16x16/edit_add.gif"), "ids/formDocumentos?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nuevo documento"))?>
        </td>
    </tr>
    <?
    }
    ?>
</table>

