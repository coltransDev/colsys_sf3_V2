<?

$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/entrada.php";



if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del módulo de tickets";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "helpdesk/index";	
}

if( $action=="index" || $action=="listaTickets" ){
	$button[2]["name"]="Nuevo";
	$button[2]["tooltip"]="Crear una nuevo ticket";
	$button[2]["image"]="22x22/new.gif"; 			
	$button[2]["link"]= "helpdesk/crearTicket?token=".md5(time());	
}

switch($action){
	
	case "verTicket":
		
		$button[2]["name"]="Editar";
		$button[2]["tooltip"]="Editar este ticket";
		$button[2]["image"]="22x22/edit.gif"; 			
		$button[2]["link"]= "helpdesk/crearTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());
		
		break;
			
}

?>