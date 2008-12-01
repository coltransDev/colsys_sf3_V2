<?
/*
* Panel de administracion de archivos del cada trafico
*/

include_component("gestDocumental", "panelArchivos", 
						array("dataUrl"=>"pricing/dataArchivosPais?idtrafico=".$trafico->getCaIdtrafico()."&impoexpo=".$impoexpo."&transporte=".$transporte."&modalidad=".$modalidad."&token=".md5(time()),
							"viewUrl"=>"pricing/verArchivo",
							"deleteUrl"=>"pricing/borrarArchivo",
							"title"=>"Archivos ".substr($impoexpo,0,4)."»".utf8_decode($transporte)."»".$modalidad."»".$trafico->getCaNombre(), 
							"closable"=>true, 
							"uploadURL"=>"pricing/subirArchivo?idtrafico=".$trafico->getCaIdtrafico()."&impoexpo=".$impoexpo."&transporte=".$transporte."&modalidad=".$modalidad."&token=".md5(time()),
							"readOnly"=>$opcion=="consulta"
						));
exit();
?>

