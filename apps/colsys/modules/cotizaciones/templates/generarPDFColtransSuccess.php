<?
$cotizacion = $sf_data->getRaw("cotizacion");
$notas = $sf_data->getRaw("notas");
$usuario = $cotizacion->getUsuario();
$contacto = $cotizacion->getContacto();
$cliente = $contacto->getCliente();
$empresa = Doctrine::getTable("Empresa")->find(2); // Localiza la empresa Coltrans

$sucursal =  Doctrine::getTable("Sucursal")
        ->createQuery("s")                
        ->where("ca_nombre = ? and ca_idempresa= 2" , $usuario->getSucursal()->getcaNombre() )
        ->fetchOne();
$comodato = false;

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

$pdf = new PDF ( );
$pdf->Open();
$pdf->setIdempresa(2);
$pdf->setColtransHeader(true);
$pdf->setColtransFooter(true);
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);

switch ($cotizacion->getCaFuente()) {
    case "Arial":
        $font = 'Arial';
        break;
    case "Calibri":
        $pdf->AddFont('Calibri', '', 'calibri.php');
        $pdf->AddFont('Calibri', 'B', 'calibrib.php');
        $font = 'Calibri';
        break;
    default:
        $pdf->AddFont('Tahoma', '', 'tahoma.php');
        $pdf->AddFont('Tahoma', 'B', 'tahomab.php');
        $font = 'Tahoma';
        break;
}

$pdf->SetFont($font, '', 10);
$directorioAg = array();
$imprimirNotas = array();
$sucursal = $usuario->getSucursal();
$pdf->SetSucursal($sucursal->getCaIdsucursal());

$txtSucursal=array();
$txtSucursal["datos"][]= $sucursal->getCaNombre();
$dir= explode("  ", $sucursal->getCaDireccion());

foreach($dir as $d)
    $txtSucursal["datos"][]=$d;
$txtSucursal["datos"][]="Pbx: ".$sucursal->getCaTelefono();//"Pxb : (57 - 1) 4239300";
$txtSucursal["datos"][]="Fax: ".$sucursal->getCaFax();//"Pxb : (57 - 1) 4239300";
$txtSucursal["datos"][] = "Cod. Postal: ". $sucursal->getCaCodpostal();
if($sucursal->getCaEmail()!="")
    $txtSucursal["datos"][]= $sucursal->getCaEmail();//"Email: bogota@coltrans.com.co";
$txtSucursal["datos"][]=$empresa->getCaUrl();// "www.coltrans.com.co";
$txtSucursal["datos"][]="NIT: ".$empresa->getCaId();// "800024075";
$txtSucursal["datos"][]="Cod. DIAN ".$empresa->getCaCoddian();

