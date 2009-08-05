<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tablerList" width="100%" cellspacing="0">
    <tr>
        <th>
            Criterio
        </th>
        <?
        if( $tipocriterio!="seleccion" ){
        ?>
        <th>
            Ponderaci&oacute;n
        </th>
        <?
        }
        ?>
        <th>
            Calificaci&oacute;n
        </th>
        <th>
            Observaciones
        </th>
    </tr>
    <?
    foreach( $criterios as $criterio ){
    ?>
    <tr>
        <td>
            <?=$criterio->getCaCriterio()?>
            <input type="hidden" name="idcriterio[]" size="5" value="<?=$criterio->getCaIdCriterio()?>" />
        </td>
        <?
        if( $tipocriterio!="seleccion" ){
        ?>
        <td>
            <input type="text" name="ponderacion_<?=$criterio->getCaIdCriterio()?>" size="5" />
        </td>
        <?
        }
        ?>
        <td>
            <input type="text" name="calificacion_<?=$criterio->getCaIdCriterio()?>" size="5" />
        </td>
        <td>
            <input type="text" name="observaciones_<?=$criterio->getCaIdCriterio()?>" size="30" />
        </td>
    </tr>
    <?
    }
    ?>
    <tr>
        <td colspan="4"><div align="center"><input type="Submit" value="Guardar" class="button"></div>
        </td>
    </tr>
</table>