<?
$fichatecnica = $sf_data->getRaw("fichatecnica");

if ($fichatecnica) {
    $documentacion = json_decode(utf8_encode($fichatecnica->getCaDocumentacion()));
    $transporteinternacional = json_decode(utf8_encode($fichatecnica->getCaTransporteinternacional()));
    $fechacreacion = $fichatecnica->getCaFchcreado();
    $fechaactualizacion = $fichatecnica->getCaFchactualizado();
}
$cliente = $fichatecnica->getCliente();
if ($cliente) {
    $representante = $cliente->getCaPapellido() . " " . $cliente->getCaSapellido() . " " . $cliente->getCaNombres();
    $actividad = $cliente->getCaActividad();
}
$ids = $cliente->getIds();
if ($ids) {
    $razonsocial = $ids->getCaNombre();
}
$contactos = $cliente->getContacto();

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");   // any date in the past

$pdf = new PDF( );
$pdf->Open();
$pdf->setColtransFooter(true);
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);
$font = 'Arial';
$pdf->SetFont($font, '', 10);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'FICHA TÉCNICA CLIENTES ADUANAS',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();


$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'INFORMACIÓN GENERAL DEL CLIENTE',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();


$pdf->SetWidths(array (40, 55, 40, 55));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Fecha creación Ficha',utf8_decode( $fechacreacion) ,'Última Actualización',utf8_decode($fechaactualizacion)));
$pdf->SetFills(array (0,0));
$pdf->ln(5);
$pdf->SetWidths(array (40, 150));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Razón Social', utf8_decode($razonsocial )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (40, 95, 20, 35));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Representante legal', utf8_decode($representante ),'C.C.',''));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (40, 150));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Actividad Económica', utf8_decode($actividad )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (160,30));
$pdf->SetAligns(array ("L","L"));
$pdf->SetStyles(array ("",""));
$pdf->Row(array('Industrial:           Comercial:           Servicios:           Financiero:           Agrícola:           Otro:           ' ,''));
$pdf->SetFills(array (0,0));

$pdf->ln(5);

foreach($contactos as $contacto){
    
    $pdf->SetWidths(array (40, 80, 20,50));
    $pdf->SetAligns(array ("L", "L","L", "L"));
    $pdf->SetStyles(array ("", "","", ""));
    $pdf->Row(array('Contacto', $contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido(),'Cargo', $contacto->getCaCargo()));
    $pdf->SetFills(array (0,0));

    $pdf->SetWidths(array (40, 80, 20,50));
    $pdf->SetAligns(array ("L", "L","L", "L"));
    $pdf->SetStyles(array ("", "","", ""));
    $pdf->Row(array('E-mail', $contacto->getCaEmail() ,'Teléfono', $contacto->getCaTelefonos()));
    $pdf->SetFills(array (0,0));
    $pdf->ln(5);
    
}

$pdf->ln();
$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'CONDICIONES ESPECIALES',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();
    

$pdf->SetWidths(array (25, 30, 40, 95));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Tipo', utf8_decode($documentacion->tipoCE) ,'Código',utf8_decode($documentacion->codigoCE)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (55, 40, 55, 40));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Número de Resolución', utf8_decode($documentacion->nroresolucionCE) ,'Fecha de Vencimiento',utf8_decode($documentacion->fchvencimientoRCE)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (55, 40, 55, 40));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Número Póliza', utf8_decode($documentacion->nropolizaCE),'Fecha de Vencimiento',utf8_decode($documentacion->fchvencimientoPCE)));
$pdf->SetFills(array (0,0));

if ($documentacion->tipoCE == "UAP"){
    $pdf->SetWidths(array (55, 40, 55, 40));
    $pdf->SetAligns(array ("L", "L","L", "L"));
    $pdf->SetStyles(array ("", "","",""));
    $pdf->Row(array('Fechas de cierre', utf8_decode($documentacion->cierreCE ),'Banco',utf8_decode($documentacion->bancoCE)));
    $pdf->SetFills(array (0,0));

}

$pdf->AddPage();
$pdf->ln();
$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'MANDATOS Y SEGURO',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();

