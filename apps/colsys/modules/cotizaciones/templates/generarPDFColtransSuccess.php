<?

$cotizacion = $sf_data->getRaw("cotizacion");
$notas = $sf_data->getRaw("notas");
$usuario = $cotizacion->getUsuario();
$contacto = $cotizacion->getContacto();
$cliente = $contacto->getCliente();
$empresa = $usuario->getSucursal()->getEmpresa();

$comodato = false;

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

$pdf = new PDF (  );
$pdf->Open ();
$pdf->setIdempresa ( $empresa->getCaIdempresa() );
$pdf->setColtransHeader ( true );
$pdf->setColtransFooter ( true );
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);

switch( $cotizacion->getCaFuente()){
	case "Arial":
		$font = 'Arial';
		break;
	case "Calibri":
		$pdf->AddFont('Calibri','','calibri.php');
		$pdf->AddFont('Calibri','B','calibrib.php');
		$font = 'Calibri';
		break;
	default:
		$pdf->AddFont('Tahoma','','tahoma.php');
		$pdf->AddFont('Tahoma','B','tahomab.php');
		$font = 'Tahoma';
		break;
}

$pdf->SetFont($font,'',10);
$directorioAg = array();
$imprimirNotas = array();
$sucursal = $usuario->getSucursal();
$pdf->SetSucursal($sucursal->getCaIdsucursal());
//$pdf->SetLineRepeat("Se�ores: ".strtoupper($cliente->getCaCompania()."    ".$cotizacion->getCaFchcreado()));
$pdf->Ln(5);
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($cotizacion->getCaFchcreado(),"%d-%d-%d %d:%d:%d");

$pdf->Cell(0, 4, str_replace(' D.C.','',$sucursal->getCaNombre()).', '.$dia.' de '.$meses[$mes-1].' de '.$anno,0,1);

$pdf->Ln(8);
$pdf->Cell(0, 4,$contacto->getCaSaludo(),0,1);
$pdf->SetFont($font,'',10);

$pdf->Cell(0, 4, strtoupper($contacto->getNombre()),0,1);
$cargo=null;
if ( $contacto->getCaCargo()!='' and $contacto->getCaDepartamento()!='') {
	$cargo = $contacto->getCaCargo()." - ".$contacto->getCaDepartamento();
} else if ($contacto->getCaCargo()!='' and $contacto->getCaDepartamento()=='') {
	$cargo = $contacto->getCaCargo();
} else if ($contacto->getCaCargo()=='' and $contacto->getCaDepartamento()!='') {
	$cargo = $contacto->getCaDepartamento();
}
if ($cargo != '') {
	$pdf->SetFont($font,'',10);
	$pdf->Cell(0, 4, $cargo,0,1);
}

$pdf->SetFont($font,'B',10);
$pdf->Cell(0, 4, strtoupper($cliente->getCaCompania()),0,1);
$pdf->SetFont($font,'',10);
$pdf->Cell(0, 4, strtoupper($cliente->getCiudad()->getCaCiudad()) ,0,1);

if($cotizacion->getCaUsuanulado()){
	$pdf->SetTextColor(128,128,128);
	$pdf->SetFont($font,'B',68);
	$pdf->Write(5,'A N U L A D O ');
	$pdf->SetTextColor(0,0,0);
}
$pdf->SetFont($font,'',10);
$pdf->Ln(8);
$pdf->Cell(0, 4, 'Asunto : '.$cotizacion->getCaAsunto()." ".$cotizacion->getCaConsecutivo()." (V-".$cotizacion->getCaVersion().")",0,1);
//    $pdf->Cell(0, 0, 'Comunicaci�n No. '.$rs->Value('ca_idcotizacion').'/'.$rs->Value('ca_usuario').str_pad(" ",7),0,0,'R');

$pdf->SetFont($font,'',10);
$pdf->Ln(4);
$pdf->Cell(0, 4, $cotizacion->getCaSaludo(),0,1);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, $cotizacion->getCaEntrada(),0,1);

$productos = $cotizacion->getCotProductos( );

$transportes = array();
//Busca todos los medios de transporte
foreach( $productos as $producto ){
	if($producto->getCaTransporte()=="OTM-DTA")
	{
		if(!in_array($producto->getCaProducto(), $transportes) ){
					$transportes[] = $producto->getCaProducto();
		}
	}
	else
	{
		if(!in_array($producto->getCaTransporte(), $transportes) ){
					$transportes[] = $producto->getCaTransporte();
		}
        
        if( $producto->getTransportador()->getCaContratoComodato() ){
            $comodato = true;
        }
	}
}

