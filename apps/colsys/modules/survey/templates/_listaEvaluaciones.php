<?php
/* 
 * This file is part of the Colsys Project.
 * (c) Coltrans S.A. - Colmas Ltda.
 */



?>

<div class="content-box">
<h5>EVALUACIONES PENDIENTES</h5>
<div class="content-box">
        <table >
        <?
        foreach ($evaluaciones as $evaluacion) {


        ?>
            <tr>
                <td>
                    <?=link_to($evaluacion->getCaTitulo(),"survey/formEvaluacion?idevaluacion=".$evaluacion->getCaIdevaluacion())?>
                </td>
            </tr>

        <?
        }
        ?>
        </table>
    </div>
</div>