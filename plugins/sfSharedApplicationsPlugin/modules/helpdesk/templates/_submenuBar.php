<?


if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del m?dulo de tickets";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "helpdesk/index";	
}

if( $action=="index" || $action=="listaTickets" ){
	$button[2]["name"]="Nuevo";
	$button[2]["tooltip"]="Crear una nuevo ticket";
	$button[2]["image"]="22x22/new.gif"; 			
	$button[2]["onClick"]= "crearTicket()";
}

switch($action){
	
	case "verTicket":		
		/*$button[2]["name"]="Editar";
		$button[2]["tooltip"]="Editar este ticket";
		$button[2]["image"]="22x22/edit.gif"; 			
		$button[2]["link"]= "helpdesk/crearTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());*/
		
		break;
	case "nuevoSeguimiento":
		$button[2]["name"]="Volver";
		$button[2]["tooltip"]="Volver al ticket";
		$button[2]["image"]="22x22/1leftarrow.gif"; 			
		$button[2]["link"]= "helpdesk/verTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());
		
		break;

			
}

?>