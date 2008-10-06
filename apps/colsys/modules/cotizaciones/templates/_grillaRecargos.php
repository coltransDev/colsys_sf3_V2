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
    {name: 'transporte', type: 'string'},
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
var storeRecargos = new Ext.data.GroupingStore({
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
	
storeRecargos.load();	
		
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
/*			
			renderer: function(v, params, record){
                    return Ext.form.Hidden({id: 'transporte', name: 'transporte', value: 'Aéreo', allowBlank:false}); 
            },
			editor: <?=extRecargos()?>
*/
		},	
		{
			id: 'tipo',
			header: "Tipo",
			width: 10,
			sortable: true,
			dataIndex: 'tipo',
			hideable: false,
			editor: <?=extTipoRecargo()?>
		},
		{
			id: 'valor_tar',
			header: "Valor Recargo",
			width: 30,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_tar',
			hideable: false,
			editor: new Ext.form.TextField({
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
			/*editor: <?=extAplicaciones("aplica_tar")?>*/
		},
		{
			id: 'valor_min',
			header: "Mínimo",
			width: 30,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_min',
			hideable: false,
			editor: new Ext.form.TextField({
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
			/*editor: <?=extAplicaciones("aplica_min")?>*/
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
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'Detalles',
	                    allowBlank:true
			})
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
					,<?=extModalidad("modalidad", "Ext.getCmp('transporte')", "%")?>
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
						name: 'detalles',
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
* Lanza lan función de actualización de registros modificados 
*/
function updateRecargosModel(){
	var success = true;
	var records = storeRecargos.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
		
		changes['cotizacionId']=r.data.idcotizacion;
		changes['idrecargo']=r.data.idrecargo;
		changes['modalidad']=r.data.modalidad;

		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("cotizaciones/formRecargoGuardar")?>', 
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


function agregarFila(ctxRecord, index){	
}

/*
* Crea la grilla 
*/    
var grid_recargos = new Ext.grid.EditorGridPanel({
	store: storeRecargos,
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
		tooltip: 'Guarda los cambios realizados en Recargos en Origen',
		iconCls:'disk',  // reference to our css
		handler: updateRecargosModel
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
		getRowClass: function(  record,  index,  rowParams,  storeRecargos ){			
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
