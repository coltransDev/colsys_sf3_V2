<?



$i=0;

if( $action!="index" ){
	$button[$i]["name"]="Inicio ";
	$button[$i]["tooltip"]="Pagina inicial del m�dulo";
	$button[$i]["image"]="22x22/gohome.gif"; 			
	$button[$i]["link"]= "agentes/index";
	$i++;
}

switch($action){
	case "consultarAgentes":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear un agente";
		$button[$i]["image"]="22x22/new.gif"; 			
		$button[$i]["link"]= "agentes/formAgentes";
		$i++;
		break;	

	case "verCotizacion":	
		$button[$i]["name"]="Volver";
		$button[$i]["tooltip"]="Vuelve a la pagina anterior";
		$button[$i]["image"]="22x22/1leftarrow.gif"; 			
		$button[$i]["link"]= "cotizaciones/consultaCotizacion?id=".$this->getRequestParameter("id")."&token=".md5(time());
		$i++;
		
		
		$button[$i]["name"]="Seguimientos ";
		$button[$i]["tooltip"]="Enviar la cotizaci&oacute;n por e-mail";
		$button[$i]["image"]="22x22/todo.gif"; 			
		$button[$i]["link"]= "cotseguimientos/verSeguimiento?idcotizacion=".$this->getRequestParameter("id");
		
		$i++;		
			
		$button[$i]["name"]="Email ";
		$button[$i]["tooltip"]="Enviar la cotizaci&oacute;n por e-mail";
		$button[$i]["image"]="22x22/email.gif"; 			
		$button[$i]["link"]= "cotizaciones/verCotizacion?id=".$this->getRequestParameter("id");
		$button[$i]["onClick"]= "showEmailForm()";
		$i++;
		
		$button[$i]["name"]="Copiar ";
		$button[$i]["tooltip"]="Copia la cotizaci&oacute;n en una nueva cotizaci&oacute;n";
		$button[$i]["image"]="22x22/copy.gif"; 		
		$button[$i]["link"]= "cotizaciones/copiarCotizacion?idcotizacion=".$this->getRequestParameter("id");
		$i++;
		
		$button[$i]["name"]="Anular ";
		$button[$i]["tooltip"]="Anula la cotizaci&oacute;n";
		$button[$i]["image"]="22x22/cancel.gif"; 		
		$button[$i]["link"]= "cotizaciones/anularCotizacion?idcotizacion=".$this->getRequestParameter("id");
		$button[$i]["confirm"]= "Esta seguro que desea anular esta cotizaci�n? ";
		$i++;
		
		break;	

	case "consultaCotizacion":		
		if( $this->getRequestParameter("id") ){
			$button[$i]["name"]="PDF ";
			$button[$i]["tooltip"]="Genera un archivo PDF para la impresi�n de la cotizaci�n";
			$button[$i]["image"]="22x22/pdf.gif"; 			
			$button[$i]["link"]= "cotizaciones/verCotizacion?id=".$this->getRequestParameter("id");
			$i++;
			
			$button[$i]["name"]="Copiar ";
			$button[$i]["tooltip"]="Copia la cotizaci&oacute;n en una nueva cotizaci&oacute;n";
			$button[$i]["image"]="22x22/copy.gif"; 		
			$button[$i]["link"]= "cotizaciones/copiarCotizacion?idcotizacion=".$this->getRequestParameter("id");
			$i++;
			
			$button[$i]["name"]="Anular ";
			$button[$i]["tooltip"]="Anula la cotizaci&oacute;n";
			$button[$i]["image"]="22x22/cancel.gif"; 		
			$button[$i]["link"]= "cotizaciones/anularCotizacion?idcotizacion=".$this->getRequestParameter("id");			
			$button[$i]["confirm"]= "Esta seguro que desea anular esta cotizaci�n? ";
			$i++;
		}
		break;			
}

if( $action!="ayuda" ){
	/*$button[$i]["name"]="Ayuda";
	$button[$i]["tooltip"]="Ayudas del modulo de cotizaciones";
	$button[$i]["image"]="22x22/help.gif"; 			
	$button[$i]["link"]= "cotizaciones/ayuda";
	$i++;*/
}
?>