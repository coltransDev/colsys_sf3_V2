<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
function num2letras($num, $fem = true, $dec = true) {
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande");
   $matuni[2]  = "dos";
   $matuni[3]  = "tres";
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";
   $matuni[6]  = "seis";
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";
   $matuni[9]  = "nueve";
   $matuni[10] = "diez";
   $matuni[11] = "once";
   $matuni[12] = "doce";
   $matuni[13] = "trece";
   $matuni[14] = "catorce";
   $matuni[15] = "quince";
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";
   $matuni[18] = "dieciocho";
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte";
   $matunisub[2] = "dos";
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";
   $matunisub[5] = "quin";
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";
   $matunisub[8] = "ocho";
   $matunisub[9] = "nove";

   $matdec[2] = "veint";
   $matdec[3] = "treinta";
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";
   $matdec[6] = "sesenta";
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";
   $matdec[9] = "noventa";
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';
   $matsub[7]  = 'mill';
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';
   $matsub[13] = 'bill';
   $matsub[15] = 'mill';
   $matmil[4]  = 'millones';
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';

   $num = trim((string)@$num);
   if ($num[0] == '-') {
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros) {
      $fin = ' coma';
      for ($n = 0; $n < strlen($fra); $n++) {
         if (($s = $fra[$n]) == '0')
            $fin .= ' cero';
         elseif ($s == '1')
            $fin .= $fem ? ' una' : ' un';
         else
            $fin .= ' ' . $matuni[$s];
      }
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   while ( ($num = substr($ent, -3)) != '   ') {
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1) {
         $t = ' ciento' . $t;
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
      if ($sub == 1) {
      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . 'ón';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   return ucfirst($tex);
}


$comprobante = $sf_data->getRaw("comprobante");
$transacciones = $sf_data->getRaw("transacciones");
$tipo = $comprobante->getInoTipoComprobante();
$sucursal = $tipo->getSucursal();
$ids = $sucursal->getEmpresa()->getIds();
$inoCliente = $comprobante->getInoHouse();
$inoMaestra = $inoCliente->getInoMaster();


//$cuentaCierre = Doctrine::getTable("InoCuenta")->find($tipo->getCaIdctaCierre());
//$cuentaIva = Doctrine::getTable("InoCuenta")->find($tipo->getCaIdctaIva());


$pdf = new PDF (  );
$pdf->Open ();
$pdf->setColtransHeader ( false );
$pdf->setColtransFooter ( false );
$pdf->setIdempresa(8);
$pdf->AliasNbPages();
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);


$x=$pdf->GetX();
$y=$pdf->GetY();

//echo $comprobante->getCaIdcomprobante();
//echo $comprobante->getCaEstado();
//exit;
if( $comprobante->getCaEstado()==0){

    $pdf->SetTextColor(224,224,224);
    $pdf->SetFont("Arial",'B',85);
    $pdf->Rotate(45,250,90);
    $pdf->Write(15,'BORRADOR');
    $pdf->Rotate(0);
    $pdf->SetTextColor(0,0,0);
}
else if( $comprobante->getCaEstado()==8){
    $pdf->SetTextColor(224,224,224);
    $pdf->SetFont("Arial",'B',85);
    $pdf->Rotate(45,250,90);
    $pdf->Write(15,'ANULADO');
    $pdf->Rotate(0);
    $pdf->SetTextColor(0,0,0);
}


$font = 'Courier';

$pdf->SetFont($font,'',6);


$pdf->SetX( $x );
$pdf->SetY( $y );



$marginHeader = 120;
$space = 2;


$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, $sucursal->getEmpresa()->getCaNombre(),0,1, "L");
$y+=$space;


$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "Nit. ".Utils::formatNumber($ids->getCaIdalterno(),0,"",".")."-".$ids->getCaDv() ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, $sucursal->getCaDireccion(),0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "PBX: ".$sucursal->getCaTelefono(),0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "FAX: ".$sucursal->getCaFax(),0,1, "L");


$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "E-mail: ".$sucursal->getCaEmail(),0,1, "L"); //.$idsSucursal->getCaEmail()

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, $sucursal->getCaNombre().", ".$sucursal->getEmpresa()->getTrafico()->getCaNombre() ,0,1, "L");


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
$pdf->Cell(0, 4, strtoupper($tipo->getCaTitulo())." NO ". $comprobante->getCaConsecutivo()/*str_pad($comprobante->getCaConsecutivo(), 14, "0", STR_PAD_LEFT)*/,0,1, "L");


