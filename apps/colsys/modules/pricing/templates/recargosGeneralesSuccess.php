<?
use_helper("Ext2");

$c = new Criteria();
$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
//$c->setLimit(3);
$recargos = TipoRecargoPeer::doSelect( $c );		
?>


var comboCiudades = new Ext.form.ComboBox({			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,					
	lazyRender:true,
	allowBlank: false,
	listClass: 'x-combo-list-small',
	valueField:'idciudad',
	displayField:'ciudad',
	mode: 'local',	
	store :  new Ext.data.SimpleStore({
				fields: ['idciudad', 'ciudad'],
				data : [
					['999-9999','Todas las ciudades']
					<?					
					foreach( $ciudades as $ciudad ){
						
					?>
						,['<?=$ciudad->getCaIdCiudad()?>','<?=$ciudad->getCaCiudad()?>']
					<?
					}
					?>
				]
			})

});


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
				data : [
					<?
					$i=0;
					foreach( $recargos as $recargo ){
						if( $i++!=0){
							echo ",";
						}
					?>
						['<?=$recargo->getCaIdRecargo()?>','<?=$recargo->getCaRecargo()?>']
					<?
					}
					?>
				]
			})

});


var datosAplicacion = [
		<?
		$i=0;
		foreach( $aplicaciones as $aplicacion ){
			if( $i++!=0){
				echo ",";
			}
		?>
			['<?=$aplicacion->getCaValor()?>']
		<?
		}
		?>
];

var comboAplicaciones = <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>;
var comboAplicaciones2 = <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>;

comboAplicaciones.store.loadData( datosAplicacion );
comboAplicaciones2.store.loadData( datosAplicacion );

/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'sel', type: 'string'},
	{name: 'id', type: 'int'},
	{name: 'idtrafico', type: 'string'},	
	{name: 'idciudad', type: 'string'},	
	{name: 'ciudad', type: 'string'},
	{name: 'idrecargo', type: 'string'},
	{name: 'recargo', type: 'string'},
	{name: 'vlrrecargo', type: 'float'},
	{name: 'vlrminimo', type: 'float'},
	{name: 'aplicacion', type: 'string'},
	{name: 'aplicacion_min', type: 'string'},
	{name: 'idmoneda', type: 'string'},
	{name: 'observaciones', type: 'string'}		
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/recargosGeneralesData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico;

?>
var storeRecargos = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',
	reader: new Ext.data.JsonReader(
		{
			id: 'id',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	sortInfo:{field: 'id', direction: "ASC"}
});
	
