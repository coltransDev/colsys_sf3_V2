<?php



/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
function num2letras($num, $fem = true, $dec = true) {

   $num=(int)$num;
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
$pdf->SetWidths(1);
//$pdf->SetRightMargin(12);
//function SetLeftMargin($margin)SetWidths
//$pdf->SetAutoPageBreak(true, 27);


$comprobantes = $sf_data->getRaw("comprobantes");
$transacciones = $sf_data->getRaw("transacciones");


$aumentox=15;


    foreach($comprobantes as $comprobante)
    {
        $tipo = $comprobante->getInoTipoComprobante();
        $sucursal = $tipo->getSucursal();
        $ids = $sucursal->getEmpresa()->getIds();
        
        $inoCliente = $comprobante->getInoHouse();
        $inoMaestra = $inoCliente->getInoMaster();
        $regContributivo=$comprobante->getIds()->getIdsCliente()->getProperty('regimen_contributivo');
        

        $pdf->AddPage();
        $pdf->SetHeight(4);


        $x=$pdf->GetX()-10;
        $y=$pdf->GetY();

//        echo $comprobante->getCaIdcomprobante();
//        echo $comprobante->getCaEstado();
//        exit;
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

        $pdf->SetFont($font,'',6.4);


        $pdf->SetX( $x );
        $pdf->SetY( $y );



        $marginHeader = 130;
        $space = 2.4;


        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, $sucursal->getEmpresa()->getCaNombre(),0,1, "L");
        $y+=$space;


        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, "Nit. ".Utils::formatNumber($ids->getCaIdalterno(),0,"",".")."-".$ids->getCaDv() ,0,1, "L");

        $y+=$space;
        
        
        
        
        $dir= explode("  ", $sucursal->getCaDireccion());

        foreach($dir as $d)
        {
            $y+=$space;
            $pdf->SetXY($x+$marginHeader,$y);
            $pdf->Cell(0, 4, $d,0,1, "L");
            
         //   $txtSucursal["datos"][]=$d;
        }

        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, "PBX: ".$sucursal->getCaTelefono(),0,1, "L");

        


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
        $pdf->Cell(0, 4, strtoupper($tipo->getCaTitulo())." ". $comprobante->getCaConsecutivo()/*str_pad($comprobante->getCaConsecutivo(), 14, "0", STR_PAD_LEFT)*/,0,1, "L");


        $pdf->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.$sucursal->getEmpresa()->getCaLogo(), $x, 12, 70, 15);

        $y+=6;
