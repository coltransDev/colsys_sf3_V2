<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$reporte = $sf_data->getRaw("reporte");
$equipos = $sf_data->getRaw("equipos");
$tarifas = $sf_data->getRaw("tarifas");
$itr = $sf_data->getRaw("itr");
$direccion = $sf_data->getRaw("direccion");
$direccion2 = $sf_data->getRaw("direccion2");

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
$pdf->setColtransFooter(false);
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);

$font = 'Arial';

$pdf->SetFont($font, 'B', 11);
$pdf->Cell(0, 4, "AUTORIZACIÓN  TRANSPORTE DE MERCANCIAS" , 0, 1,'C');
$x=0;
$y=40;

$pdf->Ln(2); $pdf->Ln(2); $pdf->Ln(2);

$pdf->SetFont($font, '', 7);
$pdf->SetWidths ( array (40, 80,20,40  ) );
$pdf->SetAligns ( array ("L", "C", "L", "C" ) );
$pdf->SetStyles ( array ("B", "", "B", "" ) );
$pdf->SetFills ( array (1, 0, 1, 0 ) );


$txt1=($reporte->getCaIdcotizacion ()!="")?$reporte->getCaIdcotizacion ():$reporte->getDatosJson("idticket");
$pdf->Row ( array ('Empresa transportadora ', utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre()), 'Cot/Ticket:', $txt1  ) );

$aduMaestra = Doctrine::getTable("InoMaestraAdu")->find($reporte->getDatosJson("do"));
if($aduMaestra)
{
    if($aduMaestra->getCaFchlevante()!="")
        $txt="FECHA LEVANTE:".$aduMaestra->getCaFchlevante();
    else
        $txt="FECHA CARGUE:".$reporte->getCaFchdespacho();
}
else
{
    $txt="FECHA CARGUE:".$reporte->getCaFchdespacho();
}

$pdf->SetFont($font, '', 7);
$pdf->SetWidths ( array (60,40,40,40  ) );
$pdf->SetAligns ( array ("L","L", "L", "L" ) );
$pdf->SetStyles ( array ("", "", "", "" ) );
$pdf->SetFills ( array (0, 0, 0,0 ) );

$datos[]="FECHA AUTORIZACIÓN: ".$reporte->getDatosJson("fchAprobacion");
$datos[]="No REO: ".$reporte->getCaConsecutivo();
$datos[]=$txt;
$datos[]="HORA:INMEDIATO";
        
$pdf->Row ( $datos );

$pdf->Ln(2);

$pdf->SetWidths ( array (60, 60,60  ) );
$pdf->SetAligns ( array ("L", "L", "L", "L" ) );
$pdf->SetStyles ( array ("", "", "", "" ) );
$pdf->SetFills ( array (0, 0, 0, 0 ) );
$datos=array();

$pdf->SetWidths ( array ( 180/*, 90,30*/ ) );
$pdf->SetAligns ( array ( "C", "C", "C" ) );
$pdf->SetStyles ( array ("B", "B", "B" ) );
$pdf->SetFills ( array (1, 1, 1  ) );
$pdf->Row ( array ('Cliente'/*, 'Contacto','Telefono'*/ ) );
$pdf->SetFills ( array ( 0, 0,0 ) );
$pdf->SetStyles ( array ("", "", "" ) );
 

$cliente = $contacto->getCliente();

$datos[]=$contacto->getCliente()->getCaCompania();
//$datos[]=utf8_encode($reporte->getContacto('2')->getCaNombres() . " " . $reporte->getContacto('2')->getCaPapellido() . " " . $reporte->getContacto('2')->getCaSapellido());

//$datos[]=$reporte->getContacto('2')->getCaTelefonos();
$pdf->Row ( $datos );

$pdf->Ln(2);

$pdf->SetWidths ( array ( 90, 90 ) );
$pdf->SetAligns ( array ( "C", "C" ) );
$pdf->SetStyles ( array ("B", "B" ) );
$pdf->SetFills ( array (1, 1 ) );
$pdf->Row ( array ('Origen', 'Destino' ) );
$pdf->SetFills ( array ( 0, 0 ) );
$pdf->SetStyles ( array ("", "" ) );

