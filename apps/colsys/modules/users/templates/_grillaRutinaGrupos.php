<?

?>
/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   			
	{name: 'rutina', type: 'string'},
	{name: 'sel', type: 'string'},
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
			editor: new Ext.form.NumberField({ minValue:-1, maxValue:3 }) 	 			
		}
				
	]	
});





/*
* Guarda los cambios en la base de datos
*/

function guardarCambios(){	
	var records = store.getModifiedRecords();
	success = true;		
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];					
		var changes = r.getChanges();
		
		changes['rutina']=r.data.rutina;
		changes['id']=r.id;		
												
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("users/observeAdminRutinas")?>', 						//method: 'POST', 
				//Solamente se envian los cambios 						
				params :	changes,
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.id ){				
						var rec = store.getById( res.id );										
						rec.set("rutina", res.rutina );											
						rec.commit();						
					}
				}			
			 }
		); 
		
	}
	
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
	title: 'Administración de rutinas',
	height: 400,	
	closable: true,	
	//renderTo: 'panelRutinas',
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
