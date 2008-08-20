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

$pdf->setColtransHeader ( true );
$pdf->setColtransFooter ( true );

$sucursal = $usuario->getSucursal();
$pdf->SetSucursal($sucursal->getCaNombre());
$pdf->SetLineRepeat("Señores: ".strtoupper($cliente->getCaCompania()."    ".$cotizacion->getCaFchcotizacion()));
$pdf->Ln(5);
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($cotizacion->getCaFchcotizacion(),"%d-%d-%d %d:%d:%d");

$pdf->Cell(0, 4, str_replace(' D.C.','',$usuario->getCaSucursal()).', '.$dia.' de '.$meses[$mes-1].' de '.$anno,0,1);


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


$imp_mem = false;
$exp_mem = false;
$pto_mem = false;
$cpt_mem = false;

$productos = $cotizacion->getCotProductos();
// ======================== Impresión por Item ======================== //


foreach( $productos as $producto ){
	$imp_mem = ($producto->getCaImpoExpo()=='Importación')?true:$imp_mem;
	$exp_mem = ($producto->getCaImpoExpo()=='Exportación')?true:$exp_mem;
	$age_imp = false;
	if ($producto->getCaImprimir() == 'Por Item') {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL', 0, 1, 'C');
		$age_imp = true;
		$pdf->SetFont('Arial','B',9);
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

		$con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';			
		
		$ix = 0;
		$imp_rec = false;
		$imp_obs = false;
		$array_items = array();
		
		$opciones = $producto->getCotOpciones();
		
		foreach( $opciones as $opcion ){
			$rec_mem = '';
			$pro_mem = $producto->getcaIdProducto();
			$aflete = explode('|',$opcion->getCaOferta());
			$recargos = $opcion->getCotRecargos( );
			foreach( $recargos as $recargo ){
				$tipoRecargo = $recargo->getTipoRecargo();
				$rec_mem.= "» ".$tipoRecargo->getCaRecargo()." ".(($recargo->getCaTipo()=='%')?$recargo->getCaTipo():$recargo->getCaIdmoneda())." ".Utils::formatNumber($recargo->getCaValorTar(),3)." ".$recargo->getCaAplicaTar().(($recargo->getCaValorMin()!=0)?" /Mín.".$recargo->getCaIdmoneda()." ".Utils::formatNumber($recargo->getCaValorMin(),3)." ".$recargo->getCaAplicaMin():"").((strlen($recargo->getCaObservaciones()))?" ".$recargo->getCaObservaciones():'')."\n";			
			}
			$concepto = $opcion->getConcepto();
			$con_mem.= $concepto->getCaConcepto();
			$apl_mem = ((strlen($aflete[2])!=0)?" ".$aflete[2]:"");
			$min_mem = (($producto->getCaTransporte()=='Aéreo')?' x HAWB':' x HBL');
			$ofe_mem.= $opcion->getCaIdmoneda()." ".$aflete[0].$apl_mem.(($aflete[1]!=0)?" / Min. ".$opcion->getCaIdmoneda().$aflete[1].$min_mem:"")."\n";
			$det_mem.= ((strlen($opcion->getCaObservaciones())!=0)?$opcion->getCaObservaciones():"");		
			
			$imp_rec = (strlen($rec_mem)!=0)?true:false;
			$imp_obs = (strlen($det_mem)!=0)?true:false;
			$aconten = array($con_mem, $ofe_mem);
			if ($imp_rec){
				array_push($aconten, $rec_mem);
			}
			if ($imp_obs){
				array_push($aconten, $det_mem);
			}
			array_push($array_items, $aconten);
			$con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';			
		}
		
		
	}
	
	// Por que aca se repite 
	$imp_gen = false;
	$recargos = $opcion->getCotRecargos( );
	foreach( $recargos as $recargo ){ 	
		$tipoRecargo = $recargo->getTipoRecargo();
		if ($recargo->getCotOpcion()->getCaIdproducto() != $pro_mem or $recargo->getCaIdopcion() != 999 or $recargo->getCaIdconcepto() != 9999 and $tipoRecargo->getCatipo() == 'Recargo en Origen'){
			continue;
		}	
		$rec_mem.= "» ".$tipoRecargo->getCaRecargo()." ".(($recargo->getCaTipo()=='%')?$recargo->getCaTipo():$recargo->getCaIdmoneda())." ".Utils::formatNumber($recargo->getCaValorTar(),3)." ".$recargo->getCaAplicaTar().(($recargo->getCaValorMin()!=0)?" /Mín.".$recargo->getCaIdmoneda()." ".Utils::formatNumber($recargo->getCaValorMin(),3)." ".$recargo->getCaAplicaMin():"").((strlen($recargo->getCaObservaciones())!=0)?" ".$recargo->getCaObservaciones():'')."\n";	
		$imp_gen = true;		
		
	}
	
	if ($imp_rec or $imp_obs){
		if ($imp_rec && $imp_obs ){
			$array_1 = array(30, 25);
		}elseif( $imp_rec ){
			$array_1 = array(30, 70);
		}elseif( $imp_obs ){
			$array_1 = array(30, 95);
		}else{
			$array_1 = array(30, 140);
		}
		$array_2 = array('Concepto', 'Tarifas');
		if ($imp_rec){
			array_push($array_1, 70);
			array_push($array_2, 'Recargos por Tarifa'); }
		if ($imp_obs){
			array_push($array_1, 45);
			array_push($array_2, 'Observaciones'); }
		$pdf->Ln(2);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetWidths($array_1);
		$pdf->SetAligns(array_fill(0, 4, "C"));
		$pdf->SetStyles(array_fill(0, 4, "B"));
		$pdf->SetFills(array_fill(0, 4, 1));
		$pdf->Row($array_2);
		$pdf->SetAligns(array_fill(0, 4, "L"));
		$pdf->SetStyles(array_fill(0, 4, ""));
		$pdf->SetFills(array_fill(0, 4, 0));
		$pdf->SetFont('Arial','',7);
		while (list ($clave, $val) = each ($array_items)) {
			$pdf->Row($val); 
		}
	} else {
		$array_1 = array(80,90); //aca cambie los valores para que se ajustara al margen de la hoja Andres
		$array_2 = array('Tarifas por Concepto','Recargos en Origen');
		$imp_gen = false;
		$fle_mem = '';
		while (list ($clave, $val) = each ($array_items)) {
			while (list ($clave_sub, $val_sub) = each ($val)) {
				if (strlen($val_sub)!=0){ 
					$fle_mem.= trim($val_sub)." / ";
				}
			}
			$fle_mem = substr($fle_mem,0,strlen($fle_mem)-2)."\n";
		}
		$array_3 = array($fle_mem, $rec_mem);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetWidths($array_1);
		$pdf->SetAligns(array_fill(0, 2, "C"));
		$pdf->SetStyles(array_fill(0, 2, "B"));
		$pdf->SetFills(array_fill(0, 2, 1));
		$pdf->Row($array_2);
		$pdf->SetAligns(array_fill(0, 2, "L"));
		$pdf->SetStyles(array_fill(0, 2, ""));
		$pdf->SetFills(array_fill(0, 2, 0));
		$pdf->SetFont('Arial','',7);
		$pdf->Row($array_3);
	}
	
	if ($imp_gen){
		$pdf->Ln(2);
		$pdf->SetWidths(array(170));
		$pdf->SetAligns(array("C"));
		$pdf->SetStyles(array("B"));
		$pdf->SetFills(array(1));
		$pdf->Row(array("Recargos en Origen"));
		$pdf->SetAligns(array("L"));
		$pdf->SetStyles(array(""));
		$pdf->SetFills(array(0));
		$pdf->Row(array($rec_mem));
	}
	
	$pdf->Ln(2);
	$array_1 = array();
	$array_2 = array();
	$array_3 = array();
	$pos_mem = 0;
	if (strlen($producto->getCaFrecuencia())<>0){
		array_push($array_1,35);
		array_push($array_2,"L");
		array_push($array_3,"Frecuencia: ".nl2br($producto->getCaFrecuencia()));
		$pos_mem+= 35; 
	}
	if (strlen($producto->getCaTiempotransito())<>0){
		array_push($array_1,35);
		array_push($array_2,"L");
		array_push($array_3,"T.Transito: ".nl2br($producto->getCaTiempotransito()));
		$pos_mem+= 35; 
	}
	if (strlen($producto->getCaObservaciones())<>0){
		array_push($array_1,(170-$pos_mem));
		array_push($array_2,"L");
		array_push($array_3,"Observaciones: ".$producto->getCaObservaciones()); }
	$pdf->SetFont('Arial','',8);
	$pdf->SetWidths($array_1);
	$pdf->SetAligns($array_2);
	$pdf->Row($array_3);
	$age_mem = $producto->getCaDatosag();
}

