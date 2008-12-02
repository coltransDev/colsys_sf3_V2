<?
/*
* Permite crear recargos locales
* @author: Carlos Lopez, Andres Botero
*/
use_helper("Ext2");
?>

var comboRecargos = new Ext.form.ComboBox({			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,					
	lazyRender:true,
	allowBlank: false,
	listClass: 'x-combo-list-small',
	valueField:'idrecargo',
	displayField:'recargo',
	mode: 'local',	
	store :  new Ext.data.SimpleStore({
				fields: ['idrecargo', 'recargo'],
				data : []
			})

})



/*
* Crea el Record 
*/
var recordGrilla = Ext.data.Record.create([
	{name: 'id', type: 'int'},
    {name: 'idcotizacion', type: 'string'},
   
    {name: 'idrecargo', type: 'string'},
    {name: 'agrupamiento', type: 'string'},
    {name: 'transporte', type: 'string'},
	{name: 'impoexpo', type: 'string'},
    {name: 'recargo', type: 'string'},
    {name: 'tipo', type: 'string'},
    {name: 'valor_tar', type: 'string'},
    {name: 'aplica_tar', type: 'string'},
    {name: 'valor_min', type: 'string'},
    {name: 'aplica_min', type: 'string'},
    {name: 'idmoneda', type: 'string'},
    {name: 'modalidad', type: 'string'},
    {name: 'observaciones', type: 'string'}
]);
   	
	
/*
* Crea el store
*/
var storeRecargosCot = new Ext.data.GroupingStore({
	url: '<?=url_for('cotizaciones/datosGrillaRecargos?idcotizacion='.$cotizacion->getCaIdcotizacion())?>',
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'id',
			root: 'recargos',
			totalProperty: 'total'
		}, 
		recordGrilla
	),
	sortInfo:{field: 'id', direction: "ASC"},
	
	groupField: 'agrupamiento'		
});
	
