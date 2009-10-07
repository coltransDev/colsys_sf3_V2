<?
$nivel = $this->getUser()->getNivelAcceso( kbaseActions::RUTINA );	

if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del módulo";
	$button[0]["image"]="22x22/gohome.gif"; 			
	$button[0]["link"]= "kbase/index";	
}


switch($action){
	
	case "index":
		if( $nivel>=1 ){ 		
			/*$button[1]["name"]="Nuevo ";
			$button[1]["tooltip"]="Crear un nuevo registro";
			$button[1]["image"]="22x22/new.gif"; 			
			$button[1]["link"]= "kbase/formContenido";*/
		}		
		break;	
	case "verContenido":
		if( $nivel>=1 ){ 			
			$button[1]["name"]="Editar ";
			$button[1]["tooltip"]="Editar este registro";
			$button[1]["image"]="22x22/edit.gif"; 			
			$button[1]["link"]= "kbase/formContenido?id=".$this->getRequestParameter("id");
		}		
		break;		
		
	
	
	
}

?>