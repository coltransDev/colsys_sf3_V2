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
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require('include/fpdf.php');                                               // Incorpora la librería de funciones, para generara Archivos en formato PDF
require('include/cpdf.php');                                               // Incorpora la plantilla con formato de Coltrans

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

session_cache_limiter('private_expire');
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$modulo = "00100000";                                                          // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos


if (true){
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
    $pdf->SetTopMargin(12);
    $pdf->SetLeftMargin(18);
    $pdf->SetRightMargin(12);
    $pdf->SetAutoPageBreak(true, 28);
    $pdf->AddPage();
	$pdf->SetHeight(4);
    $pdf->SetFont('Arial','',10);
    $pdf->SetSucursal($us->Value('ca_sucursal'));
    $pdf->Ln(5);
    list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($rs->Value('ca_fchcotizacion'),"%d-%d-%d %d:%d:%d");
    $pdf->Cell(0, 4, $us->Value('ca_sucursal').', '.$meses[$mes-1].' '.$dia.' de '.$anno,0,1);
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
    $pdf->Cell(0, 4, 'Asunto : '.$rs->Value('ca_asunto'),0,1);
//    $pdf->Cell(0, 0, 'Comunicación No. '.$rs->Value('ca_idcotizacion').'/'.$rs->Value('ca_usuario').str_pad(" ",7),0,0,'R');
    $pdf->Ln(4);
    $pdf->Cell(0, 4, $rs->Value('ca_saludo'),0,1);
    $pdf->Ln(4);
    $pdf->MultiCell(0, 4, $rs->Value('ca_entrada'),0,1);
    $opc_mem = ($pr->GetRowCount()>1)?true:false;
    $opc_num = 1;
    $imp_mem = false;
    $exp_mem = false;
	$det_tmp = '';
	$arr_loc = array();
    while (!$pr->Eof() and !$pr->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $imp_mem = ($pr->Value('ca_impoexpo')=='Importación')?true:$imp_mem;
        $exp_mem = ($pr->Value('ca_impoexpo')=='Exportación')?true:$exp_mem;
        $pdf->SetFont('Arial','B',9);
        $pdf->Ln(6);
        $pdf->SetWidths(array(170));
        $pdf->SetAligns(array("L"));
        $pdf->Row(array('Producto : '.$pr->Value('ca_producto').($opc_mem?'  (Opción '.($opc_num++).')':'')));

        $pdf->SetFont('Arial','B',8);
        $pdf->SetWidths(array(20, 20, 40, 45, 45));
        $pdf->SetAligns(array("C","C","C","C","C"));
        $pdf->Row(array('Impo/Expo', 'Transporte', 'Términos' ,'Origen', 'Destino'));
        $pdf->SetFont('Arial','',8);
        $pdf->Row(array($pr->Value('ca_impoexpo'), $pr->Value('ca_transporte'), $pr->Value('ca_incoterms'), $pr->Value('ca_ciuorigen')." - ".$pr->Value('ca_traorigen'), $pr->Value('ca_ciudestino')." - ".$pr->Value('ca_tradestino')));
        $pdf->Ln(2);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetWidths(array(30, 25, 70, 45));
        $pdf->SetAligns(array("C","C","C","C"));
        $pdf->Row(array('Concepto', 'Tarifas', 'Recargos en Origen', 'Detalles'));
        $pdf->SetAligns(array("L","L","L","L"));
        $pdf->SetFont('Arial','',8);
        $con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';
        $op->MoveFirst();
        while (!$op->Eof() and !$op->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
            if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto')) {
                $op->MoveNext();
                continue;
            }else {
                $con_mem.= $op->Value('ca_concepto')."\n";
                $ofe_mem.= $op->Value('ca_idmoneda')." ".$op->Value('ca_oferta')."\n";
                $rec_mem.= (strlen($op->Value('ca_recargos'))!=0)?$op->Value('ca_recargos'):"";
                $det_mem.= $op->Value('ca_observaciones')."\n";
            }
            $op->MoveNext();
            if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto') or strlen($op->Value('ca_recargos')) != 0 or $op->Eof()) {
                $pdf->Row(array($con_mem, $ofe_mem, $rec_mem, $det_mem));
                $con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';
                }
            }
        if (strlen($pr->Value('ca_observaciones'))<>0){
           $pdf->SetWidths(array(30,140));
           $pdf->SetAligns(array("L","L"));
           $pdf->Row(array('Observaciones:',$pr->Value('ca_observaciones')));
        }

        $det_mem = strlen($pr->Value('ca_frecuencia'))<>0?"Frecuencia: ".nl2br($pr->Value('ca_frecuencia'))."\n":'';
        $det_mem.= strlen($pr->Value('ca_tiempotransito'))<>0?"T.Transito: ".nl2br($pr->Value('ca_tiempotransito'))."\n":'';
        $age_mem = $pr->Value('ca_datosag');

		$key = -1;
		reset($arr_loc);
		while (list ($clave, $val) = each ($arr_loc)) {
			if ($val['detalle'] == $pr->Value('ca_locrecargos')){
				$key = $clave;
				break;
				}
			}
		if ($key == -1){
			array_push($arr_loc, array('detalle' => trim($pr->Value('ca_locrecargos')), 'imprimir' => true, 'posicion' => chr(65+count($arr_loc))));
			$key = count($arr_loc) - 1;
			}
	
        $pdf->Ln(2);
        $pdf->SetWidths(array(30,95,45));
        $pdf->SetAligns(array("L","L","L"));
		
		if ($arr_loc[$key]['imprimir'] == true){
			$loc_mem = $arr_loc[$key]['detalle'];
			$lit_mem = "(".$arr_loc[$key]['posicion'].")";
			$arr_loc[$key]['imprimir'] = false;
		}else{
			$loc_mem = "«Ver literal ".$arr_loc[$key]['posicion'] ."»";
			$lit_mem = "";
		}
        $pdf->Row(array('Recargos Locales: '.$lit_mem,$loc_mem,$det_mem));

        $pr->MoveNext();
        if ($pr->Value('ca_datosag')!=$age_mem or $pr->Eof()){
           if (!$ag->Open("select * from vi_agentesxcont where ca_idcontacto in ("."'".implode('\',\'',explode("|",$age_mem))."'".")")) {
               echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";
               echo "<script>document.location.href = 'cotizaciones.php';</script>";
               exit;
              }
           if (strlen($age_mem)!=0 and !$ag->IsEmpty()) {
               $pdf->Ln(4);
               $pdf->SetFont('Arial','',9);
               $pdf->MultiCell(0, 4, 'A continuación relacionamos los datos de nuestro agente encargado de coordinar los despachos:',0,1);
               $pdf->Ln(2);
               $nom_age = '';
               while (!$ag->Eof() and !$ag->IsEmpty()) {                          // Lee la totalidad de los registros obtenidos en la instrucción Select
                   if ($ag->Value('ca_nombre_ag') != $nom_age) {
                       $pdf->SetFont('Arial','B',8);
                       $pdf->MultiCell(0, 4,$ag->Value('ca_nombre_ag')." - ".strtoupper($ag->Value('ca_nomtrafico')),0,1);
                       $pdf->SetFont('Arial','',8);
                       $pdf->MultiCell(0, 4,"Página Web :".$ag->Value('ca_website'),0,1);
                       $pdf->MultiCell(0, 4,"Correo Electrónico :".$ag->Value('ca_email_ag'),0,1);
                       $pdf->Ln(2);
                       $pdf->MultiCell(0, 4,"Contactos :",0,1);
                       $nom_age = $ag->Value('ca_nombre_ag');
                       }
                   $pdf->SetFont('Arial','B',8);
                   $pdf->MultiCell(0, 4,$ag->Value('ca_nombre_co'),0,1);
                   $pdf->SetFont('Arial','',8);
                   $pdf->MultiCell(0, 4,$ag->Value('ca_direccion_co')." - ".$ag->Value('ca_ciudad_co'),0,1);
                   $pdf->MultiCell(0, 4,"Teléfonos (".substr(strtoupper($ag->Value('ca_idtrafico')),3,3)." - ".substr(strtoupper($ag->Value('ca_idciudad_co')),4,4).") : ".$ag->Value('ca_telefonos_co')." - Fax : ".$ag->Value('ca_fax_co'),0,1);
                   $pdf->MultiCell(0, 4,"Correo Electrónico :".$ag->Value('ca_email_co'),0,1);
                   $pdf->Ln(2);
                   $ag->MoveNext();
                   }
               }
           }
        }

// 	print_r($arr_loc);

    $pdf->SetFont('Arial','',10);
    $pdf->Ln(4);            
    $pdf->MultiCell(0, 4, $rs->Value('ca_despedida'),0,1);
    $pdf->Ln(6);
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
       $pdf->SetFont('Arial','B',10);
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
       $pdf->SetFont('Arial','B',10);
       $pdf->MultiCell(0, 4, "NOTAS IMPORTANTES QUE DEBEN TENER EN CUENTA"."\n"."EN SUS EXPORTACIONES", 0,'C',0);
       $pdf->Ln(1);
       $pdf->SetFont('Arial','',10);
       $pdf->MultiCell(0, 4, $contents, 0,'J',0);
    }

    $pdf->Output();
}
?>