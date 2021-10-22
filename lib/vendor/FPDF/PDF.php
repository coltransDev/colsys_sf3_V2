<?
class PDF extends FPDF {

    //Variables para manejo de Tablas
    private $widths;
    private $height;
    private $aligns;
    private $borders;
    private $sucursal;
    private $footerSucursal;
    private $coltransFooter = false;
    private $coltransHeader = false;
    private $colmasFooter = false;
    private $colmasHeader = false;
    private $linerepeat;
    private $grouping = false;
    private $bufferGroup = array();
    var $angle=0;
    private $idempresa = 2;

    const COLTRANS = 2;
    const COLMAS = 1;
    const COLOTM = 8;
    const COLDEPOSITOS = 11;
    

    private $B;
    private $I;
    private $U;
    private $HREF;

    public function setIdempresa($v) {
        $this->idempresa = $v;
    }

    //Cabecera de página
    function Header() {
        //echo "--->".$this->empresa;

        if ($this->coltransHeader) {
            if ($this->idempresa == 7) {
                $image = "TPLogistics.jpg";
            } else if ($this->idempresa == 2) {
                $image = "ColtransSA.jpg";            
            } else if ($this->idempresa == 8) {
                $image = "colotm.jpg";
            }
            //Posición: a 1,6 cm del final
            $this->SetY(16);
            //Arial italic 8
            $this->SetFont('Arial', 'B', 10);
            //Line Repeat
            $this->Cell(0, 14, $this->linerepeat, 0, 0, 'L');
            //Logo

            $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $image, 18, 8, 63, 10, 'JPG');
            /* $this->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'20y.jpg', 170, 8, 18, 14, 'JPG'); */
            //Salto de línea
            $this->Ln(10);
        } else if ($this->colmasHeader) {
            if ($this->idempresa == 1) {
                $image = "Colmas.jpg";
            } else if ($this->idempresa == 11) {
                $image = "Coldepositos.jpg";
            }
            
            //Posición: a 1,6 cm del final
            $this->SetY(16);
            //Arial italic 8
            $this->SetFont('Arial', 'B', 10);
            //Line Repeat
            $this->Cell(0, 14, $this->linerepeat, 0, 0, 'L');
            //Logo

            $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $image, 18, 8, 63, 10, 'JPG');
            /* $this->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'20y.jpg', 170, 8, 18, 14, 'JPG'); */
            //Salto de línea
            $this->Ln(10);
        } else {
            $this->Ln(5);
        }
    }

    //Pie de página
    function Footer() {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);

        if ($this->coltransFooter) {            
            //Número de página
            $this->Cell(0, 14, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            if ($this->idempresa == 7) {
                $file = "pie_pagina_tplogistics.jpg";
                $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $file, 18, 270, 40, 16, 'JPG');
            } else if ($this->idempresa == 2){
                //echo $this->idempresa;
                $posx=18;
                $diffx=16;
                //echo "ddd";
                //print_r($this->footerSucursal);
                //exit();
                if(isset($this->footerSucursal["imagenes"]))
                {
                    foreach( $this->footerSucursal["imagenes"] as $im)
                    {
                        $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $im , $posx, 270, 16);
                        $posx=$posx+$diffx;
                    }
                }
                
                /*
                $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . "basc.jpg" , $posx, 270, 16 );
                $posx=$posx+$diffx;
                $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . "iata.jpg" , $posx, 270, 14 );                
                */
            } else {                
                $file = "pie_pagina.jpg";
                $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $file, 18, 270, 40, 16, 'JPG');
            }
            
            //Image($file,$x,$y,$w,$h=0,$type='',$link='')
            


            if (!strlen(trim($this->sucursal)) == 0) {
                //$this->GetX();
                $x=-55;
                $y=-29;
                $spacing=2.5;
                $width=2.5;
                $fontsize=8;

                $this->SetXY($x, $y);
                list($family, $style, $size) = explode(",", $this->GetStyle());
                $this->SetFont($family, 'B', $fontsize);
                $this->Cell(0,$width,$this->footerSucursal["datos"][0],0,0,'L');
                $y+=4;

                for( $i=1 ; $i<count($this->footerSucursal["datos"]) ; $i++)
                {
                    if($this->footerSucursal["datos"][$i]=="")
                        continue;
                    $this->SetFont($family, '', $fontsize);
                    $this->SetXY($x, $y);
                    $this->Cell(0,$width,$this->footerSucursal["datos"][$i],0,0,'L');
                    $y+=$spacing;
                }

            }
        }else if ($this->colmasFooter) {
            //Número de página
            $this->Cell(0, 14, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            $file = "pie_pagina_colmas.jpg";
            
            //$this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $file, 18, 270, 40, 23, 'JPG');
             $posx=18;
                $diffx=20;
                //echo "ddd";
                //print_r($this->footerSucursal);
                //exit();
                if(isset($this->footerSucursal["imagenes"]))
                {
                    foreach( $this->footerSucursal["imagenes"] as $im)
                    {
                        $this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $im , $posx, 270, 16);
                        $posx=$posx+$diffx;
                    }
                }
            if (!strlen(trim($this->sucursal)) == 0) {
                $x=-60;
                $y=-29;
                $spacing=2.5;
                $width=2.5;
                $fontsize=8;

                $this->SetXY($x, $y);
                list($family, $style, $size) = explode(",", $this->GetStyle());
                $this->SetFont($family, 'B', $fontsize);
                $this->Cell(0,$width,$this->footerSucursal["datos"][0],0,0,'L');
                $y+=4;

                for( $i=1 ; $i<count($this->footerSucursal["datos"]) ; $i++)
                {
                    if($this->footerSucursal["datos"][$i]=="")
                        continue;
                    $this->SetFont($family, '', $fontsize);
                    $this->SetXY($x, $y);
                    $this->Cell(0,$width,$this->footerSucursal["datos"][$i],0,0,'L');
                    $y+=$spacing;
                }
                //$this->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . 'Dir' . $this->sucursal . '_colmas.jpg', 160, 270, 40, 18, 'JPG');
            }
        }
    }

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetHeight($h) {
        //Set the array of column widths
        $this->height = $h;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function SetBorders($b) {
        //Set the array of column borders
        $this->borders = $b;
    }

    function SetFills($f) {
        //Set the array of column fills
        $this->fills = $f;
    }

    function SetStyles($s) {
        //Set the array of column styles
        $this->styles = $s;
    }

    /*
     * Calcula el espacio 
     */

    function GetRowHeight($data) {
        $nb = 0;
        $i = 0;
        foreach ($data as $value) {
            @$nb = max($nb, $this->NbLines($this->widths[$i], $value));
            $i++;
        }
        return ($this->height) * $nb;
    }

    function Row($data) {
        if (!$this->grouping) {
            //Calculate the height of the row			
            $h = $this->GetRowHeight($data);
            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            //Draw the cells of the row
            $fillColor = $this->GetAttrib('FillColor');
            $this->SetFillColor($this->hex2dec('#D2D2D2'));
            $textColor = $this->GetAttrib('TextColor');
            $this->SetTextColor(0);
            list($family, $style, $size) = explode(",", $this->GetStyle());
            $i = 0;
            foreach ($data as $value) {
                $w = $this->widths[$i];
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                $f = isset($this->fills[$i]) ? $this->fills[$i] : 0;
                $b = isset($this->borders[$i]) ? $this->borders[$i] : 0;
                $s = isset($this->styles[$i]) ? $this->styles[$i] : '';
                $this->SetFont($family, $s, $size);
                //Save the current position
                $x = $this->GetX();
                $y = $this->GetY();
                //Draw the border
                $this->Rect($x, $y, $w, $h);
                //Print the text
                $this->MultiCell($w, $this->height, $value, $b, $a, $f);
                //Put the position to the right of the cell
                $this->SetXY($x + $w, $y);
                $i++;
            }
            $this->SetFillColor($fillColor);
            $this->SetTextColor($textColor);
            $this->SetFont($family, $style, $size);
            //Go to the next line
            $this->Ln($h);
        } else {
            $k = count($this->bufferGroup);
            $this->bufferGroup[$k]["fn"] = "Row";
            $this->bufferGroup[$k]["style"] = $this->GetStyle();
            $this->bufferGroup[$k]["TextColor"] = $this->GetAttrib('TextColor');
            $this->bufferGroup[$k]["FillColor"] = $this->GetAttrib('FillColor');
            $this->bufferGroup[$k]["widths"] = $this->widths;
            $this->bufferGroup[$k]["aligns"] = $this->aligns;
            @$this->bufferGroup[$k]["fills"] = $this->fills;
            @$this->bufferGroup[$k]["borders"] = $this->borders;
            $this->bufferGroup[$k]["styles"] = $this->styles;
            $this->bufferGroup[$k]["data"] = $data;
        }
        //print_r($this->bufferGroup["borders"]);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                }
                else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function setLineRepeat($l) {
        //Set a line to repeat every page
        $this->linerepeat = $l;
    }

    function setSucursal($s) {
        //Set the name of the branch
        $this->sucursal = $s;
    }
    
    function SetFooterSucursal($s) {
        //Set the name of the branch
        $this->footerSucursal = $s;
    }
    
    

    function setColtransHeader($s) {
        $this->coltransHeader = $s;
    }

    function setColtransFooter($s) {
        $this->coltransFooter = $s;
    }

    function setColmasHeader($s) {
        $this->colmasHeader = $s;
    }

    function setColmasFooter($s) {
        $this->colmasFooter = $s;
    }

    /*
     * Sobrecarga la funcion Cell para almacenar en el buffer, en el caso que se este agrupando.  
     * @author: Andres Botero
     */

    function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = 0, $link = '') {
        if (!$this->grouping) {
            parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
        } else {
            $k = count($this->bufferGroup);
            $this->bufferGroup[$k]["fn"] = "Cell";
            $this->bufferGroup[$k]["w"] = $w;
            $this->bufferGroup[$k]["h"] = $h;
            $this->bufferGroup[$k]["txt"] = $txt;
            $this->bufferGroup[$k]["border"] = $border;
            $this->bufferGroup[$k]["ln"] = $ln;
            $this->bufferGroup[$k]["align"] = $align;
            $this->bufferGroup[$k]["fill"] = $fill;
            $this->bufferGroup[$k]["link"] = $link;
            $this->bufferGroup[$k]["style"] = $this->GetStyle();
            $this->bufferGroup[$k]["TextColor"] = $this->GetAttrib('TextColor');
            $this->bufferGroup[$k]["FillColor"] = $this->GetAttrib('FillColor');
        }
    }

    /*
     * Sobrecarga la funcion Cell para almacenar en el buffer, en el caso que se este agrupando.  
     * @author: Andres Botero
     */

    function Ln($h = '') {
        if (!$this->grouping) {
            parent::Ln($h);
        } else {
            $k = count($this->bufferGroup);
            $this->bufferGroup[$k]["fn"] = "Ln";
            $this->bufferGroup[$k]["h"] = $h;
        }
    }

    /*
     * Se asegura de agrupar el contenido en la misma pagina
     * @author: Andres Botero
     */

    function beginGroup() {
        $this->flushGroup();
        $this->grouping = true;
    }

    /*
     * Se asegura de agrupar el contenido en la misma pagina
     * @author: Andres Botero
     */

    function flushGroup() {
        //Se verifica el tamaño de cada grupo
        $this->grouping = false;
        $height = 0;

        for ($k = 0; $k < count($this->bufferGroup); $k++) {

            $fn = $this->bufferGroup[$k]["fn"];
            switch ($fn) {
                case "Row":
                    $height+=$this->GetRowHeight($this->bufferGroup[$k]['data']);
                    break;
                case "Cell":
                    $height+=$this->bufferGroup[$k]["h"];
                    break;
                case "Ln":
                    $height+=$this->bufferGroup[$k]["h"];
                    break;
            }
        }

        $break = false;
        //echo ($this->GetY()+$height)." ".$this->PageBreakTrigger." ";
        if ($this->GetY() + $height > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            $break = true;
        }

        for ($k = 0; $k < count($this->bufferGroup); $k++) {
            $fn = $this->bufferGroup[$k]["fn"];

            // Si se realiza un salto de pagina quita el primer espacio en blanco que se haya dejado
            if ($k == 0 && $break && $fn == "Ln") {
                continue;
            }


            switch ($fn) {
                case "Row":
                    $this->TextColor = $this->bufferGroup[$k]["TextColor"];
                    //$this->FillColor = $this->bufferGroup[$k]["FillColor"];
                    list($family, $style, $size) = explode(",", $this->bufferGroup[$k]["style"]);

                    $this->SetFont($family, $style, $size);


                    $this->SetWidths($this->bufferGroup[$k]["widths"]);
                    $this->SetAligns($this->bufferGroup[$k]["aligns"]);
                    $this->SetStyles($this->bufferGroup[$k]["styles"]);
                    $this->SetFills($this->bufferGroup[$k]["fills"]);


                    $this->Row($this->bufferGroup[$k]["data"]);
                    break;
                case "Cell":

                    $this->TextColor = $this->bufferGroup[$k]["TextColor"];
                    //$this->FillColor = $this->bufferGroup[$k]["FillColor"];
                    list($family, $style, $size) = explode(",", $this->bufferGroup[$k]["style"]);

                    $this->SetFont($family, $style, $size);

                    $this->Cell($this->bufferGroup[$k]["w"], $this->bufferGroup[$k]["h"], $this->bufferGroup[$k]["txt"], $this->bufferGroup[$k]["border"], $this->bufferGroup[$k]["ln"], $this->bufferGroup[$k]["align"], $this->bufferGroup[$k]["fill"], $this->bufferGroup[$k]["link"]
                    );
                    break;
                case "Ln":
                    $this->Ln($this->bufferGroup[$k]["h"]);
                    break;
            }
        }
        $this->bufferGroup = array();
    }

    function WriteHTML($html) {
        //HTML parser
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                //Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                else
                    $this->Write(5, $e);
            }
            else {
                //Tag
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    //Extract attributes
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
        exit();
    }

    function OpenTag($tag, $attr) {
        //Opening tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U') {
            $this->SetStyle($tag, true);
        }
        if ($tag == 'A') {
            $this->HREF = $attr['HREF'];
        }
        if ($tag == 'BR') {
            $this->Ln(5);
        }
        if ($tag == 'IMG') {
            $src = $attr["SRC"];
            if (strpos($src, "/gestDocumental/verArchivo/") !== false) {
                $params = explode("/", $src);
                //print_r( $params );
                for ($i = 0; $i < count($params); $i++) {
                    if ($params[$i] == "folder") {
                        $folder = base64_decode($params[$i + 1]);
                    }

                    if ($params[$i] == "idarchivo") {
                        $idarchivo = base64_decode($params[$i + 1]);
                    }
                }
            }

            $file = sfConfig::get("app_digitalFile_root") . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $idarchivo;
            if (file_exists($file)) {
                $x = $this->GetX();
                $y = $this->GetY();
                $this->Image($file, $x, $y, 20);
            }
        }
    }

    function CloseTag($tag) {
        //Closing tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable) {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s) {
            if ($this->$s > 0)
                $style.=$s;
        }
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt) {
        //Put a hyperlink
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }
    
    
    function Rotate($angle,$x=-1,$y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    function _endpage()
    {
        if($this->angle!=0)
        {
            $this->angle=0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

}

?>