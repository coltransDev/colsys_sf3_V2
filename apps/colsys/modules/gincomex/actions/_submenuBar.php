<?

switch($action){
	case "list":
		$button[0]["name"]="Cargar/Ordenes";
		$button[0]["tooltip"]="Cargar Encabezado de Ordenes";
		$button[0]["image"]="22x22/5days.gif";
		$button[0]["link"]= "gincomex/cargarOrdenes";

		$button[1]["name"]="Cargar/Detalles";
		$button[1]["tooltip"]="Cargar Detalles de Ordenes";
		$button[1]["image"]="22x22/5days.gif";
		$button[1]["link"]= "gincomex/cargarDetalles";
		break;	

	case "procesarOrden":
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "gincomex/list";
		break;	

}


?>
