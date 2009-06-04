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
		$button[2]["name"]="Volver";
		$button[2]["tooltip"]="Vuelve a la pagina anterior";
		$button[2]["image"]="22x22/1leftarrow.gif"; 			
		$button[2]["link"]= "/colsys_php/reportenegocio.php?boton=Consultar&id=".$this->getRequestParameter("id")."&token=".md5(time());

			

			
}


?>