for( $k=0; $k<count($transportes); $k++ ):
	$transporte = $transportes[$k];
	$tabla = array();
	$i=0;

	$pdf->beginGroup();

	$pdf->Ln(4);
	$pdf->SetFont($font,'B',9);

	if(strtoupper($transporte)=="OTM")
	{
		$pdf->Cell(0, 4, '   OTM � OPERACI�N DE TRANSPORTE MULTIMODAL', 0, 1, 'L', 0);
	}
	else if(strtoupper($transporte)=="DTA")
		$pdf->Cell(0, 4, '   DTA � DECLARACI�N DE TR�NSITO ADUANERO', 0, 1, 'L', 0);
	else
		$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL '.strtoupper($transporte), 0, 1, 'L');
	$pdf->Ln(2);
	$age_imp = true;
	$pdf->SetFont($font,'B',9);

	foreach( $productos as $producto ):
                if( $producto->getCaTransporte()=="OTM-DTA" )
                {
                    if( $producto->getCaProducto()!=$transporte )
                    {
                        continue;
                    }
					$imprimirNotas[]="anexoImpo";
					$imprimirNotas[]="OTM_".$producto->getCaModalidad();
                }
                else
                {
                    if( $producto->getCaTransporte()!=$transporte )
                    {
                        continue;
                    }
                }
		$imprimirObservaciones = false;
		$imprimirRecargos = false;
		if ($producto->getCaImpoexpo()==Constantes::IMPO){
			$imprimirNotas[]="anexoImpo";
		}
		if ($producto->getCaImpoexpo()==Constantes::EXPO){
			$imprimirNotas[]="anexoExpo";
		}
		// ======================== Impresi�n por Item ======================== //
		if ($producto->getCaImprimir() == 'Por Item' || $producto->getCaTransporte()=="OTM-DTA"):

			if( $i++!=0 ){
				$pdf->Ln(4);
				$pdf->beginGroup();
			}
			$linea = $producto->getTransportador();
			$tabla = array();
			$pdf->SetFont($font,'B',8);
			$pdf->SetWidths(array(170));
			$pdf->SetAligns(array("L"));
			$pdf->SetStyles(array("B"));
			$pdf->Row(array('Producto : '.$producto->getCaProducto()));

            $titulos = array( 'T�rminos' ,'Origen', 'Destino');
            if( $producto->getCaVigencia() ){
                array_push($titulos, "Valida Hasta");
            }
            $pdf->SetFont($font,'B',8);
            if( count( $titulos ) == 3 ){
                $pdf->SetWidths(array( 50, 60, 60));
            }
            if( count( $titulos ) == 4 ){
                $pdf->SetWidths(array( 50, 45, 45, 30));
            }
			$pdf->SetAligns(array_fill(0, 5, "C"));
			$pdf->SetStyles(array_fill(0, 5, "B"));
			$pdf->SetFills(array_fill(0, 5, 1));
			$pdf->Row( $titulos );

			$pdf->SetStyles(array_fill(0, 5, ""));
			$pdf->SetFills(array_fill(0, 5, 0));
			$pdf->SetFont($font,'',8);
            $row = array( $producto->getCaIncoterms(), $producto->getOrigen()->getCaCiudad()." - ".$producto->getOrigen()->getCaTrafico(),  $producto->getDestino()->getCaCiudad()." - ".$producto->getDestino()->getCaTrafico() );

            if( $producto->getCaVigencia() ){
                array_push($row, Utils::fechaMes($producto->getCaVigencia()) );
            }

			$pdf->Row( $row );
			if( $linea && $producto->getCaPostularlinea()){
				$pdf->SetFont($font,'',8);
				$pdf->SetWidths(array(170));
				$pdf->SetAligns(array_fill(0, 3, "L"));
				$pdf->Row(array(($producto->getCaTransporte()==Constantes::AEREO?"A�rolinea: ":"Linea: ").$linea->getIds()->getCaNombre()));
			}

			$opciones = $producto->getCotOpciones( );
			foreach( $opciones as $opcion ){
				$textoRecargos = $opcion->getTextoRecargos();
				$concepto = $opcion->getConcepto();

				$tabla[$opcion->getCaIdopcion()]["flete"] = $concepto->getCaConcepto();
				$tabla[$opcion->getCaIdopcion()]["tarifas"] = $opcion->getTextoFlete()." ".$opcion->getEquipo()->getCaConcepto()."\n";
				if( $textoRecargos ){
					$tabla[$opcion->getCaIdopcion()]["recargos"] = $textoRecargos;
					$imprimirRecargos = true;
				}
				if( $opcion->getCaObservaciones() ){
					$tabla[$opcion->getCaIdopcion()]["observaciones"] = $opcion->getCaObservaciones();
					$imprimirObservaciones = true;
				}
			}
			//Imprime los detalles de la tabla (Opciones)
			if( count($tabla)>0 ){

				$pdf->Ln(2);
				$titulos = array('Concepto', 'Tarifas');

				if ($imprimirRecargos){
					array_push($titulos,  ($producto->getCaIncoterms()=="FCA - Free Carrier"?"Recargos en Origen":"Recargos por Flete") );
				}
				if ($imprimirObservaciones){
					array_push($titulos, "Observaciones");
				}

				//Calcula el ancho de las columnas
				if ($imprimirRecargos && $imprimirObservaciones ){
					$widths = array( 30, 25, 70, 45 );	//en todos los casos debe sumar 170
				}elseif( $imprimirRecargos ){
					$widths = array(40, 40, 90);
				}elseif( $imprimirObservaciones ){
					$widths = array(30, 95, 45);
				}else{
					//$widths = array(30, 140);
					$widths = array(80, 90);
				}

				$pdf->SetWidths($widths);
				$pdf->SetAligns(array_fill(0, 4, "C"));
				$pdf->SetStyles(array_fill(0, 4, "B"));
				$pdf->SetFills(array_fill(0, 4, 1));
				//$pdf->Row($titulos);

				foreach( $tabla as $item ){
					if( $imprimirRecargos && !isset($item["recargos"]) ){ //Evita que queden huecos en la impresion
						$item["recargos"]=" ";
					}
					if( $imprimirObservaciones && !isset($item["observaciones"]) ){ //Evita que queden huecos en la impresion
						$item["observaciones"]=" ";
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
			if( count($recargosGen)>0 ){
				$imprimirObservaciones=false;
				foreach( $recargosGen as $recargo ){
					if( $recargo->getCaObservaciones() ){
						$imprimirObservaciones=true;
					}
				}

                if( $producto->getCaTransporte()=="OTM-DTA" ){
                    $titulo = "COSTOS QUE SE PUEDEN GENERAR EN PUERTO POR LA OPERACION DE OTM";
                }else{
                    $titulo = "RECARGOS EN ORIGEN";
                }

				$pdf->beginGroup();
				$pdf->Ln(2);
				$pdf->SetFont($font,'B',8);
				$pdf->Cell(0, 4,  $titulo, 0, 1, 'L', 0);
				$pdf->Ln(2);
				$pdf->SetFont($font,'',7);

				$titu_mem= array('Concepto',  'Tarifa' );
				if( $imprimirObservaciones ){
					array_push( $titu_mem, 'Observaciones' );
					$width_mem= array(55, 53, 62);
				}else{
					$width_mem= array(80, 90);
				}

				$pdf->SetWidths($width_mem);
				$pdf->SetAligns(array_fill(0, count($width_mem), "C"));
				$pdf->SetStyles(array_fill(0, count($width_mem), "B"));
				$pdf->SetFills(array_fill(0, count($width_mem), 1));
				//$pdf->Row($titu_mem);

				$pdf->SetAligns(array_fill(0, count($width_mem), "L"));
				$pdf->SetStyles(array_fill(0, count($width_mem), ""));
				$pdf->SetFills(array_fill(0, count($width_mem), 0));

				foreach( $recargosGen as $recargo ){
					$row = array( $recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa() );
					if( $imprimirObservaciones ){
						array_push( $row,  $recargo->getCaObservaciones() );
					}
					$pdf->Row($row);
				}
				$pdf->Ln(2);
				$pdf->flushGroup();
			}

			//Imprime el tiempo de transito
                        array_push($widths,35);
                        array_push($datos,"Modalidad: ".nl2br($producto->getCaModalidad()));
                        $pos_mem+= 35;
			if (strlen($producto->getCaFrecuencia())<>0){
				array_push($widths,35);
				array_push($datos,"Frecuencia: ".nl2br($producto->getCaFrecuencia()));
				$pos_mem+= 35;
			}
			if (strlen($producto->getCaTiempotransito())<>0){
				array_push($widths,35);
				array_push($datos,"T.Transito: ".nl2br($producto->getCaTiempotransito()));
				$pos_mem+= 35;
			}
			if (strlen($producto->getCaObservaciones())<>0){
				array_push($widths,(170-$pos_mem));

				array_push($datos,"Observaciones: ".$producto->getCaObservaciones());
			}



			$pdf->SetFont($font,'',8);
			$pdf->SetWidths($widths);
			$pdf->SetAligns(array_fill(0, 3, "L"));
			$pdf->Row($datos);

		endif;
	endforeach; //Impresi�n por item

	// ======================== Impresi�n por Puerto ======================== //

	$tabla = array();
	$origenes = array();
	$destinos = array();
	$recargosGenPuerto = array();
	foreach( $productos as $producto ):
		if( $producto->getCaTransporte()!=$transporte ){
			continue;
		}
		if( $producto->getCaImprimir() == 'Puerto' ):
			//[$producto->getCaTransporte()]
			$origenes[] = $producto->getOrigen()->getCaCiudad();
			$destinos[] =  $producto->getDestino()->getCaCiudad();

			$opciones = $producto->getCotOpciones( );
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();
				if ( isset($tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()]) ){
					$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].= str_repeat("..-..", 12)."\n";
				}else{
					$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()]="";
				}

				$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].=$concepto->getCaConcepto()." - ".substr($producto->getCaIncoterms(),0,3)." ";
				$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].=$opcion->getTextoFlete()."\n";
				$textoRecargos = $opcion->getTextoRecargos();
				$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].=$textoRecargos;
			}

            if( $producto->getCaVigencia() ){
                $tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].=" Valida Hasta: ".Utils::fechaMes( $producto->getCaVigencia() );
            }

			$recgen = $producto->getRecargosGenerales();
			if( $recgen && count($recgen)>0 ){
				@$recargosGenPuerto = array_merge( $recargosGenPuerto , $recgen );
			}
		endif;
	endforeach;

	$origenes = array_unique( $origenes );
	$destinos = array_unique( $destinos );

	if( count($tabla)>0 ){
		if( $i++!=0 ){
			$pdf->Ln(4);
			$pdf->beginGroup();
		}

		$pdf->Ln(2);
		$pdf->SetFont($font,'',7);
		$titulos = array_merge( array("Origen\\Destino"),   $destinos);
		$width = 145/count($destinos);
		$widths = array_merge(array(25), array_fill(0, count($destinos), $width) );

		$pdf->SetStyles(array_fill(0, count($destinos)+1, "B"));
		$pdf->SetFills(array_fill(0, count($destinos)+1, 1));
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($destinos)+1, "C"));
		$pdf->Row( $titulos );

		$pdf->SetStyles( array_merge(array("B"), array_fill(0, count($destinos), "")));
		$pdf->SetFills( array_merge( array_fill(0, count($destinos)+1, 0)));
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($destinos)+1, "C"));
		foreach( $origenes as $origen  ){
			$row = array($origen);
			foreach( $destinos as $destino){
				if( isset($tabla[$origen][$destino]) ){
					$row[$destino]=	$tabla[$origen][$destino];
				}else{
					$row[$destino]=	" ";
				}
			}
			$pdf->Row($row);
		}

		$pdf->flushGroup();

		if( count($recargosGenPuerto)>0 ){
			$imprimirObservaciones=false;
			foreach( $recargosGenPuerto as $recargo ){
				if( $recargo->getCaObservaciones() ){
					$imprimirObservaciones=true;
				}
			}
			$pdf->beginGroup();
			$pdf->Ln(2);
			$pdf->SetFont($font,'B',8);
			$pdf->Cell(0, 4, 'RECARGOS EN ORIGEN ', 0, 1, 'L', 0);
			$pdf->Ln(2);
			$pdf->SetFont($font,'',7);

			$titu_mem= array('Concepto',  'Tarifa' );
			if( $imprimirObservaciones ){
				array_push( $titu_mem, 'Observaciones' );
				$width_mem= array(55, 53, 62);
			}else{
				$width_mem= array(80, 90);
			}

			$pdf->SetWidths($width_mem);
			$pdf->SetAligns(array_fill(0, count($width_mem), "C"));
			$pdf->SetStyles(array_fill(0, count($width_mem), "B"));
			$pdf->SetFills(array_fill(0, count($width_mem), 1));
			$pdf->Row($titu_mem);

			$pdf->SetAligns(array_fill(0, count($width_mem), "L"));
			$pdf->SetStyles(array_fill(0, count($width_mem), ""));
			$pdf->SetFills(array_fill(0, count($width_mem), 0));

			foreach( $recargosGenPuerto as $recargo ){
				$row = array( $recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa() );
				if( $imprimirObservaciones ){
					array_push( $row,  $recargo->getCaObservaciones() );
				}
				$pdf->Row($row);
			}
			$pdf->Ln(2);
			$pdf->flushGroup();
		}
	}
	// ======================== Impresi�n por Concepto o Trayecto ======================== //
	$tablaConceptos = array();
	$tablaTrayectos = array();
	$conceptos1 = array();
	$trayectos1  = array();

	$conceptos2 = array();
	$trayectos2  = array();

	$recargosGenConcepto =array();
	$recargosGenTrayecto =array();

	foreach( $productos as $producto ):
		if( $producto->getCaTransporte()!=$transporte ){
			continue;
		}
		if ($producto->getCaImprimir() == 'Concepto' or $producto->getCaImprimir() == 'Trayecto'  ):
			$opciones = $producto->getCotOpciones( );
			$trayecto = $producto->getOrigen()->getCaCiudad()."\n".$producto->getDestino()->getCaCiudad();
			if ($producto->getCaImprimir() == 'Concepto' ){
				$trayectos1[] = $trayecto;
				$recgen = $producto->getRecargosGenerales();
				if( $recgen && count($recgen)>0 ){
					@$recargosGenConcepto = array_merge( $recargosGenConcepto , $recgen );
				}
			}else{
				$recgen = $producto->getRecargosGenerales();
				if( $recgen && count($recgen)>0 ){
					@$recargosGenTrayecto = array_merge( $recargosGenTrayecto , $recgen );
				}
				$trayectos2[] = $trayecto;
			}
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();
				if ($producto->getCaImprimir() == 'Concepto' ){
					$conceptos1[  ] = $concepto->getCaIdconcepto();
				}else{
					$conceptos2[  ] = $concepto->getCaIdconcepto();
				}
				$contenido="";

				$concepto = $opcion->getConcepto();
				if ($producto->getCaImprimir() == 'Concepto' ){
					if ( isset($tablaConceptos[ $trayecto ][ $concepto->getCaConcepto() ]) ){
						$tablaConceptos[ $trayecto ][ $concepto->getCaIdconcepto() ].= str_repeat("..-..", 12)."\n";
					}else{
						$tablaConceptos[ $trayecto ][ $concepto->getCaIdconcepto() ]="";
					}
				}else{
					if ( isset($tablaTrayectos[ $concepto->getCaConcepto() ][ $trayecto ]) ){
						$tablaTrayectos[ $concepto->getCaIdconcepto() ][ $trayecto ].= str_repeat("..-..", 12)."\n";
					}else{
						$tablaTrayectos[ $concepto->getCaIdconcepto() ][ $trayecto ]="";
					}
				}
				if( $producto->getCaIncoterms() ){
					$contenido.= substr($producto->getCaIncoterms(),0,3)."\n";
				}
				$contenido.=$opcion->getTextoFlete()."\n";

				$textoRecargos = $opcion->getTextoRecargos();
				$contenido.=$textoRecargos;
				if ($producto->getCaImprimir() == 'Concepto' ){
					$tablaConceptos[ $trayecto ][ $concepto->getCaIdconcepto() ] .= $contenido;

					$tablaConceptos[ $trayecto ][ "observaciones" ]="";
					if( $producto->getCaFrecuencia() ){
						if($tablaConceptos[ $trayecto ][ "observaciones" ]!=""){
							$tablaConceptos[ $trayecto ][ "observaciones" ] .= "\n";
						}
						$tablaConceptos[ $trayecto ][ "observaciones" ] .= "Frec.: ".nl2br($producto->getCaFrecuencia());
					}

					if( $producto->getCaTiempotransito() ){
						if($tablaConceptos[ $trayecto ][ "observaciones" ]!=""){
							$tablaConceptos[ $trayecto ][ "observaciones" ] .= "\n";
						}
						$tablaConceptos[ $trayecto ][ "observaciones" ] .= "T.T.: ".nl2br($producto->getCaTiempotransito());
					}

                    if( $producto->getCaVigencia() ){
                        if($tablaConceptos[ $trayecto ][ "observaciones" ]!=""){
							$tablaConceptos[ $trayecto ][ "observaciones" ] .= "\n";
						}
						$tablaConceptos[ $trayecto ][ "observaciones" ] .= "Valida Hasta: ".Utils::fechaMes($producto->getCaVigencia());
                    }

					if( $producto->getCaObservaciones() ){
						if($tablaConceptos[ $trayecto ][ "observaciones" ]!=""){
							$tablaConceptos[ $trayecto ][ "observaciones" ] .= "\n";
						}
						$tablaConceptos[ $trayecto ][ "observaciones" ] .= nl2br($producto->getCaObservaciones());
					}

				}else{
					$tablaTrayectos[ $concepto->getCaIdconcepto() ][ $trayecto ] .= $contenido;
				}
			}
		endif;
	endforeach;

	$conceptos1 = array_unique( $conceptos1 );
	$trayectos1 = array_unique( $trayectos1 );
	$conceptos2 = array_unique( $conceptos2 );
	$trayectos2 = array_unique( $trayectos2 );

	$pdf->SetFont($font,'',7);
	if( count($tablaConceptos)>0 ){
		if( $i++!=0 ){
			$pdf->Ln(4);
			$pdf->beginGroup();
		}
		$conceptos = Doctrine::getTable("Concepto")
                               ->createQuery("c")
                               ->whereIn("c.ca_idconcepto", $conceptos1 )
                               ->addOrderBy("c.ca_liminferior")
                               ->addOrderBy("c.ca_concepto")
                               ->execute();

		$titulos =  array("Trayecto")  ;
		foreach( $conceptos as $concepto ){
			array_push( $titulos, $concepto->getCaConcepto() );
		}

		$titulos[] = "Obs.";
		$width = 150/(count($conceptos)+1);
		$widths = array_merge(array(20), array_fill(0, count($titulos), $width) );
		$widths[]=27;
		$pdf->SetStyles(array_fill(0, count($titulos)+1, "B"));
		$pdf->SetFills(array_fill(0, count($titulos)+1, 1));
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($titulos)+1, "C"));
		$pdf->Row( $titulos );

		$pdf->SetStyles( array_merge(array("B"), array_fill(0, count($titulos), "")));
		$pdf->SetFills( array_merge( array_fill(0, count($titulos)+1, 0)));
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($titulos)+1, "C"));
		foreach( $trayectos1 as $trayecto  ){
			$row = array($trayecto);
			foreach( $conceptos as $concepto){
				if( isset($tablaConceptos[$trayecto][$concepto->getCaIdconcepto()]) ){
					$row[$concepto->getCaConcepto()]=	$tablaConceptos[$trayecto][$concepto->getCaIdconcepto()];
				}else{
					$row[$concepto->getCaConcepto()]=	" ";
				}
			}
			$row["Observaciones"]=$tablaConceptos[$trayecto]["observaciones"];

			$pdf->Row($row);
		}
		$pdf->flushGroup();

		if( count($recargosGenConcepto)>0 ){
			$imprimirObservaciones=false;
			foreach( $recargosGenConcepto as $recargo ){
				if( $recargo->getCaObservaciones() ){
					$imprimirObservaciones=true;
				}
			}
			$pdf->beginGroup();
			$pdf->Ln(2);
			$pdf->SetFont($font,'B',8);
			$pdf->Cell(0, 4, 'RECARGOS EN ORIGEN ', 0, 1, 'L', 0);
			$pdf->Ln(2);
			$pdf->SetFont($font,'',7);

			$titu_mem= array('Concepto',  'Tarifa' );
			if( $imprimirObservaciones ){
				array_push( $titu_mem, 'Observaciones' );
				$width_mem= array(55, 53, 62);
			}else{
				$width_mem= array(80, 90);
			}
			$pdf->SetWidths($width_mem);
			$pdf->SetAligns(array_fill(0, count($width_mem), "C"));
			$pdf->SetStyles(array_fill(0, count($width_mem), "B"));
			$pdf->SetFills(array_fill(0, count($width_mem), 1));
			$pdf->Row($titu_mem);

			$pdf->SetAligns(array_fill(0, count($width_mem), "L"));
			$pdf->SetStyles(array_fill(0, count($width_mem), ""));
			$pdf->SetFills(array_fill(0, count($width_mem), 0));

			foreach( $recargosGenConcepto as $recargo ){
				$row = array( $recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa() );
				if( $imprimirObservaciones ){
					array_push( $row,  $recargo->getCaObservaciones() );
				}
				$pdf->Row($row);
			}
			$pdf->Ln(2);
			$pdf->flushGroup();
		}
	}

	if( count($tablaTrayectos)>0 ){
		if( $i++!=0 ){
			$pdf->Ln(4);
			$pdf->beginGroup();
		}

		$conceptos = Doctrine::getTable("Concepto")
                               ->createQuery("c")
                               ->whereIn("c.ca_idconcepto", $conceptos2)
                               ->addOrderBy("c.ca_liminferior")
                               ->addOrderBy("c.ca_concepto")
                               ->execute();

		$titulos = array_merge( array("Concepto\n "),   $trayectos2);
		$width = 145/count($trayectos2);
		$widths = array_merge(array(25), array_fill(0, count($trayectos2), $width) );

		$pdf->SetStyles(array_fill(0, count($trayectos2)+1, "B"));
		$pdf->SetFills(array_fill(0, count($trayectos2)+1, 1));
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($trayectos2)+1, "C"));
		$pdf->Row( $titulos );

		$pdf->SetStyles( array_merge(array("B"), array_fill(0, count($trayectos2), "")));
		$pdf->SetFills( array_merge( array_fill(0, count($trayectos2)+1, 0)));
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($trayectos2)+1, "C"));
		foreach( $conceptos as $concepto  ){
			$row = array( $concepto->getCaConcepto() );
			foreach( $trayectos2 as $trayecto){
				if( isset($tablaTrayectos[$concepto->getCaIdconcepto()][$trayecto]) ){
					$row[$trayecto] =	$tablaTrayectos[$concepto->getCaIdconcepto()][$trayecto];
				}else{
					$row[$trayecto] =	" ";
				}
			}
			$pdf->Row($row);
		}
		$pdf->flushGroup();

		if( count($recargosGenTrayecto)>0 ){
			$imprimirObservaciones=false;
			foreach( $recargosGenTrayecto as $recargo ){
				if( $recargo->getCaObservaciones() ){
					$imprimirObservaciones=true;
				}
			}
			$pdf->beginGroup();
			$pdf->Ln(2);
			$pdf->SetFont($font,'B',8);
			$pdf->Cell(0, 4, 'RECARGOS EN ORIGEN ', 0, 1, 'L', 0);
			$pdf->Ln(2);
			$pdf->SetFont($font,'',7);

			$titu_mem= array('Concepto',  'Tarifa' );
			if( $imprimirObservaciones ){
				array_push( $titu_mem, 'Observaciones' );
				$width_mem= array(55, 53, 62);
			}else{
				$width_mem= array(80, 90);
			}

			$pdf->SetWidths($width_mem);
			$pdf->SetAligns(array_fill(0, count($width_mem), "C"));
			$pdf->SetStyles(array_fill(0, count($width_mem), "B"));
			$pdf->SetFills(array_fill(0, count($width_mem), 1));
			$pdf->Row($titu_mem);

			$pdf->SetAligns(array_fill(0, count($width_mem), "L"));
			$pdf->SetStyles(array_fill(0, count($width_mem), ""));
			$pdf->SetFills(array_fill(0, count($width_mem), 0));

			foreach( $recargosGenTrayecto as $recargo ){
				$row = array( $recargo->getTipoRecargo()->getCaRecargo(), $recargo->getTextoTarifa() );
				if( $imprimirObservaciones ){
					array_push( $row,  $recargo->getCaObservaciones() );
				}
				$pdf->Row($row);
			}
			$pdf->Ln(2);
			$pdf->flushGroup();
		}
	}

    $grupos = array();
    $rows =  Doctrine_Query::create()
                    ->select("p.ca_transporte, p.ca_modalidad")
                    ->from("CotProducto p")
                    ->where("p.ca_idcotizacion = ?  ", array($cotizacion->getCaIdcotizacion()) )
                    ->addOrderBy("p.ca_transporte")
                    ->addOrderBy("p.ca_modalidad")
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->execute();


    foreach ( $rows as $row ) {
        $grupos[$row["ca_transporte"]][]=$row["ca_modalidad"];
        $grupos[$row["ca_transporte"]] = array_unique( $grupos[$row["ca_transporte"]] );
    }


	if( !isset($transportes[$k+1]) || $transporte!=$transportes[$k+1] ){
        //echo "..:";
		// ======================== Recargos Locales ======================== //

		foreach( $grupos as $key => $grupo ){
            //echo $key." - ".$transporte;
            if($transporte=="DTA" || $transporte=="OTM" )
            {
                $transporte=constantes::OTMDTA;
            }
			if( $key!=$transporte ){
//                if($key!=constantes::OTMDTA && $transporte!="OTM" )
				continue;
			}
            
			foreach( $grupo as $modalidad ){
				$recargosLoc = $cotizacion->getRecargosLocales($key, $modalidad); 
				if( count($recargosLoc)>0 ){
					$imprimirObservaciones=false;
					foreach( $recargosLoc as $recargo ){
						if( $recargo->getCaObservaciones() ){
							$imprimirObservaciones=true;
						}
					}

					$pdf->beginGroup();
					$pdf->Ln(4);
					$pdf->SetFont($font,'B',8);
					$pdf->Cell(0, 4, 'RECARGOS LOCALES '.strtoupper($key).' '.strtoupper($modalidad), 0, 1, 'L', 0);
					$pdf->Ln(2);
					$pdf->SetFont($font,'',7);

					$titu_mem= array('Concepto',  'Tarifa' );
					if( $imprimirObservaciones ){
						array_push( $titu_mem, 'Observaciones' );
						$width_mem= array(55, 53, 62);
					}else{
						$width_mem= array(80, 90);
					}
					$pdf->SetWidths($width_mem);
					$pdf->SetAligns(array_fill(0, count($width_mem), "C"));
					$pdf->SetStyles(array_fill(0, count($width_mem), "B"));
					$pdf->SetFills(array_fill(0, count($width_mem), 1));
					$pdf->Row($titu_mem);

					$pdf->SetAligns(array_fill(0, count($width_mem), "L"));
					$pdf->SetStyles(array_fill(0, count($width_mem), ""));
					$pdf->SetFills(array_fill(0, count($width_mem), 0));

					foreach( $recargosLoc as $recargo ){
                        $txt = $recargo->getTipoRecargo()->getCaRecargo();
                        if( $recargo->getCaIdconcepto() && $recargo->getCaIdconcepto()!=9999 ){
                            $txt.=" ".$recargo->getConcepto()->getCaConcepto();
                        }
						$row = array( $txt, $recargo->getTextoTarifa() );
						if( $imprimirObservaciones ){
							array_push( $row,  $recargo->getCaObservaciones() );
						}
						$pdf->Row($row);
					}
					$pdf->flushGroup();
				}
			}
		}
	}

