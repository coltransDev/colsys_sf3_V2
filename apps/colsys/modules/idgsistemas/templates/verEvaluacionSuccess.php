<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="content" align="center">

    <h2>Evaluacion de ticket</h2>
    <br />
        
    <table class="tableList alignLeft">
        <tr>
            <th colspan="4">
                <?=$evaluacion->getCaTitulo()?>

                <?
                if( $ticket ){

                    echo link_to(" Ver ticket", "pm/verTicket?format=email&id=".$ticket->getCaIdticket(), array("target"=>"_blank"));

                }

                ?>

            </th>
        </tr>



        <tr class="row0">
            <td>
                Criterio
            </td>
            <td>
                Ponderacion
            </td>
            <td>
                Valor
            </td>
            <td>
                Observaciones
            </td>            
        </tr>

        <?
        
        $evalCriterios = $evaluacion->getSurvEvaluacionxCriterio();

        $sumPonderacion = 0;
        $sumValor = 0;

        foreach( $evalCriterios as $ec ){
            $criterio = $ec->getSurvCriterio();

        ?>
        <tr>
            <td>
                <?=$criterio->getCaCriterio()?>
            </td>
            <td>
                <?=$ec->getCaPonderacion()?>%
            </td>
            <td>
                <?=$ec->getCaValor()?>
            </td>
            <td>
                <?=$ec->getCaObservaciones()?>
            </td>            
        </tr>

        
        <?
            $sumPonderacion += $ec->getCaPonderacion();
            $sumValor += ($ec->getCaValor()*$ec->getCaPonderacion());
        }
        ?>
        <tr class="row0">
            <td>
                Totales
            </td>
            <td>
                <?=$sumPonderacion?>%
            </td>
            <td>
                <?=$sumValor/$sumPonderacion?>
            </td>
            <td>
                &nbsp;
            </td>            
        </tr>
        <tr class="row0">
            <td colspan="4">
                <b>usuario</b><br />
                <?=$evaluacion->getUsuario()->getCaNombre()?>
                <?=Utils::fechaMes($evaluacion->getCaFchcreado())?>
            </td>
        </tr>
        <tr class="row0">
            <td colspan="4">
                <b>Usuario evaluado</b><br />
                <?=$evaluacion->getCaUsucreado()?>
            </td>
        </tr>

        <?
        if( $evaluacion->getCaComentarios() ){
        ?>

        <tr class="row0">
            <td colspan="4">
                <b>Comentarios</b><br />
                <?=$evaluacion->getCaComentarios()?>
            </td>
        </tr>
        <?
        }
        ?>       
        
    </table>
    
    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>

</div>
