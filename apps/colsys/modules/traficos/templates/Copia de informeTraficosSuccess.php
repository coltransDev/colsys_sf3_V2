<?
@require 'Spreadsheet/Excel/Writer.php';
error_reporting(E_ERROR ^ E_NOTICE);	

$xls = new Spreadsheet_Excel_Writer();

// Send HTTP headers to tell the browser what's coming
$xls->send("status".$idCliente.".xls");
// Add a worksheet to the file, returning an object to add data to
$sheet = $xls->addWorksheet($idCliente);



$i=7;	

// Create a format object
$headFormat = $xls->addFormat();
// Set the font family - Helvetica works for OpenOffice calc too...
$headFormat->setFontFamily('Helvetica');
// Set the text to bold
$headFormat->setBold();
// Set the text size
$headFormat->setSize('12');
// Set the text color
$headFormat->setColor('black');
// Set the bottom border width to "thick"

// Set the color of the bottom border
$headFormat->setBottomColor('black');
$headFormat->setMerge();

$sheet->write(0,5,"TRANSITO DE MERCANCIAS VIA MARITIMA ".$cliente->getCaCompania() ,$headFormat);

$sheet->write(2,0,Utils::fechaMes(date("Y-m-d")) ,$headFormat);


/*
Titulos		
*/


// Create a format object
$titleFormat = $xls->addFormat();
// Set the font family - Helvetica works for OpenOffice calc too...
$titleFormat->setFontFamily('Helvetica');
// Set the text to bold
$titleFormat->setBold();
// Set the text size
$titleFormat->setSize('8');
// Set the text color
$titleFormat->setColor('black');
// Set the bottom border width to "thick"
$titleFormat->setBottom(1);
// Set the color of the bottom border
$titleFormat->setBottomColor('black');






// Set the alignment to the special merge value
//$titleFormat->setAlign('merge');

$sheet->write($i,0,"FECHA ACT STATUS",$titleFormat);
$sheet->write($i,1,"FECHA INICIO NEGOCIACION",$titleFormat);
$sheet->write($i,2,"ORIGEN",$titleFormat);	
$sheet->write($i,3,"DESTINO",$titleFormat);
$sheet->write($i,4,"No DE PEDIDO",$titleFormat);
$sheet->write($i,5,"PROVEEDOR",$titleFormat);	
$sheet->write($i,6,"CONSIGNEE",$titleFormat);	
$sheet->write($i,7,"INCOTERMS",$titleFormat);		
$sheet->write($i,8,"ETS",$titleFormat);
$sheet->write($i,9,"ETA",$titleFormat);
$sheet->write($i,10,"PIEZAS",$titleFormat);
$sheet->write($i,11,"PESO",$titleFormat);
$sheet->write($i,12,"VOLUMEN",$titleFormat);
$sheet->write($i,13,"COL REF.",$titleFormat);
$sheet->write($i,14,"HBL",$titleFormat);
$sheet->write($i,15,"STATUS / ACCIONES A TOMAR",$titleFormat);
$i++;

// The row height
$sheet->setRow(0,25);

// Set the column width 
$sheet->setColumn(0,2,15);
$sheet->setColumn(2,2,25);
$sheet->setColumn(3,3,25);
$sheet->setColumn(4,4,15);
$sheet->setColumn(5,5,40);	
$sheet->setColumn(6,6,40);
$sheet->setColumn(7,8,10);					
$sheet->setColumn(9,9,10);	
$sheet->setColumn(10,10,7);
$sheet->setColumn(11,11,7);
$sheet->setColumn(12,12,7);
$sheet->setColumn(13,13,20);
$sheet->setColumn(14,14,30);
$sheet->setColumn(15,15,100);

