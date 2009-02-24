<?
/*
* Permite crear trayectos en la cotización e incluir diferentes 
* opciones de fletes y recargos
* @author: Andres Botero
*/
use_helper("Ext2");
?>
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
	selectOnFocus: true,					
	name: 'recargo',
	id: 'recargo',
	mode: 'local',
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
	{name: 'id', type: 'int'},   
    {name: 'idcotizacion', type: 'string'},   		
    {name: 'idproducto', type: 'string'},   
	{name: 'producto', type: 'string'}, 
	{name: 'idopcion', type: 'string'}, 		
    {name: 'trayecto', type: 'string'},   				
	{name: 'item', type: 'string'},  //Texto de concepto o recargo 
	{name: 'iditem', type: 'string'}, //Concepto o recargo  	 
	{name: 'idconcepto', type: 'string'}, //Concepto al cual pertenece el recargo	
	
	{name: 'tra_origen', type: 'string'}, 
	{name: 'tra_origen_value', type: 'string'}, 
	{name: 'ciu_origen', type: 'string'}, 
	{name: 'ciu_origen_value', type: 'string'}, 
	{name: 'tra_destino', type: 'string'}, 
	{name: 'tra_destino_value', type: 'string'},
	{name: 'ciu_destino', type: 'string'},
	{name: 'ciu_destino_value', type: 'string'}, 
	{name: 'tra_escala', type: 'string'}, 
	{name: 'tra_escala_value', type: 'string'},
	{name: 'ciu_escala', type: 'string'},
	{name: 'ciu_escala_value', type: 'string'}, 
		
	{name: 'valor_tar', type: 'float'}, 
	{name: 'valor_min', type: 'float'}, 
	{name: 'aplica_tar', type: 'string'}, 
	{name: 'aplica_min', type: 'string'}, 
	{name: 'idmoneda', type: 'string'},
	{name: 'detalles', type: 'string'},
	{name: 'tipo', type: 'string'},
	{name: 'transporte', type: 'string'},
	{name: 'modalidad', type: 'string'},
	{name: 'frecuencia', type: 'string'},
	{name: 'ttransito', type: 'string'},
	{name: 'imprimir', type: 'string'},
	{name: 'impoexpo', type: 'string'},
	{name: 'incoterms', type: 'string'},
	{name: 'observaciones', type: 'string'},
	{name: 'idlinea', type: 'string'},
	{name: 'linea', type: 'string'},
	{name: 'postular_linea', type: 'string'},
	{name: 'consecutivo', type: 'string'},	
	{name: 'orden', type: 'string'},	
	{name: 'parent', type: 'int'},				
]);
   		
/*
* Crea el store
*/
var storeProductos = new Ext.data.GroupingStore({
	autoLoad : true,
	url: '<?=url_for("cotizaciones/grillaProductosData?idcotizacion=".$cotizacion->getCaIdCotizacion())?>',
	reader: new Ext.data.JsonReader(
		{
			//id: 'id',
			root: 'productos',
			totalProperty: 'total'
		}, 
		recordProductos
	),
	sortInfo:{field: 'orden', direction: "ASC"},	
	groupField: 'trayecto'		
});
		
/*
* Crea la columna de chequeo
*/	


/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/

// turn on validation errors beside the field globally
Ext.form.Field.prototype.msgTarget = 'side';

