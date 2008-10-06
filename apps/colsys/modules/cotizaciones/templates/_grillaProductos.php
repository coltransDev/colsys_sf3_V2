<?
use_helper("Ext2");
?>

var data_productos = <?=json_encode( array("productos"=>$productos, "total"=>count($productos)) )?>;
/*
* Crea el Record 
*/
var recordGrilla = Ext.data.Record.create([
    {name: 'idcotizacion', type: 'string'},   		
    {name: 'idproducto', type: 'string'},   		
    {name: 'trayecto', type: 'string'},   
				
	{name: 'item', type: 'string'},  //Texto de concepto o recargo 
	{name: 'iditem', type: 'string'}, //Concepto o recargo  	 
	
	{name: 'moneda', type: 'string'},
	{name: 'detalles', type: 'string'}
	
]);
   		
/*
* Crea el store
*/
<?



?>
var storeProductos = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'id',
			root: 'productos',
			totalProperty: 'total'
		}, 
		recordGrilla
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
			editor: new Ext.form.ComboBox({
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
				
				store : new Ext.data.Store({
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
					),
					baseParams:{transporte:'Marítimo',modalidad:'FCL'}
				})
			})
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
			id: 'moneda',
			header: "Moneda",
			width: 100,
			sortable: false,
			dataIndex: 'moneda',
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
					rec.set("iditem", r.data.idconcepto);
					e.value = r.data.concepto;
					
					
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
					,<?=extModalidad()?>
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
* Coloca las observaciones en pantalla y actualiza el datastore 
*/
var actualizarObservaciones=function( btn, text ){		
}	

function updateModel(){
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
		handler: updateModel
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
	
	listeners:{ validateedit: grid_productosOnvalidateedit }
});
