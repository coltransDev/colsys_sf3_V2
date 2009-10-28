<?

$data = $sf_data->getRaw("data");
?>

/*
* Crea el Record 
*/
var recordSeguros = Ext.data.Record.create([   		
	{name: 'sel', type: 'string'},
	{name: 'idgrupo', type: 'int'},
	{name: 'grupo', type: 'string'},
	{name: 'trayecto', type: 'string'},
	{name: 'producto', type: 'string'},
	{name: 'vlrprima', type: 'float'},
	{name: 'vlrminima', type: 'float'},	
	{name: 'vlrobtencionpoliza', type: 'float'},
	{name: 'idmoneda', type: 'string'},
	{name: 'transporte', type: 'string'},
	{name: 'observaciones', type: 'string'}	
]);
   		
/*
* Crea el store
*/
var storeSeguros = new Ext.data.Store({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordSeguros
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data))?>),
	sortInfo:{field: 'grupo', direction: "ASC"}
});
	
/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false}); 

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModelSeguros = new Ext.grid.ColumnModel({		
	columns: [		
		checkColumn	,
		{
			header: "Trayecto",
			width: 90,
			sortable: false,	
			hideable: false,		
			dataIndex: 'trayecto' 			
		},
		{
			header: "Transporte",
			width: 90,
			sortable: false,	
			hideable: false,		
			dataIndex: 'transporte' 			
		},
		{
			header: "Producto",
			width: 90,
			sortable: false,	
			hideable: false,		
			dataIndex: 'producto' 			
		}
		,			
		{
			header: "Grupo",
			width: 90,
			sortable: false,	
			hideable: false,		
			dataIndex: 'grupo' 			
		}
		,
		{
			header: "Prima",
			width: 30,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrprima'
		}
		,
		{
			header: "Minima",
			width: 30,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrminima'
		}
		,
		{
			header: "Obtencion",
			width: 30,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrobtencionpoliza'
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 40,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false
			
		},
		{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: false,
			dataIndex: 'observaciones',
			hideable: false
		}
				
	]	
});






/*
* Handler que se dispara despues de editar una celda
*/
var gridAfterEditHandler = function(e) {	
   	
	/**
	* Copia los datos a las columnas seleccionadas 
	**/
	if(e.record.data.sel){
		var records = storeSeguros.getModifiedRecords();				
		var lenght = records.length;				
		var field = e.field;
				
		for( var i=0; i< lenght; i++){
			r = records[i];			
			if(r.data.sel){				
				r.set(field,e.value);								
			}
		}
	}	
}

var seleccionarTodo = function(){	
	storeSeguros.each( function(r){
			r.set("sel", true);
		} 
	);
}

	
/*
* Crea la grilla 
*/    

new Ext.grid.GridPanel({
	store: storeSeguros,	
	cm: colModelSeguros,
	sm: new  Ext.grid.CellSelectionModel(),
    loadMask: {msg:'Cargando...'},
	clicksToEdit: 1,
	stripeRows: true,	
	title: 'Seguros',
	height: 400,
	width: 780,
	plugins: [checkColumn], //expander,
	closable: true,
	id: '<?=$idcomponent?>',	
	tbar: [			
		{
			text: 'Seleccionar todo',
			tooltip: 'Selecciona todas las ciudades',
			iconCls:'tick',  // reference to our css
			handler: seleccionarTodo
		}
	],		
	view: new Ext.grid.GridView({
		 forceFit :true
		
	})

});