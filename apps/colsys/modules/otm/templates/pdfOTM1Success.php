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

class MYPDF extends TCPDF {
    
    private $txtFooter="";
    
     public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        //$img_file = K_PATH_IMAGES.'image_demo.jpg';
        //$img_file = '/srv/www/colsys_sf3/web/colsys/images/logos/form-660.jpg';//cambio maqr 2016-07-25
        //$this->Image($img_file, 0, 0, 210, 280, '', '', '', false, 300, '', false, false, 0);//cambio maqr 2016-07-25
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
    public function setTxtFooter($txt)
    {
        $this->txtFooter=$txt;
    }
    
    public function Footer() {
		$cur_y = -7;//$this->y;
		$this->SetTextColor(0, 0, 0);
        $this->SetFont("arial", '', 8);
		//set style for cell border
		//$line_width = 0.85 / $this->k;
		//$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		//print document barcode
		//$barcode = $this->getBarcode();
		/*if (!empty($barcode)) {
			$this->Ln($line_width);
			$barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
			$style = array(
				'position' => $this->rtl?'R':'L',
				'align' => $this->rtl?'R':'L',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => '',
				'border' => false,
				'padding' => 0,
				'fgcolor' => array(0,0,0),
				'bgcolor' => false,
				'text' => false
			);
			$this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
		}*/
		/*if (empty($this->pagegroups)) {
			$pagenumtxt = $this->l['w_page'].' '.$this->getAliasNumPage().' / '.$this->getAliasNbPages();
		} else {
			$pagenumtxt = $this->l['w_page'].' '.$this->getPageNumGroupAlias().' / '.$this->getPageGroupAlias();
		}*/
		$this->SetY($cur_y);
		//Print page number
		
        $this->SetX($this->original_rMargin+5);
        $this->Cell(0, 0,  $this->txtFooter, 0, 0, 'L');
	}
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
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
    $fontsize=9;
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
$pdf->setPrintFooter(true);
//$pdf->setFooterMargin(1);
//$pdf->setPrintHeader(false);

//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont($fontname, '', $fontsize);


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

$pdf->AddPage('', '',true);

/*$txt=date("Y");
$pdf->setFontSpacing(2);
$pdf->MultiCell(55, 10, strtoupper($txt), 0, 'L', 0, 1, $x+12, $y-19);
$pdf->setFontSpacing(1.8);
*/

/*$pdf->SetFont($fontname, '', $fontsize+3);
$txt=$repotm->getConsecutivoCvAll();
//$pdf->setFontSpacing(2);
$pdf->MultiCell(200, 10, strtoupper($txt), 0, 'L', 0, 1, $x+112, $y-10);
$pdf->setFontSpacing(1.8);

$pdf->SetFont($fontname, '', $fontsize);
*/


$y=$y+3;
$x=13;

//casilla 5-10
$y=$y+15;

//$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
//$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);

//$txt=$cliente->getCaDigito();
//$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+52, $y);

$pdf->setFontSpacing($fontspacing);
//$txt=sprintf ("%30s %30s %30s %30s","Yepes","","Sandra", "Pepita" );
$txt="";
//$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+42, $y);

/*if($cliente->getProperty("tipopersona")=="1")
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
}*/


//casilla 11
$y=$y+9;
/*if($cliente->getProperty("tipopersona")!="1")
    $txt=utf8_encode($cliente->getCaCompania());
else*/
    $txt="";

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);

$pdf->setFontSpacing($spacing);

$y=$y+9;


//casilla 24-26

$txt="900451936";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+15, $y);

$txt="8";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+55, $y);

//$pdf->MultiCell(55, 5, "2012", 1, 'L', 1, 0, '', '', true);

$pdf->setFontSpacing($fontspacing);
$txt="COL OTM S.A.S.";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+60, $y);

//casilla 27
$txt="035-12";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+164, $y);

//casilla 28
$txt="645";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+186, $y);