if($sucursal->getCaIso()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaIso();
if($sucursal->getCaBasc()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaBasc();
if($sucursal->getCaIata()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaIata();

$pdf->SetFooterSucursal($txtSucursal);

//$pdf->SetLineRepeat("Señores: ".strtoupper($cliente->getCaCompania()."    ".$cotizacion->getCaFchcreado()));
$pdf->Ln(5);
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($cotizacion->getCaFchcreado(), "%d-%d-%d %d:%d:%d");

$pdf->Cell(0, 4, str_replace(' D.C.', '', $sucursal->getCaNombre()) . ', ' . $dia . ' de ' . $meses[$mes - 1] . ' de ' . $anno, 0, 1);

$pdf->Ln(8);
$pdf->Cell(0, 4, $contacto->getCaSaludo(), 0, 1);
$pdf->SetFont($font, '', 10);

$pdf->Cell(0, 4, strtoupper($contacto->getNombre()), 0, 1);
$cargo = null;
if ($contacto->getCaCargo() != '' and $contacto->getCaDepartamento() != '') {
    $cargo = $contacto->getCaCargo() . " - " . $contacto->getCaDepartamento();
} else if ($contacto->getCaCargo() != '' and $contacto->getCaDepartamento() == '') {
    $cargo = $contacto->getCaCargo();
} else if ($contacto->getCaCargo() == '' and $contacto->getCaDepartamento() != '') {
    $cargo = $contacto->getCaDepartamento();
}
if ($cargo != '') {
    $pdf->SetFont($font, '', 10);
    $pdf->Cell(0, 4, $cargo, 0, 1);
}

$pdf->SetFont($font, 'B', 10);
$pdf->Cell(0, 4, strtoupper($cliente->getCaCompania()), 0, 1);
$pdf->SetFont($font, '', 10);
$pdf->Cell(0, 4, strtoupper($cliente->getCiudad()->getCaCiudad()), 0, 1);

if ($cotizacion->getCaUsuanulado()) {
    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont($font, 'B', 68);
    $pdf->Write(5, 'A N U L A D O ');
    $pdf->SetTextColor(0, 0, 0);
}
$pdf->SetFont($font, '', 10);
$pdf->Ln(8);
$pdf->Cell(0, 4, 'Asunto : ' . $cotizacion->getCaAsunto() . " " . $cotizacion->getCaConsecutivo() . " (V-" . $cotizacion->getCaVersion() . ")", 0, 1);
//    $pdf->Cell(0, 0, 'Comunicación No. '.$rs->Value('ca_idcotizacion').'/'.$rs->Value('ca_usuario').str_pad(" ",7),0,0,'R');

$pdf->SetFont($font, '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 4, $cotizacion->getCaSaludo(), 0, 1);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, $cotizacion->getCaEntrada(), 0, 1);

$productos = $cotizacion->getCotProductos();

$transportes = array();
//Busca todos los medios de transporte
foreach ($productos as $producto) {
    if ($producto->getCaTransporte() == "OTM-DTA") {
        if (!in_array($producto->getCaProducto(), $transportes)) {
            $transportes[] = $producto->getCaProducto();
        }
    } else {
        if (!in_array($producto->getCaTransporte(), $transportes)) {
            $transportes[] = $producto->getCaTransporte();
        }

        if ($producto->getTransportador() && $producto->getTransportador()->getCaContratoComodato()) {
            $comodato = true;
        }
    }
}

for ($k = 0; $k < count($transportes); $k++):
    $transporte = $transportes[$k];
    $tabla = array();
    $t = 0;

    $pdf->beginGroup();

    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 9);

    if (strtoupper($transporte) == "OTM") {
        $pdf->Cell(0, 4, '   OTM – OPERACIÓN DE TRANSPORTE MULTIMODAL', 0, 1, 'L', 0);
    } else if (strtoupper($transporte) == "DTA")
        $pdf->Cell(0, 4, '   DTA – DECLARACIÓN DE TRÁNSITO ADUANERO', 0, 1, 'L', 0);
    else
        $pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL ' . strtoupper($transporte), 0, 1, 'L');
    $pdf->Ln(1);
    $age_imp = true;
    $pdf->SetFont($font, 'B', 9);

    foreach ($productos as $producto):
        if ($producto->getCaTransporte() == "OTM-DTA") {
            if ($producto->getCaProducto() != $transporte) {
                continue;
            }
            $imprimirNotas[] = "anexoImpo";
            $imprimirNotas[] = "OTM_" . $producto->getCaModalidad();
        } else {
            if ($producto->getCaTransporte() != $transporte) {
                continue;
            }
        }
        $imprimirObservaciones = false;
        $imprimirRecargos = false;
        if ($producto->getCaImpoexpo() == Constantes::IMPO) {
            $imprimirNotas[] = "anexoImpo";
        }
        if ($producto->getCaImpoexpo() == Constantes::EXPO) {
            $imprimirNotas[] = "anexoExpo";
        }
        // ======================== Impresión por Item ======================== //
        if ($producto->getCaImprimir() == "Por Item" || $producto->getCaTransporte() == "OTM-DTA"):

            if ($t++ != 0) {
                $pdf->Ln(4);
                $pdf->beginGroup();
            } else {
                $pdf->Ln(1);
            }
            $linea = $producto->getTransportador();
            $tabla = array();
            $pdf->SetFont($font, 'B', 8);
            $pdf->SetWidths(array(170));
            $pdf->SetAligns(array("L"));
            $pdf->SetStyles(array("B"));
            $pdf->Row(array("Producto : " . $producto->getCaProducto()));

            if (trim($producto->getCaIncoterms()) != "") {
                $titulos = array("Términos");
                $columna_uno = $producto->getCaIncoterms();
            } else {
                $titulos = array("Servicio");
                $columna_uno = "Transporte en " . $producto->getCaProducto();
            }
            array_push($titulos, "Origen");
            array_push($titulos, "Destino");

            // $titulos = array('Términos', 'Origen', 'Destino');
            if ($producto->getCaVigencia()) {
                array_push($titulos, "Valida Hasta");
            }
            $pdf->SetFont($font, 'B', 8);
            if (count($titulos) == 3) {
                $pdf->SetWidths(array(50, 60, 60));
            }
            if (count($titulos) == 4) {
                $pdf->SetWidths(array(50, 45, 45, 30));
            }
            $pdf->SetAligns(array_fill(0, 5, "C"));
            $pdf->SetStyles(array_fill(0, 5, "B"));
            $pdf->SetFills(array_fill(0, 5, 1));
            $pdf->Row($titulos);

            $pdf->SetStyles(array_fill(0, 5, ""));
            $pdf->SetFills(array_fill(0, 5, 0));
            $pdf->SetFont($font, '', 8);
            $row = array($columna_uno, $producto->getOrigen()->getCaCiudad() . " - " . $producto->getOrigen()->getCaTrafico(), $producto->getDestino()->getCaCiudad() . " - " . $producto->getDestino()->getCaTrafico());

            if ($producto->getCaVigencia()) {
                array_push($row, Utils::fechaMes($producto->getCaVigencia()));
            }

            $pdf->Row($row);
            if ($linea && $producto->getCaPostularlinea()) {
                $pdf->SetFont($font, '', 8);
                $pdf->SetWidths(array(170));
                $pdf->SetAligns(array_fill(0, 3, "L"));
                $pdf->Row(array(($producto->getCaTransporte() == Constantes::AEREO ? "Aérolinea: " : "Linea: ") . $linea->getIds()->getCaNombre()));
            }

            $opciones = $producto->getCotOpciones();
            foreach ($opciones as $opcion) {
                $textoRecargos = $opcion->getTextoRecargos();
                $concepto = $opcion->getConcepto();

                $tabla[$opcion->getCaIdopcion()]["flete"] = $concepto->getCaConcepto();
                $tabla[$opcion->getCaIdopcion()]["tarifas"] = $opcion->getTextoFlete() . " " . $opcion->getEquipo()->getCaConcepto() . "\n";
                if ($textoRecargos) {
                    $tabla[$opcion->getCaIdopcion()]["recargos"] = $textoRecargos;
                    $imprimirRecargos = true;
                }
                if ($opcion->getCaObservaciones()) {
                    $tabla[$opcion->getCaIdopcion()]["observaciones"] = $opcion->getCaObservaciones();
                    $imprimirObservaciones = true;
                }
            }
            //Imprime los detalles de la tabla (Opciones)
            if (count($tabla) > 0) {
                $pdf->Ln(2);
                $titulos = array('Concepto', 'Tarifas');

                if ($imprimirRecargos) {
                    array_push($titulos, ($producto->getCaIncoterms() == "FCA - Free Carrier" ? "Recargos en Origen" : "Recargos por Flete"));
                }
                if ($imprimirObservaciones) {
                    array_push($titulos, "Observaciones");
                }

                //Calcula el ancho de las columnas
                if ($imprimirRecargos && $imprimirObservaciones) {
                    $widths = array(30, 25, 70, 45); //en todos los casos debe sumar 170
                } elseif ($imprimirRecargos) {
                    $widths = array(40, 40, 90);
                } elseif ($imprimirObservaciones) {
                    $widths = array(30, 95, 45);
                } else {
                    //$widths = array(30, 140);
                    $widths = array(80, 90);
                }

                $pdf->SetWidths($widths);
                $pdf->SetAligns(array_fill(0, 4, "C"));
                $pdf->SetStyles(array_fill(0, 4, "B"));
                $pdf->SetFills(array_fill(0, 4, 1));
                //$pdf->Row($titulos);

                foreach ($tabla as $item) {
                    if ($imprimirRecargos && !isset($item["recargos"])) { //Evita que queden huecos en la impresion
                        $item["recargos"] = " ";
                    }
                    if ($imprimirObservaciones && !isset($item["observaciones"])) { //Evita que queden huecos en la impresion
                        $item["observaciones"] = " ";
                    }

                    $pdf->SetWidths($widths);
                    $pdf->SetAligns(array_fill(0, 4, "L"));
                    $pdf->SetStyles(array_fill(0, 4, ""));
                    $pdf->SetFills(array_fill(0, 4, 0));
                    $pdf->Row($item);
                }
            }
            $pdf->flushGroup();
            $pdf->Ln(2);
            $widths = array();
            $datos = array();
            $pos_mem = 0;
            
            $recargosGen = $producto->getRecargosGenerales();
            if (count($recargosGen) > 0) {
                $imprimirObservaciones = false;
                foreach ($recargosGen as $recargo) {
                    if ($recargo->getCaObservaciones()) {
                        $imprimirObservaciones = true;
                    }
                }

                if ($producto->getCaTransporte() == "OTM-DTA") {
                    $titulo = "COSTOS QUE SE PUEDEN GENERAR EN PUERTO POR LA OPERACION DE OTM";
                } else {
                    $titulo = "RECARGOS EN ORIGEN";
                }

                $pdf->beginGroup();
                $pdf->Ln(2);
                $pdf->SetFont($font, 'B', 8);
                $pdf->Cell(0, 4, $titulo, 0, 1, 'L', 0);
                $pdf->Ln(2);
                $pdf->SetFont($font, '', 7);

                
                $titu_mem = array('Concepto', 'Tarifa');
                if ($imprimirObservaciones) {
                    array_push($titu_mem, 'Observaciones');
                    $width_mem = array(50, 60, 60);
                } else {
                    $width_mem = array(80, 90);
                }

                $pdf->SetWidths($width_mem);
                $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
                $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
                $pdf->SetFills(array_fill(0, count($width_mem), 1));
                //$pdf->Row($titu_mem);

                $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
                $pdf->SetStyles(array_fill(0, count($width_mem), ""));
                $pdf->SetFills(array_fill(0, count($width_mem), 0));
                
                
                foreach ($recargosGen as $recargo) {
                    $equipo = ($recargo->getEquipo()) ? $recargo->getEquipo()->getCaConcepto() : "";
                    $row = array($recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa() . " " . $equipo);
                    if ($imprimirObservaciones) {
                        array_push($row, $recargo->getCaObservaciones());
                    }
                    $pdf->Row($row);
                }
                $pdf->Ln(2);
                $pdf->flushGroup();
            }

            //Imprime el tiempo de transito
            array_push($widths, 35);
            if (strlen($producto->getCaObservaciones()) <> 0) {
                array_push($widths, 135);

                $mfytt = "Modalidad: " . nl2br($producto->getCaModalidad()) . "\n";

                if (strlen($producto->getCaFrecuencia()) <> 0) {
                    $mfytt.= "Frecuencia: " . nl2br($producto->getCaFrecuencia()) . "\n";
                }
                if (strlen($producto->getCaTiempotransito()) <> 0) {
                    $mfytt.= "T.Transito: " . nl2br($producto->getCaTiempotransito()) . "\n";
                }
                $mfytt = substr($mfytt, 0, strlen($mfytt) - 2);

                array_push($datos, $mfytt);
                array_push($datos, "Observaciones: " . $producto->getCaObservaciones());
            } else {
                array_push($datos, "Modalidad: " . nl2br($producto->getCaModalidad()));
                $pos_mem+= 35;
                if (strlen($producto->getCaFrecuencia()) <> 0) {
                    array_push($widths, 35);
                    array_push($datos, "Frecuencia: " . nl2br($producto->getCaFrecuencia()));
                    $pos_mem+= 35;
                }
                if (strlen($producto->getCaTiempotransito()) <> 0) {
                    array_push($widths, 35);
                    array_push($datos, "T.Transito: " . nl2br($producto->getCaTiempotransito()));
                    $pos_mem+= 35;
                }
            }

            $pdf->SetFont($font, '', 8);
            $pdf->SetWidths($widths);
            $pdf->SetAligns(array_fill(0, 3, "L"));
            $pdf->Row($datos);

        endif;
    endforeach; //Impresión por item
    // ======================== Impresión por Puerto ======================== //

    $i = 0;
    $lin_rec = 0;
    $tabla = array();
    $origenes = array();
    $destinos = array();
    $observaciones = array();
    $recargosGenPuerto = array();
    foreach ($productos as $producto):
        if ($producto->getCaTransporte() != $transporte) {
            continue;
        }
        if (!isset($descripcion_producto)) {
            $descripcion_producto = $producto->getCaProducto();
        }
        if ($producto->getCaImprimir() == 'Puerto'):
            $origenes[] = $producto->getOrigen()->getCaCiudad();
            $destinos[] = $producto->getDestino()->getCaCiudad();

            $num_lin = 0;
            $opciones = $producto->getCotOpciones();
            foreach ($opciones as $opcion) {
                $num_mem = 0;
                if (isset($tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()])) {
                    $num_mem = count($tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()]);
                }
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()][$num_mem]["concepto"] = $opcion->getConcepto()->getCaConcepto();
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()][$num_mem]["fletes"] = $opcion->getTextoFlete();
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()][$num_mem]["recargos"] = trim($opcion->getTextoRecargos());
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()][$num_mem]["observaciones"] = $opcion->getCaObservaciones();
                $num_lin = substr_count($opcion->getTextoRecargos(), '»');
                $num_lin+= (strlen($opcion->getCaObservaciones())!=0)?1:0;
                $lin_rec = ($num_lin>$lin_rec)?$num_lin:$lin_rec;
            }

            $num_mem = 0;
            if (isset($tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()])) {
                $num_mem = count($tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()]);
            }
            $txt_mem = null;
            $det_mem = "Detalles\n";
            $rec_mem = "Recargos".str_repeat("\n", $lin_rec);
            $txt_ant = false;
            if (strlen($producto->getCaFrecuencia()) <> 0) {
                $txt_mem.= "Frecuencia: " . nl2br($producto->getCaFrecuencia());
                $txt_ant = true;
            }
            if (strlen($producto->getCaTiempotransito()) <> 0) {
                if ($txt_ant)
                    $txt_mem.= " - ";
                $txt_mem.= "T.Transito: " . nl2br($producto->getCaTiempotransito());
                $txt_ant = true;
            }
            if ($txt_ant)
                $det_mem.= "\n";
            if (trim($producto->getCaIncoterms()) != "") {
                if ($txt_ant) {
                    $txt_mem.= "\n";
                    $det_mem.= "\n";
                }
                $txt_mem.= "Término: " . nl2br($producto->getCaIncoterms());
                $txt_ant = true;
            }
            if ($producto->getCaVigencia()) {
                if ($txt_ant) {
                    $txt_mem.= "\n";
                    $det_mem.= "\n";
                }
                $txt_mem.= "Valida Hasta: " . Utils::fechaMes($producto->getCaVigencia());
                $txt_ant = true;
            }
            if ($txt_ant) {
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()][$num_mem]["vigencia"] = $txt_mem;
            }
            if ($producto->getCaObservaciones()) {
                $i++;
                $observaciones["Puerto"][$i] = $producto->getCaObservaciones();
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()][$num_mem]["vigencia"].= " (Nota $i)";
            }

            if ($producto->getCaObservaciones()) {
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()][$num_mem]["observaciones"] = $producto->getCaObservaciones();
            }
            $recgen = $producto->getRecargosGenerales();
            if ($recgen && count($recgen) > 0) {
                foreach ($recgen as $rec) {
                    $recargosGenPuerto[] = $rec;
                }
            }
        endif;
    endforeach;

    $origenes = array_unique($origenes);
    $destinos = array_unique($destinos);

    if (count($tabla) > 0) {
        if ($t++ != 0) {
            $pdf->Ln(4);
            $pdf->beginGroup();
        } else {
            $pdf->Ln(1);
        }
        $pdf->SetFont($font, '', 9);
        $pdf->Cell(0, 4, "Producto : " . $descripcion_producto, 0, 1, 'L');
        $pdf->Ln(1);

        $tit_org = null;
        foreach ($origenes as $origen) {
            if ($tit_org != $origen) {
                $pdf->SetFont($font, '', 7);
                $titulos = array_merge(array($origen), $destinos);
                $width = round(150 / count($destinos), 0);
                $widths = array_merge(array(20), array_fill(0, count($destinos), $width));

                $pdf->SetStyles(array_fill(0, count($destinos) + 1, "B"));
                $pdf->SetFills(array_fill(0, count($destinos) + 1, 1));
                $pdf->SetWidths($widths);
                $pdf->SetAligns(array_fill(0, count($destinos) + 1, "C"));
                $pdf->Row($titulos);
                $tit_org = $origen;
            }

            $max_row = 0;
            foreach ($destinos as $destino) {
                if (isset($tabla[$origen][$destino])) {
                    $max_row = (count($tabla[$origen][$destino]) > $max_row) ? count($tabla[$origen][$destino]) : $max_row;
                }
            }
            $max_row--;    // Descuenta el último item del arreglo ya que corresponde a observaciones

            $row_3 = array("" => "", "Detalles" => $det_mem);
            for ($i = 0; $i < $max_row; $i++) {
                $row_1 = array("","Tarifas\n\n");
                $row_2 = array("",$rec_mem);
                $widths = array(5, 15);
                $pdf->SetWidths($widths);

                foreach ($destinos as $destino) {
                    if (isset($tabla[$origen][$destino][$i])) {
                        $concepto = $tabla[$origen][$destino][$i];
                    } else {
                        $concepto = array("concepto" => null);
                    }

                    // Renglón No. 1
                    if (isset($concepto["concepto"])) {
                        $row_1 = array_merge($row_1, array($concepto["concepto"] . "\n" . $concepto["fletes"]));
                    } else {
                        $row_1 = array_merge($row_1, array(""));
                    }
                    // Renglón No. 2
                    $box_1 = "";
                    if (isset($concepto["recargos"])) {
                        $box_1.= $concepto["recargos"];
                    }
                    if (isset($concepto["observaciones"])) {
                        $box_1.= ((strlen(trim($box_1)) != 0) ? "\n" : "") . $concepto["observaciones"];
                    }
                    $row_2 = array_merge($row_2, array($box_1));
                    $widths = array_merge($widths, array($width));
                    if (isset($tabla[$origen][$destino][$max_row]["vigencia"])) {
                        $row_3[$destino] = $tabla[$origen][$destino][$max_row]["vigencia"];
                    } else {
                        $row_3[$destino] = "";
                    }
                }
                $pdf->SetWidths($widths);
                $pdf->SetStyles(array_merge(array("", ""), array_fill(0, count($destinos), "B")));
                $pdf->SetAligns(array_merge(array("L", "L"), array_fill(0, count($destinos), "C")));
                $pdf->SetFills(array_merge(array(0, 1), array_fill(0, count($destinos), "0")));
                $pdf->Row($row_1);
                $widths = array_merge(array(5, 15), array_fill(0, count($destinos), $width));
                $pdf->SetWidths($widths);
                $pdf->SetStyles(array_merge(array("", ""), array_fill(0, count($destinos), "")));
                $pdf->SetAligns(array_merge(array("L", "L"), array_fill(0, count($destinos), "L")));
                if (trim(implode($row_2)) != "Recargos") {
                    $pdf->Row($row_2);
                }
            }
            $pdf->Row($row_3);
            $pdf->Ln(2);
        }
        $pdf->flushGroup();

        if (count($observaciones["Puerto"]) != 0) {
            $pdf->beginGroup();
            $pdf->SetFont($font, '', 7);
            $titu_mem = array('Observaciones');
            $width_mem = array(170);

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);

            $width_mem = array(11, 159);

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
            $pdf->SetStyles(array_fill(0, count($width_mem), ""));
            $pdf->SetFills(array_fill(0, count($width_mem), 0));
            foreach ($observaciones["Puerto"] as $key => $observacion) {
                $row = array("Nota $key", $observacion);
                $pdf->Row($row);
            }
            $pdf->flushGroup();
        }

        if (count($recargosGenPuerto) > 0) {
            $imprimirObservaciones = false;
            foreach ($recargosGenPuerto as $recargo) {
                if ($recargo->getCaObservaciones()) {
                    $imprimirObservaciones = true;
                }
            }
            $pdf->beginGroup();
            $pdf->Ln(2);
            $pdf->SetFont($font, 'B', 8);
            $pdf->Cell(0, 4, 'RECARGOS EN ORIGEN ', 0, 1, 'L', 0);
            $pdf->Ln(2);
            $pdf->SetFont($font, '', 7);

            $titu_mem = array('Concepto', 'Tarifa');
            if ($imprimirObservaciones) {
                array_push($titu_mem, 'Observaciones');
                $width_mem = array(55, 53, 62);
            } else {
                $width_mem = array(80, 90);
            }

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);

            $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
            $pdf->SetStyles(array_fill(0, count($width_mem), ""));
            $pdf->SetFills(array_fill(0, count($width_mem), 0));

            foreach ($recargosGenPuerto as $recargo) {
                $row = array($recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa());
                if ($imprimirObservaciones) {
                    array_push($row, $recargo->getCaObservaciones());
                }
                $pdf->Row($row);
            }
            $pdf->Ln(2);
            $pdf->flushGroup();
        }
    }
    // ======================== Impresión por Concepto o Trayecto ======================== //
    $tablaConceptos = array();
    $tablaTrayectos = array();
    $conceptos1 = array();
    $trayectos1 = array();

    $conceptos2 = array();
    $trayectos2 = array();

    $recargosGenConcepto = array();
    $recargosGenTrayecto = array();

    $observaciones = array();
    foreach ($productos as $producto):
        if ($producto->getCaTransporte() != $transporte) {
            continue;
        }
        if (!isset($descripcion_producto)) {
            $descripcion_producto = $producto->getCaProducto();
        }
        if ($producto->getCaImprimir() == 'Concepto' or $producto->getCaImprimir() == 'Trayecto'):
            $opciones = $producto->getCotOpciones();
            $trayecto = $producto->getOrigen()->getCaCiudad() . "\n" . $producto->getDestino()->getCaCiudad();
            if (($producto->getCaImprimir() == 'Concepto' and $producto->getCaObservaciones()) or ($producto->getCaImprimir() == 'Trayecto' and ($producto->getCaObservaciones() or $producto->getCaIncoterms() or $producto->getCaFrecuencia() or $producto->getCaTiempotransito() or $producto->getCaVigencia()))) {
                $i = isset($observaciones[$producto->getCaImprimir()]) ? count($observaciones[$producto->getCaImprimir()]) + 1 : 1;
                $observaciones[$producto->getCaImprimir()][$i] = $producto->getCaObservaciones();
                $trayecto.= (($producto->getCaImprimir() == 'Concepto') ? "\n" : " ") . "(Nota $i)";
            }
            if ($producto->getCaImprimir() == 'Concepto') {
                $trayectos1[] = $trayecto;
                $recgen = $producto->getRecargosGenerales();
                if ($recgen && count($recgen) > 0) {
                    foreach ($recgen as $rec) {
                        $recargosGenConcepto[] = $rec;
                    }
                }
            } else {
                $recgen = $producto->getRecargosGenerales();
                if ($recgen && count($recgen) > 0) {
                    foreach ($recgen as $rec) {
                        $recargosGenTrayecto[] = $rec;
                    }
                }
                $trayectos2[] = $trayecto;
            }
            $add_det = "";
            foreach ($opciones as $opcion) {
                $concepto = $opcion->getConcepto();
                if ($producto->getCaImprimir() == 'Concepto') {
                    $conceptos1[] = $concepto->getCaIdconcepto();
                } else {
                    $conceptos2[] = $concepto->getCaIdconcepto();
                }
                $contenido = "";

                if ($producto->getCaImprimir() == 'Concepto') {
                    if (isset($tablaConceptos[$trayecto][$concepto->getCaConcepto()])) {
                        $tablaConceptos[$trayecto][$concepto->getCaIdconcepto()].= str_repeat("..-..", 12) . "\n";
                    } else {
                        $tablaConceptos[$trayecto][$concepto->getCaIdconcepto()] = "";
                    }
                } else {
                    if (isset($tablaTrayectos[$concepto->getCaConcepto()][$trayecto])) {
                        $tablaTrayectos[$concepto->getCaIdconcepto()][$trayecto].= str_repeat("..-..", 12) . "\n";
                    } else {
                        $tablaTrayectos[$concepto->getCaIdconcepto()][$trayecto] = "";
                    }
                }
                $contenido.="Flete: " . $opcion->getTextoFlete() . "\n";
                if ($opcion->getCaObservaciones()) {
                    $contenido.=$opcion->getCaObservaciones() . "\n";
                }

                $textoRecargos = $opcion->getTextoRecargos();
                $contenido.=$textoRecargos;
                if ($producto->getCaImprimir() == 'Concepto') {
                    $tablaConceptos[$trayecto][$concepto->getCaIdconcepto()] .= $contenido;

                    $tablaConceptos[$trayecto]["observaciones"] = "";
                    if ($producto->getCaIncoterms()) {
                        if ($tablaConceptos[$trayecto]["observaciones"] != "") {
                            $tablaConceptos[$trayecto]["observaciones"] .= "\n";
                        }
                        $tablaConceptos[$trayecto]["observaciones"] .= $producto->getCaIncoterms();
                    }

                    if ($producto->getCaFrecuencia()) {
                        if ($tablaConceptos[$trayecto]["observaciones"] != "") {
                            $tablaConceptos[$trayecto]["observaciones"] .= "\n";
                        }
                        $tablaConceptos[$trayecto]["observaciones"] .= "Frec.: " . $producto->getCaFrecuencia();
                    }

                    if ($producto->getCaTiempotransito()) {
                        if ($tablaConceptos[$trayecto]["observaciones"] != "") {
                            $tablaConceptos[$trayecto]["observaciones"] .= "\n";
                        }
                        $tablaConceptos[$trayecto]["observaciones"] .= "T.T.: " . $producto->getCaTiempotransito();
                    }

                    if ($producto->getCaVigencia()) {
                        if ($tablaConceptos[$trayecto]["observaciones"] != "") {
                            $tablaConceptos[$trayecto]["observaciones"] .= "\n";
                        }
                        $tablaConceptos[$trayecto]["observaciones"] .= "Valida Hasta: " . Utils::fechaMes($producto->getCaVigencia());
                    }
                } else {
                    $tablaTrayectos[$concepto->getCaIdconcepto()][$trayecto] .= $contenido;
                    if ($add_det == "") {
                        if ($producto->getCaIncoterms()) {
                            $add_det.= ((strlen($add_det) != 0) ? " " : "") . "Término :" . $producto->getCaIncoterms();
                        }
                        if ($producto->getCaFrecuencia()) {
                            $add_det.= ((strlen($add_det) != 0) ? " " : "") . "Frec.: " . $producto->getCaFrecuencia();
                        }
                        if ($producto->getCaTiempotransito()) {
                            $add_det.= ((strlen($add_det) != 0) ? " " : "") . "T.T.: " . $producto->getCaTiempotransito();
                        }
                        if ($producto->getCaVigencia()) {
                            $add_det.= ((strlen($add_det) != 0) ? " " : "") . "Valida Hasta: " . Utils::fechaMes($producto->getCaVigencia());
                        }
                        if (strlen($add_det) != 0) {
                            $observaciones[$producto->getCaImprimir()][$i] = $add_det . "\n" . trim($observaciones[$producto->getCaImprimir()][$i]);
                        }
                    }
                }
            }
        endif;
    endforeach;

    $conceptos1 = array_unique($conceptos1);
    $trayectos1 = array_unique($trayectos1);
    $conceptos2 = array_unique($conceptos2);
    $trayectos2 = array_unique($trayectos2);

    $pdf->SetFont($font, '', 7);
    if (count($tablaConceptos) > 0) {
        if ($t++ != 0) {
            $pdf->Ln(4);
            $pdf->beginGroup();
        } else {
            $pdf->Ln(1);
        }
        $conceptos = Doctrine::getTable("Concepto")
                ->createQuery("c")
                ->whereIn("c.ca_idconcepto", $conceptos1)
                ->addOrderBy("c.ca_liminferior")
                ->addOrderBy("c.ca_concepto")
                ->execute();

        $titulos = array("Trayecto");
        foreach ($conceptos as $concepto) {
            if (!in_array($concepto->getCaConcepto(), $titulos)) {
                array_push($titulos, $concepto->getCaConcepto());
            }
        }

        $titulos[] = "Detalles";
        $width = 150 / (count($titulos) - 1);
        $widths = array_merge(array(20), array_fill(0, count($titulos), $width));
        $widths[] = 27;
        $pdf->SetFont($font, '', 9);
        $pdf->Cell(0, 4, "Producto : " . $descripcion_producto, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->SetFont($font, '', 7);
        $pdf->SetStyles(array_fill(0, count($titulos) + 1, "B"));
        $pdf->SetFills(array_fill(0, count($titulos) + 1, 1));
        $pdf->SetWidths($widths);
        $pdf->SetAligns(array_fill(0, count($titulos) + 1, "C"));
        $pdf->Row($titulos);

        $pdf->SetStyles(array_merge(array("B"), array_fill(0, count($titulos), "")));
        $pdf->SetFills(array_merge(array_fill(0, count($titulos) + 1, 0)));
        $pdf->SetWidths($widths);
        $pdf->SetAligns(array_fill(0, count($titulos) + 1, "C"));
        foreach ($trayectos1 as $trayecto) {
            $row = array($trayecto);
            foreach ($conceptos as $concepto) {
                if (isset($tablaConceptos[$trayecto][$concepto->getCaIdconcepto()])) {
                    $row[$concepto->getCaConcepto()] = $tablaConceptos[$trayecto][$concepto->getCaIdconcepto()];
                } else {
                    $row[$concepto->getCaConcepto()] = " ";
                }
            }
            $row["Observaciones"] = $tablaConceptos[$trayecto]["observaciones"];

            $pdf->Row($row);
        }
        $pdf->flushGroup();

        if (count($recargosGenConcepto) > 0) {
            $imprimirObservaciones = false;
            foreach ($recargosGenConcepto as $recargo) {
                if ($recargo->getCaObservaciones()) {
                    $imprimirObservaciones = true;
                }
            }
            $pdf->beginGroup();
            $pdf->Ln(2);
            $pdf->SetFont($font, 'B', 8);
            $pdf->Cell(0, 4, 'RECARGOS EN ORIGEN ', 0, 1, 'L', 0);
            $pdf->Ln(2);
            $pdf->SetFont($font, '', 7);

            $titu_mem = array('Concepto', 'Tarifa');
            if ($imprimirObservaciones) {
                array_push($titu_mem, 'Observaciones');
                $width_mem = array(55, 53, 62);
            } else {
                $width_mem = array(80, 90);
            }
            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);

            $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
            $pdf->SetStyles(array_fill(0, count($width_mem), ""));
            $pdf->SetFills(array_fill(0, count($width_mem), 0));

            foreach ($recargosGenConcepto as $recargo) {
                $row = array($recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa());
                if ($imprimirObservaciones) {
                    array_push($row, $recargo->getCaObservaciones());
                }
                $pdf->Row($row);
            }
            $pdf->Ln(2);
            $pdf->flushGroup();
        }
        if (isset($observaciones["Concepto"])) {
            $pdf->beginGroup();
            $pdf->SetFont($font, '', 7);
            $titu_mem = array('Observaciones');
            $width_mem = array(170);

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);

            $width_mem = array(11, 159);

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
            $pdf->SetStyles(array_fill(0, count($width_mem), ""));
            $pdf->SetFills(array_fill(0, count($width_mem), 0));
            foreach ($observaciones["Concepto"] as $key => $observacion) {
                $row = array("Nota $key", $observacion);
                $pdf->Row($row);
            }
            $pdf->flushGroup();
        }
    }

    if (count($tablaTrayectos) > 0) {
        if ($i++ != 0) {
            $pdf->Ln(4);
            $pdf->beginGroup();
        } else {
            $pdf->Ln(1);
        }
        $conceptos = Doctrine::getTable("Concepto")
                ->createQuery("c")
                ->whereIn("c.ca_idconcepto", $conceptos2)
                ->addOrderBy("c.ca_liminferior")
                ->addOrderBy("c.ca_concepto")
                ->execute();

        $titulos = array_merge(array("Concepto\n "), $trayectos2);
        $width = 145 / count($trayectos2);
        $widths = array_merge(array(25), array_fill(0, count($trayectos2), $width));

        $pdf->SetFont($font, '', 9);
        $pdf->Cell(0, 4, "Producto : " . $descripcion_producto, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->SetFont($font, '', 7);
        $pdf->SetStyles(array_fill(0, count($trayectos2) + 1, "B"));
        $pdf->SetFills(array_fill(0, count($trayectos2) + 1, 1));
        $pdf->SetWidths($widths);
        $pdf->SetAligns(array_fill(0, count($trayectos2) + 1, "C"));
        $pdf->Row($titulos);

        $pdf->SetStyles(array_merge(array("B"), array_fill(0, count($trayectos2), "")));
        $pdf->SetFills(array_merge(array_fill(0, count($trayectos2) + 1, 0)));
        $pdf->SetWidths($widths);
        $pdf->SetAligns(array_fill(0, count($trayectos2) + 1, "C"));
        foreach ($conceptos as $concepto) {
            $row = array($concepto->getCaConcepto());
            foreach ($trayectos2 as $trayecto) {
                if (isset($tablaTrayectos[$concepto->getCaIdconcepto()][$trayecto])) {
                    $row[$trayecto] = $tablaTrayectos[$concepto->getCaIdconcepto()][$trayecto];
                } else {
                    $row[$trayecto] = " ";
                }
            }
            $pdf->Row($row);
        }
        $pdf->flushGroup();

        if (count($recargosGenTrayecto) > 0) {
            $imprimirObservaciones = false;
            foreach ($recargosGenTrayecto as $recargo) {
                if ($recargo->getCaObservaciones()) {
                    $imprimirObservaciones = true;
                }
            }
            $pdf->beginGroup();
            $pdf->Ln(2);
            $pdf->SetFont($font, 'B', 8);
            $pdf->Cell(0, 4, 'RECARGOS EN ORIGEN ', 0, 1, 'L', 0);
            $pdf->Ln(2);
            $pdf->SetFont($font, '', 7);

            $titu_mem = array('Concepto', 'Tarifa');
            if ($imprimirObservaciones) {
                array_push($titu_mem, 'Observaciones');
                $width_mem = array(55, 53, 62);
            } else {
                $width_mem = array(80, 90);
            }

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);

            $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
            $pdf->SetStyles(array_fill(0, count($width_mem), ""));
            $pdf->SetFills(array_fill(0, count($width_mem), 0));

            foreach ($recargosGenTrayecto as $recargo) {
                $row = array($recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa());
                if ($imprimirObservaciones) {
                    array_push($row, $recargo->getCaObservaciones());
                }
                $pdf->Row($row);
            }
            $pdf->Ln(2);
            $pdf->flushGroup();
        }
        if (isset($observaciones["Trayecto"])) {
            $pdf->beginGroup();
            $pdf->SetFont($font, '', 7);
            $titu_mem = array('Observaciones');
            $width_mem = array(170);

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);

            $width_mem = array(11, 159);

            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
            $pdf->SetStyles(array_fill(0, count($width_mem), ""));
            $pdf->SetFills(array_fill(0, count($width_mem), 0));
            foreach ($observaciones["Trayecto"] as $key => $observacion) {
                $row = array("Nota $key", $observacion);
                $pdf->Row($row);
            }
            $pdf->flushGroup();
        }
    }

    $grupos = array();
    $rows = Doctrine_Query::create()
            ->select("p.ca_transporte, p.ca_modalidad")
            ->from("CotProducto p")
            ->where("p.ca_idcotizacion = ?  ", array($cotizacion->getCaIdcotizacion()))
            ->addOrderBy("p.ca_transporte")
            ->addOrderBy("p.ca_modalidad")
            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
            ->execute();


    foreach ($rows as $row) {
        $grupos[$row["ca_transporte"]][] = $row["ca_modalidad"];
        $grupos[$row["ca_transporte"]] = array_unique($grupos[$row["ca_transporte"]]);
    }


    if (!isset($transportes[$k + 1]) || $transporte != $transportes[$k + 1]) {
        //echo "..:";
        // ======================== Recargos Locales ======================== //

        foreach ($grupos as $key => $grupo) {
            // echo $key." - ".$transporte." <br/>";
            if ($transporte == "DTA" || $transporte == "OTM") {
                $transporte = constantes::OTMDTA;
            }
            if ($key != $transporte) {
            // if($key!=constantes::OTMDTA && $transporte!="OTM" )
                continue;
            }

            foreach ($grupo as $modalidad) {
                $recargosLoc = $cotizacion->getRecargosLocales($key, $modalidad);
                if (count($recargosLoc) > 0) {
                    $imprimirObservaciones = false;
                    foreach ($recargosLoc as $recargo) {
                        if ($recargo->getCaObservaciones()) {
                            $imprimirObservaciones = true;
                        }
                    }

                    $pdf->beginGroup();
                    $pdf->Ln(4);
                    $pdf->SetFont($font, 'B', 8);
                    $pdf->Cell(0, 4, 'RECARGOS LOCALES ' . strtoupper($key) . ' ' . strtoupper($modalidad), 0, 1, 'L', 0);
                    $pdf->Ln(2);
                    $pdf->SetFont($font, '', 7);

                    $titu_mem = array('Concepto', 'Tarifa');
                    if ($imprimirObservaciones) {
                        array_push($titu_mem, 'Observaciones');
                        $width_mem = array(55, 53, 62);
                    } else {
                        $width_mem = array(80, 90);
                    }
                    $pdf->SetWidths($width_mem);
                    $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
                    $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
                    $pdf->SetFills(array_fill(0, count($width_mem), 1));
                    $pdf->Row($titu_mem);

                    foreach ($recargosLoc as $recargo) {
                        $pdf->beginGroup();
                        $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
                        $pdf->SetStyles(array_fill(0, count($width_mem), ""));
                        $pdf->SetFills(array_fill(0, count($width_mem), 0));
                        
                        $txt = $recargo->getTipoRecargo()->getCaRecargo();
                        if ($recargo->getCaIdconcepto() && $recargo->getCaIdconcepto() != 9999) {
                            $txt.=" " . $recargo->getConcepto()->getCaConcepto();
                        }
                        $row = array($txt, $recargo->getTextoTarifa());
                        if ($imprimirObservaciones) {
                            array_push($row, str_replace(array("<br/>", "<BR/>", "<br />", "<BR />"), "", $recargo->getCaObservaciones()));
                        }
                        $pdf->Row($row);
                        $pdf->flushGroup();
                    }
                    $pdf->flushGroup();
                }
            }
        }
    }

