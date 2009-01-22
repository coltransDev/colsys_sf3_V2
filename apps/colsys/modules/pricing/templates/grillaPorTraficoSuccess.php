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
			 '<h3>Observaciones: </h3>'
			,'<tpl for=".">'
			,'<div >{observaciones}</div>'
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
	  '<p><div class=\'btnComentarios\' id=\'obs_{_id}\'>&nbsp; {observaciones}</div></p>'
 	
  	) 
});

/*
* editor de recargos 
*/

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


/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'idtrayecto', type: 'int'},
	{name: 'nconcepto', type: 'string'},
	{name: 'destino', type: 'string'},
	{name: 'trayecto', type: 'string'},			
	{name: 'inicio', type: 'date', dateFormat:'Y-m-d'},
	{name: 'vencimiento', type: 'date', dateFormat:'Y-m-d'},		
	{name: 'moneda', type: 'string'},		
	{name: 'iditem', type: 'int'},
	{name: 'idconcepto', type: 'int'},
	{name: 'observaciones', type: 'string'},
	{name: 'aplicacion', type: 'string'},	
	{name: 'aplicacion_min', type: 'string'},		
	{name: 'sel', type: 'bool'},
	{name: 'ttransito', type: 'string'},
	{name: 'frecuencia', type: 'string'},				
	{name: 'style', type: 'string'}	,
	{name: 'tipo', type: 'string'}	,
	{name: 'neta', type: 'float'}	,
	{name: 'minima', type: 'float'}, 
	{name: 'sugerida', type: 'float'},
	{name: 'consecutivo', type: 'int'},	
	{name: 'orden', type: 'int'}		
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/datosGrillaPorTrafico?impoexpo=".$impoexpo."&modalidad=".$modalidad."&transporte=".utf8_encode($transporte);

if( $idtrafico ){
	$url .= "&idtrafico=".$idtrafico;
}


if( $idlinea ){
	$url .= "&idlinea=".$idlinea;
}
if( $idciudad ){
	$url .= "&idciudad=".$idciudad;
}
if( $idciudad2 ){
	$url .= "&idciudad2=".$idciudad2;
}

if( $opcion ){
	$url .= "&opcion=".$opcion;
}

if( $timestamp ){
	$url .= "&timestamp=".$timestamp;
}

