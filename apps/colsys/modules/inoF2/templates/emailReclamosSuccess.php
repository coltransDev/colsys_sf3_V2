<?php

$reclamos = $sf_data->getRaw("reclamos");
$user = $sf_data->getRaw("user");
?>
<table width="100%" border="0" cellspacing="5" cellpadding="0">
    <tr>        
        <td >
            <div ><font size="2" face="arial, helvetica, sans-serif" >
                Apreciado Proveedor <br>

                Extendemos un cordial saludo.<br>

                Hemos encontrado una diferencia de valor  en su factura #  <?=$reclamos->getCaFactura()?> con respecto a lo acordado <br>
                Por lo anterior procede reclamo y no aceptaci�n de su factura. <br>

                Esperamos una pronto revisi�n y env�o de la correcta factura y/o nota cr�dito a favor de Coltrans SAS <br>
            </font></div>
         </td>
    </tr>
    <tr>
        <td>
<?php
if($user!==false)
{
?>
<font size="2" face="arial, helvetica, sans-serif" color="#000000">
<br />
Cualquier informaci�n adicional que ustedes requieran, con gusto le ser� suministrada.<br />
<br />
Cordial Saludo.<br />
<br />
<br />
<?php
 echo $user->getFirmaHTML();
}
?>
</font>
        </td>
    </tr>
    <tr><td colspan="2"><hr noshade size="1"></td></tr>    
</table>



