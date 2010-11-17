<?

switch($action){
	case "list":		
		$button[1]["name"]="Importar";
		$button[1]["tooltip"]="Importar la informaci&oacute;n desde la carpeta OUT";
		$button[1]["image"]="22x22/kexi_kexi.gif"; 			
		$button[1]["link"]= "dataImport/importFile?fileHeader=1&proceso=Coltrans&token=".md5(time());
		break;	
	case "details":		
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "falabella/list";
		
		$button[1]["name"]="Exportar";
		$button[1]["tooltip"]="Exportar la informaci&oacute;n a la carpeta IN";
		$button[1]["image"]="22x22/kexi_kexi.gif";
                $button[1]["onClick"]="export_file()";

		$button[2]["name"]="Facturaci&oacute;n";
		$button[2]["tooltip"]="Exportar informaci&oacute;n de Facturaci&oacute;n en la carpeta IN";
		$button[2]["image"]="22x22/kexi_kexi.gif"; 			
		$button[2]["link"]= "falabella/generarFactura?iddoc=".$this->getRequestParameter("iddoc");

		$button[3]["name"]="Archivar";
		$button[3]["tooltip"]="Archivar la Orden de Pedido";
		$button[3]["image"]="22x22/attach.gif";
		$button[3]["link"]= "falabella/archivarOrden?iddoc=".$this->getRequestParameter("iddoc");

		$button[4]["name"]="Informar";
		$button[4]["tooltip"]="Genera Archivo Plano con Cantidades";
		$button[4]["image"]="22x22/txt.gif";
		$button[4]["link"]= "falabella/informarOrden?iddoc=".$this->getRequestParameter("iddoc");

		$button[5]["name"]="Anular";
		$button[5]["tooltip"]="Anular la Orden de Pedido";
		$button[5]["image"]="22x22/cancel.gif";
		$button[5]["link"]= "falabella/anularOrden?iddoc=".$this->getRequestParameter("iddoc");
		
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