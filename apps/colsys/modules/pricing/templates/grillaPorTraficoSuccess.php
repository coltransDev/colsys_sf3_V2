<?
use_helper("Ext2");
?>		
/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'idtrayecto', type: 'int'},
	{name: 'origen', type: 'string'},
	{name: 'destino', type: 'string'},
	{name: 'linea', type: 'string'},			
	{name: 'inicio', type: 'date', dateFormat:'m/d/Y'},
	{name: 'vencimiento', type: 'date', dateFormat:'m/d/Y'},		
	{name: 'moneda', type: 'string'},		
	{name: 'recargo_id', type: 'int'},
	{name: 'concepto_id', type: 'int'},
	{name: 'observaciones', type: 'string'},
	{name: 'aplicacion', type: 'string'},		
	{name: '_id', type: 'int'},
	{name: '_parent', type: 'auto'},
	{name: '_is_leaf', type: 'bool'},
	{name: 'sel', type: 'bool'}	
	<?
	foreach( $conceptos as $concepto ){			
	?>
	,{name: 'concepto_<?=$concepto->getCaIdconcepto()?>', type: 'string'}			
	<?			
	}
	?>		
]);
   		
/*
* Crea el store
*/

var store = new Ext.ux.maximgb.treegrid.AdjacencyListStore({
	autoLoad : true,			
	url: '<?=url_for("pricing/pagerData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico."&linea=".$linea)?>',
	reader: new Ext.data.JsonReader(
		{
			id: '_id',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	)		
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
		expander,				
		{
			id: 'origen',
			header: "Origen",
			width: 200,
			sortable: true,
			renderer: renderRowTooltip,	
			dataIndex: 'origen',
			hideable: false				
		},			
		{
			id: 'destino',
			header: "Destino",
			width: 100,
			sortable: true,
			dataIndex: 'destino', 
			renderer: renderRowTooltip,	              
			hideable: false               
		}
		,checkColumn,		 
		{
			header: "Inicio",
			width: 80,
			sortable: true,
			dataIndex: 'inicio',               
			renderer: Ext.util.Format.dateRenderer('m/d/Y'),
			editor: new Ext.form.DateField({
				format: 'm/d/Y'
			})
		},{
			header: "Venc.",
			width: 80,
			sortable: true,
			dataIndex: 'vencimiento',               
			renderer: Ext.util.Format.dateRenderer('m/d/Y'),
			editor: new Ext.form.DateField({
				format: 'm/d/Y'
			})
		}
		,{
			header: "Aplicacion",
			width: 100,
			sortable: false,
			dataIndex: 'aplicacion',              
			/*editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				//transform:'light',
				lazyRender:true,
				listClass: 'x-combo-list-small',
				store : aplicaciones	
			})*/
		}				
		,{
			header: "Moneda",
			width: 80,
			sortable: false,
			dataIndex: 'moneda',              
			editor: <?=extMonedas("USD")?>
		}
		<?
		foreach( $conceptos as $concepto ){			
		?>
		,{
			id: 'concepto_<?=$concepto->getCaIdconcepto()?>',
			header: "<?=$concepto->getCaConcepto()?>",
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
			dataIndex: 'concepto_<?=$concepto->getCaIdconcepto()?>',               
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
	],
	isCellEditable: function(colIndex, rowIndex) {	
		var record = store.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
		if (record.data.recargo_id && (field == 'aplicacion'||field == 'inicio'||field == 'vencimiento')) {			
			return false;
		}			
		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);		
	}
});

/*
* Configura el modo de seleccion de la grilla 
*/
var selModel = new  Ext.grid.CellSelectionModel({
	listeners:{
		/**
		* Expande las ramas cuando se seleccionan si el padre no esta 
		* expandido lo expande
		**/
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
});



 	
/*
* Handlers de los eventos y botones de la grilla 
*/

/**
* Copia los datos a las columnas seleccionadas 
**/
var gridAfterEditHandler = function(e) {		
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

/*
* Actualiza los datos de la base de datos usando Ajax.
*/
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
		
/*
* Crea la grilla 
*/    
new Ext.ux.maximgb.treegrid.GridPanel({
	store: store,
	master_column_id : 'origen',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'origen',
	title: '<?=$trafico->getCaNombre()?>',
	root_title: '<?=$trafico->getCaNombre()?>',	
	plugins: [expander,checkColumn],
	closable: true,
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'add',                      // reference to our css
		handler: updateModel
	}],

	bbar: new Ext.ux.maximgb.treegrid.PagingToolbar({
		store: store,
		displayInfo: true,
		pageSize: 25
		<?
		/*if( $transporte=="Marítimo" ){
			echo "pageSize: 25"; //Un tamaño mayor impacta en el rendimiento
		}else{
			echo "pageSize: 100"; //Puede ser mas grande ya que las filas no se expanden
		}*/
		?>		
	}),	
	listeners:{
		afteredit: gridAfterEditHandler,
		click: gridOnclickHandler
	}	

});
	

 	
