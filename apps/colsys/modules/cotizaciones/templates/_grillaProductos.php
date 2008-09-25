<?
use_helper("Ext2");
?>

var data_productos = <?=json_encode( array("productos"=>$productos, "total"=>count($productos)) )?>;
/*
* Crea el Record 
*/
var recordGrilla = Ext.data.Record.create([
    {name: 'trayecto', type: 'string'},   		
	{name: 'producto', type: 'string'},
	{name: 'impoexpo', type: 'string'},
	{name: 'transporte', type: 'string'},
	{name: 'modalidad', type: 'string'},
	{name: 'incoterms', type: 'string'},
	{name: 'origen', type: 'string'},
	{name: 'destino', type: 'string'},
	{name: 'frecuencia', type: 'string'},
	{name: 'ttransito', type: 'string'},
	{name: 'observaciones', type: 'string'},
	{name: 'imprimir', type: 'string'}
]);
   		
/*
* Crea el store
*/
<?
$url ="cotizaciones/asd";
/*$url = "pricing/pagerData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico;
if( $idlinea ){
	$url .= "&idlinea=".$idlinea;
}
if( $idciudad ){
	$url .= "&idciudad=".$idciudad;
}*/

?>
var storeProductos = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'producto',
			root: 'productos',
			totalProperty: 'total'
		}, 
		recordGrilla
	),
	sortInfo:{field: 'producto', direction: "ASC"},
	proxy: new Ext.data.MemoryProxy(data_productos),
	groupField: 'trayecto'		
	
});
	
storeProductos.load();	
		
/*
* Crea la columna de chequeo
*/	


/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/

var colModel = new Ext.grid.ColumnModel({		
	columns: [
		{
			id: 'trayecto',
			header: "Trayecto",
			width: 100,
			sortable: true,
			dataIndex: 'trayecto',
			hideable: false,
			hidden: true
			
		},
		{
			id: 'producto',
			header: "Producto",
			width: 200,
			sortable: true,			
			dataIndex: 'producto',
			hideable: false,
//			renderer: function(value, metaData){
//					if( value=="FLETE" ){					
//						return "<div style='font-weight:bold'>"+value+"</div>";
//					}else{
//						return value;
//					}
//				} 
		},	
	
		{
			id: 'frecuencia',
			header: "Frecuencia",
			width: 100,
			sortable: true,
			dataIndex: 'frecuencia',
			hideable: false 
		},
		{
			id: 'ttransito',
			header: "Tiempo/Transito",
			width: 100,
			sortable: true,
			dataIndex: 'ttransito',
			hideable: false 
		},
		{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: true,
			dataIndex: 'observaciones',
			hideable: false 
		},
		{
			id: 'imprimir',
			header: "Imprimir",
			width: 100,
			sortable: true,
			dataIndex: 'imprimir',
			hideable: false 
		},
		
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


var productoHandler = function(){
	//crea una ventana 
	win = new Ext.Window({		
		width       : 450,
		height      : 400,
		closeAction :'hide',
		plain       : true,		
		
		items       : new Ext.FormPanel({					
			id: 'recargo-form',			
			frame: true,
			title: 'Ingrese los datos del Producto',
			autoHeight: true,
			bodyStyle: 'padding: 5px 5px 0 5px;',
			labelWidth: 80, 			
			
			items: [{
						xtype:'textfield',
						fieldLabel: 'Producto',
						name: 'producto',
						value: '',						 
						allowBlank:false,
						width: 300
	                },
					<?=extImpoExpo()?>
					,
					<?=extIncoterms()?>
					,
					<?=extTransporte()?>
					,
					<?=extModalidad()?>
					,
					<?=extOrigen()?>
					,
					<?=extDestino()?>
					,{
						xtype: 'textarea',
						width: 310,
						fieldLabel: 'Observaciones',
						name: 'observaciones',
						value: '',
	                    allowBlank:true
					},
					<?=extImprimir()?>
					]
			
		}),

		buttons: [{
			text     : 'Crear',
			handler: function(){
				
				var fp = Ext.getCmp("recargo-form");	
												
				if(fp.getForm().isValid()){
					fp.getForm().submit({url:'<?=url_for('cotizaciones/formCotizacionGuardar')?>', 
	            							 	waitMsg:'Salvando Datos básicos de la Cotizaci&oacute;n...',
	            							 	// standardSubmit: false,
	            							 	success:function(response,options){
	            							 		win.close();
	            							 	},
		            							failure:function(response,options){							
													Ext.msg.alert( "Error "+response.responseText );
													win.close();
												}//end failure block      
											});
					
					
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
* Coloca las observaciones en pantalla y actualiza el datastore 
*/
var actualizarObservaciones=function( btn, text ){		
}	

function updateModel(){
}



function agregarFila(ctxRecord, index){	
}

/*
* Crea la grilla 
*/    
var grid = new Ext.grid.EditorGridPanel({
	store: storeProductos,
	master_column_id : 'producto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'producto',
	title: 'Datos grilla',

	root_title: 'impoexpo',	
	// plugins: [checkColumn], //expander,
	closable: true,
	id: 'grid_productos',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'disk',  // reference to our css
		handler: updateModel
	},
	{
		text: 'Agregar producto',
		tooltip: '...',
		iconCls:'disk',  // reference to our css
		handler: productoHandler
	}
	
	],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true, 
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
	})	
});
