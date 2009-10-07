<?

if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del módulo";
	$button[0]["image"]="22x22/home.gif"; 			
	$button[0]["link"]= "adminPerfiles/index";
	
}

switch($action){
	case "index":		
		$button[1]["name"]="Nuevo";
		$button[1]["tooltip"]="Crear un nuevo Concepto";
		$button[1]["image"]="22x22/new.gif"; 			
		$button[1]["link"]= 'adminPerfiles/formPerfil';
		break;	

	case "formPermisos":		
			$button[1]["name"]="Volver";
			$button[1]["tooltip"]="Vuelve a la pagina anterior";
			$button[1]["image"]="22x22/1leftarrow.gif"; 			
			$button[1]["link"]= "adminPerfiles/index";
		break;		
	case "formPerfil":	
		$button[1]["name"]="Volver";
		$button[1]["tooltip"]="Vuelve a la pagina anterior";
		$button[1]["image"]="22x22/1leftarrow.gif"; 			
		$button[1]["link"]= "adminPerfiles/index";
			
		$button[2]["name"]="Permisos";
		$button[2]["tooltip"]="Permisos por usuario";
		$button[2]["image"]="22x22/unlock.gif"; 			
		$button[2]["link"]= "adminPerfiles/formPermisos?perfil=".$this->getRequestParameter("perfil");
		
		$button[3]["name"]="Usuarios";
		$button[3]["tooltip"]="Usuarios con este perfil";
		$button[3]["image"]="22x22/add_user.gif"; 			
		$button[3]["link"]= "adminPerfiles/formUsers?perfil=".$this->getRequestParameter("perfil");
		
		break;	

	case "formUsers":		
			$button[1]["name"]="Volver";
			$button[1]["tooltip"]="Vuelve a la pagina anterior";
			$button[1]["image"]="22x22/1leftarrow.gif"; 			
			$button[1]["link"]= "adminPerfiles/index";
		break;			
}
?>