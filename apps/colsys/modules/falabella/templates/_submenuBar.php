<?

switch($action){
	case "list":		
		$button[1]["name"]="Importar";
		$button[1]["tooltip"]="Importar la informaci&oacute;n desde la carpeta OUT";
		$button[1]["image"]="22x22/kexi_kexi.gif"; 			
		$button[1]["link"]= "dataImport/importFile?fileHeader=1&token=".md5(time());
		break;	
	case "details":		
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif"; 			
		$button[0]["link"]= "falabella/list";	
		
		$button[1]["name"]="Exportar";
		$button[1]["tooltip"]="Exportar la informaci&oacute;n a la carpeta IN";
		$button[1]["image"]="22x22/kexi_kexi.gif"; 			
		$button[1]["link"]= "#";
		$button[1]["onClick"]= "export_file()";				

		$button[2]["name"]="Anular";
		$button[2]["tooltip"]="Anular la Orden de Pedido";
		$button[2]["image"]="22x22/cancel.gif"; 			
		$button[2]["link"]= "falabella/anularOrden?iddoc=".$this->getRequestParameter("iddoc");				
		
		break;	
	case "shippingInstructions":	
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif"; 			
		$button[0]["link"]= "falabella/list";	
	
		$button[1]["name"]="Detalles";
		$button[1]["tooltip"]="Exportar la informaci&oacute;n a la carpeta IN";
		$button[1]["image"]="22x22/kexi_kexi.gif"; 			
		$button[1]["link"]= "falabella/details?iddoc=".$this->getRequestParameter("iddoc");
		
		$button[2]["name"]="e-mail";
		$button[2]["tooltip"]="Enviar por e-mail";
		$button[2]["image"]="22x22/email.gif"; 			
		$button[2]["link"]= "#";
		$button[2]["onClick"]= "showEmailForm()";
		break;	
	
}


?>