$pdf->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.$sucursal->getEmpresa()->getCaLogo(), 18, 12, 70, 15, 'JPG');

$y+=6;


//Encabezado
$pdf->Rect($x,$y,175,20);
$pdf->line($x+100,$y+10,$x+175,$y+10);
$pdf->line($x+100,$y,$x+100,$y+20);
$pdf->line($x+130,$y,$x+130,$y+20);
$pdf->line($x+145,$y,$x+145,$y+10);


$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, "FECHA FACTURA"  ,0,1, "L");

//$pdf->SetXY($x+133,$y);
//$pdf->Cell(0, 4, "PLAZO"  ,0,1, "L");

//$pdf->SetXY($x+147,$y);
//$pdf->Cell(0, 4, "FECHA DE VENCIMIENTO"  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "SEÑORES: ". $comprobante->getIds()->getCaNombre() ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "ATENCION: "  ,0,1, "L");

//[TODO] REEMPLAZAR POR LOS VALORES
$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, Utils::parseDate($comprobante->getCaFchcomprobante(), "Y/m/d")  ,0,1, "L");

//$pdf->SetXY($x+135,$y);
//$plazo=($comprobante->getCaPlazo()>0)?$comprobante->getCaPlazo(): ($comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()>0)?$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito():0;

//$pdf->Cell(0, 4, $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()  ,0,1, "L");
//$pdf->SetXY($x+152,$y);
//$pdf->Cell(0, 4, Utils::agregarDias($comprobante->getCaFchcomprobante(), $plazo,  "Y/m/d")   ,0,1, "L");

$y+=6;
$pdf->SetXY($x+10,$y);
$suc_cli=$comprobante->getIds()->getSucursalPrincipal();
if(!$suc_cli)
{
    $suc_cli=$comprobante->getIds()->getIdsCliente();
    $direccion=$suc_cli->getDireccion1();
}
else
{
    $suc_cli=$comprobante->getIds()->getSucursalPrincipal();
    $direccion=$suc_cli->getCaDireccion();
}

$pdf->Cell(0, 4, "DIRECCIÓN: ". utf8_decode($direccion)  ,0,1, "L");

$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, "TASA DE CAMBIO ". $comprobante->getCaTcambio() ,0,1, "L");
$pdf->SetXY($x+148,$y);
$pdf->Cell(0, 4, "No. REF. "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "CIUDAD: ".$suc_cli->getCiudad()->getCaCiudad()  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "TELEFONO: ".$suc_cli->getCaTelefonos()  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "NIT: ".$comprobante->getCaId()."-".$comprobante->getIds()->getCaDv()  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "VENDEDOR: ".$inoCliente->getCaVendedor()  ,0,1, "L");


$pdf->SetXY($x+110,$y);
$pdf->Cell(0, 4, Utils::formatNumber($comprobante->getCaTcambio(), 2, ".", ",")  ,0,1, "L");
$pdf->SetXY($x+143,$y);
$pdf->Cell(0, 4, $inoMaestra->getCaReferencia()  ,0,1, "L");

$y+=8;

$pdf->Rect($x,$y,175,23);
$y+=$space;

$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "BIENES TRANS. : ". $comprobante->getProperty("bienestrans")  ,0,1, "L");
$pdf->SetXY($x+135,$y);
$pdf->Cell(0, 4, "SERVICIO : ".$inoMaestra->getCaTransporte()  ,0,1, "L"); //$inoMaestra->getCaTransporte()

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "DETALLE  : ". $comprobante->getProperty("detalle")/*$comprobante->getCaObservaciones()*/  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "BL Hijo  : ".$inoCliente->getCaDoctransporte()  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Nave  : "  ,0,1, "L"); //.$inoCliente->getCaIdnave()

$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "Piezas  : ".$inoCliente->getCaNumpiezas()  ,0,1, "L");

$pdf->SetXY($x+90,$y);
$pdf->Cell(0, 4, "Peso  : ".$inoCliente->getCaPeso()  ,0,1, "L");

