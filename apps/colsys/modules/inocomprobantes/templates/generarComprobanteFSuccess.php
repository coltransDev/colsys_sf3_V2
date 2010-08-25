<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$comprobante = $sf_data->getRaw("comprobante");
$tipo = $comprobante->getInoTipoComprobante();
$idsSucursal = $tipo->getIdsSucursal();
$ids = $idsSucursal->getIds();
$inoHouse = $comprobante->getInoHouse();
$inoMaestra = $inoHouse->getInoMaster();

$cuentaCierre = Doctrine::getTable("InoCuenta")->find($tipo->getCaIdctaCierre());
$cuentaIva = Doctrine::getTable("InoCuenta")->find($tipo->getCaIdctaIva());


$pdf = new PDF (  );
$pdf->Open ();
$pdf->setColtransHeader ( false );
$pdf->setColtransFooter ( false );
$pdf->AliasNbPages();
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);


$x=$pdf->GetX();
$y=$pdf->GetY();


if( $comprobante->getcaEstado()==0){
    $pdf->SetX( 80 );
    $pdf->SetY( 50 );

    $pdf->SetTextColor(224,224,224);
    $pdf->SetFont("Arial",'B',62);
    $pdf->Write(5,'B O R R A D O R');
    $pdf->SetTextColor(0,0,0);
}

$font = 'Courier';

$pdf->SetFont($font,'',6);





$pdf->SetX( $x );
$pdf->SetY( $y );



$marginHeader = 120;
$space = 2;

$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, $idsSucursal->getCaDireccion(),0,1, "L");
$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "PBX: ".$idsSucursal->getCaTelefonos(),0,1, "L");
$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "FAX: ".$idsSucursal->getCaFax(),0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "Apartado Aéreo 151596: ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "E-mail: ",0,1, "L"); //.$idsSucursal->getCaEmail()

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, $idsSucursal->getCiudad()->getCaCiudad().", ".$idsSucursal->getCiudad()->getTrafico()->getCaNombre() ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "Nit. ".Utils::formatNumber($ids->getCaIdalterno(),0,"",".")."-".$ids->getCaDv() ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "No somos grandes contribuyentes ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "Agentes de retención de IVA con ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "transacciones con el régimen simplificado.",0,1, "L");


$y+=6;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, strtoupper($tipo->getCaTitulo())." NO ". str_pad($comprobante->getCaConsecutivo(), 14, "0", STR_PAD_LEFT),0,1, "L");


$pdf->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'ColtransSA.jpg', 18, 12, 63, 10, 'JPG');

$y+=6;


//Encabezado
$pdf->Rect($x,$y,175,20);
$pdf->line($x+100,$y+10,$x+175,$y+10);
$pdf->line($x+100,$y,$x+100,$y+20);
$pdf->line($x+130,$y,$x+130,$y+20);
$pdf->line($x+145,$y,$x+145,$y+10);


$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, "FECHA FACTURA"  ,0,1, "L");

$pdf->SetXY($x+133,$y);
$pdf->Cell(0, 4, "PLAZO"  ,0,1, "L");

$pdf->SetXY($x+147,$y);
$pdf->Cell(0, 4, "FECHA DE VENCIMIENTO"  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "SEÑORES: ". $comprobante->getIds()->getCaNombre() ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "ATENCION: "  ,0,1, "L");

//[TODO] REEMPLAZAR POR LOS VALORES
$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, Utils::parseDate($comprobante->getCaFchcomprobante(), "Y/m/d")  ,0,1, "L");
$pdf->SetXY($x+135,$y);
$pdf->Cell(0, 4, $comprobante->getCaPlazo()  ,0,1, "L");
$pdf->SetXY($x+152,$y);
$pdf->Cell(0, 4, Utils::agregarDias($comprobante->getCaFchcomprobante(), $comprobante->getCaPlazo(),  "Y/m/d")   ,0,1, "L");

$y+=6;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "DIRECCIÓN: "  ,0,1, "L");



$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, "TASA DE CAMBIO "  ,0,1, "L");
$pdf->SetXY($x+148,$y);
$pdf->Cell(0, 4, "No. REF."  ,0,1, "L");


$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "CIUDAD: "  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "TELEFONO: "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "NIT: "  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "VENDEDOR: "  ,0,1, "L");


