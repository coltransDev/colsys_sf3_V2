<?
$comprobante = $sf_data->getRaw("comprobante");
$usuario = $sf_data->getRaw("usuario");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0"  >
    <tr>
        <td >
            <table  border="0" style="font-size: 14px;" border="1" cellspacing="0" cellpadding="2" width="100%" >
                <tr >
                    <td colspan="10" align="center"><img src="/images/branding/coltrans/logo316x60.png" ><br>
                        <b>COMPROBANTE DE COMISIONES No. <?=$comprobante->getCaConsecutivo()?></b>
                        <br> <?=$comprobante->getCaFchcomprobante()?>
                    </td>
                </tr>
                <tr style="font-weight: bold">
                    <td>Referencia</td>
                    <td>Cliente</td>
                    <td>Doc. Trans</td>
                    <td>Factura</td>
                    <td>Fecha Fac</td>
                    <td>Recibo</td>
                    <td>Fecha recibo</td>
                    <td>%</td>
                    <td>INO</td>
                    <td>Comision</td>
                    
                </tr>
                <?                
                $inoDetalles=$comprobante->getInoDetalle();          
                $total_comision=0;
                foreach($inoDetalles as $d)
                {                    
                    $house=$d->getInoHouse();
                    $comision=$d->getCaCr();//$house->calculateFee();
                    $total_comision+=$comision;
                ?>
                <tr>
                    <td><?=$house->getInoMaster()->getCaReferencia()?></td>
                    <td><?=$house->getCliente()->getCaCompania()?></td>
                    <td><?=$house->getCaDoctransporte()?></td>
                    <td>
                    <?
                    foreach($house->getFacturas() as $f)
                    {
                        echo $f->getCaConsecutivo()."<br>";
                    }
                    ?>
                    </td>
                    <td>
                    <?
                    foreach($house->getFacturas() as $f)
                    {
                        echo $f->getCaFchcomprobante()."<br>";
                    }
                    ?>
                    </td>
                    <td>
                    <?
                    foreach($house->getReciboCaja() as $r)
                    {
                        echo $r->getCaConsecutivo()."<br>";
                    }
                    ?>
                    </td>
                    <td>
                    <?
                    foreach($house->getReciboCaja() as $r)
                    {
                        echo $r->getCaFchcomprobante()."<br>";
                    }
                    ?>
                    </td>
                    <td>10%</td>
                    <td><?=Utils::formatNumber(($comision*100)/10)?></td>
                    <td><?=Utils::formatNumber($comision)?></td>
                </tr>
                <?
                }
                ?>
                <tr>
                    <td colspan="8">Totales</td>                    
                    <td><?=Utils::formatNumber(($total_comision*100)/10)?></td>
                    <td><?=Utils::formatNumber($total_comision)?></td>
                </tr>
            </table>            
        </td>
    </tr>
</table>

<? 
echo $usuario->getFirmaHTML();
?>