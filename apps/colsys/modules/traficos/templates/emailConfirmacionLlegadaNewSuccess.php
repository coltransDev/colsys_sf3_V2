<?
$user = $sf_data->getRaw("user");
$status = $sf_data->getRaw("status");
$reporte = $sf_data->getRaw("reporte");
$etapa = $sf_data->getRaw("etapa");
$firmaotm = $sf_data->getRaw("firmaotm");

$house = $reporte->getInoHouse()->getFirst();
$master = $house->getInoMaster();
$cliente = $house->getCliente();
$datosMaster = $master->getDatosMasterSea();
$muelle = ParametroTable::retrieveByCaso("CU268", null, null,$master->getInoMasterSea()->getCaIdmuelle())->getFirst();

?>
<div class="htmlContent">
    <table style="border-radius: 4px;" width="100%" cellspacing="1"  class="tableList">
        <tr><td style="padding: 2px; font-size: 13px;font-family: Arial,Helvetica,sans-serif;">
                Señores:<br />
                <b><?= strtoupper($cliente->getCaCompania()) ?></b>
                <br /><br />
                <?= Utils::replace($status->getCaIntroduccion()); ?>
            </td>
        </tr>
    </table><br /><br />

    <table style="border:aliceblue; border-collapse: collapse;" width="100%" cellspacing="1" border="1" class="tableList">
        <?
        if ($status->getCaIdetapa() == "IMCPD") { //confirmación de llegada
            if ($house->getCaNumorden()) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="23%"><b>Orden:</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $house->getCaNumorden() ?></td>
                </tr>
                <?
            }
            ?>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Proveedor:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="3"><?= $house->getCaTercero() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Referencia</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getCaReferencia() ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Origen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="4%"><?= $master->getOrigen()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="23%"><b>Fch.Salida:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="14%"><?= $master->getCaFchsalida() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="28%"><b>Nombre del Buque:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="5%"><?= $datosMaster["mnllegada"] ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Destino:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getDestino()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fch.Llegada:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getInoMasterSea()->getCaFchconfirmacion() ?><br /><b>Hora: </b><?= $master->getInoMasterSea()->getCaHoraconfirmacion() ?></td>
                <?
                if ($master->getInoMasterSea()->getCaFchdesconsolidacion()) {
                    ?>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Desconsolidación:</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getInoMasterSea()->getCaFchdesconsolidacion() ?></td>
                    <?
                } else {
                    ?>
                    <td width="3%" colspan="2">&nbsp;</td>
                    <?
                }
                ?>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>No.Piezas:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= Utils::formatNumber($house->getCaNumpiezas()) ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Volumen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= Utils::formatNumber($house->getCaVolumen()) ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Peso:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= Utils::formatNumber($house->getCaPeso()) ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>No. HBL:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="10%"><?= $house->getCaDoctransporte() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Reg. Aduanero:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $datosMaster["registroadu"] ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fch.Registro:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $datosMaster["fchregistroadu"] ?></td>
            </tr>
            <tr>                
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Bandera:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $datosMaster["bandera"]  ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Muelle</td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getInoMasterSea()->getCaIdmuelle() . " - " . $muelle->getCaValor(); ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Mercanc&iacute;a</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $reporte->getCaMercanciaDesc() ?><?= ($reporte->getCaMciaPeligrosa()) ? "<br><b>Mercacia Peligrosa</b>" : "" ?></td>
            </tr>
            <?
            if ($status->getCaStatus()) {
                ?>
                <tr>
                    <td style="padding: 2px; font-size: 13px;font-family: Arial,Helvetica,sans-serif;" colspan="6"><b>Informe:</b><br/><?= Utils::replace($status->getCaStatus()) ?></td>
                </tr>
                <?
            }

            if ($master->getCaModalidad() == "FCL") {
                if ($house) {
                    $houseSea = $house->getInoHouseSea();                    
                    $equipos = $houseSea->getDatosJson("equipos");
                    
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
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">No.Contenedor</th>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Observaciones</th>
                                    </tr>
                                    <?
                                    foreach ($equipos as $equipo) {
                                        ?>
                                        <tr>
                                            <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getConcepto()->getCaConcepto() ?></td>
                                            <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getCaCantidad() ?></td>
                                            <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getCaIdequipo() ?></td>                                            
                                            <td><?= $equipo->getCaObservaciones() ? $equipo->getCaObservaciones() : "&nbsp;" ?></td>
                                        </tr>
                                        <?
                                    }   
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <?
                    }
                }
            }
            $idetapa = $status->getCaIdetapa();
            if(in_array($idetapa, $status->getEtapasEvaluacion())){
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
                                <a href="https://www.colsys.com.co/formulario/indexExt5/id/MjE=/co/MjYyNjM=/tipo/2/cl/<?= base64_encode($cliente->getCaIdcliente())?>/idstatus/<?= base64_encode($status->getCaIdstatus())?>" target="_blank"><b>Es un buen momento para evaluar nuestro servicio!</b></a>
                            </p>
                            </td></tr></table>
                        </div>
                    </td>
                </tr>
                <?
            }
        } else {
            if ($house->getCaNumorden()) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Orden :</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $house->getCaNumorden() ?>		</td>
                </tr>
                <?
            }
            ?>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Proveedor :</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $house->getCaTercero() ?>		</td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Origen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getOrigen()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Destino:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getDestino()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fch.Salida:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $master->getcaFchllegada() ?></td>
            </tr>
            <?
            $c = new Criteria();
            $c->add(RepStatusPeer::CA_FCHENVIO, $status->getCaFchEnvio(), Criteria::LESS_EQUAL);
            $c->addDescendingOrderByColumn(RepStatusPeer::CA_FCHENVIO);
            $statusList = $reporte->getRepStatuss($c);
            if (count($statusList) > 0) {
                ?>
                <tr>
                    <td colspan="6"><table width="100%" cellspacing="1" border="1" class="tableList">
                            <tr>
                                <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="2">Status del Embarque</th>
                            </tr>
                            <tr>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="24%">Fecha</th>
                                <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="76%">Status</th>
                            </tr>				

                            <?
                            foreach ($statusList as $lstatus) {
                                ?>
                                <tr>
                                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $lstatus->getCaFchenvio() ?></td>
                                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= Utils::replace($lstatus->getStatus()) ?></td>
                                </tr>
                                <?
                            }
                            ?>
                        </table></td>
                </tr>
                <?
            }
        }
        ?>
    </table><br />
    
    <div style="padding:10px 40px; background:#F8F8F8;width:920px;border-radius:8px;">        
        <!--<?= $datosMaster["mensaje"] ?>-->
        <? 
        $cartaStd = $reporte->getCliente()->cartaGarantiaStd(null);
        if ($master->getCaModalidad() == "FCL" and ($reporte->getIdsProveedor()->getCaContratoComodato() or $cartaStd['ca_stdcarta_gtia'] == 'Vigente' )) {
            ?>
            <div style="color:blue;"><b>NOTA DE INSPECCION: <br/>
                    Señor importador, favor una vez se realice la entrega fisica de la unidad REQUERIMOS nos envien INMEDIATAMENTE este documento para poderle dar cierre a su Contrato de Comodato.</b>
            </div>
            <br />
            <?
        }
        if (substr($master->getcaReferencia(), 0, 1) == "4") {
            ?>
            <b>Informaci&oacute;n de Contenedores</b><br/>
            <ul>
                <li>El recibo de los contenedores en el interior del País esta sujeto a la disponibilidad de espacio en el respectivo patio de las Navieras.</li>
                <li>En caso de aceptación se debe cancelar un Drop Off , el cual fue previamente cotizado a Ustedes.</li>
                <li>Solicitamos a ustedes devolver los contenedores a la mayor brevedad posible, para evitar costos  adicionales por concepto de demoras en la devolución de las unidades.</li>
                <li>El tiempo libre para la devolución de los contenedores vacíos es estimado en 9 días calendario a partir de la fecha de arribo del buque para las unidades estándar. Y  los contenedores  especiales como refrigeradas tienen  3 días  siguientes a la llegada del buque, y sin excepcion la devolucion es en el  Puerto  (este tiempo esta sujeto a variaciones del mercado o condiciones específicas definidas en la oferta comercial).</li>
            </ul>
            <?
        }
        ?> 
        <br/>
        <b>Importante:</b><br />
        Estimado Cliente,
        <ul>
            <li>Le recordamos que el tiempo de permanencia de mercancìa en los depositos es de un (1) mes, contados desde la fecha de llegada de la mercancìa, y pueden solicitar una posible prorroga por un (1) mes adicional acorde al Decreto 2557 del 06 de Julio 2007 art. 10</li>
        <?
        if ($status->getCaIdetapa() == "IMCPD") {
            ?>
            <li>Favor tener en cuenta la entrada en vigencia de la Resolución No. 7408,  Declaracion  Anticipada. En caso de requerir certificación de fletes en forma anticipada informarnos por escrito y con el mayor gusto la suministraremos.</li>
            <?
        }
        ?>
        </ul>
    </div>
    
    Cualquier informaci&oacute;n adicional que ustedes requieran, con gusto le ser&aacute; suministrada..<br />
    Cordial Saludo.
    <br />
    <br />
    <?
    if ($firmaotm == true)
        echo $user->getFirmaOtmHTML($repotm->getCaLiberacion());
    else
        echo $user->getFirmaHTML();
    ?>
    <br/>
    <div style="font-size: 7px;font-family: Arial,Helvetica,sans-serif;">Realizado con plantilla <?=$plantilla?></div>
</div>
