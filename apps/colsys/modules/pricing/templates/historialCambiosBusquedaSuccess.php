/*
* Crea el Record 
*/
var recordHistorial = Ext.data.Record.create([   			
	{name: 'idtrayecto', type: 'string'},
	{name: 'fchcreado', type: 'string'},
	{name: 'horacreado', type: 'string'},
	{name: 'usucreado', type: 'string'},	
	{name: 'timestamp', type: 'int'},
	{name: 'timestamp2', type: 'int'}
	
]);
 		
/*
* Crea el store
*/
var storeHistorial = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordHistorial
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data, "total"=>count($data)))?>),
	sortInfo:{field: 'timestamp', direction: "ASC"},
	groupField: 'fchcreado'		
});
	

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModelHistorial = new Ext.grid.ColumnModel({		
	columns: [		
		{
			header: "Fecha",
			width: 90,
			sortable: true,	
			hideable: false,	
			hidden: true,	
			dataIndex: 'fchcreado'		
		},		
		{
			header: "Fecha",
			width: 90,
			sortable: true,	
			hideable: false,		
			dataIndex: 'horacreado'		
		},
		{
			header: "Usuario",
			width: 90,
			sortable: true,	
			hideable: false,				
			dataIndex: 'usucreado'		
		}
		
	]	
});


var mostrarHistorial = function(grid, rowIndex, columnIndex ){
	
	var record = storeHistorial.getAt(rowIndex);
	
	Ext.Ajax.request({
		url: '<?=url_for("pricing/historialCambios")?>',
		params: {			
			idtrayecto: record.data.idtrayecto,			
			timestamp: record.data.timestamp,
			timestamp2:record.data.timestamp			
		},
		success: function(xhr) {						
			//win.close();	
			var newComponent = eval(xhr.responseText);
			Ext.getCmp('tab-panel').add(newComponent);
			Ext.getCmp('tab-panel').setActiveTab(newComponent);
			
		},
		failure: function() {
			Ext.Msg.alert("Tab creation failed", "Server communication failure");
		}
	});	
	
	
}

	
/*
* Crea la grilla 
*/    

new Ext.grid.GridPanel({
	store: storeHistorial,	
	cm: colModelHistorial,
	sm: new  Ext.grid.CellSelectionModel(),		
	stripeRows: true,	
	title: 'Historial de cambios',
	height: 400,	
	closable: true,					
	view: new Ext.grid.GroupingView({
		forceFit :true,		
		enableGroupingMenu: false,
		startCollapsed : false
	}),
	listeners:{
		 celldblclick : mostrarHistorial
	}	
	
});