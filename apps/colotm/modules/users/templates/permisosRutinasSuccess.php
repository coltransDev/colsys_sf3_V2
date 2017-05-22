
<?
include_component( "users","grillaRutinaGrupos", array("rutina"=>$rutina) );
include_component( "users","grillaRutinaUsuarios", array("rutina"=>$rutina) );
?>


function guardarCambios(){
	guardarGrillaRutinaGrupos();
	guardarGrillaRutinaUsuarios();
}




new Ext.TabPanel({
    renderTo: Ext.getBody(),
    activeTab: 0,
	title: '<?=$rutina->getCaOpcion()?>',
	height: 385,
    items: [
			grillaRutinaGrupos,
			grillaRutinaUsuarios
			]
});


