<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del módulo de Cotizaciones";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "cotizaciones/index";
	
}

switch($action){
	case "index":		
		$button[2]["name"]="Nuevo";
		$button[2]["tooltip"]="Crear una nueva Cotización";
		$button[2]["image"]="22x22/new.gif"; 			
		$button[2]["link"]= "cotizaciones/consultaCotizacion?token=".md5(time());
		break;	

	case "verCotizacion":	
		$button[2]["name"]="Volver";
		$button[2]["tooltip"]="Vuelve a la pagina anterior";
		$button[2]["image"]="22x22/1leftarrow.gif"; 			
		$button[2]["link"]= "cotizaciones/consultaCotizacion?id=".$this->getRequestParameter("id")."&token=".md5(time());

			
		$button[3]["name"]="Email ";
		$button[3]["tooltip"]="Enviar la cotizaci&oacute;n por e-mail";
		$button[3]["image"]="22x22/email.gif"; 			
		$button[3]["link"]= "cotizaciones/verCotizacion?id=".$this->getRequestParameter("id");
		$button[3]["onClick"]= "showEmailForm()";
		
		
		$button[4]["name"]="Copiar ";
		$button[4]["tooltip"]="Copia la cotizaci&oacute;n en una nueva cotizaci&oacute;n";
		$button[4]["image"]="22x22/copy.gif"; 		
		$button[4]["link"]= "cotizaciones/copiarCotizacion?idcotizacion=".$this->getRequestParameter("id");
		
		$button[5]["name"]="Anular ";
		$button[5]["tooltip"]="Anula la cotizaci&oacute;n";
		$button[5]["image"]="22x22/cancel.gif"; 		
		$button[5]["link"]= "cotizaciones/anularCotizacion?idcotizacion=".$this->getRequestParameter("id");
		$button[5]["confirm"]= "Esta seguro que desea anular esta cotización? ";
		
		break;	

	case "consultaCotizacion":		
		if( $this->getRequestParameter("id") ){
			$button[2]["name"]="PDF ";
			$button[2]["tooltip"]="Genera un archivo PDF para la impresión de la cotización";
			$button[2]["image"]="22x22/pdf.gif"; 			
			$button[2]["link"]= "cotizaciones/verCotizacion?id=".$this->getRequestParameter("id");
			
			$button[3]["name"]="Copiar ";
			$button[3]["tooltip"]="Copia la cotizaci&oacute;n en una nueva cotizaci&oacute;n";
			$button[3]["image"]="22x22/copy.gif"; 		
			$button[3]["link"]= "cotizaciones/copiarCotizacion?idcotizacion=".$this->getRequestParameter("id");
			
			$button[4]["name"]="Anular ";
			$button[4]["tooltip"]="Anula la cotizaci&oacute;n";
			$button[4]["image"]="22x22/cancel.gif"; 		
			$button[4]["link"]= "cotizaciones/anularCotizacion?idcotizacion=".$this->getRequestParameter("id");
			$button[4]["confirm"]= "Esta seguro que desea anular esta cotización? ";
		}
		break;			
}

if( $action!="ayuda" ){
	$button[10]["name"]="Ayuda";
	$button[10]["tooltip"]="Ayudas del modulo de cotizaciones";
	$button[10]["image"]="22x22/help.gif"; 			
	$button[10]["link"]= "cotizaciones/ayuda";
}
?>