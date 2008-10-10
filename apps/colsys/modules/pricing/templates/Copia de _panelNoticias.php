


var recordNotificaciones = Ext.data.Record.create([   		
	{name: 'idnotificacion', type: 'string'},
	{name: 'titulo', type: 'string'}
	
]);


// create the data store
var storeNotificaciones = new Ext.data.JsonStore({
	url: '<?=url_for("pricing/panelNoticiasData")?>',
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'idnotificacion',
			root: 'data',
			totalProperty: 'total'				
		},  
		recordNotificaciones
	),

//	proxy: new Ext.data.MemoryProxy( data )		
});



storeNotificaciones.each( function(r){
				alert(r.data.titulo);
		});
//




// create the Grid
var gridNoticias = new Ext.grid.GridPanel({
	store: storeNotificaciones,
	columns: [
		{
			id: 'idnotificacion',
			header: "Titulo",
			width: 200,
			sortable: true,			
			dataIndex: 'titulo',
			hideable: false				
		},
		{
			id: 'titulo',
			header: "Titulo",
			width: 200,
			sortable: true,			
			dataIndex: 'titulo',
			hideable: false				
		},
		{
			id: 'fchcreado',
			header: "Fecha",
			width: 200,
			sortable: true,			
			dataIndex: 'fchcreado',
			hideable: false,
			renderer: Ext.util.Format.dateRenderer('m/d/Y')				
		}	
		
	],
	//stripeRows: true,
	
	height:350,
	width:400,
	title:'Notificaciones'
});

gridNoticias.render('panel-noticias');







/*
var myData = <?=json_encode( array("data"=>$data, "total"=>count($data)) )?>;

var recordNotificaciones = Ext.data.Record.create( [
								{name: 'idnotificacion', type: 'string'},
								{name: 'titulo', type: 'string'},
								{name: 'mensaje', type: 'string'},
								{name: 'usucreado', type: 'string'},					
								{name: 'fchcreado', type: 'string'} ]
							);
							

	
// create the data store
var store = new Ext.data.JsonStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'idnotificacion',
			root: 'data',
			totalProperty: 'total'				
		}, 
		recordNotificaciones
	),

	proxy: new Ext.data.MemoryProxy( myData )		
});


// create the Grid
var gridNoticias = new Ext.grid.GridPanel({
	store: storeNotificaciones,
	columns: [
		{
			id: 'titulo',
			header: "Titulo",
			width: 200,
			sortable: true,			
			dataIndex: 'titulo',
			hideable: false				
		},
		{
			id: 'fchcreado',
			header: "Fecha",
			width: 200,
			sortable: true,			
			dataIndex: 'fchcreado',
			hideable: false,
			renderer: Ext.util.Format.dateRenderer('m/d/Y')				
		}	
		
	],
	//stripeRows: true,
	
	height:350,
	width:400,
	title:'Notificaciones'
});

gridNoticias.render('panel-noticias');
*/