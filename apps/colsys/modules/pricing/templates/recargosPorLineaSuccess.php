<?
if( isset($linea) && $linea ){ 
	$lineaStr = $linea->getCaSigla()?$linea->getCaSigla():$linea->getIds()->getCaNombre();
}else{
	$lineaStr = "";
}

if( $idtrafico=="99-999" ){

	include_component("pricing", "panelParametrosRecargosLocales", array("object"=>"panelRecargosLocalesParametros"));
	
	include_component("pricing", "panelRecargosLinea", array("object"=>"panelRecargos"));
	
	include_component("pricing", "panelPatiosRecargosLocales", array("object"=>"panelPatiosRecargosLocales"));

?>
new Ext.TabPanel({		
		frame: true,
		title: '<?=("Recargos locales»".$lineaStr) ?>',
		width: 540,
		height: 400,
		closable: true,
		activeTab: 0,
		
		items: [
			panelRecargosLocalesParametros,
			panelRecargos,
			panelPatiosRecargosLocales
		]
});
<?
}else{
	include_component("pricing", "panelRecargosLinea");

}
?>