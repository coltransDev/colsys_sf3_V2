<?



$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");




$pdf = new PDF (  );
$pdf->Open ();  
$pdf->setColtransHeader ( true );
$pdf->setColtransFooter ( true );
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);


switch( $cotizacion->getCafuente()){
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
$pdf->SetSucursal($sucursal->getCaIdSucursal());
//$pdf->SetLineRepeat("Se�ores: ".strtoupper($cliente->getCaCompania()."    ".$cotizacion->getCaFchcreado()));
$pdf->Ln(5);
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($cotizacion->getCaFchcreado(),"%d-%d-%d %d:%d:%d");

$pdf->Cell(0, 4, str_replace(' D.C.','',$usuario->getCaSucursal()).', '.$dia.' de '.$meses[$mes-1].' de '.$anno,0,1);




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
$pdf->Ln(8);
$pdf->Cell(0, 4, 'Asunto : '.$cotizacion->getCaAsunto()." ".$cotizacion->getCaConsecutivo(),0,1);
//    $pdf->Cell(0, 0, 'Comunicaci�n No. '.$rs->Value('ca_idcotizacion').'/'.$rs->Value('ca_usuario').str_pad(" ",7),0,0,'R');

if($cotizacion->getCaUsuanulado()){
	$pdf->SetTextColor(128,128,128);	
	$pdf->SetFont($font,'B',68);
	$pdf->Write(5,'A N U L A D O ');
	$pdf->SetTextColor(0,0,0);
}


$pdf->SetFont($font,'',10);
$pdf->Ln(4);
$pdf->Cell(0, 4, $cotizacion->getCaSaludo(),0,1);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, $cotizacion->getCaEntrada(),0,1);

$c = new Criteria();
$c->addAscendingOrderByColumn( CotProductoPeer::CA_TRANSPORTE );
$productos = $cotizacion->getCotProductos( $c );


$transportes = array();
//Busca todos los medios de transporte 
foreach( $productos as $producto ){
	if(!in_array($producto->getCaTransporte(), $transportes) ){
		$transportes[] = $producto->getCaTransporte(); 
	}
}


