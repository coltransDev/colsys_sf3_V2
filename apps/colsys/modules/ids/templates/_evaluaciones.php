<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
   var crearEvaluacion =function(){
      var url = "<?= url_for("ids/formEvaluacion?modo=" . $modo . "&id=" . $ids->getCaId()) ?>"
      var tipo = document.getElementById("tipo_evaluacion").value;
        
      document.location = url+"?tipo="+tipo;
   }

</script>
<?
$initialYear = 2007;
$actualYear = date("Y");
$numYears = $actualYear - $initialYear + 1;
?>
<table class="tableList " width="100%" border="1">
   <tr class="row0">
      <?
      $years = array();
      $evals = $ids->getCalificaciones();

      foreach ($evals as $key => $val) {
         ?>            
         <td <?= !isset($val[0]) ? "colspan='2'" : "" ?>><div align="center"  > <?= $key ?></div></td>
         <?
      }
      ?>
      <td><div align="center">+</div></td>
      <td><div align="center">=</div></td>
      <td><div align="center">-</div></td>
   </tr>
   <tr>
      <?
      $evaluacionAnt = null;
      $evaluacion = null;
      foreach ($evals as $key => $val) {
         $evaluacionAnt = $evaluacion;
         $evaluacion = null;
         if (isset($val[0])) {
            if (isset($evals[$key])) {
               $evaluacion = $val[0];
            }
            ?>
            <td><div align="left"><?= $evaluacion ? $evaluacion : "&nbsp;" ?></div></td>
            <?
         } else {
             if($val[2]){
                $evaluacion = $val[2];
             }else{
                $evaluacion = $val[1]; 
             }
            ?>
            <td><div align="left"><?= $val[1] ? $val[1] : "&nbsp;" ?></div></td>
            <td><div align="left"><?= $val[2] ? $val[2] : "&nbsp;" ?></div></td>
            <?
         }
      }
      ?>
      <td><div align="center"><?= $evaluacionAnt && $evaluacionAnt < $evaluacion ? "X" : "&nbsp;" ?></div></td>
      <td><div align="center"><?= $evaluacionAnt && $evaluacionAnt == $evaluacion ? "X" : "&nbsp;" ?></div></td>
      <td><div align="center"><?= $evaluacionAnt && $evaluacionAnt > $evaluacion ? "X" : "&nbsp;" ?></div></td>
   </tr>
</table>
<br>

<table class="tableList alignLeft" width="100%" border="1">
   <tr class="row0">
      <td width="15%">
         <b>Fecha </b>
      </td>
      <td width="5%">
         <b>A&ntilde;o</b>
      </td>
      <td width="5%">
         <b>Periodo</b>
      </td>
      <td width="20%">
         <b>Tipo</b>
      </td>
      <td width="20%">
         <b>Concepto</b>
      </td>
      <td width="10%">
         <b>Calificaci&oacute;n</b>
      </td>
      <td width="25%" align="center">
         <?
         if ($nivel >= 2) {
            ?>
            <select id="tipo_evaluacion">

               <option value="seleccion">Selecci&oacute;n</option>
               <?
               $tipos_array = array("TRI"); //, "TRN", "DEP", "ESC", "OPL", "MNT"
               if (in_array($ids->getIdsProveedor()->getCaTipo(), $tipos_array)) {
                  ?>
                  <option value="desempeno_impo" selected="selected">Desempe&ntilde;o Impo</option>
                  <option value="desempeno_expo">Desempe&ntilde;o Expo</option>
                  <option value="reevaluacion_impo">Reevaluaci&oacute;n:Desempe&ntilde;o Impo</option>
                  <option value="reevaluacion_expo">Reevaluaci&oacute;n:Desempe&ntilde;o Expo</option>
                  <?
               } else {
                  ?>
                  <option value="desempeno" selected="selected">Desempe&ntilde;o</option>
                  <option value="reevaluacion">Reevaluaci&oacute;n:Desempe&ntilde;o</option>
                  <?
               }
               ?>

            </select>
            <?
            echo image_tag("16x16/edit_add.gif", array("onClick" => "crearEvaluacion()"));
         }
         ?>

      </td>
   </tr>
   <?
   $tipo = null;
   foreach ($evaluaciones as $evaluacion) {
      ?>
      <tr   >
         <td>
            <?= Utils::fechaMes($evaluacion->getCaFchevaluacion()) ?>

         </td>
         <td>
            <?= $evaluacion->getCaAno() ?>

         </td>
         <td>
            <?= $evaluacion->getCaPeriodo() ?>

         </td>
         <td>
            <?= ucfirst($evaluacion->getCaTipo()) ?>
         </td>
         <td>
            <?= $evaluacion->getCaConcepto() ? $evaluacion->getCaConcepto() : "&nbsp;" ?>
         </td>
         <td>
            <?= $evaluacion->getCalificacion() ?>
         </td>
         <td align="center">
            <?= link_to(image_tag("16x16/edit.gif"), "ids/verEvaluacion?modo=" . $modo . "&idevaluacion=" . $evaluacion->getCaIdevaluacion()) ?>
            <?= link_to(image_tag("16x16/pdf.gif"), "/ids/verComunicado/modo/$modo/id/".$ids->getCaId()."/ano/".$evaluacion->getCaAno()."/periodo/".$evaluacion->getCaPeriodo() ) ?>
         </td>        
      </tr>
      <?
   }
   ?>
</table>