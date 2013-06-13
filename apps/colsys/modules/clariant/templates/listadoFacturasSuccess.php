<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

use_helper("ExtCalendar");
?>
<div class="content" align="center">
    <h2>Informe de Facturación Clariant</h2>
    <br />
    <form action="<?=url_for("clariant/novedadesFacturacion")?>" method="post" >
        <table class="tableList"  width="600px"  >
            <tr>
                <th colspan="6"> 
                    Ingrese los par&aacute;metros para el Reporte
                </th>
            </tr>
            <tr>
                <td>
                    Fecha Inicial:
                    <?=extDatePicker("fchInicial", date("Y-m-")."01")?>
                </td>
                <td>
                    Fecha Final:
                    <?=extDatePicker("fchFinal", date("Y-m-d"))?>
                </td>
                <td>
                    <input type="submit" value="Consultar" class="button" />                
                </td>
            </tr>

        </table>
        
         <br />
        <br />
    <table CELLSPACING=10>
    <tr>
      <th><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='document.location="/clariant/novedadesFacturacion"'></th>
    </tr>
    </table>   
    </form>       
</div>