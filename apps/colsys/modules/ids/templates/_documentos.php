<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

use_helper("MimeType");

$documentos = $sf_data->getRaw( "documentos" );
?>

<table class="tableList alignLeft" width="100%">
    <tr class="row0">
        <td>
           <b>Documento</b>
        </td>
        <td>
           <b>Inicio</b>
        </td>
        <td>
           <b>Vencimiento</b>
        </td>
        <td>
           <b>Imagen</b>
        </td>
        <td>
           <b>Observaciones</b>
        </td>
        <td>
           <?
           if( $nivel>=3 ){
               echo link_to(image_tag("16x16/edit_add.gif"), "ids/formDocumentos?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Nuevo documento"));
           }else{
               echo "&nbsp;";
           }
           ?>
        </td>
    </tr>
    <?
    $i=0;
    foreach( $documentosPorTipo as $docRequired ){
        if( $docRequired->getCaImpoexpo()==Constantes::IMPO && !$ids->getIdsProveedor()->getCaActivoImpo() ){
            continue;
        }
        
        if( $docRequired->getCaImpoexpo()==Constantes::EXPO && !$ids->getIdsProveedor()->getCaActivoExpo() ){
            continue;
        }
        
        if( $i++==0 ){
        ?>
        <tr class="row0"> 
            <td colspan="6">Documentos requeridos</td>
        </tr>    
        <?    
        }
    ?>
    <tr>
        <td>
            <b><?=$docRequired->getIdsTipoDocumento()->getCaTipo() ?></b>
        </td>        
        <?
        if( isset($documentos[$docRequired->getCaIdtipo()]) ){
            $documento = $documentos[$docRequired->getCaIdtipo()];
        ?>
        
        <td>
           <?=Utils::fechaMes($documento->getCaFchinicio() )?>
        </td>
        <td>
            <?
            if( $documento->getCaFchvencimiento() ){
                if($documento->getCaFchvencimiento()<date("Y-m-d")){
                    ?>
                <span class="rojo">
                     <?=Utils::fechaMes($documento->getCaFchvencimiento() )?>
                </span>
                <?
                }else{
                    echo Utils::fechaMes($documento->getCaFchvencimiento() );
                }
            }
            ?>
        </td>
        <td>
            <?=($documento->getCaUbicacion()&&(file_exists($documento->getArchivo()) || file_exists($documento->getArchivo().".gz"))?mime_type_icon($documento->getCaUbicacion())." ".link_to($documento->getCaUbicacion(),"ids/verDocumento?iddocumento=".$documento->getCaIddocumento()):"&nbsp;")?>
        </td> 
        <td>
           <?=$documento->getCaObservaciones()?>
        </td> 
        <td>
            <?            
            if( $nivel>=3 ){
                echo link_to(image_tag("16x16/edit.gif"), "ids/formDocumentos?modo=".$modo."&iddocumento=".$documento->getCaIddocumento(),array("title"=>"Editar documento"));
                echo link_to(image_tag("16x16/delete.gif"), "ids/eliminarDocumentos?modo=".$modo."&iddocumento=".$documento->getCaIddocumento(),array("title"=>"Eliminar documento", "confirm"=>"Esta seguro?"));
            }            
            ?>
        </td>
        <?
            unset($documentos[$docRequired->getCaIdtipo()]);
            
        }else{
        ?>
        <td colspan="4">
           <?
           if( $docRequired->getCaSoloSiAplica() ){
           ?>
            Este documento debe subirse en caso que aplique para este proveedor
           <?
           }else{
           ?>
           <?=image_tag("16x16/alert.png")?> <span class="rojo">Este documento es requerido y no se ha subido al sistema.</span> 
           <?
           }
           ?>
        </td>
        <td>
            <?            
            if( $nivel>=3 ){
                echo link_to(image_tag("16x16/edit.gif"), "ids/formDocumentos?modo=".$modo."&idtipodocumento=".$docRequired->getIdsTipoDocumento()->getCaIdtipo()."&id=".$ids->getCaId() ,array("title"=>"Editar documento"));
            }            
            ?>
        </td>
        <?
        }
        ?>
         
    </tr> 
    <?
    }
    
    
    $i=0;
    foreach( $documentos as $documento ){   
        if( $i++==0 ){
        ?>
        <tr class="row0"> 
            <td colspan="5">Otros Documentos</td>
        </tr>    
        <?    
        }
    ?>
    <tr>
        <td>
            <b><?=$documento->getIdsTipoDocumento()->getCaTipo() ?></b>
        </td>                
        
        <td>
           <?=Utils::fechaMes($documento->getCaFchinicio() )?>
        </td>
        <td>
            <?
            if( $documento->getCaFchvencimiento() ){
                if($documento->getCaFchvencimiento()<date("Y-m-d")){
                    ?>
                <span class="rojo">
                     <?=Utils::fechaMes($documento->getCaFchvencimiento() )?>
                </span>
                <?
                }else{
                    echo Utils::fechaMes($documento->getCaFchvencimiento() );
                }
            }
            ?>
        </td>
        <td>
           <?=($documento->getCaUbicacion()&&file_exists($documento->getArchivo())?mime_type_icon($documento->getCaUbicacion())." ".link_to($documento->getCaUbicacion(),"ids/verDocumento?iddocumento=".$documento->getCaIddocumento()):"&nbsp;")?>
        </td>
         <td>
           <?=$documento->getCaObservaciones()?>
        </td>
        <td>
            <?            
            if( $nivel>=3 ){
                echo link_to(image_tag("16x16/edit.gif"), "ids/formDocumentos?modo=".$modo."&iddocumento=".$documento->getCaIddocumento(),array("title"=>"Editar documento"));
                echo link_to(image_tag("16x16/delete.gif"), "ids/eliminarDocumentos?modo=".$modo."&iddocumento=".$documento->getCaIddocumento(),array("title"=>"Eliminar documento", "confirm"=>"Esta seguro?"));
            }            
            ?>
        </td>        
    </tr> 
    <?
    }
    
    
    $tipo = null;
    $i = 0;
    
    ?>
</table>

<?
if( $nivel>=3 ){
    echo "<br />";
    echo link_to("Historial de envio de mensajes", "ids/historialMensajes?modo=".$modo."&id=".$ids->getCaId(),array("title"=>"Mensajes de solicitud de documentos enviados automaticamente."));
}
?>