//
//        
//        //Encabezado
        $pdf->Rect($x,$y,175+$aumentox,20);
        $pdf->line($x+100+$aumentox,$y+10,$x+175+$aumentox,$y+10);
        $pdf->line($x+100+$aumentox,$y,$x+100+$aumentox,$y+20);
        $pdf->line($x+130+$aumentox,$y,$x+130+$aumentox,$y+20);
        $pdf->line($x+145+$aumentox,$y,$x+145+$aumentox,$y+10);

        $pdf->SetXY($x+105+$aumentox,$y);
        $pdf->SetFont($font, '', 8);
        $pdf->Cell(0, 4, "FECHA FACTURA"  ,0,1, "L");

        $pdf->SetXY($x+133+$aumentox,$y);
        $pdf->Cell(0, 4, "PLAZO"  ,0,1, "L");

        $pdf->SetXY($x+145+$aumentox,$y);
        $pdf->Cell(0, 4, "FECHA VENCIMIENTO"  ,0,1, "L");
        
        $pdf->SetFont($font, '', 8);
        $y+=$space;
        $pdf->SetXY($x+2,$y);
        $pdf->Cell(0, 4, "SEÑORES: ". $comprobante->getIds()->getCaNombre() ,0,1, "L");
        $y+=$space;
        $pdf->SetXY($x+2,$y);        
        $pdf->Cell(0, 4, "ATENCION: " . $comprobante->getProperty("idcontacto")   ,0,1, "L");

        $pdf->SetXY($x+105+$aumentox,$y);
        $fechComprobante=Utils::parseDate(($comprobante->getCaFchcomprobante()=="")?date("Y-m-d"):$comprobante->getCaFchcomprobante(), "Y-m-d");
        $pdf->Cell(0, 4,  $fechComprobante ,0,1, "L");
        $pdf->SetXY($x+135+$aumentox,$y);
        
        if( !$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito() ||$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="" || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()<0 || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="0" )
        {
            $dcredito=0;
            $fchDocCruce=date("Y-m-d");
        }
        else
            $dcredito=$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito();

        if($dcredito>0)
            $fchDocCruce=Utils::agregarDias($fechComprobante , $dcredito,  "Y-m-d");
        else
            $fchDocCruce=date("Y-m-d");
        
        //$plazo=($comprobante->getCaPlazo()>0)?$comprobante->getCaPlazo(): ($comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()>0)?$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito():0;

        $pdf->Cell(0, 4, $dcredito  ,0,1, "L");
        $pdf->SetXY($x+152+$aumentox,$y);
        
        
        $pdf->Cell(0, 4, $fchDocCruce   ,0,1, "L");

        $y+=5;
        $pdf->SetXY($x+103+$aumentox,$y);
        $pdf->Cell(0, 4, "TASA DE CAMBIO "/*    . $comprobante->getCaTcambio()*/ ,0,1, "L");
        $pdf->SetXY($x+148+$aumentox,$y);
        $pdf->Cell(0, 4, "No. REF. "  ,0,1, "L");
        $y-=5;
        $y+=$space;
        $pdf->SetXY($x+2,$y);
        $suc_cli=$comprobante->getIds()->getSucursalPrincipal();
        if($comprobante->getCaIdsucursal()=="")
        {
            $suc_cli=$comprobante->getIds()->getIdsCliente();
            $direccion= $suc_cli->getDireccion();
        }
        else
        {
            $suc_cli = Doctrine::getTable("IdsSucursal")->find($comprobante->getCaIdsucursal());
            //$suc_cli=$comprobante->getIds()->getSucursalPrincipal();
            //$direccion=$suc_cli->getCaDireccion();
            $direccion= $suc_cli->getCaDireccion();
        }
        //$suc_cli=$comprobante->getIds()->getIdsCliente();
        //$direccion=$suc_cli->getDireccion();

        $pdf->Cell(0, 4, "DIRECCIÓN: "  ,0,1, "L");
        $pdf->SetXY($x+20,$y);
        if(strlen($direccion)>50)
            $pdf->SetFont($font,'',7);

        $pdf->Cell(0, 4,  utf8_decode($direccion)  ,0,1, "L");
        if(strlen($direccion)>50)
            $pdf->SetFont($font,'',8);
        $y+=$space;
        $pdf->SetXY($x+2,$y);
        $pdf->Cell(0, 4, "CIUDAD: ".$suc_cli->getCiudad()->getCaCiudad()  ,0,1, "L");
        $pdf->SetXY($x+60+$aumentox,$y);
        $pdf->Cell(0, 4, "TELEFONO: ".$suc_cli->getCaTelefonos()  ,0,1, "L");

        $y+=$space;
        $pdf->SetXY($x+2,$y);
        $pdf->Cell(0, 4, "NIT: ".$comprobante->getIds()->getCaIdalterno()."-".$comprobante->getIds()->getCaDv()  ,0,1, "L");

        /*
        $pdf->SetXY($x+60,$y);
        $pdf->Cell(0, 4, "VENDEDOR: ".$inoCliente->getCaVendedor()  ,0,1, "L");
        */

        $pdf->SetXY($x+107+$aumentox,$y);
        $pdf->Cell(0, 4, Utils::formatNumber($comprobante->getCaTcambio(), 2, ".", ",")  ,0,1, "L");
        $pdf->SetXY($x+138+$aumentox,$y);
        $pdf->Cell(0, 4, $inoMaestra->getCaReferencia()  ,0,1, "L");

        $y+=6;

