<?

switch($action){
	case "list":
		$button[0]["name"]="Cargar/Ordenes";
		$button[0]["tooltip"]="Cargar Archivos de Ordenes";
		$button[0]["image"]="22x22/5days.gif";
		$button[0]["link"]= "clariant/loadInfo";

		$button[1]["name"]="Cartas/Instrucci&oacute;n";
		$button[1]["tooltip"]="Cargar Cartas de Instrucci&oacute;n";
		$button[1]["image"]="22x22/5days.gif";
		$button[1]["link"]= "clariant/loadLetters";
		
		$button[2]["name"]="<br/>Facturaci&oacute;n";
		$button[2]["tooltip"]="Prorrateo de Facturaci&oacute;n";
		$button[2]["image"]="22x22/5days.gif";
		$button[2]["link"]= "clariant/facturacion";
		break;	

	case "procesarOrden":
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "clariant/list";

		$button[1]["name"]="Generar Archivo";
		$button[1]["tooltip"]="Generar un nuevo Envio con Notificaciones de Embarque nuevas";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "clariant/generarArchivo";
		break;	

}


?>
