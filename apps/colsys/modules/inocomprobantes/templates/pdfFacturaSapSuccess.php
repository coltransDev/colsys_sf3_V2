<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

function num2letras($num, $fem = false, $dec = true) { 
    if($num=="1100000")
        return "UN MILLÓN CIEN MIL PESOS";
    //if(if($num=="1100000"))
    
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
   
   $float=explode('.',$num);
   $num=$float[0];
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
   //Zi hack --> return ucfirst($tex);
   $end_num=ucfirst($tex).(($float[1]!="")?' con '.num2letras($float[1])." centavos":"");
   return $end_num; 
} 

$pdf = new PDF (  );
$pdf->Open ();
$pdf->setColtransHeader ( false );
$pdf->setColtransFooter ( false );
$pdf->setIdempresa(8);
$pdf->AliasNbPages();
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(18);
$pdf->SetWidths(1);

$comprobantes = $sf_data->getRaw("comprobantes");
$transacciones = $sf_data->getRaw("transacciones");
$trd = $sf_data->getRaw("trd");

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

    $dir= explode("  ", $sucursal->getCaDireccion());

    foreach($dir as $d)
    {
        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, $d,0,1, "L");
    }

    $y+=$space;
    $pdf->SetXY($x+$marginHeader,$y);
    $pdf->Cell(0, 4, "PBX: ".$sucursal->getCaTelefono()." ".$sucursal->getCaFax(),0,1, "L");

    $datostmp= json_decode($sucursal->getCaDatos());
    $y+=$space;
    $pdf->SetXY($x+$marginHeader,$y);
    $pdf->Cell(0, 4, "E-mail: ".(($datostmp->emailFactura!="")?$datostmp->emailFactura:$sucursal->getCaEmail()),0,1, "L"); //.$idsSucursal->getCaEmail()

    $y+=$space;
    $pdf->SetXY($x+$marginHeader,$y);
    $pdf->Cell(0, 4, $sucursal->getCaNombre().", ".$sucursal->getEmpresa()->getTrafico()->getCaNombre() ,0,1, "L");

    $y+=$space;
    $pdf->SetXY($x+$marginHeader,$y);
    $pdf->Cell(0, 4, "Regimen común ",0,1, "L");
    
    $y+=$space;
    $pdf->SetXY($x+$marginHeader,$y);
    $pdf->Cell(0, 4, "No somos grandes contribuyentes ",0,1, "L");
    
    $datostmp = ParametroTable::retrieveByCaso("CU234",$sucursal->getCaIdempresa());
    foreach ($datostmp as $d) {
        $datosMensajes[$d->getCaIdentificacion()]=$d->getCaValor2();
    }

    if(isset($datosMensajes[$sucursal->getCaIdempresa()."5"]))
    {            
        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, $datosMensajes[$sucursal->getCaIdempresa()."5"],0,1, "L");
    }

    if($sucursal->getCaIdempresa()=="2" || $sucursal->getCaIdempresa()=="8")
    {
        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, "Agentes de retención de IVA ",0,1, "L");        
        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);        
        $pdf->Cell(0, 4, "Articulo 437-2 Num. 7 Prov.C.I.",0,1, "L");   
        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, "Num. 9 Regimen-Simple ",0,1, "L");        
    }
    else
    {
        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);
        $pdf->Cell(0, 4, "Agentes de retención de IVA ",0,1, "L");        
        $pdf->Cell(0, 4, "",0,1, "L");
        $y+=$space;
        $pdf->SetXY($x+$marginHeader,$y);        
        $pdf->Cell(0, 4, "Articulo 437-2 Num. 9 Regimen-Simple",0,1, "L");        
    }

    $y+=$space;
    $pdf->SetXY($x+$marginHeader,$y);
    $pdf->Cell(0, 4, strtoupper($tipo->getCaTitulo())." ". $comprobante->getCaConsecutivo()/*str_pad($comprobante->getCaConsecutivo(), 14, "0", STR_PAD_LEFT)*/,0,1, "L");

    $pdf->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.$sucursal->getEmpresa()->getCaLogo(), $x, 12, 70, 15);

    $y+=6;

    //Encabezado
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
    $pdf->Cell(0, 4, Utils::parseDate($comprobante->getCaFchcomprobante(), "Y/m/d")  ,0,1, "L");
    $pdf->SetXY($x+135+$aumentox,$y);

    $idsCreditos=$comprobante->getIds()->getIdsCredito();
    $plazo=0;
    
    if(($comprobante->getCaPlazo()>=0))
        $plazo=$comprobante->getCaPlazo();
    else
    {
        foreach($idsCreditos as $idsc)
        {
            if($idsc->getCaIdempresa()==$comprobante->getInoTipoComprobante()->getCaIdempresa())
                $plazo=$idsc->getCaDias();
        }
        
    }

    $pdf->Cell(0, 4, $plazo  ,0,1, "L");
    $pdf->SetXY($x+152+$aumentox,$y);
    $pdf->Cell(0, 4, Utils::agregarDias($comprobante->getCaFchcomprobante(), $plazo,  "Y/m/d")   ,0,1, "L");

    $y+=5;
    $pdf->SetXY($x+103+$aumentox,$y);
    $pdf->Cell(0, 4, "TASA DE CAMBIO "/*    . $comprobante->getCaTcambio()*/ ,0,1, "L");
    $pdf->SetXY($x+148+$aumentox,$y);
    $pdf->Cell(0, 4, "No. REF. "  ,0,1, "L");
    $y-=5;
    $y+=$space;
    $pdf->SetXY($x+2,$y);
    if($comprobante->getCaIdsucursal()=="")
    {
        $suc_cli=$comprobante->getIds()->getIdsCliente();
        $direccion= trim($suc_cli->getDireccion());
    }
    else
    {
        $suc_cli = Doctrine::getTable("IdsSucursal")->find($comprobante->getCaIdsucursal());
        $direccion= trim($suc_cli->getCaDireccion());
    }

    $pdf->Cell(0, 4, "DIRECCIÓN: "  ,0,1, "L");
    $pdf->SetXY($x+20,$y);
    if(strlen($direccion)>50)
        $pdf->SetFont($font,'',7);

    $pdf->Cell(0, 4,  (substr($direccion,0,64))  ,0,1, "L");
    if(strlen($direccion)>50)
        $pdf->SetFont($font,'',8);

    $y+=$space;
    $pdf->SetXY($x+2,$y);
    $pdf->Cell(0, 4, "CIUDAD: ".$suc_cli->getCiudad()->getCaCiudad()  ,0,1, "L");
    $pdf->SetXY($x+30+$aumentox,$y);
    $pdf->Cell(0, 4, "TELEFONO: ".$suc_cli->getCaTelefonos()  ,0,1, "L");

    $y+=$space;
    $pdf->SetXY($x+2,$y);
    $pdf->Cell(0, 4, "NIT: ".$comprobante->getIds()->getCaIdalterno()."-".$comprobante->getIds()->getCaDv()  ,0,1, "L");

    $datos= json_decode(utf8_encode($comprobante->getCaDatos()));
    $ca_referencia=($inoMaestra->getCaReferencia()!="")?$inoMaestra->getCaReferencia():$datos->ca_referencia;

    $pdf->SetXY($x+107+$aumentox,$y);
    $pdf->Cell(0, 4, Utils::formatNumber($comprobante->getCaTcambio(), 2, ".", ",")  ,0,1, "L");
    $pdf->SetXY($x+138+$aumentox,$y);
    $pdf->Cell(0, 4, $ca_referencia  ,0,1, "L");

    $y+=6;

    $pdf->Rect($x,$y,175+$aumentox,25);
    $y+=$space;

    if($sucursal->getEmpresa()->getCaIdempresa()=="12" || $sucursal->getEmpresa()->getCaIdempresa()=="11")        
        $txt="BIENES : ";        
    else
        $txt="BIENES TRANS. : ";

    $pdf->SetXY($x+2,$y);
    $pdf->Cell(0, 4, $txt. utf8_decode($comprobante->getProperty("bienestrans"))  ,0,1, "L");

    $pdf->SetXY($x+130+$aumentox,$y);        
    $txt="SERVICIO : ". $comprobante->getInoCentroCosto()->getCaNombre();

    $pdf->Cell(0, 4, $txt   ,0,1, "L"); //$inoMaestra->getCaTransporte()

    $y+=$space;
    $pdf->SetXY($x+2,$y);
    $pdf->Cell(0, 4, "DETALLE  : ". $comprobante->getProperty("detalle")/*$comprobante->getCaObservaciones()*/  ,0,1, "L");

    $y+=$space;
    $pdf->SetXY($x+2,$y);

    if($sucursal->getEmpresa()->getCaIdempresa()=="12" || $sucursal->getEmpresa()->getCaIdempresa()=="11")
        $txt="Doc. Transp.  : ".$datos->ca_doctransporte;
    else
    {
        /*if($inoMaestra->getCaTransporte()==Constantes::AEREO)
            $txt="HAWB  : ".$inoCliente->getCaDoctransporte();    
        else if($inoMaestra->getCaTransporte()==Constantes::MARITIMO)
            $txt="BL Hijo  : ".$inoCliente->getCaDoctransporte();
        else*/
            $txt="Doc. Transp.  : ".($inoCliente->getCaDoctransporte()!=""?$inoCliente->getCaDoctransporte():$datos->ca_doctransporte);
    }

    $pdf->Cell(0, 4, $txt  ,0,1, "L");

    if($sucursal->getEmpresa()->getCaIdempresa()=="12" || $sucursal->getEmpresa()->getCaIdempresa()=="11" || ($inoMaestra->getCaTransporte()==Constantes::AEREO && $inoMaestra->getCaImpoexpo() == Constantes::IMPO ))
        $txt="";
    else
    {
        $y+=$space;
        $pdf->SetXY($x+2,$y);
        $txt="Nave  : ".$inoMaestra->getCaMotonave();
        $pdf->Cell(0, 4, $txt  ,0,1, "L"); //.$inoCliente->getCaIdnave()
    }

    $y+=$space;
    $pdf->SetXY($x+2,$y);

        $txt="Piezas  : ";
    $pdf->Cell(0, 4, $txt.($inoCliente->getCaNumpiezas()!=""?$inoCliente->getCaNumpiezas():$datos->ca_piezas)  ,0,1, "L");

    $pdf->SetXY($x+40,$y);
    
        $txt="Peso  : ";
    $pdf->Cell(0, 4, $txt.($inoCliente->getCaPeso()!=""?$inoCliente->getCaPeso():$datos->ca_peso)  ,0,1, "L");

    $pdf->SetXY($x+70,$y);
    
        $txt="CMB  : ".($inoCliente->getCaVolumen()!=""?$inoCliente->getCaVolumen():$datos->ca_volumen);
    $pdf->Cell(0, 4, $txt  ,0,1, "L");

    $y+=$space;
    $pdf->SetXY($x+2,$y);

    if($sucursal->getEmpresa()->getCaIdempresa()=="12")        
        $txt = "Bodega  : ".$datos->ca_trayecto;
    else if($sucursal->getEmpresa()->getCaIdempresa()=="11") 
        $txt = "Recepción No. : ".$datos->ca_trayecto;
    else
        $txt="Trayecto  : ".($comprobante->getCaIdhouse()!=""?($inoMaestra->getOrigen()->getCaCiudad()." , ".$inoMaestra->getOrigen()->getTrafico()->getCaNombre()."  -  ".$inoMaestra->getDestino()->getCaCiudad()." - ".$inoMaestra->getDestino()->getTrafico()->getCaNombre()):$datos->ca_trayecto);
    $pdf->Cell(0, 4, $txt   ,0,1, "L"); //

    $y+=$space+1;
    $pdf->SetXY($x+5,$y);

    $pdf->SetFont($font,'',6);
    $pdf->MultiCell(0, 2, utf8_decode($datos->txttrm)  ,0,1, "C");
    $pdf->SetFont($font,'',8);

    $y+=8;
    $pdf->Rect($x,$y,175+$aumentox,100);
    $pdf->line($x,$y+6,$x+175+$aumentox,$y+6);

    $pdf->line($x+20,$y,$x+20,$y+100);
    if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
        $pdf->line($x+125+$aumentox,$y,$x+125+$aumentox,$y+100);
    $pdf->line($x+150+$aumentox,$y,$x+150+$aumentox,$y+100);

    $y+=1;
    $pdf->SetXY($x+5,$y);
    $pdf->Cell(0, 4, "CÓDIGO"  ,0,1, "L");
    $pdf->SetXY($x+60,$y);
    $pdf->Cell(0, 4, "D E S C R I P C I Ó N"  ,0,1, "L");
    $pdf->SetXY($x+130+$aumentox,$y);        
    $txt="PESOS";
    if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
        $pdf->Cell(0, 4, "VALOR ".$comprobante->getCaIdmoneda()  ,0,1, "L");
    else if($tipoImpresion=="E")
        $txt=$comprobante->getCaIdmoneda();            

    $pdf->SetXY($x+152+$aumentox,$y);
    $pdf->Cell(0, 4, "VALOR $txt"  ,0,1, "L");

    $lastIngresoPropio = null;
    $impuestos = array();
    $totales = array();
    $k = 5;
    $totales["local"]=$totales["mext"]=$subtotales=0;

    $tcambio=$comprobante->getCaTcambio();
    foreach( $transacciones[$comprobante->getCaIdcomprobante()] as $t ){

        if( substr($lastIngresoPropio,0,2)!=substr($t["det_ca_idcuenta"],0,2) )
        {
            $pdf->SetXY($x+22,$y+$k+$space);
            if( substr($t["det_ca_idcuenta"],0,2)=="41" ){
                $pdf->Cell(0, 4, "INGRESOS  PROPIOS" ,0,1, "L");
                $k+=($space/2);
            }
            if( substr($t["det_ca_idcuenta"],0,2)=="28" ){
                $pdf->Cell(0, 4, "INGRESOS PARA TERCEROS" ,0,1, "L");
                $k+=($space/2);
            }
            if($subtotales>0)
            {
                $pdf->SetXY($x+102.5+$aumentox,$y+$k);
                $pdf->Cell(0, 4, "SUBTOTAL...." ,0,1, "L");
                $txt=$subtotales;

                if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
                {
                    $pdf->SetXY($x,$y+$k);
                    $pdf->Cell(165, 4, number_format(($subtotales1), 2, ",", ".")  ,0,1, "R");
                    $txt=number_format(round($subtotales), 0, ",", ".");
                }
                else if($tipoImpresion=="E")
                    $txt=number_format(round($subtotales1,2), 2, ",", ".");
                else 
                    $txt=number_format(round($subtotales), 0, ",", ".");

                $pdf->SetXY($x+$aumentox,$y+$k);
                $pdf->Cell(175, 4, $txt  ,0,1, "R");
                $k+=$space;
                $totales["local"]+=$subtotales;
                $subtotales=$subtotales1=0;
            }
            $k+=$space+$space;
        }
        $lastIngresoPropio=$t["det_ca_idcuenta"];

        $pdf->SetXY($x+5,$y+$k);
        $pdf->Cell(0, 4,$t["s_ca_idconcepto"] ,0,1, "L");
        $pdf->SetXY($x+25,$y+$k);
        $pdf->Cell(0, 4, strtoupper($t["s_ca_concepto_".$idioma] ),0,1, "L");

        $txt=$t["det_ca_cr"]*$tcambio;
        if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
        {
            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(150, 4, number_format($t["det_ca_cr"], 2, ",", ".")  ,0,1, "R");
            $txt=number_format(($txt), 0, ",", ".");
            $totales["mext"]+=$t["det_ca_cr"];
        }
        else if($tipoImpresion=="E")
        {
            $txt=number_format(($t["det_ca_cr"]), 2, ",", ".");                
            $totales["mext"]+=$t["det_ca_cr"];
        }
        else
            $txt=number_format(($txt), 0, ",", ".");

        $pdf->SetXY($x+$aumentox,$y+$k);
        $pdf->Cell(175, 4, $txt  ,0,1, "R");
        $k+=$space+1;
        $subtotales+=round($t["det_ca_cr"]*$tcambio);
        $subtotales1+= $t["det_ca_cr"];
    }

    if($subtotales>0)
    {
        $pdf->SetXY($x+102.5+$aumentox,$y+$k);
        $pdf->Cell(0, 4, "SUBTOTAL...." ,0,1, "L");
        $txt=$subtotales;
        if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
        {
            $pdf->SetXY($x,$y+$k);
            $pdf->Cell(165, 4, number_format(($subtotales1), 2, ",", ".")  ,0,1, "R");
            $txt=number_format(round($subtotales), 0, ",", ".");
        }
        else if($tipoImpresion=="E")
            $txt=number_format(round($subtotales1,2), 2, ",", ".");
        else
            $txt=number_format(round($txt), 0, ",", ".");

        $pdf->SetXY($x+$aumentox,$y+$k);
        $pdf->Cell(175, 4, $txt  ,0,1, "R");
        $k+=$space+3;
        $totales["local"]+=$subtotales;
    }

    $k+=$space;
    $pdf->SetXY($x+106.3+$aumentox,$y+$k);
    $pdf->Cell(0, 4, "TOTAL ...." ,0,1, "L");
    $txt=$totales["local"];
    if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
    {
        $pdf->SetXY($x+$aumentox,$y+$k);
        $pdf->Cell(150, 4, number_format( $totales["mext"] , 2, ",", ".")  ,0,1, "R");
        $txt=number_format( round($totales["local"]) , 0, ",", ".");
    }else if($tipoImpresion=="E")
        $txt=number_format( round($totales["mext"],2) , 2, ",", ".");        
    else
        $txt=number_format( round($totales["local"]) , 0, ",", ".");

    $pdf->SetXY($x+$aumentox,$y+$k);
    $pdf->Cell(175, 4, $txt  ,0,1, "R");
    $k+=$space+1;

    $pdf->SetXY($x+106.3+$aumentox,$y+$k);
    $pdf->Cell(0, 4, "I.V.A ...." ,0,1, "L");

    $txt=$datos->iva*$tcambio;
    if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
    {        
        $pdf->SetXY($x+$aumentox,$y+$k);
        $pdf->Cell(150, 4, number_format($datos->iva, 2, ",", ".")  ,0,1, "R");
        $txt=number_format(round($txt), 0, ",", ".");
    }
    else if($tipoImpresion=="E")
        $txt=number_format(round($datos->iva,2), 2, ",", ".");
    else
        $txt=number_format(round($txt), 0, ",", ".");

    $pdf->SetXY($x+$aumentox,$y+$k);
    $pdf->Cell(175, 4, $txt  ,0,1, "R");    
    $k+=$space+1;

    {
        if($datos->rteiva>0)
        {
            $impuestos["reteiva"]=(($impuestos["iva"]*15)/100);
            $pdf->SetXY($x+99+$aumentox,$y+$k);
            $pdf->Cell(0, 4, "RTE.I.V.A ...." ,0,1, "L");
            $txt=$datos->rteiva*$tcambio;
            if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
            {
                $pdf->SetXY($x+$aumentox,$y+$k);
                $pdf->Cell(150, 4, number_format($datos->rteiva, 2, ",", ".")  ,0,1, "R");
                $txt=number_format( round($txt) , 0, ",", ".");
            }
            else if($tipoImpresion=="E")
                $txt=number_format( round($datos->rteiva,2) , 2, ",", ".");
            else
                $txt=number_format( round($txt) , 0, ",", ".");

            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(175, 4, $txt  ,0,1, "R");    
            $k+=$space+1;
        }

        if($datos->rteica>0)
        {
            $pdf->SetXY($x+99+$aumentox,$y+$k);
            $pdf->Cell(0, 4, "RTE.I.C.A ...." ,0,1, "L");
            $txt=$datos->rteica*$tcambio;
            if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
            {
                $pdf->SetXY($x+$aumentox,$y+$k);
                $pdf->Cell(150, 4, number_format($datos->rteica, 2, ",", ".")  ,0,1, "R");
                $txt=number_format( round($txt) , 0, ",", ".");
            }
            else if($tipoImpresion=="E")                    
                $txt=number_format( round($datos->rteica,2) , 2, ",", ".");
            else
                $txt=number_format( round($txt) , 0, ",", ".");

            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(175, 4, $txt  ,0,1, "R");    
            $k+=$space;
            $k+=$space;
        }
        $datos->rtefuente=$datos->rtefuente-$datos->autoretencion;

        if( $datos->rtefuente > 0 )
        {
            $pdf->SetXY($x+99+$aumentox,$y+$k);
            $pdf->Cell(0, 4, "RTEFUENTE ...." ,0,1, "L");
            $txt=$datos->rtefuente*$tcambio;
            if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
            {
                $pdf->SetXY($x+$aumentox,$y+$k);
                $pdf->Cell(150, 4, number_format($datos->rtefuente, 2, ",", ".")  ,0,1, "R");
                $txt=number_format( round($txt) , 0, ",", ".");
            }
            else if($tipoImpresion=="E")                    
                $txt=number_format( round($datos->rtefuente,2) , 2, ",", ".");
            else
                $txt=number_format( round($txt) , 0, ",", ".");

            $pdf->SetXY($x+$aumentox,$y+$k);
            $pdf->Cell(175, 4, $txt  ,0,1, "R");    
            $k+=$space;
            $k+=$space;
        }
        else
            $datos->rtefuente=0;

        $txtAnticipo="";
        foreach($datos->idanticipo as $a)
        {
            if($a>0)
            {
                $anticipo = Doctrine::getTable("InoComprobante")->find($a);
                if($anticipo)
                {
                    $txtAnticipo.=$anticipo->getInoTipoComprobante()->getCaPrefijoSap().$anticipo->getInoTipoComprobante()->getCaComprobante()."-". $anticipo->getCaConsecutivo()." ".$anticipo->getCaValor()." ".$anticipo->getCaIdmoneda().(($anticipo->getCaIdmoneda()!="COP")?"(TRM:".$anticipo->getCaTcambio().")":"")."--";
                    $arrAnticipos[$anticipo->getCaIdcomprobante()]["valor"]=$anticipo->getCaValor();
                    $arrAnticipos[$anticipo->getCaIdcomprobante()]["trm"]=$anticipo->getCaTcambio();
                    $arrAnticipos[$anticipo->getCaIdcomprobante()]["moneda"]=$anticipo->getCaIdmoneda();
                }
            }
        }

        if($txtAnticipo!="")
        {
            $pdf->SetFont($font,'',6);
            $pdf->SetXY($x+7+$aumentox,$y+$k);
            $pdf->Cell(0, 4, $txtAnticipo ,0,1, "L");
            $pdf->SetFont($font,'',8);
            $pdf->SetXY($x+102+$aumentox,$y+$k);
            $pdf->Cell(0, 4, "ANTICIPO ...." ,0,1, "L");

            if($comprobante->getCaIdmoneda()!="COP")
            {
                $pdf->SetXY($x+$aumentox,$y+$k);
                {
                    foreach($arrAnticipos as $a)
                    {
                        if($a["moneda"]=="COP")
                            $vanticipo+=($a["valor"]/$comprobante->getCaTcambio());
                        else
                            $vanticipo+=$a["valor"];
                    }
                }
                if($tipoImpresion=="EP")
                    $pdf->Cell(150, 4, number_format($vanticipo, 2, ",", ".")  ,0,1, "R");
            }

            $pdf->SetXY($x+$aumentox,$y+$k);
            foreach($arrAnticipos as $a)
                $vanticipoCop+=($a["valor"]*$a["trm"]);
            
            if($tipoImpresion!="E")
                $pdf->Cell(175, 4, number_format(round($vanticipoCop), 0, ",", ".")  ,0,1, "R");
            else
                $pdf->Cell(175, 4, number_format($vanticipo, 2, ",", ".")  ,0,1, "R");
            
            $k+=$space;
            $k+=$space;
        }
    }

    $pdf->SetXY($x + 98, $y + $k);

    $k+=$space;
    if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
        $pdf->line($x + 125+$aumentox, $y + $k, $x + 150+$aumentox, $y + $k);

    $pdf->line($x + 150+$aumentox, $y + $k, $x + 175+$aumentox, $y + $k);
    $k+=$space;

    $pdf->SetXY($x+93.6+$aumentox,$y+$k);
    $pdf->Cell(0, 4, "TOTAL A PAGAR...." ,0,1, "L");

    $txt=($totales["local"]+ (($datos->iva-$datos->rteica-$datos->rteiva-$datos->rtefuente)*$tcambio))-$vanticipoCop;
    if($comprobante->getCaIdmoneda()!="COP" && $tipoImpresion=="EP")
    {
        $pdf->SetXY($x+$aumentox,$y+$k);
        $pdf->Cell(150, 4, number_format($totales["mext"]+(( $datos->iva-$datos->rteica-$datos->rteiva-$datos->rtefuente))-$vanticipo , 2, ",", ".")  ,0,1, "R");
        $txt=number_format( round($txt) , 0, ",", ".");
    }
    else if($tipoImpresion=="E")
        $txt=number_format( round($totales["mext"]+(( $datos->iva-$datos->rteica-$datos->rteiva-$datos->rtefuente))-$vanticipo,2) , 2, ",", ".");

    else
        $txt=number_format( round($txt) , 0, ",", ".");

    $pdf->SetXY($x+$aumentox,$y+$k);
    $pdf->Cell(175, 4, $txt  ,0,1, "R");
    $k+=$space;

    $y+=100+$space;

    $pdf->Rect($x,$y,175+$aumentox,10);
    $pdf->SetXY($x+4,$y-1);

    $txt=round(($totales["mext"]+(( $datos->iva-$datos->rteica-$datos->rteiva-$datos->rtefuente))-$vanticipo),2);
    if($tipoImpresion=="P")
    {
        $txt= round( ($totales["local"]+(( $datos->iva-$datos->rteica-$datos->rteiva-$datos->rtefuente)*$tcambio)-$vanticipoCop),0);
    }
    $pdf->MultiCell(0, 4, "SON: ". strtoupper(num2letras(number_format($txt, 2, '.', '') , false, true )) ." ".($tipoImpresion=="P"?"PESOS":$comprobante->getCaIdmoneda()) . (($comprobante->getCaIdmoneda()=="COP" || $tipoImpresion=="P")?" M/CTE":"") ,0,1, "C");
    $space = 2;
    $y+=10;
    $pdf->Rect($x,$y,175+$aumentox,10);
    $pdf->SetXY($x+5,$y);

    if($sucursal->getEmpresa()->getCaIdempresa()=="12")
        $txt="OBSERVACIONES:\n".$comprobante->getProperty("anexos");
    else
        $txt="ANEXOS:\n".$comprobante->getProperty("anexos");

    $pdf->MultiCell(0, 4, $txt ,0,1, "C");
    $pdf->SetFont($font, '', 6);

    $y+=10;
    $pdf->Rect($x,$y,175+$aumentox,15);
    $pdf->SetXY($x+5,$y);
    $pdf->MultiCell(0, 4, $tipo->getCaMensaje() ,0,1, "C");

    $y+=16;
    $pdf->SetXY($x+12,$y);
    $datostmp= json_decode($tipo->getCaDatos());
    $pdf->Cell(0, 3, "Numeración según Resolución DIAN ".$tipo->getCaNoautorizacion()."  ".Utils::parseDate($tipo->getCaFchautorizacion(),"Y/m/d")." ".$datostmp->prefijo." ".$tipo->getCaInicialAut()." AL ".$tipo->getCaFinalAut()." FACTURA POR COMPUTADOR. ".$datostmp->vigencia  ,0,1, "L"); 

    $datostmp = ParametroTable::retrieveByCaso("CU234",$sucursal->getCaIdempresa());
    foreach ($datostmp as $d) {
        $datosMensajes[$d->getCaIdentificacion()]=$d->getCaValor2();
    }

    if($sucursal->getCaIdempresa()=="2")
        $y+=8;            
    else
        $y+=4;

    if(isset($datosMensajes[$sucursal->getCaIdempresa()."1"]))
    {
        $pdf->SetRightMargin(55);
        $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."1"])/100))*3);
        $pdf->SetXY($x+2,$y);
        $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."1"] );
        $y+=(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."1"])/100))*3;
    }

    if(isset($datosMensajes[$sucursal->getCaIdempresa()."2"]))
    {
        $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."2"])/100))*3);
        $pdf->SetXY($x+2,$y);
        $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."2"] );
        $y+=(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."2"])/100))*3;
    }

    if(isset($datosMensajes[$sucursal->getCaIdempresa()."3"]))
    {
        $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."3"])/100))*3);
        $pdf->SetXY($x+2,$y);
        $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."3"] );
        $y+=(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."3"])/100))*3;
    }

    if(isset($datosMensajes[$sucursal->getCaIdempresa()."4"]))
    {
        $pdf->Rect($x,$y,140+$aumentox,(ceil(strlen($datosMensajes[$sucursal->getCaIdempresa()."4"])/100))*4);
        $pdf->SetXY($x+2,$y);
        $pdf->MultiCell(0, 3, $datosMensajes[$sucursal->getCaIdempresa()."4"]  );
    }

    $pdf->SetRightMargin(12);

    if($sucursal->getCaIdempresa()=="2")
    {
        $y-=17;
    }
    else {
        $y-=30;
    }
    $pdf->SetXY($x+140+$aumentox,$y);
    $pdf->Cell(0, 4, "___________________________"  ,0,1, "L");
    $y+=2;
    $pdf->SetXY($x+142+$aumentox,$y);
    $pdf->Cell(0, 4, $sucursal->getEmpresa()->getCaNombre()  ,0,1, "L");


    $y+=14;
    $pdf->SetXY($x+140+$aumentox,$y);
    $pdf->Cell(0, 4, "___________________________"  ,0,1, "L");
    $y+=3;
    $pdf->SetXY($x+148+$aumentox,$y);
    $pdf->Cell(0, 4, "FIRMA RECIBIDO "  ,0,1, "L");

    $y+=8;
    $pdf->SetXY($x+140+$aumentox,$y);
    $pdf->Cell(0, 4, "___________________________"  ,0,1, "L");
    $y+=3;
    $pdf->SetXY($x+148+$aumentox,$y);
    $pdf->Cell(0, 4, "FECHA RECIBIDO "  ,0,1, "L");
}