$y=$y+8;
$pdf->setFontSpacing($spacing);
$trans2=Constantes::MARITIMO;
switch($reporte->getOrigen()->getCaCiudad())
{
    case "Cartagena":
    case "Santa Marta":
        $representante["cedula"]="73569889";
        $representante["nombre1"]="CARLOS";
        $representante["nombre2"]="ALFONSO";
        $representante["apellido1"]=utf8_encode("BOLAÑO");
        $representante["apellido2"]="MELENDEZ";
    break;
    case "Buenaventura":
        $representante["cedula"]="67006136";
        $representante["nombre1"]="SANTOS";
        $representante["nombre2"]="MABEL";
        $representante["apellido1"]=utf8_encode("TUFIÑO");
        $representante["apellido2"]="PALACIOS";
    break;
    case "Bogotá":
    case "Bogota":
    case "Bogotá D.C.":
        $trans2=Constantes::AEREO;
        $representante["cedula"]="52556478";
        $representante["nombre1"]="SANDRA";
        $representante["nombre2"]="LUCIA";
        $representante["apellido1"]=utf8_encode("YEPES");
        $representante["apellido2"]=utf8_encode("LEON");
    break;
}
/*$representante["cedula"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"73569889":"67006136";
$representante["nombre1"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"CARLOS":"SANTOS";
$representante["nombre2"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"ALFONSO":"MABEL";
$representante["apellido1"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?utf8_encode("BOLAÑO"):utf8_encode("TUFIÑO");
$representante["apellido2"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"MELENDEZ":"PALACIOS";
*/

//casilla 29-34
$txt=$representante["cedula"];//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
//$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x-1, $y);//cambio maqr 2016-07-22
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+15, $y);

$txt="";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+55, $y);

$pdf->setFontSpacing($fontspacing);
//$txt=sprintf ("%30s %30s %30s %30s",$representante["apellido1"],$representante["apellido2"],$representante["nombre1"],$representante["nombre2"] );
$txt=$representante["apellido1"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+60, $y);

$txt=$representante["apellido2"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+94, $y);

$txt=$representante["nombre1"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+128, $y);

$txt=$representante["nombre2"];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+165, $y);


$proveedor=$repotm->getIdsProveedor();
$transportador=$proveedor->getIds();
if(!$transportador)
    $transportador=new Ids ();

//casilla 35
$y=$y+8;
$pdf->setFontSpacing($spacing);
$txt=$repotm->getIdsProveedor()->getIds()->getCaIdalterno();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+15, $y);


$txt=$transportador->getCaDv();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+55, $y);
//$reporte

//casilla 37
$pdf->setFontSpacing($fontspacing);
$txt=$transportador->getCaNombre();
//$txt="INTERANDINA DE TRANSPORTES S.A. INANTRA";
$pdf->MultiCell(500, 10, utf8_encode(strtoupper($txt)), 0, 'L', 0, 1, $x+65, $y);

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
    case "860062581"://UNION ANDINA DE TRANSPORTES S.A. 
        $txt="403";
        break;
    case "805000977"://TRANSCARGA RG SAS. 
        $txt="371";
        break;
    case "800149351"://TRANSPORTES INVERSIONES MARTINEZ R E HIJOS SAS 
        $txt="637";
        break;
    case "800104891"://TRANSPORTES VAN DE LEUR TRADING SAS. 
        $txt="567";
        break;
    case "860534357"://PROCAM SA
        $txt="437";
        break;
    case "800148756"://TRANSPORTE LODISCARGA
        $txt="653";
        break;
    case "890904713"://Tcoordinadora
        $txt="454";
        break;
    case "900416879"://conalca
        $txt="651";
        break;
    case "805010341":
        $txt="622";
        break;
    case "811033031":
        $txt="690";
        break;
    case "900055029":
        $txt="665";
        break;
    case "830144803":
        $txt="396";
        break;
    case "805021657"://movitrans sas
        $txt="761";
        break;
    case "800046457":
        $txt="642";
        break;
    case "800038129":
        $txt="318";
        break;
    default:
        $txt="146";
}

//casilla 38
//$txt="146";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+185, $y);

//casilla 39
//garantia
$pdf->setFontSpacing($fontspacing);
$y=$y+5;

$txt="1";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+25, $y);//cambio maqr 2016-07-22

//casilla 40
$txt="2";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+56, $y);

//casilla 41
$txt="31 DL 015566";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+72, $y);

//casilla 42
$txt=  number_format("1378910000");
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+121, $y);

//casilla 43
$txt=  "2019";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+163, $y);

$txt=  "02";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+175, $y);

$txt=  "25";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+183, $y);

$y=$y+8;
//datos de la operacion


if($trans2==Constantes::AEREO)
{
//casilla 45
$txt="X";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+35, $y);
}
else
{
//casilla 44
$txt="X";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+18, $y);

}

//casilla 46
$txt="X";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+56, $y);

