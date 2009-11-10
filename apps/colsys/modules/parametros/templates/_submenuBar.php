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
	$button[$i]["link"]= "parametros/index";
	$i++;
}

switch($action){
	case "index":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear una nuevo concepto";
		$button[$i]["image"]="22x22/new.gif"; 			
		$button[$i]["link"]= "parametros/formConcepto?token=".md5(time());
		$i++;

        $button[$i]["name"]="Parametrizacion";
		$button[$i]["tooltip"]="Crear una nuevo concepto";
		$button[$i]["image"]="22x22/new.gif";
		$button[$i]["link"]= "parametros/formConcepto?token=".md5(time());
		$i++;
		break;	

	case "verConcepto":
		$button[$i]["name"]="Editar";
		$button[$i]["tooltip"]="Edita los valores de este concepto";
		$button[$i]["image"]="22x22/edit.gif";
		$button[$i]["link"]= "parametros/formConcepto?id=".$this->getRequestParameter("id")."&token=".md5(time());
		$i++;
		
		break;	

				
}


?>