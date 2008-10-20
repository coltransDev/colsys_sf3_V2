<?
use_helper("Ext2");
?>

/* Inicializa los tooltips
*/
Ext.QuickTips.init();	
Ext.apply(Ext.QuickTips.getQuickTip(), {	   
   dismissDelay: 200000 //permite que los tips permanezcan por mas tiempo. 
});

/*
* Cre un template para renderizar el tooltip
*/
var qtipTpl=new Ext.XTemplate(
			 '<h3>Observaciones:</h3>'
			,'<tpl for=".">'
			,'<div>{observaciones}</div>'
			,'</tpl>'
		);

/**
* Renderiza una celda incluyendo el tooltip de observaciones
* @param {Mixed} val Value to render
* @param {Object} cell
* @param {Ext.data.Record} record
*/

var renderRowTooltip=function(val, cell, record) {
	//alert("asdasd");
	// get data
	var data = record.data;

	 
	// create tooltip
	var qtip = qtipTpl.apply(data);

	// return markup
	return '<div qtip="' + qtip +'">' + val + '</div>';
}	

/*
* Crea el expander
*/
var expander = new Ext.grid.myRowExpander({  	  
  lazyRender : false, 
  width: 15,	
  tpl : new Ext.Template(
	  '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\'btnComentarios\' id=\'obs_{_id}\'><strong>Observaciones:</strong> {observaciones}</div></p>' 
	 
  )
});


/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'idtrayecto', type: 'int'},
	{name: 'nconcepto', type: 'string'},
	{name: 'destino', type: 'string'},
	{name: 'trayecto', type: 'string'},			
	{name: 'inicio', type: 'date', dateFormat:'m/d/Y'},
	{name: 'vencimiento', type: 'date', dateFormat:'m/d/Y'},		
	{name: 'moneda', type: 'string'},		
	{name: 'iditem', type: 'int'},
	{name: 'idconcepto', type: 'int'},
	{name: 'observaciones', type: 'string'},
	{name: 'aplicacion', type: 'string'},			
	{name: 'sel', type: 'bool'},
	{name: 'ttransito', type: 'string'},
	{name: 'frecuencia', type: 'string'},				
	{name: 'style', type: 'string'}	,
	{name: 'tipo', type: 'string'}	,
	{name: 'neta', type: 'string'}	,
	{name: 'minima', type: 'string'}	

	
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/pagerData?opcion=consulta&modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico;
if( $idlinea ){
	$url .= "&idlinea=".$idlinea;
}
if( $idciudad ){
	$url .= "&idciudad=".$idciudad;
}
if( $idciudaddestino ){
	$url .= "&idciudaddestino=".$idciudaddestino;
}

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
* Template to render tooltip
*/
var qtipTpl=new Ext.XTemplate(
			 '<h3>Observaciones:</h3>'
			,'<tpl for=".">'
			,'<div>{observaciones}</div>'
			,'</tpl>'
		)


/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/

