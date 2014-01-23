<?
$reporte = $sf_data->getRaw("reporte");
$iduser = $sf_data->getRaw("iduser");

$cliente=$reporte->getCliente("continuacion");
$repotm=$reporte->getRepOtm();        
        
$stretching=100;
$spacing=1.8;
//style="font-stretch:<?=$stretching %;letter-spacing:<?=$spacing mm;"
$spacing=2;

$y=45;
$x=5;

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
//if( $iduser=="alramirez" || $iduser=="maquinche"  )
{
    //echo "<pre>";print_r($_SERVER);echo "</pre>";
    //$fontname = $pdf->addTTFfont($_SERVER["DOCUMENT_ROOT"].'/fonts/arial.ttf', 'TrueType', 'iso-8859-1', 32);    
    //$fontname="freemonob";
    //$fontname="helvetica";
    //$fontname="courier";
    
    $fontname="dejavusans";
    $fontname="freesans";
    $fontname="pdfhelvetica";
    //$fontname="pdftimes";
    $fontname="tahoma";
    $fontname="freeserefi";
    $fontname="uni2cid_ac15";
    $fontname="kozminproregular";
    $fontname="dejavuserif";
    $fontname="dejavusans";
    
    $y=41;
    
    //$fontname="arial";
    $fontsize=11;
    //$fontspacing=-0.7;
    //$fontspacing1=-1;
    //$pdf->setFontStretching(70);
    //$fontstretching= $pdf->getFontStretching();
    //$fontstretching=0;
}    
/*else if( $iduser=="jcastellanos" || $iduser=="ajsanchez" || $iduser=="cfhidalgo"  )
{
    $fontname="arialb";
    $fontsize=10;
}
else
{

    $fontname="arialb";
    $fontsize=10;
}*/

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Coltrans');
$pdf->SetMargins(1, 1, 1,true);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);
//$pdf->Footer();
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont($fontname, '', $fontsize);


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

$pdf->AddPage('', '',true);

$txt=date("Y");
$pdf->setFontSpacing(2);
$pdf->MultiCell(55, 10, strtoupper($txt), 0, 'L', 0, 1, $x-2, $y-10);
$pdf->setFontSpacing(1.9);

$y=$y+3;
$x=1;
/*$y=$y+16;
//casillas 5 - 6
$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x, $y);

$txt=$cliente->getCaDigito();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+56, $y);


$y=$y+8;
//casillas 11
$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x, $y);
*/

//$y=$y+8;

//casilla 5-10
$y=$y+28;

$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);

$txt=$cliente->getCaDigito();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+52, $y);

$pdf->setFontSpacing($fontspacing);
//$txt=sprintf ("%30s %30s %30s %30s","Yepes","","Sandra", "Pepita" );
$txt="";
//$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+42, $y);

if($cliente->getProperty("tipopersona")=="1")
{
    $pdf->setFontSpacing($fontspacing);
    //$txt=sprintf ("%30s %30s %30s %30s",$representante["apellido1"],$representante["apellido2"],$representante["nombre1"],$representante["nombre2"] );
    $txt=$cliente->getProperty("apellido1");
    $pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+60, $y);

    $txt=$cliente->getProperty("apellido2");
    $pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+94, $y);

    $txt=$cliente->getProperty("nombre1");
    $pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+130, $y);

    $txt=$cliente->getProperty("nombre2");
    $pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+172, $y);
}


//casilla 11
$y=$y+8;
if($cliente->getProperty("tipopersona")=="2")
    $txt=utf8_encode($cliente->getCaCompania());
else
    $txt="";

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);

$pdf->setFontSpacing($spacing);

$y=$y+10;


//casilla 24-26
$txt="900451936";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);

$txt="8";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+52, $y);

//$pdf->MultiCell(55, 5, "2012", 1, 'L', 1, 0, '', '', true);

$pdf->setFontSpacing($fontspacing);
$txt="COL OTM S.A.S.";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+60, $y);

$txt="035-12";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+172, $y);

$txt="645";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+191, $y);

$y=$y+9;
$pdf->setFontSpacing($spacing);

