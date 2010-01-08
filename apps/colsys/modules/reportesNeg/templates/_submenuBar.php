<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



if( $action!="index" ){
	$button[0]["name"]="Inicio ";
	$button[0]["tooltip"]="Pagina inicial del reporte de negocios";
	$button[0]["image"]="22x22/home.gif"; 			
	$button[0]["link"]= "reportesNeg/index?modo=".$this->getRequestParameter("modo");
	
}

switch($action){
	case "index":		
		$button[1]["name"]="Nuevo";
		$button[1]["tooltip"]="Crear un nuevo reporte de negocios";
		$button[1]["image"]="22x22/new.gif"; 			
		$button[1]["link"]= "reportesNeg/formReporte?modo=".$this->getRequestParameter("modo")."&token=".md5(time());
	
		break;	
	case "consultaReporte":		
		

        $button[1]["name"]="Editar ";
		$button[1]["tooltip"]="Modificar este reporte";
		$button[1]["image"]="22x22/edit.gif";
		$button[1]["link"]= "reportesNeg/formReporte?id=".$this->getRequestParameter("id")."&token=".md5(time());

        $button[2]["name"]="Generar ";
		$button[2]["tooltip"]="Genera un archivo PDF con el reporte";
		$button[2]["image"]="22x22/pdf.gif";
		$button[2]["link"]= "reportesNeg/verReporte?id=".$this->getRequestParameter("id")."&token=".md5(time());

        /*
		$button[2]["name"]="Nueva Versi&oacute;n";
		$button[2]["tooltip"]="Genera un archivo PDF con el reporte";
		$button[2]["image"]="22x22/copy_newv.gif"; 			
		$button[2]["link"]= "reportesNeg/copiarReporte?reporteId=".$this->getRequestParameter("reporteId")."&modo=".$this->getRequestParameter("modo")."&option=nuevaVersion&token=".md5(time());
		*/
		
		
		$button[3]["name"]="Copiar ";
		$button[3]["tooltip"]="Genera un archivo PDF con el reporte";
		$button[3]["image"]="22x22/copy.gif"; 			
		$button[3]["link"]= "reportesNeg/copiarReporte?id=".$this->getRequestParameter("id");
		

        $button[4]["name"]="Anular ";        
		$button[4]["tooltip"]="Anula el reporte actual";
		$button[4]["image"]="22x22/cancel.gif";
        $button[4]["confirm"]="Esta seguro?";
		$button[4]["link"]= "reportesNegreportesNeg/anularReporte?id=".$this->getRequestParameter("id");


		break;	
	case "verReporte":		
		$button[1]["name"]="Volver ";
		$button[1]["tooltip"]="Vuelve a la pagina anterior";
		$button[1]["image"]="22x22/1leftarrow.gif"; 			
		$button[1]["link"]= "reportesNeg/consultaReporte?id=".$this->getRequestParameter("id")."&token=".md5(time());
		
		
		$button[2]["name"]="Email ";
		$button[2]["tooltip"]="Enviar la cotizaci&oacute;n por e-mail";
		$button[2]["image"]="22x22/email.gif"; 			
		$button[2]["link"]= "#";
		$button[2]["onClick"]= "showEmailForm()";
		
		
		break;	
	
	
}


?>