//        $pdf->Rect($x,$y,175+$aumentox,23);
//        $y+=$space;
//
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
//            $txt="BIENES : ";        
//        else
//            $txt="BIENES TRANS. : ";
//        
//        $pdf->SetXY($x+2,$y);
//        $pdf->Cell(0, 4, $txt. utf8_decode($comprobante->getProperty("bienestrans"))  ,0,1, "L");
//        
//        $pdf->SetXY($x+135+$aumentox,$y);        
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
//            $txt="";        
//        else
//            $txt="SERVICIO : ".$inoMaestra->getCaTransporte();
//        
//        $pdf->Cell(0, 4, $txt   ,0,1, "L"); //$inoMaestra->getCaTransporte()
//
//        $y+=$space;
//        $pdf->SetXY($x+2,$y);
//        $pdf->Cell(0, 4, "DETALLE  : ". $comprobante->getProperty("detalle")/*$comprobante->getCaObservaciones()*/  ,0,1, "L");
//
//        $y+=$space;
//        $pdf->SetXY($x+2,$y);
//        
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
//            $txt="";        
//        else
//        {
//            if($inoMaestra->getCaTransporte()==Constantes::AEREO)
//                $txt="HAWB  : ".$inoCliente->getCaDoctransporte();    
//            else
//                $txt="BL Hijo  : ".$inoCliente->getCaDoctransporte();
//        }
//        
//        $pdf->Cell(0, 4, $txt  ,0,1, "L");
//
//        
//        
//        
//        
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12" || ($inoMaestra->getCaTransporte()==Constantes::AEREO && $inoMaestra->getCaImpoexpo() == Constantes::IMPO ))
//            $txt="";
//        else
//        {
//            $y+=$space;
//            $pdf->SetXY($x+2,$y);
//            $txt="Nave  : ";
//            $pdf->Cell(0, 4, $txt  ,0,1, "L"); //.$inoCliente->getCaIdnave()
//        }
//        
//
//        //$pdf->SetXY($x+60,$y);
//        
//        $y+=$space;
//        $pdf->SetXY($x+2,$y);
//        
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
//            $txt="";        
//        else
//            $txt="Piezas  : ";
//        $pdf->Cell(0, 4, $txt.$inoCliente->getCaNumpiezas()  ,0,1, "L");
//
//        $pdf->SetXY($x+40,$y);
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
//            $txt="";        
//        else
//            $txt="Peso  : ";
//        $pdf->Cell(0, 4, $txt.$inoCliente->getCaPeso()  ,0,1, "L");
//
//        $pdf->SetXY($x+70,$y);
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
//            $txt="";        
//        else
//            $txt="CMB  : ".$inoCliente->getCaVolumen();        
//        $pdf->Cell(0, 4, $txt  ,0,1, "L");
//
//        $y+=$space;
//        $pdf->SetXY($x+2,$y);
//        
//        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
//            $txt="";        
//        else
//            $txt="Trayecto  : ".($inoMaestra->getOrigen()->getCaCiudad()." , ".$inoMaestra->getOrigen()->getTrafico()->getCaNombre()."  -  ".$inoMaestra->getDestino()->getCaCiudad()." - ".$inoMaestra->getDestino()->getTrafico()->getCaNombre());
//        $pdf->Cell(0, 4, $txt   ,0,1, "L"); //
//
//        $y+=$space;
//        $pdf->SetXY($x+10,$y);
//        $pdf->Cell(0, 4, ""/*"Para embarques marítimos, la factura debe ser liquidada a la TRM del día de pago mas $30 siempre y cuando esta nos sea inferior"*/  ,0,1, "L");
//        $y+=$space;
//        $pdf->SetXY($x+10,$y);
//        $pdf->Cell(0, 4, "" /*"a la tasa de emisión de esta factura.  También puede consultar la tasa de cambio para pago de sus facturas, llamando a nuestro"*/  ,0,1, "L");
//        //$y+=$space;
//        //$pdf->SetXY($x+10,$y);
//        //$pdf->Cell(0, 4, "" /*"PBX 4239300 Opción 1."*/  ,0,1, "L");
//
        //Detalles
        $y+=6;

        $pdf->Rect($x,$y,175+$aumentox,100);

        $pdf->line($x,$y+6,$x+175+$aumentox,$y+6);

        //tres lineas v
        $pdf->line($x+20,$y,$x+20,$y+100);
        $pdf->line($x+105,$y,$x+105,$y+100);
        if($comprobante->getCaIdmoneda()!="COP")
            $pdf->line($x+125+$aumentox,$y,$x+125+$aumentox,$y+100);
        $pdf->line($x+150+$aumentox,$y,$x+150+$aumentox,$y+100);

        //$pdf->line($x,$y+100,$x+175+$aumentox,$y+100);
        //$pdf->line($x,$y+110,$x+175,$y+110);

        $y+=1;


        $pdf->SetXY($x+5,$y);
        $pdf->Cell(0, 4, "CÓDIGO"  ,0,1, "L");
        $pdf->SetXY($x+50,$y);
        $pdf->Cell(0, 4, "D E S C R I P C I Ó N"  ,0,1, "L");
        $pdf->SetXY($x+110,$y);
        $pdf->Cell(0, 4, "REFERENCIA"  ,0,1, "L");
        $pdf->SetXY($x+130+$aumentox,$y);
        if($comprobante->getCaIdmoneda()!="COP")
            $pdf->Cell(0, 4, "VALOR ".$comprobante->getCaIdmoneda()  ,0,1, "L");
            //$pdf->Cell(0, 4, "VALOR DOLAR"  ,0,1, "L");
            
        $pdf->SetXY($x+152+$aumentox,$y);
        $pdf->Cell(0, 4, "VALOR PESOS"  ,0,1, "L");

        //Imprime Transacciones

        $lastIngresoPropio = null;
        $impuestos = array();
        $totales = array();

        //$totales["propios"] = 0;
        //$totales["terceros"] = 0;

        $k = 5;

        $totales["local"]=$totales["mext"]=$subtotales=$impuestos["iva"]=$impuestos["reteiva"]=$impuestos["reteica"]=0;
        
        //$pdf->Cell(0, 4, "NREG:".count($transacciones) ,0,1, "L");
        $tcambio=$comprobante->getCaTcambio();
        foreach( $transacciones[$comprobante->getCaIdcomprobante()] as $t ){

//            if( $lastIngresoPropio!=$t["s_ca_pt"]   ){
//                $pdf->SetXY($x+22,$y+$k+$space);
//                if( $t["s_ca_pt"]=="P" ){
//                    $pdf->Cell(0, 4, "INGRESOS  PROPIOS" ,0,1, "L");
//                    $k+=($space/2);
//                }else if( $t["s_ca_pt"]=="T" ){
//                    $pdf->Cell(0, 4, "INGRESOS PARA TERCEROS" ,0,1, "L");
//                    $k+=($space/2);
//                }
//                if($subtotales>0)
//                {
//                    
//                    
//                    $pdf->SetXY($x+102.5+$aumentox,$y+$k);
//                    $pdf->Cell(0, 4, "SUBTOTAL...." ,0,1, "L");
//                    
//                    if($comprobante->getCaIdmoneda()!="COP")
//                    {
//                        $pdf->SetXY($x,$y+$k);
//                        $pdf->Cell(162, 4, number_format(($subtotales1), 2, ",", ".")  ,0,1, "R");
//                    }
//                    
//                    $pdf->SetXY($x+$aumentox,$y+$k);
//                    $pdf->Cell(175, 4, number_format($subtotales, 2, ",", ".")  ,0,1, "R");
//                    $k+=$space;
//                    $totales["local"]+=$subtotales;
//                    $subtotales=$subtotales1=0;
//                }
                
                //$k+=$space+$space;
//            }
//            $lastIngresoPropio=$t["s_ca_pt"];  
//
//
            $pdf->SetXY($x+5,$y+$k);
            $pdf->Cell(0, 4,$t["mc_ca_idconcepto"] ,0,1, "L");
            $pdf->SetXY($x+25,$y+$k);

            $pdf->Cell(0, 4, strtoupper($t["mc_ca_concepto_esp"] ),0,1, "L");

            $pdf->SetXY($x+107.5,$y+$k);
            $pdf->Cell(0, 4, $t["im_ca_referencia"] ,0,1, "L");

            if($comprobante->getCaIdmoneda()!="COP")
            {
                $pdf->SetXY($x+$aumentox,$y+$k);
                $pdf->Cell(147, 4, number_format(($t["det_ca_cr"]), 2, ",", ".")  ,0,1, "R");
                $totales[$comprobante->getCaIdmoneda()]+=$t["det_ca_cr"];
            }
            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(175, 4, number_format(($t["det_ca_cr"]*$tcambio), 2, ",", ".")  ,0,1, "R");
            //$totales["local"]+=$t["det_ca_cr"]*$tcambio;
            $k+=$space+1;
            
//            if($regContributivo=="G" && $t["s_ca_pt"]=="P")//gran contribuyente e ingresos propios
//            {
//                //$q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."2");
//                
//                $impuestos["reteica"]+=round(($t["det_ca_cr"]*$tcambio)* ($t["cric_ca_rteica"]/100));
//                //echo round($t["det_ca_cr"] ."----". ($t["cric_ca_reteica"]));
//                //print_r($t);
//                //exit;
//            }
//            //echo "<pre>";print_r($t);echo "</pre>";
//            //    exit;
            $t["s_ca_porciva"]= $comprobante->getIva();
            if($t["s_ca_iva"]=="S")
                $impuestos["iva"]+=round(($t["det_ca_cr"]*$tcambio)* ($t["s_ca_porciva"]/100));
            $subtotales+=($t["det_ca_cr"]*$tcambio);
            $subtotales1+=$t["det_ca_cr"];
//            //$totales["mext"]+=$t["det_ca_cr"];
        }

        

        if($subtotales>0)
        {
            $k+=$space;
            $pdf->SetXY($x+102.5+$aumentox,$y+$k);
            $pdf->Cell(0, 4, "SUBTOTAL...." ,0,1, "L");
            
            if($comprobante->getCaIdmoneda()!="COP")
            {
                $pdf->SetXY($x,$y+$k);
                $pdf->Cell(162, 4, number_format(($subtotales1), 2, ",", ".")  ,0,1, "R");
            }
            
            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(175, 4, number_format($subtotales, 2, ",", ".")  ,0,1, "R");
            $k+=$space+3;
            $totales["local"]+=$subtotales;
        }

        $k+=$space;
        $pdf->SetXY($x+106.3+$aumentox,$y+$k);
        $pdf->Cell(0, 4, "TOTAL ...." ,0,1, "L");
        if($comprobante->getCaIdmoneda()!="COP")
        {
            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(147, 4, number_format( $totales[$comprobante->getCaIdmoneda()] , 2, ",", ".")  ,0,1, "R");
        }
        $pdf->SetXY($x+$aumentox,$y+$k);
        $pdf->Cell(175, 4, number_format( $totales["local"] , 2, ",", ".")  ,0,1, "R");
        $k+=$space+1;

        $pdf->SetXY($x+106.3+$aumentox,$y+$k);
            $pdf->Cell(0, 4, "I.V.A ...." ,0,1, "L");
            if($comprobante->getCaIdmoneda()!="COP")
            {
                $pdf->SetXY($x+$aumentox,$y+$k);
                $pdf->Cell(147, 4, number_format($impuestos["iva"]/$tcambio, 2, ",", ".")  ,0,1, "R");      
            }
            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(175, 4, number_format($impuestos["iva"], 2, ",", ".")  ,0,1, "R");    
            $k+=$space+1;
            
            
