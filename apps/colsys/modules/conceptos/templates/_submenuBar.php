<?

if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del módulo de Conceptos";
	$button[0]["image"]="22x22/home.gif"; 			
	$button[0]["link"]= "conceptos/index";
	
}

switch($action){
	case "index":		
		$button[1]["name"]="Nuevo";
		$button[1]["tooltip"]="Crear un nuevo Concepto";
		$button[1]["image"]="22x22/new.gif"; 			
		$button[1]["link"]= 'conceptos/new';
		break;	

	case "verCotizacion":	
		$button[1]["name"]="Volver";
		$button[1]["tooltip"]="Vuelve a la pagina anterior";
		$button[1]["image"]="22x22/1leftarrow.gif"; 			
		$button[1]["link"]= "cotizaciones/consultaCotizacion?id=".$this->getRequestParameter("id")."&token=".md5(time());

			
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
			
			$button[3]["name"]="Anular ";
			$button[3]["tooltip"]="Anula la cotizaci&oacute;n";
			$button[3]["image"]="22x22/cancel.gif"; 		
			$button[3]["link"]= "cotizaciones/anularCotizacion?idcotizacion=".$this->getRequestParameter("id");
			$button[3]["confirm"]= "Esta seguro que desea anular esta cotización? ";
		}
		break;			
}
?>