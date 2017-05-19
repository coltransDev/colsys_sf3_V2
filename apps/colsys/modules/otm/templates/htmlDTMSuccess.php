<?
$reporte = $sf_data->getRaw("reporte");
$repotm = $sf_data->getRaw("repotm");
$marcas = $sf_data->getRaw("marcas");

$datos = array();

$adudestino = $repotm->getProperty("adudestino")?"/".$repotm->getProperty("adudestino"):"";

$datos["bodega"]=$reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo().$adudestino;
$cli=$reporte->getCliente("continuacion");
if($reporte->getCaTiporep()=="4" )
{    
    $datos["consignatario"]["nombre"]=($repotm->getCaIdimportador()!="")?$repotm->getImportador()->getCaNombre():$cli->getCaCompania();
    $datos["consignatario"]["direccion"]=($repotm->getCaIdimportador()!="")?str_replace("|"," ",$repotm->getImportador()->getCaDireccion()):str_replace("|"," ",$cli->getCaDireccion());
    $datos["puerto"]=$repotm->getOrigenimp()->getCaCiudad();    
    $datos["origen"]=$reporte->getOrigen()->getCaCiudad();
    $datos["destino"]=$reporte->getDestino()->getCaCiudad();    

    $datos["peso"]=$repotm->getCaPeso(). " "/*.$repotm->getCaPiezasUn()*/;
    $datos["piezas"]=$repotm->getCaNumpiezas(). " ".$repotm->getCaNumpiezasun();
    $datos["volumen"]=$repotm->getCaVolumen();
}
else
{
    $datos["puerto"]=$reporte->getOrigen()->getCaCiudad();
    $datos["origen"]=$reporte->getDestino()->getCaCiudad();
    $datos["destino"]=$reporte->getDestinoCont()->getCaCiudad();    
    $datos["consignatario"]["nombre"]=$cli->getCaCompania();
    $datos["consignatario"]["direccion"]=str_replace("|"," ",$cli->getCaDireccion());

    $status = $reporte->getUltimoStatus();
    $peso = explode("|", $status->getCaPeso());
    $piezas = explode("|", $status->getCaPiezas());
    $volumen = explode("|", $status->getCaVolumen());
    $datos["peso"]=$peso[0] ? $peso[0] : 0;
    $datos["piezas"]=($piezas[0] ? $piezas[0] : 0). " ". ($piezas[1] ? $piezas[1] : "");
    $datos["volumen"]=$volumen[0] ? $volumen[0] : 0;
}

//$firmaautorizada=($datos["origen"]=="Cartagena")?"Carlos A. Bola&ntilde;o M.<br>C.C. 73569889 Cartagena":"Santos Mabel Tufi&ntilde;o Palacio <br>C.C. 67006136 Cali ";
$firmaautorizada=($datos["origen"]=="Cartagena")?"Carlos A. Bola&ntilde;o M.<br>C.C. 73569889 Cartagena":(($datos["origen"]=="Buenaventura")?"Santos Mabel Tufi&ntilde;o Palacio <br>C.C. 67006136 Cali":"Carlos A. Bola&ntilde;o M.<br>C.C. 73569889 Cartagena");

switch($datos["origen"])
{
    case "Cartagena":
    case "Santa Marta":
        $firmaautorizada="Carlos A. Bola&ntilde;o M.<br>C.C. 73569889 Cartagena";
    break;
    case "Buenaventura":
        $firmaautorizada="Santos Mabel Tufi&ntilde;o Palacio <br>C.C. 67006136 Cali";
    break;
    case "Bogotá":
    case "Bogota":
    case "Bogotá D.C.":
        $firmaautorizada="Sandra Lucia Yepes Leon <br>C.C. 52556478 Bogota";        
    break;
}

?>