endfor; //transportes
// ======================== Aduanas ======================== //
// $aduanas = $cotizacion->getCotAduana();
$aduanas = Doctrine::getTable("CotAduana")
        ->createQuery("ca")
        ->where("ca.ca_idcotizacion = ?", $cotizacion->getCaIdcotizacion())
        ->innerJoin("ca.Costo c")
        ->leftJoin("c.ConceptoAduana a ON c.ca_idcosto = a.ca_idconcepto")
        ->addOrderBy("c.ca_transporte, a.ca_consecutivo")
        ->execute();

$imprimirObservaciones = false;

foreach ($aduanas as $aduana) {
    if (trim($aduana->getCaObservaciones()) != "") {
        $imprimirObservaciones[$aduana->getCosto()->getCaTransporte()] = true;
    }
}

if (count($aduanas) > 0) {

    $imprimirNotas[] = "aduanaImpo";

    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 9);
    $pdf->Cell(0, 4, 'COSTOS DE AGENCIAMIENTO ADUANERO', 0, 1, 'L', 0);
    $pdf->SetFont($font, '', 9);
    $i = 1;
    $linea = "";
    $vigencia = array();

    foreach ($aduanas as $aduana) {
        $pdf->beginGroup();
        if ($linea != $aduana->getCosto()->getCaTransporte()){
            //Control impresión
            $pdf->Ln(2);
            $pdf->SetFont($font, '', 9);
            $pdf->Cell(0, 4, "Transporte ".$aduana->getCosto()->getCaTransporte(), 0, 1, 'L', 0);
            $pdf->Ln(3);
            $pdf->SetFont($font, '', 7);

            $titu_mem = array('Concepto', 'Valor');
            if ($imprimirObservaciones[$aduana->getCosto()->getCaTransporte()]) {
                array_push($titu_mem, 'Observaciones');
                $width_mem = array(35, 65, 70); // = 170
            } else {
                $width_mem = array(40, 130);  // = 170
            }
            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);
            $linea = $aduana->getCosto()->getCaTransporte();
        }
        $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
        $pdf->SetStyles(array_fill(0, count($width_mem), ""));
        $pdf->SetFills(array_fill(0, count($width_mem), 0));
		
        $valor = "";
        if ($aduana->getCaValor() > 0 and $aduana->getCaValor() < 1) {
                $valor.= Utils::formatNumber($aduana->getCaValor())." %";
        }else if ($aduana->getCaValor() >= 1) {
                $valor.= "$ ".Utils::formatNumber($aduana->getCaValor());
        }
        if ($aduana->getCaAplicacion()){
                $valor.= " " . $aduana->getCaAplicacion();
        }
        if ($aduana->getCaValorminimo()){
            $valor.= " Mínimo :";
            if ($aduana->getCaValorminimo() > 0 and $aduana->getCaValorminimo() < 1) {
                    $valor.= Utils::formatNumber($aduana->getCaValorminimo())." %";
            }else if ($aduana->getCaValorminimo() >= 1) {
                    $valor.= "$ ".Utils::formatNumber($aduana->getCaValorminimo());
            }
            if ($aduana->getCaAplicacionminimo()){
                    $valor.= " " . $aduana->getCaAplicacionminimo();
            }
        }
		
        $row = array(
            $aduana->getCosto()->getCaCosto(),
            $valor
        );
        if ($imprimirObservaciones) {
            array_push($row, $aduana->getCaObservaciones());
        }
        $pdf->Row($row);
        $pdf->flushGroup();
    }
}

