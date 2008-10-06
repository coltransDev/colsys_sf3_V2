<?
use_helper("Ext2");
?>

var data_seguros = <?=json_encode( array("seguros"=>$seguros, "total"=>count($seguros)) )?>;
/*
* Crea el Record 
*/
var recordGrilla = Ext.data.Record.create([
    {name: 'idcotizacion', type: 'string'},
    {name: 'idmoneda', type: 'string'},
    {name: 'prima_tip', type: 'string'},
    {name: 'prima_vlr', type: 'string'},
    {name: 'prima_min', type: 'string'},
    {name: 'obtencion', type: 'string'},
	{name: 'observaciones', type: 'string'},
    {name: 'oid', type: 'string'}
]);
  
   		
/*
* Crea el store
*/
var storeSeguros = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{
			id: 'seguro',
			root: 'seguros',
			totalProperty: 'total'
		}, 
		recordGrilla
	),
	proxy: new Ext.data.MemoryProxy(data_seguros),
});
	
storeSeguros.load();	
		
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
			id: 'oid',
			header: "Oid",
			width: 10,
			sortable: true,			
			dataIndex: 'oid',
			hideable: false,
			hidden: true
		},{
			id: 'cotizacionId',
			header: "cotizacionId",
			width: 10,
			sortable: true,
			dataIndex: 'cotizacionId',
			hideable: false,
			hidden: true
		},{
			id: 'prima_tip',
			header: "Tipo",
			width: 10,
			sortable: true,
			dataIndex: 'prima_tip',
			hideable: false,
			editor: <?=extTipoRecargo()?>
		},{
			id: 'prima_vlr',
			header: "Prima",
			width: 25,
			sortable: true,
			renderer: Ext.util.Format.defaultValue,
			dataIndex: 'prima_vlr',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'prima_vlr',
						allowBlank:false,
						allowNegative: false
			})
		},{
			id: 'prima_min',
			header: "Mínimo",
			width: 25,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'prima_min',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'prima_min',
						allowBlank:false,
						allowNegative: false
			})
		},{
			id: 'obtencion',
			header: "Obtención Póliza",
			width: 25,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'obtencion',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'obtencion',
						allowBlank:false,
						allowNegative: false
			})
		},{
			id: 'idmoneda',
			header: "Moneda",
			width: 15,
			sortable: true,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=extMonedas()?>
		},{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: true,
			dataIndex: 'observaciones',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'observaciones'
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
* Lanza lan función de actualización de registros modificados 
*/
function updateSeguroModel(){
	var success = true;
	var records = storeSeguros.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
		
		changes['cotizacionId']=r.data.idcotizacion;
		changes['oid']=r.data.oid;

		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("cotizaciones/observeSegurosManagement")?>', 
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
		storeSeguros.commitChanges();
		Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
	}else{
		Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
	}	
}


function agregarFila(){
	index = 0;
	var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
						  prima_tip:'',
						  prima_vlr:0,
						  prima_min:0,
						  obtencion:'',
						  idmoneda:'',
						  observaciones:''
						});
	records = [];
	records.push( rec );
	storeSeguros.insert( index+1, records );
	
}

/*
* Crea la grilla 
*/    
var grid_seguros = new Ext.grid.EditorGridPanel({
	store: storeSeguros,
	master_column_id : 'seguro',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	autoExpandColumn: 'seguro',
	title: 'Tarifas para Seguro',

	root_title: 'prima_tip',	
	// plugins: [checkColumn], //expander,
	closable: true,
	id: 'grid_seguros',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en Seguros',
		iconCls:'disk',  // reference to our css
		handler: updateSeguroModel
	},
	{
		text: 'Agregar Seguro',
		tooltip: '...',
		scope:this,
		handler: function(){
			agregarFila();
		}
	}
	
	],
	
	view: new Ext.grid.GroupingView({
		forceFit:true,
		enableRowBody:true, 
		getRowClass: function(  record,  index,  rowParams,  storeSeguros ){			
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
