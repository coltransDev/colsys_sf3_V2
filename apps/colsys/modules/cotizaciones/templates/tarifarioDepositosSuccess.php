<?

$data = $sf_data->getRaw("data");
?>

/*
* Crea el Record 
*/
var recordDepositos = Ext.data.Record.create([   		
	{name: 'sel', type: 'string'},
        {name: 'idconcepto', type: 'int'},
        {name: 'parametros', type: 'string'},
        {name: 'concepto', type: 'string'},
        {name: 'parametro', type: 'string'},
        {name: 'valor', type: 'float'},
        {name: 'aplicacion', type: 'string'},
        {name: 'valorminimo', type: 'float'},
        {name: 'aplicacionminimo', type: 'string'},
        {name: 'fchini', type: 'date'},
        {name: 'fchfin', type: 'date'},
        {name: 'observaciones', type: 'string'},
]);
   		
/*
* Crea el store
*/
var storeDepositos = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordDepositos
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data))?>),
        groupField: 'parametros'
});
	
/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false}); 

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModelDepositos = new Ext.grid.ColumnModel({		
	columns: [		
		checkColumn,
		{
			header: "Modalidad",
			width: 90,
			sortable: false,
			hideable: false,
                        hidden: true,
			dataIndex: 'parametros'
		},
		{
			header: "Concepto",
			width: 90,
			sortable: false,
			hideable: false,
			dataIndex: 'concepto'
		},
		{
			header: "Parametro",
			width: 90,
			sortable: false,
			hideable: false,
			dataIndex: 'parametro'
		},
		{
			header: "Valor",
			width: 40,
			sortable: false,
			hideable: false,
			dataIndex: 'valor',
                        renderer: this.formatNumber
		},
		{
			header: "Aplicacion",
			width: 90,
			sortable: false,
			hideable: false,
			dataIndex: 'aplicacion'
		}
		,			
		{
			header: "Valor Minimo",
			width: 40,
			sortable: false,
			hideable: false,
			dataIndex: 'valorminimo',
                        renderer: this.formatNumber
		}
		,
		{
			header: "Aplicacion Min",
			width: 90,
			sortable: false,
			hideable: false,
			dataIndex: 'aplicacionminimo'
		}
		,
		{
			header: "Fecha Inicial",
			width: 40,
			sortable: false,
			hideable: false,
			dataIndex: 'fchini',
                        renderer: Ext.util.Format.dateRenderer('Y/m/d')
		},
		{
			header: "Fecha Final",
			width: 40,
			sortable: false,
			hideable: false,
			dataIndex: 'fchfin',
                        renderer: Ext.util.Format.dateRenderer('Y/m/d')
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
		var records = storeDepositos.getModifiedRecords();				
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
	storeDepositos.each( function(r){
			r.set("sel", true);
		} 
	);
}

	
/*
* Crea la grilla 
*/    

new Ext.grid.GridPanel({
	store: storeDepositos,	
	cm: colModelDepositos,
	sm: new  Ext.grid.CellSelectionModel(),
        loadMask: {msg:'Cargando...'},
	clicksToEdit: 1,
	stripeRows: true,	
	title: 'Depositos',
	height: 400,
	width: 980,
	plugins: [checkColumn], //expander,
	closable: true,
	id: '<?=$idcomponent?>',	
	tbar: [			
		{
			text: 'Seleccionar todo',
			tooltip: 'Selecciona todas las tarifas',
			iconCls:'tick',  // reference to our css
			handler: seleccionarTodo
		}
	],
	view: new Ext.grid.GroupingView({
		 forceFit :true		
	})
});
