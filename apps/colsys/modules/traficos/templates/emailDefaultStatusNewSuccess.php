<?
$user = $sf_data->getRaw("user");
$status = $sf_data->getRaw("status");
$etapa = $sf_data->getRaw("etapa");
$firmaotm = $sf_data->getRaw("firmaotm");
$company = $sf_data->getRaw("company");
$modo = $sf_data->getRaw("modo");
?>

<div class="htmlContent">
    <?
    $reporte = $status->getReporte();
    $cliente = $reporte->getCliente();  
    $comercial = $reporte->getCaLogin(); 
    $house = $reporte->getInoHouse()->getFirst(); 
    
    ?>
    <div align="center"><h3><?= ($etapa && $etapa->getCaTitle()) ? $etapa->getCaTitle() : "SEGUIMIENTO DE CARGA" ?></h3></div>
    <div align="left">
        <table width="100%" cellspacing="1"  class="tableList">
            <tr>
                <td style="padding: 2px; font-size: 13px;font-family: Arial,Helvetica,sans-serif;">
                    Señores:<br />
                    <? if ($modo != "otm") { ?>
                        <b><?= strtoupper($cliente->getCaCompania()) ?></b>
                        <?
                    } else {
                        $inoClientes = $reporte->getInoHouse();
                        if ($comercial == "consolcargo" || count($inoClientes) <= 0) {
                            ?>
                            <b><?= strtoupper($cliente->getCaCompania()) ?></b>
                            <?
                        } else {
                            foreach ($inoClientes as $inoCliente) {
                                ?>
                                <b><?= strtoupper($inoCliente->getCliente()->getCaCompania()) ?></b>
                                <?
                            }
                        }
                    }
                    ?>
                    <br /><br />
                    <?= $status->getCaIntroduccion() ?>
                </td>
                <?
//                if ($user->getSucursal()->getEmpresa()->getCaNombre() == "Coltrans S.A.S.") {
//                ?>
<!--                    <td width="300">
                        <div style="float:right"><a href="https://www.coltrans.com.co/logosoficiales/coltrans/fitac2_2018.jpg" target="_blank"><img src="https://www.coltrans.com.co/logosoficiales/coltrans/fitac2_2018.jpg" width="300" /></a></div>
                    </td>-->
                <?
//                }
                ?>
                <?
//                $etapas = array("IAPIN","IAAGR","IACCR","IAETA","IMAGR","IMCAG","IMETA","IMCPD","EERDC","EERCN","EEETD","EEFFL","TTRPL","TTDES","TTCOL");
//                if (in_array($status->getCaIdetapa(), $etapas)) {
                ?>
<!--                    <td width="170">
                        <div style="float:right"><a href="https://www.micentroempresarial.com/clientescoltrans" target="_blank"><img src="https://www.colsys.com.co/images/publicidad/Inv_Decreto_Aduanero.jpg" width="500"/></a></div>
                    </td>-->
                <?
//                }/* else if ( $user->getSucursal()->getEmpresa()->getCaNombre() == "Coltrans S.A.S." && $reporte->getCaTransporte() == Constantes::AEREO && ($status->getCaIdetapa() == "IACCR" || $status->getCaIdetapa() == "IACAD")) {
                ?>
<!--                    <td width="170">
                        <div style="float:right"><img src="https://www.colsys.com.co/images/publicidad/amb-bog20140814.jpg"/></div>
                    </td>-->
                <?
