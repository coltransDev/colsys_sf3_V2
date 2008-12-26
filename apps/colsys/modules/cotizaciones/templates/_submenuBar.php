<?

if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del módulo de Cotizaciones";
	$button[0]["image"]="22x22/home.gif"; 			
	$button[0]["link"]= "cotizaciones/index";
	
}

switch($action){
	case "index":		
		$button[1]["name"]="Nuevo";
		$button[1]["tooltip"]="Crear una nueva Cotización";
		$button[1]["image"]="22x22/new.gif"; 			
		$button[1]["link"]= "cotizaciones/consultaCotizacion?token=".md5(time());
		break;	

	case "verCotizacion":		
		$button[2]["name"]="Email ";
		$button[2]["tooltip"]="Enviar la cotizaci&oacute;n por e-mail";
		$button[2]["image"]="22x22/email.gif"; 			
		$button[2]["link"]= "cotizaciones/verCotizacion?id=".$this->getRequestParameter("id");
		$button[2]["onClick"]= "showEmailForm()";
		break;	

	case "consultaCotizacion":		
		if( $this->getRequestParameter("id") ){
			$button[1]["name"]="PDF ";
			$button[1]["tooltip"]="Genera un archivo PDF para la impresión de la cotización";
			$button[1]["image"]="22x22/pdf.gif"; 			
			$button[1]["link"]= "cotizaciones/verCotizacion?id=".$this->getRequestParameter("id");
			
			$button[2]["name"]="Copiar ";
			$button[2]["tooltip"]="Copia la cotizaci&oacute;n en una nueva cotizaci&oacute;n";
			$button[2]["image"]="22x22/copy.gif"; 		
			$button[2]["link"]= "cotizaciones/copiarCotizacion?idcotizacion=".$this->getRequestParameter("id");
		}
		break;			
}
?>