<?
$reporte = $sf_data->getRaw("reporte");
$pdf = new PDF ( 'P', 'mm', 'letter' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( false );

$pdf->SetAutoPageBreak(true, 0);
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

$id_cotizacion = null;

$pdf->Row ( array ('Reporte No.: ', $reporte->getCaConsecutivo (), 'Versi�n No.: ', $reporte->getCaVersion () . "/" . $reporte->numVersiones(), 'Fecha Reporte: ', Utils::fechaMes ( $reporte->getCaFchreporte () ), 'Cotizaci�n: ', $reporte->getCaIdcotizacion () ) );

$pdf->SetWidths ( array (200 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetFills ( array (0 ) );
$pdf->Row ( array ('Informaci�n General' ) );

$pdf->SetWidths ( array (30, 85, 85 ) );
$pdf->SetAligns ( array ("C", "C", "C" ) );
$pdf->SetStyles ( array ("", "B", "B" ) );
$pdf->SetFills ( array (1, 1, 1 ) );
$pdf->Row ( array ('Clase', 'Origen', 'Destino' ) );
$pdf->SetFills ( array (0, 0, 0 ) );

$origen = $reporte->getOrigen ();
$destino = $reporte->getDestino ();
$pdf->Row ( array ($reporte->getCaImpoexpo (), $origen->getCaCiudad () . ' - ' . $origen->getTrafico ()->getCaNombre (), $destino  ) );

$agente=null;
//if($reporte->getCaIdagente()!="")
{
    $agente = $reporte->getIdsAgente();
    $sucursalag=$reporte->getIdsSucursal();
    if(!$sucursalag)
        $sucursalag = new $sucursalag();

    $pdf->SetWidths(array(26,17,25,132));
    $pdf->SetAligns(array("L","L","L","L","L","L"));
    $pdf->SetFills(array(0,0,0,0,0,0));
    $pdf->SetStyles(array("B","","B","","B",""));
    if ($reporte->getCaImpoexpo () == Constantes::IMPO ) {
        $pdf->Row(array('Fch.Despacho:',$reporte->getCaFchdespacho () ,'Agente:', $agente->getIds()->getCaNombre(). "-".$sucursalag->getCiudad()->getCaCiudad()." ".$sucursalag->getCaDireccion()  ));
    }else{
        $pdf->Row ( array ('Fch.Despacho:', $reporte->getCaFchdespacho (), 'Incoterms:', $reporte->getCaIncoterms () ) );
    }
}

$pdf->SetWidths(array(200));
$pdf->SetStyles(array(""));
$pdf->Row(array('Descripci�n de la Mercancia:'."\n".$reporte->getCaMercanciaDesc().' �'.(($reporte->getCaMciaPeligrosa())?"S�":"NO")." es Mercanc�a Peligrosa�"));
    
//$pdf->Ln(3);

if ($reporte->getCaImpoexpo () == Constantes::EXPO && $reporte->getCaTiporep()!="3" ) {
	$repexpo = $reporte->getRepExpo ();

    if(!$repexpo)
        $repexpo=new $repExpo();

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
	$pdf->Row ( array ('Peso (Kgs):', $repexpo->getCaPeso (), 'Volumen:', html_entity_decode($repexpo->getCaVolumen ()), 'Piezas:', str_replace ( "|", " ", $repexpo->getCaPiezas () ), 'Dimensiones:', $repexpo->getCaDimensiones () != "0|0|0" ? str_replace ( "|", "x", $repexpo->getCaDimensiones () ) : "" ) );

	$pdf->SetWidths ( array (26, 17, 35, 20, 25, 77 ) );
	$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "L", "L", "L" ) );
	$pdf->SetFills ( array (0, 0, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('Valor carga:', Utils::formatNumber ( $repexpo->getCaValorcarga () ), 'Solicitud anticipo:', $repexpo->getCaAnticipo ()/*($reporte->getCaLiberacion()=="S�"||$reporte->getCaLiberacion()=="Si")?"No":"S�"*/, 'Tipo de exportacion:', $repexpo->getTipoExpo () ) );

	$pdf->SetWidths ( array (26, 72, 25, 25, 27, 25 ) );
	$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "L", "L", "L" ) );
	$pdf->SetFills ( array (0, 0, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('Agente Aduanero:', $repexpo->getSia(), ( $reporte->getCaTransporte()==Constantes::MARITIMO )?'Emision BL:':'', $repexpo->getCaEmisionbl (), ( $reporte->getCaTransporte()==Constantes::MARITIMO )?'Motonave:':'Vuelo', $repexpo->getCaMotonave () ) );

    if($agente!=null && $agente && $reporte->getCaIdagente ()!="")
    {
        $pdf->Ln ( 3 );
        $pdf->SetWidths ( array (30, 25, 145 ) );
        $pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
        $pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
        $pdf->Row ( array ('Agente:', '10.1 Nombre:', $agente->getIds()->getCaNombre() ) );
        $ids = new Ids();

        $sucAgente = $agente->getIds()->getSucursalPrincipal();

        $pdf->SetWidths ( array (5, 25, 170 ) );
        $pdf->Row ( array ('', 'Direcci�n:', str_replace ( "|", " ", $sucAgente->getCaDireccion () . " " . $sucAgente->getCaZipcode () ) ) );
        $pdf->SetWidths ( array (5, 25, 40, 15, 30, 18, 67 ) );
        $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
        $pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
        $pdf->Row ( array ('', 'Tel�fono:', $sucAgente->getCaTelefonos (), 'Fax:', $sucAgente->getCaFax () ) );
    }
}
if(!$repexpo)
{    
   $repexpo=new RepExpo();
}

$ordenes = array_combine(explode("|",$reporte->getCaIdproveedor()), explode("|",$reporte->getCaOrdenProv()));
$terminos= array_combine(explode("|",$reporte->getCaIdproveedor()), explode("|",$reporte->getCaIncoterms()));

$idproveedores = explode("|",$reporte->getCaIdproveedor());

foreach( $idproveedores as $idprov ){
    if($idprov=="")
        continue;
    $pdf->Ln(2);
    $tercero = Doctrine::getTable("Tercero")->find($idprov);
    if(!$tercero)
        $tercero=new Tercero();

    $orden = $ordenes[$idprov];
    $termino = substr($terminos[$idprov],0,3);
    $pdf->SetWidths(array(25,25,85,25,40));
    $pdf->SetFills(array(1,0,0,0,0,0,0));
    $pdf->SetStyles(array("B","B","","B",""));
    $pdf->Row(array('Proveedor:','Nombre:',($tercero->getCaNombre()),'Orden:',$orden));
    $pdf->SetWidths(array(5,20,70,25,80));
    $pdf->Row(array('','Contacto:',($tercero->getCaContacto()),'Direcci�n:',($tercero->getCaDireccion()) ));
    $pdf->SetWidths(array(5,20,40,15,30,18,40,22,10));
    $pdf->SetStyles(array("B","B","","B","","B","","B",""));
    $pdf->Row(array('','Tel�fono:',$tercero->getCaTelefonos(),'Fax:',$tercero->getCaFax(),'E-mail:',$tercero->getCaEmail(),'Incoterms:',$termino));
    $pdf->Ln(1);
}

$pdf->Ln(2);
$contacto = $reporte->getContacto();
$cliente = $contacto->getCliente();
$pdf->SetWidths ( array (25, 25, 85, 25, 40 ) );
$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
$pdf->Row ( array ('Cliente:', 'Nombre:', $cliente->getCaCompania ()." Nit : ".$cliente->getCaIdcliente()."-".$cliente->getCaDigito(), $reporte->getCaOrdenClie () != "''" ? 'Orden:' : ' ', $reporte->getCaOrdenClie () != "''" ? $reporte->getCaOrdenClie () : " " ) );
$pdf->SetWidths ( array (5, 20, 70, 25, 80 ) );
$pdf->Row ( array ('', 'Contacto:', ($contacto->getNombre ()) , 'Direcci�n:', $cliente->getDireccion ()  ) );
$pdf->SetWidths ( array (5, 20, 40, 15, 30, 18, 72 ) );
$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('', 'Tel�fono:', $cliente->getCaTelefonos (), 'Fax:', $cliente->getCaFax (), 'E-mail:', $contacto->getCaEmail () ) );



