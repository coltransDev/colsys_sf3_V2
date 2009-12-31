<?




$pdf->SetWidths ( array (26, 17, 25, 73, 59 ) );
$pdf->SetAligns ( array ("L", "L", "L", "L", "L", "L" ) );
$pdf->SetFills ( array (0, 0, 0, 0, 0, 0 ) );
$pdf->SetStyles ( array ("B", "", "B", "", "B", "" ) );
$pdf->Row ( array ('4. Fch.Despacho:', $reporte->getCaFchdespacho (), '5. Incoterms:', $reporte->getCaIncoterms () ) );



$agente = $reporte->getAgente ();





/*
$tiempo_cred = ($rs->Value('ca_liberacion')=='Sí')?" Tiempo de Crédito: ".$rs->Value('ca_tiempocredito'):"";
*/
$pdf->SetWidths ( array (40, 10, 35, 10, 35, 70 ) );
$pdf->Row ( array ('15. Transporte terrestre Nal:', $reporte->getCaColmas (), '16. Seguro:', $reporte->getCaSeguro () ,/*'17. Lib. Automática:'*/ '' ,/*$rs->Value('ca_liberacion').$tiempo_cred*/ '' ) );






?>