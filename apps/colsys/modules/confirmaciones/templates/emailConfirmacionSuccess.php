<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$referencia = $sf_data->getRaw("referencia");
?>


<table width="50%" border="0" class="tableList">
    <tr>
        <td colspan="3">
            <?=$intro_body?>
            <br/>
            <?=(($fchsyga)?"Fecha SYGA : ".$fchsyga:"")?>
        </td>
    </tr>
    <tr>
        <td width="33%"><b>Origen :</b><?=$referencia->getOrigen()->getCaCiudad()?></td>
        <td width="33%"><b>Nombre del Buque :</b><?=$referencia->getCaMnllegada()?></td>
        <td width="33%"><b>Bandera :</b><?=$referencia->getCaBandera()?></td>        
    </tr>
    <tr>
        <td width="33%"><b>Destino :</b><?=$referencia->getDestino()->getCaCiudad()?></td>
        <td width="33%"><b>Fch.Llegada :</b><?=$referencia->getCaFchconfirmacion()?></td>
        <td width="33%"><b>Fch.Registro :</b><?=$referencia->getCaFchdesconsolidacion()?></td>
    </tr>
    <tr>
        <td width="33%"><b>Reg.Aduanero :</b><?=$referencia->getCaRegistroadu()?></td>
        <td width="33%"><b>Fch.Registro :</b><?=$referencia->getCaFchregistroadu()?></td>
        <td width="33%"><b>Reg.Capitania :</b><?=$referencia->getCaRegistrocap()?></td>        
    </tr>
        <tr>
        <td width="33%"><b>Reg.Aduanero :</b><?=$referencia->getCaRegistroadu()?></td>
        <td width="33%"><b>Fch.Registro :</b><?=$referencia->getCaFchregistroadu()?></td>
        <td width="33%"><b>Reg.Capitania :</b><?=$referencia->getCaRegistrocap()?></td>        
    </tr>
    <tr>
        <td colspan="3">
            La información ha sido registrada en el sistema, favor proceder a informar a los clientes.<br/>
            Cordial Saludo.
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <?=$usuario->getFirma()?>
        </td>
    </tr>
</table>



