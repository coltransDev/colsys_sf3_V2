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
	$button[$i]["link"]= "antecedentes/index";
	$i++;
}

switch($action){
	case "asignacionMaster":
		$button[$i]["name"]="Enviar Planilla";
		$button[$i]["tooltip"]="Notifica al departamento marítimo ";
		$button[$i]["image"]="16x16/email.gif";
		$button[$i]["link"]= "antecedentes/enviarPlanilla?master=".$this->getRequestParameter("master");
		$i++;
        break;
    case "enviarPlanilla":
        $button[$i]["name"] = "Volver ";
        $button[$i]["tooltip"] = "Vuelve a la pagina anterior";
        $button[$i]["image"] = "22x22/1leftarrow.gif";
        $button[$i]["link"] = "antecedentes/asignacionMaster?master=" . $this->getRequestParameter("master");
        $i++;

		break;	
}

?>