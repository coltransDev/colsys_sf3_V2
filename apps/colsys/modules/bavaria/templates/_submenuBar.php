<?

switch($action){
	case "list":
		$button[0]["name"]="Procesar Ordenes";
		$button[0]["tooltip"]="Captura la información Requerida por ";
		$button[0]["image"]="22x22/5days.gif";
		$button[0]["link"]= "bavaria/procesarOrdenes";
		break;	

	case "procesarOrdenes":
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "bavaria/list";

		$button[1]["name"]="Generar Archivo";
		$button[1]["tooltip"]="Generar un nuevo Envio con Notificaciones de Embarque nuevas";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "bavaria/generarArchivo";

}


?>