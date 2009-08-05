<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<?
use_helper("ExtCalendar");
?>


<div class="content" align="center">
    <form action="<?=url_for("ids/formEvaluacion?modo=".$modo."&tipo=".$tipo."&id=".$ids->getCaId())?>" method="post">
    <table class="tableList" width="50%">
        <tr>
            <th colspan="2">&nbsp;</th>
        </tr>
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
            <td colspan="2">
                <b>Tipo de Evaluaci&oacute;n:</b> <br /> <?=$tipo=="seleccion"?"Selecci&oacute;n":"Desempe&ntilde;o"?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Fecha:</b><br />
                <?
                echo $form["fchevaluacion"]->renderError();
                $form->setDefault('fchevaluacion', date("Y-m-d") );
                echo $form["fchevaluacion"]->render();
                ?>

            </td>
        
            <td>
                <b>Concepto:</b><br />
                <?
                echo $form["concepto"]->renderError();
                echo $form["concepto"]->render();
                ?>

            </td>

            <tr>
            <td colspan="2">
                <table class="tablerList" width="100%" cellspacing="0">
                    <tr>
                        <th>
                            Criterio
                        </th>                        
                        <th>
                            Ponderaci&oacute;n
                        </th>                        
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
                        if( $tipo=="seleccion" ){
                            $ponderacion = 100/count( $criterios );
                        }
                        ?>
                        <td>
                            <?
                            echo $form["ponderacion_".$criterio->getCaIdCriterio()]->renderError();
                            if( $ponderacion ){
                                $form->setDefault("ponderacion_".$criterio->getCaIdCriterio(), $ponderacion );
                            }
                            echo $form["ponderacion_".$criterio->getCaIdCriterio()]->render();
                            ?>%
                        </td>
                        
                        <td>
                            <?
                            echo $form["calificacion_".$criterio->getCaIdCriterio()]->renderError();                            
                            echo $form["calificacion_".$criterio->getCaIdCriterio()]->render();
                            ?>
                        </td>
                        <td>
                           <?
                            echo $form["observaciones_".$criterio->getCaIdCriterio()]->renderError();
                            echo $form["observaciones_".$criterio->getCaIdCriterio()]->render();
                            ?>
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
            </td>
        </tr>        
    </table>
    </form>

</div>