endfor; //transportes

$pdf->beginGroup();
$pdf->SetFont($font,'B',8);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, "Nota Importante: En caso de aceptaci�n de la presente oferta de servicios se entender� le�do y aceptado el contrato de agenciamiento de carga que se encuentra en la p�gina web www.coltrans.com.co y que regir� nuestra relaci�n comercial.", 0,'J',0);
if( $comodato ){
    $pdf->MultiCell(0, 4, "Cesa laobligaci�n de demoras de contenedor una vez est� sea entregado en el Patio o lugar de entrega de vacios designado por la Naviera.", 0,'J',0);
}
$pdf->Ln(2);
$pdf->flushGroup();

// ======================== Continuaci�n de viaje ======================== //
if(in_array("OTM",$transportes) || in_array("DTA",$transportes))
{
$pdf->beginGroup();
    $pdf->Ln(2);
    $pdf->MultiCell(0, 4, "Nota Importante: Es responsabilidad del importador, los perjuicios a que haya lugar como consecuencia de inexactitudes o errores en la documentaci�n suministrada, as� como de las sanciones resultado de requerimientos aduaneros por faltantes o sobrantes.

La Poliza del Importador deber� incluir los tributos aduaneros. El OTM no se hace responsable por el pago de tributos aduaneros a la DIAN, la p�liza de tributos aduanero s�lo cumple la funci�n de garant�a a la DIAN. Los pagos por tr�butos aduaneros deber�n ser asumidos por el importador y reclamados a su compa��a de seguros para ser pagados a la DIAN.", 0,'J',0);


	$pdf->flushGroup();
}



// ======================== Seguros ======================== //
$seguros = $cotizacion->getCotSeguros();
$imprimirObservaciones = false;

foreach( $seguros as $seguro ){
	if( $seguro->getCaObservaciones() ){
		$imprimirObservaciones = true;
		break;
	}
}

if ( count($seguros)>0 ) {

	$imprimirNotas[]="seguro";
	//Control impresi�n
	$pdf->beginGroup();

	$pdf->Ln(4);
	$pdf->SetFont($font,'B',9);
	$pdf->Cell(0, 4, 'SEGURO INTERNACIONAL', 0, 1, 'L', 0);
	$pdf->SetFont($font,'',9);
	$pdf->Ln(2);
	$i = 1;
	$linea = "";

	$pdf->Ln(2);
	$pdf->SetFont($font,'',7);

	$titu_mem= array('Transporte', 'Prima',  'Tarifa M�nima' , 'Obtenci�n de la P�liza');
	if( $imprimirObservaciones ){
		array_push( $titu_mem, 'Observaciones' );
		$width_mem= array(20, 45, 35, 35, 35);
	}else{
		$width_mem= array(20, 45, 35, 70);
	}
	$pdf->SetWidths($width_mem);
	$pdf->SetAligns(array_fill(0, count($width_mem), "C"));
	$pdf->SetStyles(array_fill(0, count($width_mem), "B"));
	$pdf->SetFills(array_fill(0, count($width_mem), 1));
	$pdf->Row($titu_mem);
	foreach( $seguros as $seguro ){
		$pdf->SetAligns(array_fill(0, count($width_mem), "L"));
		$pdf->SetStyles(array_fill(0, count($width_mem), ""));
		$pdf->SetFills(array_fill(0, count($width_mem), 0));
		$row = array(
					$seguro->getCaTransporte(),
					(($seguro->getCaPrimaTip()=="%")?Utils::formatNumber($seguro->getCaPrimaVlr())." ".$seguro->getCaPrimaTip():$seguro->getCaIdmoneda()." ".Utils::formatNumber($seguro->getCaPrimaVlr()))." sobre valor asegurado"
					 ,
					($seguro->getCaPrimaMin()!=0)?$seguro->getCaIdmoneda()." ".Utils::formatNumber($seguro->getCaPrimaMin()):" "
					,
					($seguro->getCaObtencion()!=0)?$seguro->getCaIdmoneda()." ".Utils::formatNumber($seguro->getCaObtencion()):""

		 );
		if( $imprimirObservaciones ){
			array_push( $row,  $seguro->getCaObservaciones() );
		}
		$pdf->Row($row);
	}
	$pdf->flushGroup();
}
// ======================== Directorio de agentes ======================== //
$datosAg = array();

$contactosAgente = $cotizacion->getContactosAgente();

if( count($contactosAgente)>0 ){
    $pdf->beginGroup();
    $pdf->Ln(2);
    $pdf->SetFont($font,'B',9);
    $pdf->MultiCell(0, 4, "DIRECTORIO DE AGENTES", 0,'L',0);

    $pdf->Ln(4);
    $pdf->SetFont($font,'',9);

    if( count($contactosAgente)==1 ){
        $pdf->MultiCell(0, 4, 'A continuaci�n relacionamos los datos de nuestro agente encargado de coordinar los despachos:',0,1);
        $imprimiotitulo = true;
    }else{
        $pdf->MultiCell(0, 4, 'A continuaci�n relacionamos los datos de nuestros agentes encargados de coordinar los despachos:',0,1);
        $imprimiotitulo = true;
    }
    $pdf->Ln(2);
    $idagente = "";
    $idtrafico = "";
    foreach( $contactosAgente as $contacto ){
        $idsSucursal= $contacto->getIdsSucursal();
        $agente = $idsSucursal->getIds();
        $ciudad = $idsSucursal->getCiudad();

        if( !$imprimiotitulo ){
            $pdf->beginGroup();
        }

        if( $idtrafico!=$ciudad->getCaIdtrafico() ){
            $idtrafico=$ciudad->getCaIdtrafico();
            $trafico = $ciudad->getTrafico();
            $pdf->Ln(1);
            $pdf->SetFont($font,'B',10);
            $pdf->MultiCell(0, 3, '� '.$trafico->getCaNombre().' �',0,1);
            $pdf->Ln(2);
        }

        if( $idagente != $agente->getCaId() ){
            $idagente = $agente->getCaId();

            $pdf->SetFont($font,'B',8);
            $pdf->MultiCell(0, 3,$agente->getCaNombre(),0,1);
            $pdf->SetFont($font,'',8);
            $pdf->Ln(2);
            $pdf->MultiCell(0, 3,"Contactos :",0,1);
        }
        $pdf->SetFont($font,'B',8);
        $pdf->MultiCell(0, 3,$contacto->getNombre(),0,1);
        $pdf->SetFont($font,'',8);
        $pdf->MultiCell(0, 3,$contacto->getCaDireccion()." - ".$ciudad->getCaCiudad(),0,1);
        $pdf->MultiCell(0, 3,"Tel�fonos (".substr(strtoupper($ciudad->getTrafico()  ->getCodigoarea()),3,3)." - ".substr(strtoupper($contacto->getCodigoArea() ),4,4).") : ".$contacto->getCaTelefonos()." - Fax : ".$contacto->getCaFax(),0,1);
        $pdf->MultiCell(0, 3,"Correo Electr�nico :".$contacto->getCaEmail(),0,1);
        $pdf->MultiCell(0, 3,"Operaci�n :".str_replace("|",", ", $contacto->getCaTransporte()),0,1);

        $pdf->flushGroup();
        $pdf->Ln(2);
        $imprimiotitulo = false;
    }
}

$pdf->SetFont($font,'',10);
//Hace que el titulo tenga por lo menos 2 renglones
if( $pdf->GetY()>$pdf->PageBreakTrigger-15 ){
	$pdf->AddPage();
}else{
	$pdf->Ln(4);
}
$pdf->MultiCell(0, 4, $cotizacion->getCaDespedida(),0,1);

$pdf->beginGroup();
$pdf->Ln(4);
$pdf->MultiCell(0, 4, 'Cordialmente,',0,1);


$pdf->Ln(10);
$pdf->SetFont($font,'B',10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaNombre()),0,1);
$pdf->SetFont($font,'',10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaCargo()),0,1);
$pdf->MultiCell(0, 4, strtoupper($empresa->getCaNombre()),0,1);
$pdf->MultiCell(0, 4, $sucursal->getCaDireccion(),0,1);
$pdf->MultiCell(0, 4, "Tel.:".$sucursal->getCaTelefono()." ".$usuario->getCaExtension(),0,1);
$pdf->MultiCell(0, 4, "Fax :".$sucursal->getCaFax(),0,1);

