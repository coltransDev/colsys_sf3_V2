<?


if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del módulo de tickets";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "idgsistemas/index";
}


switch($action){
	
	case "verTicket":		
		/*$button[2]["name"]="Editar";
		$button[2]["tooltip"]="Editar este ticket";
		$button[2]["image"]="22x22/edit.gif"; 			
		$button[2]["link"]= "helpdesk/crearTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());*/
		
		break;
	

			
}

?>