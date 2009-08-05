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
            <b>Fecha </b>
        </td>
        <td width="20%">
           <b>Tipo</b>
        </td>
        <td width="20%">
            <b>Concepto</b>
        </td>
        <td width="20%">
            <b>Calificaci&oacute;n</b>
        </td>
        <td width="20%" align="center">
           <?=link_to(image_tag("16x16/edit_add.gif")." Selecci&oacute;n", "ids/formEvaluacion?modo=".$modo."&id=".$ids->getCaId()."&tipo=seleccion",array("title"=>"Nueva evaluaci&oacute;n"))?>
           <?=link_to(image_tag("16x16/edit_add.gif")." Desempe&ntilde;o", "ids/formEvaluacion?modo=".$modo."&id=".$ids->getCaId()."&tipo=desempeno",array("title"=>"Nueva evaluaci&oacute;n"))?>
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
           <?=$evaluacion->getCaConcepto()?$evaluacion->getCaConcepto():"&nbsp;"?>
        </td>
        <td>
           <?=$evaluacion->getCalificacion()?>
        </td>
        <td align="center">
           <?=link_to(image_tag("16x16/edit.gif"),"ids/verEvaluacion?modo=".$modo."&idevaluacion=".$evaluacion->getCaIdevaluacion())?>
        </td>        
    </tr>
    <?
    }
    ?>
</table>