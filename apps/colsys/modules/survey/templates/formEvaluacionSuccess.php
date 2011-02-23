<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$ticket = $sf_data->getRaw( "ticket" );
?>

<script type="text/javascript">
    var check = function(id){        
        if( document.getElementById("calificacion_"+id).value<=3 ){
            document.getElementById("obs_"+id).style.display="";
        }else{
            document.getElementById("obs_"+id).style.display="none";
        }
    }
</script>

<div class="content" align="center" >

    <h2><?=$evaluacion->getCaTitulo()?></h2>
    <br />
    <div class="box1" style="width: 700px; text-align: justify;">
    <?
    if( $ticket ){
        if( $ticket->getCaAssignedto() ){
			$asignado = $ticket->getAssignedUser();
			if( $asignado ){
				echo "<b>Asignado: a</b> ".$asignado->getCaNombre()."";
			}
		}
        echo $ticket->getCaText();
        echo "<br /><br />";
        echo link_to("Haga click aca para ver el ticket completo", "pm/VerTicket?format=email&id=".$ticket->getCaIdticket(), array("target"=>"_blank"));
       
    }

    ?>
    </div>
    <br /><br />

    <form action="<?=url_for("survey/formEvaluacion")?>" method="post">
        <input type="hidden" name="idevaluacion" value="<?=$evaluacion->getCaIdevaluacion()?>">
        <input type="hidden" name="idtipo" value="<?=$evaluacion->getCaIdtipo()?$evaluacion->getCaIdtipo():$idtipo?>">



        <table class="tableList alignLeft" width="700px" cellspacing="0" border="1">
                 <?
                if( $form->renderGlobalErrors() ){
                ?>
                <tr>
                    <td colspan="3" >
                        <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div>
                    </td>
                </tr>
                <?
                }
                ?>

                <tr>
                    <th>
                        Criterio
                    </th>
                   
                    <th>
                        Calificaci&oacute;n
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


                        echo $form["calificacion_".$criterio->getCaIdcriterio()]->renderError();
                        if( $evaluacionXCriterio ){
                            $form->setDefault("calificacion_".$criterio->getCaIdcriterio(),$evaluacionXCriterio->getCaValor() );
                        }
                        echo $form["calificacion_".$criterio->getCaIdcriterio()]->render();
                        ?>

                        <div style="display:none" id="obs_<?=$criterio->getCaIdcriterio()?>">
                            <b>¿Por que?</b>
                           <?
                            echo $form["observaciones_".$criterio->getCaIdcriterio()]->renderError();
                            if( $evaluacionXCriterio ){
                                $form->setDefault("observaciones_".$criterio->getCaIdcriterio(),$evaluacionXCriterio->getCaObservaciones() );
                            }
                            echo $form["observaciones_".$criterio->getCaIdcriterio()]->render();
                            ?>
                        </div>

                    </td>
                   
                </tr>
                <?
                }
                ?>
                <tr>
                    <td colspan="3">
                        <div align="center">
                            <input type="Submit" value="Guardar" class="button">&nbsp;
                            <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("homepage/index")?>'">
                        </div>
                    </td>
                </tr>
            </table>
            
    </form>

</div>
<script type="text/javascript">
<?

foreach( $criterios as $criterio ){
    ?>
    check('<?=$criterio->getCaIdcriterio()?>');
    <?
}
?>
</script>