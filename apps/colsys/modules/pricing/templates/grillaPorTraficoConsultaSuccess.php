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
	{name: 'recargo_id', type: 'int'},
	{name: 'concepto_id', type: 'int'},
	{name: 'observaciones', type: 'string'},
	{name: 'aplicacion', type: 'string'},		
	{name: '_id', type: 'int'},
	{name: '_parent', type: 'auto'},
	{name: '_is_leaf', type: 'bool'},
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
			dataIndex: 'neta'		
		},		
		{
			id: 'minima',
			header: "<?=($transporte=="Aéreo"||$modalidad=="FCL")?"Sugerida":"Minima"?>",
			width: 80,
			sortable: true,
			groupable: false,								
			dataIndex: 'minima'		
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
* Crea la grilla 
*/    
new Ext.grid.GridPanel({
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
	/*tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'disk',  // reference to our css
		handler: updateModel
	}],*/
	
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
	/*
	bbar: new Ext.PagingToolbar({
		store: store,
		displayInfo: true,
		pageSize: 80
		
	}),*/
	

});
//store.load();



