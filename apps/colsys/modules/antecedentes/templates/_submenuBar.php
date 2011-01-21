<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

$i=0;

if( $action!="index" ){
    if( $this->getRequestParameter("format")!="maritimo" ){
        $button[$i]["name"]="Inicio ";
        $button[$i]["tooltip"]="Pagina inicial del módulo";
        $button[$i]["image"]="16x16/gohome.gif";
        $button[$i]["link"]= "antecedentes/index";
    }else{
        $button[$i]["name"]="Inicio ";
        $button[$i]["tooltip"]="Pagina inicial del módulo";
        $button[$i]["image"]="16x16/gohome.gif";
        $button[$i]["link"]= "/colsys_php/inosea.php";
    }
	$i++;
}

switch($action){


    case "index":
       
        $button[$i]["name"]="Nueva Master";
        $button[$i]["tooltip"]="Notifica al departamento marítimo ";
        $button[$i]["image"]="16x16/new.gif";
        $button[$i]["link"]= "antecedentes/asignacionMaster";
		$i++;
        break;
	case "asignacionMaster":
        if( $this->getRequestParameter("ref") ){
            $button[$i]["name"]="Ver Planilla";
            $button[$i]["tooltip"]="Notifica al departamento marítimo ";
            $button[$i]["image"]="16x16/email.gif";
            $button[$i]["link"]= "antecedentes/verPlanilla?ref=".$this->getRequestParameter("ref");
        }
		$i++;
        break;
    case "verPlanilla":
        if( $this->getRequestParameter("format")!="maritimo" ){
            $button[$i]["name"] = "Editar ";
            $button[$i]["tooltip"] = "Edita esta referencia para agregar o quitar reportes";
            $button[$i]["image"] = "22x22/edit.gif";
            $button[$i]["link"] = "antecedentes/asignacionMaster?ref=" . $this->getRequestParameter("ref");
            $i++;        

            $button[$i]["name"]="Email ";
            $button[$i]["tooltip"]="Enviar este reporte por e-mail";
            $button[$i]["image"]="22x22/email.gif";
            $button[$i]["link"]= "#";
            $button[$i]["onClick"]= "showEmailForm()";
            $i++;
        }
		break;	
}

?>