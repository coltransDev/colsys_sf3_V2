<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del módulo de Reporte de Negocios";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "/colsys_php/reportenegocio.php";
	
}

switch($action){
	

	case "verReporte":	
		
		$button[2]["name"]="Notificar";
		$button[2]["tooltip"]="Envia una notificación a las personas relacionadas en el reporte para que lo revisen";
		$button[2]["image"]="22x22/email.gif"; 			
		$button[2]["link"]= "/reportes/enviarNotificacion/idreporte/".$this->getRequestParameter("id")."/token/".md5(time());
		
		$button[3]["name"]="Volver";
		$button[3]["tooltip"]="Vuelve a la pagina anterior";
		$button[3]["image"]="22x22/1leftarrow.gif"; 			
		$button[3]["link"]= "/colsys_php/reportenegocio.php?boton=Consultar&id=".$this->getRequestParameter("id")."&token=".md5(time());
		break;
	case "enviarNotificacion":	
		$button[3]["name"]="Volver";
		$button[3]["tooltip"]="Vuelve a la pagina anterior";
		$button[3]["image"]="22x22/1leftarrow.gif"; 			
		$button[3]["link"]= "/reportes/verReporte?id=".$this->getRequestParameter("idreporte")."&token=".md5(time());
		break;
			

			
}


?>