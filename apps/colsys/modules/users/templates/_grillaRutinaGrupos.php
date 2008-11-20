<?

?>

/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30}); 

/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   			
	{name: 'rutina', type: 'string'},
	{name: 'sel', type: 'bool'},
	{name: 'grupo', type: 'string'},
	{name: 'nivel', type: 'string'}
]);
   		
/*
* Crea el store
*/
var store = new Ext.data.Store({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data))?>),
	sortInfo:{field: 'grupo', direction: "ASC"}
});
	

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModelSeguros = new Ext.grid.ColumnModel({		
	columns: [	
		checkColumn,			
		{
			header: "Grupo",
			width: 90,
			sortable: true,	
			hideable: false,		
			dataIndex: 'grupo'		
		}
		,
		{
			header: "Nivel",
			width: 90,
			sortable: true,	
			hideable: false,		
			dataIndex: 'nivel',
			editor: new Ext.form.ComboBox({ value: "0",
											forceSelection: true,  
											store:[["-1", "Sin acceso"],
													["0", "Consulta"],
													["1", "Modificación"],
													["2", "Eliminación"],
													["3", "Ejecución"]] }) 	 			
		}
				
	]	
});





/*
* Guarda los cambios en la base de datos
*/

function guardarCambios(){	
	var records = store.getRange();
	
	var lenght = records.length;
	
	var grupos="";
	
	for( var i=0; i< lenght; i++){
		r = records[i];					
		if( r.data.sel ){
			if(grupos!=""){
				grupos+="|";
			}
			grupos+=r.data.grupo+","+r.data.nivel;
		}
	}
	
	
	Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("users/observeRutinasGrupos")?>', 						//method: 'POST', 
				//Solamente se envian los cambios 						
				params :	{grupos:grupos,
							 rutina: '<?=$rutina->getCaRutina()?>'
							},
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.success ){										
						store.commitChanges();							
						win.close();				
					}
				}			
			 }
		); 
		
		
	
}

	
/*
* Crea la grilla 
*/    

grillaRutinaGrupos = new Ext.grid.EditorGridPanel({
	store: store,	
	cm: colModelSeguros,
	sm: new  Ext.grid.CellSelectionModel(),	
	clicksToEdit: 1,
	stripeRows: true,	
	title: 'Grupos',
	height: 400,	
	closable: false,	
	plugins: [checkColumn],
	tbar: [					
		{
			text: 'Guardar',
			tooltip: 'Guarda los cambios',
			iconCls:'disk',  // reference to our css
			handler: guardarCambios
		}
	],		
	view: new Ext.grid.GridView({
		 forceFit :true
		
	}),
	

})