$pdf->SetXY($x+120,$y);
$pdf->Cell(0, 4, "CMB  : ".$inoCliente->getCaVolumen()  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Trayecto  : ".($inoMaestra->getOrigen()->getCaCiudad()." , ".$inoMaestra->getOrigen()->getTrafico()->getCaNombre()."  -  ".$inoMaestra->getDestino()->getCaCiudad()." - ".$inoMaestra->getDestino()->getTrafico()->getCaNombre())  ,0,1, "L"); //

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, ""/*"Para embarques marítimos, la factura debe ser liquidada a la TRM del día de pago mas $30 siempre y cuando esta nos sea inferior"*/  ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "" /*"a la tasa de emisión de esta factura.  También puede consultar la tasa de cambio para pago de sus facturas, llamando a nuestro"*/  ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "" /*"PBX 4239300 Opción 1."*/  ,0,1, "L");


//Detalles
$y+=10;

$pdf->Rect($x,$y,175,100);

$pdf->line($x,$y+6,$x+175,$y+6);

//tres lineas v
$pdf->line($x+20,$y,$x+20,$y+100);
$pdf->line($x+125,$y,$x+125,$y+100);
$pdf->line($x+150,$y,$x+150,$y+100);

$pdf->line($x,$y+100,$x+175,$y+100);
//$pdf->line($x,$y+110,$x+175,$y+110);

$y+=1;


$pdf->SetXY($x+5,$y);
$pdf->Cell(0, 4, "CUENTA"  ,0,1, "L");
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

//$totales["propios"] = 0;
//$totales["terceros"] = 0;

$k = 5;

$totales=$subtotales=$impuestos=0;
//echo "<pre>";print_r($transacciones);echo "</pre>";
//exit;
//$pdf->Cell(0, 4, "NREG:".count($transacciones) ,0,1, "L");
foreach( $transacciones as $t ){

    if( $lastIngresoPropio!=$t["s_ca_pt"]   ){
        $pdf->SetXY($x+30,$y+$k+$space);
        if( $t["s_ca_pt"]=="P" ){
            $pdf->Cell(0, 4, "INGRESOS  PROPIOS" ,0,1, "L");
        }else if( $t["s_ca_pt"]=="T" ){
            $pdf->Cell(0, 4, "INGRESOS PARA TERCEROS" ,0,1, "L");
        }
        if($subtotales>0)
        {
            $pdf->SetXY($x+107,$y+$k);
            $pdf->Cell(0, 4, "SUBTOTAL...." ,0,1, "L");
            $pdf->SetXY($x,$y+$k);
            $pdf->Cell(172, 4, number_format($totales, 2, ",", ".")  ,0,1, "R");
            $k+=$space;
            $totales=$subtotales;
        }
        $subtotales=0;
        $k+=$space+$space;
    }
    $lastIngresoPropio=$t["s_ca_pt"];
        
    $pdf->SetXY($x+5,$y+$k);
    $pdf->Cell(0, 4,$t["s_ca_cuenta"] ,0,1, "L");
    $pdf->SetXY($x+30,$y+$k);
    
    $pdf->Cell(0, 4, strtoupper($t["s_ca_descripcion"] ),0,1, "L");

    //$pdf->SetXY($x+130,$y+$k);
    //$pdf->Cell(0, 4, $transaccion->getCaCr() ,0,1, "L");

    $pdf->SetXY($x,$y+$k);
    $pdf->Cell(172, 4, number_format(($t["det_ca_db"]), 2, ",", ".")  ,0,1, "R");
    $totales+=$t["det_ca_db"];
    $k+=$space;
    
    $impuestos+=round($t["det_ca_db"]* ($t["s_ca_porciva"]/100));
}

if($subtotales>0)
{
    $pdf->SetXY($x+107,$y+$k);
    $pdf->Cell(0, 4, "SUBTOTAL...." ,0,1, "L");
    $pdf->SetXY($x,$y+$k);
    $pdf->Cell(172, 4, number_format($totales, 2, ",", ".")  ,0,1, "R");
    $k+=$space;
    $totales=$subtotales;
}

$k+=$space;
$pdf->SetXY($x+111,$y+$k);
$pdf->Cell(0, 4, "TOTAL ...." ,0,1, "L");
$pdf->SetXY($x,$y+$k);
$pdf->Cell(172, 4, number_format( $totales , 2, ",", ".")  ,0,1, "R");
$k+=$space;

