<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<div class="tableList" align="center">
    <table class="tableList" >
        <tr>
            <th>Criterio</th>
            <th>Ponderaci&oacute;n</th>
        </tr>
        <?
        $lastTipoProv = null;
        $lastTipoCrit = null;
        foreach( $criterios as $criterio ){
            $tipo = $criterio->getIdsTipo();
            if( $lastTipoProv!=$tipo->getCaNombre() ){
                
                $lastTipoCrit = null;
                if( $lastTipoProv!=null ){
                ?>
                <tr >
                    <td colspan="2">&nbsp;</td>
                    
                </tr>
                <?    
                }
                
                $lastTipoProv=$tipo->getCaNombre();  
                ?>
                <tr class="row0">
                    <td ><b><?=$lastTipoProv?></b></td>
                    <td><?=$nivel>=6?link_to(image_tag("16x16/edit_add.gif"), "ids/formNuevoCriterio?modo=".$modo."&tipoprov=".$tipo->getCaTipo()):"&nbsp;"?></td>
                    
                </tr>
                <?
            }    
            
            
            
            if( $lastTipoCrit!=$criterio->getCaTipocriterio()." ".$criterio->getCaImpoexpo()." ".$criterio->getCaTransporte() ){
                $lastTipoCrit=$criterio->getCaTipocriterio()." ".$criterio->getCaImpoexpo()." ".$criterio->getCaTransporte();    
                ?>
                <tr class="row0">
                    <td ><?=ucfirst($lastTipoCrit)?></b></td>
                    <td>
                        <?=$nivel>=6?link_to(image_tag("16x16/edit.gif"), "ids/formCriterios?modo=".$modo."&tipoprov=".$tipo->getCaTipo()."&tipo=".$criterio->getCaTipocriterio().($criterio->getCaImpoexpo()?"&impoexpo=".$criterio->getCaImpoexpo():"").($criterio->getCaTransporte()?"&transporte=".$criterio->getCaTransporte():"")):"&nbsp;"?>
                    </td>
                </tr>
                <?
            }   
        ?>
        <tr>
            <td><?=$criterio->getCaCriterio()?></td>
            <td>
                <?=$criterio->getCaPonderacion()?>% 
                <?=($nivel>=6&&$criterio->getCaPonderacion()==0)?link_to(image_tag("16x16/delete.gif"), "ids/desactivarCriterio?modo=".$modo."&idcriterio=".$criterio->getCaIdcriterio()):""?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>
    
</div>

