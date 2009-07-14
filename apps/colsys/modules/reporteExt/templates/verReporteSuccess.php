<?
if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
	include_component("reporteExt","reporteMaritimoExt", array("reporte"=>$reporte));
}

if( $reporte->getCaTransporte()==Constantes::AEREO ){
	include_component("reporteExt","reporteAereoExt", array("reporte"=>$reporte));
}
?>