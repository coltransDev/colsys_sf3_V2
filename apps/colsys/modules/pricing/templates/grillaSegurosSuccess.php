/*
* Crea el Record 
*/
var recordSeguros = Ext.data.Record.create([   		
	{name: 'sel', type: 'string'},
	{name: 'idgrupo', type: 'int'},
	{name: 'grupo', type: 'string'},
	{name: 'vlrprima', type: 'float'},
	{name: 'vlrminima', type: 'float'},	
	{name: 'vlrobtencionpoliza', type: 'float'},
	{name: 'idmoneda', type: 'string'},
    {name: 'idmonedaobtencion', type: 'string'},
	{name: 'observaciones', type: 'string'}	
]);
   		
/*
* Crea el store
*/
var storeSeguros = new Ext.data.Store({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'idgrupo',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordSeguros
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$sf_data->getRaw('data')))?>),
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
		checkColumn	
		,			
		{
			header: "Grupo",
			width: 110,
			sortable: false,	
			hideable: false,		
			dataIndex: 'grupo' 
			
		}
		,
		{
			header: "Prima",
			width: 50,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrprima',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})  
		}
		,
		{
			header: "Minima",
			width: 50,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrminima',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})  
		},
        {
			id: 'idmoneda',
			header: "Moneda",
			width: 40,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false
			<?
			if( $opcion!="consulta" ){
			?>
			,
			editor: <?=include_component("widgets", "monedas")?>
			<?
			}
			?>
		}
		,
		{
			header: "Obtencion",
			width: 50,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrobtencionpoliza',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})  
		},
		{
			id: 'idmonedaobtencion',
			header: "Moneda",
			width: 40,
			sortable: false,
			dataIndex: 'idmonedaobtencion',
			hideable: false
			<?
			if( $opcion!="consulta" ){
			?>
			,			
			editor: <?=include_component("widgets", "monedas")?>
			<?
			}
			?>
		},
		{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: false,
			dataIndex: 'observaciones',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'Detalles',
	                    allowBlank:true
			})
		}
				
	]	
});

/*
* Actualiza los datos de la base de datos usando Ajax.
*/

/*
* Handlers de los eventos y botones de la grilla 
*/

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

function updateModel(){
	var success = true;
	var records = storeSeguros.getModifiedRecords();
	var lenght = records.length;
	//Valida que se hayan colocado todos los campos 
	for( var i=0; i< lenght; i++){
		r = records[i];
		
		if( !r.data.vlrprima ){			
			Ext.MessageBox.alert("Error", "Por favor coloque el valor de la prima en todos los campos");
			return 0;
		}
		if( !r.data.vlrminima ){			
			Ext.MessageBox.alert("Error", "Por favor coloque el valor de la minima en todos los campos");
			return 0;
		}
		if( !r.data.vlrobtencionpoliza ){			
			Ext.MessageBox.alert("Error", "Por favor coloque el valor de obtención de poliza en todos los campos");
			return 0;
		}
        if( !r.data.idmoneda ){
			Ext.MessageBox.alert("Error", "Por favor coloque la moneda en todos los campos");
			return 0;
		}
		if( !r.data.idmonedaobtencion ){
			Ext.MessageBox.alert("Error", "Por favor coloque la moneda de obtencion en todos los campos");
			return 0;
		}
	}
	
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
						
		changes['id']=r.id;
		changes['idgrupo']=r.data.idgrupo;
		changes['transporte']='<?=$transporte?>';	
										
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeGrillaSeguros")?>', 						
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
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.id ){				
						var rec = storeSeguros.getById( res.id );						
						rec.set("sel", false); //Quita la seleccion de todas las columnas				
						rec.commit();		
					}
				}
			 }
		);
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

new Ext.grid.<?=$opcion!="consulta"?"Editor":""?>GridPanel({
	store: storeSeguros,	
	cm: colModelSeguros,
	sm: new  Ext.grid.CellSelectionModel(),	
	clicksToEdit: 1,
	stripeRows: true,	
	title: 'Seguros <?=$transporte?>',
	height: 400,	
	plugins: [checkColumn], //expander,
	closable: true,
	id: '<?=$idcomponent?>',
	<?
	if( $opcion!="consulta" ){
	?>
	tbar: [			  
		{
			text: 'Guardar Cambios',
			tooltip: 'Guarda los cambios realizados en el tarifario',
			iconCls:'disk',  // reference to our css
			handler: updateModel
		},	
		{
			text: 'Seleccionar todo',
			tooltip: 'Selecciona todas las ciudades',
			iconCls:'tick',  // reference to our css
			handler: seleccionarTodo
		}
	],
	<?
	}
	?>	
	view: new Ext.grid.GridView({
		 forceFit :true		
	}),		
	listeners:{		
		afteredit: gridAfterEditHandler
		
	}
});