<table width="100%" border="0" cellspacing="15" cellpadding="0" >
    <tr>
        <td >
            <table cellpadding="0" cellspacing="0" border="1" >
                <tr >
                    <td><div style="font-size: 19px;">2.CONSIGNOR </div> Expedidor <br> <?=utf8_encode($reporte->getProveedoresStr(true))?><br></td>
                </tr>
                <tr>
                    <td><div style="font-size: 19px;">3.CONSIGNED </div> Consignado a la orden de <br><?=utf8_encode(htmlentities($datos["consignatario"]["nombre"]))?> / <?=utf8_encode(htmlentities($datos["bodega"]))?><br> </td>
                </tr>
                <tr>
                    <td><div style="font-size: 19px;">4.ADDRESS FOR NOTIFICATIONS </div> Direccion para notificacion <br> <?=htmlentities($datos["consignatario"]["nombre"])?> <br> <?=htmlentities($datos["consignatario"]["direccion"])?><br></td>
                </tr>
                <tr>
                    <td><div style="font-size: 19px;">5.PLACE AND DATE OF RECEIPT - CODE </div> Lugar y fecha de recibo - codigo <br> <?=$datos["puerto"]." ".$repotm->getCaFchdoctransporte()?><br> </td>
                </tr>
            </table>
       </td>
       <td>
            <table border="1">
                <tr>
                    <td>No. <?=$repotm->getConsecutivoDtm()?><br></td>
                </tr>
                <tr>
                    <td style="font-size: 26px;" align="center">NEGOTIABLE MULTIMODAL TRANSPORTATION ANDEAN<BR>DOCUMENT INTERNATIONATIONAL M.T.A.D.I<BR>Documento Andino de Transporte<br> Multimodal Internacional D.A.T5.M.I.<br>
                        <br><img src="/images/logos/LOGOCOLTM200.jpg" width="200" height="69"><br>
                        El O.T.M abajo firmante ser&aacute; responsable por el cumplimiento de los t&eacute;rminos del contrato de Transporte Multimodal y las DECISIONES 331 Y 393 DE LA COMISI&Oacute;N DEL ACUERDO DE CARTAGENA
                        <br>&nbsp;<br><br>
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
                </tr>
                <tr style="font-size: 22px;">
                    <td>3</td>
                    <td><?=htmlentities($datos["puerto"])?></td>
                    <td><?=htmlentities($datos["origen"])?></td>
                    <td>1</td>
                    <td><?=htmlentities($datos["origen"])?></td>
                    <td><?=htmlentities($datos["destino"])?></td>
                    <td></td>
                    <td></td>
                    <td></td>                    
                </tr>
            </table>
        </td>
    </tr>    
    <tr>
        <td colspan="2" style="font-size: 26px;">
            <table border="1">
                <tr style="font-size: 18px;">
                        <td>7.HANDLING INSTRUCTIONS<br>Instruccion de manejo</td>
                </tr>
            </table>        
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table border="1">
                <tr style="font-size: 20px;">
                    <td width="100">8.INTENTED DATE OF DELIVERY<br>fecha de entrega programada</td>
                    <td width="120">9.NUMBER DE ORIGINAL DTMs ISSUED<br>No. de D.T.M. orig.</td>
                    <td width="100">10.TYPE OF CARGO<br>Tipo de carga<br></td>
                    <td width="250">11.PLACE OF FINAL DELIBERY<br>Lugar de entrega final</td>
                </tr>
                <tr style="font-size: 20px;">
                    <td></td>
                    <td>1</td>
                    <td><?=($reporte->getCaMciaPeligrosa()==true)?"Peligrosa":"General"?></td>
                    <td><b><?=utf8_encode($reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo())?></b></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table border="1" >
                <tr style="font-size: 20px;">
                    <td width="100">12.MARKS AND NUMBERS<br></td>
                    <td width="100">13.NUMBERS AND TYPE OF PACKAGES<br></td>
                    <td width="200">14.DESCRIPTION OF GOODS <br></td>
                    <td width="85">15.GROSS WEIGHT<br></td>
                    <td width="85">16.VOLUMEN<br></td>
                </tr>
                <tr style="font-size: 20px;">
                    <td width="100"><?=$marcas?></td>
                    <td width="100"><?=$datos["piezas"]?></td>
                    <td width="200">Dice contener:<br> <?=$reporte->getCaMercanciaDesc()?></td>
                    <td width="85"><?=$datos["peso"]?></td>
                    <td width="85"><?=$datos["volumen"]?></td>
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
            <table style="font-size: 16px;"  border="1" style="border:1px solid #FF0000" >
                <tr>
                    <td width="60%" style="font-size: 22px;"><div style="font-size: 14px;text-align: justify">18.GOODS AND INSTRUCTIONS ARE ACEPTED</div>
                    <BR>
                    Los bienes e instrucciones son aceptadas y manejados con sujecion a las condiciones del contrato de transporte multimodal a menos que se indique lo contrario en el presente documento, son tomados a cargo en unbuen orden y condicion aparente en el lugar de recibo para su transporte y entrega segun lo arriba mencionado. Uno de estos documentos de transporte multimodal debe ser entregado debidamentre endosado a cambio de los bienes en fe de lo cual el D.T.M. Original y todas estas copias exactas y fachadas han sido firmadas en el numero de estipulados abajo.
                    </td>
                    <td width="40%">
                    <div style="font-size: 18px;">Este valor es netamente para poliza de seguro</div>
                        <table border="1" style="font-size: 18px;">
                            <tr>
                                <td >Valor Fob</td><td style="text-align: right"><?=round($repotm->getCaValorfob(),2)?></td>
                            </tr>
                            <tr>
                                <td>Flete</td><td style="text-align: right"><?=round(($repotm->getCaValorfob()*0.26),2)?></td>
                            </tr>
                            <tr>
                                <td>Valor Aprox DDP</td><td align="right"><?=round($repotm->getCaValorfob()+($repotm->getCaValorfob()*0.26),2)?></td>
                            </tr>
                        </table>
                    <div style="font-size: 18px;">19 COST AND FREIGHT</div>
                    </td>
                </tr>
                <tr>
                    <td width="60%" style="font-size: 22px;">
                        <div style="font-size: 22px;text-align: justify">20.NAME, ADDRESS AND TELEPHONE NUMBER AGENT MAKING THE DELIVERY<BR>Nombre, Direccion y telefono del agente de OTM que entrega</div>
                    <BR>
                    COL OTM S.A.S. , <?=htmlentities($datos["origen"])?>
                    <br><br>
                    </td>
                    <td width="40%">
                    <div style="font-size: 18px;">22. OTM AUTORIZED SIGNATURE</div>
                        <table  border="1" style="font-size: 18px;">
                            <tr>
                                <td>Firma autorizada OTM<br>Name<br>Nombre</td>
                                <td><?=$firmaautorizada?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>