storeRecargosCot.load();	
		
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
			id: 'agrupamiento',
			header: "Recargos",
			width: 100,
			sortable: true,
			dataIndex: 'agrupamiento',
			hideable: false,
			hidden: true
		},
		{
			id: 'transporte',
			header: "transporte",
			width: 100,
			dataIndex: 'transporte',
			hideable: false, 
			hidden: true
		},
		{
			id: 'recargo',
			header: "Recargo",
			width: 80,
			sortable: true,			
			dataIndex: 'recargo',
			hideable: false,
			editor: comboRecargos
		},			
		{
			id: 'valor_tar',
			header: "Valor Recargo",
			width: 30,
			sortable: true,
			//renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_tar',
			hideable: false,
			editor: new Ext.form.NumberField({
						name: 'valor_tar',
						allowBlank:false,
						allowNegative: false
			})
		},
		{
			id: 'aplica_tar',
			header: "Aplicación Rec.",
			width: 35,
			sortable: true,
			dataIndex: 'aplica_tar',
			hideable: false,
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
			
		},
		{
			id: 'valor_min',
			header: "Mínimo",
			width: 30,
			sortable: true,
			//renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_min',
			hideable: false,
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})
		},
		{
			id: 'aplica_min',
			header: "Aplicación Min.",
			width: 35,
			sortable: true,
			dataIndex: 'aplica_min',
			hideable: false,
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
			
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 20,
			sortable: true,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=extMonedas()?>
		},
		{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: true,
			dataIndex: 'observaciones',
			//dataIndex: 'id',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'Detalles',
	                    allowBlank:true
			})
		}
	],
	isCellEditable: function(colIndex, rowIndex) {	
		var record = storeRecargosCot.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
			
		if( !record.data.idrecargo && field!="recargo" ){
			return false;
		}
		
		if( record.data.idrecargo && field=="recargo" ){
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
* Determina que store se debe utilizar dependiendo si es un concepto o recargo
*/
grid_recargosOnBeforeedit = function( e ){						
	
	if( e.field=="recargo" ){
		var recargosMaritimo = [
			<?
			$i=0;
			foreach( $recargosMaritimo as $recargo ){
				if( $i++!=0){
					echo ",";
				}
			?>
				['<?=$recargo->getCaIdRecargo()?>','<?=$recargo->getCaRecargo()?>']
			<?
			}
			?>
		];
		
		var recargosAereo = [
			<?
			$i=0;
			foreach( $recargosAereo as $recargo ){
				if( $i++!=0){
					echo ",";
				}
			?>
				['<?=$recargo->getCaIdRecargo()?>','<?=$recargo->getCaRecargo()?>']
			<?
			}
			?>
		];
		
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		if( e.record.data.transporte=="<?=Constantes::AEREO?>" ){
			ed.field.store.loadData( recargosAereo );
		}else{
			ed.field.store.loadData( recargosMaritimo );
		}
	
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
* Cambia el valor que se toma de los combobox y copia el valor em otra columna, 
* tambien inserta otra columna en blanco para que el usuario continue digitando 
*/
var grid_recargosOnvalidateedit = function(e){	
	
	if( e.field == "recargo"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
							
	    store.each( function( r ){				
				if( r.data.idrecargo==e.value ){									
					if( !rec.data.idrecargo  ){							
						var newRec = new recordGrilla({
						   id: rec.data.id+1,  
						   idcotizacion: rec.data.idcotizacion,
						   agrupamiento: rec.data.agrupamiento,  
						   transporte: rec.data.transporte, 
						   modalidad: rec.data.modalidad,  
						   idrecargo: '',   
						   recargo: '+',
						   iditem: '',							   
						   valor_tar: '',
						   valor_min: '',
						   aplica_tar: '',
						   aplica_min: '',
						   idmoneda: '',
						   observaciones: ''
						});	
						newRec.id = rec.data.id+1;								
																	
						storeRecargosCot.addSorted(newRec);
						rec.set("idmoneda", "USD" );
						
					}
					rec.set("idrecargo", r.data.idrecargo);
					e.value = r.data.recargo;				
					return true;
				}
			}
		)		
	}
}


/*
* Menu contextual que se despliega sobre una fila con el boton derecho
*/

var grid_recargosOnRowcontextmenu =  function(grid, index, e){		
	rec = this.store.getAt(index);	
	this.menu = new Ext.menu.Menu({
	id:'grid_recargos-ctx',
	items: [
	        
			{
				text: 'Importar del tarifario',
				iconCls: 'import',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord ){					
						ventanaTarifarioRecargos( this.ctxRecord );
					}						
				}
			},		
			{
				text: 'Eliminar item',
				iconCls: 'delete',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord && this.ctxRecord.data.idrecargo && confirm("Desea continuar?") ){					
											
						
						var id = this.ctxRecord.data.id;
						
						var idrecargo = this.ctxRecord.data.idrecargo;
						var modalidad = this.ctxRecord.data.modalidad;
						if( idrecargo ){
							Ext.Ajax.request( 
							{   
								waitMsg: 'Guardando cambios...',						
								url: '<?=url_for("cotizaciones/eliminarRecargo?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
								//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{									
									idrecargo: idrecargo,									
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
									
									storeRecargosCot.each( function( record ){																					
											if( record.data.id==id ){		
																						
												storeRecargosCot.remove(record);																																																																				
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

var activeRecordRec = null;
/*
* Muestra una ventana con la informacion del tarifario y le permite al usuario 
* seleccionar las tarifas a importar
*/
var ventanaTarifarioRecargos = function( record ){
	var url = '<?=url_for("pricing/recargosGenerales?opcion=consulta")?>';
	
	activeRecordRec = record;
	
	Ext.Ajax.request({
		url: url,
		params: {						
			transporte: record.data.transporte, 
			modalidad: record.data.modalidad,
			impoexpo: "Importación" //TODO Corregir para expo		
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
						//
						
						/*
						* Busca el ultimo elemento para insertar al final del grupo
						*/
						var flag = false;	
						storeRecargosCot.each( function( record ){																					
								if( record.data.id==activeRecordRec.id ){		
									flag=true;
								}									
								if(flag){
									if(!record.data.idrecargo){
										activeRecordRec = record;
										flag=false;
										return 0;
									}
								}									
						});
												
						var id = activeRecordRec.data.id;	
						var j = 0;	
						storeRecargos.each( function(r){
							if( r.data.sel==true ){		
								j++;		
								var newId = id+j;				
								var newRec = new record({
									id: newId,
									agrupamiento: activeRecordRec.data.agrupamiento, 
									recargo: '', 
									valor_tar: 0,  
									valor_min: 0,   
									aplica_tar: '',
									aplica_min: '',							   
									idmoneda: '',
									observaciones: '',
									transporte: activeRecordRec.data.transporte,  
									modalidad: activeRecordRec.data.modalidad
								});											
								newRec.id = newId;		
								activeRecordRec.id=newId+1;
								activeRecordRec.data.id=newId+1;
								storeRecargosCot.addSorted( newRec );
								
								//Es necesario buscar de nuevo el record dentro del store
								//para que se activen los eventos de edición del store																
								var newRec = storeRecargosCot.getById( newId ); 
								
								newRec.set("idrecargo", r.data.idrecargo );
								newRec.set("recargo", r.data.recargo );								
								newRec.set("valor_tar", r.data.vlrrecargo );
								newRec.set("valor_min", r.data.vlrminimo );
								newRec.set("aplica_tar", r.data.aplicacion );
								newRec.set("aplica_min", r.data.aplicacion_min );
								newRec.set("idmoneda", r.data.idmoneda );
								newRec.set("observaciones", r.data.observaciones );																													
								
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
* Lanza lan función de actualización de registros modificados 
*/
function updateRecargosModel(){
	var success = true;
	var records = storeRecargosCot.getModifiedRecords();
			
	var lenght = records.length;
	
	//Validacion
	for( var i=0; i< lenght; i++){
		r = records[i];
		if(!r.data.idmoneda&&r.data.idrecargo){
			Ext.Msg.alert( "","Por favor coloque la moneda en todos los items " );	
			return 0;						
		}
	}
	
	for( var i=0; i< lenght; i++){
		r = records[i];
		if( r.data.idrecargo ){			
			var changes = r.getChanges();
			changes['id']=r.id;	
			changes['idrecargo']=r.data.idrecargo;
			changes['modalidad']=r.data.modalidad;
	
			//envia los datos al servidor 
			Ext.Ajax.request( 
				{   
					waitMsg: 'Guardando cambios...',						
					url: '<?=url_for("cotizaciones/formRecargoGuardar?idcotizacion=".$cotizacion->getCaIdcotizacion() )?>', 
					//Solamente se envian los cambios 						
					params :	changes,
					
					callback :function(options, success, response){	
											
						var res = Ext.util.JSON.decode( response.responseText );					
						var rec = storeRecargosCot.getById( res.id );																										
						rec.commit();						
					}										
					
				 }
			);
			r.set("sel", false);//Quita la seleccion de todas las columnas 
		}
	}	
	
}


function agregarFila(ctxRecord, index){	
}

/*
* Crea la grilla 
*/    
var grid_recargos = new Ext.grid.EditorGridPanel({
	store: storeRecargosCot,
	master_column_id : 'recargo',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'recargo',
	title: 'Recargos Locales',

	root_title: 'impoexpo',	
	// plugins: [checkColumn], //expander,
	closable: false,
	id: 'grid_recargos',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en Recargos',
		iconCls: 'disk',  // reference to our css
		handler: guardarItems
	},
	{
		text: 'Recargar',
		tooltip: 'Recarga los datos de la base de datos',
		iconCls: 'refresh',  // reference to our css
		handler: function(){
			if(storeRecargosCot.getModifiedRecords().length>0){
				if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
					return 0;
				}
			}
		
			storeRecargosCot.reload();
		}
	}
	],

	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true		
	}),
	
	listeners:{ 		
		rowcontextmenu:grid_recargosOnRowcontextmenu,
		validateedit: grid_recargosOnvalidateedit,
		beforeedit:grid_recargosOnBeforeedit
	}	
});