$pdf->MultiCell(0, 4, $sucursal->getCaNombre()." - ".$empresa->getTrafico()->getCaNombre(),0,1);
$pdf->MultiCell(0, 4, $usuario->getCaEmail(),0,1);
$pdf->MultiCell(0, 4, $empresa->getCaUrl(),0,1);

if ($cotizacion->getCaAnexos() != '' &&  $empresa->getCaIdempresa()==1) {
	$pdf->Ln(6);
	$pdf->MultiCell(0, 4, "Anexo: ".$cotizacion->getCaAnexos(),0,1);
}
$pdf->flushGroup();

// ======================== Notas ======================== //

if( $empresa->getCaIdempresa()==2 ){
    $imprimirNotas = array_unique( $imprimirNotas );

    $nuevaPagina = false;

    foreach($imprimirNotas as $val ) {
        if(!$nuevaPagina){
            $pdf->AddPage();
            $nuevaPagina=true;
        }

        //Hace que el titulo tenga por lo menos 2 renglones
        if( $pdf->GetY()>$pdf->PageBreakTrigger-15 ){
            $pdf->AddPage();
        }else{
            $pdf->Ln(2);
        }

        $pdf->SetFont($font,'B',9);
        $pdf->MultiCell(0, 4, $notas[$val."Titulo"], 0,'C',0);
        $pdf->Ln(1);
        $pdf->SetFont($font,'',8);
        $pdf->MultiCell(0, 4, $notas[$val], 0,'J',0);
    }
}