$pdf->SetWidths(array (50, 120));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Compañía Aseguradora', utf8_decode($documentacion->ciaaseguradoraMS )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (50, 30, 40, 50));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Porcentaje de Seguro', utf8_decode($documentacion->porcentajeMS ),'Vigencia',utf8_decode($documentacion->vigenciaMS)));
$pdf->SetFills(array (0,0));

$pdf->ln(5);
$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'DOCUMENTACIÓN',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln(10);
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();

$pdf->SetWidths(array (85));
$pdf->SetAligns(array ("L"));
$pdf->SetStyles(array (""));
$pdf->Row(array('Registro o Licencia de Importación' ));
$pdf->SetFills(array (0,0));
$pdf->ln(10);
$pdf->SetWidths(array (170));
$pdf->SetAligns(array ("L"));
$pdf->SetStyles(array (""));
$pdf->Row(array('Colmas:                      Otro:              Aceptación previa de la D.I.:         ' ));
$pdf->SetFills(array (0,0));

$x = $pdf->GetX()+20;
$y = $pdf->GetY()-3;  

$pdf->Rect($x, $y, 2, 2 );

if ($documentacion->registro_importacionColmas){
    $pdf->Line( $x, $y, $x + 2, $y + 2);
    $pdf->Line( $x, $y + 2, $x + 2, $y);
} 

$x = $pdf->GetX()+47;
$y = $pdf->GetY()-3;
$pdf->Rect($x, $y, 2, 2 );

if ($documentacion->registro_importacionOtro){
    $pdf->Line( $x, $y, $x + 2, $y + 2);
    $pdf->Line( $x, $y + 2, $x + 2, $y);
} 

$x = $pdf->GetX()+110;
$y = $pdf->GetY()-3;
$pdf->Rect($x, $y, 2, 2 );

if ($documentacion->registro_importacionAP){
    $pdf->Line( $x, $y, $x + 2, $y + 2);
    $pdf->Line( $x, $y + 2, $x + 2, $y);
} 

$pdf->ln(10);
$pdf->SetWidths(array (85, 85));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Instrucciones para manejo de saldos, en registros globales', utf8_decode($documentacion->instrucciones )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (85, 85));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Envío Factura Comercial', utf8_decode($documentacion->envio_faccomercial )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (85, 85));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Envío lista de Empaque', utf8_decode($documentacion->envio_listaempaque )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (85, 85));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Envío certificados de Origen', utf8_decode($documentacion->envio_certorigen )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (85, 85));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Envío certificados sanitarios', utf8_decode($documentacion->envio_certsanitarios )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (85, 85));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Envío certificados Fitosanitarios y Zoosanitarios', utf8_decode($documentacion->envio_certfitozoo )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (85, 85));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Otras Instrucciones', utf8_decode($documentacion->instrucciones_detalle )));
$pdf->SetFills(array (0,0));

$y = $pdf->GetY(); 
if ($y > 225){
    $pdf->AddPage();
}

$pdf->ln(5);

$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'TRANSPORTE INTERNACIONAL',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();

