<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
    var crearEvaluacion =function(){
        var url = "<?=url_for("ids/formEvaluacion?modo=".$modo."&id=".$ids->getCaId())?>"
        var tipo = document.getElementById("tipo_evaluacion").value;
        
        document.location = url+"?tipo="+tipo;
    }

</script>

<table class="tableList" width="100%" border="1">
    <tr class="row0">
        <td width="20%">
            <b>Fecha </b>
        </td>
        <td width="20%">
           <b>Tipo</b>
        </td>
        <td width="20%">
            <b>Concepto</b>
        </td>
        <td width="20%">
            <b>Calificaci&oacute;n</b>
        </td>
        <td width="20%" align="center">
            <?
            if( $nivel>=2 ){
            ?>
            <select id="tipo_evaluacion">
                <?
                if( $nivel>=4 ){
                ?>
                <option value="seleccion">Selecci&oacute;n</option>
                <?
                }
                ?>
                <option value="desempeno" selected="selected">Desempe&ntilde;o</option>
                <option value="reevaluacion">Reevaluaci&oacute;n:Desempe&ntilde;o</option>

            </select>
           <?
           echo image_tag("16x16/edit_add.gif", array("onClick"=>"crearEvaluacion()"));
          

               
           }
           ?>

        </td>
    </tr>
    <?
    $tipo = null;
    foreach( $evaluaciones as $evaluacion ){
        
    ?>
    <tr   >
        <td>
            <?=Utils::fechaMes($evaluacion->getCaFchevaluacion() )?>

        </td>
        <td>
           <?=ucfirst($evaluacion->getCaTipo())?>
        </td>
         <td>
           <?=$evaluacion->getCaConcepto()?$evaluacion->getCaConcepto():"&nbsp;"?>
        </td>
        <td>
           <?=$evaluacion->getCalificacion()?>
        </td>
        <td align="center">
           <?=link_to(image_tag("16x16/edit.gif"),"ids/verEvaluacion?modo=".$modo."&idevaluacion=".$evaluacion->getCaIdevaluacion())?>
        </td>        
    </tr>
    <?
    }
    ?>
</table>