if( $timestamp2 ){
	$url .= "&timestamp2=".$timestamp2;
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
	sortInfo:{field: 'orden', direction: "ASC"},
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
			sortable: false,
			groupable: false,
			
			dataIndex: 'nconcepto',
			hideable: false,
			renderer: function(value, metaData, record){
				var data = record.data;
				// create tooltip
				var qtip = qtipTpl.apply(data);
				
				switch(  record.data.tipo ){
					case 'trayecto_obs':
						return '<div qtip="' + qtip +'"><b>'+value+'</b></div>';
						break;		
					case 'concepto':
						return '<div qtip="' + qtip +'"><b>'+value+'</b></div>';
						break;		
					case 'recargo':	
						return '<div qtip="' + qtip +'" class="recargo">'+value+'</div>';
						break;
					case 'recargoxciudad':	
						return '<div qtip="' + qtip +'" class="recargo">'+value+'</div>';
						break;
							
				}				
				
			} ,
			editor: comboRecargos
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
								
		<?
		if( $modalidad!="LCL" ){ 
		?>,{
			id: 'neta',
			header: "Neta",
			width: 80,
			sortable: false,
			groupable: false,							
			dataIndex: 'neta',
			editor: new Ext.form.NumberField()		
		}
		<?
		}
		?>
		,			
		{
			id: 'sugerida',
			header: "Sugerida",
			width: 80,
			sortable: false,
			groupable: false,							
			dataIndex: 'sugerida',
			editor: new Ext.form.NumberField()			
		}
		,		
		{
			header: "Aplicación",
			width: 100,
			sortable: false,
			groupable: false,
			
			dataIndex: 'aplicacion',              
			editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
			
			
		},	
		<?
		if( $modalidad!="FCL" ){ 
		?>		
		{
			id: 'minima',
			header: "Minima",
			width: 80,
			sortable: false,
			groupable: false,							
			dataIndex: 'minima',
			editor: new Ext.form.NumberField()			
		},
		{
			header: "Aplicación Min.",
			width: 100,
			sortable: false,
			groupable: false,
			
			dataIndex: 'aplicacion_min',              
				editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
		},	
		<?
		}
		?>
		
		{
			header: "Moneda",
			width: 80,
			sortable: false,
			groupable: false,
			dataIndex: 'moneda',              
			editor: <?=extMonedas("USD")?>
		}	
		
	]
	,
	isCellEditable: function(colIndex, rowIndex) {	
		var record = store.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
		
		if( record.data.tipo=="recargoxciudad" ){
			return false;
		}
		
		if( record.data.tipo=="concepto" && record.data.iditem=='9999' ){
			return false;
		}
		
		if( record.data.tipo=="concepto" && !(field=='neta' || field=='sugerida'||field=='inicio' || field=='vencimiento' || field=='moneda'|| field=='aplicacion')  ){
			return false;
		}
		
		if( record.data.tipo=="recargo"){			
			if( (field=='nconcepto' && record.data.iditem) || !( field=='nconcepto' || field=='neta' || field=='minima' || field=='moneda'|| field=='aplicacion'|| field=='aplicacion_min'|| field=='inicio' || field=='vencimiento')  ){					
				return false;								
			}		
		}
		
		if( record.data.tipo=="trayecto_obs"   ){		
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
				if( !(r.data.tipo=="concepto"||r.data.tipo=="recargo") ){
					continue;
				}
				if (r.data.recargo_id && (field == 'aplicacion'||field == 'inicio'||field == 'vencimiento')) {			
					continue;
				}	
				
				if(field == 'nconcepto'){					
					r.set("iditem",e.record.data.iditem);
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
var gridOndblclickHandler =  function(e) {	
	<?
	if($opcion!="consulta"){
	?>
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
	<?
	}
	?>
}
	
/*
* Coloca las observaciones en pantalla y actualiza el datastore 
*/
var actualizarObservaciones=function( btn, text ){		
	if( btn=="ok" ){			
		var record = store.getAt(activeRow); 
		record.set("observaciones", text);
		
		var records = store.getModifiedRecords();				
		var lenght = records.length;				
					
		for( var i=0; i< lenght; i++){
			r = records[i];			
			if(r.data.sel){
				r.set("observaciones", text);			
			}
		}
		
	}
}	


/*
* actualiza el estilo en una celda y en las celdas seleccionadas
*/
var colocarEstilo = function( rec,  val ){
				
	
	rec.set("style", val);
	
	if( rec.data.sel ){
		var records = store.getModifiedRecords();				
		var lenght = records.length;	
				
		for( var i=0; i< lenght; i++){
			r = records[i];			
			if(r.data.sel && r.data.tipo=="concepto"){
				r.set("style", val);
			}
		}
	}
}


var seleccionarConcepto = function(){ 
	var iditem = this.ctxRecord.data.iditem;
	var tipo = this.ctxRecord.data.tipo;	
	var idconcepto = this.ctxRecord.data.idconcepto;
					
	store.each(function(r){
		if( tipo=="concepto" ){ 
			if( r.data.iditem==iditem && r.data.tipo==tipo ){
				//alert( r.data.neta+" "+ r.data.minima );
				if( !(r.data.neta=="" && r.data.minima=="") ){//Evita que se seleccionen escalas que no se han creado por que no se necesitan
				
					r.set('sel', true);
				}
			}
		}
		
		if( tipo=="recargo" ){ 
			if( r.data.iditem==iditem && r.data.idconcepto==idconcepto && r.data.tipo==tipo ){
				r.set('sel', true);
			}
		}
	});   					                   
	
}


var gridOnRowcontextmenu =  function(grid, index, e){
		
	rec = this.store.getAt(index);	
	e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
	if( rec.data.tipo=='concepto' ){
		this.menu = new Ext.menu.Menu({
			id:'grid-ctx',			
			items: [{
					text: 'Nuevo recargo',
					iconCls: 'add',
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
								handler: function(){    					                   					colocarEstilo( rec , "");									
								}
							}, {
								text: 'Sugerida',
								checked: rec.get("style")=="yellow"?true:false,								
								group: 'theme',								
								handler: function(){   									               						colocarEstilo( rec , "yellow");									
								}
							}, {
								text: 'Mantenimiento',
								checked: rec.get("style")=="pink"?true:false,									
								group: 'theme',								
								handler: function(){    					                   					colocarEstilo( rec , "pink");									
								}
							}
						]
					}
                },
				{
					text: 'Seleccionar trayecto',
					iconCls: 'new-tab',
					scope:this,
					handler: function(){ 
						var trayecto = this.ctxRecord.data.trayecto;					
						store.each(function(r){
							if( r.data.trayecto==trayecto){
								r.set('sel', true);
							}
						});   					                   
						
					}
				},				
				{
					text: 'Seleccionar este concepto',
					iconCls: 'new-tab',
					scope:this,
					handler: seleccionarConcepto
				},
				
				{
					text: 'Control de cambios',
					iconCls: '',
					scope:this,
					handler: function(){    					                   
							ventanaControlCambios(this.ctxRecord, index);					
					}
				}				
			]
		});
		//this.menu.on('hide', this.onContextHide, this);
    		
		if(this.ctxRow){
			Ext.fly(this.ctxRow).removeClass('x-node-ctx');
			this.ctxRow = null;
		}
		this.ctxRecord = rec;
		this.ctxRow = this.view.getRow(index);
		Ext.fly(this.ctxRow).addClass('x-node-ctx');
		this.menu.showAt(e.getXY());
	}
	
	if( rec.data.tipo=='recargo' ){
		this.menu = new Ext.menu.Menu({
			id:'grid-ctx',
			 
			items: [					
					{
					text: 'Eliminar',
					iconCls: 'delete',
					scope:this,
					handler: function(){    					                   
						eliminarFila(this.ctxRecord, index);					
					}
				},
								
				{
					text: 'Seleccionar este recargo',
					iconCls: 'new-tab',
					scope:this,
					handler: seleccionarConcepto
				}				
			]
		});
				
		//this.menu.on('hide', this.onContextHide, this);
    		
		if(this.ctxRow){
			Ext.fly(this.ctxRow).removeClass('x-node-ctx');
			this.ctxRow = null;
		}
		this.ctxRecord = rec;
		this.ctxRow = this.view.getRow(index);
		Ext.fly(this.ctxRow).addClass('x-node-ctx');
		this.menu.showAt(e.getXY());
	}
}