/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false}); 

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModel = new Ext.grid.ColumnModel({		
	columns: [		
		checkColumn	, 	
		{
			header: "Ciudad",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'ciudad' ,
			editor: comboCiudades 
		}
		,
		{
			header: "Recargo",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'recargo' ,
			editor: comboRecargos 
		}
		,
		{
			header: "Valor",
			width: 50,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrrecargo',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})  
		},
		{
			header: "Aplicación",
			width: 80,
			sortable: false,	
			hideable: false,		
			dataIndex: 'aplicacion',
			editor: comboAplicaciones  
		},
		{
			header: "Mínimo",
			width: 50,
			sortable: true,	
			hideable: false,		
			dataIndex: 'vlrminimo',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})  
		},
		{
			header: "Aplicación Mín.",
			width: 80,
			sortable: false,	
			hideable: false,		
			dataIndex: 'aplicacion_min',
			editor: comboAplicaciones2 
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 40,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=extMonedas()?>
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
				
	],
	isCellEditable: function(colIndex, rowIndex) {	
		var record = storeRecargos.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
			
		if( !record.data.idciudad && field!="ciudad" ){
			return false;
		}
		
		if( record.data.idciudad && field=="ciudad" ){
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
* Handler que se dispara despues de editar una celda
*/
var gridAfterEditHandler = function(e) {	
   	
	/**
	* Copia los datos a las columnas seleccionadas 
	**/
	if(e.record.data.sel){
		var records = storeRecargos.getModifiedRecords();				
		var lenght = records.length;				
		var field = e.field;
				
		for( var i=0; i< lenght; i++){
			r = records[i];			
			if(r.data.sel){
				if ( (field == 'ciudad')) {			
					continue;
				}	
				r.set(field,e.value);
				
				if ( (field == 'recargo')) {			
					r.set("idrecargo",e.record.data.idrecargo);
				}	
				
			}
		}
	}	
}

/*
* Handler que se encarga de colocar el dato recargo_id en el Record 
* cuando se inserta un nuevo recargo
*/
var gridOnvalidateedit = function(e){
	
	if( e.field == "recargo"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
		
	    store.each( function( r ){				
				if( r.data.idrecargo==e.value ){														
					rec.set("idrecargo", r.data.idrecargo);
					e.value = r.data.recargo;				
					return true;
				}
			}
		)		
	}
	
	if( e.field == "ciudad"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
		
	    store.each( function( r ){						
				if( r.data.idciudad==e.value ){									
					if( !rec.data.idciudad  ){	
						/*
						* Crea una columna en blanco adicional para permitir 
						* agregar mas items
						*/
						var newRec = new record({
							id: rec.data.id+1, 
						   idtrafico: rec.data.idtrafico,  
						   idciudad: '',
						   ciudad: '+', 
						   idrecargo: '',  						   
						   recargo: '', 
						   vlrrecargo: '',  
						   vlrminimo: '',   
						   aplicacion: '',
						   aplicacion_min: '',							   
						   idmoneda: '',
						   observaciones: ''
						});	
						newRec.id = rec.data.id+1;								
						//Inserta una columna en blanco al final												
						storeRecargos.addSorted(newRec);										
						
					}
					rec.set("idciudad", r.data.idciudad);
					e.value = r.data.ciudad;				
					return true;
				}
			}
		)		
	}
	
}


/**
* Muestra una ventana donde se pueden editar las observaciones
**/
var gridOnclickHandler =  function(e) {	
	var btn = e.getTarget('.btnComentarios');        
	if (btn) {			
		var t = e.getTarget();
		var v = this.view;	
		var rowIdx = v.findRowIndex(t);
		var record = this.getStore().getAt(rowIdx);           
						
		activeRow = rowIdx;				
		Ext.MessageBox.show({
		   title: 'Observaciones',
		   msg: 'Por favor coloque las observaciones:',
		   width:300,
		   buttons: Ext.MessageBox.OKCANCEL,
		   multiline: true,
		   fn: actualizarObservaciones,
		   animEl: 'mb3',
		   value: record.get("observaciones")
	   });	
	}
}
	
/*
* Coloca las observaciones en pantalla y actualiza el datastore 
*/
var actualizarObservaciones=function( btn, text ){		
	if( btn=="ok" ){			
		var record = store.getAt(activeRow); 
		record.set("observaciones", text);
		
		document.getElementById("obs_"+record.get("_id")).innerHTML  = "<strong>Observaciones:</strong> "+text;		
	}
}	

function updateModel(){
	var success = true;
	var records = storeRecargos.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
						
		
		changes['idciudad']=r.data.idciudad;										
 	    changes['idrecargo']=r.data.idrecargo;											
		
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeRecargosGenerales?idtrafico=".$idtrafico."&modalidad=".$modalidad)?>', 						
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
		storeRecargos.commitChanges();
		Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
	}else{
		Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
	}	
}

/*
* Menu contextual que se despliega sobre una fila con el boton derecho
*/
var gridOnRowcontextmenu =  function(grid, index, e){
	
	rec = this.store.getAt(index);	
	this.menu = new Ext.menu.Menu({
	id:'grid_recargos-ctx',
	items: [		
			{
				text: 'Eliminar item',
				iconCls: 'new-tab',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord && this.ctxRecord.data.idrecargo ){					
											
						
						var id = this.ctxRecord.data.id;						
						var idciudad = this.ctxRecord.data.idciudad;
						var idrecargo = this.ctxRecord.data.idrecargo;
						
						if( idrecargo ){
							
							Ext.Ajax.request( 
							{   
								waitMsg: 'Guardando cambios...',						
								url: '<?=url_for("pricing/eliminarRecargosGenerales?idtrafico=".$idtrafico."&modalidad=".$modalidad)?>',
								//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{									
									idciudad: idciudad,									
									idrecargo: idrecargo

								},
														
								//Ejecuta esta accion en caso de fallo
								//(404 error etc, ***NOT*** success=false)
								failure:function(response,options){							
									alert( response.responseText );						
									success = false;
								},
								//Ejecuta esta accion cuando el resultado es exitoso
								success:function(response,options){							
									
									storeRecargos.each( function( record ){																					
											if( record.data.id==id ){																							
												storeRecargos.remove(record);																																																																				
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


var seleccionarTodo = function(){	
	storeRecargos.each( function(r){
			r.set("sel", true);
		} 
	);
}


	
/*
* Crea la grilla 
*/    

new Ext.grid.EditorGridPanel({
	store: storeRecargos,
	//master_column_id : 'nconcepto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	//autoExpandColumn: 'nconcepto',
	title: 'Recargos <?=$trafico->getCaNombre()?>',
	
	plugins: [checkColumn], //expander,
	closable: true,
	id: 'recgen_<?=$idcomponent?>',
	
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
	view: new Ext.grid.GridView({
		 forceFit :true
		
	}),		
	listeners:{
		rowcontextmenu: gridOnRowcontextmenu,
		afteredit: gridAfterEditHandler,
		click: gridOnclickHandler,
		validateedit: gridOnvalidateedit
	}	

});