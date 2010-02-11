<?


	
?>

<?
if( $opcion!="consulta" ){
	if( $idtrafico!="99-999"  ){
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
							,['<?=$ciudad->getCaIdciudad()?>','<?=$ciudad->getCaCiudad()?>']
						<?
						}
						?>
					]
				})
	
	});
	<?
	}
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
					data : [
						<?
						$i=0;
						foreach( $recargos as $recargo ){
							if( $i++!=0){
								echo ",";
							}
						?>
							['<?=$recargo->getCaIdrecargo()?>','<?=$recargo->getCaRecargo()?>']
						<?
						}
						?>
					]
				})
	
	});
	
	
	
<?
}
?>
/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'sel', type: 'string'},
	{name: 'id', type: 'int'},
	{name: 'idtrafico', type: 'string'},	
	{name: 'idciudad', type: 'string'},	
	{name: 'impoexpo', type: 'string'},	
	{name: 'ciudad', type: 'string'},
	{name: 'idrecargo', type: 'string'},
	{name: 'recargo', type: 'string'},
    {name: 'inicio', type: 'date', dateFormat:'Y-m-d'},
	{name: 'vencimiento', type: 'date', dateFormat:'Y-m-d'},
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
$url = "pricing/recargosGeneralesData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico."&impoexpo=".utf8_encode($impoexpo);
if( $opcion=="consulta" ){
	$url.= "&opcion=consulta";
}	
?>
var storeRecargos = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',
	reader: new Ext.data.JsonReader(
		{			
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
		checkColumn	
		<?
		if( $idtrafico!="99-999" ){
		?>
		, 			
		{
			header: "Ciudad",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'ciudad' 
			<?
			if( $opcion!="consulta" ){
			?>
			,
			editor: comboCiudades 
			<?
			}
			?>
		}
		<?
		}
		?>		
        ,
        {
			header: "Recargo",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'recargo' 
			<?
			if( $opcion!="consulta" ){
			?>
			,
			editor: comboRecargos 
			<?
			}
			?>
		},
        {
			header: "Inicio",
			width: 80,
			sortable: false,
			groupable: false,
			dataIndex: 'inicio',
			renderer: Ext.util.Format.dateRenderer('Y/m/d'),
			editor: new Ext.form.DateField({
				format: 'Y/m/d'
			})
		},{
			header: "Venc.",
			width: 80,
			sortable: false,
			groupable: false,
			dataIndex: 'vencimiento',
			renderer: Ext.util.Format.dateRenderer('Y/m/d'),
			editor: new Ext.form.DateField({
				format: 'Y/m/d'
			})
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
						allowNegative: false,
						decimalPrecision :3
			})  
		},
		{
			header: "Aplicación",
			width: 80,
			sortable: false,	
			hideable: false,		
			dataIndex: 'aplicacion'
			<?
			if( $opcion!="consulta" ){
			?>
			,
			editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
			<?
			}
			?>
		},
		{
			header: "Mínimo",
			width: 50,
			sortable: true,	
			hideable: false,		
			dataIndex: 'vlrminimo',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:true,
						allowNegative: false,
						decimalPrecision : 3
			})  
		},
		{
			header: "Aplicación Mín.",
			width: 80,
			sortable: false,	
			hideable: false,		
			dataIndex: 'aplicacion_min'
			<?
			if( $opcion!="consulta" ){
			?>
			,
			editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
			<?
			}
			?>
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
			editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
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
				
	],
	isCellEditable: function(colIndex, rowIndex) {	
		var record = storeRecargos.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
		
		<?
		if( $idtrafico!="99-999" ){
		?>	
		if( !record.data.idciudad && field!="ciudad" ){
			return false;
		}
		
		if( record.data.idciudad && field=="ciudad" ){
			return false;
		}
		<?
		}else{
		?>
		if( !record.data.idrecargo && field!="recargo" ){
			return false;
		}
		
		if( record.data.idrecargo && field=="recargo" ){
			return false;
		}
		<?
		}
		?>
		
		
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
					<?
					if( $idtrafico=="99-999" ){
					?>
					if( !rec.data.idrecargo  ){	
						/*
						* Crea una columna en blanco adicional para permitir 
						* agregar mas items
						*/
						var newRec = new record({
							id: rec.data.id+1, 
						   idtrafico: rec.data.idtrafico,  
						   idciudad: '999-9999',
						   ciudad: '', 
						   idrecargo: '',  						   
						   recargo: '+', 
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
					<?
					}
					?>													
					rec.set("idrecargo", r.data.idrecargo);
                    if( !rec.get("idmoneda") ){
                        rec.set("idmoneda", "COP");
                    }
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
					<?
					if( $idtrafico!="99-999" ){
					?>
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
					<?
					}
					?>
					rec.set("idciudad", r.data.idciudad);
					rec.set("idmoneda", "USD");
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
		
		document.getElementById("obs_"+record.get("_id")).innerHTML  = "<b>Observaciones:</b> "+text;		
	}
}	

function guardarRecargosGenerales(){
	var success = true;
	var records = storeRecargos.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
						
		changes['id']=r.id;
		changes['idciudad']=r.data.idciudad;										
 	    changes['idrecargo']=r.data.idrecargo;	
        changes['idmoneda']=r.data.idmoneda;

		
        //Da formato a las fechas antes de enviarlas 
		if(changes['inicio']){
			changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');									
		}	
		
		if(changes['vencimiento']){
			changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');									
		}	

		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeRecargosGenerales?idtrafico=".$idtrafico."&modalidad=".$modalidad."&impoexpo=".utf8_encode($impoexpo))?>',
				//Solamente se envian los cambios 						
				params :	changes,
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.id && res.success){				
						var rec = storeRecargos.getById( res.id );						
						rec.set("sel", false); //Quita la seleccion de todas las columnas				
						rec.commit();		
					}
				}	
										
				
			 }
		); 
		r.set("sel", false);//Quita la seleccion de todas las columnas 
	}	
	
}

