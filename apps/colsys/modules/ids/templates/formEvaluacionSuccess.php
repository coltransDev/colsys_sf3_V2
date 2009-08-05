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
    <table class="tableList" width="50%">
        <tr>
            <th colspan="2">&nbsp;</th>
        </tr>
        <tr>
            <td colspan="2">
                Por favor seleccione el tipo de evaluaci&oacute;n<br />
                <select name="tipo" id="tipo" onchange='actualizarContenido( "evaluacion", "<?=url_for("ids/getConceptosEvaluacion");?>", {tipocriterio:this.value} );'>
                    <option value="seleccion">Selecci&oacute;n</option>
                    <option value="desempeno">Desempe&ntilde;o</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Fecha:<br />
                <?
                echo extDatePicker("fchevaluacion", date("Y-m-d"));
                ?>

            </td>
        
            <td>
                Concepto:<br />
                <select>
                    <option value=""></option>
                    <option value="<?=Constantes::IMPO?>">Importaci&oacute;n</option>
                    <option value="<?=Constantes::EXPO?>">Exportaci&oacute;n</option>
                </select>

            </td>

            <tr>
            <td colspan="2">
                <div id="evaluacion"></div>
            </td>
        </tr>
        </tr>
    </table>
    </form>

</div>
<script type="text/javascript">
   

    actualizarContenido( 'evaluacion', '<?=url_for("ids/getConceptosEvaluacion");?>', {tipocriterio:document.getElementById("tipo").value} );

</script>