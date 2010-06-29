<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       COTIZACION.PHP                                              \\
// Creado:        2005-01-01                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2005-01-14                                                  \\
//                                                                            \\
// Descripción:   Módulo para la generación de archivos en formato PDF con la \\
//                cotización para el cliente.                                 \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 13;

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require('include/fpdf.php');                                               // Incorpora la librería de funciones, para generara Archivos en formato PDF
require('include/cpdf.php');                                               // Incorpora la plantilla con formato de Coltrans

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
$trans = array("Aéreo" => "Aérea", "Marítimo" => "Marítima", "Terrestre" => "Terrestre");

session_cache_limiter('private_expire');
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$modulo = "00100000";                                                          // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

    if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }
    $pr =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$pr->Open("select * from vi_cotproductos where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
        echo "<script>alert(\"".addslashes($pr->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }
    $op =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$op->Open("select * from vi_cotopciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
        echo "<script>alert(\"".addslashes($op->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }
    $rc =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$rc->Open("select * from vi_cotrecargos where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
        echo "<script>alert(\"".addslashes($rc->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }
    $cn =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$cn->Open("select * from vi_cotcontinuacion where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
        echo "<script>alert(\"".addslashes($cn->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }
    $sg =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$sg->Open("select * from tb_cotseguro where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
        echo "<script>alert(\"".addslashes($sg->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$us->Open("select * from vi_usuarios where ca_login = '".$rs->Value('ca_usuario')."'")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }
    $ag =& DlRecordset::NewRecordset($conn);

    $pdf=new PDF();
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->SetTopMargin(14);
    $pdf->SetLeftMargin(18);
    $pdf->SetRightMargin(12);
    $pdf->SetAutoPageBreak(true, 28);
    $pdf->AddPage();
	$pdf->SetHeight(4);
    $pdf->SetFont('Arial','',10);
    $pdf->SetSucursal($us->Value('ca_sucursal'));
    $pdf->SetLineRepeat("Señores: ".strtoupper($rs->Value('ca_compania')."    ".$rs->Value('ca_fchcotizacion')));
    $pdf->Ln(5);
    list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($rs->Value('ca_fchcotizacion'),"%d-%d-%d %d:%d:%d");
    $pdf->Cell(0, 4, str_replace(' D.C.','',$us->Value('ca_sucursal')).', '.$dia.' de '.$meses[$mes-1].' de '.$anno,0,1);
    $pdf->Ln(8);
    $pdf->Cell(0, 4, $rs->Value('ca_saludo_cn'),0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0, 4, strtoupper($rs->Value('ca_ncompleto_cn')),0,1);
    if ($rs->Value('ca_cargo')!='' and $rs->Value('ca_departamento')!='') {
        $cargo = $rs->Value('ca_cargo')." - ".$rs->Value('ca_departamento');
    } else if ($rs->Value('ca_cargo')!='' and $rs->Value('ca_departamento')=='') {
        $cargo = $rs->Value('ca_cargo');
    } else if ($rs->Value('ca_cargo')=='' and $rs->Value('ca_departamento')!='') {
        $cargo = $rs->Value('ca_departamento');
    }
    if ($cargo != '') {
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0, 4, $cargo,0,1);
    }
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0, 4, strtoupper($rs->Value('ca_compania')),0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0, 4, $rs->Value('ca_ciudad'),0,1);
    $pdf->Ln(8);
    $pdf->Cell(0, 4, 'Asunto : '.$rs->Value('ca_asunto')." ".$rs->Value('ca_consecutivo'),0,1);
//    $pdf->Cell(0, 0, 'Comunicación No. '.$rs->Value('ca_idcotizacion').'/'.$rs->Value('ca_usuario').str_pad(" ",7),0,0,'R');
    $pdf->Ln(4);
    $pdf->Cell(0, 4, $rs->Value('ca_saludo'),0,1);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 4, $rs->Value('ca_entrada'),0,1);
    $imp_mem = false;
    $exp_mem = false;
	$pto_mem = false;
	$cpt_mem = false;


// ======================== Impresión por Item ======================== //

    $pr->MoveFirst();
    while (!$pr->Eof() and !$pr->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $imp_mem = ($pr->Value('ca_impoexpo')=='Importación')?true:$imp_mem;
        $exp_mem = ($pr->Value('ca_impoexpo')=='Exportación')?true:$exp_mem;
		$age_imp = false;

        if ($pr->Value('ca_imprimir') == 'Por Item') {
			$pdf->Ln(4);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL', 0, 1, 'C');
			$age_imp = true;
			$pdf->SetFont('Arial','B',9);
			$pdf->Ln(2);
			$pdf->SetWidths(array(170));
			$pdf->SetAligns(array("L"));
			$pdf->SetStyles(array("B"));
			$pdf->Row(array('Producto : '.$pr->Value('ca_producto')));
			$pdf->SetFont('Arial','B',8);
			$pdf->SetWidths(array(20, 20, 40, 45, 45));
			$pdf->SetAligns(array_fill(0, 5, "C"));
			$pdf->SetStyles(array_fill(0, 5, "B"));
			$pdf->SetFills(array_fill(0, 5, 1));
			$pdf->Row(array('Impo/Expo', 'Transporte', 'Términos' ,'Origen', 'Destino'));
			$pdf->SetStyles(array_fill(0, 5, ""));
			$pdf->SetFills(array_fill(0, 5, 0));
			$pdf->SetFont('Arial','',8);
			$pdf->Row(array($pr->Value('ca_impoexpo'), $pr->Value('ca_transporte'), $pr->Value('ca_incoterms'), $pr->Value('ca_ciuorigen')." - ".$pr->Value('ca_traorigen'), $pr->Value('ca_ciudestino')." - ".$pr->Value('ca_tradestino')));

			$con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';
			$op->MoveFirst();
			$ix = 0;
			$imp_rec = false;
			$imp_obs = false;
			$array_items = array();
			while (!$op->Eof() and !$op->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
				if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto')) {
					$op->MoveNext();
					continue;
				}else {
					$rec_mem = '';
					$pro_mem = $pr->Value('ca_idproducto');
					$aflete = explode('|',$op->Value('ca_oferta'));
					$rc->MoveFirst();
					while (!$rc->Eof() and !$rc->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
						if ($op->Value('ca_idproducto') != $rc->Value('ca_idproducto') or $op->Value('ca_idopcion') != $rc->Value('ca_idopcion') or $op->Value('ca_idconcepto') != $rc->Value('ca_idconcepto')){
							$rc->MoveNext();
							continue; 
							}
						$rec_mem.= "» ".$rc->Value('ca_recargo')." ".(($rc->Value('ca_tipo')=='%')?$rc->Value('ca_tipo'):$rc->Value('ca_idmoneda'))." ".formatNumber($rc->Value('ca_valor_tar'),3)." ".$rc->Value('ca_aplica_tar').(($rc->Value('ca_valor_min')!=0)?" /Mín.".$rc->Value('ca_idmoneda')." ".formatNumber($rc->Value('ca_valor_min'),3)." ".$rc->Value('ca_aplica_min'):"").((strlen($rc->Value('ca_observaciones'))!=0)?" ".$rc->Value('ca_observaciones'):'')."\n";
						$rc->MoveNext();
					}
					$con_mem.= $op->Value('ca_concepto');
					$apl_mem = ((strlen($aflete[2])!=0)?" ".$aflete[2]:"");
					$min_mem = (($pr->Value('ca_transporte')=='Aéreo')?' x HAWB':' x HBL');
					$ofe_mem.= $op->Value('ca_idmoneda')." ".$aflete[0].$apl_mem.(($aflete[1]!=0)?" / Min. ".$op->Value('ca_idmoneda').$aflete[1].$min_mem:"")."\n";
					$det_mem.= ((strlen($op->Value('ca_observaciones'))!=0)?$op->Value('ca_observaciones'):"");
				}
				$imp_rec = (strlen($rec_mem)!=0)?true:false;
				$imp_obs = (strlen($det_mem)!=0)?true:false;
				$aconten = array($con_mem, $ofe_mem);
				if ($imp_rec){
					array_push($aconten, $rec_mem);}
				if ($imp_obs){
					array_push($aconten, $det_mem);}
				array_push($array_items, $aconten);
				$con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';
				$op->MoveNext();
			}
			$rc->MoveFirst();
			$imp_gen = false;
			while (!$rc->Eof() and !$rc->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
				if ($rc->Value('ca_idproducto') != $pro_mem or $rc->Value('ca_idopcion') != 999 or $rc->Value('ca_idconcepto') != 9999 and ca_generado == 'Recargo en Origen'){
					$rc->MoveNext();
					continue; 
					}
				$rec_mem.= "» ".$rc->Value('ca_recargo')." ".(($rc->Value('ca_tipo')=='%')?$rc->Value('ca_tipo'):$rc->Value('ca_idmoneda'))." ".formatNumber($rc->Value('ca_valor_tar'),3)." ".$rc->Value('ca_aplica_tar').(($rc->Value('ca_valor_min')!=0)?" /Mín.".$rc->Value('ca_idmoneda')." ".formatNumber($rc->Value('ca_valor_min'),3)." ".$rc->Value('ca_aplica_min'):"").((strlen($rc->Value('ca_observaciones'))!=0)?" ".$rc->Value('ca_observaciones'):'')."\n";
				$rc->MoveNext();
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
					$pdf->Row($val); }
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
			if (strlen($pr->Value('ca_frecuencia'))<>0){
				array_push($array_1,35);
				array_push($array_2,"L");
				array_push($array_3,"Frecuencia: ".nl2br($pr->Value('ca_frecuencia')));
				$pos_mem+= 35; }
			if (strlen($pr->Value('ca_tiempotransito'))<>0){
				array_push($array_1,35);
				array_push($array_2,"L");
				array_push($array_3,"T.Transito: ".nl2br($pr->Value('ca_tiempotransito')));
				$pos_mem+= 35; }
			if (strlen($pr->Value('ca_observaciones'))<>0){
				array_push($array_1,(170-$pos_mem));
				array_push($array_2,"L");
				array_push($array_3,"Observaciones: ".$pr->Value('ca_observaciones')); }
			$pdf->SetFont('Arial','',8);
			$pdf->SetWidths($array_1);
			$pdf->SetAligns($array_2);
			$pdf->Row($array_3);
			$age_mem = $pr->Value('ca_datosag');
		}
        $pr->MoveNext();
        if ($age_imp and ($pr->Value('ca_datosag')!=$age_mem or $pr->Eof())){
			print_agent($ag, $age_mem, $pdf); }
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

	$pr->MoveFirst();
    while (!$pr->Eof() and !$pr->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $imp_mem = ($pr->Value('ca_impoexpo')=='Importación')?true:$imp_mem;
        $exp_mem = ($pr->Value('ca_impoexpo')=='Exportación')?true:$exp_mem;
		$fyt_mem = (strlen($pr->Value('ca_frecuencia'))!=0)?"Frecuencia: ".nl2br($pr->Value('ca_frecuencia'))."\n":"";
		$fyt_mem.= (strlen($pr->Value('ca_tiempotransito'))!=0)?"T.Transito: ".nl2br($pr->Value('ca_tiempotransito'))."\n":"";
		$fyt_mem = str_repeat("=-=", 12)."\n".$fyt_mem;
		$age_arr = explode('|',$pr->Value('ca_datosag'));
		
        if ($pr->Value('ca_imprimir') == 'Puerto') {
			if(!in_array($trans[$pr->Value('ca_transporte')],$tra_arr)){
				array_push($tra_arr,$trans[$pr->Value('ca_transporte')]); }
	
			if(!in_array($pr->Value('ca_impoexpo'),$ime_arr)){
				array_push($ime_arr,$pr->Value('ca_impoexpo')); }

			while (list ($j, $cont) = each ($age_arr)) {
				$age_mem.= (stripos($age_mem,$cont)===false and strlen($cont)!=0)?$cont.'|':'';
			}
			$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $pto_mem = true;
			$op->MoveFirst();
			while (!$op->Eof() and !$op->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
				if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto')) {
					$op->MoveNext();
					continue;
				}else {
					$rec_mem = "";
					$pro_mem = $pr->Value('ca_idproducto');
					$con_mem = $op->Value('ca_concepto')." - ".substr($pr->Value('ca_incoterms'),0,3);
					$aflete = explode('|',$op->Value('ca_oferta'));
					$rc->MoveFirst();
					while (!$rc->Eof() and !$rc->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
						if ($op->Value('ca_idproducto') != $rc->Value('ca_idproducto') or $op->Value('ca_idopcion') != $rc->Value('ca_idopcion') or $op->Value('ca_idconcepto') != $rc->Value('ca_idconcepto')){
							$rc->MoveNext();
							continue; 
							}
						$rec_mem.= $rc->Value('ca_recargo')." ".(($rc->Value('ca_tipo')=='%')?$rc->Value('ca_tipo'):$rc->Value('ca_idmoneda'))." ".formatNumber($rc->Value('ca_valor_tar'),3)." ".$rc->Value('ca_aplica_tar').(($rc->Value('ca_valor_min')!=0)?" /Mín.".$rc->Value('ca_idmoneda')." ".formatNumber($rc->Value('ca_valor_min'),3)." ".$rc->Value('ca_aplica_min'):"").((strlen($rc->Value('ca_observaciones'))!=0)?" ".$rc->Value('ca_observaciones'):'')."\n";
						$rc->MoveNext();
					}
					$apl_mem = ((strlen($aflete[2])!=0)?" ".$aflete[2]:"");
					$min_mem = (($pr->Value('ca_transporte')=='Aéreo')?' x HAWB':' x HBL');
					$ofe_mem.= $op->Value('ca_idmoneda')." ".$aflete[0].$apl_mem.(($aflete[1]!=0)?" / Min. ".$aflete[1].$min_mem:"")."\n";
					$ofe_mem.= (strlen($rec_mem)!=0)?$rec_mem:"";
					if (strlen($apuerto[$pr->Value('ca_ciudestino')][$pr->Value('ca_ciuorigen')]) != 0){
						$apuerto[$pr->Value('ca_ciudestino')][$pr->Value('ca_ciuorigen')].= str_repeat("..-..", 12)."\n";
					}
					$apuerto[$pr->Value('ca_ciudestino')][$pr->Value('ca_ciuorigen')].= $con_mem." ".$ofe_mem;
					$atimest[$pr->Value('ca_ciudestino')][$pr->Value('ca_ciuorigen')].= $fyt_mem;
					$fyt_mem = "";
				}
				$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $rec_mem = '';
				$rc->MoveFirst();
				while (!$rc->Eof() and !$rc->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
					if ($rc->Value('ca_idproducto') != $pro_mem or $rc->Value('ca_idopcion') != 999 or $rc->Value('ca_idconcepto') != 9999 and ca_generado == 'Recargo en Origen'){
						$rc->MoveNext();
						continue; 
						}
					$rec_tmp = $rc->Value('ca_recargo')." ".(($rc->Value('ca_tipo')=='%')?$rc->Value('ca_tipo'):$rc->Value('ca_idmoneda'))." ".formatNumber($rc->Value('ca_valor_tar'),3)." ".$rc->Value('ca_aplica_tar').(($rc->Value('ca_valor_min')!=0)?" /Mín.".$rc->Value('ca_idmoneda')." ".formatNumber($rc->Value('ca_valor_min'),3)." ".$rc->Value('ca_aplica_min'):"").((strlen($rc->Value('ca_observaciones'))!=0)?" ".$rc->Value('ca_observaciones'):'')."\n";
					if (strpos($res_rec[$rc->Value('ca_transporte')], $rec_tmp) === false){
						$res_rec[$rc->Value('ca_transporte')].= "» ".$rec_tmp;
					}
					$rc->MoveNext();
				}
				$op->MoveNext();
			}
		}

        $pr->MoveNext();
		if ($pr->Eof() and $pto_mem){
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

	$pr->MoveFirst();
    while (!$pr->Eof() and !$pr->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $imp_mem = ($pr->Value('ca_impoexpo')=='Importación')?true:$imp_mem;
        $exp_mem = ($pr->Value('ca_impoexpo')=='Exportación')?true:$exp_mem;
		$fyt_mem = (strlen($pr->Value('ca_frecuencia'))!=0)?"Frecuencia: ".nl2br($pr->Value('ca_frecuencia'))."\n":"";
		$fyt_mem.= (strlen($pr->Value('ca_tiempotransito'))!=0)?"T.Transito: ".nl2br($pr->Value('ca_tiempotransito'))."\n":"";
		$age_arr = explode('|',$pr->Value('ca_datosag'));
		
        if ($pr->Value('ca_imprimir') == 'Concepto' or $pr->Value('ca_imprimir') == 'Trayecto') {
			if(!in_array($trans[$pr->Value('ca_transporte')],$tra_arr)){
				array_push($tra_arr,$trans[$pr->Value('ca_transporte')]); }
	
			if(!in_array($pr->Value('ca_impoexpo'),$ime_arr)){
				array_push($ime_arr,$pr->Value('ca_impoexpo')); }

			while (list ($j, $cont) = each ($age_arr)) {
				$age_mem.= (stripos($age_mem,$cont)===false and strlen($cont)!=0)?$cont.'|':'';
			}
			$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $cpt_mem = true;
			$op->MoveFirst();
			$una_vez = true;
			while (!$op->Eof() and !$op->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
				if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto')) {
					$op->MoveNext();
					continue;
				}else {
					$rec_mem = '';
					$pro_mem = $pr->Value('ca_idproducto');
					$aflete = explode('|',$op->Value('ca_oferta'));
					$rc->MoveFirst();
					while (!$rc->Eof() and !$rc->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
						if ($op->Value('ca_idproducto') != $rc->Value('ca_idproducto') or $op->Value('ca_idopcion') != $rc->Value('ca_idopcion') or $op->Value('ca_idconcepto') != $rc->Value('ca_idconcepto')){
							$rc->MoveNext();
							continue; 
							}
						$rec_mem.= $rc->Value('ca_recargo')." ".(($rc->Value('ca_tipo')=='%')?$rc->Value('ca_tipo'):$rc->Value('ca_idmoneda'))." ".formatNumber($rc->Value('ca_valor_tar'),3)." ".$rc->Value('ca_aplica_tar').(($rc->Value('ca_valor_min')!=0)?" /Mín.".$rc->Value('ca_idmoneda')." ".formatNumber($rc->Value('ca_valor_min'),3)." ".$rc->Value('ca_aplica_min'):"").((strlen($rc->Value('ca_observaciones'))!=0)?" ".$rc->Value('ca_observaciones'):'')."\n";
						$rc->MoveNext();
					}
					$apl_mem = ((strlen($aflete[2])!=0)?" ".$aflete[2]:"");
					$min_mem = (($pr->Value('ca_transporte')=='Aéreo')?' x HAWB':' x HBL');
					$ofe_mem.= $op->Value('ca_idmoneda')." ".$aflete[0].$apl_mem.(($aflete[1]!=0)?" / Min. ".$aflete[1].$min_mem:"")."\n";
					$ofe_mem.= (strlen($rec_mem)!=0)?$rec_mem:"";
					$ofe_mem.= ((strlen($op->Value('ca_observaciones'))!=0)?" ".$op->Value('ca_observaciones')."\n":'');
					$trayecto= $pr->Value('ca_ciuorigen')."\n".$pr->Value('ca_ciudestino');
					$concepto= $op->Value('ca_concepto')."\n".substr($pr->Value('ca_incoterms'),0,3);
					if ($pr->Value('ca_imprimir') == 'Concepto'){
						$len_mem = strlen($apuerto[$trayecto][$concepto]);
					}else{
						$len_mem = strlen($apuerto[$concepto][$trayecto]);
					}
					if ($len_mem != 0){
						if ($pr->Value('ca_imprimir') == 'Concepto'){
							$apuerto[$trayecto][$concepto].= str_repeat("=-=", 12)."\n";
						}else{
							$apuerto[$concepto][$trayecto].= str_repeat("=-=", 12)."\n";
						}
					}
					if ($pr->Value('ca_imprimir') == 'Concepto'){
						$apuerto[$trayecto][$concepto].= $ofe_mem;
					}else{
						$apuerto[$concepto][$trayecto].= $ofe_mem;
					}
					if (strlen($fyt_mem)!=''){
						array_push($ainform, $fyt_mem);
					}
					$fyt_mem = "";
				}
				$con_mem = ''; $ofe_mem = ''; $det_mem = ''; $rec_mem = '';
				$rc->MoveFirst();
				while (!$rc->Eof() and !$rc->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
					if ($rc->Value('ca_idproducto') != $pro_mem or $rc->Value('ca_idopcion') != 999 or $rc->Value('ca_idconcepto') != 9999 and ca_generado == 'Recargo en Origen'){
						$rc->MoveNext();
						continue; 
						}
					$rec_tmp = $rc->Value('ca_recargo')." ".(($rc->Value('ca_tipo')=='%')?$rc->Value('ca_tipo'):$rc->Value('ca_idmoneda'))." ".formatNumber($rc->Value('ca_valor_tar'),3)." ".$rc->Value('ca_aplica_tar').(($rc->Value('ca_valor_min')!=0)?" /Mín.".$rc->Value('ca_idmoneda')." ".formatNumber($rc->Value('ca_valor_min'),3)." ".$rc->Value('ca_aplica_min'):"").((strlen($rc->Value('ca_observaciones'))!=0)?" ".$rc->Value('ca_observaciones'):'')."\n";
					if (strpos($res_rec[$rc->Value('ca_transporte')], $rec_tmp) === false){
						$res_rec[$rc->Value('ca_transporte')].= "» ".$rec_tmp;
					}
					$rc->MoveNext();
				}
				$op->MoveNext();
			}
		}

        $pr->MoveNext();
		if ($pr->Eof() and $cpt_mem){
			$pdf->Ln(2);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(0, 4, 'TRANSPORTE DE CARGA INTERNACIONAL '.(strtoupper(implode("/", $ime_arr))).' '.(strtoupper(implode(" y ", $tra_arr))), 0, 1, 'C');
			$pdf->Ln(2);
			$cabecera = array_keys($apuerto);
			$acuerpo  = array();
			$len_res  = ($pr->Value('ca_imprimir') == 'Trayecto')?120:140;
			$tamanos  = array_fill(0, count($cabecera), round(($len_res/count($cabecera)),0) );
			array_unshift($tamanos,(170-(140-$len_res)-round(($len_res/count($cabecera)),0)*count($cabecera)));
			if ($pr->Value('ca_imprimir') == 'Trayecto'){
				array_push($cabecera, "Detalles\ndel Transporte");
				array_push($tamanos, 20);
			}
			array_unshift($cabecera,(($pr->Value('ca_imprimir')=='Concepto')?"Trayecto\nConcepto":"Concepto\nTrayecto"));
			array_unshift($ainform,"Detalles del Transporte->");
			$posicion = array_fill(0, count($cabecera), "C");
			$pdf->SetFont('Arial','',7);
			$pdf->SetWidths(array(170));
			$pdf->SetAligns(array("L"));
			$pdf->SetStyles(array("B"));
			$pdf->SetFills(array("1"));
			$pdf->Row(array('Producto : '.$pr->Value('ca_producto')));
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
					$acuerpo[$clave_1][$pos].=$val_1;
				}
			}
			$i=1;
			while (list ($clave, $val) = each ($acuerpo)) {
				$contenido = array_fill(0, count($cabecera), "");
				$contenido[0] = $clave;
				while (list ($clave_1, $val_1) = each ($val)) {
					$contenido[$clave_1].= $val_1;
				}
				if ($pr->Value('ca_imprimir') == 'Trayecto'){
					$contenido[count($contenido)-1] = $ainform[$i++];
				}
				if (strlen($pr->Value('ca_observaciones'))!= 0) {
					$contenido[count($contenido)-1] = $pr->Value('ca_observaciones');
				}
				$pdf->Row($contenido);
			}
			if ($pr->Value('ca_imprimir') == 'Concepto'){
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
	$rc->MoveFirst();
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
		$con_loc = ($con_loc!=0)?$con_loc:1;
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


    if (!$cn->Eof() and !$cn->IsEmpty()) {
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
		while (!$cn->Eof() and !$cn->IsEmpty()) {
			$aflete = explode('|',$cn->Value('ca_tarifa'));
			$ofe_mem= formatNumber($aflete[0],2).(($aflete[1]!=0)?" / Min. ".$aflete[1].$min_mem:"");
			$concep = ($cn->Value('ca_concepto') != $cn->Value('ca_equipo'))?$cn->Value('ca_concepto')." en ".$cn->Value('ca_equipo'):$cn->Value('ca_concepto');
			$valo_mem= array($cn->Value('ca_modalidad'), $concep, $cn->Value('ca_idmoneda'), $ofe_mem, $cn->Value('ca_observaciones'));
			if ($cn->Value('ca_tipo') != $tip_mem or $cn->Value('ca_modalidad') != $mod_mem or $cn->Value('ca_ciuorigen') != $org_mem or $cn->Value('ca_ciudestino') != $des_mem){
				$pdf->Ln($jump_mem);
				$pdf->SetWidths(array(20, 30, 30));
				$pdf->SetAligns(array_fill(0, 4, "L"));
				$pdf->SetStyles(array_fill(0, 4, "B"));
				$pdf->SetFills(array_fill(0, 4, 0));
				$pdf->Row(array('Tipo : '.$cn->Value('ca_tipo'), 'Origen : '.$cn->Value('ca_ciuorigen'), 'Destino : '.$cn->Value('ca_ciudestino')));
				$tip_mem = $cn->Value('ca_tipo');
				$mod_mem = $cn->Value('ca_modalidad');
				$org_mem = $cn->Value('ca_ciuorigen');
				$des_mem = $cn->Value('ca_ciudestino');
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
			$cn->MoveNext();
			}

		while (list ($clave, $val) = each ($imp_not)) {
		   $filename = "./links/Notas_OTM_$val.txt";
		   $handle = fopen($filename, "r");
		   $contents = fread($handle, filesize($filename));
		   fclose($handle);
		
		   $pdf->Ln(2);
		   $pdf->SetFont('Arial','B',9);
		   $pdf->MultiCell(0, 4, "NOTAS INCLUYE Y NO INCLUYE EN CONTINUACIÓN DE VIAJE (OTM/DTA) - CARGA $val", 0,'C',0);
		   $pdf->Ln(1);
		   $pdf->SetFont('Arial','',9);
		   $pdf->MultiCell(0, 4, $contents, 0,'J',0);
		}

    }

    if (!$sg->Eof() and !$sg->IsEmpty()) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(0, 4, 'SEGURO INTERNACIONAL', 0, 1, 'L', 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Ln(2);
		$i = 1;
		$linea = "";
		while (!$sg->Eof() and !$sg->IsEmpty()) {
			$aprima = explode('|',$sg->Value('ca_prima'));
			$pdf->Ln(1);
			$linea = "     $i) Prima sobre valor CIF de la mercancía ".(($aprima[0]=="%")?$aprima[1]." ".$aprima[0]:$sg->Value('ca_idmoneda')." ".$aprima[1])." ".(($aprima[2]!=0)?" / Mínimo ".$sg->Value('ca_idmoneda')." ".$aprima[2]:"").(($sg->Value('ca_obtencion')!=0)?" + Obtención de Póliza ".$sg->Value('ca_idmoneda')." ".$sg->Value('ca_obtencion'):"").((strlen($sg->Value('ca_observaciones'))!=0)?" ".$sg->Value('ca_observaciones'):".");
			$pdf->MultiCell(0, 4, $linea, 0, 1);
			$sg->MoveNext();
			$i++;
			}

		if ($imp_mem) {
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
		}
    }

    $pdf->SetFont('Arial','',10);
    $pdf->Ln(4);
    $pdf->MultiCell(0, 4, $rs->Value('ca_despedida'),0,1);
    $pdf->Ln(4);
    $pdf->MultiCell(0, 4, 'Cordialmente,',0,1);
    
    while (!$us->Eof() and !$us->IsEmpty()) {
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',10);
        $pdf->MultiCell(0, 4, strtoupper($us->Value('ca_nombre')),0,1);
        $pdf->SetFont('Arial','',10);
        $pdf->MultiCell(0, 4, strtoupper($us->Value('ca_cargo')),0,1);
        $pdf->MultiCell(0, 4, "COLTRANS S.A.",0,1);
        $pdf->MultiCell(0, 4, $us->Value('ca_direccion'),0,1);
		$pdf->MultiCell(0, 4, "Tel.:".$us->Value('ca_telefono')." ".$us->Value('ca_extension'),0,1);
		$pdf->MultiCell(0, 4, "Fax :".$us->Value('ca_fax'),0,1);
		$pdf->MultiCell(0, 4, $us->Value('ca_sucursal')." - Colombia",0,1);
		$pdf->MultiCell(0, 4, $us->Value('ca_email'),0,1);
		$pdf->MultiCell(0, 4, "www.coltrans.com.co",0,1);
        $us->MoveNext();
       }
    if ($rs->Value('ca_anexos') != '') {
        $pdf->Ln(6);
        $pdf->MultiCell(0, 4, "Anexo: ".$rs->Value('ca_anexos'),0,1);
    }

    if ($imp_mem) {
       $pdf->AddPage();
       $filename = "./links/Notas_Impo.txt";
       $handle = fopen($filename, "r");
       $contents = fread($handle, filesize($filename));
       fclose($handle);

       $pdf->Ln(2);
       $pdf->SetFont('Arial','B',9);
       $pdf->MultiCell(0, 4, "NOTAS IMPORTANTES QUE DEBEN TENER EN CUENTA"."\n"."EN SUS IMPORTACIONES", 0,'C',0);
       $pdf->Ln(1);
       $pdf->SetFont('Arial','',10);
       $pdf->MultiCell(0, 4, $contents, 0,'J',0);
    }

    if ($exp_mem) {
       $pdf->AddPage();
       $filename = "./links/Notas_Expo.txt";
       $handle = fopen($filename, "r");
       $contents = fread($handle, filesize($filename));
       fclose($handle);

       $pdf->Ln(2);
       $pdf->SetFont('Arial','B',9);
       $pdf->MultiCell(0, 4, "NOTAS IMPORTANTES QUE DEBEN TENER EN CUENTA"."\n"."EN SUS EXPORTACIONES", 0,'C',0);
       $pdf->Ln(1);
       $pdf->SetFont('Arial','',10);
       $pdf->MultiCell(0, 4, $contents, 0,'J',0);
    }
    $pdf->Output();


function print_agent(&$ag, &$age_mem, &$pdf){
	if (!$ag->Open("select * from vi_agentesxcont where ca_idcontacto::text in ("."'".implode('\',\'',explode("|",$age_mem))."'".") order by ca_transporte, ca_nomtrafico_ag, ca_nombre_ag, ca_nombre_co")) {
	   echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";
	   echo "<script>document.location.href = 'cotizaciones.php';</script>";
	   exit;
	  }
	if (strlen($age_mem)!=0 and !$ag->IsEmpty()) {
	   $pdf->Ln(4);
	   $pdf->SetFont('Arial','',9);
	   $pdf->MultiCell(0, 4, 'A continuación relacionamos los datos de nuestro agente encargado de coordinar los despachos:',0,1);
	   $pdf->Ln(2);
	   $tra_mem = '';
	   $nom_age = '';
	   $tra_age = '';
	   while (!$ag->Eof() and !$ag->IsEmpty()) {                          // Lee la totalidad de los registros obtenidos en la instrucción Select
		   if ($ag->Value('ca_transporte') != $tra_mem and strlen($ag->Value('ca_transporte')) != 0) {
		       $pdf->Ln(2);
		       $pdf->SetFont('Arial','B',11);
		       $pdf->MultiCell(0, 3,str_replace('|',' / ',strtoupper($ag->Value('ca_transporte'))),0,1);
		       $pdf->Ln(2);
		       $tra_mem = $ag->Value('ca_transporte'); }		   
		   if ($ag->Value('ca_nomtrafico_ag') != $tra_age) {
		       $pdf->Ln(1);
		       $pdf->SetFont('Arial','B',10);
		       $pdf->MultiCell(0, 3, '» '.$ag->Value('ca_nomtrafico_ag').' «',0,1);
		       $pdf->Ln(2);
		       $tra_age = $ag->Value('ca_nomtrafico_ag'); }		   
		   if ($ag->Value('ca_nombre_ag') != $nom_age) {
			   $pdf->SetFont('Arial','B',8);
			   $pdf->MultiCell(0, 3,$ag->Value('ca_nombre_ag'),0,1);
			   $pdf->SetFont('Arial','',8);
			   $pdf->MultiCell(0, 3,"Página Web :".$ag->Value('ca_website'),0,1);
			   $pdf->MultiCell(0, 3,"Correo Electrónico :".$ag->Value('ca_email_ag'),0,1);
			   $pdf->Ln(2);
			   $pdf->MultiCell(0, 3,"Contactos :",0,1);
			   $nom_age = $ag->Value('ca_nombre_ag');
			   }
		   $pdf->SetFont('Arial','B',8);
		   $pdf->MultiCell(0, 3,$ag->Value('ca_nombre_co'),0,1);
		   $pdf->SetFont('Arial','',8);
		   $pdf->MultiCell(0, 3,$ag->Value('ca_direccion_co')." - ".$ag->Value('ca_ciudad_co'),0,1);
		   $pdf->MultiCell(0, 3,"Teléfonos (".substr(strtoupper($ag->Value('ca_idtrafico')),3,3)." - ".substr(strtoupper($ag->Value('ca_idciudad_co')),4,4).") : ".$ag->Value('ca_telefonos_co')." - Fax : ".$ag->Value('ca_fax_co'),0,1);
		   $pdf->MultiCell(0, 3,"Correo Electrónico :".$ag->Value('ca_email_co'),0,1);
		   $pdf->Ln(2);
		   $ag->MoveNext();
		   }
	   }
}
?>