foreach($transporteinternacional as $ti){

    $pdf->SetWidths(array (85, 85));
    $pdf->SetAligns(array ("L", "L"));
    $pdf->SetStyles(array ("", ""));
    $pdf->Row(array('Agente de Carga ', utf8_decode($ti->nombre_tipotransporteI )));
    $pdf->SetFills(array (0,0));

    $pdf->SetWidths(array (85, 85));
    $pdf->SetAligns(array ("L", "L"));
    $pdf->SetStyles(array ("", ""));
    $pdf->Row(array('Tipo', utf8_decode($ti->tipoI )));
    $pdf->SetFills(array (0,0));

    $pdf->SetWidths(array (85, 85));
    $pdf->SetAligns(array ("L", "L"));
    $pdf->SetStyles(array ("", ""));
    $pdf->Row(array('Convenio', utf8_decode($ti->convenioI )));
    $pdf->SetFills(array (0,0));

    $pdf->SetWidths(array (85, 85));
    $pdf->SetAligns(array ("L", "L"));
    $pdf->SetStyles(array ("", ""));
    $pdf->Row(array('Contacto', utf8_decode($ti->contactoI) ));
    $pdf->SetFills(array (0,0));

    $pdf->SetWidths(array (85, 85));
    $pdf->SetAligns(array ("L", "L"));
    $pdf->SetStyles(array ("", ""));
    $pdf->Row(array('Teléfono', utf8_decode($ti->telefonoI )));
    $pdf->SetFills(array (0,0));

    $pdf->SetWidths(array (40, 10, 35, 10,65,10));
    $pdf->SetAligns(array ("L", "L","L", "L","L", "L"));
    $pdf->SetStyles(array ("", "","","","",""));
    $pdf->Row(array('Pago de fletes', ' ' ,'Drop OFF',' ','Devol. Contenedor Vacío',' '));
    $pdf->SetFills(array (0,0));

    $x = $pdf->GetX()+44;
    $y = $pdf->GetY()-3;    
    $pdf->Rect($x,$y, 2, 2 );

    if ($ti->pagofletesI ){
        $pdf->Line( $x, $y, $x + 2, $y + 2);
        $pdf->Line( $x, $y + 2, $x + 2, $y);
    }
    $x = $x + 44;    
    $pdf->Rect($x,$y, 2, 2 );
    if($ti->dropoffI ){
        $pdf->Line( $x, $y, $x + 2, $y + 2);
        $pdf->Line( $x, $y + 2, $x + 2, $y);
    }
    $x = $x + 76;   
    $pdf->Rect($x,$y, 2, 2 );      
    if($ti->contenedorvacioI){
        $pdf->Line( $x, $y, $x + 2, $y + 2);
        $pdf->Line( $x, $y + 2, $x + 2, $y);
    }
}
$y = $pdf->GetY(); 
if ($y > 225){
    $pdf->AddPage();
}

$pdf->ln(5);
$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'MANEJO DE MERCANCIAS',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();
    
      
$pdf->SetWidths(array (60, 10, 60, 50,));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Operaciones Zona Franca', ' ' ,'Deposito Zona Franca',utf8_decode($documentacion->deposito_zonafrancaMM)));
$pdf->SetFills(array (0,0));
$x = $pdf->GetX()+64;
$y = $pdf->GetY()-3;
$pdf->Rect($x,$y, 2, 2 );

if($documentacion->operacion_zonafrancaMM){
        $pdf->Line( $x, $y, $x + 2, $y + 2);
        $pdf->Line( $x, $y + 2, $x + 2, $y);
    }

$pdf->SetWidths(array (20, 10, 20, 10, 50, 10 ,50, 10));
$pdf->SetAligns(array ("L", "L","L", "L","L", "L","L", "L"));
$pdf->SetStyles(array ("", "","","","", "","",""));
$pdf->Row(array('DTA', ' ' ,'OTM',' ','Descargue Directo','','Anticipada',''));
$pdf->SetFills(array (0,0));
$x = $pdf->GetX();
$y = $pdf->GetY()-3;
    
$pdf->Rect($x+24,$y, 2, 2 );
$pdf->Rect($x+54,$y, 2, 2 );
$pdf->Rect($x+114,$y, 2, 2 );
$pdf->Rect($x+174,$y, 2, 2 );
    
if($documentacion->dtaMM){
        $pdf->Line( $x+24, $y, $x+24 + 2, $y + 2);
        $pdf->Line( $x+24, $y + 2, $x+24 + 2, $y);
    }
if($documentacion->otmMM){
        $pdf->Line( $x+54, $y, $x+54 + 2, $y + 2);
        $pdf->Line( $x+54, $y + 2, $x+54 + 2, $y);
    }    
if($documentacion->descargue_directoMM){
        $pdf->Line( $x+114, $y, $x+114 + 2, $y + 2);
        $pdf->Line( $x+114, $y + 2, $x+114 + 2, $y);
    }
if($documentacion->anticipadaMM){
        $pdf->Line( $x+174, $y, $x+174 + 2, $y + 2);
        $pdf->Line( $x+174, $y + 2, $x+174 + 2, $y);
    }
        
        
$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Preinspecciones/inventario previo de mercancias', utf8_decode($documentacion->preinspeccionesMM) ,'Toma de seriales',utf8_decode($documentacion->serialesMM)));
$pdf->SetFills(array (0,0));