// ======================== Seguros ======================== //
$seguros = $cotizacion->getCotSeguros();
$imprimirObservaciones = false;

foreach ($seguros as $seguro) {
    if ($seguro->getCaObservaciones()) {
        $imprimirObservaciones = true;
        break;
    }
}

if (count($seguros) > 0) {

    $imprimirNotas[] = "seguro";
    //Control impresión
    $pdf->beginGroup();

    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 9);
    $pdf->Cell(0, 4, 'SEGURO INTERNACIONAL', 0, 1, 'L', 0);
    $pdf->SetFont($font, '', 9);
    $pdf->Ln(2);
    $i = 1;
    $linea = "";

    $pdf->Ln(2);
    $pdf->SetFont($font, '', 7);

    $titu_mem = array('Transporte', 'Prima', 'Tarifa Mínima', 'Obtención de la Póliza');
    if ($imprimirObservaciones) {
        array_push($titu_mem, 'Observaciones');
        $width_mem = array(20, 45, 35, 35, 35);
    } else {
        $width_mem = array(20, 45, 35, 70);
    }
    $pdf->SetWidths($width_mem);
    $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
    $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
    $pdf->SetFills(array_fill(0, count($width_mem), 1));
    $pdf->Row($titu_mem);
    foreach ($seguros as $seguro) {
        $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
        $pdf->SetStyles(array_fill(0, count($width_mem), ""));
        $pdf->SetFills(array_fill(0, count($width_mem), 0));
        $row = array(
            $seguro->getCaTransporte(),
            (($seguro->getCaPrimaTip() == "%") ? Utils::formatNumber($seguro->getCaPrimaVlr()) . " " . $seguro->getCaPrimaTip() : $seguro->getCaIdmoneda() . " " . Utils::formatNumber($seguro->getCaPrimaVlr())) . " sobre valor asegurado"
            ,
            ($seguro->getCaPrimaMin() != 0) ? $seguro->getCaIdmoneda() . " " . Utils::formatNumber($seguro->getCaPrimaMin()) : " "
            ,
            ($seguro->getCaObtencion() != 0) ? $seguro->getCaIdmoneda() . " " . Utils::formatNumber($seguro->getCaObtencion()) : ""
        );
        if ($imprimirObservaciones) {
            array_push($row, $seguro->getCaObservaciones());
        }
        $pdf->Row($row);
    }
    $pdf->flushGroup();
}

