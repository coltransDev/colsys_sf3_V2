<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<div class="content" align="center">
    
    <h2>Tipo de proveedor: <?=$tipoProv->getCaNombre()." ".$impoexpo." ".$transporte?></h2>
    <form action="<?=url_for("ids/formCriterios?modo=".$modo)?>" method="post">
        <input type="hidden" name="tipo" value="<?=$tipo?>">
        <input type="hidden" name="tipoprov" value="<?=$tipoprov?>">
        <input type="hidden" name="impoexpo" value="<?=$impoexpo?>">
        <input type="hidden" name="transporte" value="<?=$transporte?>">
    <table class="tableList alignLeft" width="50%">
        
        <?
        if( $form->renderGlobalErrors() ){
        ?>
        <tr>
            <td colspan="2" >
             <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
        </tr>
        <?
        }
        ?>
        
                
            <tr>
                <th>
                    Criterio
                </th>                        
                <th>
                    Ponderaci&oacute;n
                </th>                                        
            </tr>
            <?
            foreach( $criterios as $criterio ){
                if( isset($evaluacionxCriterios[$criterio->getCaIdcriterio()] )){
                    $evaluacionXCriterio = $evaluacionxCriterios[$criterio->getCaIdcriterio()];
                }else{
                    $evaluacionXCriterio = null;
                }
            ?>
            <tr>
                <td>
                    <?=$criterio->getCaCriterio()?>
                    <input type="hidden" name="idcriterio[]" size="5" value="<?=$criterio->getCaIdcriterio()?>" />
                </td>
                <?
                
                $ponderacion = $criterio->getCaPonderacion();
                
                ?>
                <td>
                    <?
                    echo $form["ponderacion_".$criterio->getCaIdcriterio()]->renderError();
                    if( $ponderacion ){
                        $form->setDefault("ponderacion_".$criterio->getCaIdcriterio(), $ponderacion );
                    }
                    echo $form["ponderacion_".$criterio->getCaIdcriterio()]->render();
                    ?>%
                </td>
            </tr>
            <?
            }
            ?>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="Submit" value="Guardar" class="button">&nbsp;
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("ids/listadoCriteriosEval?modo=".$modo)?>'">

                    </div>
                </td>
            </tr>
        </table>
            
    </form>

</div>