<?

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
$trans = array("Aéreo" => "Aérea", "Marítimo" => "Marítima", "Terrestre" => "Terrestre");


$pdf = new PDF (  );
$pdf->Open ();  
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);
$pdf->SetFont('Arial','',10);

$directorioAg = array();


$sucursal = $usuario->getSucursal();
$pdf->SetSucursal($sucursal->getCaNombre());
$pdf->SetLineRepeat("Señores: ".strtoupper($cliente->getCaCompania()."    ".$cotizacion->getCaFchcotizacion()));
$pdf->Ln(5);
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($cotizacion->getCaFchcotizacion(),"%d-%d-%d %d:%d:%d");

$pdf->Cell(0, 4, str_replace(' D.C.','',$usuario->getCaSucursal()).', '.$dia.' de '.$meses[$mes-1].' de '.$anno,0,1);

$pdf->setColtransHeader ( true );
$pdf->setColtransFooter ( true );

$pdf->Ln(8);
$pdf->Cell(0, 4,$contacto->getCaSaludo(),0,1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(0, 4, strtoupper($contacto->getNombre()),0,1);
if ( $contacto->getCaCargo()!='' and $contacto->getCaDepartamento()!='') {
	$cargo = $contacto->getCaCargo()." - ".$contacto->getCaDepartamento();
} else if ($contacto->getCaCargo()!='' and $contacto->getCaDepartamento()=='') {
	$cargo = $contacto->getCaCargo();
} else if ($contacto->getCaCargo()=='' and $contacto->getCaDepartamento()!='') {
	$cargo = $contacto->getCaDepartamento();
}
if ($cargo != '') {
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0, 4, $cargo,0,1);
}

$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 4, strtoupper($cliente->getCaCompania()),0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0, 4, strtoupper($cliente->getCiudad()->getCaCiudad()) ,0,1);
$pdf->Ln(8);

$pdf->Cell(0, 4, 'Asunto : '.$cotizacion->getCaAsunto(),0,1);
//    $pdf->Cell(0, 0, 'Comunicación No. '.$rs->Value('ca_idcotizacion').'/'.$rs->Value('ca_usuario').str_pad(" ",7),0,0,'R');

$pdf->Ln(4);
$pdf->Cell(0, 4, $cotizacion->getCaSaludo(),0,1);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, $cotizacion->getCaEntrada(),0,1);



$productos = $cotizacion->getCotProductos();

if( count($productos)>0 ){
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL', 0, 1, 'C');
	$age_imp = true;
	$pdf->SetFont('Arial','B',9);
}
// ======================== Impresión por Item ======================== //

$tabla = array();

$imprimirObservaciones = false;
$imprimirRecargos = false;