//                }
                ?>
        </table><br /><br />
        
        <table style="border:aliceblue; border-collapse: collapse;" width="100%" cellspacing="0" border="1" class="tableList">
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="13%"><b>Orden:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getCaOrdenClie() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>T&eacute;rmino de Negociaci&oacute;n:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">
                    <?
                    /*$array = explode("|", $reporte->getCaIncoterms());
                    $array = array_unique($array);
                    $incoterms = implode(" ", $array);
                    echo $incoterms;*/
                    echo $reporte->getIncotermsStr();
                    ?>
                </td>
                <?
                //Ticket # 938
                ?>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Cotizaci&oacute;n:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getCaIdcotizacion() ? $reporte->getCaIdcotizacion() : "&nbsp;" ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Proveedor:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="3"><?= $reporte->getProveedoresStr(false, "<br>") ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="20%"><b><?= $reporte->getOrdenesStr() ? "Orden Proveedor" : "&nbsp;" ?></b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"width="22%"><?= $reporte->getOrdenesStr() ? $reporte->getOrdenesStr() : "&nbsp;" ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Origen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="13%"><?= $reporte->getOrigen()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="15%"><b>Fch.Salida:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="17%"><?= $status->getCaFchsalida() ? $status->getCaFchsalida() . " " . $status->getCaHorasalida() : "&nbsp;" ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b><?= ($reporte->getCaTransporte() == Constantes::MARITIMO || $reporte->getCaTransporte() == Constantes::TERRESTRE) ? "Motonave:" : "Vuelo:" ?></b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $status->getCaIdnave() ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Destino:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getDestino()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b><?= $etapa->getCaDepartamento() == "Tráficos" ? "Fch. Estimada de Llegada:" : "Fch. Estimada de Llegada:" //ticket #4032 ?></b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $status->getCaFchllegada() ? $status->getCaFchllegada() : "&nbsp;" ?>
                    <? if ($reporte->getCaTransporte() == Constantes::AEREO && $status->getCaFchllegada()) { ?>
                        en la <?= $status->getProperty("jornada") ? $status->getProperty("jornada") : "&nbsp;" ?>
                    <? } ?>
                </td>
                <?
                    if($status->getCaIdetapa()=="IACAD" || $status->getCaIdetapa()=="IACCR"){?>
                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Aerol&iacute;nea - Bodega</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getIdsProveedor()->getIds()->getCaNombre()?> - <?=$status->getProperty("bodega_air")?></td>
                    <?}else{?>
                        <td colspan="2">&nbsp;</td>
                    <?                
                    }
                    ?>
            </tr>
            <?
            if ($reporte->getCaContinuacion() != "N/A" && $reporte->getCaImpoexpo() != Constantes::EXPO) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Destino:</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getCaContinuacion() . " -> " . $reporte->getDestinoCont() ?>	</td>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b><?= $etapa->getCaDepartamento() == "Tráficos" ? "Fch. Estimada de Llegada:" : "Fch.Llegada:" ?></b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="3"><?= $status->getCaFchcontinuacion() ? $status->getCaFchcontinuacion() : "&nbsp;" ?></td>
                </tr>
                <?
            }
            ?>	
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>No.Piezas:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $status->getCaPiezas() ? str_replace("|", " ", $status->getCaPiezas()) : "&nbsp;" ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Peso:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $status->getCaPeso() ? str_replace("|", " ", $status->getCaPeso()) : "&nbsp;" ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Volumen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $status->getCaVolumen() ? str_replace("|", " ", $status->getCaVolumen()) : "&nbsp;" ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b><?= ($reporte->getCaTransporte() == Constantes::MARITIMO || $reporte->getCaTransporte() == Constantes::TERRESTRE) ? "HBL:" : "HAWB:" ?></b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $status->getCaDoctransporte() ? $status->getCaDoctransporte() : "&nbsp;" ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getCaModalidad() == "FCL" && $status->getCaDocmaster() ? "<b>Master:</b>" : "&nbsp;" ?></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" ><?= $reporte->getCaModalidad() == "FCL" && $status->getCaDocmaster() ? $status->getCaDocmaster() : "&nbsp;" ?></td>
                <? if ($reporte->getCaTransporte() == Constantes::AEREO && $status->getProperty("manifiesto")){?>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Manifiesto</td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" ><?= $status->getProperty("manifiesto") ? $status->getProperty("manifiesto") : "&nbsp;" ?>&nbsp;<?= $status->getProperty("fchmanifiesto") ? $status->getProperty("fchmanifiesto") : "&nbsp;" ?></td>
                <? }else{?>
                <td></td><td></td>
                <?}?>
            </tr>
            <?
            if ($reporte->getCaTransporte() == Constantes::AEREO && ($reporte->getCaImpoexpo() == Constantes::IMPO || $reporte->getCaImpoexpo() == Constantes::TRIANGULACION)) {
                //Ticket # 1921
                $bodega2 = Doctrine::getTable("Bodega")->find($reporte->getCaIdbodega());
                if (!$bodega2)
                    $bodega2 = new Bodega();
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Trasladar a:</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?
                        if ($reporte->getProperty("entrega_lugar_arribo") == "true" || $reporte->getProperty("entrega_lugar_arribo") == "1") {
                            echo " Entrega en Lugar de Arribo / ";
                        }
                        echo $bodega2->getCaTipo() != $bodega2->getCaNombre() ? $bodega2->getCaTipo() . " " . $bodega2->getCaNombre() : $bodega2->getCaTipo()?>
                    </td>
                </tr>
                <?
            }
            ?>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Mercanc&iacute;a</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $reporte->getCaMercanciaDesc() ?> <?= ($reporte->getCaMciaPeligrosa()) ? "<br><b>Mercanc&iacute;a Peligrosa</b>" : "" ?></td>
            </tr>
            <?
            
            if($status->getProperty("muelle")!=""){
                $depositos = Doctrine::getTable("InoDianDepositos")->find($status->getProperty("muelle"));
                $muelle = $depositos->getCaNombre();
            }
            
                       
            
            if ($house) {
                $master = $house->getInoMaster();
                if($master->getCaReferencia() != null){
                    $fchfinmuisca = $master->getInoMasterSea()->getCaFchfinmuisca();
                    $fchfinvaciado = $master->getInoMasterSea()->getCaFchvaciado();
                    if ($master->getInoMasterSea()->getCaIdmuelle() != "")
                        $muelle = $master->getInoMasterSea()->getCaIdmuelle() . "-" . $master->getInoMasterSea()->getInoDianDepositos()->getCaNombre();
                    else
                        $muelle = $status->getProperty("muelle")?$status->getProperty("muelle"):"";

                    ?>
                    <tr>
                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Referencia</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getCaReferencia() ?></td>

                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fecha Finalizaci&oacute;n MUISCA</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $fchfinmuisca ?></td>

                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fecha Finalizaci&oacute;n Vaciado</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $fchfinvaciado ?></td>        
                    </tr>
                    <?
                }
            }
            if ($muelle != "") {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Muelle</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $muelle ?></td>        
                </tr>
                <?
            }
            
            if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                $repexpo = $reporte->getRepexpo();
                if ($repexpo->getCaInspeccionFisica() !== null) {
                    ?>
                    <tr>
                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Inspección Fisica</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $repexpo->getCaInspeccionFisica() ? "Sí" : "No" ?></td>
                    </tr>
                    <?
                }
                if (($reporte->getCaTransporte() == Constantes::MARITIMO || $reporte->getCaTransporte() == Constantes::TERRESTRE) && $status->getCaIdetapa() == "EEETD") {
                    ?>
                    <tr>
                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Emisi&oacute;n BLs:</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $repexpo->getCaEmisionbl() ?></td>
                    </tr>
                    <?
                }

                if (($reporte->getCaTransporte() == Constantes::MARITIMO || $reporte->getCaTransporte() == Constantes::TERRESTRE) && $status->getCaIdetapa() == "EEETD") {
                    ?>
                    <tr>
                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>DATOS EN DESTINO PARA RECLAMAR BLs:</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= nl2br($repexpo->getCaDatosbl()) ?></td>
                    </tr>
                    <?
                }
            }
            $bodega = $status->getBodega();
            if ($bodega) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Bodega</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $bodega->getCaNombre() ?></td>
                </tr>
                <?
            }

            if ($reporte->getCaSeguro() == "Sí") {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><strong>Carga Asegurada:</strong></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= Utils::replace($reporte->getCaSeguro()) ?></td>	
                </tr>
                <?
            }

            if ($reporte->getCaColmas() == "Sí" && $reporte->getCaImpoexpo() != Constantes::EXPO) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><strong>Nacionalización Colmas Ltda:</strong></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= Utils::replace($reporte->getCaColmas()) ?></td>
                </tr> 
                <?
            }

            if ($reporte->getCaModalidad() == "FCL") {
                if ($house) {                    
                    $houseSea = $house->getInoHouseSea();
                    $datosHouSea = json_decode(utf8_encode($houseSea->getCaDatos()),1);                    
                    $equipos = $datosHouSea["equipos"];
                    
                    if (count($equipos)>0){
                        ?>
                        <tr>
                            <td colspan="6">
                                <table width="100%" cellspacing="0" border="1" class="tableList">
                                    <tr>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5">Relación de Contenedores</th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Concepto</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Num. Contenedor</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Sello</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Kilos</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Piezas</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Fechas de Entrega</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Patio Entrega</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Observaciones</th>
                                    </tr>
                                    <?
                                    foreach ($equipos as $key => $equipo) {
                                        $inoequipo = Doctrine::getTable("InoEquipo")->find($equipo["idequipo"]);
                                        if($inoequipo){
                                            $datosEquipo = $inoequipo->getCaDatos()?json_decode(utf8_encode($inoequipo->getCaDatos()),1):null;
                                            ?>
                                            <tr>
                                                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo["concepto"] ?></td>
                                                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo["serial"] ?></td>
                                                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo["numprecinto"]?></td>
                                                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo["kilos"]?></td>
                                                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo["piezas"]?></td>
                                                    <?  if ($datosEquipo) { ?>
                                                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Entrega Comodato:</b><?= $datosEquipo["fecha_entrega"] ?><br/><b>Días Libres:</b><?= $datosEquipo["dias_libres"] ?><br/><b>L&iacute;m. Devoluci&oacute;n:</b><?= $datosEquipo["limite_devolucion"] ?><br/></td>
                                                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $datosEquipo["patio"] ?></td>
                                                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $datosEquipo["observaciones"] ?></td>
                                                    <?  } else {
                                                        ?>
                                                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                                        <?                                                 
                                                        }
                                                    ?>
                                            </tr>
                                            <?
                                        }
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <?
                    }
                } else {
                    $equipos = $reporte->getRepEquipos();
                    if (count($equipos) > 0) {
                        ?>
                        <tr>
                            <td colspan="6">
                                <table width="100%" cellspacing="0" border="1" class="tableList">
                                    <tr>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="4">Relación de Contenedores</th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Concepto</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Cantidad</th>
                                        <?
                                        if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                                            ?>
                                            <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Serial</th>
                                            <?
                                        } else if ($reporte->getCaImpoexpo() == Constantes::IMPO) {
                                            ?>
                                            <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">No.Contenedor</th>
                                            <?
                                        }
                                        ?>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Observaciones</th>
                                    </tr>
                                    <?
                                    foreach ($equipos as $equipo) {
                                        ?>
                                        <tr>
                                            <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getConcepto()->getCaConcepto() ?></td>
                                            <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getCaCantidad() ?></td>
                                            <?
                                            if ($reporte->getCaImpoexpo() == Constantes::EXPO or $reporte->getCaImpoexpo() == Constantes::IMPO) {
                                                ?>
                                                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getCaIdequipo() ?></td>
                                                <?
                                            }
                                            ?>
                                            <td><?= $equipo->getCaObservaciones() ? $equipo->getCaObservaciones() : "&nbsp;" ?></td>
                                        </tr>
                                        <?
                                    }   
                                    ?>
                                </table></td>
                        </tr>
                        <?
                    }
                }
//                if($status->getCaIdetapa() == "IMCNT" && $master->getCaIdlinea() == 4){ // Si la naviera es CMA CGM COLOMBIA S.A.S Ticket # 72411
                    ?>
                    <!--<tr><td colspan="6"><a href="https://www.colsys.com.co/images/uploads/Circular_cierre_patio_sprc.pdf" target="_blank"><b>Mensaje importante: CIERRE PATIO EN EL TERMINAL SPRC</b></a></td></tr>-->
                    <?
//                }
            }
            if(in_array($status->getCaIdetapa(), $status->getEtapasEvaluacion())){
                ?>
                <tr>
                    <td colspan="6">
                        <div align="center" style="margin-left: 30%; width: 30%; margin-right: 10%;">
                            <table width="100%"><tr><td>
                            <p align="justify">

                                <img src="/images/32x32/evaluacion.png" />

                            </p>
                            </td><td>
                            <p align="left" style="font-size: 16px;">                                                       
                                <a href="https://www.colsys.com.co/formulario/indexExt5/id/MjE=/co/MjYyNjM=/tipo/2/cl/<?= base64_encode($cliente->getCaIdcliente())?>/idstatus/<?= base64_encode($status->getCaIdstatus())?>" target="_blank"><b>Es un buen momento para evaluar nuestro servicio !</b></a>
                            </p>
                            </td></tr></table>
                        </div>
                    </td>
                </tr>
                <?
            }
            $statusList = $reporte->getRepStatus();
            if (count($statusList) > 0) {
                ?>
                <tr>
                    <td style="padding: 2px; font-size: 13px;font-family: Arial,Helvetica,sans-serif;" colspan="6">
                        <?include_component("traficos", "listaStatus", array("reporte" => $reporte, "endDate" => $status->getCaFchenvio()));?>
                    </td>
                </tr>
                <?
            }
            ?>
        </table>
        <br />
        <?
        if($modo!="otm"){
            ?>
            <div align="center" class="bigbutton" style="margin-left: 30%; width: 30%; margin-right: 10%;">Para obtener más información de sus cargas, no olvide visitar nuestro tracking <a href="https://www.colsys.com.co/tracking" target="_blank">https://www.colsys.com.co/tracking</a></div>
            <?
        }
        ?>
        <br />
        <?
        /*if ($reporte->getCaTransporte() == Constantes::AEREO && ($status->getCaIdetapa() == "IACAD" || $status->getCaIdetapa() == "IACCR" || $status->getCaIdetapa() == "IACEM" || $status->getCaIdetapa() == "IACDE" || $status->getCaIdetapa() == "IACIM" || $status->getCaIdetapa() == "IACMV" || $status->getCaIdetapa() == "IACTD" ))
            echo $textos['mensajeAereo'] . "<br />";*/

        if ($status->getCaIdetapa() == "IMCCR")
            echo $textos['mensajeReservaMaritimo'] . "<br />";

        if ($status->getCaIdetapa() == "IMETA")
            echo $textos['mensajeEmbarqueMaritimo'];
        
        if ($reporte->getCaContinuacion() == "OTM")
            echo $textos['mensajeEmbarqueOTM'] . "<br />";

