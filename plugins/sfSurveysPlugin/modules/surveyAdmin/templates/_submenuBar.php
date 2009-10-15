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
	$button[$i]["link"]= "surveyAdmin/index";
	$i++;
}

switch($action){
	case "index":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear una nueva encuesta";
		$button[$i]["image"]="22x22/new.gif"; 			
		$button[$i]["link"]= "surveyAdmin/formSurvey";
		$i++;
		break;	

	case "verIds":
		$button[$i]["name"]="Editar";
		$button[$i]["tooltip"]="Edita este registro";
		$button[$i]["image"]="22x22/edit.gif";
		$button[$i]["link"]= "ids/formIds?id=".$this->getRequestParameter("id")."&modo=".$this->getRequestParameter("modo") ;
		$i++;        
		
        $button[$i]["name"]="Nueva sucursal";
		$button[$i]["tooltip"]="";
		$button[$i]["image"]="22x22/add_group.gif";
		$button[$i]["link"]= "ids/formSucursalIds?id=".$this->getRequestParameter("id")."&modo=".$this->getRequestParameter("modo") ;
		$i++;

       
		break;
		
	
}


?>