$origen = $reporte->getOrigen();
$destino = $reporte->getDestino ();
$pdf->Row ( array ( $origen, $destino  ) );

$pdf->Ln(2);

if($direccion)
{
    $pdf->SetWidths ( array (25, 25, 130 ) );
    $pdf->SetFills ( array (1, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", ) );
    $pdf->Row ( array ('Cargue:', 'Nombre:', $direccion->getCaNombre()." Id : ".$direccion->getCaIdentificacion() ) );
    
    $pdf->SetWidths ( array (5, 20, 70, 25, 60 ) );
    $pdf->SetStyles ( array ("", "B", "","B" ) );
    $pdf->Row ( array ('', 'Contacto:', ($direccion->getCaContacto ()) , 'Teléfono:', /*$direccion->getCaTelefonos ()*/  ) );
    $pdf->SetWidths ( array (5, 20, 90,  15, 50 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "",  "B", "" ) );
    $pdf->Row ( array ('','Dirección:', $direccion->getCaDireccion (). " ".$direccion->getCiudad()->getCaCiudad(),  'E-mail:', $direccion->getCaEmail () ) );
}
 
$pdf->Ln(2);
    
$direccion=$direccion2;
if($direccion)
{
    $pdf->SetWidths ( array (25, 25, 130 ) );
    $pdf->SetFills ( array (1, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", ) );
    $pdf->Row ( array ('Descargue:', 'Nombre:', $direccion->getCaNombre()." Id : ".$direccion->getCaIdentificacion() ) );
    
    $pdf->SetWidths ( array (5, 20, 70, 25, 60 ) );
    $pdf->SetStyles ( array ("", "B", "","B" ) );
    $pdf->Row ( array ('', 'Contacto:', ($direccion->getCaContacto ()) , 'Teléfono:', /*$direccion->getCaTelefonos ()*/  ) );
    $pdf->SetWidths ( array (5, 20, 90,  15, 50 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "",  "B", "" ) );
    $pdf->Row ( array ('','Dirección:', $direccion->getCaDireccion (). " ".$direccion->getCiudad()->getCaCiudad(),  'E-mail:', $direccion->getCaEmail () ) );
 }else
 {
    $pdf->SetWidths ( array (25, 25, 130 ) );
    $pdf->SetFills ( array (1, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "", ) );
    $pdf->Row ( array ('Descargue:', 'Nombre:', $cliente->getCaCompania()." Id : ".$cliente->getCaIdalterno() ) );    
    $pdf->SetWidths ( array (5, 20, 70, 25, 60 ) );
    $pdf->SetStyles ( array ("", "B", "","B" ) );
    $pdf->Row ( array ('', 'Contacto:', ($contacto->getNombre ()) , 'Teléfono:', /*$cliente->getCaTelefonos ()*/  ) );
    $pdf->SetWidths ( array (5, 20, 90,  15, 50 ) );
    $pdf->SetFills ( array (1, 0, 0, 0, 0, 0, 0 ) );
    $pdf->SetStyles ( array ("B", "B", "",  "B", "" ) );
    $pdf->Row ( array ('','Dirección:', $cliente->getDireccion (). " ".$cliente->getCiudad()->getCaCiudad(),  'E-mail:',  $contacto->getCaEmail () ) );
 }

$pdf->Ln(2);
$pdf->SetFont($font, 'B', 11);
$pdf->Cell(0, 4, "MERCANCÍAS A TRANSPORTAR" , 0, 1,'C');

$pdf->MultiCell(0, 2, " "  ,0,1, "C");
$y+=5;
$pdf->SetFont($font, '', 7);
$pdf->SetWidths ( array(30, 70 , 25 , 25 , 30   ) );
$pdf->SetAligns ( array("C", "C", "C", "C", "C" ) );
$pdf->SetStyles ( array("B", "B", "B", "B", "B" ) );
$pdf->SetFills ( array (1, 1, 1, 1, 1 ) );
$datos=array();
$datos=array("U.Medida","Producto","Peso","Volumen","V/R Mercancia");
$pdf->Row ( $datos );

$pdf->SetFont($font, '', 7);
$pdf->SetWidths ( array (30,  70 , 25 , 25 , 30   ) );
$pdf->SetAligns ( array ("L", "L", "R", "R", "R" ) );
$pdf->SetStyles ( array ("", "","", "", "" ) );
$pdf->SetFills ( array ( 0, 0, 0, 0, 0 ) );

$datos=array();
$txt="";
foreach($equipos as $equipo)
{
    if($txt!="")
        $txt.="\n";
    $txt.=$equipo->getConcepto()->getCaConcepto();
            
}
$datos=array($txt,$reporte->getCaMercanciaDesc(),$reporte->getDatosJson("ca_peso"),$reporte->getDatosJson("ca_volumen"),$reporte->getDatosJson("ca_valor"));
$pdf->Row ( $datos );



$pdf->SetWidths ( array (25, 30, 25, 100 ) );
$pdf->SetFills ( array (1, 0, 1, 0, 1, 0 ) );
$pdf->SetStyles ( array ("B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('Modalidad:', $reporte->getCaModalidad (),'Do:', $reporte->getDatosJson("do") ) );

if($reporte->getCaTiporep()=="5")
{
    /*
    $pdf->SetWidths ( array (20, 30, 22, 23, 35, 70 ) );
    $pdf->SetFills ( array (1, 0, 1, 0, 1, 0 ) );
    $pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "" ) );
    $pdf->Row ( array ('Urbano:',$reporte->getDatosJson("urbano") , 'Traslado:', ucfirst($reporte->getDatosJson("traslado")) ) );
    */
    
    $pdf->SetWidths ( array (20, 25, 20, 25, 20, 25,20,25 ) );
    $pdf->SetFills ( array (1, 0, 1, 0, 1, 0, 1, 0, 1, 0 ) );
    $pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "", "B", "" ) );
    $pdf->Row ( array 
            (   'Piezas:', $reporte->getDatosJson("ca_piezas"), 
                'Peso:', $reporte->getDatosJson("ca_peso"), 'Volumen:', $reporte->getDatosJson("ca_volumen"), 'Itr:', ($reporte->getDatosJson("itr")=="on"?"Si":"No")) );
    
    /*$pdf->SetWidths ( array (20, 25, 20, 25, 20, 25,20,25 ) );
    $pdf->SetFills ( array (1, 0, 1, 0, 1, 0, 1, 0, 1, 0 ) );
    $pdf->SetStyles ( array ("B", "", "B", "", "B", "", "B", "", "B", "" ) );*/
    $pdf->Row ( array 
            (   'Seguro:', $reporte->getDatosJson("seguro"), 
                'Escolta:', $reporte->getDatosJson("escolta"), 'Regimen:', $reporte->getDatosJson("regimen")) );
    
//    $pdf->Ln(2);
    
    $pdf->SetWidths ( array (25, 75,20, 60 ) );
    $pdf->SetFills ( array (1, 0, 1, 0, 1, 0 ) );
    $pdf->SetStyles ( array ("B", "", "B", "", "B", "" ) );
    $pdf->Row ( array 
            (   'Dimensiones:', $reporte->getDatosJson("ca_dimensiones"), 'Bl:', $reporte->getDatosJson("ca_doc_transporte")) );
    $pdf->Ln(2);   
  
    
    $pdf->Ln(2);

$pdf->SetWidths(array(180));
$pdf->SetFills(array(1));
$pdf->Row(array(''));

$pdf->SetWidths(array(200));
$pdf->SetStyles(array(""));
$pdf->SetFills(array(0));
$pdf->MultiCell(180,4,'Observaciones:'."\n".($reporte->getDatosJson("ca_observaciones2")),1);
$pdf->Ln(2);
    
}



$pdf->Ln(2);
$pdf->MultiCell(0, 2, " "  ,0,1, "C");

$pdf->SetFont($font, 'B', 11);
$pdf->Cell(0, 4, "SERVICIOS SOLICITADOS" , 0, 1,'C');

{
    
    if($reporte->getCaModalidad ()=="LCL" || $reporte->getCaModalidad ()=="LOCAL" || $reporte->getCaModalidad ()=="CONSOLIDADO") 
    {
        $pdf->Ln(2);
        $pdf->SetFont($font, '', 7);
        //$pdf->SetWidths ( array ( 90 , 30 , 30 , 30  ) );
        $pdf->SetWidths ( array ( 40 , 30 , 30 , 80 ) );
        $pdf->SetAligns ( array ("C", "C", "C", "C" ) );
        $pdf->SetStyles ( array ("B", "B","B", "B" ) );
        $pdf->SetFills ( array ( 1, 1, 1, 1  ) );

        $datos=array();
        $datos=array("Vehiculo", "Cantidad", "Embalaje","Observaciones");
        $pdf->Row ( $datos );

        //$pdf->SetWidths ( array ( 60 , 30 , 30 , 30,30  ) );
        $pdf->SetAligns ( array ("L", "L", "L", "L" ) );
        $pdf->SetStyles ( array ("", "","", "" ) );
        $pdf->SetFills ( array ( 0, 0, 0, 0 ) );
        foreach($equipos as $equipo)
        {
            $emb = ParametroTable::retrieveByCaso("CU047",null,null,$equipo->getDatosJson("idembalaje"));
            $datos=array();    
            
            $datos=array($equipo->getDatosJson("vehiculo"), $equipo->getCaCantidad(), $emb[0]->getCaValor(),$equipo->getCaObservaciones());
            $pdf->Row ( $datos );
        }
    }
    else
    {
        $pdf->Ln(2);
        $pdf->SetFont($font, '', 7);
        //$pdf->SetWidths ( array ( 90 , 30 , 30 , 30  ) );
        $pdf->SetWidths ( array ( 60 , 30 , 30 , 30,30  ) );
        $pdf->SetAligns ( array ("C", "C", "C", "C", "C" ) );
        $pdf->SetStyles ( array ("B", "B","B", "B", "B" ) );
        $pdf->SetFills ( array ( 1, 1, 1, 1 , 1  ) );

        $datos=array();
        $datos=array("Vehiculo", "Cantidad", "No. Contenedor","Sitio Devolución","fecha Devolución");
        $pdf->Row ( $datos );

        //$pdf->SetWidths ( array ( 60 , 30 , 30 , 30,30  ) );
        $pdf->SetAligns ( array ("L", "L", "L", "L", "L" ) );
        $pdf->SetStyles ( array ("", "","", "","" ) );
        $pdf->SetFills ( array ( 0, 0, 0, 0,0 ) );
        foreach($equipos as $equipo)
        {
            $datos=array();    
            $datos=array($equipo->getDatosJson("vehiculo"), $equipo->getCaCantidad(), $equipo->getCaIdequipo(),$equipo->getDatosJson("patio"),$equipo->getDatosJson("limite_devolucion"));
            $pdf->Row ( $datos );
        }
        
    }
}
//if($reporte->getDatosJson("itr")=="on")
{
    $pdf->Ln(2);
    $pdf->SetFont($font, '', 8);
    $pdf->SetWidths ( array ( 180  ) );
    $pdf->SetAligns ( array ("C" ) );
    $pdf->SetStyles ( array ("B" ) );
    $pdf->SetFills ( array ( 1) );
    $datos=array();
    $datos=array("ITR");
    $pdf->Row ( $datos );
    
    $pdf->Ln(2);
    $pdf->SetFont($font, '', 7);
    $pdf->SetWidths ( array ( 40 , 20 , 20, 20,20, 60  ) );
    $pdf->SetAligns ( array ("C", "C", "C", "C", "C", "C", "C" ) );
    $pdf->SetStyles ( array ("B", "B","B", "B", "B", "B", "B" ) );
    $pdf->SetFills ( array ( 1, 1, 1, 1, 1, 1, 1  ) );
    $datos=array();
    $datos=array("Vehiculo", "Embalaje" ,"Piezas", "Peso","Volumen","Dirección");
    $pdf->Row ( $datos );

    //$pdf->SetWidths ( array ( 40 , 25 ,  20, 20, 75  ) );
    $pdf->SetAligns ( array ("L", "L", "R", "R", "R", "L" ) );
    $pdf->SetStyles ( array ("", "","", "", "", "" ) );
    $pdf->SetFills ( array ( 0, 0, 0, 0, 0, 0 ) );
    foreach($itr as $equipo)
    {
        $veh = ParametroTable::retrieveByCaso("CU020",null,null,$equipo->getCaIdvehiculo());
        
        $emb = ParametroTable::retrieveByCaso("CU047",null,null,$equipo->getCaIdembalaje());
        $datos=array();
        $datos=array($veh[0]->getCaValor(), $emb[0]->getCaValor() ,$equipo->getCaPiezas(), $equipo->getCaPeso(),$equipo->getCaVolumen(),$equipo->getCaDireccion());
        $pdf->Row ( $datos );
    }
}
//else


$pdf->MultiCell(0, 2, " "  ,0,1, "C");
$pdf->MultiCell(0, 2, " "  ,0,1, "C");

$pdf->SetFont($font, 'B', 11);
$pdf->Cell(0, 4, "VALOR DEL SERVICIO" , 0, 1,'C');

$pdf->MultiCell(0, 2, " "  ,0,1, "C");

$pdf->SetFont($font, '', 8);
$pdf->SetWidths ( array (10 ,60 , 30 ,80   ) );
$pdf->SetAligns ( array ("C","C", "C", "C" ) );
$pdf->SetStyles ( array ("B","B", "B","B") );
$pdf->SetFills ( array ( 1, 1, 1,1 ) );
$datos=array();
$datos=array("","CONCEPTO","VALOR","OBSERVACIONES");
$pdf->Row ( $datos );

$pdf->SetWidths ( array (10,  60 , 30,80   ) );
$pdf->SetAligns ( array ("L","L", "R","L" ) );
$pdf->SetStyles ( array ("", "","","") );
$pdf->SetFills ( array ( 0, 0,0,0 ) );
$total=0;
foreach($tarifas as $n=>$tarifa)
{
    if($tarifa->getDatosJson("sol")=="true")
    {
        $datos=array($n+1,$tarifa->getInoConcepto()->getCaConcepto(),$tarifa->getCaNetaTar(),utf8_encode($tarifa->getCaObservaciones()));
        $pdf->Row ( $datos );
        $total+=$tarifa->getCaNetaTar();
    }
}

$pdf->SetWidths ( array ( 70 , 30,80   ) );
$pdf->SetAligns ( array ("R","R", "R" ) );
$pdf->SetStyles ( array ("B", "B", "B") );
$pdf->SetFills ( array ( 1, 1, 1 ) );
$datos=array();
$datos=array("TOTAL", $total,"");
$pdf->Row ( $datos );

$pdf->SetFont($font, '', 10);
$directorioAg = array();
$imprimirNotas = array();
$sucursal = $usuario->getSucursal();
$pdf->SetSucursal($sucursal->getCaIdsucursal());

$txtSucursal=array();
$txtSucursal["datos"][]= $sucursal->getCaNombre();
$txtSucursal["datos"][]= $sucursal->getEmpresa()->getCaNombre();
$dir= explode("  ", $sucursal->getCaDireccion());

foreach($dir as $d)
    $txtSucursal["datos"][]=$d;
$txtSucursal["datos"][]="Pbx: ".$sucursal->getCaTelefono();//"Pxb : (57 - 1) 4239300";
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




// ======================== Notas adicionales ======================== //
if ($empresa->getCaIdempresa() == 2 ) {
    $pdf->AddPage();
    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 11);
    $pdf->Cell(0, 4, "Condiciones Generales requeridas por nuestros clientes:", 0, 1, "C");

    $pdf->SetFont($font, '', 8);
    $pdf->Ln(6);    
    $pdf->MultiCell(0, 5, " Vehículos en buenas condiciones (limpios, sin filtraciones, sin fallas mecánicas)
Tener mínimo 4 reportes y que sean claros y precisos en la ubicación real de nuestras cargas (No se recibirán comunicaciones por WhatsApp)
Enviar un estimado de tiempo faltante del trayecto a la entrega final en cada reporte
Tomar registro fotográfico del cargue y descargue 
Trincar perfectamente la mercancía para evitar averías
Dejar notas de observaciones del estado de la carga y registro fotográfico que se validen en el momento del recibo de la carga tanto en origen como en el destino final
Reportar de manera inmediata cualquier novedad que se presente durante el trayecto
Enviar notas de inspección inmediatamente se generen las entregas de las unidades vacías.", 0, 'J', 0);
    
    
    
    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 11);
    $pdf->Cell(0, 4, "Condiciones Específicas requeridas por nuestros clientes por tipo de mercancía:", 0, 1, "C");
    
    
    $pdf->SetFont($font, '', 8);
    $pdf->Ln(6);    
    $pdf->MultiCell(0, 5, "Alimentos: Vehículo furgonado, vehículos higiénicamente aptos para prestar el servicio, libre de olores no partículas que puedan contaminar la carga.
Refrigerados: Vehículo con termo King que aplique la temperatura solicitada en esta orden  
Maquinaria: Trincas aptas y suficientes para los amarres de la mercancía ", 0, 'J', 0);
    
    
    
$pdf->Ln(4);
    $pdf->SetFont($font, 'B', 11);
    $pdf->Cell(0, 4, "Condiciones específicas para carga consolidada:", 0, 1, "C");
    
    
    $pdf->SetFont($font, '', 8);
    $pdf->Ln(6);    
    $pdf->MultiCell(0, 5, "-Cumplir tiempos de consolidación que no deben superar los 4 días calendario posterior a la recepción de esta orden
- Al momento de consolidar tener presente el tipo de mercancía para evitar contaminaciones ", 0, 'J', 0);
    
    
$pdf->Ln(4);
    $pdf->SetFont($font, 'B', 11);
    $pdf->Cell(0, 4, "Condiciones específicas para Mercancías acompañadas:", 0, 1, "C");
    
    
    $pdf->SetFont($font, '', 8);
    $pdf->Ln(6);    
    $pdf->MultiCell(0, 5, "-Una vez finalizado el servicio enviar copia de los peajes que fueron pagados durante la prestación del mismo
-Enviar la trazabilidad del servicio
-Envío de registro fotográfico al iniciar y al finalizar la operación. ", 0, 'J', 0);
    
    
    $pdf->SetFont($font, '', 8);
    $pdf->Ln(6);    
    $pdf->MultiCell(0, 5, "NOTA IMPORTANTE: Tener en cuenta que la responsabilidad de la verificación del cumplimiento de requisitos BASC de los conductores y terceros que sean utilizados para la prestación del servicio será de cada uno de ustedes como proveedores aprobados para nuestra compañía. ", 0, 'J', 0);
    
}

//$reporte->setDatosJson("fchAprobacion",date("Y-m-d H:i:s"));
//$reporte->getDatosJson("usuAprobacion" );


if($reporte->getDatosJson("usuAprobacion")!="")
{    
    $usuario =  Doctrine::getTable("Usuario")
        ->createQuery("u")
        ->select("ca_login,ca_email,ca_nombre")
        ->where("ca_login = ? " , $reporte->getDatosJson("usuAprobacion" ) )
        ->fetchOne();

    

    $sucursal=$usuario->getSucursal();
    $empresa=$sucursal->getEmpresa();

    $pdf->Ln(5);

//    $pdf->beginGroup();
    $pdf->Ln(4);
    $pdf->MultiCell(0, 4, 'Cordialmente,', 0, 1);


    $pdf->Ln(10);
    $pdf->SetFont($font, 'B', 8);
    $pdf->MultiCell(0, 4, strtoupper($usuario->getCaNombre()), 0, 1);
    $pdf->SetFont($font, '', 8);
    $pdf->MultiCell(0, 4, strtoupper($usuario->getCaCargo()), 0, 1);
    $pdf->MultiCell(0, 4, strtoupper($empresa->getCaNombre()), 0, 1);
    $pdf->MultiCell(0, 4, $sucursal->getCaDireccion(), 0, 1);
    $pdf->MultiCell(0, 4, "Tel.:" . $sucursal->getCaTelefono() . " " . $usuario->getCaExtension(), 0, 1);    
    $pdf->MultiCell(0, 4, $sucursal->getCaNombre() . " - " . $empresa->getTrafico()->getCaNombre(), 0, 1);
    $pdf->MultiCell(0, 4, $usuario->getCaEmail(), 0, 1);
    $pdf->MultiCell(0, 4, $empresa->getCaUrl(), 0, 1);

}    



$pdf->Output($filename);

if (!$filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>