/*
* Menu contextual que se despliega sobre una fila con el boton derecho
*/
var gridOnRowcontextmenu =  function(grid, index, e){
	
	rec = this.store.getAt(index);

    if( typeof(this.menu) !="undefined" ){
        this.menu.removeAll( true );
    }

	this.menu = new Ext.menu.Menu({
	id:'grid_recargos-ctx',
	items: [		
			{
				text: 'Eliminar item',
				iconCls: 'delete',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord && this.ctxRecord.data.idrecargo ){					
											
						
						var id = this.ctxRecord.id;						
						var idciudad = this.ctxRecord.data.idciudad;
						var idrecargo = this.ctxRecord.data.idrecargo;
											
						if( idrecargo && confirm("Esta seguro?") ){
							
							Ext.Ajax.request( 
							{   
								waitMsg: 'Guardando cambios...',						
								url: '<?=url_for("pricing/eliminarRecargosGenerales?idtrafico=".$idtrafico."&modalidad=".$modalidad."&impoexpo=".$impoexpo)?>',
								//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{									
									idciudad: idciudad,									
									idrecargo: idrecargo,
									id: id

								},
														
								
								callback :function(options, success, response){	
										
									var res = Ext.util.JSON.decode( response.responseText );	
									
									if( res.id && res.success){				
										var rec = storeRecargos.getById( res.id );														
										storeRecargos.remove(rec);	
									}
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


var seleccionarTodo = function(){	
	storeRecargos.each( function(r){
			r.set("sel", true);
		} 
	);
}


	
/*
* Crea la grilla 
*/    

new Ext.grid.<?=$opcion!="consulta"?"Editor":""?>GridPanel({
	store: storeRecargos,
	//master_column_id : 'nconcepto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
    loadMask: {msg:'Cargando...'},
	stripeRows: true,
	//autoExpandColumn: 'nconcepto',
	title: 'Recargos <?=($idtrafico!="99-999"?$trafico->getCaNombre():"locales")." ".$modalidad?>',
	height: 400,
	width: 780,
	plugins: [checkColumn], //expander,
	closable: true,
	id: 'recgen_<?=$idcomponent?>',
	<?
	if( $opcion!="consulta" ){
	?>
	tbar: [			  
		{
			text: 'Guardar Cambios',
			tooltip: 'Guarda los cambios realizados en el tarifario',
			iconCls:'disk',  // reference to our css
			handler: guardarRecargosGenerales
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
		rowcontextmenu: gridOnRowcontextmenu,
		afteredit: gridAfterEditHandler,
		click: gridOnclickHandler,
		validateedit: gridOnvalidateedit
	}	

});