//$reporte = new Reporte();

//casilla 48
$txt=  utf8_encode($repotm->getOrigenimp()->getCaCiudad());

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+85, $y);
//casilla 49

$txt=  $repotm->getProperty("placa");
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+132, $y);

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


$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+12, $y);

//casilla 51
$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $reporte->getCaDestino() );
$des_ori=$c->fetchOne();
if($des_ori)
    $txt=$des_ori->getCaIdentificacion();
else
    $txt="";

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+34, $y);

//casilla 52
$txt=$repotm->getCaManifiesto();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+54, $y);

//casilla 53
$fechaArribo = explode("-",$repotm->getCaFcharribo());
//$txt=$fechaArribo[0]." ".$fechaArribo[1]." ".$fechaArribo[2];
//$txt=sprintf ("%4s %5s %6s",$fechaArribo[0],$fechaArribo[1],$fechaArribo[2]);
$txt=$fechaArribo[0];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+97, $y);

$txt=$fechaArribo[1];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+110, $y);

$txt=$fechaArribo[2];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+117, $y);

//casilla 54
$txt=$repotm->getCaHbls();
$pdf->SetFont($fontname, '', $fontsize-2);
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+126, $y);
$pdf->SetFont($fontname, '', $fontsize);
//casilla 55
$fechaArribo = explode("-",$repotm->getCaFchdoctransporte());

$txt=$fechaArribo[0];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+170, $y-1);//94

$txt=$fechaArribo[1];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+182, $y-1);//106

$txt=$fechaArribo[2];
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+190, $y-1);


//casilla 56
$adudestino = $repotm->getProperty("adudestino")?"/".$repotm->getProperty("adudestino"):"";
$pdf->setFontSpacing($spacing1-0.1);
$pdf->SetFont($fontname, '', $fontsize-1);
$txt1=trim(utf8_encode($reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo().$adudestino));
$tam=  strlen($txt1);
//$txt1=$tam.$txt1;
if($tam>75)
{
    $sumy=$y+8;    
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
else if($tam>62)
{
    $sumy=$y+8;
    //$txt=  substr($txt1, 0,58)."\n".substr($txt1, 58,$tam-58);
    $txt=$txt1;
    $pdf->SetFont($fontname, '', $fontsize-2);
}
else if($tam>52)
{
    $sumy=$y+7;
    //$txt=  substr($txt1, 0,58)."\n".substr($txt1, 58,$tam-58);
    $txt=$txt1;
    $pdf->SetFont($fontname, '', $fontsize-2);
}else
{
    $sumy=$y+7;
    $txt=$txt1;
}

$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x, $sumy);
$pdf->SetFont($fontname, '', $fontsize);
$pdf->setFontSpacing($fontspacing);
$y=$y+8;
/*if($reporte->getBodega()->getCaTipo()=="Zona Franca Bogota SA")
    $txt="13907";
else
    $txt="";
*/
//casilla 57
$txt=$reporte->getBodega()->getCaCodDian();
//$txt = 2005;
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+111, $y);

//casilla 58
$txt=$repotm->getCaValorfob();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+125, $y);

//casilla 59
$txt=$repotm->getOrigenimp()->getTrafico()->getCaCodDian();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+165, $y);

//casilla 60
$txt=$repotm->getCaNumpiezas();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+183, $y);


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

//casilla 61
$y=$y+8;

if($reporte->getCaModalidad()=="LCL")
    $txt="CARGA SUELTA";
else
    $txt=$repotm->getCaContenedor();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x, $y);

//casilla 62
$txt="S";
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+51, $y);


$txt=$repotm->getCaPeso();
$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+125, $y);

$y=$y+7;

if($reporte->getCaModalidad()=="LCL")
    $txt1="LCL/LCL";
else
    $txt1="FCL/FCL";
$pdf->SetFont($fontname, '', $fontsize-2);

//$txt1=trim(utf8_encode($reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo()));
//$tam=  strlen($txt1);
$txt1 = utf8_encode($txt1.". Dice Contener:  ".($reporte->getCaMercanciaDesc()).".  \nDTM:".$repotm->getCaConsecutivo());
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


$pdf->MultiCell(500, 10, strtoupper($txt), 0, 'L', 0, 1, $x+3, $y);
$pdf->SetFont($fontname, '', $fontsize);



//Close and output PDF document
$pdf->Output('documento.pdf', 'I');
       exit;
?>