//            
//        if($regContributivo=="G")
//        {
//            if($impuestos["iva"]>0)
//            {
//                $impuestos["reteiva"]=(($impuestos["iva"]*15)/100);
//                $pdf->SetXY($x+99+$aumentox,$y+$k);
//                $pdf->Cell(0, 4, "RTE.I.V.A ...." ,0,1, "L");
//                
//                if($comprobante->getCaIdmoneda()!="COP")
//                {
//                    $pdf->SetXY($x+$aumentox,$y+$k);
//                    $pdf->Cell(147, 4, number_format($impuestos["reteiva"]/$tcambio, 2, ",", ".")  ,0,1, "R");      
//                }
//                
//                $pdf->SetXY($x+$aumentox,$y+$k);
//                $pdf->Cell(175, 4, number_format( $impuestos["reteiva"]  , 2, ",", ".")  ,0,1, "R");    
//                $k+=$space+1;
//
//            }
//
//            if($impuestos["reteica"]>0)
//            {
//                $pdf->SetXY($x+99+$aumentox,$y+$k);
//                $pdf->Cell(0, 4, "RTE.I.C.A ...." ,0,1, "L");
//                
//                if($comprobante->getCaIdmoneda()!="COP")
//                {
//                    $pdf->SetXY($x+$aumentox,$y+$k);
//                    $pdf->Cell(147, 4, number_format($impuestos["reteica"]/$tcambio, 2, ",", ".")  ,0,1, "R");      
//                }
//                
//                $pdf->SetXY($x+$aumentox,$y+$k);
//                $pdf->Cell(175, 4, number_format($impuestos["reteica"], 2, ",", ".")  ,0,1, "R");    
//                $k+=$space;
//                $k+=$space;
//            }
//        }
//
        $pdf->SetXY($x + 98, $y + $k);
        
        if($comprobante->getCaIdmoneda()!="COP")
           // $pdf->line($x + 125+$aumentox, $y + $k, $x + 150+$aumentox, $y + $k);
        $k+=$space;
        //$pdf->line($x + 150+$aumentox, $y + $k, $x + 175+$aumentox, $y + $k);
        $k+=$space;

        $pdf->SetXY($x+93.6+$aumentox,$y+$k);
        $pdf->Cell(0, 4, "TOTAL A PAGAR...." ,0,1, "L");
        
        if($comprobante->getCaIdmoneda()!="COP")
        {
            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(147, 4, number_format($totales[$comprobante->getCaIdmoneda()]+(($impuestos["iva"]-$impuestos["reteiva"]-$impuestos["reteica"])/$tcambio) , 2, ",", ".")  ,0,1, "R");
        }
        
        $pdf->SetXY($x+$aumentox,$y+$k);
        $pdf->Cell(175, 4, number_format($totales["local"]+$impuestos["iva"]-$impuestos["reteiva"]-$impuestos["reteica"] , 2, ",", ".")  ,0,1, "R");
        $k+=$space;



        $y+=100+$space;

        $pdf->Rect($x,$y,175+$aumentox,10);
        $pdf->SetXY($x+5,$y);
