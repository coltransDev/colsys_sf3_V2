<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<table class="tableList" width="100%">
    <tr>
        <th colspan="5">Cuadro de ingresos de la referencia</th>
        <th><div align="center" >&nbsp;</div></th>
    </tr>
    <tr class="row0">
        <td><b>Cliente</b></td>
        <td><b>Doc. Transporte</b></td>
        <td><b>Comprobante</b></td>
        <td><b>Fecha</b></td>
        <td><b>Valor</b></td>
        <td>&nbsp;</td>
    </tr>
    <?
    foreach( $InoHouses as $InoHouse ){
        $comprobantes = $InoHouse->getInoComprobante();
        $k = 0;
        if( count($comprobantes)>0 ){

            foreach( $comprobantes as $comprobante ){
                $tipo = $comprobante->getInoTipoComprobante();
                ?>
                <tr >
                    <?
                    if( $k==0 ){
                    ?>
                    <td rowspan="<?=count($comprobantes)?>" valign="top"><?=$InoHouse->getIds()->getCaNombre()?></td>
                    <td rowspan="<?=count($comprobantes)?>" valign="top"><?=$InoHouse->getCaDoctransporte()?></td>
                    <?
                    }
                    $k++;
                    ?>
                    <td><?=$tipo." ".str_pad($comprobante->getCaConsecutivo(), 6, "0", STR_PAD_LEFT)?></td>
                    <td><?=Utils::fechaMes($comprobante->getCaFchcomprobante())?></td>
                    <td><?
                        $valor = $comprobante->getValor();
                        if( $valor ){
                            echo Utils::formatNumber($valor, 2);
                        }
                        ?>
                    </td>
                    <td>
                        <?                        
                        echo link_to(image_tag("16x16/edit.gif"), "ino/formComprobante?modo=".$modo."&idInoHouse=".$InoHouse->getCaIdInoHouse()."&idcomprobante=".$comprobante->getCaIdcomprobante());
                        if( $k==count($comprobantes) ){
                            echo "&nbsp;".link_to(image_tag("16x16/edit_add.gif"), "ino/formComprobante?modo=".$modo."&idInoHouse=".$InoHouse->getCaIdInoHouse());
                        }
                        ?>
                    </td>
                </tr>
                <?
            }
        }else{
        ?>
        <tr >
            <td><?=$InoHouse->getIds()->getCaNombre()?></td>
            <td><?=$InoHouse->getCaDoctransporte()?></td>
            <td><span class="rojo">Sin facturar</span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <?=link_to(image_tag("16x16/edit_add.gif"), "ino/formComprobante?modo=".$modo."&idInoHouse=".$InoHouse->getCaIdInoHouse())?>
            </td>
        </tr>

        <?
        }
    }
    ?>
</table>