<?
$reporte = $sf_data->getRaw("reporte");
$repotm = $sf_data->getRaw("repotm");

$datos = array();

$datos["bodega"]=$reporte->getBodega()->getCaNombre();
//echo $reporte->getCaTiporep();
    
if($reporte->getCaTiporep()=="4")
{
    $datos["puerto"]=$repotm->getOrigenimp()->getCaCiudad();
    $datos["origen"]=$reporte->getOrigen()->getCaCiudad();
    $datos["destino"]=$reporte->getDestino()->getCaCiudad();
    $datos["consignatario"]["nombre"]=$repotm->getImportador()->getCaNombre();
    $datos["consignatario"]["direccion"]=$repotm->getImportador()->getCaDireccion();
    
    $datos["peso"]=$repotm->getCaPeso(). " "/*.$repotm->getCaPiezasUn()*/;
    $datos["piezas"]=$repotm->getCaNumpiezas();
    $datos["volumen"]=$repotm->getCaVolumen();
}
else
{
    $datos["puerto"]=$reporte->getOrigen()->getCaCiudad();
    $datos["origen"]=$reporte->getDestino()->getCaCiudad();
    $datos["destino"]=$reporte->getDestinoCont()->getCaCiudad();            
    $datos["consignatario"]["nombre"]=$reporte->getConsignatario()->getCaNombre();
    $datos["consignatario"]["direccion"]=$reporte->getConsignatario()->getCaDireccion(); 
    $status = $reporte->getUltimoStatus();
    $peso = explode("|", $status->getCaPeso());
    $piezas = explode("|", $status->getCaPiezas());
    $volumen = explode("|", $status->getCaVolumen());
    $datos["peso"]=$peso[0] ? $peso[0] : 0;
    $datos["piezas"]=($piezas[0] ? $piezas[0] : 0). " ". ($piezas[1] ? $piezas[1] : "");
    $datos["volumen"]=$volumen[0] ? $volumen[0] : 0;
}
?>
<table cellpadding="1" cellspacing="1" border="1">
    <tr>
        <td>
            <table style="font-size: 25px;">
                <tr >
                    <td><div style="font-size: 19px;">2.CONSIGNOR </div> Expedidor <br> <?=htmlentities($reporte->getCliente()->getCaCompania())?></td>
                </tr>
                <tr>
                    <td><div style="font-size: 19px;">3.CONSIGNED </div> Consignado a la orden de <br> <?=htmlentities($datos["bodega"])?>/ <BR> <?=htmlentities($datos["consignatario"]["nombre"])?></td>
                </tr>
                <tr>
                    <td><div style="font-size: 19px;">4.ADDRESS FOR NOTIFICATIONS </div> Direccion para notificacion <br> <?=htmlentities($datos["consignatario"]["nombre"])?> <br> <?=htmlentities($datos["consignatario"]["direccion"])?></td>
                </tr>
                <tr>
                    <td><div style="font-size: 19px;">5.PLACE AND DATE OF RECEIPT - CODE </div> Lugar y fecha de recibo - codigo <br> Por definir</td>
                </tr>
            </table>
       </td>
       <td>
            <table border="1">
                <tr>
                    <td><?=$repotm->getCaIddtm()?></td>
                </tr>
                <tr>
                    <td>NEGOTIABLE MULTIMODAL TRANSPORTATION ANDEAN<BR>DOCUMENT INTERNATIONATIONAL M.T.A.D.I<BR>Documento Andino de Transporte<br> Multimodal Internacional D.A.T.5.M.I.<br>
                        <img src="/images/logos/LOGOCOLTM200.jpg" width="200" height="69"><br>
                    </td>
                </tr>
            </table>
       </td>
    </tr>
    <tr>
        <td colspan="2">
            <table border="1">
                <tr style="font-size: 18px;" >
                    <td>MODES<BR>modo</td>
                    <td>ORIGIN<BR>Origen</td>
                    <td>DESTINATION<BR>DESTINO</td>                    
                    <td>MODES<BR>modo</td>
                    <td>ORIGIN<BR>Origen</td>
                    <td>DESTINATION<BR>DESTINO</td>
                    <td>MODES<BR>modo</td>
                    <td>ORIGIN<BR>Origen</td>
                    <td>DESTINATION<BR>DESTINO</td>
                    <td>MODES<BR>modo</td>
                    <td>ORIGIN<BR>Origen</td>
                    <td>DESTINATION<BR>DESTINO</td>
                </tr>
                <tr style="font-size: 22px;">
                    <td>3</td>
                    <td><?=htmlentities($datos["puerto"])?></td>
                    <td><?=htmlentities($datos["origen"])?></td>
                    <td>1</td>
                    <td><?=htmlentities($datos["origen"])?></td>
                    <td><?=  htmlentities($datos["destino"])?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>
    <br>
    <tr>
        <td colspan="2" style="font-size: 26px;"><div style="font-size: 18px;">7.HANDLING INSTRUCTIONS</div>
        Instruccion de manejo
        </td>
    </tr>
    <br>
    <tr>
        <td colspan="2">
            <table>
                <tr style="font-size: 20px;">
                    <td>8.INTENTED DATE OF DELIVERY<BR>fecha de entrega programada<br><?=$repotm->getCaFcharribo()?></td>
                    <td>9.NUMBER DE ORIGINAL DTMs ISSUED<BR>No. de D.T.M. orig.<br>1</td>
                    <td>10.TYPE OF CARGO Tipo de carga<BR><?=($reporte->getCaMciaPeligrosa()==true)?"Peligrosa":"General"?></td>
                    <td>PLACE OF FINAL DELIBERY<BR>Lugar de entrega final<br><b><?=$reporte->getBodega()->getCaNombre()?></b></td>
                </tr>
            </table>
        </td>
    </tr>
    <br>
    <tr>
        <td colspan="2">
            <table border="1" >
                <tr style="font-size: 20px;">
                    <td>12.MARKS AND NUMBERS<BR><?=$marcas?></td>
                    <td>13.NUMBERS AND TYPE OF PACKAGES<BR><?=$datos["piezas"]?></td>
                    <td>14.DESCRIPTION OF GOODS <BR><?=$reporte->getCaMercanciaDesc()?></td>
                    <td>15.GROSS WEIGHT<BR><?=$datos["peso"]?></td>
                    <td>16.VOLUMEN<BR><?=$datos["volumen"]?></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table style="font-size: 16px;"  border="1">
                <tr>
                    <td width="60%" style="font-size: 22px;"><div style="font-size: 14px;">18.GOODS AND INSTRUCTIONS ARE ACEPTED</div>
                    <BR>
                    Los bienes e instrucciones son aceptadas y manejados con sujecion a las coindiciones del contrato de transporte multimodal a menos que se indique lo contrario en el presente documento, son tomados a cargo en unbuen orden y condicion aparente en el lugar de recibo para su transporte y entrega segun lo arriba mencionado. Uno de estos documentos de transporte multimodal debe ser entregado debidamentre endosado a cambio de los bienes en fe de lo cual el D.T.M. Original y todas estas copias ecaxtas y fachadas han sido firmadas en el numero de estipulados abajo.
                    </td>
                    <td width="40%">
                    <div style="font-size: 18px;">19 COST AND FREIGHT</div>
                        <table  border="1"> 
                            <tr >
                                <td rowspan="2">FREIGHT<BR>Flete</td>
                                <td>PREPAID<br>Prepagado</td>
                                <td>CURRENCY<br>Moneda</td>
                                <td>COLLECT<br>Al cobro</td>
                                <td>CURRENCY<br>Moneda</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>OTHERS<br>Otros</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>