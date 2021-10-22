<?php

$pdf = new PDF('L', 'mm', 'Letter');
$pdf->Open();
$pdf->AliasNbPages();
$pdf->setTopMargin(0);
$pdf->setLeftMargin(5);
$pdf->setRightMargin(5);
$pdf->setColtransHeader(true);

$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();
$pdf->SetHeight(4);
$pdf->SetFont('Arial', '', 9);
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date("Y-m-d H:i:s"), "%d-%d-%d %d:%d:%d");
$widths = array(24, 26, 48, 22, 13, 36, 18, 18, 20, 20, 20);
$aligns = array("L", "L", "L", "C", "C", "L", "R", "R", "C", "C", "C");

$pdf->SetWidths(array(265));
$pdf->SetAligns(array("C"));
$pdf->SetStyles(array("B"));
$pdf->SetFills(array(1));
$pdf->Row(array('Comprobante de Pago de Comisiones por Vendedor' . "\n" . $vendedor));
$pdf->SetStyles(array(""));
$pdf->SetFills(array(0));
$pdf->Row(array('Número :' . $comprobante->getCaConsecutivo() . ' de Fecha :' . $comprobante->getCaFchliquidado()));
$pdf->Ln(2);
$pdf->SetWidths($widths);
$pdf->SetFont('Arial', '', 7);
$pdf->SetAligns(array("C", "C", "C", "C", "C", "C", "C", "C", "C", "C", "C"));
$pdf->Row(array('Referencia', 'Doc.Transporte', 'Cliente', 'Reporte/Negocio', 'Incoterms', 'Concepto', 'Utilidad', 'Comisión', 'Comp.Cruce', 'Usu.Causación', 'Fch.Causación'));

$page = 1;
$marg = 0;
$font_size = 9;
$sub_tit = null;
$pdf->SetAligns($aligns);
$utl_tot = $com_tot = 0;

foreach ($datos as $dato) {
    if ($sub_tit != $dato['llave']) {
        if ($sub_tit != null) {
            $pdf->SetStyles(array("B", "B", "B", "B"));
            $pdf->SetAligns(array("R", "R", "R", "R"));
            $pdf->SetWidths(array(169, 18, 18, 60));
            $pdf->Row(array('Sub Total ' . $sub_tit, number_format($utl_sub, 0), number_format($com_sub, 0), null));
            $pdf->SetWidths($widths);
            $pdf->SetAligns($aligns);
            $pdf->Ln(3);
            $utl_tot += $utl_sub;
            $com_tot += $com_sub;
        }
        $pdf->SetWidths(array(265));
        $pdf->SetStyles(array("B"));
        $pdf->SetFills(array(1));
        $pdf->Row(array($dato['llave']));
        $pdf->SetStyles(array(""));
        $pdf->SetFills(array(0));
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetWidths($widths);
        $sub_tit = $dato['llave'];
        $utl_sub = $com_sub = 0;
    }
    $pdf->Row(array($dato['referencia'], $dato['doctransporte'], $dato['cliente'], $dato['reporte'], $dato['incoterms'], $dato['concepto'], number_format($dato['utilidad'], 0), number_format($dato['comision'], 0), $dato['crucescomp'], $dato['usucausado'], $dato['fchcausado']));
    $utl_sub += $dato['utilidad'];
    $com_sub += $dato['comision'];
}
$pdf->SetStyles(array("B", "B", "B", "B"));
$pdf->SetAligns(array("R", "R", "R", "R"));
$pdf->SetWidths(array(169, 18, 18, 60));
$pdf->Row(array('Sub Total ' . $sub_tit, number_format($utl_sub, 0), number_format($com_sub, 0), null));
$utl_tot += $utl_sub;
$com_tot += $com_sub;
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 8);
$pdf->Row(array('GRAN TOTAL', number_format($utl_tot, 0), number_format($com_tot, 0), null));

$pdf->Ln(1);
$pdf->MultiCell(0, 4, 'Impreso por : '.$usuario->getUserId().' el día: '.$dia.' de '.Utils::mesLargo($mes).' de '.$anno.' '.$tiempo.':'.$minuto.':'.$segundo, 0, 1);

if ($liquidado->getCaDepartamento() == 'Auditoría') {
    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont($font, 'B', 68);
    $pdf->Write(22, '         A J U S T E             ');
    $pdf->Write(22, 'N O   R E P O R T A R');
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 8);
}

$pdf->Ln(10);
$pdf->MultiCell(0, 4, $vendedor->getFirma(), 0, 1);

$filename = 'Comprobante_Nro_' . $comprobante->getCaConsecutivo() . '.pdf';
$pdf->Output($filename, "I");
if ($filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>