<?
$nivel = $this->getUser()->getNivelAcceso( kbaseActions::RUTINA );	

if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del módulo";
	$button[0]["image"]="22x22/gohome.gif"; 			
	$button[0]["link"]= "kbase/index";	
}


switch($action){
	
	
	case "viewIssue":
		
        if( $nivel>=2 ){
            $button[1]["name"]="Editar ";
            $button[1]["tooltip"]="Editar este registro";
            $button[1]["image"]="22x22/edit.gif";
            $button[1]["link"]= "kbase/formIssue?id=".$this->getRequestParameter("id");
        }
		
		break;		
		
	
	
	
}

?>