// ======================== Notas adicionales ======================== //

if( $empresa->getCaIdempresa()==2 ){
    $pdf->AddPage();
    $pdf->Ln(4);
    $pdf->SetFont($font,'B',14);
    $pdf->Cell(0, 4, "CIRCULAR EXTERNA NO. 001",0,1, "C");

    $pdf->Ln(4);
    $pdf->SetFont($font,'',10);
    $pdf->Cell(0, 4, "27 de Abril de 2009",0,1);

    $pdf->Ln(10);
    $pdf->SetFont($font,'',10);
    $pdf->Cell(0, 4, "Apreciados Clientes,",0,1);
    $pdf->Ln(15);
    $pdf->MultiCell(0, 5, "La presente es con el fin de  informarles las nuevas disposiciones  Aduaneras en el Marco Legal actual que es el Decreto 2101 del 13 de Junio de 2008 , Decreto 1039 del 26 de Marzo 2009 y la Resoluci�n No. 7941 del 26 de Agosto de 2008, Resoluci�n 3942 del 17 de Abril de 2009  en donde se modifica tr�mites semiautomatizados a procedimientos totalmente automatizados sin uso del papel en el Proceso de Importaci�n Mar�tima, se tuvieron en cuenta lineamientos internacionales como el Marco Normativo de la OMA y acuerdos que en la actualidad Colombia est� negociando.", 0,'J',0);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 5, "Por lo anterior a partir del 1o. de Mayo 2009 es indispensable que los documentos de transporte contengan como m�nimo la siguiente informaci�n: ", 0,'J',0);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 5,
    " RUT ( Registro �nico Tributario)  del Importador
      La indicaci�n del Tr�mite o destino que se le dar� a la mercanc�a una vez descargada en el lugar de llegada, ejemplo:
         -   Entrega en lugar de arribo
         -   Transito Aduanero
         -   Ingreso a dep�sito o Zona Franca despu�s del descargue en el lugar de arribo
         -   Descargue de mercanc�a directamente en el dep�sito o zona franca
         -   Entrega Urgente
      Descripci�n  gen�rica de la mercanc�a ;  NO es aceptada como descripci�n \" mercanc�as varias, mercanc�a seg�n factura , miscel�neas.. \"
      La DIAN tendr� la potestad de establecer en que eventos es necesario las partidas o  sub-partidas arancelarias de la mercanc�a   por acto oficial, como lo estipula en el Decreto 2101 art. 8 y la Resoluci�n 7941 art 8 , hasta la fecha no se ha pronunciado la Aduana con los productos susceptibles del anterior requerimiento
      Peso,  unidades de carga.  Cuando se trate de carga contenerizada es necesario el n�mero de seguridad o precinto", 0,'J',0);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 5, "Es recomendable que la informaci�n  descrita sea de conocimiento de los Exportadores, para el momento de la elaboraci�n de los documentos de transporte. ", 0,'J',0);
    $pdf->Ln(15);
    $pdf->Cell(0, 4, "Atentamente,",0,1);
    $pdf->Ln(10);
    $pdf->Cell(0, 4, sfConfig::get('app_branding_name1'),0,1);
    $pdf->Ln(4);
    $pdf->Cell(0, 4, "DEPARTAMENTO MARITIMO",0,1);
    $pdf->AddPage();
    // Ticket # 1811
    $pdf->Ln(4);
    $pdf->SetFont($font,'B',14);
    $pdf->Cell(0, 4, "CIRCULAR 0170",0,1, "C");
    $pdf->Ln(15);
    $pdf->SetFont($font,'',14);
    $pdf->MultiCell(0, 5,
    "Los Agentes de Carga Internacional  y Agencias de Aduana debemos adoptar las medidas necesarias para prevenci�n  y control al lavado de activos. As� mismo, establecer mecanismos de control orientados a seleccionar y conocer los clientes acerca lo personal, financiero y comercial. Dentro de estas medidas existe una herramienta para el conocimiento del cliente que es la aplicaci�n de la Circular 0170 exigida por la DIAN

    Algunos de estos mecanismos de prevenci�n y control del lavado de activos que la DIAN instruye ayudan a identificar las operaciones sospechosas y as� mismo controlar los indicios que permite detectar la realizaci�n de una operaci�n  inusual.

    Nos es muy grato ofrecer los servicios de nuestra empresa, para contribuir con el buen servicio los invitamos a diligenciar la Circular 0170 de manera sincera y oportuna.
     ", 0,'J',0);
    $pdf->Ln(2);
}

$pdf->Output ( $filename );

if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}
?>
