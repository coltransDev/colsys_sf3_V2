<?
use_helper("Ext2");
?>
  

/*
* Crea el Record 
*/
var recordGrilla = Ext.data.Record.create([
	{name: 'oid', type: 'int'},  
    {name: 'idcotizacion', type: 'string'},   		
    {name: 'tipo', type: 'string'},   		
    {name: 'modalidad', type: 'string'},   		
    {name: 'origen', type: 'string'},   		
	{name: 'ciuorigen', type: 'string'},
	{name: 'destino', type: 'string'},
	{name: 'ciudestino', type: 'string'},
	{name: 'idconcepto', type: 'string'},
	{name: 'concepto', type: 'string'},
	{name: 'idequipo', type: 'string'},
	{name: 'equipo', type: 'string'},
	{name: 'valor_tar', type: 'string'},
	{name: 'valor_min', type: 'string'},
	{name: 'idmoneda', type: 'string'},
	{name: 'frecuencia', type: 'string'},
	{name: 'ttransito', type: 'string'},
	{name: 'observaciones', type: 'string'}
]);
  
   		
/*
* Crea el store
*/
var storeContViajes = new Ext.data.GroupingStore({
	autoLoad : true,
	url: '<?=url_for("cotizaciones/datosContinuacionViaje?idcotizacion=".$cotizacion->getCaIdCotizacion() )?>',
	reader: new Ext.data.JsonReader(
		{
			id: 'contviaje',
			root: 'contviajes',
			totalProperty: 'total'
		}, 
		recordGrilla
	),
	sortInfo:{field: 'modalidad', direction: "ASC"},
	//proxy: new Ext.data.MemoryProxy(data_contviajes),
	groupField: 'tipo'		
});
	
