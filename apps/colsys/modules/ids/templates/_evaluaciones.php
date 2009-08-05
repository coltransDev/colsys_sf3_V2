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
            <b>Fecha </b>
        </td>
        <td>
           <b>Tipo</b>
        </td>
        <td>
            <b>Calificaci&oacute;n</b>
        <td>
        
        <td>
           <?=link_to(image_tag("16x16/edit_add.gif"), "ids/formEvaluacion?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nueva evaluaci&oacute;n"))?>
        </td>
    </tr>
    <?
    $tipo = null;
    foreach( $evaluaciones as $evaluacion ){
        
    ?>
    <tr   >
        <td>
            <?=Utils::fechaMes($evaluacion->getCaFchcreado() )?>

        </td>
        <td>
           <?=ucfirst($evaluacion->getCaTipo())?>
        </td>
        <td>
           <?=$evaluacion->getCalificacion()?>
        <td>
        <td>
            &nbsp;
        </td>
        
    </tr>
    <?
    }
    ?>
</table>