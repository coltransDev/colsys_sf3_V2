<?
class PDF extends FPDF {
    //Variables para manejo de Tablas
    private $widths;
	private $height;
    private $aligns;
    private $sucursal;
	private $repeat;
	private $coltransFooter=false;
	private $coltransHeader=false;
    private $linerepeat;
	private $grouping = false;
	private $bufferGroup = array();
	
	/*
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
    }*/
	
	//Cabecera de página
    function Header() {
		if( !$this->coltransHeader ){
			 $this->Ln(5);
		}else{	 
			//Posición: a 1,6 cm del final
			$this->SetY(16);
			//Arial italic 8
			$this->SetFont('Arial','B',10);
			//Line Repeat
			$this->Cell(0,14,$this->linerepeat,0,0,'L');
			//Logo
			$this->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'ColtransSA.jpg', 18, 8, 63, 10, 'JPG');
			$this->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'20y.jpg', 170, 8, 18, 14, 'JPG');
			//Salto de línea
			$this->Ln(10);
		}
    }

    //Pie de página
    function Footer() {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',8);
			
		if( $this->coltransFooter ){
			//Número de página
			$this->Cell(0,14,'Página '.$this->PageNo().'/{nb}',0,0,'C');
			$this->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'pie_pagina.jpg', 18, 270, 40, 16, 'JPG');
			if (strlen(trim($this->sucursal)) == 0) {
			   $this->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'Dir. Bogotá D.C..jpg', 160, 270, 40, 18, 'JPG');
			}else{
			   /*$this->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'Dir. '.$this->sucursal.'.jpg', 160, 270, 40, 18, 'JPG');*/
			}
		}
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
	
	/*
	* Calcula el espacio 
	*/
	function GetRowHeight( $data ){
		$nb=0;
		$i=0;
		foreach( $data as $value ){				
			@$nb=max($nb,$this->NbLines($this->widths[$i],$value));
			$i++;
		} 
		return ($this->height)*$nb;
	}
    function Row($data) {
		if( !$this->grouping ){
			//Calculate the height of the row			
			$h=$this->GetRowHeight( $data );
			//Issue a page break first if needed
			$this->CheckPageBreak($h);
			//Draw the cells of the row
			$fillColor = $this->GetAttrib('FillColor');
			$this->SetFillColor($this->hex2dec('#D2D2D2'));
			$textColor = $this->GetAttrib('TextColor');
			$this->SetTextColor(0);
			list($family,$style,$size) = explode(",", $this->GetStyle());
			$i=0;
			foreach( $data as $value ){		
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
				$this->MultiCell($w,$this->height,$value,$f,$a,$f);
				//Put the position to the right of the cell
				$this->SetXY($x+$w,$y);
				$i++;
			}
			$this->SetFillColor($fillColor);
			$this->SetTextColor($textColor);
			$this->SetFont($family,$style,$size);
			//Go to the next line
			$this->Ln($h);
		}else{
			$k = count( $this->bufferGroup );
			$this->bufferGroup[$k]["fn"]="Row";
			$this->bufferGroup[$k]["style"]=$this->GetStyle();
			$this->bufferGroup[$k]["TextColor"]=$this->GetAttrib('TextColor');
			$this->bufferGroup[$k]["FillColor"]=$this->GetAttrib('FillColor');
			$this->bufferGroup[$k]["widths"]=$this->widths;
			$this->bufferGroup[$k]["aligns"]=$this->aligns;
			@$this->bufferGroup[$k]["fills"]=$this->fills;
			$this->bufferGroup[$k]["styles"]=$this->styles;
			$this->bufferGroup[$k]["data"]=$data;
		}
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
	
	function setLineRepeat($l) {
		//Set a line to repeat every page
		$this->linerepeat=$l;
    }

    function setSucursal($s) {
		//Set the name of the branch
		$this->sucursal=$s;
    }
	
	function setColtransHeader($s) {		
		$this->coltransHeader=$s;
    }
	
	function setColtransFooter($s) {		
		$this->coltransFooter=$s;
    }
	
	/*
	* Sobrecarga la funcion Cell para almacenar en el buffer, en el caso que se este agrupando.  
	* @author: Andres Botero
	*/
	function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
	{
		if( !$this->grouping ){
			parent::Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
		}else{			
			$k = count( $this->bufferGroup );
			$this->bufferGroup[$k]["fn"]="Cell";
			$this->bufferGroup[$k]["w"]=$w;
			$this->bufferGroup[$k]["h"]=$h;
			$this->bufferGroup[$k]["txt"]=$txt;
			$this->bufferGroup[$k]["border"]=$border;
			$this->bufferGroup[$k]["ln"]=$ln;
			$this->bufferGroup[$k]["align"]=$align;
			$this->bufferGroup[$k]["fill"]=$fill;
			$this->bufferGroup[$k]["link"]=$link;
			$this->bufferGroup[$k]["style"]=$this->GetStyle();
			$this->bufferGroup[$k]["TextColor"]=$this->GetAttrib('TextColor');
			$this->bufferGroup[$k]["FillColor"]=$this->GetAttrib('FillColor');
		}
	}
	/*
	* Sobrecarga la funcion Cell para almacenar en el buffer, en el caso que se este agrupando.  
	* @author: Andres Botero
	*/
	
	function Ln($h=''){
		if( !$this->grouping ){
			parent::Ln($h);
		}else{
			$k = count( $this->bufferGroup );
			$this->bufferGroup[$k]["fn"]="Ln";
			$this->bufferGroup[$k]["h"]=$h;
		}
	}
		
	/*
	* Se asegura de agrupar el contenido en la misma pagina
	* @author: Andres Botero
	*/
	function beginGroup(){
		$this->flushGroup();
		$this->grouping=true;
	}
		
	/*
	* Se asegura de agrupar el contenido en la misma pagina
	* @author: Andres Botero
	*/
	function flushGroup(){
		//Se verifica el tamaño de cada grupo
		$this->grouping=false;
		$height = 0;
		
		for($k=0 ; $k<count( $this->bufferGroup ); $k++ ){
			
			$fn = $this->bufferGroup[$k]["fn"];
			switch( $fn ){ 
				case "Row":
					$height+=$this->GetRowHeight( $this->bufferGroup[$k]['data'] );
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
		if( $this->GetY()+$height>$this->PageBreakTrigger ){
			$this->AddPage($this->CurOrientation);
			$break = true;	
		}
		
		for($k=0 ; $k<count( $this->bufferGroup ); $k++ ){
			$fn = $this->bufferGroup[$k]["fn"];
			
			// Si se realiza un salto de pagina quita el primer espacio en blanco que se haya dejado
			if( $k==0 && $break && $fn=="Ln"  ){
				continue;
			}
			
			
			switch( $fn ){ 
				case "Row":
					$this->TextColor = $this->bufferGroup[$k]["TextColor"];
					//$this->FillColor = $this->bufferGroup[$k]["FillColor"];
					list($family,$style,$size) = explode(",", $this->bufferGroup[$k]["style"]);	
								
					$this->SetFont($family,$style,$size);			
					
					
					$this->SetWidths($this->bufferGroup[$k]["widths"]);
					$this->SetAligns($this->bufferGroup[$k]["aligns"]);
					$this->SetStyles($this->bufferGroup[$k]["styles"]);
					$this->SetFills($this->bufferGroup[$k]["fills"]);
					
													
					$this->Row( $this->bufferGroup[$k]["data"] );			
					break;
				case "Cell":
					
					$this->TextColor = $this->bufferGroup[$k]["TextColor"];
					//$this->FillColor = $this->bufferGroup[$k]["FillColor"];
					list($family,$style,$size) = explode(",", $this->bufferGroup[$k]["style"]);	
								
					$this->SetFont($family,$style,$size);
					
					$this->Cell($this->bufferGroup[$k]["w"],
								$this->bufferGroup[$k]["h"],
								$this->bufferGroup[$k]["txt"],
								$this->bufferGroup[$k]["border"],
								$this->bufferGroup[$k]["ln"],
								$this->bufferGroup[$k]["align"],
								$this->bufferGroup[$k]["fill"],
								$this->bufferGroup[$k]["link"]								
							);
					break;
				case "Ln":
					$this->Ln($this->bufferGroup[$k]["h"]);
					break;
			}
		}	
		$this->bufferGroup=array();	
	}
	
	
	
}
?>