storeContViajes.load();	
		
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
			id: 'tipo',
			header: "Tipo",
			width: 40,
			sortable: true,			
			dataIndex: 'tipo',
			hideable: false,
			editor: <?=extOtmDta("tipo")?>
		},	
		{
			id: 'cotizacionId',
			header: "cotizacionId",
			width: 10,
			sortable: true,
			dataIndex: 'idcotizacion',
			hideable: false,
			hidden: true
		},
		{
			id: 'modalidad',
			header: "Modalidad",
			width: 60,
			sortable: true,			
			dataIndex: 'modalidad',
			hideable: false,
			editor: <?=extModalidad("modalidad", Constantes::MARITIMO, Constantes::IMPO )?>
		},
		{
			id: 'ciuorigen',
			header: "Origen",
			width: 80,
			sortable: true,
			dataIndex: 'ciuorigen',
			hideable: false,
			editor: <?=include_component("widgets", "ciudades" ,array("id"=>"origen", "label"=>"Ciudad Origen", "idpais"=>"CO-057" ))?>
		},
		{
			id: 'ciudestino',
			header: "Destino",
			width: 80,
			sortable: true,
			dataIndex: 'ciudestino',
			hideable: false,
			editor: <?=include_component("widgets", "ciudades" ,array("id"=>"destino", "label"=>"Ciudad Destino", "idpais"=>"CO-057" ))?>
		},
		{
			id: 'concepto',
			header: "Concepto",
			width: 90,
			sortable: true,
			dataIndex: 'concepto',
			hideable: false,
			editor: <?=extConcepto($id="conceptoOtmDta", Constantes::TERRESTRE, $modalidad="OTM-DTA")?>
		},
		{
			id: 'equipo',
			header: "Equipo",
			width: 100,
			sortable: true,
			dataIndex: 'equipo',
			hideable: false,
			editor: <?=extConcepto($id="equipo", Constantes::MARITIMO)?>
		},
		{
			id: 'valor_tar',
			header: "Tarifa",
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_tar',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'valor_tar',
						allowBlank:false,
						allowNegative: false
			})
		},
		{
			id: 'valor_min',
			header: "Mínimo",
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_min',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 100,
			sortable: true,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=extMonedas()?>
		},
		{
			id: 'frecuencia',
			header: "Frecuencia",
			width: 100,
			sortable: true,
			dataIndex: 'frecuencia',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'frecuencia',
						allowBlank:false
			})
		},
		{
			id: 'ttransito',
			header: "Tiempo/Transito",
			width: 100,
			sortable: true,
			dataIndex: 'ttransito',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'ttransito',
						allowBlank:false
			}) 
		},
		{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: true,
			dataIndex: 'observaciones',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'observaciones',
						allowBlank:false
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

var contviajeHandler = function(){
	//crea una ventana 
	win = new Ext.Window({		
		width       : 500,
		height      : 470,
		closeAction :'hide',
		plain       : true,		
		
		items       : new Ext.FormPanel({
			id: 'contviaje-form',
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
			        }
					,<?=extOtmDta("tipo")?>
					,<?=extModalidad("modalidad", Constantes::MARITIMO, Constantes::IMPO )?>
					,<?=include_component("widgets", "ciudades" ,array("id"=>"origen", "label"=>"Ciudad Origen", "idpais"=>"CO-057" ))?>
					,<?=include_component("widgets", "ciudades" ,array("id"=>"destino", "label"=>"Ciudad Destino", "idpais"=>"CO-057" ))?>
					,<?=extConcepto($id="conceptoOtmDta", Constantes::TERRESTRE , $modalidad="OTM-DTA")?>
					,<?=extConcepto($id="equipo", Constantes::MARITIMO , $modalidad="Ext.getCmp('modalidad')")?>
					,{
						xtype:'textfield',
						fieldLabel: 'Valor',
						name: 'valor_tar',
						value: '',						 
						allowBlank:false,
						width: 120
	                },{
						xtype:'textfield',
						fieldLabel: 'Mínimo',
						name: 'valor_min',
						value: '',						 
						allowBlank:false,
						width: 120
	                }
	                ,<?=extMonedas("idmoneda")?>
					,{
						xtype: 'textfield',
						width: 100,
						fieldLabel: 'Frecuencia',
						name: 'frecuencia',
						value: '',
	                    allowBlank:false
					},{
						xtype: 'textfield',
						width: 100,
						fieldLabel: 'T/Transito',
						name: 'ttransito',
						value: '',
	                    allowBlank:false
					},{
						xtype: 'textarea',
						width: 310,
						fieldLabel: 'Observaciones',
						name: 'observaciones',
						value: '',
	                    allowBlank:true
					}
					]
			
		}),

		buttons: [{
			text     : 'Guardar',
			handler: function(){
				var fp = Ext.getCmp("contviaje-form");	
												
				if( fp.getForm().isValid() ){
					fp.getForm().submit({url:'<?=url_for('cotizaciones/formContViajeGuardar')?>', 
	            							 	waitMsg:'Salvando Datos de OTM/DTA...',
	            							 	// standardSubmit: false,
	            							 	
	            							 	success:function(response,options){
	            							 		storeContViajes.reload();
	            							 		win.close();
	            							 	},
		            							failure:function(response,options){
													Ext.Msg.alert( "Error "+response.responseText );
													win.close();
												}//end failure block      
											});
					}else{
						Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información de la Continuación de Viaje no es válida o está incompleta!');
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
* Lanza lan función de actualización de registros modificados 
*/
function updateContViajeModel(){
	var success = true;
	var records = storeContViajes.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
		
		changes['cotizacionId']=r.data.idcotizacion;
		changes['oid']=r.data.oid;	

		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("cotizaciones/formContViajeGuardar")?>', 
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
		storeContViajes.commitChanges();			
		//Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
	}else{
		Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
	}	
}


function agregarFila(ctxRecord, index){	
}

/*
* Cambia el valor que se toma de los combobox y copia el valor em otra columna, 
* tambien inserta otra columna en blanco para que el usuario continue digitando 
*/
var grid_contviajesOnvalidateedit = function(e){	
	var rec = e.record;		   
	var ed = this.colModel.getCellEditor(e.column, e.row);		
	var store = ed.field.store;

	if( e.field == "ciuorigen"){	
	    store.each( function( r ){	    		
				if( r.data.idciudad==e.value ){									
					rec.set("origen", r.data.idciudad );
					e.value = r.data.ciudad;								
					return true;
				}
			}
		)		
	}else if( e.field == "ciudestino"){	
	    store.each( function( r ){	    		
				if( r.data.idciudad==e.value ){									
					rec.set("destino", r.data.idciudad );
					e.value = r.data.ciudad;								
					return true;
				}
			}
		)		
	}else if( e.field == "concepto"){
	    store.each( function( r ){
				if( r.data.idconcepto==e.value ){
					rec.set("concepto", r.data.idconcepto );
					e.value = r.data.concepto;
					return true;
				}
			}
		)		
	}else if( e.field == "equipo"){
	    store.each( function( r ){
				if( r.data.idconcepto==e.value ){
					rec.set("equipo", r.data.idconcepto );
					e.value = r.data.concepto;
					return true;
				}
			}
		)		
	}
}

var grid_contOnBeforeedit = function( e ){
	
	if( e.field == "equipo"){	
		 ed = this.colModel.getCellEditor(e.column, e.row );		
		 ed.field.store.baseParams = {transporte:"<?=Constantes::MARITIMO?>",modalidad:e.record.data.modalidad ,impoexpo:"Exportación"};
		 ed.field.store.reload();
	}
		
}

/*
* Crea la grilla 
*/    
var grid_contviajes = new Ext.grid.EditorGridPanel({
	store: storeContViajes,
	master_column_id : 'contviaje',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'contviaje',
	title: 'Tarifas para OTM/DTA',

	root_title: 'impoexpo',	
	// plugins: [checkColumn], //expander,
	closable: false,
	id: 'grid_contviajes',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el Continuación de Viaje',
		iconCls: 'disk',  // reference to our css
		handler: guardarItems
	},
	{
		text: 'Agregar Concepto',
		tooltip: 'Agregar un Concepto de OTM o DTA',
		iconCls: 'add',  // reference to our css
		handler: contviajeHandler
	}
	
	],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true, 
		getRowClass: function(  record,  index,  rowParams,  storeContViajes ){			
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
		validateedit: grid_contviajesOnvalidateedit,
		beforeedit: grid_contOnBeforeedit
	}	
});
