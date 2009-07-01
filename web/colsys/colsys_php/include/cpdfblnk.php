<?
class PDF extends FPDF {
    //Variables para manejo de Tablas
    var $widths;
	var $height;
    var $aligns;
    
    //Cabecera de página
    function Header() {
        $this->Ln(5);
    }

    //Pie de página
    function Footer() {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',8);
        //Número de página
    }
    
    function SetWidths($w) {
    //Set the array of column widths
    $this->widths=$w;
    }

    function SetHeight($h) {
    //Set the array of column widths
    $this->height=$h;
    }

    function SetAligns($a) {
    //Set the array of column alignments
    $this->aligns=$a;
    }

    function SetFills($f) {
    //Set the array of column fills
    $this->fills=$f;
    }

    function SetStyles($s) {
    //Set the array of column styles
    $this->styles=$s;
    }

    function Row($data) {
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=($this->height)*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    $fillColor = $this->GetAttrib('FillColor');
    $this->SetFillColor($this->hex2dec('#D2D2D2'));
    $textColor = $this->GetAttrib('TextColor');
    $this->SetTextColor(0);
    list($family,$style,$size) = explode(",", $this->GetStyle());
    for($i=0;$i<count($data);$i++) {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        $f=isset($this->fills[$i]) ? $this->fills[$i] : 0;
        $s=isset($this->styles[$i]) ? $this->styles[$i] : '';
        $this->SetFont($family,$s,$size);
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,$this->height,$data[$i],$f,$a,$f);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
        }
    $this->SetFillColor($fillColor);
    $this->SetTextColor($textColor);
    $this->SetFont($family,$style,$size);
    //Go to the next line
    $this->Ln($h);
    }

    function CheckPageBreak($h) {
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt) {
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb) {
        $c=$s[$i];
        if($c=="\n") {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
            }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax) {
            if($sep==-1) {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
        }
    return $nl;
    }

}
?>