//echo number_format($totales+$impuestos , 0, ".", "");
//exit;
        $pdf->MultiCell(0, 4, "SON:\n     ". strtoupper(num2letras(round($totales["local"]+$impuestos["iva"]-$impuestos["reteiva"]-$impuestos["reteica"]) , false )) . " M/CTE" ,0,1, "C");

        $space = 2;
        $y+=10;
        $pdf->Rect($x,$y,175+$aumentox,10);
        $pdf->SetXY($x+5,$y);
        
        if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
            $txt="OBSERVACIONES:\n".$comprobante->getProperty("anexos");
        else
            $txt="OBSERVACIONES:\n".$comprobante->getCaObservaciones();
        
        $pdf->MultiCell(0, 4, $txt ,0,1, "C");
        $pdf->SetFont($font, '', 6);

        $y+=10;
        $pdf->Rect($x,$y,175+$aumentox,15);
        $pdf->SetXY($x+5,$y);
        $pdf->MultiCell(0, 4, $tipo->getCaMensaje() ,0,1, "C");

//
//        $y+=15;
//        $pdf->SetXY($x+30,$y);
//        $pdf->Cell(0, 3, "Numeración según Resolución DIAN ".$tipo->getCaNoautorizacion()."  ".Utils::parseDate($tipo->getCaFchautorizacion(),"Y/m/d")." ".$tipo->getCaInicialAut()." AL ".$tipo->getCaFinalAut()." FACTURA POR COMPUTADOR."  ,0,1, "L");
//
//        $datostmp = ParametroTable::retrieveByCaso("CU234",$sucursal->getCaIdempresa());
//        foreach ($datostmp as $d) {
//            $datosMensajes[$d->getCaIdentificacion()]=$d->getCaValor2();
//        }
//
//        $y+=4;
//        if(isset($datosMensajes[$sucursal->getCaIdempresa()."1"]))
//        {
//            $pdf->SetRightMargin(55);            
//            //$pdf->Rect($x,$y,140,6);            
//            $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."1"])/100))*3);
//            $pdf->SetXY($x+2,$y);
//            //$pdf->MultiCell(0, 2, $datosMensajes[$sucursal->getCaIdempresa()."1"] ,0,1, "J");
//            $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."1"] );
//            $y+=(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."1"])/100))*3;
//        }
//
//        /*if(isset($datosMensajes[3]))
//        {
//            $y+=7;
//            $pdf->Rect($x,$y,140,6);
//            $pdf->SetXY($x+5,$y);
//            $pdf->MultiCell(0, 2, $datosMensajes[3] ,0,1, "J");
//        }*/
//        if(isset($datosMensajes[$sucursal->getCaIdempresa()."2"]))
//        {
//            //$pdf->Rect($x,$y,140,21);
//            $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."2"])/100))*3);
//            $pdf->SetXY($x+2,$y);
//            $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."2"] );
//            $y+=(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."2"])/100))*3;
//        }
//
//
//        if(isset($datosMensajes[$sucursal->getCaIdempresa()."3"]))
//        {
//            
//            $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."3"])/100))*3);
//            $pdf->SetXY($x+2,$y);
//            $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."3"] );
//            $y+=(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."3"])/100))*3;
//        }
//        
//        if(isset($datosMensajes[$sucursal->getCaIdempresa()."4"]))
//        {
//            
//            $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."4"])/100))*4);
//            $pdf->SetXY($x+2,$y);
//            $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."4"]  );
//        }
//
//        $pdf->SetRightMargin(12);
//
//        $y-=26;
//        $pdf->SetXY($x+140+$aumentox,$y);
//        $pdf->Cell(0, 4, "___________________________"  ,0,1, "L");
//        $y+=3;
//        $pdf->SetXY($x+142+$aumentox,$y);
//        $pdf->Cell(0, 4, $sucursal->getEmpresa()->getCaNombre()  ,0,1, "L");
//
//
//        $y+=13;
//        $pdf->SetXY($x+140+$aumentox,$y);
//        $pdf->Cell(0, 4, "___________________________"  ,0,1, "L");
//        $y+=3;    
//        $pdf->SetXY($x+148+$aumentox,$y);
//        $pdf->Cell(0, 4, "FIRMA RECIBIDO "  ,0,1, "L");
//        
//        $y+=7;
//        $pdf->SetXY($x+140+$aumentox,$y);
//        $pdf->Cell(0, 4, "___________________________"  ,0,1, "L");
//        $y+=3;
//        $pdf->SetXY($x+148+$aumentox,$y);
//        $pdf->Cell(0, 4, "FECHA RECIBIDO "  ,0,1, "L");
        
        
        
    }

$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}
?>