$representante["cedula"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"73569889":"67006136";
$representante["nombre1"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"CARLOS":"SANTOS";
$representante["nombre2"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"ALFONSO":"MABEL";
$representante["apellido1"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?utf8_encode("BOLAÑO"):utf8_encode("TUFIÑO");
$representante["apellido2"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"MELENDEZ":"PALACIOS";

$txt=$representante["cedula"];//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);

$txt="";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+52, $y);

$pdf->setFontSpacing($fontspacing);
//$txt=sprintf ("%30s %30s %30s %30s",$representante["apellido1"],$representante["apellido2"],$representante["nombre1"],$representante["nombre2"] );
$txt=$representante["apellido1"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+60, $y);

$txt=$representante["apellido2"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+94, $y);

$txt=$representante["nombre1"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+130, $y);

$txt=$representante["nombre2"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+172, $y);


$proveedor=$repotm->getIdsProveedor();
$transportador=$proveedor->getIds();
if(!$transportador)
    $transportador=new Ids ();


$y=$y+8;
$pdf->setFontSpacing($spacing);
$txt=$repotm->getIdsProveedor()->getIds()->getCaIdalterno();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);

$txt=$transportador->getCaDv();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+52, $y);
//$reporte
$pdf->setFontSpacing($fontspacing);
$txt=$transportador->getCaNombre();
//$txt="INTERANDINA DE TRANSPORTES S.A. INANTRA";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+65, $y);

switch($repotm->getIdsProveedor()->getIds()->getCaIdalterno())
{
    case "890904488"://TDM TRANSPORTE S.A.
        $txt="053";
        break;
    case "800238072":
        $txt="314";
        break;
    case "860016819"://PROVEEDOR Y SERCARGA S.A
        $txt="051";
        break;
    case "890901321"://eduardo botero soto
        $txt="219";
        break;
    case "800092024"://tanques del nordeste
        $txt="424";
        break;
    case "860062581"://UNION ANDINA DE TRANSPORTES S.A. <- Cochinadas a Nombre de Maquinche
        $txt="403";
        break;
    case "805000977"://TRANSCARGA RG SAS. <- Cochinadas a Nombre de Maquinche
        $txt="371";
        break;
    case "800149351"://TRANSPORTES INVERSIONES MARTINEZ R E HIJOS SAS <- Cochinadas a Nombre de Maquinche
        $txt="637";
        break;
    case "800104891"://TRANSPORTES VAN DE LEUR TRADING SAS. <- Cochinadas a Nombre de Maquinche
        $txt="567";
        break;
    default:
        $txt="146";
}

//$txt="146";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+191, $y);

//garantia
$pdf->setFontSpacing($fontspacing);
$y=$y+6;

$txt="1";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+20, $y);

$txt="2";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+46, $y);

$txt="31 DL 011 420";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+72, $y);

//casilla 42
$txt=  number_format("1179000000");
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+121, $y);

//casilla 43
$txt=  "2014";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+174, $y);

$txt=  "08";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+186, $y);

$txt=  "22";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+194, $y);

$y=$y+8;
//datos de la operacion
//casilla 44
$txt="X";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+12, $y);
//casilla 46
$txt="X";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+50, $y);

//$reporte = new Reporte();

$txt=  utf8_encode($repotm->getOrigenimp()->getCaCiudad());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+83, $y);

//$reporte=new Reporte();
$y=$y+9;
//$aduana = ParametroTable::retrieveByCaso("CU111", null, $reporte->getCaOrigen() );

//casilla 50
$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $reporte->getCaOrigen() );
$adu_ori=$c->fetchOne();
if($adu_ori)
    $txt=$adu_ori->getCaIdentificacion();
else
    $txt="";


$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+10, $y);

//casilla 51
$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $reporte->getCaDestino() );
$des_ori=$c->fetchOne();
if($des_ori)
    $txt=$des_ori->getCaIdentificacion();
else
    $txt="";

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+32, $y);

//casilla 52
$txt=$repotm->getCaManifiesto();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+54, $y);

//casilla 53
$fechaArribo = explode("-",$repotm->getCaFcharribo());
//$txt=$fechaArribo[0]." ".$fechaArribo[1]." ".$fechaArribo[2];
//$txt=sprintf ("%4s %5s %6s",$fechaArribo[0],$fechaArribo[1],$fechaArribo[2]);
$txt=$fechaArribo[0];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+94, $y);

$txt=$fechaArribo[1];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+106, $y);

$txt=$fechaArribo[2];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+113, $y);

//casilla 54
$txt=$repotm->getCaHbls();
$pdf->SetFont($fontname, '', $fontsize-1);
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+130, $y);
$pdf->SetFont($fontname, '', $fontsize);
//casilla 55
$fechaArribo = explode("-",$repotm->getCaFchdoctransporte());

$txt=$fechaArribo[0];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+174, $y);//94

$txt=$fechaArribo[1];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+186, $y);//106

$txt=$fechaArribo[2];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+194, $y);