function eliminarFila(ctxRecord, index){	
	if( confirm("Esta seguro?") ){
		var params = [];
		params['idtrayecto'] = ctxRecord.data.idtrayecto;
		params['idconcepto'] = ctxRecord.data.idconcepto;
		params['idrecargo'] = ctxRecord.data.iditem;	
		params['id'] = ctxRecord.id;	
		Ext.Ajax.request( 
			{   
				waitMsg: 'Eliminando...',						
				url: '<?=url_for("pricing/eliminarRecargoGrillaPorTraficos")?>', 						//method: 'POST', 
				//Solamente se envian los cambios 						
				params :	params,
										
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.success ){	
						store.each(
							function(r){
								if(r.id == res.id){									
									store.remove( r );
								}
							}
						);		
					
					}
				}	
			 }
		); 
		
	}
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
						  aplicacion:'',
						  aplicacion_min:'',
						  tipo:'recargo'							
						});
							
	
	records = [];
	records.push( rec );
	store.insert( index+1, records );
}
	


function guardarGrillaPorTrafico(){
	
	var records = store.getModifiedRecords();
			
	var lenght = records.length;
	
	for( var i=0; i< lenght; i++){
		r = records[i];
		if(!r.data.moneda && (r.data.tipo=="concepto"||r.data.recargo=="concepto")){
			Ext.MessageBox.alert('Warning','Por favor coloque la moneda en todos los items');
			return 0;
		}
	}	
	
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
		
		changes['id']=r.id;
		changes['tipo']=r.data.tipo;
		changes['iditem']=r.data.iditem;	
		changes['idconcepto']=r.data.idconcepto;	
		changes['idtrayecto']=r.data.idtrayecto;		
												
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeGrillaPorTraficos")?>', 						//method: 'POST', 
				//Solamente se envian los cambios 						
				params :	changes,
										
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.id ){				
						var rec = store.getById( res.id );
						
						rec.set("sel", false); //Quita la seleccion de todas las columnas				
						rec.commit();		
					}
				}	
			 }
		); 
		 
	}
	
	
}


/*
* Muestra todos los cambios realizados en el trayecto
*/
var ventanaControlCambios=function( record ){
	var url = '<?=url_for("pricing/historialCambiosBusqueda")?>';
	
	activeRecord = record;
		
	Ext.Ajax.request({
		url: url,
		params: {
			idtrayecto: record.data.idtrayecto
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
		handler: guardarGrillaPorTrafico
	}],
	<?
	}
	?>
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true, 
		enableGroupingMenu: false,
		startCollapsed : true, 		
		getRowClass: function(  record,  index,  rowParams,  store ){			
			//definido en myRowExpander.js
			/*switch( record.data.style ){
				case "yellow":					
					return "row_yellow";
					break;
				case "pink":					
					return "row_pink";
					break;
				default:
					return "";
					break;
			}*/
		} 
	}),	
	listeners:{
		rowcontextmenu: gridOnRowcontextmenu,
		afteredit: gridAfterEditHandler,
		dblclick : gridOndblclickHandler,
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



