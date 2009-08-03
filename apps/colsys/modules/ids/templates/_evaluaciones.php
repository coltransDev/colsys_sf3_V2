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
            <b>Evaluación </b>
        </td>
        <td>
           <b>Tipo</b>
        </td>
        <td>
           <b>Fecha</b>
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


        </td>
        <td>
           <?=Utils::fechaMes($documento->getCaFchinicio() )?>
        </td>
        <td>
            <?
            if($documento->getCaFchvencimiento()<date("Y-m-d")){
                ?>
            <span class="rojo">
                 <?=Utils::fechaMes($documento->getCaFchvencimiento() )?>
            </span>
            <?
            }else{
                echo Utils::fechaMes($documento->getCaFchvencimiento() );
            }

            ?>
        <td>
        <td>
           <?=($documento->getCaUbicacion()&&file_exists($documento->getArchivo())?mime_type_icon($documento->getCaUbicacion())." ".link_to($documento->getCaUbicacion(),"ids/verDocumento?iddocumento=".$documento->getCaIddocumento()):"&nbsp;")?>
        </td>
        <td>
            <?
            if( !$class ){
                echo link_to(image_tag("16x16/edit.gif"), "ids/formDocumentos?modo=".$modo."&iddocumento=".$documento->getCaIddocumento(),array("title"=>"Editar documento"));
            }
            ?>
        </td>
    </tr>
    <?
    }
    ?>
</table>