if ($age_imp and ($producto->getCaDatosag()!=$age_mem )){ //or $pr->Eof()
	print_agent($ag, $age_mem, $pdf); 
}


// ======================== Impresión por Puerto ======================== //
$age_mem = '';
$apuerto = array();
$atimest = array();
$age_arr = array();
$array_1 = array();
$array_2 = array();
$array_3 = array();
$array_4 = array();
$array_5 = array();
$tra_arr = array();
$ime_arr = array();
$res_rec = array();

foreach( $productos as $producto ){

	$imp_mem = ($producto->getCaImpoExpo()=='Importación')?true:$imp_mem;
	$exp_mem = ($producto->getCaImpoExpo()=='Exportación')?true:$exp_mem;
	$age_imp = false;
	
	$fyt_mem = (strlen($producto->getCaFrecuencia())!=0)?"Frecuencia: ".nl2br($producto->getCaFrecuencia())."\n":"";
	$fyt_mem.= (strlen($producto->getCaTiempotransito())!=0)?"T.Transito: ".nl2br($producto->getCaTiempotransito())."\n":"";
	$fyt_mem = str_repeat("=-=", 12)."\n".$fyt_mem;
	$age_arr = explode('|',$producto->getCaDatosag() );
	
	if ( $producto->getCaImprimir() == 'Puerto'  ) {
		if(!in_array($trans[$producto->getCaTransporte()],$tra_arr)){
			array_push($tra_arr,$trans[$producto->getCaTransporte()]);
		}
	
		if(!in_array($producto->getCaImpoexpo(),$ime_arr)){
			array_push($ime_arr,$producto->getCaImpoexpo()); 
		}
		while (list ($j, $cont) = each ($age_arr)) {
			$age_mem.= (stripos($age_mem,$cont)===false and strlen($cont)!=0)?$cont.'|':'';
		}
		$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $pto_mem = true;
		
		$opciones = $producto->getCotOpciones();		
		foreach( $opciones as $opcion ){
			$rec_mem = "";
			$pro_mem = $producto->getCaIdproducto();
			$concepto = $opcion->getConcepto();
			$con_mem = $concepto->getCaConcepto()." - ".substr($producto->getCaIncoterms(),0,3);
			$aflete = explode('|',$opcion->getCaOferta());			
			$recargos = $opcion->getCotRecargos( );
			foreach( $recargos as $recargo ){
				$tipoRecargo = $recargo->getTipoRecargo();
				$rec_mem.= "» ".$tipoRecargo->getCaRecargo()." ".(($recargo->getCaTipo()=='%')?$recargo->getCaTipo():$recargo->getCaIdmoneda())." ".Utils::formatNumber($recargo->getCaValorTar(),3)." ".$recargo->getCaAplicaTar().(($recargo->getCaValorMin()!=0)?" /Mín.".$recargo->getCaIdmoneda()." ".Utils::formatNumber($recargo->getCaValorMin(),3)." ".$recargo->getCaAplicaMin():"").((strlen($recargo->getCaObservaciones())!=0)?" ".$recargo->getCaObservaciones():'')."\n";	
			
			}
			$apl_mem = ((strlen($aflete[2])!=0)?" ".$aflete[2]:"");
			$min_mem = (($producto->getCaTransporte()=='Aéreo')?' x HAWB':' x HBL');
			$ofe_mem.= $opcion->getCaIdmoneda()." ".$aflete[0].$apl_mem.(($aflete[1]!=0)?" / Min. ".$aflete[1].$min_mem:"")."\n";
			$ofe_mem.= (strlen($rec_mem)!=0)?$rec_mem:"";
			if (@strlen($apuerto[$producto->getDestino()->getCaCiudad()][$producto->getOrigen()->getCaCiudad()]) != 0){
				$apuerto[$producto->getDestino()->getCaCiudad()][$producto->getOrigen()->getCaCiudad()].= str_repeat("..-..", 12)."\n";
			}
			@$apuerto[$producto->getDestino()->getCaCiudad()][$producto->getOrigen()->getCaCiudad()].= $con_mem." ".$ofe_mem;
			@$atimest[$producto->getDestino()->getCaCiudad()][$producto->getOrigen()->getCaCiudad()].= $fyt_mem;
			$fyt_mem = "";
		
			$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $rec_mem = '';
			foreach( $recargos as $recargo ){ 	
				$tipoRecargo = $recargo->getTipoRecargo();
				if ($recargo->getCotOpcion()->getCaIdproducto() != $pro_mem or $recargo->getCaIdopcion() != 999 or $recargo->getCaIdconcepto() != 9999 and $tipoRecargo->getCatipo() == 'Recargo en Origen'){
					continue; 
				}	
				$rec_tmp="";	
//				$rec_tmp.= "» ".$tipoRecargo->getCaTipo()." ".(($recargo->getCaTipo()=='%')?$recargo->getCaTipo():$recargo->getCaIdmoneda())." ".Utils::formatNumber($recargo->getCaValorTar(),3)." ".$recargo->getCaAplicaTar().(($recargo->getCaValorMin()!=0)?" /Mín.".$recargo->getCaIdmoneda()." ".Utils::formatNumber($recargo->getCaValorMin(),3)." ".$recargo->getCaAplicaMin():"").((strlen($recargo->getCaObservaciones())!=0)?" ".$recargo->getCaObservaciones():'')."\n";	
				if (strpos($res_rec[$producto->getCaTransporte()], $rec_tmp) === false){
					$res_rec[$producto->getCaTransporte()].= "» ".$rec_tmp;
				}				
			}		
		}
	}
	if ( $pto_mem){ //$pr->Eof() and
		$pdf->Ln(2);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL '.(strtoupper(implode("/", $ime_arr))).' '.(strtoupper(implode(" y ", $tra_arr))), 0, 1, 'C');
		$pdf->Ln(2);
		$destinos = array_keys($apuerto);
		$tamanos  = array_fill(0, count($destinos), round((140/count($destinos)),0) );
		array_unshift($tamanos,(170-round((140/count($destinos)),0)*count($destinos)));
		array_unshift($destinos,"Origen/Destino");
		$posicion = array_fill(0, count($destinos), "C");
		$pdf->SetFont('Arial','',7);
		$pdf->SetWidths($tamanos);
		$pdf->SetAligns($posicion);
		$pdf->SetStyles(array_fill(0, count($destinos), "B"));
		$pdf->SetFills(array_fill(0, count($destinos), 1));
		$pdf->Row($destinos);
		$pdf->SetStyles(array_fill(0, count($destinos), ""));
		$pdf->SetFills(array_fill(0, count($destinos), 0));
		while (list ($clave, $val) = each ($apuerto)) {
			while (list ($clave_1, $val_1) = each ($val)) {
				$pos = array_search($clave, $destinos);
				$contenido = array_fill(0, count($destinos), "");
				$contenido[0] = $clave_1;
				$contenido[$pos] = $val_1.$atimest[$clave][$clave_1];
				$pdf->Row($contenido);
			}
		}
		ksort($res_rec);
		$con_org = count($res_rec);
		while (list ($clave, $val) = each ($res_rec)) {
			if (strlen($val) >=0){
				array_push($array_1,170/$con_org);
				array_push($array_2,"L");
				array_push($array_3,$val);
				array_push($array_4,"Recargos en Origen - ".$clave);
				array_push($array_5,"C");
			}
		}
		$pdf->SetWidths($array_1);
		$pdf->SetAligns($array_5);
		$pdf->SetStyles(array_fill(0, 2, "B"));
		$pdf->SetFills(array_fill(0, 2, 1));
		$pdf->Row($array_4);
		$pdf->SetAligns($array_2);
		$pdf->SetStyles(array_fill(0, 2, ""));
		$pdf->SetFills(array_fill(0, 2, 0));
		$pdf->Row($array_3);
		$age_mem = substr($age_mem,0,strlen($age_mem)-1);
		print_agent($ag, $age_mem, $pdf);
	}
}