var colModel = new Ext.grid.ColumnModel({		
	columns: [
		expander,	
		checkColumn,			
		{
			id: 'concepto', //para aplicar estilos a esta columna
			header: "Concepto",
			width: 200,
			sortable: true,
			
			dataIndex: 'nconcepto',
			hideable: false,
			renderer: function(value, metaData, record){
				var data = record.data;
				// create tooltip
				var qtip = qtipTpl.apply(data);

			
				if( record.data.tipo == "concepto" ){					
					return '<div qtip="' + qtip +'"><b>'+value+'</b></div>';
				}else{
					return '<div qtip="' + qtip +'" class="recargo">'+value+'</div>';
				}
			} ,
			editor: <?=extRecargosNoEnlazado( $transporte )?>	
		},	
		{
			id: 'trayecto',
			header: "Trayecto",
			width: 100,
			sortable: true,
			dataIndex: 'trayecto', 			
			hideable: false ,
			hidden: true              
		},		 
		{
			header: "Inicio",
			width: 80,
			sortable: true,
			dataIndex: 'inicio',               
			renderer: Ext.util.Format.dateRenderer('d/m/Y'),
			editor: new Ext.form.DateField({
				format: 'd/m/Y'
			})
		},{
			header: "Venc.",
			width: 80,
			sortable: true,
			dataIndex: 'vencimiento',               
			renderer: Ext.util.Format.dateRenderer('d/m/Y'),
			editor: new Ext.form.DateField({
				format: 'd/m/Y'
			})
		} 
		,{
			header: "Aplicacion",
			width: 100,
			sortable: false,
			
			dataIndex: 'aplicacion'//,              
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
		,{
			id: 'neta',
			header: "Neta",
			width: 80,
			sortable: true,
			groupable: false,								
			dataIndex: 'neta',
			editor: new Ext.form.NumberField()		
		},		
		{
			id: 'minima',
			header: "<?=(($transporte=="Aéreo"&&$modalidad!="CABOTAJE")||$modalidad=="FCL")?"Sugerida":"Minima"?>",
			width: 80,
			sortable: true,
			groupable: false,								
			dataIndex: 'minima',
			editor: new Ext.form.NumberField()			
		}
		
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
					rec.set("iditem", r.data.idrecargo);									
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

var gridOnRowcontextmenu =  function(grid, index, e){
		
	rec = this.store.getAt(index);
  //  if(!this.menu){ // create context menu on first right click
		this.menu = new Ext.menu.Menu({
			id:'grid-ctx',
			items: [{
					text: 'Nuevo recargo',
					iconCls: 'new-tab',
					scope:this,
					handler: function(){    					                   
						agregarFila(this.ctxRecord, index);					
					}
				},					
				{
					text: 'Estado',	
					menu: {       
						items: [							
							{
								text: 'Normal',
								checked: rec.get("style")==""?true:false,
								group: 'theme',								
								handler: function(){    					                   
									rec.set("style", "");
								}
							}, {
								text: 'Sugerida',
								checked: rec.get("style")=="yellow"?true:false,								
								group: 'theme',								
								handler: function(){   									               
									rec.set("style", "yellow");
								}
							}, {
								text: 'Mantenimiento',
								checked: rec.get("style")=="pink"?true:false,									
								group: 'theme',								
								handler: function(){    					                   
									rec.set("style", "pink");
								}
							}
						]
					}
                }			
			]
		});
		this.menu.on('hide', this.onContextHide, this);
   // }
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

function agregarFila(ctxRecord, index){	
		
	
	var rec = new record({trayecto:ctxRecord.get("trayecto"),
						  nconcepto:'',
						  idconcepto: ctxRecord.get("iditem"),
						  idtrayecto:ctxRecord.get("idtrayecto"),
						  trayecto:ctxRecord.get("trayecto"),
						  ttransito:ctxRecord.get("ttransito"),
						  frecuencia:ctxRecord.get("frecuencia"),
						  moneda:'',
						  neta:'',
						  minima:'',
						  tipo:'recargo'							
						});
							
	
	records = [];
	records.push( rec );
	store.insert( index+1, records );
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
		
		changes['tipo']=r.data.tipo;
		changes['iditem']=r.data.iditem;	
		changes['idconcepto']=r.data.idconcepto;	
		changes['idtrayecto']=r.data.idtrayecto;
												
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observePricingManagement")?>', 						//method: 'POST', 
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
new Ext.grid.<?=$opcion!="consulta"?"Editor":""?>GridPanel({
	store: store,
	master_column_id : 'nconcepto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'nconcepto',
	title: '<?=$titulo?>',
	root_title: '<?=$trafico->getCaNombre()?>',	
	plugins: [checkColumn, expander], 
	closable: true,
	id: 'fletes_<?=$idcomponent?>',
	height: 400,
	//autoHeight : true, 
	<?
	if($opcion!="consulta"){
	?>
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls: 'disk',  // reference to our css
		handler: updateModel
	}],
	<?
	}
	?>
	
	view: new Ext.grid.GroupingView({
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
	listeners:{
		rowcontextmenu: gridOnRowcontextmenu,
		afteredit: gridAfterEditHandler,
		click: gridOnclickHandler,
		validateedit: gridOnvalidateedit
	}	
	/*
	bbar: new Ext.PagingToolbar({
		store: store,
		displayInfo: true,
		pageSize: 80
		
	}),*/
	

});
//store.load();



