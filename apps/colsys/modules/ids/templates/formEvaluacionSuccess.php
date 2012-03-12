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
    <form action="<?=url_for("ids/formEvaluacion?modo=".$modo."&id=".$ids->getCaId())?>" method="post">
        <input type="hidden" name="idevaluacion" value="<?=$evaluacion->getCaIdevaluacion()?>">
        <?
        echo $form["concepto"]->renderError();
        if( $evaluacion->getCaConcepto() ){
            $form->setDefault('concepto', $evaluacion->getCaConcepto() );
        }else{
            if( $tipo=="desempeno_impo" || $tipo=="reevaluacion_impo" ){
                $form->setDefault('concepto', Constantes::IMPO );
            }

            if( $tipo=="desempeno_expo" || $tipo=="reevaluacion_expo" ){
                $form->setDefault('concepto', Constantes::EXPO );
            }
        }
        echo $form["concepto"]->render();
        ?>
    <table class="tableList alignLeft" width="50%">
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
                <b>Tipo de Evaluaci&oacute;n:</b> <br /> 
                <?
                
                if( $tipo=="seleccion"){
                    echo "Selecci&oacute;n";
                    ?>
                    <input type="hidden" name="tipo" value="<?=$tipo?>" />
                    <?
                }else{
                    echo $form["tipo"]->renderError();
                    if( $evaluacion->getCaTipo() ){
                        $form->setDefault('tipo', $evaluacion->getCaTipo() );
                    }
                    echo $form["tipo"]->render();
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>                
                <b>A&ntilde;o:</b><br />
                <?
                echo $form["ano"]->renderError();
                if( $evaluacion->getCaAno() ){
                    $form->setDefault('ano', $evaluacion->getCaAno() );
                }else{
                    $form->setDefault('ano', $defAno );
                }
                echo $form["ano"]->render();
                ?>
            </td>        
            <td>
               <b>Periodo:</b><br />
                <?
                echo $form["periodo"]->renderError();
                if( $evaluacion->getCaAno() ){
                    $form->setDefault('periodo', $evaluacion->getCaPeriodo() );
                }else{
                    $form->setDefault('periodo', $defPeriodo );
                }
                echo $form["periodo"]->render();
                ?>
            </td>
            
        </tr>
        
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
                        //if( $tipo=="seleccion" ){
                        //    $ponderacion = 100/count( $criterios );
                        //}else{
                            $ponderacion = $criterio->getCaPonderacion();
                        //}
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
                        
                        <td>
                            <?
                            echo $form["calificacion_".$criterio->getCaIdcriterio()]->renderError();
                            if( $evaluacionXCriterio ){
                                $form->setDefault("calificacion_".$criterio->getCaIdcriterio(),$evaluacionXCriterio->getCaValor() );
                            }
                            echo $form["calificacion_".$criterio->getCaIdcriterio()]->render();
                            ?>
                        </td>
                        <td>
                           <?
                            echo $form["observaciones_".$criterio->getCaIdcriterio()]->renderError();
                            if( $evaluacionXCriterio ){
                                $form->setDefault("observaciones_".$criterio->getCaIdcriterio(),$evaluacionXCriterio->getCaObservaciones() );
                            }
                            echo $form["observaciones_".$criterio->getCaIdcriterio()]->render();
                            ?>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                    <tr>
                        <td colspan="4">
                            <div align="center">
                                <input type="Submit" value="Guardar" class="button">&nbsp;
                                <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("ids/verIds?modo=".$modo."&id=".$ids->getCaId())?>'">
                                <?
                                if( $evaluacion->getCaIdevaluacion() ){
                                ?>
                                <input type="button" value="Eliminar" class="button" onClick="if(confirm('Esta seguro?')){document.location='<?=url_for("ids/eliminarEvaluacion?modo=".$modo."&idevaluacion=".$evaluacion->getCaIdevaluacion())?>';}">
                                <?
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>        
    </table>
    </form>

</div>
