<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       COMISION.PHP                                                \\
// Creado:        2005-01-01                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2005-01-14                                                  \\
//                                                                            \\
// Descripción:   Módulo para la generación de archivos en formato PDF con el \\
//                comprobante de liquidación de comisiones.                   \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 24;

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require('include/fpdf.php');                                               // Incorpora la librería de funciones, para generara Archivos en formato PDF
require('include/cpdf.php');                                               // Incorpora la plantilla con formato de Coltrans

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

session_cache_limiter('private_expire');
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$modulo = "00100000";                                                          // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
$rf =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

if (true){
    if (!$rs->Open("select * from vi_inoingresos_sea where ca_comprobante = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'comisiones.php';</script>";
        exit;
       }

    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$us->Open("select * from vi_usuarios where ca_login = '".$rs->Value('ca_login')."'")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
       }

    $pdf=new PDF($orientation='L');
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->SetTopMargin(8);
    $pdf->SetLeftMargin(18);
    $pdf->SetRightMargin(12);
    $pdf->SetAutoPageBreak(true, 28);
    $pdf->AddPage();
	$pdf->SetHeight(4);
    $pdf->SetFont('Arial','',7);
    $pdf->Ln(8);
    list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date("Y-m-d"),"%d-%d-%d %d:%d:%d");

    $pdf->SetWidths(array(257)); // 169
    $pdf->SetAligns(array("C"));
    $pdf->Row(array('Comprobante de Pago de Comisiones por Vendedor'."\n".$us->Value('ca_nombre')));
    $pdf->Row(array('Número :'.$id.' de Fecha :'.$rs->Value('ca_fchliquidacion')));
    $pdf->Ln(1);
    $pdf->SetWidths(array(22,45,20,29,11,15,18,18,15,10,18,18,18)); // 169
    $pdf->SetAligns(array("C","C","C","C","C","C","C","C","C","C","C","C","C"));
    $pdf->Row(array('Referencia','Cliente','Hbl','Termino Neg.','CBM','Factura','Fch.Factura','Valor','Rec.Caja','%','Comisión','C.Sobreventa','Fch.Liquidac'));

    $pdf->SetAligns(array("L","L","L","L","R","L","C","R","L","C","R","R","C"));
    $sum_vlr = 0;
    $sum_sbr = 0;
    $elaboro = null;
    while (!$rs->Eof()) {
        $ref_mem = $rs->Value('ca_referencia');
        $com_mem = $rs->Value('ca_compania');
        $hbl_mem = $rs->Value('ca_hbls');
        $utl_cbm = round(($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r'),0);
        $sum_vlr+= $rs->Value('ca_vlrcomision_cob');
        $sum_sbr+= $rs->Value('ca_sbrcomision_cob');
        $pdf->Row(array($ref_mem,$com_mem,$hbl_mem,$rs->Value('ca_incoterms'),number_format($rs->Value('ca_volumen'),2),$rs->Value('ca_factura'),$rs->Value('ca_fchfactura'),number_format($rs->Value('ca_valor'),0),$rs->Value('ca_reccaja'),$rs->Value('ca_porcentaje'),number_format($rs->Value('ca_vlrcomision_cob'),0),number_format($rs->Value('ca_sbrcomision_cob'),0),$rs->Value('ca_fchliquidacion')));
        do {
            $rs->MoveNext();
            if (($ref_mem != $rs->Value('ca_referencia') or $com_mem != $rs->Value('ca_compania') or $hbl_mem != $rs->Value('ca_hbls') or $rs->Eof())) {
                break;
            }
            $pdf->Row(array('','','','','',$rs->Value('ca_factura'),$rs->Value('ca_fchfactura'),number_format($rs->Value('ca_valor'),0),$rs->Value('ca_reccaja'),$rs->Value('ca_porcentaje'),'','',''));
        } while(true);
        $pdf->Ln(1);
        $elaboro = "Elaboró: ".$rs->Value('ca_usucreado_cmp')." ".$rs->Value('ca_fchcreado_cmp');
    }
    $pdf->SetFont('Arial','B',8);
    $pdf->SetWidths(array(203,18,18,18)); // 169
    $pdf->SetAligns(array("R","R","R","C"));
    $pdf->Row(array('Sub-Totales :',number_format($sum_vlr,0),number_format($sum_sbr,0),''));

    $pdf->SetFont('Arial','B',9);
    $pdf->SetWidths(array(203,36,18)); // 169
    $pdf->SetAligns(array("R","R"));
    $pdf->Row(array('Gran Total :',number_format($sum_vlr + $sum_sbr,0),''));

    while (!$us->Eof() and !$us->IsEmpty()) {
        $pdf->Ln(14);
        $pdf->SetFont('Arial','B',9);
        $pdf->MultiCell(0, 4, strtoupper($us->Value('ca_nombre')),0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->MultiCell(0, 4, strtoupper($us->Value('ca_cargo')),0,1);
        $pdf->MultiCell(0, 4, COLTRANS,0,1);
        $pdf->MultiCell(0, 4, $us->Value('ca_direccion'),0,1);
		$pdf->MultiCell(0, 4, "Tel.:".$us->Value('ca_telefono')." Ext.: ".$us->Value('ca_extension'),0,1);		
		$pdf->MultiCell(0, 4, $us->Value('ca_sucursal')." - Colombia",0,1);
		$pdf->MultiCell(0, 4, $us->Value('ca_email'),0,1);
		$pdf->MultiCell(0, 4, "www.coltrans.com.co",0,1);
        $us->MoveNext();
       }
    $pdf->Ln(5);
    $pdf->MultiCell(0, 4, $elaboro, 0, 1);
    $pdf->Output();
    $pdf->Close();
}
?>