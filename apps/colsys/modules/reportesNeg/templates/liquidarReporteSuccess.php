<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



?>



<div class="content" align="center">
    <table class="tableList alignLeft" width="90%">
        <tr>
            <th> Liquidacion Reporte de Negocio</th>
        </tr>
        <tr>
            <td>Reporte <?=$reporte->getCaConsecutivo()?></td>
        </tr>

        <tr class="row0">
            <td><b>Conceptos de Fletes</b></td>
        </tr>
        <tr >
            <td>
                <div id="panel-fletes"></div>
            </td>
        </tr>
        <tr class="row0">
            <td><b>Recargos locales</b></td>
        </tr>
        <tr class="row0">
            <td><b>Recargos de Aduana</b></td>
        </tr>

    </table>
</div>
<?
include_component("reportesNeg","panelConceptosFletes", array("reporte"=>$reporte));
?>
<script language="javascript">
      var panelFletes = new PanelConceptosFletes();
      //panelFletes.render("panel-fletes");

      var mainPanel = new PanelConceptosFletes({
                            items: [panelFletes]
                      });
      mainPanel.render("panel-fletes");

</script>