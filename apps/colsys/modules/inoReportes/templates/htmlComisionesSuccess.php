<?
$comprobante = $sf_data->getRaw("comprobante");
?>

<table width="100%" border="1" cellspacing="15" cellpadding="0"  >
    <tr>
        <td >
            <table cellpadding="3" cellspacing="2" border="0" style="font-size: 22px;" >
                <tr >
                    <td colspan="4" align="center"><img src="/images/logos/logoCOLTRANS.png" width="316" height="60"><br>
                        <b>COMPROBANTE DE COMISIONES No. <?=$comprobante->getCaConsecutivo()?></b>
                    </td>
                </tr>                
            </table>            
        </td>
    </tr>
</table>
<? //exit;?>