// ======================== Seguros Contenedor ======================== //

if($cotizacion->getEsSeguroContenedor()){
    $imprimirNotas[] = "seguroContenedor";
}

// ========================== Notas Importantes ========================== //
$pdf->beginGroup();
$pdf->SetFont($font, 'B', 8);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, "Nota Importante: En caso de aceptación de la presente oferta de servicios se entenderá leído y aceptado el contrato de agenciamiento de carga que se encuentra en la página web www.coltrans.com.co y que regirá nuestra relación comercial.", 0, 'J', 0);
if ($comodato) {
    $pdf->MultiCell(0, 4, "Cesa la obligación de demoras de contenedor una vez esté sea entregado en el Patio o lugar de entrega de vacios designado por la Naviera.", 0, 'J', 0);
}
$pdf->Ln(2);
$pdf->flushGroup();

// ======================== Continuación de viaje ======================== //
if (in_array("OTM", $transportes) || in_array("DTA", $transportes)) {
    $pdf->beginGroup();
    $pdf->Ln(2);
    $pdf->MultiCell(0, 4, "Nota Importante: Es responsabilidad del importador, los perjuicios a que haya lugar como consecuencia de inexactitudes o errores en la documentación suministrada, así como de las sanciones resultado de requerimientos aduaneros por faltantes o sobrantes.

    La Poliza del Importador deberá incluir los tributos aduaneros. El OTM no se hace responsable por el pago de tributos aduaneros a la DIAN, la póliza de tributos aduanero sólo cumple la función de garantía a la DIAN. Los pagos por tríbutos aduaneros deberán ser asumidos por el importador y reclamados a su compañía de seguros para ser pagados a la DIAN.

    Importante:
        • Al peso de la mercancía deberá adicionarse el peso del contenedor. La tara promedio para contenedor de 20' es de 2.300 kg y 40' de 4.300 kg.
        • Las tarifas de los contenedores de 20' son tarifas para combinar. El tiempo estimado  de cargue para contenedores de 20' consolidados es de 48 horas.
        • Los días de restricción vial informados por el Ministerio de Transporte no se tendrán en cuenta como días hábiles de entrega del contenedor.", 0, 'J', 0);
    $pdf->flushGroup();
}

// ======================== Directorio de agentes ======================== //
$datosAg = array();

$contactosAgente = $cotizacion->getContactosAgente();

if (count($contactosAgente) > 0) {
    $pdf->beginGroup();
    $pdf->Ln(2);
    $pdf->SetFont($font, 'B', 9);
    $pdf->MultiCell(0, 4, "DIRECTORIO DE AGENTES", 0, 'L', 0);

    $pdf->Ln(4);
    $pdf->SetFont($font, '', 9);

    if (count($contactosAgente) == 1) {
        $pdf->MultiCell(0, 4, 'A continuación relacionamos los datos de nuestro agente encargado de coordinar los despachos:', 0, 1);
        $imprimiotitulo = true;
    } else {
        $pdf->MultiCell(0, 4, 'A continuación relacionamos los datos de nuestros agentes encargados de coordinar los despachos:', 0, 1);
        $imprimiotitulo = true;
    }
    $pdf->Ln(2);
    $idagente = "";
    $idtrafico = "";
    foreach ($contactosAgente as $contacto) {
        $idsSucursal = $contacto->getIdsSucursal();
        $agente = $idsSucursal->getIds();
        $ciudad = $idsSucursal->getCiudad();

        if (!$imprimiotitulo) {
            $pdf->beginGroup();
        }

        if ($idtrafico != $ciudad->getCaIdtrafico()) {
            $idtrafico = $ciudad->getCaIdtrafico();
            $trafico = $ciudad->getTrafico();
            $pdf->Ln(1);
            $pdf->SetFont($font, 'B', 10);
            $pdf->MultiCell(0, 3, '» ' . $trafico->getCaNombre() . ' «', 0, 1);
            $pdf->Ln(2);
        }

        if ($idagente != $agente->getCaId()) {
            $idagente = $agente->getCaId();

            $pdf->SetFont($font, 'B', 8);
            $pdf->MultiCell(0, 3, $agente->getCaNombre(), 0, 1);
            $pdf->SetFont($font, '', 8);
            $pdf->Ln(2);
            $pdf->MultiCell(0, 3, "Contactos :", 0, 1);
        }
        $pdf->SetFont($font, 'B', 8);
        $pdf->MultiCell(0, 3, $contacto->getNombre(), 0, 1);
        $pdf->SetFont($font, '', 8);
        $pdf->MultiCell(0, 3, $contacto->getCaDireccion() . " - " . $ciudad->getCaCiudad(), 0, 1);
        $pdf->MultiCell(0, 3, "Teléfonos (" . strtoupper($ciudad->getTrafico()->getCodigoarea()) . " - " . strtoupper($contacto->getCodigoArea()) . ") : " . $contacto->getCaTelefonos() . " - Fax : " . $contacto->getCaFax(), 0, 1);
        $pdf->MultiCell(0, 3, "Correo Electrónico :" . $contacto->getCaEmail(), 0, 1);
        $pdf->MultiCell(0, 3, "Operación :" . str_replace("|", ", ", $contacto->getCaTransporte()), 0, 1);

        $pdf->flushGroup();
        $pdf->Ln(2);
        $imprimiotitulo = false;
    }
}

$pdf->SetFont($font, '', 10);
//Hace que el titulo tenga por lo menos 2 renglones
if ($pdf->GetY() > $pdf->PageBreakTrigger - 15) {
    $pdf->AddPage();
} else {
    $pdf->Ln(4);
}
$pdf->MultiCell(0, 4, $cotizacion->getCaDespedida(), 0, 1);

$pdf->beginGroup();
$pdf->Ln(4);
$pdf->MultiCell(0, 4, 'Cordialmente,', 0, 1);


$pdf->Ln(10);
$pdf->SetFont($font, 'B', 10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaNombre()), 0, 1);
$pdf->SetFont($font, '', 10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaCargo()), 0, 1);
$pdf->MultiCell(0, 4, strtoupper($empresa->getCaNombre()), 0, 1);
$pdf->MultiCell(0, 4, $sucursal->getCaDireccion(), 0, 1);
$pdf->MultiCell(0, 4, "Tel.:" . $sucursal->getCaTelefono() . " " . $usuario->getCaExtension(), 0, 1);
$pdf->MultiCell(0, 4, "Fax :" . $sucursal->getCaFax(), 0, 1);

