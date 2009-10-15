<?
/*
* Panel de administracion de archivos del cada trafico
*/




include_component("gestDocumental", "panelArchivos",
						array("folder"=>$folder,
							"closable"=>true,
                            "id"=>$idcomponent,
                            "title"=>"Archivos ".substr($impoexpo,0,4)."»".utf8_decode($transporte)."»".$modalidad."»".$trafico->getCaNombre(),
							"closable"=>true,
							"readOnly"=>$opcion=="consulta"
						));

?>

