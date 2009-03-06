<?
$pdf = new PDF ( $orientation = 'P', $unit = 'mm', $format = 'letter' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( true );


$pdf->SetAutoPageBreak ( true, 0 );
$pdf->SetHeight ( 4 );
$pdf->AddPage ();
$pdf->SetFont ( 'Arial', '', 8 );

list ( $anno, $mes, $dia, $tiempo, $minuto, $segundo ) = sscanf ( date ( "Y-m-d" ), "%d-%d-%d %d:%d:%d" );

$pdf->SetWidths ( array (200 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetStyles ( array ("B" ) );
$pdf->Row ( array ('REPORTE DE NEGOCIOS' ) );

$pdf->SetWidths ( array (25, 25, 25, 25, 25, 25, 25, 25 ) );
$pdf->SetAligns ( array ("L", "C", "L", "C", "L", "C", "L", "C" ) );
$pdf->SetStyles ( array ("", "B", "", "B", "", "B", "", "B" ) );
$pdf->SetFills ( array (1, 0, 1, 0, 1, 0, 1, 0 ) );
/*
$cotProducto = $reporteNegocio->getCotProducto();
if( $cotProducto ){	
	$id_cotizacion = $cotProducto->getCaIdcotizacion();
}else{	*/

$id_cotizacion = null;
//}  


$pdf->Row ( array ('Reporte No.: ', $reporteNegocio->getCaConsecutivo (), 'Versión No.: ', $reporteNegocio->getCaVersion () . "/" . $reporteNegocio->numVersiones (), 'Fecha Reporte: ', Utils::fechaMes ( $reporteNegocio->getCaFchreporte () ), 'Cotización: ', $reporteNegocio->getCaIdCotizacion () ) );

$pdf->SetWidths ( array (200 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetFills ( array (0 ) );
$pdf->Row ( array ('Información General' ) );

$pdf->SetWidths ( array (30, 85, 85 ) );
$pdf->SetAligns ( array ("C", "C", "C" ) );
$pdf->SetStyles ( array ("", "B", "B" ) );
$pdf->SetFills ( array (1, 1, 1 ) );
$pdf->Row ( array ('1. Impor/Exportación', '2. Origen', '3. Destino' ) );
$pdf->SetFills ( array (0, 0, 0 ) );

$origen = $reporteNegocio->getOrigen ();
$destino = $reporteNegocio->getDestino ();
$pdf->Row ( array ($reporteNegocio->getCaImpoexpo (), $origen->getCaCiudad () . ' - ' . $origen->getTrafico ()->getCaNombre (), $destino . ' - ' . $destino->getTrafico ()->getCaNombre () ) );

$agente = $reporteNegocio->getAgente ();

$pdf->SetWidths ( array (26, 17, 25, 73, 59 ) );
$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "L" ) );
$pdf->SetFills ( array (0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('4. Fch.Despacho:', $reporteNegocio->getCaFchdespacho (), '5. Incoterms:', $reporteNegocio->getCaIncoterms () ) );

$pdf->SetWidths ( array (200 ) );
$pdf->SetStyles ( array ("" ) );
$pdf->Row ( array ('Descripción de la Mercancia:' . "\n" . $reporteNegocio->getCaMercanciaDesc () ) );

if ($reporteNegocio->getCaImpoexpo () == "Exportación") {
	$repexpo = $reporteNegocio->getRepExpo ();
	
	$pdf->Ln ( 3 );
	$pdf->SetWidths ( array (200 ) );
	$pdf->SetFills ( array (1 ) );
	$pdf->SetAligns ( array ("C" ) );
	$pdf->SetStyles ( array ("B" ) );
	$pdf->Row ( array ('DATOS DE EXPORTACIONES' ) );
	
	$pdf->SetWidths ( array (26, 17, 35, 20, 25, 25, 27, 25 ) );
	$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "L", "L", "L" ) );
	$pdf->SetFills ( array (0, 0, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('Peso (Kgs):', $repexpo->getCaPeso (), 'Volumen:', $repexpo->getCaVolumen (), 'Piezas:', str_replace ( "|", " ", $repexpo->getCaPiezas () ), 'Dimensiones:', $repexpo->getCaDimensiones () != "0|0|0" ? str_replace ( "|", "x", $repexpo->getCaDimensiones () ) : "" ) );
	
	$pdf->SetWidths ( array (26, 17, 35, 20, 25, 77 ) );
	$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "L", "L", "L" ) );
	$pdf->SetFills ( array (0, 0, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('Valor carga:', Utils::formatNumber ( $repexpo->getCaValorcarga () ), 'Solicitud anticipo:', $repexpo->getCaAnticipo (), 'Tipo de exportacion:', $repexpo->getTipoExpo () ) );
	
	$pdf->SetWidths ( array (26, 72, 25, 25, 27, 25 ) );
	$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "L", "L", "L" ) );
	$pdf->SetFills ( array (0, 0, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('SIA:', $repexpo->getSia (), 'Emision BL:', $repexpo->getCaEmisionbl (), 'Motonave:', $repexpo->getCaMotonave () ) );

}
$agente = $reporteNegocio->getAgente ();
if ($agente) {
	$pdf->Ln ( 3 );
	$pdf->SetWidths ( array (30, 25, 145 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
	$pdf->Row ( array ('10. Agente:', '10.1 Nombre:', $agente->getCaNombre () ) );
	$pdf->SetWidths ( array (5, 25, 170 ) );
	$pdf->Row ( array ('', '10.2 Dirección:', str_replace ( "|", " ", $agente->getCaDireccion () . " " . $agente->getCaZipcode () ) ) );
	$pdf->SetWidths ( array (5, 25, 40, 15, 30, 18, 67 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('', '10.3 Teléfono:', $agente->getCaTelefonos (), '10.4 Fax:', $agente->getCaFax (), '10.5 E-mail:', $agente->getCaEmail () ) );
}

/*
Proveedor
if (!$tm->Open("select * from vi_terceros where ca_idtercero in (".str_replace("|",",",$rs->Value('ca_idproveedor')).")")) { // Hace un Select a la vista e uncluye un registro vacio
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>parent.frames[2].location.href = 'grupos.php';</script>";
        exit;
    }
    $tm->MoveFirst();

    $ordenes = array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_orden_prov')));
	$terminos= array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_incoterms')));
    while (!$tm->Eof()) {
        $orden = $ordenes[$tm->Value('ca_idtercero')];
		$termino = substr($terminos[$tm->Value('ca_idtercero')],0,3);
        $pdf->SetWidths(array(25,25,85,25,40));
        $pdf->SetFills(array(1,0,0,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B",""));
        $pdf->Row(array('Proveedor:','7. Nombre:',$tm->Value('ca_nombre'),'7.1 Orden:',$orden));
        $pdf->SetWidths(array(5,20,70,25,80));
        $pdf->Row(array('','7.2 Contacto:',$tm->Value('ca_contacto'),'7.3 Dirección:',$tm->Value('ca_direccion')));
        $pdf->SetWidths(array(5,20,40,15,30,18,40,22,10));
        $pdf->SetStyles(array("B","B","","B","","B","","B",""));
        $pdf->Row(array('','7.4 Teléfono:',$tm->Value('ca_telefonos'),'7.5 Fax:',$tm->Value('ca_fax'),'7.6 E-mail:',$tm->Value('ca_email'),'7.7 Incoterms:',$termino));
        $pdf->Ln(1);
        $tm->MoveNext();
    }
	$pdf->Ln(3);
*/
$pdf->Ln ( 3 );
$contacto = $reporteNegocio->getContacto ();
$cliente = $contacto->getCliente ();
$pdf->SetWidths ( array (25, 25, 85, 25, 40 ) );
$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
$pdf->Row ( array ('Cliente:', '8. Nombre:', $cliente->getCaCompania (), $reporteNegocio->getCaOrdenClie () != "''" ? '8.1 Orden:' : ' ', $reporteNegocio->getCaOrdenClie () != "''" ? $reporteNegocio->getCaOrdenClie () : " " ) );
$pdf->SetWidths ( array (5, 20, 70, 25, 80 ) );
$pdf->Row ( array ('', '8.2 Contacto:', $contacto->getNombre (), '8.3 Dirección:', str_replace ( "|", " ", $cliente->getCaDireccion () ) . $cliente->getCaComplemento () ) );
$pdf->SetWidths ( array (5, 20, 40, 15, 30, 18, 72 ) );
$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('', '8.4 Teléfono:', $cliente->getCaTelefonos (), '8.5 Fax:', $cliente->getCaFax (), '8.6 E-mail:', $contacto->getCaEmail () ) );

$consignatario = $reporteNegocio->getConsignatario ();
if ($consignatario) {
	$pdf->Ln ( 3 );
	
	$pdf->SetWidths ( array (25, 25, 85, 40, 25 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
	$pdf->Row ( array ('Consignatario:', '9.1 Nombre:', $consignatario->getCaNombre (), $reporteNegocio->getCaImpoexpo () == "Exportación" ? '9.1.1 Identificacion' : '9.1.1 Enviar Información:', $reporteNegocio->getCaImpoexpo () == "Exportación" ? $consignatario->getCaIdentificacion () : $reporteNegocio->getCaInformarCons () ) );
	
	$pdf->SetWidths ( array (5, 22, 68, 25, 80 ) );
	$pdf->Row ( array ('', '9.1.2 Cont.:', $consignatario->getCaContacto (), '9.1.3 Dirección:', str_replace ( "|", " ", $consignatario->getCaDireccion () ) ) );
	$pdf->SetWidths ( array (5, 22, 38, 15, 30, 20, 70 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('', '9.1.4 Tel.:', $consignatario->getCaTelefonos (), '9.1.5 Fax:', $consignatario->getCaFax (), '9.1.6 E-mail:', $consignatario->getCaEmail () ) );
}

$notify = $reporteNegocio->getNotify ();
if ($notify) {
	$pdf->Ln ( 3 );
	
	$pdf->SetWidths ( array (25, 25, 85, 40, 25 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
	$pdf->Row ( array ('Notify:', '9.2 Nombre:', $notify->getCaNombre (), $reporteNegocio->getCaImpoexpo () == "Exportación" ? '9.2.1 Identificacion' : '9.1.1 Enviar Información:', $reporteNegocio->getCaImpoexpo () == "Exportación" ? $notify->getCaIdentificacion () : $reporteNegocio->getCaInformarCons () ) );
	
	$pdf->SetWidths ( array (5, 22, 68, 25, 80 ) );
	$pdf->Row ( array ('', '9.2.2 Cont.:', $notify->getCaContacto (), '9.2.3 Dirección:', str_replace ( "|", " ", $notify->getCaDireccion () ) ) );
	$pdf->SetWidths ( array (5, 22, 38, 15, 30, 20, 70 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('', '9.2.4 Tel.:', $notify->getCaTelefonos (), '9.2.5 Fax:', $notify->getCaFax (), '9.2.6 E-mail:', $notify->getCaEmail () ) );
}
/*

if($rs->Value('ca_idrepresentante') != 0){
$pdf->Ln(3);
$pdf->SetWidths(array(25,25,85,40,25));
$pdf->SetFills(array(1,0,0,0,0));
$pdf->SetStyles(array("B","B","","B",""));
$pdf->Row(array('Representante:','10. Nombre:',$rs->Value('ca_nombre_rep'),'10.1 Enviar Información:',$rs->Value('ca_informar_repr')));
$pdf->SetWidths(array(5,25,65,25,80));
$pdf->Row(array('','10.2 Contacto:',$rs->Value('ca_contacto_rep'),'10.3 Dirección:',str_replace ("|"," ",$rs->Value('ca_direccion_rep'))));
$pdf->SetWidths(array(5,25,35,15,30,18,72));
$pdf->SetFills(array(1,0,0,0,0,0,0));
$pdf->SetStyles(array("B","B","","B","","B",""));
$pdf->Row(array('','10.4 Teléfono:',$rs->Value('ca_telefonos_rep'),'10.5 Fax:',$rs->Value('ca_fax_rep'),'10.6 E-mail:',$rs->Value('ca_email_rep')));
}
*/

$pdf->Ln ( 3 );

$pdf->SetWidths ( array (200 ) );
$pdf->SetFills ( array (1 ) );
$pdf->Row ( array ('' ) );

$pdf->SetWidths ( array (200 ) );
$pdf->SetStyles ( array ("" ) );
$pdf->SetFills ( array (0 ) );
$pdf->Row ( array ('11.1 Preferencias del Cliente:' . "\n" . $reporteNegocio->getCaPreferenciasClie () ) );

$pdf->SetWidths ( array (200 ) );
$pdf->SetStyles ( array ("" ) );
$pdf->Row ( array ('11.2 Instrucciones Especiales para el Agente:' . "\n" . $reporteNegocio->getCaInstrucciones () ) );

$pdf->SetWidths ( array (45, 50, 50, 55 ) );
$pdf->SetStyles ( array ("B", "", "", "", "" ) );

$emails = explode ( ",", $reporteNegocio->getCaConfirmarClie () );
$z = 0;
$cadena = "11.3 Copiar comunicaciones a:";
for($i = 0; $i < ceil ( count ( $emails ) / 3 ); $i ++) {
	for($j = 0; $j < 3; $j ++) {
		if (isset($emails [$z])) {
			$cadena .= (strlen ( $emails [$z] ) == 0) ? "," : "," . $emails [$z];
			$z ++;
		}
	}
	$pdf->Row ( explode ( ",", $cadena ) );
	$cadena = "";
}

$pdf->Ln ( 3 );

$transporte = $reporteNegocio->getTransportador ();
if ($transporte) {
	$nombreTransporte = $transporte->getCaNombre ();
} else {
	$nombreTransporte = "";
}

$pdf->SetWidths ( array (25, 25, 22, 23, 35, 70 ) );
$pdf->SetFills ( array (0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('12. Transporte:', $reporteNegocio->getCaTransporte (), '13. Modalidad:', $reporteNegocio->getCaModalidad (), '14.1 Línea Transporte:', $nombreTransporte ) );

/*
$tiempo_cred = ($rs->Value('ca_liberacion')=='Sí')?" Tiempo de Crédito: ".$rs->Value('ca_tiempocredito'):"";
*/
$pdf->SetWidths ( array (40, 10, 35, 10, 35, 70 ) );
$pdf->Row ( array ('15. Transporte terrestre Nal:', $reporteNegocio->getCaColmas (), '16. Seguro:', $reporteNegocio->getCaSeguro () ,/*'17. Lib. Automática:'*/ '' ,/*$rs->Value('ca_liberacion').$tiempo_cred*/ '' ) );

/*
if ($rs->Value('ca_continuacion')!= "N/A") {
	$pdf->Ln(3);
	$pdf->SetWidths(array(200));
	$pdf->SetFills(array(1));
	$pdf->SetAligns(array("C"));
	$pdf->SetStyles(array("B"));
	$pdf->Row(array('CONTINUACIÓN DE VIAJE'));
	$pdf->SetWidths(array(35,10,28,20,42,65));
	$pdf->SetAligns(array("L","L","L","L","L","L"));
	$pdf->SetStyles(array("B","","B","","B",""));
	$pdf->SetFills(array(0,0,0,0,0,0));
	$pdf->Row(array('18.1 Continuación/Viaje:',$rs->Value('ca_continuacion'),'18.2 Destino final:',$rs->Value('ca_final_dest'),'18.3 Notificar C/Viaje al email:',$rs->Value('ca_continuacion_conf')));
}
*/

$pdf->SetWidths ( array (45, 50, 55, 50 ) ); 
/*
$consig = (($rs->Value('ca_idconsignatario')!=0)?$rs->Value('ca_nombre_con'):$rs->Value('ca_nombre_cli'));
$cadena = (($rs->Value('ca_consignar')=='Nombre del Cliente')?$consig:$rs->Value('ca_consignar')).(($rs->Value('ca_idbodega')!= 111)?" / ".$rs->Value('ca_tipobodega')." ".$rs->Value('ca_bodega'):"");
$pdf->Row(array('19.1 Consignar HAWB/HBL a :',$cadena,'Igualar Master/Hijo:',$rs->Value('ca_mastersame')));
*/
$pdf->Row ( array ('19.1 Consignar MAWB/BL a :', $reporteNegocio->getConsignarmaster (),'19.2 Consignar HAWB/HBL a :', $reporteNegocio->getConsignar () ) );

if ($reporteNegocio->getCaSeguro () == "Sí") {
	
	$pdf->Ln ( 3 );
	
	$repseguro = $reporteNegocio->getRepSeguro ();
	
	$pdf->SetWidths ( array (200 ) );
	$pdf->SetFills ( array (1 ) );
	$pdf->SetAligns ( array ("C" ) );
	$pdf->SetStyles ( array ("B" ) );
	$pdf->Row ( array ('INFORMACIÓN PARA LA ASEGURADORA' ) );
	
	$pdf->SetWidths ( array (79, 30, 28, 63 ) );
	$pdf->SetFills ( array (1, 1, 1, 1, 1 ) );
	$pdf->SetAligns ( array ("C", "C", "C", "C", "C" ) );
	$pdf->SetStyles ( array ("B", "B", "B", "B", "B" ) );
	$pdf->Row ( array ('20.2 Notificar Seguro:', '20.3 Vlr.Asegurado:', '20.5 Prima Venta:', '20.6 Obtención Póliza:' ) );
	$pdf->SetStyles ( array ("B", "B", "B", "B", "B" ) );
	$pdf->SetFills ( array (0, 0, 0, 0, 0 ) );
	$pdf->SetAligns ( array ("L", "R", "C", "C", "R" ) );
	$pdf->Row ( array ($repseguro->getCaSeguroConf (), Utils::formatNumber ( $repseguro->getCaVlrasegurado (), 3 ) . " " . $repseguro->getCaIdmonedaVlr (), $repseguro->getCaPrimaventa () . "%\nMin." . $repseguro->getCaMinimaventa () . " " . $repseguro->getCaIdmonedaVta (), Utils::formatNumber ( $repseguro->getCaObtencionpoliza (), 3 ) . " " . $repseguro->getCaIdmonedaPol () ) );
}

if( ($reporteNegocio->getCaImpoExpo()=="Importación" && $reporteNegocio->getCaColmas()=="Sí") || ($reporteNegocio->getCaImpoExpo()=="Exportación" && $repexpo->getCaIdSia()==17 ) ){
	$pdf->Ln ( 3 );
	$repaduana = $reporteNegocio->getRepAduana ();
	
	$pdf->SetWidths ( array (200 ) );
	$pdf->SetFills ( array (1 ) );
	$pdf->SetAligns ( array ("C" ) );
	$pdf->SetStyles ( array ("B" ) );
	if ($reporteNegocio->getCaImpoexpo () == "Importación") {
		$pdf->Row ( array ('NACIONALIZACION CON COLMAS SIA LTDA.' ) );
	} else {
		$pdf->Row ( array ('AGENCIAMIENTO CON COLMAS SIA LTDA.' ) );
	}
	
	$pdf->SetWidths ( array (100, 100 ) );
	$pdf->SetFills ( array (1, 0 ) );
	$pdf->SetAligns ( array ("C", "L" ) );
	$pdf->SetStyles ( array ("B", "" ) );
	$pdf->Row ( array ('Transporte nacional', '21.3 Instrucciones Especiales para Colmas:' ) );
	$pdf->SetWidths ( array (32, 26, 42, 100 ) );
	$pdf->SetFills ( array (0, 0, 0, 0 ) );
	$pdf->SetAligns ( array ("L", "L", "L", "L" ) );
	$pdf->SetStyles ( array ("", "", "", "" ) );
	$pdf->Row ( array ("21.1 Con Colmas:  " . $repaduana->getCaTransnacarga (), "21.2 Tipo:\n" . $repaduana->getCaTransnatipo (), "" /*"21.4 Coordinador:\n" . $repaduana->getCaCoordinador ()*/, $repaduana->getCaInstrucciones () ) );
}

$pdf->Ln ( 3 );
$pdf->SetWidths ( array (200 ) );
$pdf->SetFills ( array (1 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetStyles ( array ("B" ) );

$pdf->Row ( array ('EMBARQUE ' . strtoupper ( $reporteNegocio->getCaTransporte () ) ) );

/*




	$pdf->SetWidths(array(30,40,50,50,30));
	$pdf->SetFills(array(0,1,1,1,0));
	$pdf->SetStyles(array("B","B","B","B","B"));
	$pdf->SetAligns(array("C","C","C","C","C"));
	$pdf->Row(array('','Concepto:','Reportar / Min.','Cobrar / Min',''));
	
	$pdf->SetWidths(array(30,40,25,25,25,25,30));
	$pdf->SetFills(array(0,1,0,0,0,0,0));
	$pdf->SetStyles(array("","B","","","","",""));
	$pdf->SetAligns(array("L","L","R","R","R","R","R"));
	
	$conceptos = $reporteNegocio->getRepTarifas(  );
	foreach( $conceptos as $concepto ){		
		$pdf->Row(array('',$concepto->getConcepto()->getCaConcepto(),$concepto->getCaReportartar()." ".$concepto->getCaReportaridm(),$concepto->getCaReportarmin()." ".$concepto->getCaReportaridm(),$concepto->getCaCobrartar()." ".$concepto->getCaCobraridm(),$concepto->getCaCobrarmin()." ".$concepto->getCaCobraridm(),''));
	}

}
*/

$pdf->SetWidths ( array (40, 10, 50, 50, 50 ) );
$pdf->SetFills ( array (1, 1, 1, 1, 1 ) );
$pdf->SetStyles ( array ("B", "B", "B", "B", "B" ) );
$pdf->SetAligns ( array ("C", "C", "C", "C", "C" ) );
$pdf->Row ( array ('Concepto:', 'Cant.', 'Neta / Min.', 'Reportar / Min.', 'Cobrar / Min' ) );



$conceptos = $reporteNegocio->getRepTarifas ();
foreach ( $conceptos as $concepto ) {
	$pdf->SetWidths ( array (40, 10, 25, 25, 25, 25, 25, 25 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "", "", "", "", "", "", "", "" ) );
	$pdf->SetAligns ( array ("L", "C", "R", "R", "R", "R", "R", "R" ) );
	$pdf->Row ( array ($concepto->getConcepto ()->getCaConcepto (), $concepto->getCaCantidad (), Utils::formatNumber($concepto->getCaNetatar ()) . " " . $concepto->getCaNetaidm (), $concepto->getCaNetamin () . " " . $concepto->getCaNetaidm (), Utils::formatNumber ( $concepto->getCaReportartar () ). " " . $concepto->getCaReportaridm (), $concepto->getCaReportarmin () . " " . $concepto->getCaReportaridm (), Utils::formatNumber ($concepto->getCaCobrartar ()) . " " . $concepto->getCaCobraridm (), $concepto->getCaCobrarmin () . " " . $concepto->getCaCobraridm () ) );
	if ($concepto->getCaObservaciones ()) {
		$pdf->SetWidths ( array (200 ) );		
		$pdf->SetStyles ( array ("" ) );
		$pdf->SetFills ( array (0  ) );
		
		$pdf->Row ( array ("* Observaciones: " . $concepto->getCaObservaciones () ) );
		
	}
}

$pdf->Ln ( 3 );
$pdf->SetWidths ( array (200 ) );
$pdf->SetFills ( array (1 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetStyles ( array ("B" ) );
$pdf->Row ( array ('RELACIÓN DE RECARGOS' ) );
$sub_mem = 'Recargo en Origen';

$pdf->SetWidths ( array (45, 35, 40, 40, 40 ) );
$pdf->SetFills ( array (1, 1, 1, 1, 1 ) );
$pdf->SetStyles ( array ("B", "B", "B", "B", "B" ) );
$pdf->SetAligns ( array ("C", "C", "C", "C", "C" ) );
$pdf->Row ( array ($sub_mem, 'Aplicación', 'Neta / Min.', 'Reportar / Min.', 'Cobrar / Min' ) );

$pdf->SetWidths ( array (45, 35, 20, 20, 20, 20, 20, 20 ) );
$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "", "", "", "", "", "", "", "" ) );
$pdf->SetAligns ( array ("L", "L", "R", "R", "R", "R", "R", "R" ) );

$gastos = $reporteNegocio->getRecargos ( "origen" );
foreach ( $gastos as $gasto ) {
	$pdf->SetWidths ( array (45, 35, 20, 20, 20, 20, 20, 20 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "", "", "", "", "", "", "", "" ) );
	$pdf->SetAligns ( array ("L", "L", "R", "R", "R", "R", "R", "R" ) );
	
	$des_rec = $gasto->getTipoRecargo ()->getCaRecargo ();
	if ($gasto->getCaIdconcepto () != '9999') {
		$des_rec .= " -> " . $gasto->getConcepto ()->getCaConcepto ();
	}
	
	if ($gasto->getCaTipo () == "$") {
		$pdf->Row ( array ($des_rec, $gasto->getCaAplicacion (), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), $gasto->getCaCobrarMin () . " " . $gasto->getCaIdmoneda () ) );
	} else {
		$pdf->Row ( array ($des_rec, $gasto->getCaAplicacion (), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
	}
	
	if ($gasto->getCaDetalles ()) {
		$pdf->SetWidths ( array (200 ) );
		$pdf->SetStyles ( array ("" ) );
		$pdf->SetFills ( array (0 ) );
		$pdf->Row ( array ("* Observaciones: " . $gasto->getCaDetalles () ) );
	}
}
if( $reporteNegocio->getCaImpoexpo () == "Importación" ){ 
	$sub_mem = 'Recargo Local';
	$pdf->Ln ( 3 );
	
	$gastos = $reporteNegocio->getRecargos ( "local" );
	
	$pdf->SetWidths ( array (100, 40, 60 ) );
	$pdf->SetFills ( array (1, 1, 1 ) );
	$pdf->SetStyles ( array ("B", "B", "B" ) );
	$pdf->SetAligns ( array ("C", "C", "C" ) );
	$pdf->Row ( array ($sub_mem, 'Observaciones', 'Cobrar / Min' ) );
	
	foreach ( $gastos as $gasto ) {
		
		$pdf->SetWidths ( array (100, 40, 30, 30 ) );
		$pdf->SetFills ( array (1, 0, 0, 0 ) );
		$pdf->SetStyles ( array ("B", "", "", "" ) );
		$pdf->SetAligns ( array ("L", "L", "R", "R" ) );
		
		$des_rec = $gasto->getTipoRecargo ()->getCaRecargo ();
		if ($gasto->getCaIdconcepto () != '9999') {
			$des_rec .= " -> " . $gasto->getConcepto ()->getCaConcepto ();
		}
		
		if ($gasto->getCaTipo () == "$") {
			$pdf->Row ( array ($des_rec, $gasto->getCaAplicacion (), $gasto->getCaCobrarTar () . " " . $gasto->getCaIdMoneda (), $gasto->getCaCobrarMin () . " " . $gasto->getCaIdMoneda () ) );
		} else {
			$pdf->Row ( array ($des_rec, $gasto->getCaAplicacion (), $gasto->getCaTipo () . " " . $gasto->getCaCobrarTar (), $gasto->getCaCobrarMin () . " " . $gasto->getCaIdMoneda () ) );
		}
		if ($gasto->getCaDetalles ()) {
			$pdf->SetWidths ( array (200 ) );
			$pdf->SetStyles ( array ("" ) );
			$pdf->SetFills ( array (0 ) );
			$pdf->Row ( array ("* Observaciones: " . $gasto->getCaDetalles () ) );
		}
	
	}
}

if( ($reporteNegocio->getCaImpoExpo()=="Importación" && $reporteNegocio->getCaColmas()=="Sí") || ($reporteNegocio->getCaImpoExpo()=="Exportación" && $repexpo->getCaIdSia()==17 ) ){

	$costosAduana = $reporteNegocio->getCostos ( "aduana" );
	if (count ( $costosAduana )) {
		$pdf->Ln ( 3 );
		$pdf->SetWidths ( array (200 ) );
		$pdf->SetFills ( array (1 ) );
		$pdf->SetAligns ( array ("C" ) );
		$pdf->SetStyles ( array ("B" ) );
		$pdf->Row ( array ('CONCEPTOS DE COBRO EN AGENCIAMIENTO COLMAS SIA LTDA.' ) );
		
		$pdf->SetWidths ( array (49, 8, 21, 21, 21, 10, 70 ) );
		$pdf->SetFills ( array_fill ( 0, 7, "1" ) );
		$pdf->SetAligns ( array_fill ( 0, 7, "C" ) );
		$pdf->SetStyles ( array_fill ( 0, 7, "B" ) );
		$pdf->Row ( array ('Concepto', 'Tipo', 'Neto', 'Valor', 'Mínimo', 'Mnd', 'Detalles' ) );
		
		$pdf->SetFills ( array_fill ( 0, 7, "0" ) );
		$pdf->SetAligns ( array ("L", "C", "R", "R", "R", "C", "L" ) );
		$pdf->SetStyles ( array_fill ( 0, 7, "" ) );
		
		$pdf->SetFills ( array_fill ( 0, 7, "0" ) );
		$pdf->SetAligns ( array ("L", "C", "R", "R", "R", "C", "L" ) );
		$pdf->SetStyles ( array_fill ( 0, 7, "" ) );
		foreach ( $costosAduana as $costo ) {
			$pdf->Row ( array ($costo->getCosto ()->getCaCosto (), $costo->getCaTipo (), Utils::formatNumber ( $costo->getCaNetcosto () ), Utils::formatNumber ( $costo->getCaVlrcosto () ), Utils::formatNumber ( $costo->getCaMincosto () ), $costo->getCaIdmoneda (), $costo->getCaDetalles () ) );
		
		}
	}
}

$pdf->Ln ( 3 );
$line = $pdf->GetAttrib ( 'y' );
for($i = $line; $i < 274; $i += 5) {
	$pdf->Cell ( 0, 5, str_repeat ( " . ", 84 ), 0, 1 );
}

$fch_mem = ($reporteNegocio->getCaFchactualizado () != '') ? $reporteNegocio->getCaFchactualizado () : $reporteNegocio->getCaFchcreado ();

$usu_mem = ($reporteNegocio->getCaFchactualizado () != '') ? $reporteNegocio->getCaUsuactualizado () : $reporteNegocio->getCaUsucreado ();
list ( $anno, $mes, $dia, $hor, $min, $seg ) = sscanf ( $fch_mem, "%d-%d-%d %d:%d:%d" );

$usuario = $reporteNegocio->getUsuario();
$sucursal = $usuario->getSucursal();
$pdf->SetY ( 275 );
$pdf->SetWidths ( array (15, 24, 15, 30, 15, 32, 25, 44 ) );
$pdf->SetFills ( array (1, 0, 1, 0, 1, 0, 1, 0 ) );
$pdf->SetStyles ( array ("B", "B", "B", "B", "B", "B", "B", "B" ) );
$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "C", "L", "C" ) );
$pdf->Row ( array ('Ciudad :', $sucursal?$sucursal->getCaNombre():""  , 'Elaboró :', $usu_mem, 'Fecha:', date ( "Y-m-d", mktime ( $hor, $min, $seg, $mes, $dia, $anno ) ) . " " . date ( "h:i a", mktime ( $hor, $min, $seg, $mes, $dia, $anno ) ), 'Rep. Comercial:', $usuario->getCaNombre() ) );


$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}
?>