$pdf->MultiCell(0, 4, $sucursal->getCaNombre() . " - " . $empresa->getTrafico()->getCaNombre(), 0, 1);
$pdf->MultiCell(0, 4, $usuario->getCaEmail(), 0, 1);
$pdf->MultiCell(0, 4, $empresa->getCaUrl(), 0, 1);

if ($cotizacion->getCaAnexos() != '' && $empresa->getCaIdempresa() == 1) {
    $pdf->Ln(6);
    $pdf->MultiCell(0, 4, "Anexo: " . $cotizacion->getCaAnexos(), 0, 1);
}
$pdf->flushGroup();

// ======================== Notas ======================== //
//if( $empresa->getCaIdempresa()==2 ){
//if( $empresa->getCaIdempresa() )
//if( $empresa->getCaIdempresa()==2 || $empresa->getCaIdempresa()==1 ) {
$imprimirNotas = array_unique($imprimirNotas);

$nuevaPagina = false;

foreach ($imprimirNotas as $val) {
    if (!$nuevaPagina) {
        $pdf->AddPage();
        $nuevaPagina = true;
    }

    //Hace que el titulo tenga por lo menos 2 renglones
    if ($pdf->GetY() > $pdf->PageBreakTrigger - 15) {
        $pdf->AddPage();
    } else {
        $pdf->Ln(2);
    }

    $pdf->SetFont($font, 'B', 9);
    $pdf->MultiCell(0, 4, $notas[$val . "Titulo"], 0, 'C', 0);
    $pdf->Ln(1);
    $pdf->SetFont($font, '', 8);
    $pdf->MultiCell(0, 4, $notas[$val], 0, 'J', 0);
}

