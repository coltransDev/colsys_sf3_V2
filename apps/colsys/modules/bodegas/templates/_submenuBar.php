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
	$button[$i]["image"]="16x16/gohome.gif";
	$button[$i]["link"]= "bodegas/index";
	$i++;
}

switch($action){
	case "index":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear una nueva noticia";
		$button[$i]["image"]="16x16/new.gif";
		$button[$i]["link"]= "bodegas/formClientePanel";
		$i++;
		break;	
}

if( $action!="ayuda" ){
	/*$button[$i]["name"]="Ayuda";
	$button[$i]["tooltip"]="Ayudas del modulo de cotizaciones";
	$button[$i]["image"]="22x22/help.gif"; 			
	$button[$i]["link"]= "cotizaciones/ayuda";
	$i++;*/
}
?>