$pdf->ln(5);
        
$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Desembalaje/separación de bultos', utf8_decode($documentacion->desembalajeMM ),'Inspección SANIDAD e ICA',utf8_decode($documentacion->sanidadMM)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Productos', utf8_decode($documentacion->productosMM )));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Procedimiento/ incosistencia, averías o faltantes', utf8_decode($documentacion->averiasMM )));
$pdf->SetFills(array (0,0));
    
$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Presencia de ajustadores de seguros', utf8_decode($documentacion->ajustadoresMM) ,'Presencia funcionario COLMAS',utf8_decode($documentacion->funcionarioMM)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Presencia representante del Cliente', utf8_decode($documentacion->representante_clienteMM) ,'Presencia funcionario de Cia de Seguros',utf8_decode($documentacion->segurosMM)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Registros fotográficos y fílmicos', utf8_decode($documentacion->fotograficosMM)));
$pdf->SetFills(array (0,0));

$pdf->ln(10);

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Productos controlados', utf8_decode($documentacion->controladosMM)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Coordinar despacho transporte y entrega', ' ' ,'Escolta',' '));
$pdf->SetFills(array (0,0));

$x = $pdf->GetX();
$y = $pdf->GetY()-3;

$pdf->Rect($x+84,$y, 2, 2 );
$pdf->Rect($x+174,$y, 2, 2 );

if($documentacion->coord_despachoMM){
        $pdf->Line( x+94, $y, x+94 + 2, $y + 2);
        $pdf->Line(x+94, $y + 2, x+94 + 2, $y);
    }
if($documentacion->escoltaMM){
        $pdf->Line( $x+174, $y, $x+174 + 2, $y + 2);
        $pdf->Line( $x+174, $y + 2, $x+174 + 2, $y);
    }

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Condiciones contractuales póliza de transporte', utf8_decode($documentacion->poliza_transporteMM)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Horario de recibo de mercancía en planta o bodega', utf8_decode($documentacion->horario_reciboMM)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Instrucciones especiales', utf8_decode($documentacion->instrucciones_especialesMM)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Clasificación Arancelaria', utf8_decode($documentacion->clasificacionCR)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Registros de Importación', utf8_decode($documentacion->registrosCR)));
$pdf->SetFills(array (0,0));

$y = $pdf->GetY(); 
if ($y > 225){
    $pdf->AddPage();
}

$pdf->ln(5);
$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'SOLICITUD DE FONDOS O ANTICIPOS',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();

$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Gastos portuarios', utf8_decode($documentacion->portuariosSF),'Almacenajes',utf8_decode($documentacion->almacenajesSF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Flete internacional', utf8_decode($documentacion->fleteSF) ,'Transporte interno, urbano',utf8_decode($documentacion->transporteSF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('ICA, INVIMA', utf8_decode($documentacion->icainvimaSF ),'Otros gastos',utf8_decode($documentacion->otrosgastosSF)));
$pdf->SetFills(array (0,0));
    
$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Tributos aduaneros', utf8_decode($documentacion->tributosSF),'Ingresos propios',utf8_decode($documentacion->ingresosSF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Bancos', utf8_decode($documentacion->bancosSF)));
$pdf->SetFills(array (0,0));


$y = $pdf->GetY(); 
if ($y > 225){
    $pdf->AddPage();
}

$pdf->ln(5);
$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'FACTURACIÓN',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();