foreach( $reportes as $reporte ){
	if( !$reporte->esUltimaVersion() ){
		continue;
	}
		
	$aviso = $reporte->getUltimoAviso();	
	$status = $reporte->getUltimoStatus();	
	
	$mostrarStatus = false;
	$mostrarAviso = false;
	
	if( $aviso && $status ){
		if( Utils::compararFechas( $aviso?$aviso->getCaFchEnvio("Y-m-d"):"", $status?$status->getCaFchStatus("Y-m-d"):"" )>1 ){
			$mostrarAviso = true;
		}else{
			$mostrarStatus = true;
		}											
	}else{
		if( $aviso ){
			$mostrarAviso = true;
		}
		
		if( $status ){
			$mostrarStatus = true;
		}
	}
	$fecha = null;
	$refSea = null;
	$inoclientesSea = $reporte->getInoClientesSea();
	if( $refSea && $refSea->getCaMensaje() ){		
		$fecha = $refSea->getCaFchconfirmado("Y-m-d");		
	}else{		
		if( $mostrarAviso ){
			$fecha = $aviso?$aviso->getCaFchEnvio("Y-m-d"):" ";
		}		
		
		if( $mostrarStatus ){
			$fecha = $status?$status->getCaFchStatus("Y-m-d"):" ";
		}		
	}
		
	if($inoclientesSea){
		$refSea = $inoclientesSea->getInoMaestraSea();	
		
		if( $fecha==date("Y-m-d")){//nuevo status
			$rowFormat = $format2;
		}
		else{
			$rowFormat = $format1; //sin novedad
		}	
	}else{
		$etapa = $reporte->getCaEtapaActual(); 
		switch( $etapa ){				
			case "Pendiente de Coordinación":
				$rowFormat = $format5;
				break;
			case "Carga Embarcada":
				$rowFormat = $format3;
				break;			
			default:
				if( $fecha==date("Y-m-d")){//nuevo status
					$rowFormat = $format2;
				}
				else{
					$rowFormat = $format1; //sin novedad
				}
				break;	 
		}
	
	}
	
	
	
	$sheet->write($i,1, $reporte->getCaFchReporte(),$rowFormat);
	$sheet->write($i,2, $reporte->getOrigen(),$rowFormat);
	$rowFormat->setBold(1);
	$sheet->write($i,3, $reporte->getDestino(),$rowFormat);
	$rowFormat->setBold(0);
	$sheet->write($i,4, $reporte->getCaOrdenClie(),$rowFormat);
	$sheet->write($i,5, $reporte->getProveedor(),$rowFormat);
	$sheet->write($i,6, $reporte->getConsignatario()?$reporte->getConsignatario():" ",$rowFormat);
	$sheet->write($i,7, $reporte->getCaIncoterms(),$rowFormat);
	
	$coltRef = $reporte->getCaConsecutivo();
	
	$statusOTM =null;
	if( $inoclientesSea ){
		$statusOTM = $inoclientesSea->getUltimoStatusOTM();
	}
		
	if( $inoclientesSea && ($refSea->getCaMensaje() || $inoclientesSea->getCaContinuacion()!="N/A" && $statusOTM  ) ){		
		$coltRef.=" ".$refSea->getCaReferencia(); 		
		
		$sheet->write($i,8, $refSea->getCaFchembarque("Y-m-d"),$rowFormat);
		$sheet->write($i,9, $refSea->getCaFcharribo("Y-m-d"),$rowFormat);
		$sheet->write($i,10, $inoclientesSea->getCaNumpiezas(),$rowFormat);
		$sheet->write($i,11, $inoclientesSea->getCaPeso(),$rowFormat);
		$sheet->write($i,12, $inoclientesSea->getCaVolumen() ,$rowFormat);		
		$sheet->write($i,14, $inoclientesSea->getCaHbls(),$rowFormat);	
		
		if( $inoclientesSea->getCaContinuacion()!="N/A" && $statusOTM ){
			$sheet->write($i,0, $statusOTM->getCaFchaviso("Y-m-d"),$rowFormat);
			$sheet->write($i,15, str_replace("\r" , "",$statusOTM->getCaAviso()) ,$rowFormat);
		}else{
			$sheet->write($i,0, $refSea->getCaFchconfirmado("Y-m-d"),$rowFormat);
			$sheet->write($i,15, str_replace("\r" , "",$refSea->getCaMensaje()." ".$inoclientesSea->getCamensaje()) ,$rowFormat);
		}
		
		
	}else{
		
		if( $mostrarAviso ){
			$sheet->write($i,0, $aviso?$aviso->getCaFchEnvio("Y-m-d"):" ",$rowFormat);
			$sheet->write($i,8, $aviso?$aviso->getCaFchSalida():" ",$rowFormat);
			$sheet->write($i,9, $aviso?$aviso->getCaFchLlegada():" ",$rowFormat);
			$sheet->write($i,10, $aviso?str_replace("|", " ",$aviso->getCaPiezas()):" ",$rowFormat);
			$sheet->write($i,11, $aviso?str_replace("|", " ",$aviso->getCaPeso()):" ",$rowFormat);
			$sheet->write($i,12, $aviso?str_replace("|", " ",$aviso->getCaVolumen()):" ",$rowFormat);
			$sheet->write($i,14, $aviso?$aviso->getCaDoctransporte():" ",$rowFormat);	
			$sheet->write($i,15, $aviso?str_replace("\r" , "",$aviso->getCaNotas()):" ",$rowFormat);
		}
		
		if( $mostrarStatus ){		
			$sheet->write($i,0, $status?$status->getCaFchStatus("Y-m-d"):" ",$rowFormat);
			$sheet->write($i,8, " ",$rowFormat);
			$sheet->write($i,9, " ",$rowFormat);
			$sheet->write($i,10, " ",$rowFormat);
			$sheet->write($i,11, " ",$rowFormat);
			$sheet->write($i,12, " ",$rowFormat);				
			$sheet->write($i,14, " ",$rowFormat);	
			$sheet->write($i,15, $status?str_replace("\r" , "",$status->getCaStatus()):" ",$rowFormat);
		}
	}
	$sheet->write($i,13, $coltRef ,$rowFormat);	
		
	$i++;
}	


$xls->close(); 

?>