<div align="center"><h3>Administración de permisos por usuario y grupo</h3></div>
<br />
<div id="panelAdmin" style="margin:0 20px 0 20px"></div>
<script language="javascript" >
/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   			
	{name: 'rutina', type: 'string'},
	{name: 'grupo', type: 'string'},
	{name: 'opcion', type: 'string'},
	{name: 'descripcion', type: 'string'},
	{name: 'programa', type: 'string'}
	
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
			width: 40,
			sortable: true,	
			hideable: false,		
			dataIndex: 'grupo',			
			editor: new Ext.form.TextField() 			
		}
		,
		{
			header: "Opción",
			width: 40,
			sortable: true,	
			hideable: false,		
			dataIndex: 'opcion',
			editor: new Ext.form.TextField() 	 			
		},		
		{
			header: "Descripcion",
			width: 80,
			sortable: true,	
			hideable: false,		
			dataIndex: 'descripcion',
			editor: new Ext.form.TextField() 	
		}
		,
		{
			header: "Link",
			width: 60,
			sortable: true,	
			hideable: false,		
			dataIndex: 'programa',
			editor: new Ext.form.TextField() 	
		}
		
				
	]	
});



var activeRecord = null;
/*
* Muestra una ventana con la informacion del tarifario y le permite al usuario 
* seleccionar las tarifas a importar
*/
var ventanaPermisos = function( record ){
	var url = '<?=url_for("users/permisosRutinas")?>';
	
	activeRecord = record;
	Ext.Ajax.request({
		url: url,
		params: {						
			rutina: record.data.rutina 		
		},
		success: function(xhr) {			
			//alert( xhr.responseText );			
			var newComponent = eval(xhr.responseText);
			
			//Se crea la ventana
			
			win = new Ext.Window({		
			width       : 830,
			height      : 460,
			closeAction :'close',
			plain       : true,	
			title       : activeRecord.data.opcion,			
			items       : [newComponent],
			
	
			buttons: [
				{
					text     : 'Guardar',
					handler  : function( ){	
						guardarCambios();
					}
				},
				{
					text     : 'Cancelar',
					handler  : function(){
						win.close();
					}
				}
			]
		});		
		win.show( );		
		},
		failure: function() {
			Ext.Msg.alert("Win creation failed", "Server communication failure");
		}
	});	
}



/*
* Menu contextual que se despliega sobre una fila con el boton derecho
*/

var gridOnRowcontextmenu =  function(grid, index, e){		
	rec = this.store.getAt(index);	
	this.menu = new Ext.menu.Menu({
	
	items: [{
				text: 'Permisos',
				iconCls: '',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord ){								
						ventanaPermisos( this.ctxRecord );
					}							
				}
			},			
			{
				text: 'Eliminar item',
				iconCls: 'delete',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord &&confirm("Desea continuar?") ){					
						
						if( this.ctxRecord.data.rutina ){
							var rutina = this.ctxRecord.data.rutina;
							Ext.Ajax.request( 
							{   
								waitMsg: 'Guardando cambios...',						
								url: '<?=url_for("users/eliminarAdminRutina")?>',
								//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{
									rutina: rutina									
								},
														
								//Ejecuta esta accion en caso de fallo
								//(404 error etc, ***NOT*** success=false)
								failure:function(response,options){							
									alert( response.responseText );						
									success = false;
								},
								//Ejecuta esta accion cuando el resultado es exitoso
								success:function(response,options){	
									store.each( function( record ){										
											if( record.data.rutina==rutina ){												
												store.remove(record);																																															
											}	
									});
								}
							}); 
						}
					}						
				}
			}				
			]
	});
	//this.menu.on('hide', this.onContextHide, this);
   
	e.stopEvent();
	if(this.ctxRow){
		Ext.fly(this.ctxRow).removeClass('x-node-ctx');
		this.ctxRow = null;
	}
	this.ctxRecord = rec;
	this.ctxRow = this.view.getRow(index);
	Ext.fly(this.ctxRow).addClass('x-node-ctx');
	this.menu.showAt(e.getXY());
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

var agregarFila = function(){	
	var rec = new record({
							rutina:'',
							opcion:'',
							descripcion:'',
							programa:'',
							grupo:''
						});
	records = [];
	records.push( rec );
	store.insert( 0, records );
}


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

var panel = new Ext.grid.EditorGridPanel({
	store: store,	
	cm: colModelSeguros,
	sm: new  Ext.grid.CellSelectionModel(),	
	clicksToEdit: 2,
	stripeRows: true,	
	title: 'Administración de rutinas',
	height: 400,	
	closable: true,	
	//renderTo: 'panelRutinas',
	tbar: [			
		{
			text: 'Agregar',
			tooltip: 'Permite agregar una nueva rutina',
			iconCls:'add',  // reference to our css
			handler: agregarFila
		},
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
	listeners:{ 		
		rowcontextmenu:gridOnRowcontextmenu	
	}

});

panel.render("panelAdmin");
</script>