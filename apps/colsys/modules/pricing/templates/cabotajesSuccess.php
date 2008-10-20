<?
use_helper("Ext2");
?>

/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   	
	{name: 'sel', type: 'bool'},	
	//{name: 'oid', type: 'integer'},
	{name: 'origen', type: 'string'},
	{name: 'destino', type: 'string'},
	{name: 'idlinea', type: 'string'},
	{name: 'linea', type: 'string'},
	{name: 'vlrkilo', type: 'string'},			
	{name: 'vlrminimo', type: 'string'},
	{name: 'maxpeso', type: 'string'},
	{name: 'dimensiones', type: 'string'}
]);

 		
/*
* Crea el store
*/
<?
$url = "pricing/datosCabotajes";

?>
var store = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',	
	reader: new Ext.data.JsonReader(
		{
			id: 'origen',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	sortInfo:{field: 'destino', direction: "ASC"},
	groupField: 'linea'			
});

		
/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, groupable: false}); 


/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModel = new Ext.grid.ColumnModel({		
	columns: [		
		//checkColumn,			
		{
			id: 'linea', //para aplicar estilos a esta columna
			header: "Linea",
			width: 200,
			sortable: true,			
			dataIndex: 'linea',
			hideable: true		
		},	
		{
			id: 'origen',
			header: "Origen",
			width: 100,
			sortable: true,
			dataIndex: 'origen', 			
			hideable: true			  
		},
		{
			id: 'destino',
			header: "Destino",
			width: 100,
			sortable: true,
			dataIndex: 'destino', 			
			hideable: true

		}		
		,{
			id: 'vlrkilo',
			header: "Valor kilo",
			width: 80,
			sortable: true,
			groupable: false,								
			dataIndex: 'vlrkilo',
			editor: new Ext.form.TextField()  	
		},		
		{
			id: 'vlrminimo',
			header: "Valor Minimo",
			width: 80,
			sortable: true,
			groupable: false,								
			dataIndex: 'vlrminimo'	,
			editor: new Ext.form.TextField() 	
		}		
	]	
});



/*
* Configura el modo de seleccion de la grilla 
*/
var selModel = new  Ext.grid.CellSelectionModel();



/*
* Actualiza los datos de la base de datos usando Ajax.
*/

	
/*
* Handlers de los eventos y botones de la grilla 
*/
var guardarCambios=function(){
	var success = true;
	var records = store.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
		
		changes['idtrayecto']=r.data.idtrayecto;										
												
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeAdminTrayectos")?>', 						
				//Solamente se envian los cambios 						
				params :	changes,
										
				//Ejecuta esta accion en caso de fallo
				//(404 error etc, ***NOT*** success=false)
				failure:function(response,options){							
					alert( response.responseText );						
					success = false;
				},
				//Ejecuta esta accion cuando el resultado es exitoso
				success:function(response,options){							
					//alert( response.responseText );						
					//r.commit();
				}
			 }
		); 
		r.set("sel", false);//Quita la seleccion de todas las columnas 
	}
	
	if( success ){
		store.commitChanges();
		Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
	}else{
		Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
	}	
}

/*
* Handler que se dispara despues de editar una celda
*/
var gridAfterEditHandler = function(e) {	
   	
	/**
	* Copia los datos a las columnas seleccionadas 
	**/
	if(e.record.data.sel){
		var records = store.getModifiedRecords();				
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
		
/*
* Crea la grilla 
*/    
new Ext.grid.EditorGridPanel({
	store: store,
	master_column_id : 'origen',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'origen',
	title: '<?=$titulo?>',
	root_title: '<?=$trafico->getCaNombre()?>',	
	plugins: [checkColumn], 
	closable: true,
	id: '<?=$idcomponent?>',
	height: 400,
	//autoHeight : true, 
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en los trayectos',
		iconCls:'disk',  // reference to our css
		handler: guardarCambios
	}],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true,
		enableNoGroups:false, 
        hideGroupedColumn: true
		
	}),	
	listeners:{	
		afteredit: gridAfterEditHandler		
	}	
});

