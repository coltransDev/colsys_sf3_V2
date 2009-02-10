<?


if( $action!="seleccionCliente" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del reporte de negocios";
	$button[0]["image"]="22x22/gohome.gif"; 			
	$button[0]["link"]= "traficos/index?modo=".$this->getRequestParameter("modo");	
}

switch($action){
	case "verEstatusCarga":		
		
		if( $this->getRequestParameter("ver")!="reporte" ){
			$button[1]["name"]="Excel";
			$button[1]["tooltip"]="Exporta la informaci&oacute;n a excel ";
			$button[1]["image"]="22x22/kchart_chrt.gif"; 			
			$button[1]["link"]= "traficos/informeTraficos?modo=".$this->getRequestParameter("modo")."&idcliente=".$this->getRequestParameter("idcliente")."&fechaInicial=".$this->getRequestParameter("fechaInicial")."&fechaFinal=".$this->getRequestParameter("fechaFinal")."&ver=".$this->getRequestParameter("ver")."&token=".md5(time());
					
			$button[3]["name"]="Email";
			$button[3]["tooltip"]="Envia información de varios embarques por correo ";
			$button[3]["image"]="22x22/mail_forward.gif"; 			
			$button[3]["link"]= "traficos/correoTraficos?modo=".$this->getRequestParameter("modo")."&idcliente=".$this->getRequestParameter("idcliente")."&fechaInicial=".$this->getRequestParameter("fechaInicial")."&fechaFinal=".$this->getRequestParameter("fechaFinal")."&ver=".$this->getRequestParameter("ver")."&token=".md5(time());		
		}		
			
		break;	
}
?>