// ======================== Notas adicionales ======================== //

if ($empresa->getCaIdempresa() == 2 || $empresa->getCaIdempresa() == 1) {
    $pdf->AddPage();
    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 14);
    $pdf->Cell(0, 4, "CIRCULAR EXTERNA NO. 001", 0, 1, "C");

    $pdf->Ln(4);
    $pdf->SetFont($font, '', 10);
    $pdf->Cell(0, 4, "27 de Abril de 2009", 0, 1);

    $pdf->Ln(10);
    $pdf->SetFont($font, '', 10);
    $pdf->Cell(0, 4, "Apreciados Clientes,", 0, 1);
    $pdf->Ln(15);
    $pdf->MultiCell(0, 5, "La presente es con el fin de  informarles las nuevas disposiciones  Aduaneras en el Marco Legal actual que es el Decreto 2101 del 13 de Junio de 2008 , Decreto 1039 del 26 de Marzo 2009 y la Resolución No. 7941 del 26 de Agosto de 2008, Resolución 3942 del 17 de Abril de 2009  en donde se modifica trámites semiautomatizados a procedimientos totalmente automatizados sin uso del papel en el Proceso de Importación Marítima, se tuvieron en cuenta lineamientos internacionales como el Marco Normativo de la OMA y acuerdos que en la actualidad Colombia está negociando.", 0, 'J', 0);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 5, "Por lo anterior a partir del 1o. de Mayo 2009 es indispensable que los documentos de transporte contengan como mínimo la siguiente información: ", 0, 'J', 0);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 5, " RUT ( Registro Único Tributario)  del Importador
      La indicación del Trámite o destino que se le dará a la mercancía una vez descargada en el lugar de llegada, ejemplo:
         -   Entrega en lugar de arribo
         -   Transito Aduanero
         -   Ingreso a depósito o Zona Franca después del descargue en el lugar de arribo
         -   Descargue de mercancía directamente en el depósito o zona franca
         -   Entrega Urgente
      Descripción  genérica de la mercancía ;  NO es aceptada como descripción \" mercancías varias, mercancía según factura , misceláneas.. \"
      La DIAN tendrá la potestad de establecer en que eventos es necesario las partidas o  sub-partidas arancelarias de la mercancía   por acto oficial, como lo estipula en el Decreto 2101 art. 8 y la Resolución 7941 art 8 , hasta la fecha no se ha pronunciado la Aduana con los productos susceptibles del anterior requerimiento
      Peso,  unidades de carga.  Cuando se trate de carga contenerizada es necesario el número de seguridad o precinto", 0, 'J', 0);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 5, "Es recomendable que la información  descrita sea de conocimiento de los Exportadores, para el momento de la elaboración de los documentos de transporte. ", 0, 'J', 0);
    $pdf->Ln(15);
    $pdf->Cell(0, 4, "Atentamente,", 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(0, 4, sfConfig::get('app_branding_name1'), 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(0, 4, "DEPARTAMENTO MARITIMO", 0, 1);
    $pdf->AddPage();
    // Ticket # 1811
    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 14);
    $pdf->Cell(0, 4, "CIRCULAR 0170", 0, 1, "C");
    $pdf->Ln(15);
    $pdf->SetFont($font, '', 14);
    $pdf->MultiCell(0, 5, "Los Agentes de Carga Internacional  y Agencias de Aduana debemos adoptar las medidas necesarias para prevención  y control al lavado de activos. Así mismo, establecer mecanismos de control orientados a seleccionar y conocer los clientes acerca lo personal, financiero y comercial. Dentro de estas medidas existe una herramienta para el conocimiento del cliente que es la aplicación de la Circular 0170 exigida por la DIAN

    Algunos de estos mecanismos de prevención y control del lavado de activos que la DIAN instruye ayudan a identificar las operaciones sospechosas y así mismo controlar los indicios que permite detectar la realización de una operación  inusual.

    Nos es muy grato ofrecer los servicios de nuestra empresa, para contribuir con el buen servicio los invitamos a diligenciar la Circular 0170 de manera sincera y oportuna.
     ", 0, 'J', 0);
    $pdf->Ln(2);
}

$pdf->Output($filename);

if (!$filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>
