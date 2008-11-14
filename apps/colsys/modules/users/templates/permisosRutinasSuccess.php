
<?
include_component( "users","grillaRutinaGrupos", array("rutina"=>"") );
?>

new Ext.TabPanel({
    renderTo: Ext.getBody(),
    activeTab: 0,
    items: [{
        title: 'Grupos',
		items:[
			grillaRutinaGrupos
		]
    },{
        title: 'Usuarios',
        html: 'Another one'
    }]
});