foreach( $productos as $producto ):
	
	if ($producto->getCaImprimir() == 'Por Item'):
	
		$pdf->Ln(2);
		$pdf->SetWidths(array(170));
		$pdf->SetAligns(array("L"));
		$pdf->SetStyles(array("B"));
		$pdf->Row(array('Producto : '.$producto->getCaProducto()));
		$pdf->SetFont('Arial','B',8);
		$pdf->SetWidths(array(20, 20, 40, 45, 45));
		$pdf->SetAligns(array_fill(0, 5, "C"));
		$pdf->SetStyles(array_fill(0, 5, "B"));
		$pdf->SetFills(array_fill(0, 5, 1));
		$pdf->Row(array('Impo/Expo', 'Transporte', 'Términos' ,'Origen', 'Destino'));
		$pdf->SetStyles(array_fill(0, 5, ""));
		$pdf->SetFills(array_fill(0, 5, 0));
		$pdf->SetFont('Arial','',8);
		$pdf->Row(array($producto->getCaImpoExpo(), $producto->getCaTransporte(), $producto->getCaIncoterms(), $producto->getOrigen()->getCaCiudad()." - ".$producto->getOrigen()->getCaTrafico(),  $producto->getDestino()->getCaCiudad()." - ".$producto->getDestino()->getCaTrafico() ));		
		
		$opciones = $producto->getCotOpciones();
		
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
				array_push($titulos, "Recargos por Tarifa");
			}
			if ($imprimirObservaciones){
				array_push($titulos, "Observaciones");
			}
			
			//Calcula el ancho de las columnas 
			if ($imprimirRecargos && $imprimirObservaciones ){
				$widths = array( 30, 25, 70, 45 );	//en todos los casos debe sumar 170		
			}elseif( $imprimirRecargos ){
				$widths = array(30, 70, 70);
			}elseif( $imprimirObservaciones ){
				$widths = array(30, 95, 45);
			}else{
				$widths = array(30, 140);
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
		
		$pdf->Ln(2);
		$widths = array();
		$datos = array();
		$pos_mem = 0;
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
		$pdf->SetFont('Arial','',8);
		$pdf->SetWidths($widths);
		$pdf->SetAligns(array_fill(0, 3, "L"));
		$pdf->Row($datos);		
		array_merge($directorioAg , explode('|',$producto->getCaDatosag()) );		
	endif; 
endforeach;

// ======================== Impresión por Puerto ======================== //

$tabla = array();
$origenes = array();
$destinos = array();
foreach( $productos as $producto ):	
	if( $producto->getCaImprimir() == 'Puerto' ):
		//[$producto->getCaTransporte()]
		$origenes[] = $producto->getOrigen()->getCaCiudad();
		$destinos[] =  $producto->getDestino()->getCaCiudad();
		
		$opciones = $producto->getCotOpciones();		
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
			
		
	endif; 
endforeach;

array_unique( $origenes );
array_unique( $destinos );

if( count($tabla)>0 ){
	$pdf->Ln(2);
	$titulos = array_merge( array("Origen\\Destino"),   $destinos);
	$width = 145/count($destinos);	
	$widths = array_merge(array(25), array_fill(0, count($destinos), $width) );
	
	$pdf->SetStyles(array_fill(0, count($destinos)+1, "B"));
	$pdf->SetFills(array_fill(0, count($destinos)+1, 1));	
	$pdf->SetWidths( $widths );
	$pdf->SetAligns(array_fill(0, count($destinos)+1, "C"));
	$pdf->Row( $titulos );	
	
	$pdf->SetStyles( array_merge(array("B"), array_fill(0, count($destinos), "")));
	$pdf->SetFills( array_merge(array(1), array_fill(0, count($destinos), 0)));	
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
}	

// ======================== Impresión por Concepto o Trayecto ======================== //
$tablaConceptos = array();
$conceptos1 = array();
$trayectos1  = array();
foreach( $productos as $producto ):	
	if ($producto->getCaImprimir() == 'Concepto' or $producto->getCaImprimir() == 'Trayecto'  ):
		$opciones = $producto->getCotOpciones();		
		$trayecto = $producto->getOrigen()->getCaCiudad()."\n".$producto->getDestino()->getCaCiudad();
		$trayectos1[] = $trayecto;
		foreach( $opciones as $opcion ){
			$concepto = $opcion->getConcepto();	
			$conceptos1[] = $concepto->getCaConcepto();
			$contenido="";
			
			$concepto = $opcion->getConcepto();		
			if ( isset($tablaConceptos[ $trayecto ][ $concepto->getCaConcepto() ]) ){
				$tablaConceptos[ $trayecto ][ $concepto->getCaConcepto() ].= str_repeat("..-..", 12)."\n";
			}else{
				$tablaConceptos[ $trayecto ][ $concepto->getCaConcepto() ]="";
			}
			
			$contenido.=$concepto->getCaConcepto()." - ".substr($producto->getCaIncoterms(),0,3);
			
			$contenido.=$opcion->getTextoFlete()."\n";
			
			$textoRecargos = $opcion->getTextoRecargos();		
			$contenido.=$textoRecargos;
			
			$tablaConceptos[ $trayecto ][ $concepto->getCaConcepto() ] .= $contenido;
		}
				
	endif; 
endforeach;



array_unique( $conceptos1 );
array_unique( $trayectos1 );

if( count($tablaConceptos)>0 ){
	$pdf->Ln(2);
	$titulos = array_merge( array("Trayecto\\Concepto"),   $conceptos1);
	$width = 145/count($conceptos1);	
	$widths = array_merge(array(25), array_fill(0, count($conceptos1), $width) );
	
	$pdf->SetStyles(array_fill(0, count($conceptos1)+1, "B"));
	$pdf->SetFills(array_fill(0, count($conceptos1)+1, 1));	
	$pdf->SetWidths( $widths );
	$pdf->SetAligns(array_fill(0, count($conceptos1)+1, "C"));
	$pdf->Row( $titulos );	
	
	$pdf->SetStyles( array_merge(array("B"), array_fill(0, count($conceptos1), "")));
	$pdf->SetFills( array_merge(array(1), array_fill(0, count($conceptos1), 0)));	
	$pdf->SetWidths( $widths );
	$pdf->SetAligns(array_fill(0, count($conceptos1)+1, "C"));
	foreach( $trayectos1 as $trayecto  ){
		$row = array($trayecto);
		foreach( $conceptos1 as $concepto){
			if( isset($tablaConceptos[$trayecto][$concepto]) ){
				$row[$concepto]=	$tablaConceptos[$trayecto][$concepto];		
			}else{
				$row[$concepto]=	" ";		
			}
		}	
		$pdf->Row($row);	
	}
}	




// ======================== Continuación de viaje ======================== //




// ======================== Seguros ======================== //
$seguros = $cotizacion->getCotSeguros();


if ( count($seguros)>0 ) {
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(0, 4, 'SEGURO INTERNACIONAL', 0, 1, 'L', 0);
	$pdf->SetFont('Arial','',9);
	$pdf->Ln(2);
	$i = 1;
	$linea = "";
	foreach( $seguros as $seguro ){	
		$aprima = explode('|',$seguro->getCaPrima());
		$pdf->Ln(1);
		$linea = "     $i) Prima sobre valor CIF de la mercancía ".(($aprima[0]=="%")?$aprima[1]." ".$aprima[0]:$seguro->getCaIdmoneda()." ".$aprima[1])." ".(($aprima[2]!=0)?" / Mínimo ".$seguro->getCaIdmoneda()." ".$aprima[2]:"").(($seguro->getCaObtencion()!=0)?" + Obtención de Póliza ".$seguro->getCaIdmoneda()." ".$seguro->getCaObtencion():"").((strlen($seguro->getCaObservaciones())!=0)?" ".$seguro->getCaObservaciones():".");
		$pdf->MultiCell(0, 4, $linea, 0, 1);
		$i++;
	}

	/*if ($imp_mem) {
	   $filename = "./links/Notas_Segu.txt";
	   $handle = fopen($filename, "r");
	   $contents = fread($handle, filesize($filename));
	   fclose($handle);
	
	   $pdf->Ln(4);
	   $pdf->SetFont('Arial','B',9);
	   $pdf->MultiCell(0, 4, "NOTAS IMPORTANTES SOBRE EL SEGURO", 0,'C',0);
	   $pdf->Ln(1);
	   $pdf->SetFont('Arial','',9);
	   $pdf->MultiCell(0, 4, $contents, 0,'J',0);
	}*/
}

$pdf->SetFont('Arial','',10);
$pdf->Ln(4);
$pdf->MultiCell(0, 4, $cotizacion->getCaDespedida(),0,1);
$pdf->Ln(4);
$pdf->MultiCell(0, 4, 'Cordialmente,',0,1);
    

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaNombre()),0,1);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaCargo()),0,1);
$pdf->MultiCell(0, 4, "COLTRANS S.A.",0,1);
$pdf->MultiCell(0, 4, $sucursal->getCaDireccion(),0,1);
$pdf->MultiCell(0, 4, "Tel.:".$sucursal->getCaTelefono()." ".$usuario->getCaExtension(),0,1);
$pdf->MultiCell(0, 4, "Fax :".$sucursal->getCaFax(),0,1);

