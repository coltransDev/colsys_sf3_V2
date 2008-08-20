<?



if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del tarifario";
	$button[0]["image"]="22x22/home.gif"; 			
	$button[0]["link"]= "pricing/index";
	
}

switch($action){
	
	case "consultaReporte":		
		$button[1]["name"]="Generar ";
		$button[1]["tooltip"]="Genera un archivo PDF con el reporte";
		$button[1]["image"]="22x22/pdf.gif"; 			
		$button[1]["link"]= "reportesNeg/verReporte?modo=".$this->getRequestParameter("modo")."&reporteId=".$this->getRequestParameter("reporteId")."&token=".md5(time());
		
		break;	
	
	
	
}


?>