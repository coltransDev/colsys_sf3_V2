<?

if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del módulo";
	$button[0]["image"]="22x22/home.gif"; 			
	$button[0]["link"]= "adminUsers/index";
	
}

switch($action){        
	case "index":		
		$button[1]["name"]="Nuevo";
		$button[1]["tooltip"]="Crear un nuevo Usuario";
		$button[1]["image"]="22x22/add_user.gif"; 			
		$button[1]["link"]= 'adminUsers/formUsuario?key=new';
        
        $button[2]["name"]="Buscar";
		$button[2]["tooltip"]="opciones de busqueda avanzadas";
		$button[2]["image"]="22x22/lupa.gif"; 			
		$button[2]["link"]= 'adminUsers/directory';
		break;
        case "formUsuario":
            @$nivel = adminUsersActions::getNivel();
		$button[1]["name"]="Volver";
		$button[1]["tooltip"]="Vuelve a la pagina anterior";
		$button[1]["image"]="22x22/1leftarrow.gif"; 			
		$button[1]["link"]= "adminUsers/index";
             if($nivel>1){    
		$button[2]["name"]="Permisos";
		$button[2]["tooltip"]="Permisos por usuario";
		$button[2]["image"]="22x22/unlock.gif"; 			
		$button[2]["link"]= "adminUsers/formPermisos?login=".$this->getRequestParameter("login");
		
		$button[3]["name"]="Perfiles";
		$button[3]["tooltip"]="Perfiles del usuario";
		$button[3]["image"]="22x22/add_group.gif"; 			
		$button[3]["link"]= "adminUsers/formPerfiles?login=".$this->getRequestParameter("login");
            }
            break;	
	case "formPerfiles":            
                $button[1]["name"]="Volver";
                $button[1]["tooltip"]="Vuelve a la pagina anterior";
                $button[1]["image"]="22x22/1leftarrow.gif"; 			
                $button[1]["link"]= "adminUsers/formUsuario?login=".$this->getRequestParameter("login");            
            break;
        }
?>