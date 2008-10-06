<?
use_helper("Ext2");
?>

var data_productos = <?=json_encode( array("productos"=>$productos, "total"=>count($productos)) )?>;


/*
*Store que carga los conceptos
*/
var storeConceptos = new Ext.data.Store({
	autoLoad : false,
	url: '<?=url_for("pricing/datosConceptos")?>',
	reader: new Ext.data.JsonReader(
		{
			id: 'idconcepto',
			root: 'root',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		Ext.data.Record.create([
			{name: 'idconcepto'},
			{name: 'concepto'}
		])
	)
});

editorConceptos = new Ext.form.ComboBox({
	fieldLabel: 'Concepto',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,					
	name: 'recargo',
	id: 'recargo',
	displayField: 'concepto',
	valueField: 'idconcepto',
	lazyRender:true,
	listClass: 'x-combo-list-small',	
	store : storeConceptos	
})


/*
* Crea el Record 
*/
var recordProductos = Ext.data.Record.create([
    {name: 'idcotizacion', type: 'string'},   		
    {name: 'idproducto', type: 'string'},   
	{name: 'idopcion', type: 'string'}, 		
    {name: 'trayecto', type: 'string'},   				
	{name: 'item', type: 'string'},  //Texto de concepto o recargo 
	{name: 'iditem', type: 'string'}, //Concepto o recargo  	 
	{name: 'idconcepto', type: 'string'}, //Concepto al cual pertenece el recargo	
	{name: 'valor_tar', type: 'float'}, 
	{name: 'valor_min', type: 'float'}, 
	{name: 'aplica_tar', type: 'string'}, 
	{name: 'aplica_min', type: 'string'}, 
	{name: 'idmoneda', type: 'string'},
	{name: 'detalles', type: 'string'},
	{name: 'tipo', type: 'string'},
	{name: 'transporte', type: 'string'},
	{name: 'modalidad', type: 'string'}
	
]);
   		
/*
* Crea el store
*/
var storeProductos = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'id',
			root: 'productos',
			totalProperty: 'total'
		}, 
		recordProductos
	),
	sortInfo:{field: 'idproducto', direction: "ASC"},
	proxy: new Ext.data.MemoryProxy(data_productos),
	groupField: 'trayecto'		
});
	
storeProductos.load();	
		
/*
* Crea la columna de chequeo
*/	


/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/

// turn on validation errors beside the field globally
Ext.form.Field.prototype.msgTarget = 'side';

