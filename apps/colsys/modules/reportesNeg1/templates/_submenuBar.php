<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$i = 0;

$opcion = ($this->getRequestParameter("opcion")?"&opcion=".$this->getRequestParameter("opcion"):"");

$modo = "&modo=".($this->getRequestParameter("modo")?$this->getRequestParameter("modo"):"Aéreo");

$impoexpo = "&impoexpo=".($this->getRequestParameter("impoexpo")?$this->getRequestParameter("impoexpo"):"Importación");
$modo.=$impoexpo;

if( $action!="index" ){
	$button[$i]["name"]="Inicio ";
	$button[$i]["tooltip"]="Pagina inicial del reporte de negocios";
	$button[$i]["image"]="22x22/home.gif";
	$button[$i]["link"]= "reportesNeg/index?token=".md5(time()).$opcion;
	$i++;
}

switch($action){
	case "index":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear un nuevo reporte de negocios";
		$button[$i]["image"]="22x22/new.gif";
		$button[$i]["link"]= "reportesNeg/formReporte?token=".md5(time()).$opcion.$modo;
        $i++;
		break;	
	case "consultaReporte":		
		

        $button[$i]["name"]="Editar ";
		$button[$i]["tooltip"]="Modificar este reporte";
		$button[$i]["image"]="22x22/edit.gif";
		$button[$i]["link"]= "reportesNeg/formReporte?id=".$this->getRequestParameter("id").$opcion.$modo;
        $i++;

        $button[$i]["name"]="Generar ";
		$button[$i]["tooltip"]="Genera un archivo PDF con el reporte";
		$button[$i]["image"]="22x22/pdf.gif";
		$button[$i]["link"]= "reportesNeg/verReporte?id=".$this->getRequestParameter("id").$opcion.$modo;
        $i++;
       		
        $button[$i]["id"]="anular-reporte";
        $button[$i]["name"]="Anular ";
		$button[$i]["tooltip"]="Anula el reporte actual";
		$button[$i]["image"]="22x22/cancel.gif";
        $button[$i]["onClick"]="ventanaAnularReporte()";
		$button[$i]["link"]= "#";
        $i++;

        $button[$i]["name"]="Unificar ";
		$button[$i]["tooltip"]="Copia las comunicaciones existentes de un reporte a este reporte";
		$button[$i]["image"]="22x22/copy_newv.gif";
		$button[$i]["link"]= "reportesNeg/unificarReporte?id=".$this->getRequestParameter("id").$opcion.$modo;
        $i++;

		break;	
	case "verReporte":		
		$button[$i]["name"]="Volver ";
		$button[$i]["tooltip"]="Vuelve a la pagina anterior";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "reportesNeg/consultaReporte?id=".$this->getRequestParameter("id").$opcion.$modo;
		$i++;
		
		$button[$i]["name"]="Notificar";
		$button[$i]["tooltip"]="Envia una notificación a las personas relacionadas en el reporte para que lo revisen";
		$button[$i]["image"]="22x22/email.gif";
		$button[$i]["link"]= "/reportesNeg/enviarNotificacion/idreporte/".$this->getRequestParameter("id")."/token/".md5(time());

        $i++;		
		
		break;
    case "unificarReporte":
		$button[$i]["name"]="Volver ";
		$button[$i]["tooltip"]="Vuelve a la pagina anterior";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "reportesNeg/consultaReporte?id=".$this->getRequestParameter("id").$opcion.$modo;
		$i++;


		break;
}


?>