$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Fechas de Cierre', utf8_decode($documentacion->fechascierreF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Soportes facturación nacionalización', utf8_decode($documentacion->soportesF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Plazo facturación Vs. Despacho/Embarque ', utf8_decode($documentacion->plazoF)));
$pdf->SetFills(array (0,0));

$pdf->ln(10);

$pdf->SetWidths(array (30, 10, 30, 10, 30, 70));
$pdf->SetAligns(array ("L", "L","L", "L","L", "L"));
$pdf->SetStyles(array ("", "","","","",""));
$pdf->Row(array('Crédito', utf8_decode($documentacion->creditoF) ,'Días',utf8_decode($documentacion->diasF),'Cupo',utf8_decode($documentacion->cupoF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10, 30, 60));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Fondo Anticipo', utf8_decode($documentacion->fondoanticipoF),'Valor',utf8_decode($documentacion->valorF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10, 30, 60));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Pago',utf8_decode( $documentacion->pagoF),'Banco',utf8_decode($documentacion->bancoF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 10, 30, 60));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Transferencia', utf8_decode($documentacion->transferenciaF),'Plazo',utf8_decode($documentacion->plazotransferenciaF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (50, 10, 50, 10, 50, 10));
$pdf->SetAligns(array ("L", "L","L", "L","L", "L"));
$pdf->SetStyles(array ("", "","","","",""));
$pdf->Row(array('Cheque', utf8_decode($documentacion->chequeF) ,'Consignación efectivo',utf8_decode($documentacion->consignacionF),'Pago electrónico',utf8_decode($documentacion->pagoelectronicoF)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Contacto área financiera', utf8_decode($documentacion->contactoareaF)));
$pdf->SetFills(array (0,0));
    
$pdf->SetWidths(array (30, 50, 30, 70));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Tel.', utf8_decode($documentacion->telefonoF,'E-mail',$documentacion->correoF)));
$pdf->SetFills(array (0,0));

$y = $pdf->GetY(); 
if ($y > 225){
    $pdf->AddPage();
}

$pdf->ln(5);

$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'OTROS CONTACTOS',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Depósito', utf8_decode($documentacion->nombre_deposito)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (40, 90, 20, 30));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Contacto.', utf8_decode($documentacion->contacto_deposito),'Tel.',utf8_decode($documentacion->tel_deposito)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Convenio', utf8_decode($documentacion->convenio_deposito)));
$pdf->SetFills(array (0,0,0));

$pdf->ln(5);

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Operador Portuario', utf8_decode($documentacion->nombre_operador)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (40, 90, 20, 30));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Contacto.', utf8_decode($documentacion->contacto_operador),'Tel.',utf8_decode($documentacion->tel_operador)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Convenio', utf8_decode($documentacion->convenio_operador)));
$pdf->SetFills(array (0,0));

 $pdf->ln(5);


$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Empresa de transporte nacional/urbano', utf8_decode($documentacion->nombre_empresanu)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (40, 90, 20, 30));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Contacto.', utf8_decode($documentacion->contacto_empresanu),'Tel.',utf8_decode($documentacion->tel_empresanu)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Convenio', utf8_decode($documentacion->convenio_empresanu)));
$pdf->SetFills(array (0,0));

$pdf->ln(5);


$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Empresas de vigilancia/escoltas', utf8_decode($documentacion->nombre_empresasve)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (40, 90, 20, 30));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Contacto.', utf8_decode($documentacion->contacto_empresasve),'Tel.',utf8_decode($documentacion->tel_empresasve)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Convenio', utf8_decode($documentacion->convenio_empresasve)));
$pdf->SetFills(array (0,0));

$y = $pdf->GetY(); 
if ($y > 225){
    $pdf->AddPage();
}

$pdf->ln(5);

$pdf->SetTextColor(14, 51, 172);
$pdf->SetFont($font, '', 15);
$pdf->Cell(190,10,'REPORTES E INFORMES',0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($font, '', 10);
$pdf->ln();
$x = $pdf->GetX();
$y = $pdf->GetY();  
$pdf->Line(10,$y,200,$y);
$pdf->ln();

$pdf->SetWidths(array (80, 10, 80, 10));
$pdf->SetAligns(array ("L", "L","L", "L"));
$pdf->SetStyles(array ("", "","",""));
$pdf->Row(array('Presentación de indicadores.', utf8_decode($documentacion->indicadoresRE),'Estado D.O. diario.',utf8_decode($documentacion->estadoRE)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Reporte despacho de mercancías', utf8_decode($documentacion->reporteRE)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Otros informes', utf8_decode($documentacion->informesRE)));
$pdf->SetFills(array (0,0));

$pdf->SetWidths(array (80, 100));
$pdf->SetAligns(array ("L", "L"));
$pdf->SetStyles(array ("", ""));
$pdf->Row(array('Envío copia de declaraciones', utf8_decode($documentacion->declaracionesRE)));
$pdf->SetFills(array (0,0));

$pdf->Output();
exit();
?>