$pdf->SetXY($x+111,$y+$k);
    $pdf->Cell(0, 4, "I.V.A ...." ,0,1, "L");
    $pdf->SetXY($x,$y+$k);
    $pdf->Cell(172, 4, number_format($impuestos, 2, ",", ".")  ,0,1, "R");    
    $k+=$space;
    $k+=$space;
    

$pdf->SetXY($x+96,$y+$k);
$pdf->Cell(0, 4, "TOTAL A ACREDITAR ...." ,0,1, "L");
$pdf->SetXY($x,$y+$k);
$pdf->Cell(172, 4, number_format($totales+$impuestos , 2, ",", ".")  ,0,1, "R");
$k+=$space;



$y+=100+$space;

$pdf->Rect($x,$y,175,10);
$pdf->SetXY($x+5,$y);

$pdf->MultiCell(0, 4, "SON:\n     ". strtoupper(num2letras($totales+$impuestos , false )) . " M/CTE" ,0,1, "C");

$y+=10;
$pdf->Rect($x,$y,175,10);
$pdf->SetXY($x+5,$y);
$pdf->MultiCell(0, 4, "ANEXOS:\n".$comprobante->getProperty("anexos") ,0,1, "C");

$y+=10;
$pdf->Rect($x,$y,175,15);
$pdf->SetXY($x+10,$y);
$pdf->MultiCell(0, 4, $tipo->getCaMensaje() ,0,1, "C");


$y+=15;
/*$pdf->SetXY($x+30,$y);
$pdf->Cell(0, 3, "Numeración según Resolución DIAN ".$tipo->getCaNoautorizacion()."  ".Utils::parseDate($tipo->getCaFchautorizacion(),"Y/m/d")." ".$tipo->getCaInicialAut()." AL ".$tipo->getCaFinalAut()." FACTURA POR COMPUTADOR."  ,0,1, "L");
*/
$datostmp = ParametroTable::retrieveByCaso("CU234",$sucursal->getCaIdempresa());
foreach ($datostmp as $d) {
    $datosMensajes[]=$d->getCaValor2();
}

//$pdf->SetRightMargin(55);
$y+=4;
$pdf->Rect($x,$y,140,6);
$pdf->SetXY($x+5,$y);
$pdf->MultiCell(0, 2, (isset($datosMensajes[0])?$datosMensajes[0]:"") ,0,1, "J");

if(isset($datosMensajes[3]))
{
    $y+=7;
/*
    $pdf->Rect($x,$y,140,6);
    $pdf->SetXY($x+5,$y);
    $pdf->MultiCell(0, 2, $datosMensajes[3] ,0,1, "J");
*/
}
$y+=7;
/*
$pdf->Rect($x,$y,140,21);
$pdf->SetXY($x+5,$y);
$pdf->MultiCell(0, 3, (isset($datosMensajes[1])?$datosMensajes[1]:"") ,0,1, "J");
*/

//$y+=22;
/*$pdf->Rect($x,$y,140,12);
$pdf->SetXY($x+5,$y);
$pdf->MultiCell(0, 2, (isset($datosMensajes[2])?$datosMensajes[2]:"") ,0,1, "J");
*/
//$pdf->SetRightMargin(12);

/*$y-=20;
$pdf->SetXY($x+140,$y);
$pdf->Cell(0, 4, "___________________________"  ,0,1, "L");
$y+=3;
$pdf->SetXY($x+148,$y);
$pdf->Cell(0, 4, $sucursal->getEmpresa()->getCaNombre()  ,0,1, "L");
*/

$y+=10;
$pdf->SetXY($x+20,$y);
$pdf->Cell(0, 4, "___________________________"  ,0,1, "L");

$pdf->SetXY($x+130,$y);
$pdf->Cell(0, 4, "___________________________"  ,0,1, "L");

$y+=3;

$pdf->SetXY($x+25,$y);
$pdf->Cell(0, 4, "ELABORO "  ,0,1, "L");


$pdf->SetXY($x+138,$y);
$pdf->Cell(0, 4, "FIRMA RECIBIDO "  ,0,1, "L");

$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}

?>