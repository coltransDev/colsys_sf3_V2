<?


if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del módulo";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "pm/index";
}

if( $action=="index" || $action=="listaTickets" ){
	$button[2]["name"]="Nuevo";
	$button[2]["tooltip"]="Crear una nuevo ticket";
	$button[2]["image"]="22x22/new.gif"; 			
	$button[2]["link"]= "pm/crearTicket?token=".md5(time());

    $button[3]["name"]="Proyectos";
	$button[3]["tooltip"]="Crear una nuevo ticket";
	$button[3]["image"]="22x22/new.gif";
	$button[3]["link"]= "pm/listaProyectos";
}

switch($action){
	
	case "verTicket":		
		$button[2]["name"]="Editar";
		$button[2]["tooltip"]="Editar este ticket";
		$button[2]["image"]="22x22/edit.gif"; 			
		$button[2]["link"]= "pm/crearTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());

       
		break;
	case "nuevoSeguimiento":
		$button[2]["name"]="Volver";
		$button[2]["tooltip"]="Volver al ticket";
		$button[2]["image"]="22x22/1leftarrow.gif"; 			
		$button[2]["link"]= "pm/verTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());
		
		break;

    case "listaTicketsPrioridades":
        if($this->getRequestParameter("option")!="view"){
            $button[2]["name"]="Guardar";
            $button[2]["tooltip"]="Guardar el orden de los tickets";
            $button[2]["image"]="22x22/save.gif";
            $button[2]["onClick"]= "javascript:save()";

            $button[3]["name"]="Ver estimados";
            $button[3]["tooltip"]="Ver estimacion de tiempo ";
            $button[3]["image"]="22x22/kexi_kexi.gif";
            $button[3]["link"]= "pm/listaTicketsPrioridades?area=".$this->getRequestParameter("area")."&user=".$this->getRequestParameter("user")."&option=view";

        }else{
            $button[2]["name"]="Edicion";
            $button[2]["tooltip"]="Ver resultado de las ";
            $button[2]["image"]="22x22/inline_table.gif";
            $button[2]["link"]= "pm/listaTicketsPrioridades?area=".$this->getRequestParameter("area")."&user=".$this->getRequestParameter("user");
           
        }
		break;
			
}

?>