var formatItem = function(value, p, record) {

	if( record.data.tipo == "recargo" ){
		return String.format(
			'<div class="recargo">{0}</div>',
			value
		);
	}else{
		return String.format(
			'<b>{0}</b>',
			value
		);
	}
}

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
			editor: editorConceptos,
			renderer: formatItem
		},	
		{
			id: 'valor_tar',
			header: "Valor",
			width: 80,
			sortable: false,
			dataIndex: 'valor_tar',
			hideable: false ,
			editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
		},
		{
			id: 'aplica_tar',
			header: "Aplicación",
			width: 100,
			sortable: false,
			dataIndex: 'aplica_tar',			
			hideable: false,
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>	 
		},
		{
			id: 'valor_min',
			header: "Minimo",
			width: 80,
			sortable: false,
			dataIndex: 'valor_min',
			hideable: false ,
			editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
		},
		{
			id: 'aplica_min',
			header: "Aplicación Min",
			width: 100,
			sortable: false,
			dataIndex: 'aplica_min',
			hideable: false,
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?> 
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 65,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false ,
			editor: <?=extMonedas()?>
		}		,		
		{
			id: 'detalles',
			header: "Detalles",
			width: 100,
			sortable: false,
			dataIndex: 'detalles',			
			hideable: false ,
			editor: new Ext.form.TextField({
				allowBlank: false ,				
				style: 'text-align:left',
				allowBlank: true
			})
		}
		/*	
		,
		{			
			header: "Id",
			width: 100,
			dataIndex: 'id'
		},
		{			
			header: "Parent",
			width: 100,			
			dataIndex: 'parent'
			
		}	,
		{			
			header: "Orden",
			width: 100,			
			dataIndex: 'orden'
			
		}	*/	
	]
	,
	isCellEditable: function(colIndex, rowIndex) {	
		var record = storeProductos.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
			
		if( !record.data.iditem && field!="item" ){
			return false;
		}
		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);		
	}
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
						var newRec = new recordProductos({
						   id: rec.data.id+20,  
						   idcotizacion: rec.data.idcotizacion,  
						   idproducto: rec.data.idproducto,  
						   trayecto: rec.data.trayecto,   
						   transporte: rec.data.transporte,  
						   modalidad: rec.data.modalidad,   
						   idconcepto: rec.data.iditem,
						   idopcion: rec.data.idopcion,
						   producto: rec.data.producto,
						   tra_origen: rec.data.tra_origen,
						   tra_origen_value: rec.data.tra_origen_value,
						   ciu_origen: rec.data.ciu_origen,
						   ciu_origen_value: rec.data.ciu_origen_value,
						   tra_destino: rec.data.tra_destino,
						   tra_destino_value: rec.data.tra_destino_value,
						   ciu_destino: rec.data.ciu_destino,
						   ciu_destino_value: rec.data.ciu_destino_value,
						   tra_escala: rec.data.tra_escala,
						   tra_escala_value: rec.data.tra_escala_value,
						   ciu_escala: rec.data.ciu_escala,
						   ciu_escala_value: rec.data.ciu_escala_value,
						   impoexpo: rec.data.impoexpo,
						   incoterms: rec.data.incoterms,
						   frecuencia: rec.data.frecuencia,
						   ttransito: rec.data.ttransito,
						   imprimir: rec.data.imprimir,
						   observaciones: rec.data.observaciones,
						   idlinea: '',
						   linea: '',
						   postular_linea: '',				  
						   
						   item: '+',
						   iditem: '',	
						   tipo: 'concepto',
						   valor_tar: '',
						   valor_min: '',
						   aplica_tar: '',
						   aplica_min: '',
						   idmoneda: '',
						   detalles: '',
						   orden: '9999-9999'
						});	
						rec.data.parent = rec.data.id;
						rec.data.orden = rec.data.id;
						//newRec.id = rec.data.id+20;		
						newRec.data.concepto = "";												
						//Inserta una columna en blanco al final
												
						storeProductos.addSorted(newRec);
						
					}
					rec.set("idmoneda", "USD");
					rec.set("iditem", r.data.idconcepto);					
					e.value = r.data.concepto;			
						
					return true;
				}
			}
		)		
	}
}

