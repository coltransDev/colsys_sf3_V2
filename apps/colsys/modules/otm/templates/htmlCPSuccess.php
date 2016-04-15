<?
$reporte = $sf_data->getRaw("reporte");
$repotm = $sf_data->getRaw("repotm");
$referencia = $sf_data->getRaw("referencia");

$datos = array();

$datos["bodega"]=$reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo();
$datos["bodega_direccion"]=$reporte->getBodega()->getCaDireccion();
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
$firmaautorizada=($datos["origen"]=="Cartagena")?"Carlos A. Bola&ntilde;o M.<br>C.C. 73569889 Cartagena":(($datos["origen"]=="Buenaventura")?"Santos Mabel Tufi&ntilde;o Palacio <br>C.C. 67006136 Cali":"Carlos A. Bola&ntilde;o M.<br>C.C. 73569889 Cartagena");
?>

<table width="100%" border="1" cellspacing="15" cellpadding="0"  >
    <tr>
        <td >
            <table cellpadding="3" cellspacing="2" border="0" style="font-size: 22px;" >
                <tr >
                    <td colspan="4" align="center"><img src="/images/logos/LOGOCOLTM200.jpg" width="200" height="69"><br>
                        <b>ACTA DE ENTREGA AL TRANSPORTE</b>
                    </td>
                </tr>
                <tr>
                    <td width="30%" >Fecha de Entrega</td><td colspan="3"><?=date("Y-m-d")?></td>
                </tr>
                <tr>
                    <td >Compa&ntilde;ia Transportadora</td><td colspan="3"><?=$repotm->getIdsProveedor()->getIds()->getCaNombre()?></td>
                </tr>
                
                <tr>
                    <td >Importador</td><td colspan="3"><?=$reporte->getProveedoresStr(true)?></td>
                </tr>
                <tr>
                    <td >Trayecto Terrestre</td><td colspan="3"><?=$datos["origen"]."-".$datos["destino"]?></td>
                </tr>
                <tr>
                    <td >Deposito donde se finaliza C.V.</td><td colspan="3"><?=$datos["bodega"]?></td>
                </tr>
                <tr>
                    <td >Direccion del deposito</td><td colspan="3"><?=$datos["bodega_direccion"]?></td>
                </tr>
                <tr>
                    <td >Fecha de Finalizaci&oacute;n</td><td colspan="3"><?=$repotm->getProperty("fechafinalizacion")?></td>
                </tr>
                <tr>
                    <td >Fecha de Vencimiento</td><td colspan="3"><?=$repotm->getProperty("fechavencimiento")?></td>
                </tr>
                <tr>
                    <td >Referencia</td><td colspan="3"><?=$referencia?></td>
                </tr>                
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>                
                <tr>
                    <th colspan="4" align="center"><b>DOCUMENTOS ENTREGADOS AL TRANSPORTADOR</b></th>
                </tr>                
                <tr>
                    <th><b>DOCUMENTOS</b></th>
                    <th><b>NUMERO</b></th>
                    <th><b>ORIGINAL</b></th>
                    <th><b>COPIA</b></th>
                </tr>
                
                <tr>
                    <td >D.T.M.</td><td ><?=$repotm->getConsecutivoDtm()?></td><td >1</td><td ></td>
                </tr>
                
                <tr>
                    <td >Documento de transporte Hijo</td><td ><?=$repotm->getCaHbls()?></td><td >1</td><td >1</td>
                </tr>
                
                <tr>
                    <td >Continuaci&oacute;n de Viaje</td><td ><?=$repotm->getProperty("nocontinuacion")?></td><td >1</td><td >1</td>
                </tr>
                <tr>
                    <td >Factura comecial</td><td ></td><td ></td><td ></td>
                </tr>
                <tr>
                    <td >Contrato de comadato y paz y salvo</td><td ></td><td ></td><td ></td>
                </tr>
                <tr>
                    <td >Monto a asegurar</td><td ><?=round($repotm->getCaValorfob()+($repotm->getCaValorfob()*0.26),2)?></td><td ></td><td ></td>
                </tr>
                <tr>
                    <td >(**) CONS. DESC. FINAL</td><td ></td><td ></td><td ></td>
                </tr>
                <tr>
                    <td >(**) Consulta de inventario</td><td ><?=$repotm->getCaManifiesto()?></td><td ></td><td ></td>
                </tr>
                <tr>
                    <td >Otro: Facturas comerciales</td><td ></td><td ></td><td ></td>
                </tr>
                <tr>
                    <td >Contenedor No.</td><td colspan="3"><?=$repotm->getCaContenedor()?></td>
                </tr>
                <tr>
                    <td >Peso en Kgs.</td><td colspan="3"><?=$datos["peso"]?></td>
                </tr>
                <tr>
                    <td >Peso seg&uacute;n puerto</td><td colspan="3"></td>
                </tr>
                <tr>
                    <td >Precinto DIAN Nro.</td><td colspan="3"></td>
                </tr>
                <tr>
                    <td >Localizaci&oacute;n</td><td colspan="3"><?=$repotm->getInoDianDepositos()->getCaNombre()?></td>
                </tr>
                <tr>
                    <td >Cantidad de Bultos</td><td colspan="3"><?=$datos["piezas"]?></td>
                </tr>
                <tr>
                    <td >Clase de Mercancia</td><td colspan="3"><?=$reporte->getCaMercanciaDesc()?></td>
                </tr>
                <tr>
                    <td >Carga Lcl</td><td colspan="3"></td>
                </tr>
                
                <tr>
                    <td style="height: 40px" >OBSERVACIONES O INSTRUCCIONES ESPECIALES:</td><td colspan="3"><?=$repotm->getProperty("observaciones")?></td>
                </tr>
                
                
                <tr><td colspan='4'></td></tr>
                <tr><td>Cordialmente</td></tr>
                <tr>    
                    <td><?=$firmaautorizada?></td>
                    <td></td>
                    <td colspan="2">
                        <table>
                            <tr><td>Recibido por</td></tr>
                            <tr><td>Fecha de recibo</td></tr>
                            <tr><td>Hora de recibo</td></tr>
                            <tr><td>Colocar sello de recibido</td></tr>
                            
                        </table>
                    </td>
                </tr>
                <tr><td></td></tr>
                
            </table>
            
            
            
        </td>
    </tr>
</table>
<? //exit;?>