<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

$i=0;

if( $action!="index" ){
	$button[$i]["name"]="Inicio ";
	$button[$i]["tooltip"]="Pagina inicial del módulo";
	$button[$i]["image"]="22x22/gohome.gif"; 			
	$button[$i]["link"]= "ids/index?modo=".$this->getRequestParameter("modo");
	$i++;
}

switch($action){
	case "index":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear una nuevo registro";
		$button[$i]["image"]="22x22/new.gif"; 			
		$button[$i]["link"]= "ids/formIds?modo=".$this->getRequestParameter("modo");
		$i++;
		break;	

	case "verIds":
		$button[$i]["name"]="Editar";
		$button[$i]["tooltip"]="Edita este registro";
		$button[$i]["image"]="22x22/edit.gif";
		$button[$i]["link"]= "ids/formIds?id=".$this->getRequestParameter("id")."&modo=".$this->getRequestParameter("modo") ;
		$i++;

        $button[$i]["name"]="Contactos";
		$button[$i]["tooltip"]="Modifica los contactos";
		$button[$i]["image"]="22x22/add_user.gif";
		$button[$i]["link"]= "ids/formContactosIds?id=".$this->getRequestParameter("id")."&modo=".$this->getRequestParameter("modo") ;
		$i++;
		break;
		
	
}


?>