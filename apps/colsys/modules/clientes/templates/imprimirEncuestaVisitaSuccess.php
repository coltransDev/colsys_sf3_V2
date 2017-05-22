<?php
$sucursal = $encuestaVisita->getUsuCreado()->getSucursal();
$empresa = $sucursal->getEmpresa();
$cliente = $encuestaVisita->getContacto()->getCliente();
$contacto = $encuestaVisita->getContacto();
$usuario = $encuestaVisita->getUsuCreado();
$identificacion = $cliente->getCaIdalterno()?number_format($cliente->getCaIdalterno()) . "-" . $cliente->getCaDigito():"";
$instalaciones_otro = str_replace(",",", ",$encuestaVisita->getCaInstalacionesTipo());
$instalaciones_otro.= $encuestaVisita->getCaInstalacionesOtro()?", ".$encuestaVisita->getCaInstalacionesOtro():"";
$sistema_seguridad = str_replace(",",", ",$encuestaVisita->getCaSistemaSeguridad());
$sistema_seguridad.= $encuestaVisita->getCaSistemaSeguridadOtro()?", ".$encuestaVisita->getCaSistemaSeguridadOtro():"";
$certificaciones = str_replace(",",", ",$encuestaVisita->getCaCertificacion());
$certificaciones.= $encuestaVisita->getCaCertificacionOtro()?", ".$encuestaVisita->getCaCertificacionOtro():"";
if ($encuestaVisita->getCaIdsucursal()){
    $direccion = $encuestaVisita->getIdsSucursal()->getCaDireccion();
    $telefonos = $encuestaVisita->getIdsSucursal()->getCaTelefonos();
    $fax = $encuestaVisita->getIdsSucursal()->getCaFax();
    $ciudad = $encuestaVisita->getIdsSucursal()->getCiudad()->getCaCiudad();
}else{
    $direccion = str_replace("|", " ", $cliente->getCaDireccion()) . $cliente->getCaComplemento();
    $telefonos = $cliente->getCaTelefonos();
    $fax = $cliente->getCaFax();
    $ciudad = $cliente->getCiudad()->getCaCiudad();
}

$pdf = new PDF ( );
$pdf->Open();
$pdf->setIdempresa($sucursal->getCaIdempresa());
$pdf->setSucursal($sucursal->getCaIdsucursal());
if ($sucursal->getCaIdempresa() == 2) {
    $pdf->setColtransHeader(true);
    $pdf->setColtransFooter(true);
}else if ($sucursal->getCaIdempresa() == 1) {
    $pdf->setColmasHeader(true);
    $pdf->setColmasFooter(true);
}
$pdf->AliasNbPages();
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);

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

$pdf->SetFont('Arial', 'B', 11);
$pdf->SetWidths(array(170));
$pdf->SetAligns(array("C"));
$pdf->SetFills (array (1));
$pdf->Row(array("FORMATO DE VISITA DEL CLIENTE"));
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 11);
$pdf->SetWidths(array(100, 70));
$pdf->SetAligns(array("L", "L"));
$pdf->SetFills (array (1, 0, 1, 0, 1, 0, 1, 0));
$pdf->Row(array($cliente->getCaCompania(), " Nit.: " . $identificacion));
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetWidths(array(50, 120));
$pdf->SetAligns(array("L", "L"));
$pdf->Row(array("Representante Legal : ", $cliente->getCaNombres() . " " . $cliente->getCaPapellido() . " " . $cliente->getCaSapellido()));
$pdf->SetWidths(array(30, 140));
$pdf->SetAligns(array("L", "L", "L", "L"));
$pdf->Row(array("Lugar de la Visita : ", $direccion));
$pdf->SetWidths(array(30, 30, 30, 30, 20, 30));
$pdf->Row(array("Teléfonos : " , $telefonos, "Fax : ", $fax, "Ciudad : ", $ciudad));
$pdf->SetWidths(array(30, 140));
$pdf->Row(array("Actividad Comercial : ", $cliente->getCaActividad()));
$pdf->SetWidths(array(16, 25, 16, 25, 16, 25, 22, 25));
$pdf->Row(array("Coltrans :\n\n", $estados['ca_coltrans_std']."\n".substr($estados['ca_coltrans_fch'],0,10), "Colmas :\n\n", $estados['ca_colmas_std']."\n".substr($estados['ca_colmas_fch'],0,10), "ColOTM :\n\n", $estados['ca_colotm_std']."\n".substr($estados['ca_colotm_fch'],0,10), "Coldepósitos:\n\n", $estados['ca_coldepositos_std']."\n".substr($estados['ca_coldepositos_fch'],0,10)));

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths(array(30, 80, 30, 30));
$pdf->SetAligns(array("L", "L", "L", "L"));
$pdf->Row(array("Contacto : ", $contacto->getCaNombres() . " " . $contacto->getCaPapellido() . " " . $contacto->getCaSapellido(), "Fecha de la Visita :", $encuestaVisita->getCaFchvisita()));

