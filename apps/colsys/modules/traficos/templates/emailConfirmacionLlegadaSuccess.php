<?
$user = $sf_data->getRaw("user");
$status = $sf_data->getRaw("status");
$reporte = $sf_data->getRaw("reporte");
$etapa = $sf_data->getRaw("etapa");
$firmaotm = $sf_data->getRaw("firmaotm");

$inoCliente = $reporte->getInoClientesSea();
$inoMaestra = $inoCliente->getInoMaestraSea();
$cliente = $inoCliente->getCliente();
?>
<div class="htmlContent">
    <table style="border-radius: 4px;" width="100%" cellspacing="1"  class="tableList">
        <tr><td style="padding: 2px; font-size: 13px;font-family: Arial,Helvetica,sans-serif;">
                Señores:<br />
                <b><?= strtoupper($cliente->getCaCompania()) ?></b>
                <br /><br />
                <?= Utils::replace($status->getCaIntroduccion()); ?>
            </td>                       
            <?
//            if ($user->getSucursal()->getEmpresa()->getCaNombre() == "Coltrans S.A.S.") {
//                ?>
<!--                <td width="300">
                    <div style="float:right"><a href="https://www.coltrans.com.co/logosoficiales/coltrans/fitac2_2018.jpg" target="_blank"><img src="https://www.coltrans.com.co/logosoficiales/coltrans/fitac2_2018.jpg" width="300" /></a></div>
                </td>-->
                //<?
//            }
//            $etapas = array("IAPIN","IAAGR","IACCR","IAETA","IMAGR","IMCAG","IMETA","IMCPD","EERDC","EERCN","EEETD","EEFFL","TTRPL","TTDES","TTCOL");
//            if (in_array($status->getCaIdetapa(), $etapas)) {
//                ?>
<!--                <td width="170">
                    <div style="float:right"><a href="https://www.micentroempresarial.com/clientescoltrans" target="_blank"><img src="https://www.colsys.com.co/images/publicidad/Inv_Decreto_Aduanero.jpg" width="500"/></a></div>
                </td>-->
                <?
//            }
//            ?>
        </tr>
    </table><br /><br />

    <table style="border:aliceblue; border-collapse: collapse;" width="100%" cellspacing="1" border="1" class="tableList">
        <?
        if ($status->getCaIdetapa() == "IMCPD") { //confirmación de llegada
            if ($inoCliente->getCaNumorden()) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="23%"><b>Orden:</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $inoCliente->getCaNumorden() ?></td>
                </tr>
                <?
            }
            ?>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Proveedor:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="3"><?= $inoCliente->getCaProveedor() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Referencia</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaReferencia() ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Origen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="4%"><?= $inoMaestra->getOrigen()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="23%"><b>Fch.Salida:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="14%"><?= $inoMaestra->getCaFchembarque() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="28%"><b>Nombre del Buque:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="5%"><?= $inoMaestra->getCaMnllegada() ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Destino:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getDestino()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fch.Llegada:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaFchconfirmacion() ?><br /><b>Hora: </b><?= $inoMaestra->getCaHoraconfirmacion() ?></td>
                <?
                if ($inoMaestra->getCaFchdesconsolidacion()) {
                    ?>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Desconsolidación:</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaFchdesconsolidacion() ?></td>
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
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= Utils::formatNumber($inoCliente->getCaNumpiezas()) ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Volumen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= Utils::formatNumber($inoCliente->getCaVolumen()) ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Peso:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= Utils::formatNumber($inoCliente->getCaPeso()) ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>No. HBL:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="10%"><?= $inoCliente->getCaHbls() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Reg. Aduanero:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaRegistroadu() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fch.Registro:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaFchregistroadu() ?></td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Reg. Capitania:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaRegistrocap() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Bandera:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaBandera() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Muelle</td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getCaMuelle() . "-" . $inoMaestra->getInoDianDepositos()->getCaNombre() ?></td>
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

            if ($inoMaestra->getCaModalidad() == "FCL") {
                $equipos = $inoMaestra->getInoEquiposSea();
                if (count($equipos) > 0) {
                    ?>
                    <tr>
                        <td colspan="6">
                            <table width="100%" cellspacing="1" border="1" class="tableList">
                                <tr>
                                    <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="4">Relación de Contenedores</th>
                                </tr>
                                <tr>
                                    <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Concepto</th>
                                    <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Cantidad</th>
                                    <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">ID Equipo</th>
                                    <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">Observaciones</th>
                                </tr>
                                <?
                                foreach ($equipos as $equipo) {
                                    ?>
                                    <tr>
                                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getConcepto()->getCaConcepto() ?></td>
                                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getCaCantidad() ?></td>
                                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getCaIdequipo() ?></td>
                                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $equipo->getCaObservaciones() ? $equipo->getCaObservaciones() : "&nbsp;" ?></td>
                                    </tr>
                                    <?
                                }
                                ?>
                            </table></td>
                    </tr>
                    <?
                }
            }
        } else {
            if ($inoCliente->getCaNumorden()) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Orden :</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $inoCliente->getCaNumorden() ?>		</td>
                </tr>
                <?
            }
            ?>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Proveedor :</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $inoCliente->getCaProveedor() ?>		</td>
            </tr>
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Origen:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getOrigen()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Destino:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getDestino()->getCaCiudad() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fch.Salida:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoMaestra->getcaFchembarque() ?></td>
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
        <?= $inoCliente->getCaMensaje() ?><br />
        <?= $inoMaestra->getCaMensaje() ?>
        <? 
        $cartaStd = $reporte->getCliente()->cartaGarantiaStd();
        if ($inoMaestra->getCaModalidad() == "FCL" and ($reporte->getIdsProveedor()->getCaContratoComodato() or $cartaStd['ca_stdcarta_gtia'] == 'Vigente' )) {
            ?>
            <div style="color:blue;"><b>NOTA DE INSPECCION: <br/>
                    Señor importador, favor una vez se realice la entrega fisica de la unidad REQUERIMOS nos envien INMEDIATAMENTE este documento para poderle dar cierre a su Contrato de Comodato.</b>
            </div>
            <br />
            <?
        }
        if (substr($inoMaestra->getcaReferencia(), 0, 1) == "4") {
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
        <?
        if ($status->getCaIdetapa() == "IMCPD") {
            ?>
            <li>Detallamos que es necesario cumplir con los requisitos de liberación y tiempos dados por las Navieras y Operadores de Contenedores.</li>
            <li>Favor tener en cuenta la entrada en vigencia del Decreto 1165 art. 189 y el Decreto 360 que regula la Declaración Anticipada. En caso de requerir certificación de fletes en forma anticipada informarnos por escrito y con el mayor gusto la suministraremos. </li>
            <?
        }
        ?>
            <li>Le recordamos que el tiempo de permanencia de mercancía en los depósitos es de un (1) mes, contados desde la fecha de llegada de la mercancía, y pueden solicitar una posible prorroga por un (1) mes adicional. Acorde al Decreto 1165 art. 171</li>
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