// ======================== Impresión por Concepto o Trayecto ======================== //
$age_mem = '';
$age_arr = array();
$ainform = array();
$array_1 = array();
$array_2 = array();
$array_3 = array();
$array_4 = array();
$array_5 = array();
$res_rec = array();
$tra_arr = array();
$ime_arr = array();

foreach( $productos as $producto ){ 
	
	if ($producto->getCaImprimir() == 'Concepto' or $producto->getCaImprimir() == 'Trayecto'  ) {
		$imp_mem = ($producto->getCaImpoExpo()=='Importación')?true:$imp_mem;
		$exp_mem = ($producto->getCaImpoExpo()=='Exportación')?true:$exp_mem;
			
		$fyt_mem = (strlen($producto->getCaFrecuencia())!=0)?"Frecuencia: ".nl2br($producto->getCaFrecuencia())."\n":"";
		$fyt_mem.= (strlen($producto->getCaTiempotransito())!=0)?"T.Transito: ".nl2br($producto->getCaTiempotransito())."\n":"";
		$fyt_mem = str_repeat("=-=", 12)."\n".$fyt_mem;
		$age_arr = explode('|',$producto->getCaDatosag() );
		
		if(!in_array($trans[$producto->getCaTransporte()],$tra_arr)){
			array_push($tra_arr,$trans[$producto->getCaTransporte()]); 
		}

		if(!in_array($producto->getCaImpoExpo(),$ime_arr)){
			array_push($ime_arr,$producto->getCaImpoExpo()); 
		}

		while (list ($j, $cont) = each ($age_arr)) {
			$age_mem.= (stripos($age_mem,$cont)===false and strlen($cont)!=0)?$cont.'|':'';
		}
		$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $cpt_mem = true;		
		$una_vez = true;
		$opciones = $producto->getCotOpciones();
		
		foreach( $opciones as $opcion ){
			$rec_mem = '';
			$pro_mem = $producto->getCaIdproducto();
			$aflete = explode('|',$opcion->getCaOferta());
			$recargos = $opcion->getCotRecargos( );
			foreach( $recargos as $recargo ){
				$tipoRecargo = $recargo->getTipoRecargo();
				$rec_mem.= "» ".$tipoRecargo->getCaRecargo()." ".(($recargo->getCaTipo()=='%')?$recargo->getCaTipo():$recargo->getCaIdmoneda())." ".Utils::formatNumber($recargo->getCaValorTar(),3)." ".$recargo->getCaAplicaTar().(($recargo->getCaValorMin()!=0)?" /Mín.".$recargo->getCaIdmoneda()." ".Utils::formatNumber($recargo->getCaValorMin(),3)." ".$recargo->getCaAplicaMin():"").((strlen($recargo->getCaObservaciones())!=0)?" ".$recargo->getCaObservaciones():'')."\n";
			}
			$apl_mem = ((strlen($aflete[2])!=0)?" ".$aflete[2]:"");
			$min_mem = (($producto->getCaTransporte()=='Aéreo')?' x HAWB':' x HBL');
			$ofe_mem.= $opcion->getCaIdmoneda()." ".$aflete[0].$apl_mem.(($aflete[1]!=0)?" / Min. ".$aflete[1].$min_mem:"")."\n";
			$ofe_mem.= (strlen($rec_mem)!=0)?$rec_mem:"";
			$ofe_mem.= ((strlen($opcion->getCaObservaciones())!=0)?" ".$opcion->getCaObservaciones()."\n":'');
			$trayecto= $producto->getOrigen()->getCaCiudad()."\n".$producto->getDestino()->getCaCiudad();
			$conceptoR = $opcion->getConcepto();
			$concepto= $conceptoR->getCaConcepto()."\n".substr($producto->getCaIncoterms(),0,3);
			if ($producto->getCaImprimir() == 'Concepto'){
				@$len_mem = strlen($apuerto[$trayecto][$concepto]);
			}else{
				@$len_mem = strlen($apuerto[$concepto][$trayecto]);
			}
			if ($len_mem != 0){
				if ($producto->getCaImprimir() == 'Concepto'){
					@$apuerto[$trayecto][$concepto].= str_repeat("=-=", 12)."\n";
				}else{
					@$apuerto[$concepto][$trayecto].= str_repeat("=-=", 12)."\n";
				}
			}
			if ($producto->getCaImprimir() == 'Concepto'){
				@$apuerto[$trayecto][$concepto].= $ofe_mem;
			}else{
				@$apuerto[$concepto][$trayecto].= $ofe_mem;
			}
			if (strlen($fyt_mem)!=''){
				array_push($ainform, $fyt_mem);
			}
			$fyt_mem = "";	
			
			$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $rec_mem = '';
			$recargos = $opcion->getCotRecargos( );
			foreach( $recargos as $recargo ){ 	
				$tipoRecargo = $recargo->getTipoRecargo();
				if ($recargo->getCotOpcion()->getCaIdproducto() != $pro_mem or $recargo->getCaIdopcion() != 999 or $recargo->getCaIdconcepto() != 9999 and $tipoRecargo->getCatipo() == 'Recargo en Origen'){
					continue; 
				}	
					
				$rec_tmp.= "» ".$tipoRecargo->getCaTipo()." ".(($recargo->getCaTipo()=='%')?$recargo->getCaTipo():$recargo->getCaIdmoneda())." ".Utils::formatNumber($recargo->getCaValorTar(),3)." ".$recargo->getCaAplicaTar().(($recargo->getCaValorMin()!=0)?" /Mín.".$recargo->getCaIdmoneda()." ".Utils::formatNumber($recargo->getCaValorMin(),3)." ".$recargo->getCaAplicaMin():"").((strlen($recargo->getCaObservaciones())!=0)?" ".$recargo->getCaObservaciones():'')."\n";	
				if (strpos($res_rec[$producto->getCaTransporte()], $rec_tmp) === false){
					$res_rec[$producto->getCaTransporte()].= "» ".$rec_tmp;
				}				
			}		
		}
		
		
	}
}