$pdf->SetWidths(array(30, 30, 30, 30, 20, 30));
$pdf->SetAligns(array("L", "L", "L", "L", "L", "L"));
$pdf->Row(array("Cargo : ", $contacto->getCaCargo() , "Departamento :", $contacto->getCaDepartamento(), "Teléfonos", $contacto->getCaTelefonos()));

$pdf->SetWidths(array(30, 50, 30, 60));
$pdf->SetAligns(array("L", "L", "L", "L"));
$pdf->Row(array("Correo Electrónico : ", $contacto->getCaEmail(), "Observaciones :", $contacto->getCaObservaciones()));

$pdf->Ln(4);
$pdf->SetWidths(array(170));
$pdf->SetAligns(array("C"));
$pdf->Row(array("INSTALACIONES"));
$pdf->SetWidths(array(55, 115));
$pdf->SetAligns(array("L", "L", "L", "L"));
$pdf->Row(array("¿Tipo de las instalaciones? :", $instalaciones_otro));
$pdf->SetWidths(array(55, 30, 60, 25));
$pdf->Row(array("¿Uso de las instalaciones? :", $encuestaVisita->getCaInstalacionesUso(), "¿Tipo de pertenencia? :", $encuestaVisita->getCaInstalacionesPertenencia()));
$pdf->Row(array("¿Es al mismo tiempo lugar de Vivienda? :", $encuestaVisita->getCaInstalacionesVivienda()), "¿Condiciones físicas acorde con el objeto social? :", $encuestaVisita->getCaInstalacionesCondiciones());
$pdf->SetWidths(array(55, 115));
$pdf->Row(array("¿Cuenta con sistemas de seguridad y/o Vigilancia? :", $sistema_seguridad));

$pdf->Ln(4);
$pdf->SetWidths(array(170));
$pdf->SetAligns(array("C"));
$pdf->Row(array("SEGURIDAD"));
$pdf->SetWidths(array(55, 30, 60, 25));
$pdf->SetAligns(array("L", "L", "L", "L"));
$pdf->Row(array("¿Tiene control para el ingreso y/o salida de empleados? :", $encuestaVisita->getCaControlEmpleados(), "¿Tiene control para el ingreso y/o salida de visitantes? :", $encuestaVisita->getCaControlVisitantes()));
$pdf->Row(array("¿Se realiza cargue y/o descargue de mercancía dentro de las instalaciones? :", $encuestaVisita->getCaManejoMercancias(), "¿Cuenta con un procedimiento para cargue y/o descargue de la mercancía? :", $encuestaVisita->getCaManejoMercanciasProcedimiento()));
$pdf->Row(array("¿Tiene controles de acceso a la zona de cargue y descargue de mercancias? :", $encuestaVisita->getCaManejoMercanciasZona(), "¿Cuales controles? :", $encuestaVisita->getCaManejoMercanciasDetalles()));
$pdf->Row(array("¿Dispone de un plano de áreas sensibles? :", $encuestaVisita->getCaAreasSensibles(), "¿Tiene un procedimiento documentado para la prevención del lavado de activos y financiación del terrorismo? :", $encuestaVisita->getCaPrevencionLavadoActivos()));
$pdf->SetWidths(array(55, 115));
$pdf->Row(array("¿Cuenta con certificación en sistemas de calidad? :", $certificaciones));
$pdf->SetWidths(array(55, 30, 60, 25));
$pdf->Row(array("¿Tiene planeado implementar un sistema de calidad y/o seguridad? :", $encuestaVisita->getCaImplementacionSistema(), "¿Cuál y Cuando? :", $encuestaVisita->getCaImplementacionSistemaDetalles()));

$pdf->Ln(4);
$pdf->SetWidths(array(170));
$pdf->SetAligns(array("C"));
$pdf->Row(array("RECOMENDACIÓN Y CONCEPTO"));
$pdf->SetWidths(array(55, 30, 25, 60));
$pdf->SetAligns(array("L", "L", "L", "L"));
$pdf->Row(array("¿Recomienda trabajar con el cliente? :", $encuestaVisita->getCaRecomiendaTrabajar()));

$pdf->Ln(4);
$pdf->SetWidths(array(85, 85));
$pdf->SetAligns(array("L", "L"));
$pdf->SetFills (array (1, 1));
$pdf->Row(array("Concepto de seguridad", "Observaciones"));
$pdf->SetFills (array (0, 0));
$pdf->Row(array($encuestaVisita->getCaConceptoSeguridad(), $encuestaVisita->getCaObservaciones()));

$pdf->Ln(2);
$pdf->MultiCell(0, 4, "Impreso : ".date("Y-m-d h:i:s"), 0, 1);
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

$filename = str_replace(".","",$encuestaVisita->getContacto()->getCliente()->getCaIdalterno()).'.pdf';
$pdf->Output ( $filename, "I" );
if( $filename ){ //Para evitar que salga la barra de depuracion
    exit();
}
?>