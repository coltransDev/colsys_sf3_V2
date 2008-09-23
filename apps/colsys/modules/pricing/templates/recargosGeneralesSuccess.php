<?
use_helper("Ext2");

$c = new Criteria();
$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
//$c->setLimit(3);
$recargos = TipoRecargoPeer::doSelect( $c );
		
?>

/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'sel', type: 'string'},
	{name: 'idciudad', type: 'string'},
	{name: 'ciudad', type: 'string'},
	{name: 'recargo_70', type: 'string'}	
	<?
	
	foreach( $recargos as $recargo ){			
	?>
	,{name: 'recargo_<?=$recargo->getCaIdrecargo()?>', type: 'string'}			
	<?			
	}
	?>		
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/recargosGeneralesData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico;

?>
var store = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',
	reader: new Ext.data.JsonReader(
		{
			id: 'idciudad',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	sortInfo:{field: 'ciudad', direction: "ASC"}
	
	
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
		checkColumn
		,
		{
			header: "Ciudad",
			width: 100,
			sortable: true,			
			dataIndex: 'ciudad'  
		}
		
		<?
	
		foreach( $recargos as $recargo ){			
		?>
		,
		{
			header: "<?=$recargo->getCaRecargo()?>",
			width: 100,
			sortable: true,			
			dataIndex: 'recargo_<?=$recargo->getCaIdrecargo()?>',
			id: 'recargo_<?=$recargo->getCaIdrecargo()?>',
			hidden: <?=in_array($recargo->getCaIdrecargo(),$recargosArray)?"false":"true"?>,		
			
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
		
		
				
		//envía la ciudad como parametro
		if(r.data.idciudad){
			changes['idciudad']=r.data.idciudad;								
		}
												
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeRecargosGenerales")?>', 						
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

function agregarRecargo(){	
	//crea una ventana 
	win = new Ext.Window({		
		width       : 400,
		height      : 200,
		closeAction :'hide',
		plain       : true,		
		
		items       : new Ext.FormPanel({					
			id: 'recargo-form',			
			frame: true,
			title: 'Por favor seleccione un recargo',
			autoHeight: true,
			bodyStyle: 'padding: 10px 10px 0 10px;',
			labelWidth: 50, 			
			
			items: [ <?=extRecargos($transporte)?>]
			
		}),

		buttons: [{
			text     : 'Crear',
			handler: function(){
				
				var fp = Ext.getCmp("recargo-form");	
				var idrecargo = fp.getForm().findField("idrecargo").getValue();
				//alert( idrecargo );				
				if(fp.getForm().isValid()){
					//Se agrega dinamicamente la columna en la grilla
					var grid =  Ext.getCmp('recgen_<?=$idcomponent?>');
					 
					var idx =  grid.getColumnModel().findColumnIndex('recargo_'+idrecargo);  
					grid.getColumnModel().setHidden(idx, false);  
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
* Crea la grilla 
*/    

new Ext.grid.EditorGridPanel({
	store: store,
	//master_column_id : 'nconcepto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	//autoExpandColumn: 'nconcepto',
	title: 'Recargos <?=$trafico->getCaNombre()?>',
	
	plugins: [checkColumn], //expander,
	closable: true,
	id: 'recgen_<?=$idcomponent?>',
	
	tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'disk',  // reference to our css
		handler: updateModel
	},
	{
		text: 'Agregar',
		tooltip: 'Crea un nuevo recargo',
		iconCls:'add',  // reference to our css
		handler: agregarRecargo
	}
	],
	
	view: new Ext.grid.GridView({
		 forceFit :true
		
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



