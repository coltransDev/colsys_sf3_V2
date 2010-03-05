<?

switch($action){


	case "verTicket":

        $button[1]["name"]="Home";
		$button[1]["tooltip"]="Pagina principal";
		$button[1]["image"]="22x22/gohome.gif";
		$button[1]["link"]= "pm/index";

        $button[2]["name"]="Nuevo";
		$button[2]["tooltip"]="Nuevo ticket";
		$button[2]["image"]="22x22/edit_add.gif";
		$button[2]["link"]= "pm/crearTicket";

		$button[3]["name"]="Editar";
		$button[3]["tooltip"]="Editar este ticket";
		$button[3]["image"]="22x22/edit.gif";
		$button[3]["link"]= "pm/crearTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());

        $button[4]["name"]="Cerrar Ventana";
		$button[4]["tooltip"]="Cerrar esta ventanal";
		$button[4]["image"]="22x22/window_nofullscreen.gif";
		$button[4]["onClick"]= "window.close()";

       
		break;
	case "nuevoSeguimiento":
		$button[2]["name"]="Volver";
		$button[2]["tooltip"]="Volver al ticket";
		$button[2]["image"]="22x22/1leftarrow.gif"; 			
		$button[2]["link"]= "pm/verTicket?id=".$this->getRequestParameter("id")."&token=".md5(time());
		
		break;

    
			
}

?>