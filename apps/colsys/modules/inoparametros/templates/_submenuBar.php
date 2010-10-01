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
	case "cuentas":
        $button[$i]["name"]="Importar";
		$button[$i]["tooltip"]="Edita los valores de este concepto";
		$button[$i]["image"]="22x22/up.gif";
		$button[$i]["link"]= "inoparametros/importarCuentas";
		$i++;
		
		break;	

	

				
}


?>