if ( $cpt_mem){ //$pr->Eof() and
	$pdf->Ln(2);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL '.(strtoupper(implode("/", $ime_arr))).' '.(strtoupper(implode(" y ", $tra_arr))), 0, 1, 'C');
	$pdf->Ln(2);
	$cabecera = array_keys($apuerto);
	$acuerpo  = array();
	$len_res  = ($producto->getCaImprimir() == 'Trayecto')?120:140;
	$tamanos  = array_fill(0, count($cabecera), round(($len_res/count($cabecera)),0) );
	array_unshift($tamanos,(170-(140-$len_res)-round(($len_res/count($cabecera)),0)*count($cabecera)));
	if ($producto->getCaImprimir() == 'Trayecto'){
		array_push($cabecera, "Detalles\ndel Transporte");
		array_push($tamanos, 20);
	}
	array_unshift($cabecera,(($producto->getCaImprimir()=='Concepto')?"Trayecto\nConcepto":"Concepto\nTrayecto"));
	array_unshift($ainform,"Detalles del Transporte->");
	$posicion = array_fill(0, count($cabecera), "C");
	$pdf->SetFont('Arial','',7);
	$pdf->SetWidths(array(170));
	$pdf->SetAligns(array("L"));
	$pdf->SetStyles(array("B"));
	$pdf->SetFills(array("1"));
	$pdf->Row(array('Producto : '.$producto->getCaProducto()));
	$pdf->SetWidths($tamanos);
	$pdf->SetAligns($posicion);
	$pdf->SetStyles(array_fill(0, count($cabecera), "B"));
	$pdf->SetFills(array_fill(0, count($cabecera), 1));
	$pdf->Row($cabecera);
	$pdf->SetStyles(array_fill(0, count($cabecera), ""));
	$pdf->SetFills(array_fill(0, count($cabecera), 0));
	while (list ($clave, $val) = each ($apuerto)) {
		while (list ($clave_1, $val_1) = each ($val)) {
			$pos = array_search($clave, $cabecera);
			@$acuerpo[$clave_1][$pos].=$val_1;
		}
	}
	$i=1;
	while (list ($clave, $val) = each ($acuerpo)) {
		$contenido = array_fill(0, count($cabecera), "");
		$contenido[0] = $clave;
		while (list ($clave_1, $val_1) = each ($val)) {
			@$contenido[$clave_1].= $val_1;
		}
		if ($producto->getCaImprimir() == 'Trayecto'){
			@$contenido[count($contenido)-1] = $ainform[$i++];
		}
		if (strlen($producto->getCaObservaciones())!= 0) {
			@$contenido[count($contenido)-1] = $producto->getCaObservaciones();
		}
		$pdf->Row($contenido);
	}
	if ($producto->getCaImprimir()== 'Concepto'){
		$pdf->Row($ainform);
	}
	$pdf->Ln(2);
	ksort($res_rec);
	$imp_rec = false;
	$con_org = count($res_rec);
	while (list ($clave, $val) = each ($res_rec)) {
		if (strlen($val) >=0){
			array_push($array_1,170/$con_org);
			array_push($array_2,"L");
			array_push($array_3,$val);
			array_push($array_4,"Recargos en Origen - ".$clave);
			array_push($array_5,"C");
			$imp_rec = true;
		}
	}
	if ($imp_rec){
		$pdf->SetWidths($array_1);
		$pdf->SetAligns($array_5);
		$pdf->SetStyles(array_fill(0, 2, "B"));
		$pdf->SetFills(array_fill(0, 2, 1));
		$pdf->Row($array_4);
		$pdf->SetAligns($array_2);
		$pdf->SetStyles(array_fill(0, 2, ""));
		$pdf->SetFills(array_fill(0, 2, 0));
		$pdf->Row($array_3);
	}
	$age_mem = substr($age_mem,0,strlen($age_mem)-1);
	print_agent($ag, $age_mem, $pdf);
	$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $rec_mem = '';

	$recargos = $opcion->getCotRecargos( );
	foreach( $recargos as $recargo ){ 	
		$tipoRecargo = $recargo->getTipoRecargo();
		if ($recargo->getCotOpcion()->getCaIdproducto() != $pro_mem or $recargo->getCaIdopcion() != 999 or $recargo->getCaIdconcepto() != 9999 and $tipoRecargo->getCatipo() == 'Recargo en Origen'){
			continue; 
		}	
			
		$rec_tmp.= "» ".$tipoRecargo->getCaTipo()." ".(($recargo->getCaTipo()=='%')?$recargo->getCaTipo():$recargo->getCaIdmoneda())." ".Utils::formatNumber($recargo->getCaValorTar(),3)." ".$recargo->getCaAplicaTar().(($recargo->getCaValorMin()!=0)?" /Mín.".$recargo->getCaIdmoneda()." ".Utils::formatNumber($recargo->getCaValorMin(),3)." ".$recargo->getCaAplicaMin():"").((strlen($recargo->getCaObservaciones())!=0)?" ".$recargo->getCaObservaciones():'')."\n";	
		if (strpos($res_rec[$producto->getCaTransporte()], $rec_tmp) === false){
			$res_rec[$producto->getCaTransporte()].= "» ".$rec_tmp;
		}				
	}
}

