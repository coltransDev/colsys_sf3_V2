<?

?>

/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30}); 

/*
* Crea el Record 
*/
var recordUsuarios = Ext.data.Record.create([   			
	{name: 'rutina', type: 'string'},
	{name: 'sel', type: 'bool'},
	{name: 'login', type: 'string'},
	{name: 'nivel', type: 'string'},
	{name: 'nivel_val', type: 'string'}
]);
   		
/*
* Crea el store
*/
var storeUsuarios = new Ext.data.Store({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordUsuarios
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data))?>),
	sortInfo:{field: 'login', direction: "ASC"}
});
	

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModelUsuarios = new Ext.grid.ColumnModel({		
	columns: [	
		checkColumn,			
		{
			header: "Usuario",
			width: 90,
			sortable: true,	
			hideable: false,		
			dataIndex: 'login'		
		}
		,
		{
			header: "Nivel",
			width: 90,
			sortable: true,	
			hideable: false,		
			dataIndex: 'nivel_val',
			
			editor: new Ext.form.ComboBox({ value: "0",											
											valueField:'nivel',
											displayField:'nivel_val',
											typeAhead: true,
											forceSelection: true,
											triggerAction: 'all',
											emptyText:'Seleccione',
											selectOnFocus: true,					
											lazyRender:true,
											allowBlank: false,
											listClass: 'x-combo-list-small',
											mode: 'local',
											store: new Ext.data.SimpleStore({
													fields: ['nivel', 'nivel_val'],
													data : [
																<?
																$i = 0;
																foreach( $accesos as $key=>$val ){
																if( $i++!=0){
																echo ",";	
																}	
																?>
																["<?=$key?>", "<?=$val?>"]
																<?
																}
																?>
															]	
											
													 }) 
										})	 			
		}
				
	]	
});





/*
* Guarda los cambios en la base de datos
*/

function guardarGrillaRutinaUsuarios(){	
	var records = storeUsuarios.getRange();
	
	var lenght = records.length;
	
	for( var i=0; i < lenght; i++){ 
		r = records[i];			
		if( r.data.sel && !r.data.nivel){
			alert("Por favor coloque el nivel de acceso en los elementos seleccionados en los usuarios");
			return 0;
		}		
	}
	
	
	var usuarios="";
	
	for( var i=0; i< lenght; i++){
		r = records[i];					
		if( r.data.sel ){
			if(usuarios!=""){
				usuarios+="|";
			}
			usuarios+=r.data.login+","+r.data.nivel;
		}
	}
	
	
	Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("users/observeRutinasUsuarios")?>', 						//method: 'POST', 
				//Solamente se envian los cambios 						
				params :	{usuarios:usuarios,
							 rutina: '<?=$rutina->getCaRutina()?>'
							},
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.success ){										
						storeUsuarios.commitChanges();							
						win.close();				
					}
				}			
			 }
		); 
		
		
	
}

/*
* Handler que se encarga de colocar el dato de nivel_val en el Record 
*/
var gridOnvalidateedit = function(e){
	
	if( e.field == "nivel_val"){
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);
		
		var store = ed.field.store;
	    store.each( function( r ){				
				if( r.data.nivel==e.value ){				
					e.value = r.data.nivel_val;
					rec.set("nivel", r.data.nivel);									
					return true;
				}
			}
		)		
	}
}
	
/*
* Crea la grilla 
*/    

grillaRutinaUsuarios = new Ext.grid.EditorGridPanel({
	store: storeUsuarios,	
	cm: colModelUsuarios,
	sm: new  Ext.grid.CellSelectionModel(),	
	clicksToEdit: 1,
	stripeRows: true,	
	title: 'Usuarios',
	height: 400,	
	closable: false,	
	plugins: [checkColumn],	
	view: new Ext.grid.GridView({
		 forceFit :true
		
	}),
	listeners:{		
		validateedit: gridOnvalidateedit
	}	
	

})
