<?
$reporte = $sf_data->getRaw("reporte");

$pdf = new PDF ( $orientation = 'P', $unit = 'mm', $format = 'letter' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( false );


$pdf->SetAutoPageBreak ( true, 0 );
$pdf->SetHeight ( 4 );
$pdf->AddPage ();






if( $reporte->getCaUsuanulado() ){
    $x=$pdf->GetX();
    $y=$pdf->GetY();

    
    $pdf->SetY( 50 );
    $pdf->SetTextColor(128,128,128);
    $pdf->SetFont("Arial",'B',84);
    $pdf->Write(5,'A N U L A D O');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetX( $x );
    $pdf->SetY( $y );
}




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
$cotProducto = $reporte->getCotProducto();
if( $cotProducto ){	
	$id_cotizacion = $cotProducto->getCaIdcotizacion();
}else{	*/

$id_cotizacion = null;
//}  


$pdf->Row ( array ('Reporte No.: ', $reporte->getCaConsecutivo (), 'Versi�n No.: ', $reporte->getCaVersion () . "/" . $reporte->numVersiones(), 'Fecha Reporte: ', Utils::fechaMes ( $reporte->getCaFchreporte () ), 'Cotizaci�n: ', $reporte->getCaIdcotizacion () ) );

$pdf->SetWidths ( array (200 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetFills ( array (0 ) );
$pdf->Row ( array ('Informaci�n General' ) );

$pdf->SetWidths ( array (30, 85, 85 ) );
$pdf->SetAligns ( array ("C", "C", "C" ) );
$pdf->SetStyles ( array ("", "B", "B" ) );
$pdf->SetFills ( array (1, 1, 1 ) );
$pdf->Row ( array ('1. Impor/Exportaci�n', '2. Origen', '3. Destino' ) );
$pdf->SetFills ( array (0, 0, 0 ) );




$origen = $reporte->getOrigen ();
$destino = $reporte->getDestino ();
$pdf->Row ( array ($reporte->getCaImpoexpo (), $origen->getCaCiudad () . ' - ' . $origen->getTrafico ()->getCaNombre (), $destino . ' - ' . $destino->getTrafico ()->getCaNombre () ) );

$agente = $reporte->getIdsAgente ();

$pdf->SetWidths(array(26,17,25,73,59));
$pdf->SetAligns(array("L","L","L","L","L","L"));
$pdf->SetFills(array(0,0,0,0,0,0));
$pdf->SetStyles(array("B","","B","","B",""));
if ($reporte->getCaImpoexpo () == Constantes::IMPO ) {
    $pdf->Row(array('4. Fch.Despacho:',$reporte->getCaFchdespacho () ,'5. Agente:', $agente->getIds()->getCaNombre() ));
}else{
    $pdf->Row ( array ('4. Fch.Despacho:', $reporte->getCaFchdespacho (), '5. Incoterms:', $reporte->getCaIncoterms () ) );
}

$pdf->SetWidths(array(200));
$pdf->SetStyles(array(""));
$pdf->Row(array('Descripci�n de la Mercancia:'."\n".$reporte->getCaMercanciaDesc().' �'.(($reporte->getCaMciaPeligrosa())?"S�":"NO")." es Mercanc�a Peligrosa�"));
    
$pdf->Ln(3);

if ($reporte->getCaImpoexpo () == Constantes::EXPO ) {
	$repexpo = $reporte->getRepExpo ();

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
	$pdf->Row ( array ('Agente Aduanero:', $repexpo->getSia (), 'Emision BL:', $repexpo->getCaEmisionbl (), 'Motonave:', $repexpo->getCaMotonave () ) );

    if ($agente) {
        $pdf->Ln ( 3 );
        $pdf->SetWidths ( array (30, 25, 145 ) );
        $pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
        $pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
        $pdf->Row ( array ('10. Agente:', '10.1 Nombre:', $agente->getCaNombre () ) );
        $pdf->SetWidths ( array (5, 25, 170 ) );
        $pdf->Row ( array ('', '10.2 Direcci�n:', str_replace ( "|", " ", $agente->getCaDireccion () . " " . $agente->getCaZipcode () ) ) );
        $pdf->SetWidths ( array (5, 25, 40, 15, 30, 18, 67 ) );
        $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
        $pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
        $pdf->Row ( array ('', '10.3 Tel�fono:', $agente->getCaTelefonos (), '10.4 Fax:', $agente->getCaFax (), '10.5 E-mail:', $agente->getCaEmail () ) );
    }


}




$ordenes = array_combine(explode("|",$reporte->getCaIdproveedor()), explode("|",$reporte->getCaOrdenProv()));
$terminos= array_combine(explode("|",$reporte->getCaIdproveedor()), explode("|",$reporte->getCaIncoterms()));

$idproveedores = explode("|",$reporte->getCaIdproveedor());

foreach( $idproveedores as $idprov ){
    $tercero = Doctrine::getTable("Tercero")->find($idprov);

    $orden = $ordenes[$idprov];
    $termino = substr($terminos[$idprov],0,3);
    $pdf->SetWidths(array(25,25,85,25,40));
    $pdf->SetFills(array(1,0,0,0,0,0,0));
    $pdf->SetStyles(array("B","B","","B",""));
    $pdf->Row(array('Proveedor:','7. Nombre:',$tercero->getCaNombre(),'7.1 Orden:',$orden));
    $pdf->SetWidths(array(5,20,70,25,80));
    $pdf->Row(array('','7.2 Contacto:',$tercero->getCaContacto(),'7.3 Direcci�n:',$tercero->getCaDireccion()));
    $pdf->SetWidths(array(5,20,40,15,30,18,40,22,10));
    $pdf->SetStyles(array("B","B","","B","","B","","B",""));
    $pdf->Row(array('','7.4 Tel�fono:',$tercero->getCaTelefonos(),'7.5 Fax:',$tercero->getCaFax(),'7.6 E-mail:',$tercero->getCaEmail(),'7.7 Incoterms:',$termino));
    $pdf->Ln(1);
}


$pdf->Ln(3);

$contacto = $reporte->getContacto();
$cliente = $contacto->getCliente();
$pdf->SetWidths ( array (25, 25, 85, 25, 40 ) );
$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
$pdf->Row ( array ('Cliente:', '8. Nombre:', $cliente->getCaCompania (), $reporte->getCaOrdenClie () != "''" ? '8.1 Orden:' : ' ', $reporte->getCaOrdenClie () != "''" ? $reporte->getCaOrdenClie () : " " ) );
$pdf->SetWidths ( array (5, 20, 70, 25, 80 ) );
$pdf->Row ( array ('', '8.2 Contacto:', $contacto->getNombre (), '8.3 Direcci�n:', str_replace ( "|", " ", $cliente->getCaDireccion () ) . $cliente->getCaComplemento () ) );
$pdf->SetWidths ( array (5, 20, 40, 15, 30, 18, 72 ) );
$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('', '8.4 Tel�fono:', $cliente->getCaTelefonos (), '8.5 Fax:', $cliente->getCaFax (), '8.6 E-mail:', $contacto->getCaEmail () ) );



$consignatario = $reporte->getConsignatario();
if ($consignatario) {
	$pdf->Ln ( 3 );

	$pdf->SetWidths ( array (25, 25, 85, 40, 25 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
	$pdf->Row ( array ('Consignatario:', '9.1 Nombre:', $consignatario->getCaNombre (), $reporte->getCaImpoexpo () == "Exportaci�n" ? '9.1.1 Identificacion' : '9.1.1 Enviar Informaci�n:', $reporte->getCaImpoexpo () == "Exportaci�n" ? $consignatario->getCaIdentificacion () : $reporte->getCaInformarCons () ) );

	$pdf->SetWidths ( array (5, 22, 68, 25, 80 ) );
	$pdf->Row ( array ('', '9.1.2 Cont.:', $consignatario->getCaContacto (), '9.1.3 Direcci�n:', str_replace ( "|", " ", $consignatario->getCaDireccion () ) ) );
	$pdf->SetWidths ( array (5, 22, 38, 15, 30, 20, 70 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('', '9.1.4 Tel.:', $consignatario->getCaTelefonos (), '9.1.5 Fax:', $consignatario->getCaFax (), '9.1.6 E-mail:', $consignatario->getCaEmail () ) );
}

$notify = $reporte->getNotify ();
if ($notify) {
	$pdf->Ln ( 3 );

	$pdf->SetWidths ( array (25, 25, 85, 40, 25 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
	$pdf->Row ( array ('Notify:', '9.2 Nombre:', $notify->getCaNombre (),  '9.1.1 Enviar Informaci�n:', $reporte->getCaInformarNoti() ) );

	$pdf->SetWidths ( array (5, 22, 68, 25, 80 ) );
	$pdf->Row ( array ('', '9.2.2 Cont.:', $notify->getCaContacto (), '9.2.3 Direcci�n:', str_replace ( "|", " ", $notify->getCaDireccion () ) ) );
	$pdf->SetWidths ( array (5, 22, 38, 15, 30, 20, 70 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('', '9.2.4 Tel.:', $notify->getCaTelefonos (), '9.2.5 Fax:', $notify->getCaFax (), '9.2.6 E-mail:', $notify->getCaEmail () ) );
}

if( $reporte->getCaIdmaster() ){
    $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdmaster());

    $orden = $ordenes[$idprov];
    $termino = substr($terminos[$idprov],0,3);
    $pdf->SetWidths(array(25,25,85,25,40));
    $pdf->SetFills(array(1,0,0,0,0,0,0));
    $pdf->SetStyles(array("B","B","","B",""));
    $pdf->Row(array('Consigna.Master:','Nombre:',$tercero->getCaNombre(),'Enviar Informaci�n:',$reporte->getCaInformarMast()));
    $pdf->SetWidths(array(5,20,70,25,80));
    $pdf->Row(array('','Contacto:',$tercero->getCaContacto(),'Direcci�n:',$tercero->getCaDireccion()));
    $pdf->SetWidths(array(5,20,40,15,30,18,40,22,10));
    $pdf->SetStyles(array("B","B","","B","","B","","B",""));
    $pdf->Row(array('','Tel�fono:',$tercero->getCaTelefonos(),'Fax:',$tercero->getCaFax(),'E-mail:',$tercero->getCaEmail(),'7.7 Incoterms:',$termino));
    $pdf->Ln(1);
}

if( $reporte->getCaIdrepresentante() ){
    $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdrepresentante());

    $orden = $ordenes[$idprov];
    $termino = substr($terminos[$idprov],0,3);
    $pdf->SetWidths(array(25,25,85,25,40));
    $pdf->SetFills(array(1,0,0,0,0,0,0));
    $pdf->SetStyles(array("B","B","","B",""));
    $pdf->Row(array('Representante:','Nombre:',$tercero->getCaNombre(),'Enviar Informaci�n:',$reporte->getCaInformarRepr()));
    $pdf->SetWidths(array(5,20,70,25,80));
    $pdf->Row(array('','Contacto:',$tercero->getCaContacto(),'Direcci�n:',$tercero->getCaDireccion()));
    $pdf->SetWidths(array(5,20,40,15,30,18,40,22,10));
    $pdf->SetStyles(array("B","B","","B","","B","","B",""));
    $pdf->Row(array('','Tel�fono:',$tercero->getCaTelefonos(),'Fax:',$tercero->getCaFax(),'E-mail:',$tercero->getCaEmail(),'7.7 Incoterms:',$termino));
    $pdf->Ln(1);
}

    

    

   

$pdf->Ln(3);

$pdf->SetWidths(array(200));
$pdf->SetFills(array(1));
$pdf->Row(array(''));

$pdf->SetWidths(array(200));
$pdf->SetStyles(array(""));
$pdf->SetFills(array(0));

$pdf->Row(array('11.1 Preferencias del Cliente:'."\n".$reporte->getCaPreferenciasClie ()));

$pdf->SetWidths(array(200));
$pdf->SetStyles(array(""));
$pdf->Row(array('11.2 Instrucciones Especiales para el Agente:'."\n".$reporte->getCaInstrucciones ()));

$pdf->SetWidths(array(45,50,50,55));
$pdf->SetStyles(array("B","","","",""));
$emails = explode ( ",", $reporte->getCaConfirmarClie () );
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
$pdf->Ln(3);


$transportista = $reporte->getIdsProveedor();
if ( $transportista ) {
    $nombreTransporte = $transportista->getIds()->getCaNombre();;
} else {
    $nombreTransporte = "";
}

$pdf->SetWidths ( array (25, 25, 22, 23, 35, 70 ) );
$pdf->SetFills ( array (0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('12. Transporte:', $reporte->getCaTransporte (), '13. Modalidad:', $reporte->getCaModalidad (), '14.1 L�nea Transporte:', $nombreTransporte ) );


$tiempo_cred = ($reporte->getCaLiberacion()=='S�')?" Tiempo de Cr�dito: ".$reporte->getCaTiempocredito():"";


//Para expo
//15. Transporte terrestre Nal
//17. Lib. Autom�tica N/A

if( $reporte->getCaImpoexpo()==Constantes::IMPO ){
    $pdf->SetWidths ( array (40, 10, 35, 10, 35, 70 ) );
    $pdf->Row ( array ('15. Colmas Ltda:', $reporte->getCaColmas (), '16. Seguro:', $reporte->getCaSeguro () ,'17. Lib. Autom�tica:' ,$reporte->getCaLiberacion().$tiempo_cred ) );
}else{
    $pdf->SetWidths ( array (40, 10, 35, 10, 105 ) );
    $pdf->Row ( array ('15. Transporte terrestre Nal:', $reporte->getCaColmas (), '16. Seguro:', $reporte->getCaSeguro (), ''  ) );
}



if ($reporte->getCaContinuacion()!= "N/A") {
    $pdf->Ln(3);
    $pdf->SetWidths(array(200));
    $pdf->SetFills(array(1));
    $pdf->SetAligns(array("C"));
    $pdf->SetStyles(array("B"));
    $pdf->Row(array('CONTINUACI�N DE VIAJE'));
    $pdf->SetWidths(array(35,10,28,20,42,65));
    $pdf->SetAligns(array("L","L","L","L","L","L"));
    $pdf->SetStyles(array("B","","B","","B",""));
    $pdf->SetFills(array(0,0,0,0,0,0));

    $usuario = Doctrine::getTable("Usuario")->find($reporte->getCaContinuacionConf());


    $pdf->Row(array('18.1 Continuaci�n/Viaje:',$reporte->getCaContinuacion(),'18.2 Destino final:',$reporte->getDestinoCont()->getCaCiudad(),'18.3 Notificar C/Viaje al email:',$usuario->getCaEmail()));
}





if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
    $pdf->SetWidths ( array (45, 50, 55, 50 ) );
    $pdf->Row ( array ('19.1 Consignar MAWB/BL a :', $reporte->getConsignarmaster (),'19.2 Consignar HAWB/HBL a :', $reporte->getConsignar () ) );
}else{
    $pdf->SetWidths(array(45,115,30,10));
    $consig = (($consignatario)?$consignatario->getCaNombre():$cliente->getCaCompania());
    $consignar = Doctrine::getTable("Bodega")->find( $reporte->getCaIdconsignar() );

    if( $consignar->getCaNombre()=='Nombre del Cliente' ){
        $cadena = $consig;
    }else{
        $cadena = $consignar->getCaNombre();
    }

    if( $reporte->getCaIdbodega() && $reporte->getCaIdbodega()!= 111 ){ //Coltrans
        $bodega = Doctrine::getTable("Bodega")->find( $reporte->getCaIdbodega() );
        $cadena.=" / ".$bodega->getCaTipo()." ".$bodega->getCaNombre();
    }


    $pdf->Row(array('19.1 Consignar HAWB/HBL a :',$cadena,'Igualar Master/Hijo:',$reporte->getCaMastersame()));
}

if ($reporte->getCaSeguro () == "S�") {

    $pdf->Ln ( 3 );

    $repseguro = $reporte->getRepSeguro ();

    $pdf->SetWidths(array(200));
    $pdf->SetFills(array(1));
    $pdf->SetAligns(array("C"));
    $pdf->SetStyles(array("B"));
    $pdf->Row(array('INFORMACI�N PARA LA ASEGURADORA'));

    $pdf->SetWidths(array(35,35,35,95));
    $pdf->SetFills(array(1,1,1,1));
    $pdf->SetAligns(array("C","C","C","C"));
    $pdf->SetStyles(array("B","B","B","B"));
    $pdf->Row(array('20.1 Vlr.Asegurado:','20.2 Obtenci�n P�liza:','20.3 Prima Venta:','20.4 Notificar Seguro:'));
    $pdf->SetStyles(array("","","",""));
    $pdf->SetFills(array(0,0,0,0));
    $pdf->SetAligns(array("C","C","C","L"));
    $usuario = Doctrine::getTable("Usuario")->find( $repseguro->getCaSeguroConf() );
    $pdf->Row(array(Utils::formatNumber($repseguro->getCaVlrasegurado(),3)." ".$repseguro->getCaIdmonedaVlr (),Utils::formatNumber($repseguro->getCaObtencionpoliza(),3)." ".$repseguro->getCaIdmonedaPol(), $repseguro->getCaPrimaventa () . "%\nMin." . $repseguro->getCaMinimaventa()." ".$repseguro->getCaIdmonedaVta(),$usuario->getCaEmail()));
 
}


if( ($reporte->getCaImpoexpo()==Constantes::IMPO && $reporte->getCaColmas()=="S�") || ($reporte->getCaImpoexpo()==Constantes::EXPO && ($repexpo->getCaIdSia()==17 || $repexpo->getCaIdSia()==9) ) ){
	$pdf->Ln ( 3 );
	$repaduana = $reporte->getRepAduana ();

	$pdf->SetWidths ( array (200 ) );
	$pdf->SetFills ( array (1 ) );
	$pdf->SetAligns ( array ("C" ) );
	$pdf->SetStyles ( array ("B" ) );
	if ($reporte->getCaImpoexpo () == Constantes::IMPO) {
		$pdf->Row ( array ('NACIONALIZACION CON AGENCIA DE ADUANAS COLMAS LTDA.' ) );
	} else {
		$pdf->Row ( array ('AGENCIAMIENTO CON AGENCIA DE ADUANAS COLMAS  LTDA.' ) );
	}

	$pdf->SetWidths ( array (100, 100 ) );
	$pdf->SetFills ( array (1, 0 ) );
	$pdf->SetAligns ( array ("C", "L" ) );
	$pdf->SetStyles ( array ("B", "" ) );
    if ($reporte->getCaImpoexpo () == Constantes::IMPO) {
        $pdf->Row ( array ('Transporte de carga nacionalizada', '21.3 Instrucciones Especiales para Colmas:' ) );
    }else{
        $pdf->Row ( array ('Transporte nacional', '21.3 Instrucciones Especiales para Colmas:' ) );
    }
	$pdf->SetWidths ( array (32, 26, 42, 100 ) );
	$pdf->SetFills ( array (0, 0, 0, 0 ) );
	$pdf->SetAligns ( array ("L", "L", "L", "L" ) );
	$pdf->SetStyles ( array ("", "", "", "" ) );
    if ($reporte->getCaImpoexpo () == Constantes::IMPO) {
        $titulo1 = "21.1 Con Coltrans:  ";
    }else{
        $titulo1 = "21.1 Con Colmas:  ";
    }
    $usuario = Doctrine::getTable("Usuario")->find( $repaduana->getCaCoordinador () );
	$pdf->Row ( array ( $titulo1. $repaduana->getCaTransnacarga (), "21.2 Tipo:\n" . $repaduana->getCaTransnatipo(), "21.4 Coordinador:\n" . ($usuario?$usuario->getCaNombre():""), $repaduana->getCaInstrucciones () ) );
}


$pdf->Ln ( 3 );
$pdf->SetWidths ( array (200 ) );
$pdf->SetFills ( array (1 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetStyles ( array ("B" ) );


$soloAduana = $reporte->esSoloAduana();
if( !$soloAduana ){

    $pdf->Row ( array ('EMBARQUE ' . strtoupper ( $reporte->getCaTransporte () ) ) );

    $conceptos = $reporte->getRepTarifa();

    if( $reporte->getCaTransporte()==Constantes::AEREO){
        $pdf->SetWidths(array(5,40,50,50,50,5));
        $pdf->SetFills(array(0,1,1,1,1,0));
        $pdf->SetStyles(array("B","B","B","B","B"));
        $pdf->SetAligns(array("C","C","C","C","C"));
        $pdf->Row(array('','Concepto:','Reportar / Min.','Cobrar / Min','Observaciones',''));

    }else{
        $pdf->SetWidths(array(40,10,40,40,40,30));
        $pdf->SetFills(array(1,1,1,1,1,1));
        $pdf->SetStyles(array("B","B","B","B","B","B"));
        $pdf->SetAligns(array("C","C","C","C","C","C"));
        $pdf->Row(array('Concepto:','Cant.','Neta / Min.','Reportar / Min.','Cobrar / Min', 'Observaciones'));
    }


    foreach ( $conceptos as $concepto ) {

        if( $reporte->getCaTransporte()==Constantes::AEREO){
           
            $pdf->SetWidths(array(5,40,25,25,25,25,50,5));
            $pdf->SetFills(array(0,0,0,0,0,0,0,0));
            $pdf->SetStyles(array("","","","","","","",""));
            $pdf->SetAligns(array("L","L","R","R","R","R","L","L"));

            $pdf->Row ( array ('',$concepto->getConcepto ()->getCaConcepto (), Utils::formatNumber ( $concepto->getCaReportarTar () ). " " . $concepto->getCaReportarIdm (), $concepto->getCaReportarMin () . " " . $concepto->getCaReportarIdm (), Utils::formatNumber ($concepto->getCaCobrarTar ()) . " " . $concepto->getCaCobrarIdm (), Utils::formatNumber ($concepto->getCaCobrarMin () ) . " " . $concepto->getCaCobrarIdm (), $concepto->getCaObservaciones (), '' ) );

        }else{
            
            $pdf->SetWidths(array(40,10,20,20,20,20,20,20,30));
            $pdf->SetFills(array(1,0,0,0,0,0,0,0,0,0));
            $pdf->SetStyles(array("B","","","","","","","","",""));
            $pdf->SetAligns(array("L","C","R","R","R","R","R","R","L"));

            $pdf->Row ( array ($concepto->getConcepto ()->getCaConcepto (), $concepto->getCaCantidad (), Utils::formatNumber($concepto->getCaNetaTar ()) . " " . $concepto->getCaNetaIdm (), $concepto->getCaNetaMin () . " " . $concepto->getCaNetaIdm (), Utils::formatNumber ( $concepto->getCaReportarTar () ). " " . $concepto->getCaReportarIdm (), $concepto->getCaReportarMin () . " " . $concepto->getCaReportarIdm (), Utils::formatNumber ($concepto->getCaCobrarTar ()) . " " . $concepto->getCaCobrarIdm (), Utils::formatNumber ($concepto->getCaCobrarMin () ) . " " . $concepto->getCaCobrarIdm (), $concepto->getCaObservaciones () ) );
        }
    }
    
    $pdf->Ln ( 3 );
    $pdf->SetWidths ( array (200 ) );
    $pdf->SetFills ( array (1 ) );
    $pdf->SetAligns ( array ("C" ) );
    $pdf->SetStyles ( array ("B" ) );
    $pdf->Row ( array ('RELACI�N DE RECARGOS' ) );
    $sub_mem = 'Recargo en Origen';

    $pdf->SetWidths ( array (45, 35, 40, 40, 40 ) );
    $pdf->SetFills ( array (1, 1, 1, 1, 1 ) );
    $pdf->SetStyles ( array ("B", "B", "B", "B", "B" ) );
    $pdf->SetAligns ( array ("C", "C", "C", "C", "C" ) );
    $pdf->Row ( array ($sub_mem, 'Aplicaci�n', 'Neta / Min.', 'Reportar / Min.', 'Cobrar / Min' ) );

    $pdf->SetWidths ( array (45, 35, 20, 20, 20, 20, 20, 20 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "", "", "", "", "", "", "", "" ) );
    $pdf->SetAligns ( array ("L", "L", "R", "R", "R", "R", "R", "R" ) );
    
    $gastos = $reporte->getRecargos( "origen" );
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
            $pdf->Row ( array ($des_rec, $gasto->getCaAplicacion (), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ($gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
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

    if( $reporte->getCaImpoexpo () == Constantes::IMPO ){
        $sub_mem = 'Recargo Local';
        $pdf->Ln ( 3 );

        $gastos = $reporte->getRecargos ( "local" );

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
                $pdf->Row ( array ($des_rec, $gasto->getCaAplicacion (), $gasto->getCaCobrarTar () . " " . $gasto->getCaIdmoneda (), $gasto->getCaCobrarMin () . " " . $gasto->getCaIdmoneda () ) );
            } else {
                $pdf->Row ( array ($des_rec, $gasto->getCaAplicacion (), $gasto->getCaTipo () . " " . $gasto->getCaCobrarTar (), $gasto->getCaCobrarMin () . " " . $gasto->getCaIdmoneda () ) );
            }
            if ($gasto->getCaDetalles ()) {
                $pdf->SetWidths ( array (200 ) );
                $pdf->SetStyles ( array ("" ) );
                $pdf->SetFills ( array (0 ) );
                $pdf->Row ( array ("* Observaciones: " . $gasto->getCaDetalles () ) );
            }

        }
    }
}




if( ($reporte->getCaImpoexpo()=="Importaci�n" && $reporte->getCaColmas()=="S�") || ($reporte->getCaImpoexpo()=="Exportaci�n" && ($repexpo->getCaIdSia()==17 || $repexpo->getCaIdSia()==9 ) ) ){

	$costosAduana = $reporte->getCostos ( "aduana" );
	if (count ( $costosAduana )) {
		$pdf->Ln ( 3 );
		$pdf->SetWidths ( array (200 ) );
		$pdf->SetFills ( array (1 ) );
		$pdf->SetAligns ( array ("C" ) );
		$pdf->SetStyles ( array ("B" ) );
		$pdf->Row ( array ('CONCEPTOS DE COBRO EN AGENCIAMIENTO COLMAS LTDA.' ) );

		$pdf->SetWidths ( array (49, 8, 21, 21, 21, 10, 70 ) );
		$pdf->SetFills ( array_fill ( 0, 7, "1" ) );
		$pdf->SetAligns ( array_fill ( 0, 7, "C" ) );
		$pdf->SetStyles ( array_fill ( 0, 7, "B" ) );
		$pdf->Row ( array ('Concepto', 'Tipo', 'Neto', 'Valor', 'M�nimo', 'Mnd', 'Detalles' ) );

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

    
    

    

$pdf->Ln(3);
$line = $pdf->GetAttrib('y');
for ($i=$line; $i<274; $i+=5){
  $pdf->Cell(0, 5, str_repeat(" . ", 84), 0, 1);
}
$pdf->SetY(275);
$pdf->SetWidths(array(15,24,15,24,15,32,25,50));
$pdf->SetFills(array(1,0,1,0,1,0,1,0));
$pdf->SetStyles(array("B","B","B","B","B","B","B","B"));
$pdf->SetAligns(array("L","L","L","L","L","C","L","C"));


$vendedor = $reporte->getUsuario();
$fch_mem = $reporte->getCaFchactualizado()?$reporte->getCaFchactualizado():$reporte->getCaFchcreado();
$usu_mem = $reporte->getCaFchactualizado()?$reporte->getCaUsuactualizado():$reporte->getCaUsucreado();
$pdf->Row(array('Ciudad :',$vendedor->getSucursal()->getCaNombre(), 'Elabor� :',$usu_mem,'Fecha:',Utils::fechaMes( $fch_mem ),'Rep. Comercial:', $vendedor->getCaNombre() ));
//,$rs->Value('ca_vendedor')));*/






















$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}

?>