$array_1 = array();
$array_2 = array();
$array_3 = array();
$array_4 = array();
$array_5 = array();
$res_rec = array();
$tra_arr = array();
$con_loc = 0;

/*	


	
    if (!$rc->Eof() and !$rc->IsEmpty()) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(0, 4, 'RECARGOS LOCALES', 0, 1, 'L', 0);
		$pdf->Ln(2);
		$pdf->SetFont('Arial','',7);
		$tip_mem = '';
		$org_mem = '';
		$des_mem = '';
		$mod_mem = '';
		$jump_mem= 0;
		$rc->MoveFirst();
		while (!$rc->Eof() and !$rc->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
			if ($rc->Value('ca_idproducto') != 99 or $rc->Value('ca_idopcion') != 999 or $rc->Value('ca_idconcepto') != 9999 and ca_generado == 'Recargo Local'){
				$rc->MoveNext();
				continue; 
				}
			$clave = $rc->Value('ca_transporte').'-'.$rc->Value('ca_modalidad');
			if ($mod_mem != $rc->Value('ca_modalidad')){
				$mod_mem = $rc->Value('ca_modalidad');
				$con_loc++;
			}
			$rec_tmp = $rc->Value('ca_recargo')." ".(($rc->Value('ca_tipo')=='%')?$rc->Value('ca_tipo'):$rc->Value('ca_idmoneda'))." ".formatNumber($rc->Value('ca_valor_tar'),3)." ".$rc->Value('ca_aplica_tar').(($rc->Value('ca_valor_min')!=0)?" /Mín.".$rc->Value('ca_idmoneda')." ".formatNumber($rc->Value('ca_valor_min'),3)." ".$rc->Value('ca_aplica_min'):"").((strlen($rc->Value('ca_observaciones'))!=0)?" ".$rc->Value('ca_observaciones'):'')."\n";
			if (strpos($res_rec[$clave], $rec_tmp) === false){
				$res_rec[$clave].= "» ".$rec_tmp;
			}
			$rc->MoveNext();
		}
		ksort($res_rec);
		while (list ($clave, $val) = each ($res_rec)) {
			if (strlen($val) >=0){
				array_push($array_1,(170/$con_loc));
				array_push($array_2,"L");
				array_push($array_3,$val);
				array_push($array_4,"Recargos Locales - ".$clave);
				array_push($array_5,"C");
			}
		}
		$pdf->SetWidths($array_1);
		$pdf->SetAligns($array_5);
		$pdf->SetStyles(array_fill(0, $con_loc, "B"));
		$pdf->SetFills(array_fill(0, $con_loc, 1));
		$pdf->Row($array_4);
		$pdf->SetAligns($array_2);
		$pdf->SetStyles(array_fill(0, $con_loc, ""));
		$pdf->SetFills(array_fill(0, $con_loc, 0));
		$pdf->Row($array_3);
    }
*/
$continuaciones = $cotizacion->getCotContinuacions();
if ( count($continuaciones)>0 ) {
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(0, 4, 'SERVICIO DE CONTINUACIÓN DE VIAJE', 0, 1, 'L', 0);
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',7);
	$imp_not = array();
	$tip_mem = '';
	$mod_mem = '';
	$org_mem = '';
	$des_mem = '';
	$jump_mem= 0;
	foreach( $continuaciones as $continuacion ){
		$aflete = explode('|',$continuacion->getCaTarifa());
		$ofe_mem= Utils::formatNumber($aflete[0],2).(($aflete[1]!=0)?" / Min. ".$aflete[1].$min_mem:"");
		$concepto = $continuacion->getConcepto();
		$concep = ($concepto->getCaConcepto() != $continuacion->getEquipo())?$concepto->getCaConcepto()." en ".$continuacion->getEquipo():$concepto->getCaConcepto();
		$valo_mem= array($continuacion->getCaModalidad(), $concep, $continuacion->getCaIdmoneda(), $ofe_mem, $continuacion->getCaObservaciones());
		if ($continuacion->getCaTipo() != $tip_mem or $continuacion->getCaModalidad() != $mod_mem or  $continuacion->getOrigen()->getCaCiudad() != $org_mem or $continuacion->getDestino()->getCaCiudad() != $des_mem){
			$pdf->Ln($jump_mem);
			$pdf->SetWidths(array(20, 30, 30));
			$pdf->SetAligns(array_fill(0, 4, "L"));
			$pdf->SetStyles(array_fill(0, 4, "B"));
			$pdf->SetFills(array_fill(0, 4, 0));
			$pdf->Row(array('Tipo : '.$continuacion->getCaTipo(), 'Origen : '.$continuacion->getOrigen()->getCaCiudad(), 'Destino : '.$continuacion->getDestino()->getCaCiudad()));
			$tip_mem = $continuacion->getCaTipo();
			$mod_mem = $continuacion->getCaModalidad();
			$org_mem = $continuacion->getOrigen()->getCaCiudad();
			$des_mem = $continuacion->getDestino()->getCaCiudad();
			$with_mem= array(15, 55, 10, 30, 50);
			$titu_mem= array('Modalidad', 'Concepto', 'Mnd', 'Flete','Observaciones');
			$pdf->SetWidths($with_mem);
			$pdf->SetAligns(array_fill(0, count($with_mem), "C"));
			$pdf->SetStyles(array_fill(0, count($with_mem), "B"));
			$pdf->SetFills(array_fill(0, count($with_mem), 1));
			$pdf->Row($titu_mem);
			$pdf->SetAligns(array_fill(0, count($with_mem), "L"));
			$pdf->SetStyles(array_fill(0, count($with_mem), ""));
			$pdf->SetFills(array_fill(0, count($with_mem), 0));
			$jump_mem= 2;
			if (!in_array($mod_mem, $imp_not)){
				array_push($imp_not,$mod_mem);
			}
		}
		$pdf->Row($valo_mem);
	
	}

	/*while (list ($clave, $val) = each ($imp_not)) {
	   $filename = "../links/Notas_OTM_$val.txt";
	   $handle = fopen($filename, "r");
	   $contents = fread($handle, filesize($filename));
	   fclose($handle);
	
	   $pdf->Ln(2);
	   $pdf->SetFont('Arial','B',9);
	   $pdf->MultiCell(0, 4, "NOTAS INCLUYE Y NO INCLUYE EN CONTINUACIÓN DE VIAJE (OTM/DTA) - CARGA $val", 0,'C',0);
	   $pdf->Ln(1);
	   $pdf->SetFont('Arial','',9);
	   $pdf->MultiCell(0, 4, $contents, 0,'J',0);
	}*/
}

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

       
if ($cotizacion->getCaAnexos() != '') {
	$pdf->Ln(6);
	$pdf->MultiCell(0, 4, "Anexo: ".$cotizacion->getCaAnexos(),0,1);
}

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


