<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<?
use_helper("MimeType");
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
    $tipo = null;
    foreach( $documentos as $documento ){
        if( $tipo!=$documento->getCaIdTipo() ){
            $tipo = $documento->getCaIdTipo();
            $class="";
        }else{
            $class="doc_".$documento->getCaIdtipo();

        }
    
    ?>
    <tr class="<?=$class?$class:""?>" <?=$class?'style="display:none;"':""?>  >
        <td>
           <?
           if( !$class ){
           ?>
           <div class="group_collapsed" id='group_<?=$documento->getCaIdtipo()?>' onclick="expandCollapseGroup( this, 'doc_<?=$documento->getCaIdtipo()?>')">
           <?=$documento->getIdsTipodocumento()?>
           <?
           }else{
               ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$documento->getIdsTipodocumento()?>
               <?
           }
           ?>
           </div>
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

