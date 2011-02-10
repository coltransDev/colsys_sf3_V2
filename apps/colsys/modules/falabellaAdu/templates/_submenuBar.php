<?

switch($action){
	case "list":		
		$button[0]["name"]="Importar P.O.";
		$button[0]["tooltip"]="Importar la informaci&oacute;n desde la carpeta OUT";
		$button[0]["image"]="22x22/kexi_kexi.gif";
		$button[0]["link"]= "dataImport/importFile?fileHeader=4&proceso=Colmas&token=".md5(time());

		$button[1]["name"]="Cargar DIM";
		$button[1]["tooltip"]="Carga Declaraciones de Importaci�n Generadas por Aprocom";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "dataImport/loadFile?&token=".md5(time());

		break;	
	case "details":		
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "falabellaAdu/list";

		$button[1]["name"]="Aprocom";
		$button[1]["tooltip"]="Genera Archivo Plano con Informaci�n para Aprocom";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "falabellaAdu/generaAprocom?iddoc=".$this->getRequestParameter("iddoc");

		$button[2]["name"]="Exportar";
		$button[2]["tooltip"]="Exportar a Excel el contenido de las ordenes asociadas con el DO";
		$button[2]["image"]="22x22/kchart_chrt.gif";
		$button[2]["link"]= "falabellaAdu/exportaExcel?iddoc=".$this->getRequestParameter("iddoc");

		$button[3]["name"]="Importa";
		$button[3]["tooltip"]="Importa desde Excel el contenido de las ordenes asociadas con el DO";
		$button[3]["image"]="22x22/todo.gif";
		$button[3]["link"]= "falabellaAdu/importaExcel?iddoc=".$this->getRequestParameter("iddoc");

		$button[4]["name"]="S.Instructions";
		$button[4]["tooltip"]="Env�a Email con Shipping Instructions a Analista de Importaciones";
		$button[4]["image"]="22x22/mail_forward.gif";
		$button[4]["link"]= "falabellaAdu/shippingInstructions?iddoc=".$this->getRequestParameter("iddoc");

		$button[5]["name"]="Archivar";
		$button[5]["tooltip"]="Archivar la Orden de Pedido";
		$button[5]["image"]="22x22/attach.gif";
		$button[5]["link"]= "falabellaAdu/archivarOrden?iddoc=".$this->getRequestParameter("iddoc");

		$button[6]["name"]="Anular";
		$button[6]["tooltip"]="Anular la Orden de Pedido";
		$button[6]["image"]="22x22/cancel.gif";
		$button[6]["link"]= "falabellaAdu/anularOrden?iddoc=".$this->getRequestParameter("iddoc");

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
                $button[1]["confirm"]= "�Est� seguro que desea enviar al sitio FTP, la informaci�n de la Declaraci�n de Importaci�n?";

		$button[2]["name"]="Facturaci&oacute;n";
		$button[2]["tooltip"]="Exportar la informaci&oacute;n de la Facturaci&oacute;n";
		$button[2]["image"]="22x22/kexi_kexi.gif";
                $button[2]["link"]= "falabellaAdu/generaFactura?referencia=".$this->getRequestParameter("referencia");
                $button[2]["confirm"]= "�Est� seguro que desea enviar al sitio FTP, la informaci�n de facturaci�n?";
                break;
	
}
?>