$pdf->SetXY($x+110,$y);
$pdf->Cell(0, 4, Utils::formatNumber($comprobante->getCaTasacambio(), 2, ".", ",")  ,0,1, "L");
$pdf->SetXY($x+143,$y);
$pdf->Cell(0, 4, $inoMaestra->getCaReferencia()  ,0,1, "L");

$y+=8;

$pdf->Rect($x,$y,175,23);
$y+=$space;

$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "BIENES TRANS. : "  ,0,1, "L");
$pdf->SetXY($x+135,$y);
$pdf->Cell(0, 4, "SERVICIO : "  ,0,1, "L"); //$inoMaestra->getCaTransporte()

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "DETALLE  : ".$comprobante->getCaObservaciones()  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "BL Hijo  : ".$inoHouse->getCaDoctransporte()  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Nave  : "  ,0,1, "L"); //.$inoHouse->getCaIdnave()

$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "Piezas  : ".$inoHouse->getCaNumpiezas()  ,0,1, "L");

$pdf->SetXY($x+90,$y);
$pdf->Cell(0, 4, "Peso  : ".$inoHouse->getCaPeso()  ,0,1, "L");

$pdf->SetXY($x+120,$y);
$pdf->Cell(0, 4, "CMB  : ".$inoHouse->getCaVolumen()  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Trayecto  : "  ,0,1, "L"); //$inoMaestra->getOrigen()->getCaCiudad()." - ".$inoMaestra->getOrigen()->getTrafico()->getCaNombre()." ".$inoMaestra->getDestino()->getCaCiudad()." - ".$inoMaestra->getDestino()->getTrafico()->getCaNombre()

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Para embarques marítimos, la factura debe ser liquidada a la TRM del día de pago mas $30 siempre y cuando esta nos sea inferior"  ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "a la tasa de emisión de esta factura.  También puede consultar la tasa de cambio para pago de sus facturas, llamando a nuestro"  ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "PBX 4239300 Opción 1."  ,0,1, "L");


//Detalles
$y+=10;

$pdf->Rect($x,$y,175,125);

$pdf->line($x,$y+6,$x+175,$y+6);

//tres lineas v
$pdf->line($x+20,$y,$x+20,$y+100);
$pdf->line($x+125,$y,$x+125,$y+100);
$pdf->line($x+150,$y,$x+150,$y+100);

$pdf->line($x,$y+100,$x+175,$y+100);
$pdf->line($x,$y+110,$x+175,$y+110);

$y+=1;


$pdf->SetXY($x+5,$y);
$pdf->Cell(0, 4, "CÓDIGO"  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "D E S C R I P C I Ó N"  ,0,1, "L");
$pdf->SetXY($x+130,$y);
$pdf->Cell(0, 4, "VALOR DOLAR"  ,0,1, "L");
$pdf->SetXY($x+155,$y);
$pdf->Cell(0, 4, "VALOR PESOS"  ,0,1, "L");

//Imprime Transacciones

$lastIngresoPropio = null;
$impuestos = array();
$totales = array();

$totales["propios"] = 0;
$totales["terceros"] = 0;

$k = 5;



foreach( $transacciones as $transaccion ){
    $centro = $transaccion->getInoCentroCosto();
    $concepto = $transaccion->getInoConcepto();
    $parametro = $transaccion->getInoParametroFacturacion();
    if( $lastIngresoPropio===null || $lastIngresoPropio!=$parametro->getCaIngresoPropio() ){
        $lastIngresoPropio=$parametro->getCaIngresoPropio();
        $pdf->SetXY($x+30,$y+$k+$space);
        if( $lastIngresoPropio ){
            $propios = "propios";
            $pdf->Cell(0, 4, "INGRESOS  PROPIOS" ,0,1, "L");
        }else{
            $propios = "terceros";
            $pdf->Cell(0, 4, "INGRESOS PARA TERCEROS" ,0,1, "L");
        }

        $k+=$space+$space;
    }

    
    $codigo = str_pad($centro->getCaCentro(), 2, "0", STR_PAD_LEFT).str_pad($centro->getCaSubcentro(), 2, "0", STR_PAD_LEFT).str_pad($concepto->getCaIdconcepto(), 4, "0", STR_PAD_LEFT);
    
    $pdf->SetXY($x+5,$y+$k);
    $pdf->Cell(0, 4,$codigo ,0,1, "L");
    $pdf->SetXY($x+30,$y+$k);
    $pdf->Cell(0, 4, strtoupper($concepto->getCaConcepto()),0,1, "L");

    //$pdf->SetXY($x+130,$y+$k);
    //$pdf->Cell(0, 4, $transaccion->getCaCr() ,0,1, "L");

    $pdf->SetXY($x,$y+$k);
    $pdf->Cell(172, 4, number_format($transaccion->getCaValor(), 2, ",", ".")  ,0,1, "R");
    $k+=$space;

    if( !isset($totales[$propios]) ){
        $totales[$propios] = 0;
    }
    $totales[$propios] += $transaccion->getCaValor();
    
    $imp = $transaccion->getImpuestos();

    foreach( $imp as $key=>$val ){
        if(!isset( $impuestos[$key] )){
            $impuestos[$key]["db"] = 0;
            $impuestos[$key]["cr"] = 0;
        }
        $impuestos[$key]["db"]+=$imp[$key]["db"];
        $impuestos[$key]["cr"]+=$imp[$key]["cr"];
    }

    /*if( $key=="propio" || $key=="tercero" ){
        

        foreach( $val as $cuenta=>$transaccion ){
            //print_r( $transaccion );
            //echo "<br ><br >";
            
            $pdf->SetXY($x+5,$y+$k);
            $pdf->Cell(0, 4, $cuenta ,0,1, "L");
            $pdf->SetXY($x+30,$y+$k);
            $pdf->Cell(0, 4, strtoupper($transaccion["desc"]),0,1, "L"); 

            //$pdf->SetXY($x+130,$y+$k);
            //$pdf->Cell(0, 4, $transaccion->getCaCr() ,0,1, "L");

            $pdf->SetXY($x,$y+$k);
            $pdf->Cell(172, 4, number_format($transaccion["cr"], 2, ",", ".")  ,0,1, "R");
            $k+=$space;

            if( !isset($totales[$key]) ){
                $totales[$key] = 0;
            }
            $totales[$key] += $transaccion["cr"];
            
        }
        
        $pdf->SetXY($x+107,$y+$k);
        $pdf->Cell(0, 4, "SUBTOTAL...." ,0,1, "L");
        $pdf->SetXY($x,$y+$k);
        $pdf->Cell(172, 4, number_format($totales[$key], 2, ",", ".")  ,0,1, "R");
        $k+=$space;
    }    */
}

$total = array_sum($totales);
$k+=$space;
$pdf->SetXY($x+111,$y+$k);
$pdf->Cell(0, 4, "TOTAL...." ,0,1, "L");
$pdf->SetXY($x,$y+$k);
$pdf->Cell(172, 4, number_format( $total , 2, ",", ".")  ,0,1, "R");
$k+=$space;

foreach( $impuestos as $key=>$impuesto ){

    $pdf->SetXY($x+113,$y+$k);
    $pdf->Cell(0, 4, strtoupper($key)."...." ,0,1, "L");
    $pdf->SetXY($x,$y+$k);
    $pdf->Cell(172, 4, number_format($impuesto["cr"]-$impuesto["db"], 2, ",", ".")  ,0,1, "R");
    $total += $impuesto["cr"]-$impuesto["db"];
    $k+=$space;
    $k+=$space;
}

$pdf->SetXY($x+101,$y+$k);
$pdf->Cell(0, 4, "TOTAL A PAGAR...." ,0,1, "L");
$pdf->SetXY($x,$y+$k);
$pdf->Cell(172, 4, number_format($total , 2, ",", ".")  ,0,1, "R");
$k+=$space;


   





$y+=125+$space;

$pdf->Rect($x,$y,175,15);

$pdf->SetXY($x+10,$y);
$pdf->MultiCell(0, 4, $tipo->getCaMensaje() ,0,1, "C");


$y+=15;
$pdf->SetXY($x+30,$y);
$pdf->Cell(0, 4, "Numeración según Resolución DIAN ".$tipo->getCaNoautorizacion()."  ".Utils::parseDate($tipo->getCaFchautorizacion(),"Y/m/d")." ".$tipo->getCaInicialAut()." AL ".$tipo->getCaFinalAut()." FACTURA POR COMPUTADOR."  ,0,1, "L");


$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}


?>





