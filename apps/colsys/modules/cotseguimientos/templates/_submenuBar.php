<?

$i=0;



switch($action){
	case "verSeguimiento":		
		$button[$i]["name"]="Volver";
		$button[$i]["tooltip"]="Volver a la cotización";
		$button[$i]["image"]="22x22/1leftarrow.gif"; 			
		$button[$i]["link"]= "cotizaciones/consultaCotizacion?id=".$this->getRequestParameter("idcotizacion");
		$i++;
		break;		
	case "formSeguimiento":		
		$button[$i]["name"]="Volver";
		$button[$i]["tooltip"]="Crear una nuevo seguimiento";
		$button[$i]["image"]="22x22/1leftarrow.gif"; 			
		$button[$i]["link"]= "cotseguimientos/verSeguimiento?idcotizacion=".$this->getRequestParameter("idcotizacion");
		$i++;
		break;	
		
		
}


?>