var colModel = new Ext.grid.ColumnModel({		
	columns: [
		{
			id: 'trayecto',
			header: "Trayecto",
			width: 100,
			sortable: false,
			dataIndex: 'trayecto',
			hideable: false,
			hidden: true			
		},
		{
			id: 'concepto',
			header: "Concepto",
			width: 200,
			sortable: false,			
			dataIndex: 'item',
			hideable: false,
			editor: editorConceptos
		},	
	
		{
			id: 'valor_tar',
			header: "Valor",
			width: 100,
			sortable: false,
			dataIndex: 'valor_tar',
			hideable: false ,
			editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left'
			})
		},
		{
			id: 'aplica_tar',
			header: "Aplicacion",
			width: 100,
			sortable: false,
			dataIndex: 'aplica_tar',
			hideable: false 
		},
		{
			id: 'valor_min',
			header: "Minimo",
			width: 100,
			sortable: false,
			dataIndex: 'valor_min',
			hideable: false ,
			editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left'
			})
		},
		{
			id: 'aplica_min',
			header: "Aplicacion",
			width: 100,
			sortable: false,
			dataIndex: 'aplica_min',
			hideable: false 
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 100,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false ,
			editor: <?=extMonedas()?>
		},
		{
			id: 'detalles',
			header: "Detalles",
			width: 100,
			sortable: false,
			dataIndex: 'detalles',
			hideable: false ,
			editor: new Ext.form.TextField({
				allowBlank: false ,				
				style: 'text-align:left'
			})
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

/*
* Cambia el valor que se toma de los combobox y copia el valor em otra columna, 
* tambien inserta otra columna en blanco para que el usuario continue digitando 
*/
var grid_productosOnvalidateedit = function(e){	
	if( e.field == "item"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
		
	    store.each( function( r ){				
				if( r.data.idconcepto==e.value ){									
					if( !rec.data.iditem && rec.data.tipo=="concepto" ){					
						var newRec = rec.copy();
						newRec.data.concepto = "";							
						//Inserta la una columna igual 
						//alert( storeProductos.getTotalCount() );
						records = [];
						records.push( newRec );
						index = storeProductos.indexOf(rec);
						//if(index < storeProductos.getTotalCount()-1){
							storeProductos.insert( index+1 , records );					
						/*}else{						
							storeProductos.add(  records );
						}*/	
					}
					rec.set("iditem", r.data.idconcepto);
					e.value = r.data.concepto;				
					return true;
				}
			}
		)		
	}
}



var productoHandler = function(){
	//crea una ventana 
	win = new Ext.Window({		
		width       : 500,
		height      : 470,
		closeAction :'hide',
		plain       : true,		
		
		items       : new Ext.FormPanel({
			id: 'producto-form',
			layout: 'form',
			frame: true,
			title: 'Ingrese los datos del Producto',
			autoHeight: true,
			bodyStyle: 'padding: 5px 5px 0 5px;',
			labelWidth: 100,
			
			items: [{
						id: 'cotizacionId',
						xtype:'hidden',
						name: 'cotizacionId',
						value: '<?=$cotizacion->getCaIdcotizacion()?>',
			            allowBlank:false
					},{
						id: 'productoId',
						xtype:'hidden',
						name: 'productoId',
						value: '',
			            allowBlank:false
					},{
						xtype:'textfield',
						fieldLabel: 'Producto',
						name: 'producto',
						value: '',						 
						allowBlank:false,
						width: 300
	                }
	                ,<?=extImpoExpo()?>
					,<?=extIncoterms()?>
					,<?=extTransporte()?>
					<? //extModalidad()?>
					,<?=extTraficos("origen")?>
					,<?=extTraficos("destino")?>
					,{
						xtype: 'textarea',
						width: 310,
						fieldLabel: 'Observaciones',
						name: 'observaciones',
						value: '',
	                    allowBlank:true
					}
					,{
						xtype: 'textfield',
						width: 100,
						fieldLabel: 'Frecuencia',
						name: 'frecuencia',
						value: '',
	                    allowBlank:false
					}
					,{
						xtype: 'textfield',
						width: 100,
						fieldLabel: 'T/Transito',
						name: 'ttransito',
						value: '',
	                    allowBlank:false
					}
					,<?=extImprimir()?>
					]
			
		}),

		buttons: [{
			text     : 'Guardar',
			handler: function(){
				var fp = Ext.getCmp("producto-form");	
												
				if( fp.getForm().isValid() ){
					fp.getForm().submit({url:'<?=url_for('cotizaciones/formProductoGuardar')?>', 
	            							 	waitMsg:'Salvando Datos de Productos...',
	            							 	// standardSubmit: false,
	            							 	
	            							 	success:function(response,options){
	            							 		Ext.Msg.alert( "Success "+response.responseText );
	            							 		win.close();
	            							 	},
		            							failure:function(response,options){
													Ext.Msg.alert( "Error "+response.responseText );
													win.close();
												}//end failure block      
											});
					}else{
						Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información del Producto no es válida o está incompleta!');
					}	            	
				}
		},{
			text     : 'Cancelar',
			handler  : function(){
				win.close();
			}
		}]
	});
	win.show( );	
}

/*
* Menu contextual que se despliega sobre una fila con el boton derecho
*/

var grid_productosOnRowcontextmenu =  function(grid, index, e){
		
	rec = this.store.getAt(index);

		this.menu = new Ext.menu.Menu({
		id:'grid_productos-ctx',
		items: [{
				text: 'Nuevo recargo',
				iconCls: 'new-tab',
				scope:this,
				handler: function(){    					                   
					if( this.ctxRecord.data.idopcion ){					
						var newRec = new recordProductos({
						   idcotizacion: this.ctxRecord.data.idcotizacion,  
						   idproducto: this.ctxRecord.data.idproducto,  
						   trayecto: this.ctxRecord.data.trayecto,   
						   transporte: this.ctxRecord.data.transporte,  
						   modalidad: this.ctxRecord.data.modalidad,   
						   idconcepto: this.ctxRecord.data.iditem,
						   idopcion: this.ctxRecord.data.idopcion,
						   item: '',
						   iditem: '',	
						   tipo: 'recargo',
						   valor_tar: '',
						   valor_min: '',
						   aplica_tar: '',
						   aplica_min: '',
						   idmoneda: '',
						   detalles: ''
						});					
						records = [];
						records.push( newRec );
						storeProductos.insert( index+1 , records );
					}						
				}
			}		
		]
	});
	this.menu.on('hide', this.onContextHide, this);
   
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
* Coloca las observaciones en pantalla y actualiza el datastore 
*/
var actualizarObservaciones=function( btn, text ){		
}	

function guardarGridProductos(){
	
	
	var success = true;
	var records = storeProductos.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
		
		changes['idproducto']=r.data.idproducto;	
		changes['tipo']=r.data.tipo;	
		changes['idopcion']=r.data.idopcion;				
		changes['idconcepto']=r.data.idconcepto;
		changes['iditem']=r.data.iditem;
		changes['modalidad']=r.data.modalidad;										
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("cotizaciones/observeItemsOpciones?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
				//method: 'POST', 
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
		//r.set("sel", false);//Quita la seleccion de todas las columnas 
	}
	
	if( success ){
		storeProductos.commitChanges();
		Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
	}else{
		Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
	}	
}

/*
* Determina que store se debe utilizar dependiendo si es un concepto o recargo
*/
grid_productosOnBeforeedit = function( e ){						
	if(e.field=="item"){
		var rec = e.record;
		var ed = this.colModel.getCellEditor(e.column, e.row);			
		if( rec.data.tipo == "concepto" ){
			storeConceptos.baseParams={transporte:rec.data.transporte, modalidad:rec.data.modalidad};			
		}
		
		if( rec.data.tipo == "recargo" ){			
			storeConceptos.baseParams={transporte:rec.data.transporte, modalidad:rec.data.modalidad, tipo:'Recargo en Origen', modo:'recargos'};				
		}	
		
		storeConceptos.load();	
		
	}	
		
}
				

function agregarFila(ctxRecord, index){	
}

/*
* Crea la grilla 
*/    
var grid_productos = new Ext.grid.EditorGridPanel({
	store: storeProductos,
	master_column_id : 'producto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'producto',
	title: 'Productos/Tarifas',

	root_title: 'impoexpo',	
	// plugins: [checkColumn], //expander,
	closable: true,
	id: 'grid_productos',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'disk',  // reference to our css
		handler: guardarGridProductos
	},
	{
		text: 'Agregar producto',
		tooltip: '...', 
		iconCls:'add',  // reference to our css
		handler: productoHandler
	}
	
	],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true, 
		getRowClass: function(  record,  index,  rowParams,  storeProductos ){			
			switch( record.data.style ){
				case "yellow":
					return "row_yellow";
					break;
				case "pink":
					return "row_pink";
					break;
				default:
					return "";
					break;
			}
		} 
	})	,
	
	listeners:{ validateedit: grid_productosOnvalidateedit,
				rowcontextmenu:grid_productosOnRowcontextmenu,
				beforeedit:grid_productosOnBeforeedit
				 }
});
