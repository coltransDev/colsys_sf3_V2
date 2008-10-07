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
		$button[2]["link"]= "#";
		$button[2]["onClick"]= "showEmailForm()";
		break;	

	case "consultaCotizacion":		
		$button[1]["name"]="Email ";
		$button[1]["tooltip"]="Enviar la cotizaci&oacute;n por e-mail";
		$button[1]["image"]="22x22/email.gif"; 			
		$button[1]["link"]= "cotizaciones/verCotizacion?id=".$this->getRequestParameter("id");
		break;			
}
?>