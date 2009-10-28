<?

?>


/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30}); 

/*
* Crea el Record 
*/
var recordGrillaAgentes = Ext.data.Record.create([
	{name: 'sel', type: 'bool'},
    {name: 'idcontacto', type: 'string'},
    {name: 'contacto', type: 'string'},
    {name: 'agente', type: 'string'},
    {name: 'ciudad', type: 'string'},
    {name: 'pais', type: 'string'},
    {name: 'telefonos', type: 'string'},
	{name: 'cargo', type: 'string'},
    {name: 'detalle', type: 'string'},
	{name: 'operacion', type: 'string'},
	{name: 'sugerido', type: 'bool'}
]);
  
   		
/*
* Crea el store
*/
var storeAgentes = new Ext.data.GroupingStore({
	autoLoad : true,
	url: '<?=url_for("cotizaciones/datosAgentes?idcotizacion=".$cotizacion->getCaIdcotizacion() )?>',
	reader: new Ext.data.JsonReader(
		{			
			root: 'agentes',
			totalProperty: 'total'
		}, 
		recordGrillaAgentes
	),
	groupField: 'agente',
	sortInfo:{field: 'agente', direction: "ASC"}
	
});
	
	
		
/*
* Crea la columna de chequeo
*/	


/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/

// turn on validation errors beside the field globally
Ext.form.Field.prototype.msgTarget = 'side';

var colModelAgentes = new Ext.grid.ColumnModel({		
	columns: [
		checkColumn,
		{
			id: 'contacto',
			header: "Contacto",
			width: 100,
			sortable: true,
			dataIndex: 'contacto',
			hideable: false
			
		},{
			id: 'agente',
			header: "Agente",
			width: 100,
			sortable: true,
			dataIndex: 'agente',
			hideable: false,
			hidden: true
		},
		{
			id: 'cargo',
			header: "Cargo",
			width: 35,
			sortable: true,			
			dataIndex: 'cargo',
			hideable: false
		},{
			id: 'ciudad',
			header: "Ciudad",
			width: 35,
			sortable: true,			
			dataIndex: 'ciudad',
			hideable: false
		},
		{
			id: 'telefonos',
			header: "Teléfonos",
			width: 25,
			sortable: true,			
			dataIndex: 'telefonos',
			hideable: false
		},
		{
			id: 'operacion',
			header: "Operación",
			width: 25,
			sortable: true,			
			dataIndex: 'operacion',
			hideable: false
		}
	]
});



/*
* Configura el modo de seleccion de la grilla 
*/
var selModelAgentes = new  Ext.grid.CellSelectionModel();



/*
* Actualiza los datos de la base de datos usando Ajax.
*/

	
/*
* Lanza lan función de actualización de registros modificados 
*/
function guardarGridAgentes(){
	var success = true;
	var records = storeAgentes.getRange();
			
	var lenght = records.length;
	
	//Validacion
	
	var result = "";
	
	
	for( var i=0; i< lenght; i++){
		r = records[i];		
		if( r.data.sel ){
			if( result!="" ){
				result+="|";
			}			
			result+=r.data.idcontacto;					
		}	
	}
	
	
	Ext.Ajax.request( 
		{   
			waitMsg: 'Guardando cambios...',						
			url: '<?=url_for("cotizaciones/guardarAgentes?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
			//Solamente se envian los cambios 						
			params :	{datosag: result},
									
			callback :function(options, success, response){	
										
				var res = Ext.util.JSON.decode( response.responseText );						
				if( res.success ){
					storeAgentes.commitChanges();
				}					
			}		
		 }
	);
	
	
	
}






/*
* Crea la grilla 
*/    
var grid_agentes = new Ext.grid.EditorGridPanel({
	store: storeAgentes,
	master_column_id : 'seguro',
	cm: colModelAgentes,
	sm: selModelAgentes,
    loadMask: {msg:'Cargando...'},
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'seguro',
	title: 'Directorio Agentes',

	root_title: 'prima_tip',	
	plugins: [checkColumn], 
	closable: false,
	id: 'grid_agentes',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en Seguros',
		iconCls: 'disk',  // reference to our css
		handler: guardarItems
	}
	,
	{
		text: 'Recargar',
		tooltip: 'Actualiza los agentes de acuerdo a los trayectos seleccionados',
		iconCls: 'refresh',  // reference to our css
		handler: function(){
			if(storeAgentes.getModifiedRecords().length>0){
				if(!confirm("Se perderan los cambios no guardados en el directorio de agentes unicamente, desea continuar?")){
					return 0;
				}
			}
			storeAgentes.reload();
		}
	},	
	{
		text: 'Mostrar todos',
		tooltip: 'Muestra todos los',
		iconCls: 'refresh',  // reference to our css
		id: 'mostrartodos-btn',
		handler: function(){
			if(storeAgentes.getModifiedRecords().length>0){
				if(!confirm("Se perderan los cambios no guardados en el directorio de agentes unicamente, desea continuar?")){
					return 0;
				}
			}
			var btn = Ext.getCmp('mostrartodos-btn');
			if( btn.getText()=='Mostrar todos'){			
				btn.setText( "Mostrar pertinentes" );
				storeAgentes.baseParams = {mostrarTodos:true};
			}else{
				btn.setText( "Mostrar todos" );
				storeAgentes.baseParams = {};
			}
			storeAgentes.reload();
			
		}
	}
	
	
	],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:false,
		enableGroupingMenu: false,
		getRowClass: function(  record,  index,  rowParams,  store ){
			if( record.data.sugerido ){
				return "row_yellow";
			}else{
				return "";
			}									
		} 
	})	
});