function print_agent(&$ag, &$age_mem, &$pdf){
	$c = new Criteria();
	$c->add( ContactoAgentePeer::CA_IDCONTACTO, "'".implode('\',\'',explode("|",$age_mem))."'", Criteria::IN  );
	$contactosAgente = ContactoAgentePeer::doSelect( $c );
	
	if (strlen($age_mem)!=0 and count($contactosAgente)>0) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',9);
		$pdf->MultiCell(0, 4, 'A continuación relacionamos los datos de nuestro agente encargado de coordinar los despachos:',0,1);
		$pdf->Ln(2);
		$tra_mem = '';
		$nom_age = '';
		$tra_age = '';
		foreach( $contactosAgente as $contactoAg ){  
			$agente = $contactoAg->getAgente();                
			if ($contactoAg->getCaTransporte() != $tra_mem and strlen($contactoAg->getCaTransporte()) != 0) {
				$pdf->Ln(2);
				$pdf->SetFont('Arial','B',11);
				$pdf->MultiCell(0, 3,str_replace('|',' / ',strtoupper($contactoAg->getCaTransporte())),0,1);
				$pdf->Ln(2);
				$tra_mem = $contactoAg->getCaTransporte(); 
			}	
			$ciudad = $agente->getCiudad();
			
			if ($ciudad->getCaTrafico() != $tra_age) {
				$pdf->Ln(1);
				$pdf->SetFont('Arial','B',10);
				$pdf->MultiCell(0, 3, '» '.$ciudad->getCaTrafico().' «',0,1);
				$pdf->Ln(2);
				$tra_age =$ciudad->getCaTrafico(); 
			}		   
		   if ($agente->getCaNombre() != $nom_age) {
			   $pdf->SetFont('Arial','B',8);
			   $pdf->MultiCell(0, 3,$agente->getCaNombre(),0,1);
			   $pdf->SetFont('Arial','',8);
			   $pdf->MultiCell(0, 3,"Página Web :".$agente->getCaWebsite(),0,1);
			   $pdf->MultiCell(0, 3,"Correo Electrónico :".$agente->getCaEmail(),0,1);
			   $pdf->Ln(2);
			   $pdf->MultiCell(0, 3,"Contactos :",0,1);
			   $nom_age = $agente->getCaNombre();
			}
			$ciudadContacto=$contactoAg->getCiudad();
			$pdf->SetFont('Arial','B',8);
			$pdf->MultiCell(0, 3,$contactoAg->getCaNombre(),0,1);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(0, 3,$contactoAg->getCaDireccion()." - ".$ciudadContacto->getCaCiudad(),0,1);
			$pdf->MultiCell(0, 3,"Teléfonos (".substr(strtoupper($ciudad->getCaIdtrafico()),3,3)." - ".substr(strtoupper($ciudadContacto->getCaidCiudad()),4,4).") : ".$contactoAg->getCaTelefonos()." - Fax : ".$contactoAg->getCaFax(),0,1);
			$pdf->MultiCell(0, 3,"Correo Electrónico :".$contactoAg->getCaEmail(),0,1);
			$pdf->Ln(2);		
		}   
	}
}


$pdf->Output ( $filename);
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}

?>