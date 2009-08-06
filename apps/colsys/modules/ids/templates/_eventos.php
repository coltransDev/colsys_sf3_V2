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
           <b>Tipo</b>
        </td>
        <td width="20%">
            <b>Evento</b>
        </td>
        <td width="20%">
            <b>Referencia</b>
        </td>
        <td width="20%">
            <b>Usuario </b>
        </td>
        <td width="20%">
            <b>Fecha </b>
        </td>
        <td width="20%" align="center">
           <?=link_to(image_tag("16x16/edit_add.gif"), "ids/formEventos?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nuevo evento"))?>
           
        </td>
    </tr>
    <?
    $tipo = null;
    foreach( $eventos as $evento ){

    ?>
    <tr   >
        <td width="20%">
           <?=$evento->getCaTipo()?>
        </td>
        <td width="20%">
            <?=$evento->getCaEvento()?>
        </td>
        <td width="20%">
            <?=$evento->getCaReferencia()?>
        </td>
        <td width="20%">
            <?=$evento->getCaUsucreado()?> 
        </td>
        <td width="20%">
            <?=Utils::fechaMes($evento->getCaFchcreado())?> 
        </td>
        <td align="center">
           <?
           //link_to(image_tag("16x16/edit.gif"),"ids/verEvaluacion?modo=".$modo."&idevaluacion=".$evaluacion->getCaIdevaluacion())?>
        </td>
    </tr>
    <?
    }
    ?>
</table>