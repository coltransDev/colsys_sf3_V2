<?
$user = $sf_data->getRaw("user");
$status = $sf_data->getRaw("status");
$etapa = $sf_data->getRaw("etapa");
$firmaotm = $sf_data->getRaw("firmaotm");
$company = $sf_data->getRaw("company");
?>

<div class="htmlContent">
    <?
    $reporte = $status->getReporte();
    $cliente = $reporte->getCliente();
    ?>
    <div align="center"><h3><?= ($etapa && $etapa->getCaTitle()) ? $etapa->getCaTitle() : "SEGUIMIENTO DE CARGA" ?></h3></div>
    <div align="left">
        <table width="100%" cellspacing="1"  class="tableList">
            <tr>
                <td style="padding: 2px; font-size: 13px;font-family: Arial,Helvetica,sans-serif;">
                    Se�ores:<br />
                    <b><?= strtoupper($cliente->getCaCompania()) ?></b>
                    <br /><br />
                    <?= $status->getCaIntroduccion() ?>
                </td>
                <?
                if (1 == 2 && $user->getSucursal()->getEmpresa()->getCaNombre() == "Coltrans S.A.S." && $reporte->getCaTransporte() == Constantes::MARITIMO && ($status->getCaIdetapa() == "IMETA" || $status->getCaIdetapa() == "IMCPD")) {
                ?>
                    <td width="320">
                        <div style="float:right"><img src="https://www.coltrans.com.co/images/publicidad/brasil12092012.jpg"/></div>
                    </td>
                <?
                } else if (1 == 2 && $user->getSucursal()->getEmpresa()->getCaNombre() == "Coltrans S.A.S." && $reporte->getCaTransporte() == Constantes::AEREO && ($status->getCaIdetapa() == "IACCR" || $status->getCaIdetapa() == "IACAD")) {
                ?>
                    <td width="320">
                        <div style="float:right"><img src="https://www.coltrans.com.co/images/publicidad/brasil12092012.jpg"/></div>
                    </td>
                <?
                }
                ?>
        </table><br /><br />
        
        <table style="border:aliceblue; border-collapse: collapse;" width="100%" cellspacing="0" border="1" class="tableList">
            <tr>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="13%"><b>Orden:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getCaOrdenClie() ?></td>
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>T&eacute;rmino de Negociaci&oacute;n:</b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;">
                    <?
                    $array = explode("|", $reporte->getCaIncoterms());
                    $array = array_unique($array);
                    $incoterms = implode(" ", $array);
                    echo $incoterms;
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
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="20%"><b><?= $reporte->getCaOrdenProv() ? "Orden Proveedor" : "&nbsp;" ?></b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"width="22%"><?= $reporte->getCaOrdenProv() ? str_replace("|", "<br>", $reporte->getCaOrdenProv()) : "&nbsp;" ?></td>
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
                <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b><?= $etapa->getCaDepartamento() == "Tr�ficos" ? "Fch. Estimada de Llegada:" : "Fch. Estimada de Llegada:" //ticket #4032 ?></b></td>
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="3"><?= $status->getCaFchllegada() ? $status->getCaFchllegada() : "&nbsp;" ?>
                    <? if ($reporte->getCaTransporte() == Constantes::AEREO && $status->getCaFchllegada()) { ?>
                        en la <?= $status->getProperty("jornada") ? $status->getProperty("jornada") : "&nbsp;" ?>
                    <? } ?>
                </td>
            </tr>
            <?
            if ($reporte->getCaContinuacion() != "N/A" && $reporte->getCaImpoexpo() != Constantes::EXPO) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Destino:</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $reporte->getCaContinuacion() . " -> " . $reporte->getDestinoCont() ?>	</td>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b><?= $etapa->getCaDepartamento() == "Tr�ficos" ? "Fch. Estimada de Llegada:" : "Fch.Llegada:" ?></b></td>
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
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="3"><?= $reporte->getCaModalidad() == "FCL" && $status->getCaDocmaster() ? $status->getCaDocmaster() : "&nbsp;" ?></td>
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
                <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $reporte->getCaMercanciaDesc() ?> <?= ($reporte->getCaMciaPeligrosa()) ? "<br><b>Mercacia Peligrosa</b>" : "" ?></td>
            </tr>
            <?
            $inoCliente = $reporte->getInoClientesSea();
            if ($inoCliente) {
                $fchfinmuisca = $inoCliente->getInoMaestraSea()->getCaFchfinmuisca();
                $fchfinvaciado = $inoCliente->getInoMaestraSea()->getCaFchvaciado();
                if ($inoCliente->getInoMaestraSea()->getCaMuelle() != "")
                    $muelle = $inoCliente->getInoMaestraSea()->getCaMuelle() . "-" . $inoCliente->getInoMaestraSea()->getInoDianDepositos()->getCaNombre();
                else
                    $muelle = "";
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Referencia</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $inoCliente->getCaReferencia() ?></td>

                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fecha Finalizaci&oacute;n MUISCA</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $fchfinmuisca ?></td>

                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Fecha Finalizaci&oacute;n Vaciado</b></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><?= $fchfinvaciado ?></td>        
                </tr>
                <?
                if ($muelle != "") {
                    ?>
                    <tr>
                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Muelle</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $muelle ?></td>        
                    </tr>
                    <?
                }
            }
            if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                $repexpo = $reporte->getRepexpo();
                if ($repexpo->getCaInspeccionFisica() !== null) {
                    ?>
                    <tr>
                        <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><b>Inspecci�n Fisica</b></td>
                        <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= $repexpo->getCaInspeccionFisica() ? "S�" : "No" ?></td>
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

            if ($reporte->getCaSeguro() == "S�") {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><strong>Carga Asegurada:</strong></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= Utils::replace($reporte->getCaSeguro()) ?></td>	
                </tr>
                <?
            }

            if ($reporte->getCaColmas() == "S�" && $reporte->getCaImpoexpo() != Constantes::EXPO) {
                ?>
                <tr>
                    <td style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"><strong>Nacionalizaci�n Colmas Ltda:</strong></td>
                    <td style="padding: 2px; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="5"><?= Utils::replace($reporte->getCaColmas()) ?></td>
                </tr> 
                <?
            }

            if ($reporte->getCaModalidad() == "FCL") {
                if ($inoCliente) {
                    $referencia = $inoCliente->getInoMaestraSea();
                    $equipos = $referencia->getInoEquiposSea();
                    ?>
                    <tr>
                        <td colspan="6">
                            <table width="100%" cellspacing="0" border="1" class="tableList">
                                <tr>
                                    <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="4">Relaci�n de Contenedores</th>
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
                            </table>
                        </td>
                    </tr>
                    <?
                } else {
                    $equipos = $reporte->getRepEquipos();
                    if (count($equipos) > 0) {
                        ?>
                        <tr>
                            <td colspan="6">
                                <table width="100%" cellspacing="0" border="1" class="tableList">
                                    <tr>
                                        <th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="4">Relaci�n de Contenedores</th>
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
        <br />
        <?
        if ($reporte->getCaTransporte() == Constantes::AEREO && ($status->getCaIdetapa() == "IACAD" || $status->getCaIdetapa() == "IACCR" || $status->getCaIdetapa() == "IACEM" || $status->getCaIdetapa() == "IACDE" || $status->getCaIdetapa() == "IACIM" || $status->getCaIdetapa() == "IACMV" || $status->getCaIdetapa() == "IACTD" ))
            echo $textos['mensajeAereo'] . "<br />";

        if ($status->getCaIdetapa() == "IMCCR")
            echo $textos['mensajeReservaMaritimo'] . "<br />";

        if ($status->getCaIdetapa() == "IMETA")
            echo $textos['mensajeEmbarqueMaritimo'];
        
        if ($reporte->getCaContinuacion() == "OTM")
            echo $textos['mensajeEmbarqueOTM'] . "<br />";

//Ticket # 1853
        if ($reporte->getCaTransporte() == Constantes::AEREO && ($status->getCaIdetapa() == "IACCR" || $status->getCaIdetapa() == "IACAD" || $status->getCaIdetapa() == "IACDE"))
            echo "La fecha de llegada de la mercanc�a es un estimado ya que puede variar por decisi�n de la aerol�nea.<br/>"; 
            
        echo $status->getCaComentarios() ? "<strong>NOTA</strong><br />" . Utils::replace($status->getCaComentarios()) : "";

        if ($status->getCaIdetapa() == "EEETD")
            echo "Sr. Exportador, por favor p�dale a su cliente importador, que verifique que el peso y cantidad de piezas que se indican en el documento de transporte sean los mismos que usted envia. De no recibir ning�n comentario 24 horas despu�s de retirada la carga, se entender� por recibida a conformidad  por parte del importador.<br/>";

        if ($status->getCaIdetapa() == "IMCPD")
            echo "IMPORTANTE: Favor tener en cuenta la entrada en vigencia de la Resoluci�n No. 7408,  Declaracion  Anticipada. En caso de requerir certificaci�n de fletes en forma anticipada informarnos por escrito y con el mayor gusto la suministraremos.<br />";
        ?>
        <br />
        Cualquier informaci�n adicional que ustedes requieran, con gusto le ser� suministrada.<br /><br />
        Cordial Saludo.<br /><br /><br />
        <?
        if ($firmaotm == true) {
            echo $user->getFirmaOtmHTML($company);
        } else
            echo $user->getFirmaHTML();
        ?>
    </div>
</div>