$pdf->MultiCell(0, 4, $sucursal->getCaNombre()." - Colombia",0,1);
$pdf->MultiCell(0, 4, $usuario->getCaEmail(),0,1);
$pdf->MultiCell(0, 4, "www.coltrans.com.co",0,1);

// ======================== Directori de agentes ======================== //
       
if ($cotizacion->getCaAnexos() != '') {
	$pdf->Ln(6);
	$pdf->MultiCell(0, 4, "Anexo: ".$cotizacion->getCaAnexos(),0,1);
}

$imp_mem="";
if ($imp_mem) {
   $pdf->AddPage();
 /*  $filename = "./links/Notas_Impo.txt";
   $handle = fopen($filename, "r");
   $contents = fread($handle, filesize($filename));
   fclose($handle);
*/
   $pdf->Ln(2);
   $pdf->SetFont('Arial','B',9);
   $pdf->MultiCell(0, 4, "NOTAS IMPORTANTES QUE DEBEN TENER EN CUENTA"."\n"."EN SUS IMPORTACIONES", 0,'C',0);
   $pdf->Ln(1);
   $pdf->SetFont('Arial','',10);
  // $pdf->MultiCell(0, 4, $contents, 0,'J',0);
}
$exp_mem="";
if ($exp_mem) {
   $pdf->AddPage();
  /* $filename = "./links/Notas_Expo.txt";
   $handle = fopen($filename, "r");
   $contents = fread($handle, filesize($filename));
   fclose($handle);
*/
   $pdf->Ln(2);
   $pdf->SetFont('Arial','B',9);
   $pdf->MultiCell(0, 4, "NOTAS IMPORTANTES QUE DEBEN TENER EN CUENTA"."\n"."EN SUS EXPORTACIONES", 0,'C',0);
   $pdf->Ln(1);
   $pdf->SetFont('Arial','',10);
  // $pdf->MultiCell(0, 4, $contents, 0,'J',0);
}


$pdf->Output ( $filename);
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}

?>