for( $k=0; $k<count($transportes); $k++ ): 
	$transporte = $transportes[$k];

	$tabla = array();
	$i=0;
	
	$pdf->beginGroup();
	
	$pdf->Ln(4);
	$pdf->SetFont($font,'B',9);
	$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL '.strtoupper($transporte), 0, 1, 'L');
	$pdf->Ln(2);
	$age_imp = true;
	$pdf->SetFont($font,'B',9);
	
	foreach( $productos as $producto ):
		if( $producto->getCaTransporte()!=$transporte ){
			continue;
		} 
			
		$imprimirObservaciones = false;
		$imprimirRecargos = false;
		if ($producto->getCaImpoExpo()==Constantes::IMPO){	
			$imprimirNotas[]="anexoImpo";
		}
		if ($producto->getCaImpoExpo()==Constantes::EXPO){	
			$imprimirNotas[]="anexoExpo";
		}
		
		// ======================== Impresi�n por Item ======================== //
		if ($producto->getCaImprimir() == 'Por Item'):
			// Control Impresi�n
			
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
			
			$pdf->SetFont($font,'B',8);
			$pdf->SetWidths(array(40, 40, 45, 45));
			$pdf->SetAligns(array_fill(0, 5, "C"));
			$pdf->SetStyles(array_fill(0, 5, "B"));
			$pdf->SetFills(array_fill(0, 5, 1));
			$pdf->Row(array('Impo/Expo', 'T�rminos' ,'Origen', 'Destino'));
					
			$pdf->SetStyles(array_fill(0, 5, ""));
			$pdf->SetFills(array_fill(0, 5, 0));
			$pdf->SetFont($font,'',8);
			$pdf->Row(array($producto->getCaImpoExpo(), $producto->getCaIncoterms(), $producto->getOrigen()->getCaCiudad()." - ".$producto->getOrigen()->getCaTrafico(),  $producto->getDestino()->getCaCiudad()." - ".$producto->getDestino()->getCaTrafico() ));		
			
			if( $linea && $producto->getCaPostularLinea()){
				$pdf->SetFont($font,'',8);
				$pdf->SetWidths(array(170));
				$pdf->SetAligns(array_fill(0, 3, "L"));
				$pdf->Row(array(($producto->getCaTransporte()==Constantes::AEREO?"A�rolinea: ":"Linea: ").$linea->getCaNombre()));			
			}
			
			$c = new Criteria();
			$c->addJoin( CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO );
			$c->addAscendingOrderByColumn( ConceptoPeer::CA_LIMINFERIOR );
			$opciones = $producto->getCotOpciones( $c );
			
			foreach( $opciones as $opcion ){
				$textoRecargos = $opcion->getTextoRecargos();		
				$concepto = $opcion->getConcepto();					
							
				$tabla[$opcion->getCaIdOpcion()]["flete"] = $concepto->getCaConcepto();
				$tabla[$opcion->getCaIdOpcion()]["tarifas"] = $opcion->getTextoFlete()."\n"; 
				if( $textoRecargos ){
					$tabla[$opcion->getCaIdOpcion()]["recargos"] = $textoRecargos;				
					$imprimirRecargos = true;				
				}
				if( $opcion->getCaObservaciones() ){
					$tabla[$opcion->getCaIdOpcion()]["observaciones"] = $opcion->getCaObservaciones();
					$imprimirObservaciones = true;
				}
			}	
			
						
			
				
			//Imprime los detalles de la tabla (Opciones)
			if( count($tabla)>0 ){
				
				$pdf->Ln(2);
				$titulos = array('Concepto', 'Tarifas');
				
				if ($imprimirRecargos){
					array_push($titulos, "Recargos por Flete");
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
				$pdf->Row($titulos);
				
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
				
				foreach( $recargosGen as $recargo ){
					$row = array( $recargo->getTiporecargo()->getCarecargo(), $recargo->getTextoTarifa() );
					if( $imprimirObservaciones ){
						array_push( $row,  $recargo->getCaObservaciones() );
					}
					$pdf->Row($row);
				}
				$pdf->Ln(2);
				$pdf->flushGroup(); 
			}
				
			//Imprime el tiempo de transito
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
			
			$c = new Criteria();
			$c->addJoin( CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO );
			$c->addAscendingOrderByColumn( ConceptoPeer::CA_LIMINFERIOR );
			$opciones = $producto->getCotOpciones( $c );		
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();		
				if ( isset($tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()]) ){
					$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].= str_repeat("..-..", 12)."\n";
				}else{
					$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()]="";
				}
				
				$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].=$concepto->getCaConcepto()." - ".substr($producto->getCaIncoterms(),0,3);
				
				$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].=$opcion->getTextoFlete()."\n";
				
				$textoRecargos = $opcion->getTextoRecargos();		
				$tabla[$producto->getOrigen()->getCaCiudad()][$producto->getDestino()->getCaCiudad()].=$textoRecargos;	
				
			}	
			
			$recgen = $producto->getRecargosGenerales();
			if( $recgen ){
				$recargosGenPuerto = array_merge( $recargosGenPuerto , $recgen );	
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
				$row = array( $recargo->getTiporecargo()->getCarecargo(), $recargo->getTextoTarifa() );
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
			
			$c = new Criteria();
			$c->addJoin( CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO );
			$c->addAscendingOrderByColumn( ConceptoPeer::CA_LIMINFERIOR );
			$opciones = $producto->getCotOpciones( $c );		
			$trayecto = $producto->getOrigen()->getCaCiudad()."\n".$producto->getDestino()->getCaCiudad();
			if ($producto->getCaImprimir() == 'Concepto' ){		
				$trayectos1[] = $trayecto;
				$recgen = $producto->getRecargosGenerales();
				if( $recgen ){
					$recargosGenConcepto = array_merge( $recargosGenConcepto , $recgen );
				}
				
			}else{
				$recgen = $producto->getRecargosGenerales();
				if( $recgen ){
					$recargosGenTrayecto = array_merge( $recargosGenTrayecto , $recgen );
				}
				$trayectos2[] = $trayecto;
			}
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();	
				if ($producto->getCaImprimir() == 'Concepto' ){		
					$conceptos1[  ] = $concepto->getCaIdConcepto();
				}else{
					$conceptos2[  ] = $concepto->getCaIdConcepto();
				}
				$contenido="";
				
				$concepto = $opcion->getConcepto();		
				if ($producto->getCaImprimir() == 'Concepto' ){	
					if ( isset($tablaConceptos[ $trayecto ][ $concepto->getCaConcepto() ]) ){
						$tablaConceptos[ $trayecto ][ $concepto->getCaIdConcepto() ].= str_repeat("..-..", 12)."\n";
					}else{
						$tablaConceptos[ $trayecto ][ $concepto->getCaIdConcepto() ]="";
					}
				}else{			
					if ( isset($tablaTrayectos[ $concepto->getCaConcepto() ][ $trayecto ]) ){
						$tablaTrayectos[ $concepto->getCaIdConcepto() ][ $trayecto ].= str_repeat("..-..", 12)."\n";
					}else{
						$tablaTrayectos[ $concepto->getCaIdConcepto() ][ $trayecto ]="";
					}
				}
				
				if( $producto->getCaIncoterms() ){			
					$contenido.= substr($producto->getCaIncoterms(),0,3)."\n";
				}
				
				$contenido.=$opcion->getTextoFlete()."\n";
				
				$textoRecargos = $opcion->getTextoRecargos();		
				$contenido.=$textoRecargos;
				if ($producto->getCaImprimir() == 'Concepto' ){	
					$tablaConceptos[ $trayecto ][ $concepto->getCaIdConcepto() ] .= $contenido;
				}else{
					$tablaTrayectos[ $concepto->getCaIdConcepto() ][ $trayecto ] .= $contenido;
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
	
		$c = new Criteria();
		$c->add(  ConceptoPeer::CA_IDCONCEPTO, $conceptos1, Criteria::IN );
		$c->addAscendingOrderByColumn( ConceptoPeer::CA_LIMINFERIOR );
		$conceptos = ConceptoPeer::doSelect( $c );
		
		$titulos =  array("Trayecto")  ;	
		foreach( $conceptos as $concepto ){
			array_push( $titulos, $concepto->getCaConcepto() );	
		}
		$width = 145/count($conceptos);	
		$widths = array_merge(array(25), array_fill(0, count($conceptos), $width) );
		
		$pdf->SetStyles(array_fill(0, count($conceptos)+1, "B"));
		$pdf->SetFills(array_fill(0, count($conceptos)+1, 1));	
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($conceptos)+1, "C"));
		$pdf->Row( $titulos );	
		
		$pdf->SetStyles( array_merge(array("B"), array_fill(0, count($conceptos), "")));
		$pdf->SetFills( array_merge( array_fill(0, count($conceptos)+1, 0)));	
		$pdf->SetWidths( $widths );
		$pdf->SetAligns(array_fill(0, count($conceptos)+1, "C"));
		foreach( $trayectos1 as $trayecto  ){
			$row = array($trayecto);
			foreach( $conceptos as $concepto){
				if( isset($tablaConceptos[$trayecto][$concepto->getCaIdconcepto()]) ){
					$row[$concepto->getCaConcepto()]=	$tablaConceptos[$trayecto][$concepto->getCaIdconcepto()];		
				}else{
					$row[$concepto->getCaConcepto()]=	" ";		
				}
			}	
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
				$row = array( $recargo->getTiporecargo()->getCarecargo(), $recargo->getTextoTarifa() );
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
	
		$c = new Criteria();
		$c->add(  ConceptoPeer::CA_IDCONCEPTO, $conceptos2, Criteria::IN );
		$c->addAscendingOrderByColumn( ConceptoPeer::CA_LIMINFERIOR );
		$conceptos = ConceptoPeer::doSelect( $c );
			
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
				$row = array( $recargo->getTiporecargo()->getCarecargo(), $recargo->getTextoTarifa() );
				if( $imprimirObservaciones ){
					array_push( $row,  $recargo->getCaObservaciones() );
				}
				$pdf->Row($row);
			}
			$pdf->Ln(2);
			$pdf->flushGroup(); 
		}
	}	
	
	if( !isset($transportes[$k+1]) || $transporte!=$transportes[$k+1] ){
		// ======================== Recargos Locales ======================== //


		foreach( $grupos as $key => $grupo ){
			if( $key!=$transporte ){
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
						$row = array( $recargo->getTiporecargo()->getCarecargo(), $recargo->getTextoTarifa() );
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


// ======================== Continuaci�n de viaje ======================== //
$c = new Criteria();
$c->addAscendingOrderByColumn( CotContinuacionPeer::CA_TIPO );
$c->addAscendingOrderByColumn( CotContinuacionPeer::CA_MODALIDAD );
$c->addAscendingOrderByColumn( CotContinuacionPeer::CA_ORIGEN );
$c->addAscendingOrderByColumn( CotContinuacionPeer::CA_DESTINO );
$c->addAscendingOrderByColumn( CotContinuacionPeer::CA_TARIFA );
$continuaciones = $cotizacion->getCotContinuacions( $c );




if(count($continuaciones)>0){
	
	$imprimirtitulo=true;	
	
	$tipo = "";
	$imprimirObservaciones = array();
	
	foreach( $continuaciones as $continuacion ){ 
		if( !isset($imprimirObservaciones[$continuacion->getCaTipo()]) ){
			$imprimirObservaciones[$continuacion->getCaTipo()]=false;
		}
		
		if( $continuacion->getCaObservaciones() ){
			$imprimirObservaciones[$continuacion->getCaTipo()]=true;
		}
	}	
	
	$numContinuaciones = count( $continuaciones );
	for( $i=0; $i<$numContinuaciones; $i++ ){ 
		$continuacion = $continuaciones[$i];
		
		$imprimirNotas[]="anexoImpo";
		$imprimirNotas[]="OTM_".$continuacion->getCaModalidad();		
		if( $tipo!=$continuacion->getCaTipo() ){			
			
			
			$imprimiotitulo=false;
			if( $imprimirtitulo ){ // Se hace de esta manera para mantener el grupo 
				$pdf->beginGroup(); 
				$pdf->Ln(4);				
				$pdf->SetFont($font,'B',9);
				$pdf->Cell(0, 4, 'SERVICIO DE CONTINUACI�N DE VIAJE', 0, 1, 'L', 0);	
				$pdf->SetFont($font,'',7);
				$imprimirtitulo=false; 
				$imprimiotitulo=true;
			}
			
			
			if( $continuacion->getCaTipo()=="OTM" ){
				if( !$imprimiotitulo ){				
					$pdf->beginGroup();
				}
				//Control impresi�n		
				$pdf->Ln(4);						
				$pdf->SetFont($font,'B',8);			
				$pdf->Cell(0, 4, '   OTM � OPERACI�N DE TRANSPORTE MULTIMODAL', 0, 1, 'L', 0);
			}	
			
			if( $continuacion->getCaTipo()=="DTA" ){
				
				if( !$imprimiotitulo ){
					$pdf->beginGroup();
				}
				
				$pdf->Ln(4);
				$pdf->SetFont($font,'B',8);
				$pdf->Cell(0, 4, '   DTA � DECLARACI�N DE TR�NSITO ADUANERO', 0, 1, 'L', 0);				
			}	
			$pdf->SetFont($font,'',7);
			$pdf->Ln(4);
			
			$titu_mem= array('Origen', 'Destino','Mod.', 'Concepto', 'Tarifa');
			
			if( $imprimirObservaciones[$continuacion->getCaTipo()] ){
				array_push( $titu_mem, 'Observaciones' );
				$width_mem= array(20,20, 10, 50, 35, 35);
			}else{
				$width_mem= array(20,20, 10, 50, 70);
			}
			
			
			$pdf->SetWidths($width_mem);
			$pdf->SetAligns(array_fill(0, count($width_mem), "C"));
			$pdf->SetStyles(array_fill(0, count($width_mem), "B"));
			$pdf->SetFills(array_fill(0, count($width_mem), 1));
			$pdf->Row($titu_mem);
			
			$pdf->SetWidths($width_mem);
			$pdf->SetAligns(array_fill(0, count($width_mem), "L"));
			$pdf->SetStyles(array_fill(0, count($width_mem), ""));
			$pdf->SetFills(array_fill(0, count($width_mem), 0));
			
			$tipo=$continuacion->getCaTipo();
				
		}
		$row = array( $continuacion->getOrigen()->getCaCiudad(),
					  $continuacion->getDestino()->getCaCiudad(),
					  $continuacion->getCaModalidad(),
					  $continuacion->getTexto(),
					  $continuacion->getTextoTarifa()					  				 					  
				);
		
		if( $imprimirObservaciones[$continuacion->getCaTipo()] ){
			array_push( $row, $continuacion->getCaObservaciones()?$continuacion->getCaObservaciones():" ");
		}
				
		$pdf->Row( $row	);		
				
		if( !isset( $continuaciones[$i+1] ) || $continuaciones[$i+1]->getCaTipo()!=$continuacion->getCaTipo() ){
				
			//Recargos OTM - DTA 			
			$recargosLoc = $cotizacion->getRecargosOTMDTA( $tipo );
			
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
				$pdf->Cell(0, 4, 'RECARGOS' , 0, 1, 'L', 0);
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
					$row = array( $recargo->getTiporecargo()->getCarecargo(), $recargo->getTextoTarifa() );
					if( $imprimirObservaciones ){
						array_push( $row,  $recargo->getCaObservaciones() );
					}
					$pdf->Row($row);
				}
				$pdf->flushGroup(); 	
			}			
		}
	
					
	}

	$pdf->flushGroup();
}

// ======================== Seguros ======================== //


$c = new Criteria();
$c->addAscendingOrderByColumn( CotSeguroPeer::CA_TRANSPORTE );
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
if( $cotizacion->getCaDatosag() ){
	$datosAg = explode("|", $cotizacion->getCaDatosag() );
	$c = new Criteria();
	$c->addJoin( ContactoAgentePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE );
	$c->addJoin( AgentePeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );
	$c->addJoin( CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO );
	$c->add( ContactoAgentePeer::CA_IDCONTACTO, $datosAg, Criteria::IN );
	$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
	$c->addAscendingOrderByColumn( AgentePeer::CA_NOMBRE );
	$c->addAscendingOrderByColumn( ContactoAgentePeer::CA_NOMBRE );
	
	$contactosAgente = ContactoAgentePeer::doSelect( $c );
	
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
					
			$agente = $contacto->getAgente();
			$ciudad = $contacto->getCiudad();
			
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
			
			if( $idagente != $agente->getCaidAgente() ){
				$idagente = $agente->getCaidAgente();
				
				$pdf->SetFont($font,'B',8);
				$pdf->MultiCell(0, 3,$agente->getCaNombre(),0,1);
				$pdf->SetFont($font,'',8);			
				$pdf->Ln(2);
				$pdf->MultiCell(0, 3,"Contactos :",0,1);
			   
			}
					
			$pdf->SetFont($font,'B',8);
			$pdf->MultiCell(0, 3,$contacto->getCaNombre(),0,1);
			$pdf->SetFont($font,'',8);
			$pdf->MultiCell(0, 3,$contacto->getCaDireccion()." - ".$ciudad->getCaCiudad(),0,1);
			$pdf->MultiCell(0, 3,"Tel�fonos (".substr(strtoupper($ciudad->getCaIdtrafico()),3,3)." - ".substr(strtoupper($contacto->getCaIdciudad() ),4,4).") : ".$contacto->getCaTelefonos()." - Fax : ".$contacto->getCaFax(),0,1);
			$pdf->MultiCell(0, 3,"Correo Electr�nico :".$contacto->getCaEmail(),0,1);
			$pdf->MultiCell(0, 3,"Operaci�n :".str_replace("|",", ", $contacto->getCaTransporte()),0,1);
					
			$pdf->flushGroup();
			
			$pdf->Ln(2);
			
			$imprimiotitulo = false;
		}
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
$pdf->MultiCell(0, 4, "COLTRANS S.A.",0,1);
$pdf->MultiCell(0, 4, $sucursal->getCaDireccion(),0,1);
$pdf->MultiCell(0, 4, "Tel.:".$sucursal->getCaTelefono()." ".$usuario->getCaExtension(),0,1);
$pdf->MultiCell(0, 4, "Fax :".$sucursal->getCaFax(),0,1);

$pdf->MultiCell(0, 4, $sucursal->getCaNombre()." - Colombia",0,1);
$pdf->MultiCell(0, 4, $usuario->getCaEmail(),0,1);
$pdf->MultiCell(0, 4, "www.coltrans.com.co",0,1);


       
if ($cotizacion->getCaAnexos() != '') {
	$pdf->Ln(6);
	$pdf->MultiCell(0, 4, "Anexo: ".$cotizacion->getCaAnexos(),0,1);
}
$pdf->flushGroup(); 

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

	
$pdf->Output ( $filename);
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}

?>