<?

switch($action){
	case "list":		
		$button[0]["name"]="Importar";
		$button[0]["tooltip"]="Importar la informaci&oacute;n desde la carpeta OUT";
		$button[0]["image"]="22x22/kexi_kexi.gif"; 			
		$button[0]["link"]= "dataImport/importFile?fileHeader=1&proceso=Coltrans&token=".md5(time());

		$button[1]["name"]="Facturaci&oacute;n";
		$button[1]["tooltip"]="Registro de Facturas por Agenciamiento de Carga";
		$button[1]["image"]="22x22/todo.gif"; 			
		$button[1]["link"]= "falabella/datosFacturacion";
                
		$button[2]["name"]="Indicadores";
		$button[2]["tooltip"]="Genera los indicadores trimestrales";
		$button[2]["image"]="22x22/statistics.png"; 			
		$button[2]["link"]= "falabella/indicadoresGestion";
                
                $button[3]["name"]="Nuevos Indicadores";
		$button[3]["tooltip"]="Genera los indicadores trimestrales";
		$button[3]["image"]="22x22/statistics.png"; 			
		$button[3]["link"]= "falabella/indicadoresGestionExt4";
        
		break;	
	case "datosFacturacion":		
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "falabella/list";
		
		$button[1]["name"]="Nueva Factura";
		$button[1]["tooltip"]="Pagina principal";
		$button[1]["image"]="22x22/edit_add.gif";
		$button[1]["link"]= "falabella/datosFactura";

		$button[2]["name"]="Reporta Archivo";
		$button[2]["tooltip"]="Exportar informaci&oacute;n de Facturaci&oacute;n en la carpeta IN";
		$button[2]["image"]="22x22/kexi_kexi.gif"; 			
		$button[2]["link"]= "falabella/generarFactura";
		
		break;	
	case "datosFactura":		
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "falabella/list";
		
		$button[1]["name"]="Facturaci&oacute;n";
		$button[1]["tooltip"]="Registro de Facturas por Agenciamiento de Carga";
		$button[1]["image"]="22x22/todo.gif"; 			
		$button[1]["link"]= "falabella/datosFacturacion";
		
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

		$button[2]["name"]="Reportar Factura";
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
       case "indicadoresGestionExt4":	
		$button[0]["name"]="Imprimir";
		$button[0]["tooltip"]="Genera ambiente para imprimir informe";
		$button[0]["image"]="22x22/printmgr.png"; 			
		$button[0]["link"]= "#";
                $button[0]["onClick"]= "imprimir()";
	
		$button[1]["name"]="Observaciones";
		$button[1]["tooltip"]="Permite incluir observaciones en las gráficas";
		$button[1]["image"]="22x22/kexi_kexi.gif"; 			
		$button[1]["link"]= "#";
                $button[1]["onClick"]= "verObservaciones()";
		break;	
	
}


?>