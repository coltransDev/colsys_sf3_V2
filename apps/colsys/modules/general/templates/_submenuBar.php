<?

switch($action){
	case "verEmail":
		$button[1]["name"]="Volver";
		$button[1]["tooltip"]="Volver";
		$button[1]["image"]="22x22/1leftarrow.gif"; 			
		$button[1]["onClick"]= "history.go(-1)";
				
		$button[2]["name"]="Cerrar";
		$button[2]["tooltip"]="Cerrar";
		$button[2]["image"]="22x22/window_nofullscreen.gif"; 			
		$button[2]["onClick"]= "window.close()";
		break;	

			
}

?>