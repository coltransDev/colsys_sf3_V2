<?
use_helper("Ext2");
?>

/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'idtrayecto', type: 'int'},
	{name: 'nconcepto', type: 'string'},
	{name: 'destino', type: 'string'},
	{name: 'trayecto', type: 'string'},			
			
	{name: 'moneda', type: 'string'},		
	{name: 'recargo_id', type: 'int'},
	
	
	<?
	
	foreach( $ciudades as $ciudad ){			
	?>
	,{name: 'recargo_<?=$ciudad->getCaIdCiudad()?>', type: 'string'}			
	<?			
	}
	?>		
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/recargosXCiudadData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico;

?>
var store = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',
	reader: new Ext.data.JsonReader(
		{
			id: '_id',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	sortInfo:{field: 'destino', direction: "ASC"},
	groupField: 'trayecto'		
	/*
	carga local
	reader: new Ext.data.JsonReader({id: '_id'}, record),
	proxy: new Ext.data.MemoryProxy(data)
	*/
});
	
	
		
/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30}); 

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/

var colModel = new Ext.grid.ColumnModel({		
	columns: [
		//expander,	
		checkColumn,			
		{
			id: 'nconcepto',
			header: "Recargo",
			width: 200,
			sortable: true,
			renderer: renderRowTooltip,	
			dataIndex: 'nconcepto',
			hideable: false,
			renderer: function(value, metaData){
					if( value=="FLETE" ){					
						return "<div style='font-weight:bold'>"+value+"</div>";
					}else{
						return value;
					}
				} ,
			editor: <?=extRecargos( $transporte )?>	
		},	
		{
			id: 'trayecto',
			header: "Trayecto",
			width: 100,
			sortable: true,
			dataIndex: 'trayecto', 			
			hideable: false ,
			hidden: true              
		}	 
		/*
		,
		{
			header: "Aplicacion",
			width: 100,
			sortable: false,
			
			dataIndex: 'aplicacion'//,              
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				//transform:'light',
				lazyRender:true,
				listClass: 'x-combo-list-small',
				store : aplicaciones	
			})
		}*/				
		
		
	
		<?
		foreach( $ciudades as $ciudad ){		
		?>
		,{
			id: 'recargo_<?=$ciudad->getCaIdCiudad()?>',
			header: "<?=$ciudad->getCaCiudad()?>",
			width: 80,
			sortable: true,
			groupable: false,	
			<?
			switch( $modalidad ){
				case "FCL":
					?>
					renderer: rendererSug,
					<?
					break;
				case "COLOADING":
					?>
					renderer: rendererMinSug,
					<?
					break;
				default:
					?>
					renderer: rendererMin,								
					<?
					break;
			}
			?>				
			dataIndex: 'recargo_<?=$ciudad->getCaIdCiudad()?>',               
			editor: new Ext.form.NumberFieldMin({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				modalidad: '<?=$modalidad?>'                                      
			})
		}
		<?
		}
		?>
	]
	,
	isCellEditable: function(colIndex, rowIndex) {	
		var record = store.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
		
		if( record.data.nconcepto=="FLETE" && field == 'nconcepto' ){
			return false;
		}
		
		if (record.data.recargo_id && (field == 'aplicacion'||field == 'inicio'||field == 'vencimiento'|| field == 'nconcepto')) {			
			return false;
		}			
		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);		
	}
});



/*
* Configura el modo de seleccion de la grilla 
*/
var selModel = new  Ext.grid.CellSelectionModel(/*{
	listeners:{*/
		/**
		* Expande las ramas cuando se seleccionan si el padre no esta 
		* expandido lo expande
		**/
		/*
		cellselect: function(sm, rowIndex, columnIndex) {	
			var record = store.getAt(rowIndex);
			store.expandNode(record);
			if( record.data._parent ){
				var parent = store.getById(record.data._parent);
				store.expandNode(parent);
				if( parent.data._parent ){
					var parent = store.getById(parent.data._parent);
					store.expandNode(parent);
				}
			}
		}
	}
}*/);



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
		var records = store.getModifiedRecords();				
		var lenght = records.length;				
		var field = e.field;
				
		for( var i=0; i< lenght; i++){
			r = records[i];			
			if(r.data.sel){
				if (r.data.recargo_id && (field == 'aplicacion'||field == 'inicio'||field == 'vencimiento')) {			
					continue;
				}	
				r.set(field,e.value);
			}
		}
	}	
}

/*
* Handler que se encarga de colocar el dato recargo_id en el Record 
* cuando se inserta un nuevo recargo
*/
var gridOnvalidateedit = function(e){
	
	if( e.field == "nconcepto"){
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);
		
		var store = ed.field.store;
	    store.each( function( r ){				
				if( r.data.idrecargo==e.value ){				
					e.value = r.data.recargo;
					rec.set("recargo_id", r.data.idrecargo);									
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
	var records = store.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
		
		//Da formato a las fechas antes de enviarlas 
		if(changes['inicio']){
			changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');									
		}	
		
		if(changes['vencimiento']){
			changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');									
		}	
				
		//Si es un recargo y lo envia como parametro
		if(r.data.recargo_id){
			changes['recargo_id']=r.data.recargo_id;
			changes['concepto_id']=r.data.concepto_id;									
		}
												
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observePricingManagement")?>/id/'+r.data.idtrayecto, 						//method: 'POST', 
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
		store.commitChanges();
		Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
	}else{
		Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
	}	
}


var gridOnRowcontextmenu =  function(grid, index, e){
		
}

function agregarFila(){	
	var index =  store.getTotalCount();
	
	var rec = new record({ nconcepto:'',
						  recargo_id:''

						  <?
						foreach( $ciudades as $ciudad ){			
						?>
						,"concepto_<?=$ciudad->getCaIdciudad()?>":''			
						<?			
						}
						?>		
						});
	
	records = [];
	records.push( rec );
	store.insert( 0, records );
	
}
		
/*
* Crea la grilla 
*/    
new Ext.grid.EditorGridPanel({
	store: store,
	master_column_id : 'nconcepto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'nconcepto',
	title: '<?=$titulo?>',
	root_title: '<?=$trafico->getCaNombre()?>',	
	plugins: [checkColumn], //expander,
	closable: true,
	id: 'grid_<?=$idcomponent?>',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'add',  // reference to our css
		handler: updateModel
	},
	{
		text: 'Agregar',
		tooltip: 'Crea un nuevo recargo',
		iconCls:'add',  // reference to our css
		handler: agregarFila
	}
	],
	
	view: new Ext.grid.GridView({
		forceFit:true,
		enableRowBody:true, 
		getRowClass: function(  record,  index,  rowParams,  store ){			
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
	/*
	bbar: new Ext.PagingToolbar({
		store: store,
		displayInfo: true,
		pageSize: 80
		
	}),*/
	listeners:{
		rowcontextmenu: gridOnRowcontextmenu,
		afteredit: gridAfterEditHandler,
		click: gridOnclickHandler,
		validateedit: gridOnvalidateedit
	}	
	

});
//store.load();



