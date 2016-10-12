<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del módulo de traficos";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "traficos/index?modo=".$this->getRequestParameter("modo");
	
}

switch($action){
	
	case "listaStatus":
		$button[2]["name"]="Excel";
		$button[2]["tooltip"]="Exporta la informaci&oacute;n a excel ";
		$button[2]["image"]="22x22/kchart_chrt.gif"; 			
		$button[2]["link"]= "traficos/informeTraficos?modo=".$this->getRequestParameter("modo")."&idcliente=".$this->getRequestParameter("idcliente")."&reporte=".$this->getRequestParameter("reporte");
				
		$button[3]["name"]="Email";
		$button[3]["tooltip"]="Envia información de varios embarques por correo ";
		$button[3]["image"]="22x22/mail_forward.gif"; 			
		$button[3]["link"]= "traficos/correoTraficos?modo=".$this->getRequestParameter("modo")."&idcliente=".$this->getRequestParameter("idcliente")."&reporte=".$this->getRequestParameter("reporte");		
                
                $button[4]["name"]="Excel x Tráfico";
		$button[4]["tooltip"]="Exporta la informaci&oacute;n a excel x Trafico ";
		$button[4]["image"]="22x22/excel.gif"; 			
		$button[4]["link"]= "traficos/informeTraficos?modo=".$this->getRequestParameter("modo")."&formato=2&orden=xtrafico&idcliente=".$this->getRequestParameter("idcliente")."&reporte=".$this->getRequestParameter("reporte");
		
                $button[5]["name"] = "<p class='div_text'>Habilitar cierre masivo</p><p class='div_text' style='display:none'>Deshabilitar cierre masivo</p>";                
                $button[5]["tooltip"] = "Habilita el campo para seleccionar los reportes que se deben cerrar(Sacar del tracking)";
                $button[5]["image"] = "22x22/checkbox.png";
                $button[5]["onClick"] = "habilitar()";
                
		break;
	case "correoTraficos":
		$button[2]["name"]="Volver";
		$button[2]["tooltip"]="Vuelve a la pagina anterior";
		$button[2]["image"]="22x22/1leftarrow.gif"; 			
		$button[2]["link"]= "traficos/listaStatus?modo=".$this->getRequestParameter("modo")."&idcliente=".$this->getRequestParameter("idcliente")."&reporte=".$this->getRequestParameter("reporte");	
		break;
	
	case "nuevoStatus":
		$button[2]["name"]="Volver";
		$button[2]["tooltip"]="Vuelve a la pagina anterior";
		$button[2]["image"]="22x22/1leftarrow.gif"; 			
		$button[2]["link"]= "traficos/listaStatus?modo=".$this->getRequestParameter("modo")."&reporte=".$this->getRequestParameter("reporte");	
		break;
}
