<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del modulo";
	$button[0]["image"]="22x22/home.gif"; 			
	$button[0]["link"]= "inotipocomprobante/index";
	
}

switch($action){
	case "index":		
		$button[1]["name"]="Nuevo";
		$button[1]["tooltip"]="Crear un nuevo tipo de comprobante";
		$button[1]["image"]="22x22/new.gif"; 			
		$button[1]["link"]= "inotipocomprobante/formTipo";
	
		break;	
	
	
	
}


?>