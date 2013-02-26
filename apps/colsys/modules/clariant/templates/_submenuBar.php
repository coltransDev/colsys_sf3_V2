<?

switch($action){
	case "list":
		$button[0]["name"]="Cargar/Ordenes";
		$button[0]["tooltip"]="Cargar Archivos de Ordenes";
		$button[0]["image"]="22x22/5days.gif";
		$button[0]["link"]= "clariant/loadInfo";

		$button[1]["name"]="Generar Archivo";
		$button[1]["tooltip"]="Generar un nuevo Envio con Notificaciones de Embarque nuevas";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "clariant/generarArchivo";

		$button[2]["name"]="Facturaci&oacute;n";
		$button[2]["tooltip"]="Prorrateo de Facturaci&oacute;n";
		$button[2]["image"]="22x22/5days.gif";
		$button[2]["link"]= "clariant/facturacion";

		$button[3]["name"]="Cargar Reportes";
		$button[3]["tooltip"]="Busca el Reporte de Negocio basado en el N�mero de Orden";
		$button[3]["image"]="22x22/txt.gif";
		$button[3]["link"]= "clariant/buscaReporte";
		break;	

	case "procesarOrden":
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "clariant/list";

		$button[1]["name"]="Duplicar Orden";
		$button[1]["tooltip"]="Duplicar Orden con Productos Faltantes";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "clariant/duplicarOrden?idclariant=".$this->getRequestParameter("idclariant");
		$button[1]["confirm"]= "�Est� seguro que desea duplicar la Orden con los Productos Faltantes?";
          break;


	case "expoFacturas":
		$button[1]["name"]="Generar Novedades";
		$button[1]["tooltip"]="Genera Archivo de Novedades en Facturacion";
		$button[1]["image"]="22x22/kexi_kexi.gif";
		$button[1]["link"]= "clariant/novedadesFacturacion";
          break;


	case "novedadesFacturacion":
		$button[0]["name"]="Inicio";
		$button[0]["tooltip"]="Pagina principal";
		$button[0]["image"]="22x22/home.gif";
		$button[0]["link"]= "clariant/expoFacturas";

		$button[1]["name"]="Generar Excel";
		$button[1]["tooltip"]="Genera Archivo en Excel de Novedades en Facturacion";
		$button[1]["image"]="22x22/kchart_chrt.gif";
		$button[1]["link"]= "clariant/excelNovedadesFacturacion";
		$button[1]["confirm"]= "�Est� seguro que desea generar el archivo de noveades?";
          break;

}


?>
