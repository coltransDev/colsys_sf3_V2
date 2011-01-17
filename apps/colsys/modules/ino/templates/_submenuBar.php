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
	$button[$i]["link"]= "ino/seleccionModo";
	$i++;
}

switch($action){
	case "index":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear una nueva referencia";
		$button[$i]["image"]="22x22/new.gif"; 			
		$button[$i]["link"]= "ino/formIno?modo=".$this->getRequestParameter("modo")."&token=".md5(time());
		$i++;
		break;
    case "formComprobante":
		$button[$i]["name"]="Volver";
		$button[$i]["tooltip"]="Vuelve a la referencia";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "ino/verReferencia?modo=".$this->getRequestParameter("modo")."&id=".$this->getRequestParameter("idmaestra");
		$i++;
		break;

	case "verReferencia":
		$button[$i]["name"]="Editar";
		$button[$i]["tooltip"]="Edita los valores de esta referencia";
		$button[$i]["image"]="22x22/edit.gif";
		$button[$i]["link"]= "ino/formIno?id=".$this->getRequestParameter("id");
		$i++;
		
		break;
    case "verComprobante":
		$button[$i]["name"]="Volver";
		$button[$i]["tooltip"]="Vuelve a la referencia";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "ino/verReferencia?modo=".$this->getRequestParameter("modo")."&id=".$this->getRequestParameter("idmaestra");
		$i++;
		break;

				
}


?>