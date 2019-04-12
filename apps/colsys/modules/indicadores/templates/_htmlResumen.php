<table width="100%" border="1" cellpadding="2" cellspacing="2" align="center" style="border-collapse:collapse;">
    <tr><th style="text-align: center; background-color: #E3E3E3;" colspan="6"><b><?= utf8_decode($sf_data->getRaw("title"))?></b><br/><b><?= utf8_decode($subtitle)?></b></th></tr>
    <tr>
        <td rowspan="3" style=" vertical-align: top;"><b>Sucursal(es)</b><br/>{sucursal}</td>    
        <td style="background-color: #E3E3E3;">Producto NO Conforme (%)</td>
        <td>No Casos {pnc_count}</td>
        <td><b>{pnc_perc}%</b></td>
        <td style="background-color: #E3E3E3;">LCs:</td>
        <td><b>{lim_sup}</b></td>
    </tr>
    <tr>
        <td style="background-color: #E3E3E3;">Promedio Ponderado:</td>            
        <td>No Casos {avg_count}</td>
        <td><b>{avg_perc}</b></td>
        <td style="background-color: #E3E3E3;">LC:</td>
        <td><b></b></td>            
    </tr>
    <tr>
        <td style="background-color: #E3E3E3;">Registros Excluidos del Promedio</td>
        <td>No Casos {exc_count}</td>
        <td><b>{exc_perc}%</b></td>
        <td>&nbsp;</td>            
        <td><b></b></td>            
    </tr>
</table> 