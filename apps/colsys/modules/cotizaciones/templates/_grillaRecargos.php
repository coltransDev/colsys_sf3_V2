<?
use_helper("Ext2");
?>

var data_recargos = <?=json_encode( array("recargos"=>$recargos, "total"=>count($recargos)) )?>;
/*
* Crea el Record 
*/
var recordGrilla = Ext.data.Record.create([
    {name: 'idcotizacion', type: 'string'},
    {name: 'idproducto', type: 'string'},
    {name: 'idopcion', type: 'string'},
    {name: 'idconcepto', type: 'string'},
    {name: 'idrecargo', type: 'string'},
    {name: 'agrupamiento', type: 'string'},
    {name: 'recargo', type: 'string'},
    {name: 'tipo', type: 'string'},
    {name: 'valor_tar', type: 'string'},
    {name: 'aplica_tar', type: 'string'},
    {name: 'valor_min', type: 'string'},
    {name: 'aplica_min', type: 'string'},
    {name: 'idmoneda', type: 'string'},
    {name: 'modalidad', type: 'string'},
    {name: 'observaciones', type: 'string'},
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
var storerecargos = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'recargo',
			root: 'recargos',
			totalProperty: 'total'
		}, 
		recordGrilla
	),
	sortInfo:{field: 'recargo', direction: "ASC"},
	proxy: new Ext.data.MemoryProxy(data_recargos),
	groupField: 'agrupamiento'		
});
	
storerecargos.load();	
		
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
			id: 'recargo',
			header: "Recargo",
			width: 200,
			sortable: true,			
			dataIndex: 'recargo',
			hideable: false,
		},	
		{
			id: 'tipo',
			header: "Tipo",
			width: 100,
			sortable: true,
			dataIndex: 'tipo',
			hideable: false 
		},
		{
			id: 'valor_tar',
			header: "Valor Recargo",
			width: 100,
			sortable: true,
			dataIndex: 'valor_tar',
			hideable: false 
		},
		{
			id: 'aplica_tar',
			header: "Aplicación Rec.",
			width: 100,
			sortable: true,
			dataIndex: 'aplica_tar',
			hideable: false 
		},
		{
			id: 'valor_min',
			header: "Mínimo",
			width: 100,
			sortable: true,
			dataIndex: 'valor_tar',
			hideable: false 
		},
		{
			id: 'aplica_min',
			header: "Aplicación Min.",
			width: 100,
			sortable: true,
			dataIndex: 'aplica_min',
			hideable: false 
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 100,
			sortable: true,
			dataIndex: 'idmoneda',
			hideable: false 
		},
		{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: true,
			dataIndex: 'observaciones',
			hideable: false 
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

var recargoHandler = function(){
	//crea una ventana 
	win = new Ext.Window({		
		width       : 430,
		height      : 380,
		closeAction :'hide',
		plain       : true,		
		
		items       : new Ext.FormPanel({
			id: 'recargo-form',
			layout: 'form',
			frame: true,
			title: 'Ingrese los datos del Recargo Local',
			autoHeight: true,
			bodyStyle: 'padding: 5px 5px 0 5px;',
			labelWidth: 80,
			
			items: [{
						id: 'cotizacionId',
						xtype:'hidden',
						name: 'cotizacionId',
						value: '<?=$cotizacion->getCaIdcotizacion()?>',
			            allowBlank:false
					},
					new Ext.form.Hidden({
						id: 'impoexpo',						
						name: 'impoexpo',
						value: '%',
			            allowBlank:false
			        })
					,<?=extTransporte()?>
					,<?=extModalidad()?>
	                ,<?=extRecargos()?>
	                ,<?=extTipoRecargo()?>
	                ,<?=extMonedas()?>
					,{
						xtype:'textfield',
						fieldLabel: 'Valor',
						name: 'valor_tar',
						value: '',						 
						allowBlank:false,
						width: 120
	                }
					,<?=extAplicaciones("aplica_tar")?>
					,{
						xtype:'textfield',
						fieldLabel: 'Mínimo',
						name: 'valor_min',
						value: '',						 
						allowBlank:false,
						width: 120
	                }
					,<?=extAplicaciones("aplica_min")?>
					,{
						xtype: 'textfield',
						width: 300,
						fieldLabel: 'Detalles',
						name: 'Detalles',
						value: '',
	                    allowBlank:true
					}
					]
			
		}),

		buttons: [{
			text     : 'Guardar',
			handler: function(){
				var fp = Ext.getCmp("recargo-form");	
												
				if( fp.getForm().isValid() ){
					fp.getForm().submit({url:'<?=url_for('cotizaciones/formRecargoGuardar')?>', 
	            							 	waitMsg:'Salvando Recargos Locales...',
	            							 	// standardSubmit: false,
	            							 	
	            							 	success:function(response,options){
	            							 		Ext.Msg.alert( "Success "+response.responseText );
	            							 		win.close();
	            							 	},
		            							failure:function(response,options){
													Ext.Msg.alert( "Error "+response.responseText );
													win.close();
												}//end failure block      
											});
					}else{
						Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información del Recargo no es válida o está incompleta!');
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
var grid_recargos = new Ext.grid.EditorGridPanel({
	store: storerecargos,
	master_column_id : 'recargo',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'recargo',
	title: 'Recargos Locales',

	root_title: 'impoexpo',	
	// plugins: [checkColumn], //expander,
	closable: true,
	id: 'grid_recargos',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'disk',  // reference to our css
		handler: updateModel
	},
	{
		text: 'Agregar Recargo',
		tooltip: 'Opción para Crear un recargo nuevo',
		iconCls:'disk',  // reference to our css
		handler: recargoHandler
	}
	
	],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true, 
		getRowClass: function(  record,  index,  rowParams,  storerecargos ){			
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