/*
* Muestra una ventana enla que se puede crear o editar un trayecto 
*/
var crearVentanaProducto=function( record ){
	
	//crea una ventana 
	win = new Ext.Window({		
		width       : 500,
		height      : 650,
		closeAction :'close',
		plain       : true,		
		
		items       : new Ext.FormPanel({
			id: 'producto-form',
			layout: 'form',
			frame: true,
			title: 'Ingrese los datos del trayecto',
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
						id: 'idproducto',
						xtype:'hidden',
						name: 'idproducto',
						value: '',
			            allowBlank:false
					},{
						xtype:'textfield',
						fieldLabel: 'Producto',
						id: 'producto',
						name: 'producto',
						value: '',						 
						allowBlank:false,
						width: 300
	                }	                
					,<?=include_component("widgets", "impoexpo" ,array("id"=>"impoexpo", "label"=>"Impo/Expo"))?>
					,<?=extIncoterms("incoterms")?>
					,<?=extTransporte("transporte")?>
					
					,<?=include_component("widgets", "modalidades" ,array("id"=>"modalidad", "label"=>"Modalidad", "allowBlank"=>"false", "transporte"=>"transporte", "impoexpo"=>"impoexpo"))?>			
					,<?=include_component("widgets", "lineas" ,array("id"=>"idlinea", "label"=>"Linea", "allowBlank"=>"true", "link"=>"transporte" ))?>
					,{
						xtype:'checkbox',
						fieldLabel: 'Postular nombre de Linea',
						id: 'postular_linea',
						name: 'postular_linea',
						value: false,
						width: 300
	                }
					,<?=include_component("widgets", "paises" ,array("id"=>"tra_origen", "label"=>"Pais Origen", "allowBlank"=>"false"))?>										
					,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "link"=>"tra_origen", "allowBlank"=>"false"))?>
							
					
					,<?=include_component("widgets", "paises" ,array("id"=>"tra_destino", "label"=>" Pais Destino", "value"=>"C0-057", "allowBlank"=>"false"))?>									,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "link"=>"tra_destino", "allowBlank"=>"false"))?>
					,<?=include_component("widgets", "paises" ,array("id"=>"tra_escala", "label"=>"Pais Escala"))?>										
					,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_escala", "label"=>"Ciudad Escala", "link"=>"tra_escala"))?>
					,{
						xtype: 'textarea',
						width: 310,
						height: 40,
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
	                    allowBlank:true
					}
					,{
						xtype: 'textfield',
						width: 100,						
						fieldLabel: 'T/Transito',
						name: 'ttransito',
						value: '',
	                    allowBlank:true
					}
					,<?=extImprimir("imprimir")?>
				]
				
					
			
		}),

		buttons: [{
			text     : 'Guardar',
			handler: function(){
				var fp = Ext.getCmp("producto-form");									
				if( fp.getForm().isValid() ){
						
					ttransito = fp.getForm().findField("ttransito").getValue();								
					frecuencia = fp.getForm().findField("frecuencia").getValue();								
					impoexpo = fp.getForm().findField("impoexpo").getValue();								
					transporte = fp.getForm().findField("transporte").getValue();		
					
					if( ttransito=="" && frecuencia=="" && ((impoexpo=="<?=Constantes::IMPO?>" && transporte!="<?=Constantes::AEREO?>") || impoexpo=="<?=Constantes::EXPO?>" ) ){ // Solamente cuando es importación aérea se permite en blanco
						Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', 'Por favor indique el tiempo de transito y la frecuencia');
					}else{					
					
						fp.getForm().submit({url:'<?=url_for('cotizaciones/formProductoGuardar')?>', 
												waitMsg:'Salvando Datos de Productos...',
												// standardSubmit: false,
												
												success:function(response,options){
													//Ext.Msg.alert( "Success "+response.responseText );													
													storeProductos.reload();
													win.close();
												},
												failure:function(response,options){
													Ext.Msg.alert( "Error "+response.responseText );
													win.close();
												}//end failure block      
											});
					}						
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
	
	if(typeof(record)!="undefined"){ // Coloca los datos en la ventana 		
		var fp = Ext.getCmp("producto-form");
		form = fp.getForm().loadRecord(record);		
		fp.getForm().findField("tra_origen_id").setRawValue(record.data.tra_origen_value);
		fp.getForm().findField("tra_origen_id").hiddenField.value = record.data.tra_origen;		
		fp.getForm().findField("ciu_origen_id").setRawValue(record.data.ciu_origen_value);
		fp.getForm().findField("ciu_origen_id").hiddenField.value = record.data.ciu_origen;
		
		fp.getForm().findField("tra_destino_id").setRawValue(record.data.tra_destino_value);
		fp.getForm().findField("tra_destino_id").hiddenField.value = record.data.tra_destino;		
		fp.getForm().findField("ciu_destino_id").setRawValue(record.data.ciu_destino_value);
		fp.getForm().findField("ciu_destino_id").hiddenField.value = record.data.ciu_destino;	
		
		fp.getForm().findField("tra_escala_id").setRawValue(record.data.tra_escala_value);
		fp.getForm().findField("tra_escala_id").hiddenField.value = record.data.tra_escala;		
		fp.getForm().findField("ciu_escala_id").setRawValue(record.data.ciu_escala_value);
		fp.getForm().findField("ciu_escala_id").hiddenField.value = record.data.ciu_escala;		
		fp.getForm().findField("idlinea").setRawValue(record.data.linea);
		fp.getForm().findField("idlinea").hiddenField.value = record.data.idlinea;	
		
	}	
}



/*
* Crea una ventana con una vista del tarifario donde se pueden seleccionar 
* e importar las tarifas dentro de la cotizacion
*/


var activeRecord = null;
/*
* Muestra una ventana con la informacion del tarifario y le permite al usuario 
* seleccionar las tarifas a importar
*/
var ventanaTarifario = function( record ){
	var url = '<?=url_for("pricing/grillaPorTrafico?opcion=consulta")?>';
	
	activeRecord = record;
	if(record.data.impoexpo=="<?=Constantes::IMPO?>"){
		idciudad = record.data.ciu_origen;
		idciudad2 = record.data.ciu_destino;		
		idtrafico = record.data.tra_origen;
	}
	
	if(record.data.impoexpo=="<?=Constantes::EXPO?>"){
		idciudad2 = record.data.ciu_origen;
		idciudad = record.data.ciu_destino;
		idtrafico = record.data.tra_destino; 
	}
	
	Ext.Ajax.request({
		url: url,
		params: {						
			idtrafico: idtrafico, 
			idciudad: idciudad,
			idciudad2: idciudad2,
			transporte: record.data.transporte,
			impoexpo: record.data.impoexpo,
			modalidad: record.data.modalidad,
			idlinea: record.data.idlinea
		},
		success: function(xhr) {			
			//alert( xhr.responseText );			
			var newComponent = eval(xhr.responseText);
			
			//Se crea la ventana
			
			win = new Ext.Window({		
			width       : 800,
			height      : 460,
			closeAction :'close',
			plain       : true,		
			
			items       : [newComponent],
			
	
			buttons: [
				{
					text     : 'Importar',
					handler  : function( ){						
						storePricing = newComponent.store;
						
						/*
						* Busca el ultimo elemento para insertar al final del grupo
						*/
						var flag = false;						
						storeProductos.each( function( record ){																					
								if( record.data.id==activeRecord.id ){		
									flag=true;
								}									
								if(flag){
									if(!record.data.iditem){
										activeRecord = record;
										flag=false;
										return 0;
									}
								}									
						});						
						
						index =  storeProductos.indexOf(activeRecord);
						var j = 0;	
						var parent = null;					
						storePricing.each( function(r){
							if( r.data.sel==true && r.data.tipo!="trayecto_obs"  ){
							
								var iditem = r.data.iditem;								
								//Cuando se habla de LCL se colocan los minimos
								if( r.data.tipo=="concepto" ){
									var valor_tar = r.data.sugerida; //Minima sugerida de venta
									var valor_min = ''; //No aplica
								}else{	
									var valor_tar = r.data.sugerida;
									var valor_min = r.data.minima;									
								}
								
								if(r.data.tipo=="concepto"){
									j+=20;
								}else{
									j+=1;
								}
								
								var newId = activeRecord.data.id+j;
								
								if(r.data.tipo=="concepto"){
									parent = newId;
								}
								
								var newRec = new recordProductos({
								   id: newId,  
								   idcotizacion: activeRecord.data.idcotizacion,  
								   idproducto: activeRecord.data.idproducto,  
								   trayecto: activeRecord.data.trayecto,   
								   transporte: activeRecord.data.transporte,  
								   modalidad: activeRecord.data.modalidad,   
								   idconcepto: activeRecord.data.iditem,
								   idopcion: '',
								   producto: activeRecord.data.producto,
								   tra_origen: activeRecord.data.tra_origen,
								   tra_origen_value: activeRecord.data.tra_origen_value,
								   ciu_origen: activeRecord.data.ciu_origen,
								   ciu_origen_value: activeRecord.data.ciu_origen_value,
								   tra_destino: activeRecord.data.tra_destino,
								   tra_destino_value: activeRecord.data.tra_destino_value,
								   ciu_destino: activeRecord.data.ciu_destino,
								   ciu_destino_value: activeRecord.data.ciu_destino_value,
								   tra_escala: activeRecord.data.tra_escala,
								   tra_escala_value: activeRecord.data.tra_escala_value,
								   ciu_escala: activeRecord.data.ciu_escala,
								   ciu_escala_value: activeRecord.data.ciu_escala_value,
								   impoexpo: activeRecord.data.impoexpo,
								   incoterms: activeRecord.data.incoterms,
								   frecuencia: activeRecord.data.frecuencia,
								   ttransito: activeRecord.data.ttransito,
								   imprimir: activeRecord.data.imprimir,
								   observaciones: activeRecord.data.observaciones,		  
								   item: '',
								   iditem: '',	
								   tipo: '',
								   valor_tar: '',
								   valor_min: '',
								   aplica_tar: '',
								   aplica_min: '',
								   idmoneda: '',
								   detalles: '',
								   parent: parent,
								   orden: parent+'-'+newId
								});	
								j++;
								
								
								newRec.set("trayecto", activeRecord.data.trayecto );
								
								//activeRecord.id=newId+20;
								activeRecord.data.id=newId+20;
								newId = newRec.id;								
								storeProductos.addSorted( newRec );
								
								//Es necesario buscar de nuevo el record dentro del store
								//para que se activen los eventos de edición del store																
								var newRec = storeProductos.getById( newId ); 
								
																	
								newRec.set("item", r.data.nconcepto );
								newRec.set("idconcepto", r.data.idconcepto )
								
								newRec.set("iditem", iditem );
								
								if(r.data.tipo=="recargoxciudad"){
									var tipo="recargo";
								}else{
									var tipo = r.data.tipo;
								}								
								newRec.set("tipo", tipo );								
								newRec.set("valor_tar", valor_tar );								
								newRec.set("aplica_tar", r.data.aplicacion );
								newRec.set("aplica_min", r.data.aplicacion_min );
								newRec.set("valor_min", valor_min );
								newRec.set("idmoneda", r.data.moneda );	
								newRec.set("consecutivo", r.data.consecutivo );																												
								index++;
							}
						} );
										
						win.close();
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
			Ext.Msg.alert("Tab creation failed", "Server communication failure");
		}
	});	
}


/*
* Muestra una ventana con la informacion de los archivos tarifario del trafico
*/
var ventanaTarifarioArchivos = function( record ){
	var url = '<?=url_for("pricing/archivosPais?opcion=consulta")?>';
	
	activeRecord = record;
	if(record.data.impoexpo=="<?=Constantes::IMPO?>"){		
		idtrafico = record.data.tra_origen;
	}
	
	if(record.data.impoexpo=="<?=Constantes::EXPO?>"){
		idtrafico = record.data.tra_destino; 
	}
	
	Ext.Ajax.request({
		url: url,
		params: {						
			idtrafico: idtrafico, 			
			transporte: record.data.transporte,
			impoexpo: record.data.impoexpo,
			modalidad: record.data.modalidad
		},
		success: function(xhr) {			
			//alert( xhr.responseText );			
			var newComponent = eval(xhr.responseText);
			
			//Se crea la ventana			
			win = new Ext.Window({		
			width       : 550,
			height      : 300,
			closeAction :'close',
			plain       : true,				
			items       : [newComponent]		
		});		
		win.show( );		
		},
		failure: function() {
			Ext.Msg.alert("Win creation failed", "Server communication failure");
		}
	});	
}

var mostrarCabotajes = function( rec ){
	var rec = rec.copy();
	rec.data.modalidad="CABOTAJE"; 
	rec.data.tra_origen=""; 
	rec.data.tra_destino=""; 
	rec.data.impoexpo="<?=Constantes::IMPO?>"; 
	rec.data.transporte="<?=Constantes::AEREO?>";	
	ventanaTarifario( rec );
	
}

var productoHandler = function( ){
	crearVentanaProducto( );		
}



/*
* Menu contextual que se despliega sobre una fila con el boton derecho
*/

var grid_productosOnRowcontextmenu =  function(grid, index, e){		
	rec = this.store.getAt(index);	
	this.menu = new Ext.menu.Menu({
	id:'grid_productos-ctx',
	items: [{
				text: 'Editar trayecto',
				iconCls: 'page_white_edit',
				scope:this,
				handler: function(){    					                   
					if( this.ctxRecord ){					
						crearVentanaProducto( this.ctxRecord );
					}						
				}
			},
			{
				text: 'Importar del tarifario',
				iconCls: 'import',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord ){					
						ventanaTarifario( this.ctxRecord );
					}						
				}
			},
			{
				text: 'Archivos del tarifario',
				iconCls: 'import',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord ){					
						ventanaTarifarioArchivos( this.ctxRecord );
					}						
				}
			},
			{
				text: 'Informacion de cabotajes',
				iconCls: 'information',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord ){					
						mostrarCabotajes( this.ctxRecord );
					}						
				}
			}			
			,		
			{
				text: 'Nuevo recargo',
				iconCls: 'textfield_add',
				scope:this,
				handler: function(){    					                   
					rec = this.ctxRecord;					
					if( rec.data.iditem ){									
						if( rec.data.tipo=="concepto"){
							var idconcepto = rec.data.iditem;
							var parent = rec.data.parent;							
						}else{
							var idconcepto = rec.data.idconcepto;
							var parent = rec.data.parent;
						}
						
						
						newId = rec.data.id+1;
												
						var newRec = new recordProductos({
						   id: newId,  
						   idcotizacion: rec.data.idcotizacion,  
						   idproducto: rec.data.idproducto,  
						   trayecto: rec.data.trayecto,   
						   transporte: rec.data.transporte,  
						   modalidad: rec.data.modalidad,   
						   idconcepto: idconcepto,
						   idopcion: rec.data.idopcion,
						   producto: rec.data.producto,
						   tra_origen: rec.data.tra_origen,
						   tra_origen_value: rec.data.tra_origen_value,
						   ciu_origen: rec.data.ciu_origen,
						   ciu_origen_value: rec.data.ciu_origen_value,
						   tra_destino: rec.data.tra_destino,
						   tra_destino_value: rec.data.tra_destino_value,
						   ciu_destino: rec.data.ciu_destino,
						   ciu_destino_value: rec.data.ciu_destino_value,
						   tra_escala: rec.data.tra_escala,
						   tra_escala_value: rec.data.tra_escala_value,
						   ciu_escala: rec.data.ciu_escala,
						   ciu_escala_value: rec.data.ciu_escala_value,
						   impoexpo: rec.data.impoexpo,
						   incoterms: rec.data.incoterms,
						   frecuencia: rec.data.frecuencia,
						   ttransito: rec.data.ttransito,
						   imprimir: rec.data.imprimir,
						   observaciones: rec.data.observaciones,				  
						   
						   item: '+',
						   iditem: '',	
						   tipo: 'recargo',
						   valor_tar: '',
						   valor_min: '',
						   aplica_tar: '',
						   aplica_min: '',
						   idmoneda: '',
						   detalles: '',
						   parent: parent,
						   orden: parent+"-"+newId
						});	
						//newRec.id = rec.data.id+1; 										
						storeProductos.addSorted(newRec);
						newRec.set("idmoneda", "USD");
					}						
				}				
			},			
			{
				text: 'Eliminar item',
				iconCls: 'delete',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord && this.ctxRecord.data.iditem && confirm("Desea continuar?") ){					
						if( this.ctxRecord.data.tipo=="concepto" ){ 
							var idconcepto = this.ctxRecord.data.iditem;
							var idrecargo = "";						
						}else{
							var idconcepto = this.ctxRecord.data.idconcepto;
							var idrecargo = this.ctxRecord.data.iditem;
						}
						
						
						var id = this.ctxRecord.data.id;
						var tipo = this.ctxRecord.data.tipo;
						var idopcion = this.ctxRecord.data.idopcion;
						var idproducto = this.ctxRecord.data.idproducto;
						var modalidad = this.ctxRecord.data.modalidad;
						if( idopcion ){
							Ext.Ajax.request( 
							{   
								waitMsg: 'Guardando cambios...',						
								url: '<?=url_for("cotizaciones/eliminarItemsOpciones?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
								//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{
									idconcepto: idconcepto,
									idrecargo: idrecargo, 
									tipo: tipo,
									idopcion: idopcion,
									idproducto: idproducto,
									modalidad: modalidad
								},
														
								//Ejecuta esta accion en caso de fallo
								//(404 error etc, ***NOT*** success=false)
								failure:function(response,options){							
									alert( response.responseText );						
									success = false;
								},
								//Ejecuta esta accion cuando el resultado es exitoso
								success:function(response,options){							
									var flag = false;
									storeProductos.each( function( record ){
										if( record.data.tipo=="concepto" && flag ){
											flag=false;
										}
										
										if(tipo=="concepto"){																			
											if( record.data.tipo=="concepto"&& record.data.id==id ){												
												storeProductos.remove(record);
												flag=true;																																																									
											}												
										}		
										
										/*
										* Se deben eliminar los recargos del concepto que se elimino ya que al enviar la 
										* petición son borrados de la base de datos. 
										*/
										if( flag==true && record.data.tipo=="recargo" ){											
											storeProductos.remove(record);
										}else{																		
											if(tipo=="recargo"){											
												if( record.data.tipo=="recargo"&&record.data.id==id ){
													storeProductos.remove(record);
												}
											}
										}	
									});
								}
							}); 
						}
					}						
				}
			},
			{
				text: 'Eliminar trayecto',
				iconCls: 'delete',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord && confirm("Desea continuar?") ){					
						var idproducto = this.ctxRecord.data.idproducto;
						
						Ext.Ajax.request( 
						{   
							waitMsg: 'Guardando cambios...',						
							url: '<?=url_for("cotizaciones/eliminarProducto?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
							//method: 'POST', 
							//Solamente se envian los cambios 						
							params :	{								
								idproducto: idproducto								
							},
													
							//Ejecuta esta accion en caso de fallo
							//(404 error etc, ***NOT*** success=false)
							failure:function(response,options){							
								alert( response.responseText );						
								success = false;
							},
							//Ejecuta esta accion cuando el resultado es exitoso
							success:function(response,options){							
								 storeProductos.each( function( record ){						 							 									if( record.data.idproducto==idproducto ){
										 storeProductos.remove(record);
									}																																												
								 });
							}
						 }
					); 
					}						
				}
			},
			{
				text: 'Observaciones',
				iconCls: 'page_white_edit',
				scope:this,
				handler: function(){ 
					if( this.ctxRecord.data.iditem  ){
						grid_productosObservacionesHandler( this.ctxRecord );  					                   										
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
* Coloca las observaciones en pantalla y actualiza el datastore 
*/
var actualizarObservaciones=function( btn, text ){		
}	

function guardarGridProductos(){	
	var success = true;	
	var records = storeProductos.getModifiedRecords();
	var lenght = records.length;
	
	//Se hace la valida que se hayan colocado todos los datos
	for( var i=0; i< lenght; i++){	
		r = records[i];		
		//alert( r.data.iditem );
		if( !r.data.idmoneda && r.data.iditem!=9999 ){
			Ext.MessageBox.alert('Warning','Por favor coloque la moneda en todos los items en la pestaña Tarifas de trayectos');
			return 0;
		}
	}
	
	for( var i=0; i< lenght; i++){
		r = records[i];					
		var changes = r.getChanges();
		//alert( r.data.id );
		changes['id']=r.id;
		changes['parent']=r.data.parent;
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
					//alert( response.responseText );						
					success = false;
				},
				//Ejecuta esta accion cuando el resultado es exitoso
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );					
					var rec = storeProductos.getById( res.id );										
					rec.set("idopcion", res.idopcion );											
					rec.commit();	
					
					//Se coloca el id del padre en la bd
					storeProductos.each( function(r){
						if(r.data.parent == rec.data.parent && r.data.tipo=="recargo"  ){							
							r.set("idopcion", res.idopcion );		
						}
					} );								
				}
			 }
		); 		
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
			storeConceptos.baseParams={transporte:rec.data.transporte, modalidad:rec.data.modalidad, tipo:'Recargo en Origen', impoexpo:rec.data.impoexpo , modo:'recargos'};				
		}			
		storeConceptos.load();		
	}	
	
	if( e.field=="aplica_tar" || e.field=="aplica_min" ){						
		var dataAereo = [
			<?
			$i=0;
			foreach( $aplicacionesAereo as $aplicacion ){
				if( $i++!=0){
					echo ",";
				}
			?>
				['<?=$aplicacion->getCaValor()?>']
			<?
			}
			?>
		];
		
		var dataMaritimo = [
			<?
			$i=0;
			foreach( $aplicacionesMaritimo as $aplicacion ){
				if( $i++!=0){
					echo ",";
				}
			?>
				['<?=$aplicacion->getCaValor()?>']
			<?
			}
			?>
		];
		
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		if( e.record.data.transporte=="<?=Constantes::AEREO?>" ){
			ed.field.store.loadData( dataAereo );
		}else{
			ed.field.store.loadData( dataMaritimo );
		}
	}
		
}

	
/*
* Handlers de los eventos y botones de la grilla 
*/

