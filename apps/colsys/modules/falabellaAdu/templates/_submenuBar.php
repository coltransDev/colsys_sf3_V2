<?

switch($action){
	case "list":		
		$button[0]["name"]="Importar P.O.";
		$button[0]["tooltip"]="Importar la informaci&oacute;n desde la carpeta OUT";
		$button[0]["image"]="22x22/kexi_kexi.gif";
		$button[0]["link"]= "dataImport/importFile?fileHeader=4&proceso=Colmas&token=".md5(time());

		$button[1]["name"]="Cargas DIM";
		$button[1]["tooltip"]="Carga Declaraciones de Importación Generadas por Aprocom";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "dataImport/loadFile?&token=".md5(time());

		break;	
	case "details":		
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "falabellaAdu/list";
		
		$button[1]["name"]="Aprocom";
		$button[1]["tooltip"]="Genera Archivo Plano con Información para Aprocom";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "falabellaAdu/generaAprocom?iddoc=".$this->getRequestParameter("iddoc");
/*
		$button[2]["name"]="Exportar";
		$button[2]["tooltip"]="Exportar la informaci&oacute;n a la carpeta IN";
		$button[2]["image"]="22x22/kexi_kexi.gif";
		$button[2]["link"]= "#";
		$button[2]["onClick"]= "export_file()";

		$button[3]["name"]="Facturaci&oacute;n";
		$button[3]["tooltip"]="Exportar informaci&oacute;n de Facturaci&oacute;n en la carpeta IN";
		$button[3]["image"]="22x22/kexi_kexi.gif";
		$button[3]["link"]= "#";
		$button[3]["onClick"]= "factura_file()";
*/
		
		$button[4]["name"]="Anular";
		$button[4]["tooltip"]="Anular la Orden de Pedido";
		$button[4]["image"]="22x22/cancel.gif";
		$button[4]["link"]= "falabellaAdu/anularOrden?iddoc=".$this->getRequestParameter("iddoc");

		break;	
	case "shippingInstructions":
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "falabellaAdu/list";
	
		$button[1]["name"]="Detalles";
		$button[1]["tooltip"]="Exportar la informaci&oacute;n a la carpeta IN";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "falabellaAdu/details?iddoc=".$this->getRequestParameter("iddoc");
		
		$button[2]["name"]="e-mail";
		$button[2]["tooltip"]="Enviar por e-mail";
		$button[2]["image"]="22x22/email.gif";
		$button[2]["link"]= "#";
		$button[2]["onClick"]= "showEmailForm()";
		break;

	case "declaracion":
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "falabellaAdu/list";

		$button[1]["name"]="Declaraci&oacute;n";
		$button[1]["tooltip"]="Exportar la informaci&oacute;n de la Declaraci&oacute;n de Importaci&oacute;n";
		$button[1]["image"]="22x22/kexi_kexi.gif";
                $button[1]["link"]= "falabellaAdu/generaDeclaracion?referencia=".$this->getRequestParameter("referencia");

                break;
	
}
?>