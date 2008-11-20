
<?
include_component( "users","grillaRutinaGrupos", array("rutina"=>$rutina) );
?>

new Ext.TabPanel({
    renderTo: Ext.getBody(),
    activeTab: 0,
	title: '<?=$rutina->getCaOpcion()?>',
    items: [grillaRutinaGrupos,{
        title: 'Usuarios',
        html: 'Another one'
    }]
});
