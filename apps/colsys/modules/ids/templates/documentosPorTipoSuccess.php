<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="content" align="center">
    <h2>Documentos por tipo de Proveedor</h2>
    <br />
    <table class="tableList alignLeft">
        <tr>
            <th >
               Tipo de Documento
            </th>
            <th >
               Controlado por SIG
            </th>
            <th >
               Impo/Expo
            </th>
            <th >
               Transporte
            </th>
            <th >
               Opciones
            </th>
        </tr>
    <?
    foreach( $tipos as $tipo ){
    ?>
        <tr class="row0">
            <td colspan="4">
                <b><?=$tipo->getCaNombre()?></b>
            </td>
            <td >
                <?=link_to(image_tag("16x16/edit_add.gif"), "ids/formDocumentosPorTipo?modo=".$modo."&tipo=".$tipo->getCaTipo())?>
            </td>
        </tr>
    <?
        $documentosPorTipo = $tipo->getIdsDocumentoPorTipo();
        if( count( $documentosPorTipo )>0){

            foreach( $documentosPorTipo as $documentoPorTipo ){
                $tipo = $documentoPorTipo->getIdsTipoDocumento();
            ?>
            <tr >
                <td >
                    <?=$tipo->getCaTipo()?>
                </td>
                <td >
                    <?=$documentoPorTipo->getCaControladoxsig()?"S&iacute;":"No"?>
                </td>
                <td >
                     <?=$documentoPorTipo->getCaImpoexpo()?>
                </td>
                <td >
                    <?=$documentoPorTipo->getCaTransporte()?>
                </td>
                <td >
                    <?=link_to(image_tag("16x16/edit.gif"), "ids/formDocumentosPorTipo?modo=".$modo."&tipo=".$documentoPorTipo->getCaTipo()."&iddocumentosxtipo=".$documentoPorTipo->getCaIddocumentosxtipo())?>
                    <?=link_to(image_tag("16x16/delete.gif"), "ids/eliminarDocumentosPorTipo?modo=".$modo."&tipo=".$documentoPorTipo->getCaTipo()."&iddocumentosxtipo=".$documentoPorTipo->getCaIddocumentosxtipo(), array("confirm"=>"Esta seguro que desea eliminar este registro?"))?>
                </td>

            </tr>
            <?

            }
        }else{
            ?>
            <tr >
                <td colspan="5">
                    <span class="rojo">No se han creado documentos para este tipo de proveedor</a>
                </td>
            </tr>
            <?

        }
    }
    ?>
    </table>
</div>