//casilla 56
$adudestino = $repotm->getProperty("adudestino")?"/".$repotm->getProperty("adudestino"):"";
$pdf->setFontSpacing($fontspacing1);
$pdf->SetFont($fontname, '', $fontsize-1);
$txt1=trim(utf8_encode($reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo().$adudestino));
$tam=  strlen($txt1);
//$txt1=$tam.$txt1;
if($tam>56)
{
    $sumy=$y+9;
/*    $txt1=trim(utf8_encode($reporte->getBodega()->getCaNombre()."\n/".$reporte->getBodega()->getCaTipo()));
    $arrtxt=  explode(" ", $txt1);
    $salto=false;
    for($i_tmp=0;$i_tmp<count($arrtxt);$i_tmp++)
    {
        if($i > (count($arrtxt)/2))
        {
            $salto=true;
            $txt.="\n";
        }
        $txt.=$arrtxt[$i_tmp]." ";
    }
 * */
    
    $txt1=trim(utf8_encode($reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo().$adudestino));
    $arrtxt=  explode(" ", $txt1);
    //$txt=(count($arrtxt)/2)." ";
    $txt="";
    $salto=false;
    for($i_tmp=0;$i_tmp<count($arrtxt);$i_tmp++)
    {
        if(!$salto)
        {
            if($i_tmp > (count($arrtxt)/2))
            {
                $salto=true;
                $txt.="\n";
                $sumy=$sumy-2;
            }
        }
        $txt.=$arrtxt[$i_tmp]." ";
    }

    
    //$txt=$txt1;
    $pdf->SetFont($fontname, '', $fontsize-3);
}
else if($tam>50)
{
    $sumy=$y+9;
    //$txt=  substr($txt1, 0,58)."\n".substr($txt1, 58,$tam-58);
    $txt=$txt1;
    $pdf->SetFont($fontname, '', $fontsize-2);
}
else if($tam>45)
{
    $sumy=$y+9;
    //$txt=  substr($txt1, 0,58)."\n".substr($txt1, 58,$tam-58);
    $txt=$txt1;
    $pdf->SetFont($fontname, '', $fontsize-1);
}else
{
    $sumy=$y+9;
    $txt=$txt1;
}

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x, $sumy);
$pdf->SetFont($fontname, '', $fontsize);
$pdf->setFontSpacing($fontspacing);
$y=$y+9;
/*if($reporte->getBodega()->getCaTipo()=="Zona Franca Bogota SA")
    $txt="13907";
else
    $txt="";
*/
//casilla 57
$txt=$reporte->getBodega()->getCaCodDian();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+112, $y);

//casilla 58
$txt=$repotm->getCaValorfob();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+140, $y);

//casilla 59
$txt=$repotm->getOrigenimp()->getTrafico()->getCaCodDian();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+172, $y);

//casilla 60
$txt=$repotm->getCaNumpiezas();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+188, $y);


//$ciu_ori = ParametroTable::retrieveByCaso("CU111", null, $repotm->getOrigenimp() );
/*$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $repotm->getOrigenimp() );
$ciu_ori=$c->fetchOne();
if($ciu_ori)
    $txt=$ciu_ori->getCaIdentificacion();
else
    $txt="";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+170, $y);
*/
//retrieveByCaso( $casoUso, $valor1=null, $valor2=null, $id=null ){
//$reporte->getBodega()->getCaNombre()

$y=$y+9;

if($reporte->getCaModalidad()=="LCL")
    $txt="CARGA SUELTA";
else
    $txt=$repotm->getCaContenedor();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x, $y);

$txt="S";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+48, $y);


$txt=$repotm->getCaPeso();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+142, $y);

$y=$y+9;

if($reporte->getCaModalidad()=="LCL")
    $txt1="LCL/LCL";
else
    $txt1="FCL/FCL";
$pdf->SetFont($fontname, '', $fontsize-2);

//$txt1=trim(utf8_encode($reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo()));
//$tam=  strlen($txt1);
$txt1 = utf8_encode($txt1.". Dice Contener:  ".($reporte->getCaMercanciaDesc()).".  \nDTM:".$repotm->getConsecutivoDtm());
$tam=  strlen($txt1);
$div=1;
if(strpos($txt1,"\n" )===false)
{
    if($tam>330)
    {
        $arrtxt=  explode(" ", $txt1);    
        $txt="";
        $salto=false;
        for($i_tmp=0;$i_tmp<count($arrtxt);$i_tmp++)
        {
            if(!$salto)
            {
                if($i_tmp > ((count($arrtxt)/(4))*$div))
                {
                    $salto=true;
                    $txt.="\n";
                    $div++;
                }
            }
            $txt.=$arrtxt[$i_tmp]." ";
        }
    }
    else if($tam>220)
    {

        $arrtxt=  explode(" ", $txt1);    
        $txt="";
        $salto=false;
        for($i_tmp=0;$i_tmp<count($arrtxt);$i_tmp++)
        {
            if(!$salto)
            {
                if($i_tmp > ((count($arrtxt)/(3))*$div))
                {
                    $salto=true;
                    $txt.="\n";
                    $div++;
                }
            }
            $txt.=$arrtxt[$i_tmp]." ";
            $salto=false;
        }    
    }else if($tam>110)
    {

        $arrtxt=  explode(" ", $txt1);    
        $txt="";
        $salto=false;
        for($i_tmp=0;$i_tmp<count($arrtxt);$i_tmp++)
        {
            if(!$salto)
            {
                if($i_tmp > (count($arrtxt)/(2)*$div ))
                {
                    $salto=true;
                    $txt.="\n";
                    $div++;
                }
            }
            $txt.=$arrtxt[$i_tmp]." ";
        }
    }
    else
        $txt=$txt1;
}
else
    $txt=$txt1;

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x, $y);
$pdf->SetFont($fontname, '', $fontsize);

// reset pointer to the last page
//$pdf->lastPage();

//Close and output PDF document
$pdf->Output('documento.pdf', 'I');
       exit;
?>
