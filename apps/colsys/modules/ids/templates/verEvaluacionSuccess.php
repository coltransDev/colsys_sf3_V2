<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div class="content" align="center">
    <table border="1" class="tableList" width="70%">
        <thead>
            <tr>
                <th colspan="2">&nbsp;</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="50%"><b>Tipo de Evaluacion:</b><br /><?=ucfirst($evaluacion->getCaTipo())?></td>
                <td width="50%"><b>Proveedor:</b><br /><?=$ids->getCaNombre()?></td>
            </tr>
            <tr>
                <td> <b>Fecha Evaluaci&oacute;n:</b><br /><?=Utils::fechaMes($evaluacion->getCaFchevaluacion())?></td>
                <td> <b>A&ntilde;o:</b><br /><?=$evaluacion->getCaAno()?></td>
            </tr>
            <tr>
                <td> <b>Concepto:</b><br /><?=$evaluacion->getCaConcepto()?></td>
                <td> &nbsp;</td>
            </tr>
             <tr>
                <td> <b>Fecha Creaci&oacute;n:</b><br /><?=Utils::fechaMes($evaluacion->getCaFchcreado())?></td>
                <td> <b>Usuario Creador:</b><br /><?=$evaluacion->getCaUsucreado()?></td>
            </tr>
            <?
            if( $evaluacion->getCaFchactualizado() ){
            ?>
            <tr>
                <td> <b>Fecha Modificaci&oacute;n:</b><br /><?=Utils::fechaMes($evaluacion->getCaFchactualizado())?></td>
                <td> <b>Usuario Modificaci&oacute;n:</b><br /><?=$evaluacion->getCaUsuactualizado()?></td>
            </tr>
            <?
            }
            ?>
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

                    $criterios = $evaluacion->getIdsEvaluacionxCriterio();
                    $ponderacion = 0;
                    $valor = 0;
                    $i=0;
                    foreach( $criterios as $criterio ){
                        $i++;
                        $ponderacion+=$criterio->getCaPonderacion();
                        
                        $valor+=$criterio->getCaValor()*$criterio->getCaPonderacion();
                        
                    
                    ?>
                    <tr>
                        <td>
                            <?=$criterio->getIdsCriterio()->getCaCriterio()?>
                           
                        </td>                        
                        <td>
                            <?=$criterio->getCaPonderacion()?>%
                        </td>                        
                        <td>
                            <?=$criterio->getCaValor()?>
                        </td>
                        <td>
                            <?=$criterio->getCaObservaciones()?$criterio->getCaObservaciones():"&nbsp;"?>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                    <tr>
                        <td>
                            <b>Total</b>
                        </td>                       
                        <td>
                            <b><?=$ponderacion?>%</b>
                        </td>                        
                        <td>
                            <b><?

                            
                            echo $valor/$ponderacion;
                            
                            ?>
                           </b>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div align="center">
                                <input type="button" value="Volver" class="button" onClick="document.location='<?=url_for("ids/verIds?modo=".$modo."&id=".$ids->getCaId())?>'">
                                <?
                                if( $user->getUserId()==$evaluacion->getCaUsucreado() && $nivel>=2 ){
                                ?>
                                <input type="button" value="Editar" class="button" onClick="document.location='<?=url_for("ids/formEvaluacion?modo=".$modo."&idevaluacion=".$evaluacion->getCaIdevaluacion())?>'">
                                <?
                                }
                                ?>
                            </div>
                        </td>
                    </tr>                    
                </table>
                </td>
            </tr>


        </tbody>
    </table>


</div>