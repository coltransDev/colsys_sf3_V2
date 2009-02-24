<?

$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/entrada.php";



if( $action!="index" ){
	$button[1]["name"]="Inicio ";
	$button[1]["tooltip"]="Pagina inicial del módulo de Cotizaciones";
	$button[1]["image"]="22x22/gohome.gif"; 			
	$button[1]["link"]= "kbase/index";	
}

?>