var grid_productosObservacionesHandler = function( rec ){
	//crea una ventana 
	win = new Ext.Window({		
		width       : 500,
		height      : 200,
		closeAction :'close',
		plain       : true,		
		
		items       : new Ext.FormPanel({
			id: 'producto-form-obs',
			layout: 'form',
			frame: true,
			title: 'Ingrese las observaciones',
			autoHeight: true,
			bodyStyle: 'padding: 5px 5px 0 5px;',
			labelWidth: 100,
			
			items: [
					{
						xtype: 'textarea',
						width: 310,
						
						fieldLabel: 'Observaciones',
						name: 'observaciones',
						value: rec.data.detalles,
	                    allowBlank:true
					}
					]
			
		}),

		buttons: [{
			text     : 'Ok',
			handler: function(){
				var fp = Ext.getCmp("producto-form-obs");													
				if( fp.getForm().isValid() ){
										
					rec.set( "detalles",  fp.getForm().findField("observaciones").getValue() );
					win.close();           	
					
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
	title: 'Tarifas de trayectos',

	root_title: 'impoexpo',	
	// plugins: [checkColumn], //expander,
	closable: false,
	id: 'grid_productos',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls: 'disk',  // reference to our css
		handler: guardarItems
	},
	{
		text: 'Agregar trayecto',
		tooltip: 'Agregar un nuevo producto a la Cotización',
		iconCls: 'add',  // reference to our css
		handler: productoHandler
	}	
	],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true, 
		enableGroupingMenu: false,	
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
	}),
	
	listeners:{ 
		validateedit: grid_productosOnvalidateedit,
		rowcontextmenu:grid_productosOnRowcontextmenu,
		beforeedit:grid_productosOnBeforeedit
		
	}
});