if($reporte->getCaIdclienteag()>0)
{
    $pdf->Ln(2);
    $cliente = $reporte->getClienteAg();
    $pdf->SetWidths ( array (25, 25, 85, 25, 40 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
    $pdf->Row ( array ('Facturar Agente:', 'Nombre:', $cliente->getCaCompania ()." Codigo : ".$cliente->getCaIdcliente(), $reporte->getCaOrdenClie () != "''" ? 'Orden:' : ' ', $reporte->getCaOrdenClie () != "''" ? $reporte->getCaOrdenClie () : " " ) );
    $pdf->SetWidths ( array (5, 20, 70, 25, 80 ) );
    $pdf->Row ( array ('', 'Contacto:', utf8_decode($contacto->getNombre ()) , 'Direcci�n:', str_replace ( "|", " ", utf8_decode($cliente->getCaDireccion ()) ) . $cliente->getCaComplemento () ) );
    $pdf->SetWidths ( array (5, 20, 40, 15, 30, 18, 72 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
    $pdf->Row ( array ('', 'Tel�fono:', $cliente->getCaTelefonos (), 'Fax:', $cliente->getCaFax (), 'E-mail:', $contacto->getCaEmail () ) );
}


if($reporte->getCaIdclientefac()>0)
{
    $pdf->Ln(2);
    $cliente = $reporte->getClienteFac();
    $pdf->SetWidths ( array (25, 25, 85, 25, 40 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
    $pdf->Row ( array ('Facturar:', 'Nombre:', $cliente->getCaCompania ()." Nit : ".$cliente->getCaIdcliente()."-".$cliente->getCaDigito(), $reporte->getCaOrdenClie () != "''" ? 'Orden:' : ' ', $reporte->getCaOrdenClie () != "''" ? $reporte->getCaOrdenClie () : " " ) );
    $pdf->SetWidths ( array (5, 20, 70, 25, 80 ) );
    $pdf->Row ( array ('', 'Contacto:', utf8_decode($contacto->getNombre ()) , 'Direcci�n:', str_replace ( "|", " ", utf8_decode($cliente->getCaDireccion ()) ) . $cliente->getCaComplemento () ) );
    $pdf->SetWidths ( array (5, 20, 40, 15, 30, 18, 72 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
    $pdf->Row ( array ('', 'Tel�fono:', $cliente->getCaTelefonos (), 'Fax:', $cliente->getCaFax (), 'E-mail:', $contacto->getCaEmail () ) );
}

if($reporte->getCaIdclienteotro()>0)
{
    $pdf->Ln(2);
    $cliente = $reporte->getClienteOtro();
    $pdf->SetWidths ( array (25, 25, 85, 25, 40 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
    $pdf->Row ( array ('Facturar Otros Servicios:', 'Nombre:', $cliente->getCaCompania ()." Nit : ".$cliente->getCaIdcliente()."-".$cliente->getCaDigito(), $reporte->getCaOrdenClie () != "''" ? 'Orden:' : ' ', $reporte->getCaOrdenClie () != "''" ? $reporte->getCaOrdenClie () : " " ) );
    $pdf->SetWidths ( array (5, 20, 70, 25, 80 ) );
    $pdf->Row ( array ('', 'Contacto:', utf8_decode($contacto->getNombre ()) , 'Direcci�n:', str_replace ( "|", " ", utf8_decode($cliente->getCaDireccion ()) ) . $cliente->getCaComplemento () ) );
    $pdf->SetWidths ( array (5, 20, 40, 15, 30, 18, 72 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
    $pdf->Row ( array ('', 'Tel�fono:', $cliente->getCaTelefonos (), 'Fax:', $cliente->getCaFax (), 'E-mail:', $contacto->getCaEmail () ) );
}

$consignatario=null;
$consignatario = $reporte->getConsignatario();
if (trim($reporte->getCaContinuacion())!= "OTM" || (trim($reporte->getCaContinuacion())=="" || $reporte->getCaImpoexpo()==constantes::EXPO) || (trim($reporte->getCaContinuacion())=="DTA" || $reporte->getCaImpoexpo()==constantes::EXPO) && $reporte->getConsignatario()>4 )
{    
    if ($consignatario) {
        $pdf->Ln ( 3 );
        $pdf->SetWidths ( array (25, 25, 85, 40, 25 ) );
        $pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
        $pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
        $pdf->Row ( array ('Consignatario:', 'Nombre:', $consignatario->getCaNombre () . "  ".$consignatario->getCaIdentificacion (), $reporte->getCaImpoexpo () == "Exportaci�n" ? 'Identificacion' : 'Enviar Informaci�n:', $reporte->getCaImpoexpo () == "Exportaci�n" ? $consignatario->getCaIdentificacion () : $reporte->getCaInformarCons () ) );

        $pdf->SetWidths ( array (5, 22, 68, 25, 80 ) );
        $pdf->Row ( array ('', 'Cont.:', $consignatario->getCaContacto (), 'Direcci�n:', str_replace ( "|", " ", $consignatario->getCaDireccion () ) ) );
        $pdf->SetWidths ( array (5, 22, 38, 15, 30, 20, 70 ) );
        $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
        $pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
        $pdf->Row ( array ('', 'Tel.:', $consignatario->getCaTelefonos (), 'Fax:', $consignatario->getCaFax (), 'E-mail:', $consignatario->getCaEmail () ) );
    }
}

$notify = $reporte->getNotify ();
if ($notify) {
	$pdf->Ln ( 3 );

	$pdf->SetWidths ( array (25, 25, 85, 40, 25 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "" ) );
	$pdf->Row ( array ('Notify:', 'Nombre:', $notify->getCaNombre (),  'Enviar Informaci�n:', $reporte->getCaInformarNoti() ) );

	$pdf->SetWidths ( array (5, 22, 68, 25, 80 ) );
	$pdf->Row ( array ('', 'Cont.:', $notify->getCaContacto (), 'Direcci�n:', str_replace ( "|", " ", $notify->getCaDireccion () ) ) );
	$pdf->SetWidths ( array (5, 22, 38, 15, 30, 20, 70 ) );
	$pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
	$pdf->SetStyles ( array ("B", "B", "", "B", "", "B", "" ) );
	$pdf->Row ( array ('', 'Tel.:', $notify->getCaTelefonos (), 'Fax:', $notify->getCaFax (), 'E-mail:', $notify->getCaEmail () ) );
}

if( $reporte->getCaIdconsignarmaster()>4 ){
    $pdf->Ln(2);
    $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignarmaster());
        
    $orden = $ordenes[$idprov];
    $termino = substr($terminos[$idprov],0,3);
    $pdf->SetWidths(array(25,25,85,25,40));
    $pdf->SetFills(array(1,0,0,0,0,0,0));
    $pdf->SetStyles(array("B","B","","B",""));
    $pdf->Row(array('Consigna.Master:','Nombre:',$tercero->getCaNombre(),'Enviar Informaci�n:',$reporte->getCaInformarMast()));
    $pdf->SetWidths(array(5,20,70,25,80));
    $pdf->Row(array('','Contacto:',($tercero->getCaContacto()?$tercero->getCaContacto():""),'Direcci�n:',($tercero->getCaDireccion()?$tercero->getCaDireccion():"") ));
    $pdf->SetWidths(array(5,20,40,15,30,18,40,22,10));
    $pdf->SetStyles(array("B","B","","B","","B","","B",""));
    $pdf->Row(array('','Tel�fono:',$tercero->getCaTelefonos(),'Fax:',$tercero->getCaFax(),'E-mail:',$tercero->getCaEmail(),'7.7 Incoterms:',$termino));
    $pdf->Ln(1);
}

if( $reporte->getCaIdrepresentante() ){
    $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdrepresentante());

    if(!$tercero)
        $tercero = new Tercero();
    
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

$pdf->Ln(2);

$pdf->SetWidths(array(200));
$pdf->SetFills(array(1));
$pdf->Row(array(''));

$pdf->SetWidths(array(200));
$pdf->SetStyles(array(""));
$pdf->SetFills(array(0));
$pdf->MultiCell(200,4,'Preferencias del Cliente:'."\n".($reporte->getCaPreferenciasClie ()),1);
$pdf->Ln(2);
//$pdf->Row(array('Preferencias del Cliente:'."\n".($reporte->getCaPreferenciasClie ()) ));

$pdf->SetWidths(array(200));
$pdf->SetStyles(array(""));
$pdf->Row(array('Instrucciones Especiales para el Agente:'."\n".$reporte->getCaInstrucciones ()));

$pdf->SetWidths(array(45,50,50,55));
$pdf->SetStyles(array("B","","","",""));
$emails = explode ( ",", $reporte->getCaConfirmarClie () );
$z = 0;
$cadena = "Copiar comunicaciones a:";
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
$pdf->Ln(2);

$transportista = $reporte->getIdsProveedor();
if ( $transportista ) {
    $nombreTransporte = $transportista->getIds()->getCaNombre();;
} else {
    $nombreTransporte = "";
}

$pdf->SetWidths ( array (25, 25, 22, 23, 35, 70 ) );
$pdf->SetFills ( array (0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('Transporte:', $reporte->getCaTransporte (), 'Modalidad:', $reporte->getCaModalidad (), 'L�nea Transporte:', $nombreTransporte ) );

$tiempo_cred = ($reporte->getCaLiberacion()=='S�')?" Tiempo de Cr�dito: ".$reporte->getCaTiempocredito():"";

if( $reporte->getCaImpoexpo()==Constantes::IMPO ){
    $pdf->SetWidths ( array (40, 10, 35, 10, 35, 70 ) );
    $pdf->Row ( array ('Colmas Ltda:', $reporte->getCaColmas (), 'Seguro:', $reporte->getCaSeguro () ,'Lib. Autom�tica:' ,$reporte->getCaLiberacion().$tiempo_cred ) );
    if( $reporte->getCaTransporte()==Constantes::MARITIMO && $reporte->getCaModalidad()=='FCL' )
        $pdf->Row ( array ('Firma Contrato Comodato', $reporte->getCaComodato(), '', '' ,'' ,'' ) );
}else{
    $pdf->SetWidths ( array ( 55, 25, 45,75 ) );
    $pdf->Row ( array ('Seguro:', $reporte->getCaSeguro (), "Tiempo de Cr�dito:", $reporte->getCaTiempocredito()  ) );
}

if( ($reporte->getCaContinuacion()!= "N/A" && $reporte->getCaContinuacion()!= "" && $reporte->getCaImpoexpo() == constantes::IMPO ) ) {
    $pdf->Ln(2);
    $pdf->SetWidths(array(200));
    $pdf->SetFills(array(1));
    $pdf->SetAligns(array("C"));
    $pdf->SetStyles(array("B"));
    $pdf->Row(array('CONTINUACI�N DE VIAJE'));
    $pdf->SetWidths(array(35,10,28,20,42,65));
    $pdf->SetAligns(array("L","L","L","L","L","L"));
    $pdf->SetStyles(array("B","","B","","B",""));
    $pdf->SetFills(array(0,0,0,0,0,0));
    $not_cont="";
    if($reporte->getCaContinuacionConf()!="")
    {
        $usuario = Doctrine::getTable("Usuario")->find($reporte->getCaContinuacionConf());
        if($usuario)
        {
           $not_cont= $usuario->getCaEmail();
        }
        else
        {
            $usuarios = Doctrine::getTable("Usuario")
               ->createQuery("u")
               ->select("u.ca_login,u.ca_nombre,u.ca_email,ca_sucursal")
               ->innerJoin("u.UsuarioPerfil up")
               ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE','cordinador-de-otm'))
               ->addWhere("u.ca_idsucursal=?",array($reporte->getCaContinuacionConf()))
               ->addOrderBy("u.ca_idsucursal")
               ->addOrderBy("u.ca_nombre")
               ->execute();
            foreach($usuarios as $usuario)
            {
                if($not_cont!="")
                    $not_cont.=",";
                $not_cont.=$usuario->getCaEmail();
            }
        }
    }

    $pdf->Row(array('Continuaci�n/Viaje:',$reporte->getCaContinuacion(),'Destino final:',$reporte->getDestinoCont()->getCaCiudad(),'Notificar C/Viaje al email:',$not_cont));
}
else if ( $reporte->getCaImpoexpo () == Constantes::EXPO  && $reporte->getCaContOrigen()!="" && $reporte->getCaContDestino()!="" ) {
    $pdf->Ln(2);
    $pdf->SetWidths(array(200));
    $pdf->SetFills(array(1));
    $pdf->SetAligns(array("C"));
    $pdf->SetStyles(array("B"));
    $pdf->Row(array('DTA'));
    $pdf->SetWidths(array(35,10,28,20,42,65));
    $pdf->SetAligns(array("L","L","L","L","L","L"));
    $pdf->SetStyles(array("B","","B","","B",""));
    $pdf->SetFills(array(0,0,0,0,0,0));

    if($reporte->getCaTransporte()==constantes::TERRESTRE)
        $ciu_destino=$reporte->getDestinoCont()->getCaCiudad();
    else
        $ciu_destino=$reporte->getContDestino()->getCaNombre();

    $pdf->Row(array('Origen:',$reporte->getContOrigen()->getCaNombre(),'Destino:',$ciu_destino));
}

if($reporte->getCaTiporep()!="3")
{
    if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
        $pdf->SetWidths ( array (45, 50, 55, 50 ) );        
        if($reporte->getConsignar())
        {
            //$data["idconsignatario"]=$reporte->getConsignar();
            $cadena =$reporte->getConsignar();
        }
        $pdf->Row ( array ('Consignar MAWB/BL a :', $reporte->getConsignarmaster (),'Consignar HAWB/HBL a :', $cadena ) );
    }else{
        $pdf->SetWidths(array(45,115,30,10));
        $consig = (($consignatario)?$consignatario->getCaNombre():$cliente->getCaCompania());
        $nit = (($consignatario)?$consignatario->getCaIdentificacion():$cliente->getCaIdcliente()."-".$cliente->getCaDigito());
        $consignar = Doctrine::getTable("Bodega")->find( $reporte->getCaIdconsignar() );

        if( $consignar->getCaNombre()=='Nombre del Cliente' || $consignar->getCaNombre()=='Cliente / Consignatario' ){
            if($reporte->getCaContinuacion()== "OTM" || $reporte->getCaContinuacion()== "DTA")
            {
                $cadena = $consig;
                $cadena.=" NIT ".$nit;
            }
            else
            {
                $cadena=$consignar->getCaNombre();
            }
        }else{
            if( $reporte->getCaContinuacion()== "DTA")
            {
                $cadena = $consig;
                $cadena.=" NIT ".$nit;
            }
            else
                $cadena = $consignar->getCaNombre();
        }

         if( $reporte->getCaIdbodega() && $reporte->getCaIdbodega()!= 111 && $reporte->getCaIdbodega()!=1 ){ //Coltrans
            $bodega = Doctrine::getTable("Bodega")->find( $reporte->getCaIdbodega() );
            if($bodega->getCaTipo()=="Entrega en Lugar de Arribo")
                $cadena.=" / ".$bodega->getCaNombre();
            else
                $cadena.=" / ".$bodega->getCaTipo()." ".$bodega->getCaNombre();
        }
        else if($reporte->getCaIdbodega()==1 && (trim($reporte->getCaContinuacion())!= "N/A" && trim($reporte->getCaContinuacion())!="") )
        {
            $cadena='Cliente / Consignatario';
        }
        $pdf->Row(array('Consignar HAWB/HBL a :',$cadena));
    }
}

if ($reporte->getCaSeguro () == "S�") {

    $pdf->Ln ( 3 );

    $repseguro = $reporte->getRepSeguro ();
    if($repseguro)
    {
        $pdf->SetWidths(array(200));
        $pdf->SetFills(array(1));
        $pdf->SetAligns(array("C"));
        $pdf->SetStyles(array("B"));
        $pdf->Row(array('INFORMACI�N PARA LA ASEGURADORA'));

        $pdf->SetWidths(array(35,35,35,95));
        $pdf->SetFills(array(1,1,1,1));
        $pdf->SetAligns(array("C","C","C","C"));
        $pdf->SetStyles(array("B","B","B","B"));
        $pdf->Row(array('Vlr.Asegurado:','Obtenci�n P�liza:','Prima Venta:','Notificar Seguro:'));
        $pdf->SetStyles(array("","","",""));
        $pdf->SetFills(array(0,0,0,0));
        $pdf->SetAligns(array("C","C","C","L"));
        $usuario = Doctrine::getTable("Usuario")->find( $repseguro->getCaSeguroConf() );
        if(!$usuario)
            $usuario = new Usuario();
        $pdf->Row(array(Utils::formatNumber($repseguro->getCaVlrasegurado(),3)." ".$repseguro->getCaIdmonedaVlr (),Utils::formatNumber($repseguro->getCaObtencionpoliza(),3)." ".$repseguro->getCaIdmonedaPol(), $repseguro->getCaPrimaventa () . "%\nMin." . $repseguro->getCaMinimaventa()." ".$repseguro->getCaIdmonedaVta(),$usuario->getCaEmail()));
    }
}

if( (($reporte->getCaImpoexpo()==Constantes::IMPO || $reporte->getCaImpoexpo()=="OTM/DTA") && $reporte->getCaColmas()=="S�") || $reporte->getCaTiporep()=="3" ||  ($reporte->getCaImpoexpo()==Constantes::EXPO &&  ($repexpo->getCaIdsia()==17 || $repexpo->getCaIdsia()==9) ) ){
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
        $pdf->Row ( array ('Transporte de carga nacionalizada', 'Instrucciones Especiales para Colmas:' ) );
    }else{
        $pdf->Row ( array ('Transporte nacional', 'Instrucciones Especiales para Colmas:' ) );
    }
	$pdf->SetWidths ( array ( 40,  160 ) );
	$pdf->SetFills ( array ( 0,  0 ) );
	$pdf->SetAligns ( array ( "L",  "L" ) );
	$pdf->SetStyles ( array ( "",  "" ) );

    $usuario = Doctrine::getTable("Usuario")->find( $repaduana->getCaCoordinador () );
	$pdf->Row ( array ( /*$titulo1. $repaduana->getCaTransnacarga (),*/ /*"Tipo:\n" . $repaduana->getCaTransnatipo(),*/ "Coordinador:\n" . ($usuario?$usuario->getCaNombre():""), $repaduana->getCaInstrucciones () ) );
}

$pdf->Ln ( 3 );
$pdf->SetWidths ( array (200 ) );
$pdf->SetFills ( array (1 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetStyles ( array ("B" ) );

$soloAduana = $reporte->esSoloAduana();
if( !$soloAduana && $reporte->getCaTiporep()!="3" ){
    //$pdf->beginGroup();
    $pdf->Row ( array ('EMBARQUE ' . strtoupper ( $reporte->getCaTransporte () ) ) );

    $conceptos = $reporte->getRepTarifa();

    if( $reporte->getCaTransporte()==Constantes::AEREO ){
        if($reporte->getCaImpoexpo()!=constantes::EXPO)
        {
/*
            $pdf->SetWidths(array(5,40,50,50,50,5));
            $pdf->SetFills(array(0,1,1,1,1,0));
            $pdf->SetStyles(array("B","B","B","B","B"));
            $pdf->SetAligns(array("C","C","C","C","C"));
            $pdf->Row(array('Concepto:','Neta / Min.','Reportar / Min.','Cobrar / Min', 'Observaciones'));
*/
            
            $pdf->SetWidths(array(40,40,40,40,40));
            $pdf->SetFills(array(1,1,1,1,1));
            $pdf->SetStyles(array("B","B","B","B","B"));
            $pdf->SetAligns(array("C","C","C","C","C"));
            $pdf->Row(array('Concepto:','Neta / Min.','Reportar / Min.','Cobrar / Min', 'Observaciones'));

        }
        else
        {
            $pdf->SetWidths(array(40,40,40,40,40));
            $pdf->SetFills(array(1,1,1,1,1));
            $pdf->SetStyles(array("B","B","B","B","B"));
            $pdf->SetAligns(array("C","C","C","C","C"));
            $pdf->Row(array('Concepto:','Neta / Min.','Reportar / Min.','Cobrar / Min', 'Observaciones'));
        }
    }else{
        $pdf->SetWidths(array(40,10,40,40,40,30));
        $pdf->SetFills(array(1,1,1,1,1,1));
        $pdf->SetStyles(array("B","B","B","B","B","B"));
        $pdf->SetAligns(array("C","C","C","C","C","C"));
        $pdf->Row(array('Concepto:','Cant.','Neta / Min.','Reportar / Min.','Cobrar / Min', 'Observaciones'));
    }

    foreach ( $conceptos as $concepto ) {
 //       $pdf->beginGroup();
        if($concepto->getCaIdconcepto()=="9999")
                continue;
        if( $reporte->getCaTransporte()==Constantes::AEREO ){
           if($reporte->getCaImpoexpo()!=constantes::EXPO)
            {              
/*                $pdf->SetWidths(array(5,40,25,25,25,25,50,5));
                $pdf->SetFills(array(1,0,0,0,0,0,0,0));
                $pdf->SetStyles(array("","","","","","","",""));
                $pdf->SetAligns(array("L","L","R","R","R","R","L","L"));
                $pdf->Row ( array ('',$concepto->getConcepto()->getCaConcepto (),  ( $concepto->getCaReportarTar () ). " " . $concepto->getCaReportarIdm (), $concepto->getCaReportarMin () . " " . $concepto->getCaReportarIdm (),  ($concepto->getCaCobrarTar ()) . " " . $concepto->getCaCobrarIdm (),  ($concepto->getCaCobrarMin () ) . " " . $concepto->getCaCobrarIdm (), utf8_decode($concepto->getCaObservaciones ()) , '' ) );
*/

                $pdf->SetWidths(array(40,20,20,20,20,20,20,40));
                $pdf->SetFills(array(1,0,0,0,0,0,0,0,0));
                $pdf->SetStyles(array("B","","","","","","","",""));
                $pdf->SetAligns(array("L","R","R","R","R","R","R","L"));

                $pdf->Row ( array ($concepto->getConcepto ()->getCaConcepto (),  Utils::formatNumber($concepto->getCaNetaTar ()) . " " . $concepto->getCaNetaIdm (), $concepto->getCaNetaMin () . " " . $concepto->getCaNetaIdm (), Utils::formatNumber ( $concepto->getCaReportarTar () ). " " . $concepto->getCaReportarIdm (), $concepto->getCaReportarMin () . " " . $concepto->getCaReportarIdm (), Utils::formatNumber ($concepto->getCaCobrarTar ()) . " " . $concepto->getCaCobrarIdm (), Utils::formatNumber ($concepto->getCaCobrarMin () ) . " " . $concepto->getCaCobrarIdm (), utf8_decode($concepto->getCaObservaciones ()) ) );

                $gastos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->innerJoin("t.TipoRecargo r")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", $concepto->getCaIdconcepto() )
                             ->addWhere("t.ca_recargoorigen = true")
                             ->orderBy("r.ca_recargo")
                             ->execute();

            if(count($gastos)<=0)
                continue;

                $sub_mem = 'Recargo en Origen';

                $pdf->SetWidths ( array (5,40, 35, 40, 40, 40 ) );
                $pdf->SetFills ( array (1,1, 1, 1, 1, 1 ) );
                $pdf->SetStyles ( array ("","B", "B", "B", "B", "B" ) );
                $pdf->SetAligns ( array ("","C", "C", "C", "C", "C" ) );
                $pdf->Row ( array ("+",$sub_mem, 'Aplicaci�n', 'Neta / Min.', 'Reportar / Min.', 'Cobrar / Min' ) );

                $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
                $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
                $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
                $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );

                foreach ( $gastos as $gasto ) {
                    $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
                    $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
                    $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
                    $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );

                    $des_rec = $gasto->getTipoRecargo ()->getCaRecargo ();
                    if ($gasto->getCaIdconcepto () != '9999') {
    //                    $des_rec .= " -> " . $gasto->getConcepto ()->getCaConcepto ();
                    }

                    if ($gasto->getCaTipo () == "$") {
                        $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ($gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                    } else {
                        $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                    }

                    if ($gasto->getCaDetalles ()) {
                        $pdf->SetWidths ( array (200 ) );
                        $pdf->SetStyles ( array ("" ) );
                        $pdf->SetFills ( array (0 ) );
                        $pdf->Row ( array ("* Observaciones: " . ($gasto->getCaDetalles ()) ) );
                    }
                }
                $pdf->Ln ( 1 );
            }
            else
            {
//                $pdf->beginGroup();
                $pdf->SetWidths(array(40,20,20,20,20,20,20,40));
                $pdf->SetFills(array(1,0,0,0,0,0,0,0,0));
                $pdf->SetStyles(array("B","","","","","","","",""));
                $pdf->SetAligns(array("L","R","R","R","R","R","R","L"));

                $pdf->Row ( array ($concepto->getConcepto ()->getCaConcepto (),  Utils::formatNumber($concepto->getCaNetaTar ()) . " " . $concepto->getCaNetaIdm (), $concepto->getCaNetaMin () . " " . $concepto->getCaNetaIdm (), Utils::formatNumber ( $concepto->getCaReportarTar () ). " " . $concepto->getCaReportarIdm (), $concepto->getCaReportarMin () . " " . $concepto->getCaReportarIdm (), Utils::formatNumber ($concepto->getCaCobrarTar ()) . " " . $concepto->getCaCobrarIdm (), Utils::formatNumber ($concepto->getCaCobrarMin () ) . " " . $concepto->getCaCobrarIdm (), utf8_decode($concepto->getCaObservaciones ()) ) );

                 $gastos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->innerJoin("t.TipoRecargo r")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", $concepto->getCaIdconcepto() )
                             ->addWhere("t.ca_recargoorigen = true")
                             ->orderBy("r.ca_recargo")
                             ->execute();

            if(count($gastos)<=0)
                continue;

                $sub_mem = 'Recargo en Origen';

                $pdf->SetWidths ( array (5,40, 35, 40, 40, 40 ) );
                $pdf->SetFills ( array (1,1, 1, 1, 1, 1 ) );
                $pdf->SetStyles ( array ("","B", "B", "B", "B", "B" ) );
                $pdf->SetAligns ( array ("","C", "C", "C", "C", "C" ) );
                $pdf->Row ( array ("+",$sub_mem, 'Aplicaci�n', 'Neta / Min.', 'Reportar / Min.', 'Cobrar / Min' ) );

                $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
                $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
                $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
                $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );

                foreach ( $gastos as $gasto ) {
                    $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
                    $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
                    $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
                    $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );

                    $des_rec = $gasto->getTipoRecargo ()->getCaRecargo ();
                    if ($gasto->getCaIdconcepto () != '9999') {
    //                    $des_rec .= " -> " . $gasto->getConcepto ()->getCaConcepto ();
                    }

                    if ($gasto->getCaTipo () == "$") {
                        $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ($gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                    } else {
                        $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                    }

                    if ($gasto->getCaDetalles ()) {
                        $pdf->SetWidths ( array (200 ) );
                        $pdf->SetStyles ( array ("" ) );
                        $pdf->SetFills ( array (0 ) );
                        $pdf->Row ( array ("* Observaciones: " . ($gasto->getCaDetalles ()) ) );
                    }
                }
                $pdf->Ln ( 1 );
            }
        }else{             
            $pdf->SetWidths(array(40,10,20,20,20,20,20,20,30));
            $pdf->SetFills(array(1,0,0,0,0,0,0,0,0,0));
            $pdf->SetStyles(array("B","","","","","","","","",""));
            $pdf->SetAligns(array("L","C","R","R","R","R","R","R","L"));

            $pdf->Row ( array ($concepto->getConcepto ()->getCaConcepto (), $concepto->getCaCantidad (), Utils::formatNumber($concepto->getCaNetaTar ()) . " " . $concepto->getCaNetaIdm (), $concepto->getCaNetaMin () . " " . $concepto->getCaNetaIdm (), Utils::formatNumber ( $concepto->getCaReportarTar () ). " " . $concepto->getCaReportarIdm (), $concepto->getCaReportarMin () . " " . $concepto->getCaReportarIdm (), Utils::formatNumber ($concepto->getCaCobrarTar ()) . " " . $concepto->getCaCobrarIdm (), Utils::formatNumber ($concepto->getCaCobrarMin () ) . " " . $concepto->getCaCobrarIdm (), utf8_decode($concepto->getCaObservaciones ()) ) );

            $gastos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->innerJoin("t.TipoRecargo r")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", $concepto->getCaIdconcepto() )
                             ->addWhere("t.ca_recargoorigen = true")
                             ->orderBy("r.ca_recargo")
                             ->execute();
            if(count($gastos)<=0)
                continue;
            //$pdf->Row ( array ('RELACI�N DE RECARGOS' ) );
            $sub_mem = 'Recargo en Origen';

            $pdf->SetWidths ( array (5,40, 35, 40, 40, 40 ) );
            $pdf->SetFills ( array (1,1, 1, 1, 1, 1 ) );
            $pdf->SetStyles ( array ("","B", "B", "B", "B", "B" ) );
            $pdf->SetAligns ( array ("","C", "C", "C", "C", "C" ) );
            $pdf->Row ( array ("+",$sub_mem, 'Aplicaci�n', 'Neta / Min.', 'Reportar / Min.', 'Cobrar / Min' ) );

            $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
            $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
            $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
            $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );

            foreach ( $gastos as $gasto ) {
                $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
                $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
                $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
                $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );

                $des_rec = $gasto->getTipoRecargo ()->getCaRecargo ();
                if ($gasto->getCaIdconcepto () != '9999') {
//                    $des_rec .= " -> " . $gasto->getConcepto ()->getCaConcepto ();
                }

                if ($gasto->getCaTipo () == "$") {
                    $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ($gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                } else {
                    $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                }

                if ($gasto->getCaDetalles ()) {
                    $pdf->SetWidths ( array (200 ) );
                    $pdf->SetStyles ( array ("" ) );
                    $pdf->SetFills ( array (0 ) );
                    $pdf->Row ( array ("* Observaciones: " . utf8_decode($gasto->getCaDetalles ()) ) );
                }
            }            
            $pdf->Ln ( 1 );
        }
        $pdf->flushGroup();
    }
 //$pdf->beginGroup();
    $gastos = Doctrine::getTable("RepGasto")
                     ->createQuery("t")
                     ->innerJoin("t.TipoRecargo r")
                     ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                     ->addWhere("t.ca_idconcepto = ?", "9999" )
                     ->addWhere("t.ca_recargoorigen = true")
                     ->orderBy("r.ca_recargo")
                     ->execute();
    if(count($gastos)>0)
    {
            $pdf->SetWidths(array(200));
            $pdf->SetFills(array(1));
            $pdf->SetStyles(array("B"));
            $pdf->SetAligns(array("L"));
            $pdf->Row ( array ("Recargos generales del Trayecto" ) );
            $sub_mem = 'Recargo en Origen';
            $pdf->SetWidths ( array (5,40, 35, 40, 40, 40 ) );
            $pdf->SetFills ( array (1,1, 1, 1, 1, 1 ) );
            $pdf->SetStyles ( array ("","B", "B", "B", "B", "B" ) );
            $pdf->SetAligns ( array ("","C", "C", "C", "C", "C" ) );
            $pdf->Row ( array ("+",$sub_mem, 'Aplicaci�n', 'Neta / Min.', 'Reportar / Min.', 'Cobrar / Min' ) );
            $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
            $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
            $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
            $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );

            foreach ( $gastos as $gasto ) {
                $pdf->SetWidths ( array (5,40, 35, 20, 20, 20, 20, 20, 20 ) );
                $pdf->SetFills ( array (0,1, 0, 0, 0, 0, 0, 0, 0, 0 ) );
                $pdf->SetStyles ( array ("","B", "", "", "", "", "", "", "", "" ) );
                $pdf->SetAligns ( array ("","L", "L", "R", "R", "R", "R", "R", "R" ) );
                $des_rec = $gasto->getTipoRecargo ()->getCaRecargo ();
                if ($gasto->getCaTipo () == "$") {
                    $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ($gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                } else {
                    $pdf->Row ( array ("",$des_rec, utf8_decode($gasto->getCaAplicacion ()), Utils::formatNumber ( $gasto->getCaNetaTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaNetaMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaReportarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaReportarMin (), 3 ) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ) . " " . $gasto->getCaTipo (), Utils::formatNumber ( $gasto->getCaCobrarMin (), 3 ) . " " . $gasto->getCaIdmoneda () ) );
                }
                if ($gasto->getCaDetalles ()) {
                    $pdf->SetWidths ( array (200 ) );
                    $pdf->SetStyles ( array ("" ) );
                    $pdf->SetFills ( array (0 ) );
                    $pdf->Row ( array ("* Observaciones: " . ($gasto->getCaDetalles ()) ) );
                }
            }
            $pdf->Ln ( 1 );
    }
  //  $pdf->flushGroup();
  //  $pdf->beginGroup();
    if( $reporte->getCaImpoexpo () == Constantes::IMPO || $reporte->getCaImpoexpo ()==Constantes::OTMDTA || $reporte->getCaImpoexpo ()==Constantes::OTMDTA1   ){
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

            $des_rec = $gasto->getTipoRecargo ()->getCaRecargo ().(($gasto->getEquipo())?"->".$gasto->getEquipo()->getCaConcepto():"");

            if ($gasto->getCaTipo () == "$") {
                $pdf->Row ( array ($des_rec, utf8_decode($gasto->getCaAplicacion ()) ,Utils::formatNumber (  $gasto->getCaCobrarTar (), 3) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarMin (), 3) . " " . $gasto->getCaIdmoneda () ) );
            } else {
                $pdf->Row ( array ($des_rec, utf8_decode($gasto->getCaAplicacion ()), $gasto->getCaTipo () . " " . Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ), Utils::formatNumber ( $gasto->getCaCobrarMin () ,3) . " " . $gasto->getCaIdmoneda () ) );
            }
            if ($gasto->getCaDetalles ()) {
                $pdf->SetWidths ( array (200 ) );
                $pdf->SetStyles ( array ("" ) );
                $pdf->SetFills ( array (0 ) );
                $pdf->Row ( array ("* Observaciones: " . ($gasto->getCaDetalles () ) ) );
            }
        }
    }
//   $pdf->flushGroup();
//   $pdf->beginGroup();
    if( $reporte->getCaImpoexpo () == Constantes::IMPO || $reporte->getCaImpoexpo ()==Constantes::OTMDTA || $reporte->getCaImpoexpo ()==Constantes::OTMDTA1 || ($reporte->getCaImpoexpo () == Constantes::EXPO && $reporte->getCaTransporte()==Constantes::MARITIMO) ){
        $sub_mem = 'OTM-DTA';
        $pdf->Ln ( 3 );

        $gastos = $reporte->getRecargos ( constantes::OTMDTA );
        if(count($gastos)>0)
        {
            $pdf->SetWidths ( array (100, 40, 60 ) );
            $pdf->SetFills ( array (1, 1, 1 ) );
            $pdf->SetStyles ( array ("B", "B", "B" ) );
            $pdf->SetAligns ( array ("C", "C", "C" ) );
            $pdf->Row ( array ($sub_mem, 'Aplicacion', 'Cobrar / Min' ) );

            foreach ( $gastos as $gasto ) {

                $pdf->SetWidths ( array (100, 40, 30, 30 ) );
                $pdf->SetFills ( array (1, 0, 0, 0 ) );
                $pdf->SetStyles ( array ("B", "", "", "" ) );
                $pdf->SetAligns ( array ("L", "L", "R", "R" ) );

                $des_rec = ($gasto->getConcepto()?$gasto->getConcepto()->getCaConcepto():"" ). (($gasto->getEquipo())?"->".$gasto->getEquipo()->getCaConcepto():"");
                /*if ($gasto->getCaIdconcepto () != '9999') {
                    $des_rec .= " -> " . $gasto->getConcepto ()->getCaConcepto ();
                }*/

                if ($gasto->getCaTipo () == "$") {
                    $pdf->Row ( array ($des_rec, utf8_decode($gasto->getCaAplicacion ()) ,Utils::formatNumber (  $gasto->getCaCobrarTar (), 3) . " " . $gasto->getCaIdmoneda (), Utils::formatNumber ( $gasto->getCaCobrarMin (), 3) . " " . $gasto->getCaIdmoneda () ) );
                } else {
                    $pdf->Row ( array ($des_rec, utf8_decode($gasto->getCaAplicacion ()), $gasto->getCaTipo () . " " . Utils::formatNumber ( $gasto->getCaCobrarTar (), 3 ), Utils::formatNumber ( $gasto->getCaCobrarMin () ,3) . " " . $gasto->getCaIdmoneda () ) );
                }
                if ($gasto->getCaDetalles ()) {
                    $pdf->SetWidths ( array (200 ) );
                    $pdf->SetStyles ( array ("" ) );
                    $pdf->SetFills ( array (0));
                    $pdf->Row ( array ("* Observaciones: " . ($gasto->getCaDetalles () ) ) );
                }
            }
        }
    }
//    $pdf->flushGroup();
}

if( ($reporte->getCaImpoexpo()==constantes::IMPO && $reporte->getCaColmas()=="S�") ||($reporte->getCaTiporep()=="3") ||($reporte->getCaImpoexpo()==constantes::EXPO /*&& ($repexpo->getCaIdsia()==17 || $repexpo->getCaIdsia()==9 )*/ ) ){

	$costosAduana = $reporte->getCostos ( "aduana" );
	if (count ( $costosAduana )) {
//        $pdf->beginGroup();
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
			$pdf->Row ( array ($costo->getCosto ()->getCaCosto (), $costo->getCaTipo (), Utils::formatNumber ( $costo->getCaNetcosto () ), Utils::formatNumber ( $costo->getCaVlrcosto () ), Utils::formatNumber ( $costo->getCaMincosto () ), $costo->getCaIdmoneda (), utf8_decode($costo->getCaDetalles ()) ) );
		}
//        $pdf->flushGroup();
	}
}

$pdf->Ln(2);
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
$fch_mem = $reporte->getCaFchactualizado()!=""?$reporte->getCaFchactualizado():$reporte->getCaFchcreado();
$usu_mem = $reporte->getCaFchactualizado()!=""?$reporte->getCaUsuactualizado():$reporte->getCaUsucreado();
$pdf->Row(array('Ciudad :',$vendedor->getSucursal()->getCaNombre(), 'Elabor� :',$usu_mem,'Fecha:',Utils::fechaMes( $fch_mem ),'Rep. Comercial:', $vendedor->getCaNombre() ));
//,$rs->Value('ca_vendedor')));*/

$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}
?>