//Ticket # 1853
        if ($reporte->getCaTransporte() == Constantes::AEREO && ($status->getCaIdetapa() == "IACCR" || $status->getCaIdetapa() == "IACAD" || $status->getCaIdetapa() == "IACDE"))
            echo "La fecha de llegada de la mercancía es un estimado ya que puede variar por decisión de la aerolínea.<br/>"; 
//Ticket # 14000
        if($status->getProperty("muelle") && ($status->getCaIdetapa() == "IMETA" || $status->getCaIdetapa() == "IMETT")){
            echo "<br />Por favor tener en cuenta que el muelle informado en esta notificación es el informado por la naviera en su programación de itinerarios, sin embargo este muelle podría ser cambiado por la naviera en cualquier momento sin previa notificación por la naviera debido a cambios en su operación y / o negociaciones con los puertos.<br />";
        }
        echo $status->getCaComentarios() ? "<strong>NOTA</strong><br />" . Utils::replace($status->getCaComentarios()) : "";

        if ($status->getCaIdetapa() == "EEETD")
            echo "Sr. Exportador, por favor pìdale a su cliente importador, que verifique que el peso y cantidad de piezas que se indican en el documento de transporte sean los mismos que usted envia. De no recibir ningùn comentario 24 horas despuès de retirada la carga, se entenderà por recibida a conformidad  por parte del importador.<br/>";

        if ($status->getCaIdetapa() == "IMCPD")
            echo "IMPORTANTE: Favor tener en cuenta la entrada en vigencia de la Resolución No. 7408,  Declaracion  Anticipada. En caso de requerir certificación de fletes en forma anticipada informarnos por escrito y con el mayor gusto la suministraremos.<br />";
        ?>
        <br />
        Cualquier información adicional que ustedes requieran, con gusto le será suministrada.<br /><br />
        Cordial Saludo.<br /><br /><br />
        <?
        if ($firmaotm == true) {
            echo $user->getFirmaOtmHTML($company);
        } else
            echo $user->getFirmaHTML();
        ?>
    </div>
</div>