$digref= substr($ca_referencia, 0,1);
if($trd=="1" && $comprobante->getCaEstado()=="5" && ( $digref=="4"||$digref=="5" || $digref=="6" || $digref=="8" || $digref=="1" || $digref=="3" ) )
{
    $ref1=$inoMaestra->getCaReferencia();
    $ref2=$inoCliente->getCaDoctransporte();
    $impoexpo = $inoMaestra->getCaImpoexpo();    
    $datosMaster = json_decode($inoMaestra->getCaDatos());
    $transporte = $inoMaestra->getCaTransporte();
    
    if((($impoexpo == Constantes::IMPO || $impoexpo == Constantes::TRIANGULACION) && $transporte== Constantes::MARITIMO) || ($impoexpo == Constantes::OTMDTA && $transporte == Constantes::TERRESTRE && $datosMaster->idempresa == 2))
        $iddoc = 7;
    else if(($impoexpo == Constantes::IMPO || $impoexpo == Constantes::TRIANGULACION) && $transporte == Constantes::AEREO)
        $iddoc = 58;
    else if($impoexpo == Constantes::EXPO)
        $iddoc = 59;        
        
    $tipDoc = Doctrine::getTable("TipoDocumental")->find($iddoc);
    
    $path="";
    $folder = $tipDoc->getCaDirectorio();
    if ($ref1)
        $path.=$ref1 . DIRECTORY_SEPARATOR;
    if ($ref2)
        $path.=$ref2 . DIRECTORY_SEPARATOR;

    $directory = sfConfig::get('app_digitalFile_root') . date("Y") . DIRECTORY_SEPARATOR . $folder . $path;
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    chmod($directory, 0777);
        
    $fileName = $tipo->getCaTipo().$tipo->getCaComprobante()."-".$comprobante->getCaConsecutivo()."(".$tipoImpresion.$orden.$idioma.").pdf";

    $mime = "application/pdf";
    $size = -1;

    $existe=true;
    $con=0;

    if(! file_exists($directory . $fileName) )
    {
        $datos = array();
        $datos["idcomprobante"] = $comprobante->getCaIdcomprobante();
        
        $archivo = new Archivos();
        $archivo->setCaIddocumental($iddoc);
        $archivo->setCaNombre($fileName);
        $archivo->setCaMime($mime);
        $archivo->setCaSize($size);
        $archivo->setCaPath($directory . DIRECTORY_SEPARATOR . $fileName);
        $archivo->setCaRef1($inoMaestra->getCaReferencia());
        $archivo->setCaRef2($inoCliente->getCaDoctransporte());
        if($comprobante->getCaEstado()==8)
            $archivo->setCaRef3("Anulado");
        $archivo->setCaDatos(json_encode($datos));
        $archivo->save();

        $filename= $directory . $fileName;
        $pdf->Output ( $filename );
    }
    else
    {
        $filename= $directory . $fileName;
        $pdf->Output ( $filename );        
    }
}
$filename="";
$pdf->Output ( $filename , "I");
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}
?>