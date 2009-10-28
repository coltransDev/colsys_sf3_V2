<?
/*
Panel de recargos locales x naviera recargos x linea 
*/



if( $transporte==Constantes::MARITIMO ){ 
	$lineaStr = "Naviera";
}elseif( $transporte==Constantes::AEREO ){
	$lineaStr = "Aerolínea";
}else{
	$lineaStr = "Línea";
}


if( $nivel>0 ){	
	?>
	var comboLineas = new Ext.form.ComboBox({			
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,					
		lazyRender:true,
		allowBlank: false,
		listClass: 'x-combo-list-small',
		valueField:'idlinea',
		displayField:'linea',
		mode: 'local',	
		store :  new Ext.data.SimpleStore({
					fields: ['idlinea', 'linea'],
					data : [
						
						<?					
						$i=0;
						foreach( $lineas as $linea ){
							if( $i++!=0 ){
								echo ",";
							}
						?>
							['<?=$linea["p_ca_idproveedor"]?>','<?=$linea["id_ca_nombre"]?>']
						<?
						}
						?>
					]
				})
	
	});
		
	var comboRecargos = new Ext.form.ComboBox({			
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
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
							['<?=$recargo->getCaIdrecargo()?>','<?=$recargo->getCaRecargo()?>']
						<?
						}
						?>
					]
				})
	
	});
	
	
	var comboConceptos = new Ext.form.ComboBox({			
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,					
		lazyRender:true,
		allowBlank: false,
		listClass: 'x-combo-list-small',
		valueField:'idconcepto',
		displayField:'concepto',
		mode: 'local',	
		store :  new Ext.data.SimpleStore({
					fields: ['idconcepto', 'concepto'],
					data : [
						<?
						$i=0;
						foreach( $conceptos as $concepto ){
							if( $i++!=0){
								echo ",";
							}
						?>
							['<?=$concepto->getCaIdconcepto()?>','<?=str_replace( "'", "\'", $concepto->getCaConcepto())?>']
						<?
						}
						?>
						,['9999','Aplica para todos']
					]
				})
	
	});
	
<?
}
?>

var expander = new Ext.grid.myRowExpander({
lazyRender : false,
width: 15,
tpl : new Ext.Template(
  '<p><div >&nbsp;&nbsp; {observaciones}</div></p>'

)
});

/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   		
	{name: 'sel', type: 'string'},
	{name: 'id', type: 'int'},
	{name: 'idtrafico', type: 'string'},	
	{name: 'idlinea', type: 'string'},	
	{name: 'impoexpo', type: 'string'},	
	{name: 'linea', type: 'string'},
	{name: 'idrecargo', type: 'string'},	
	{name: 'recargo', type: 'string'},
	{name: 'idconcepto', type: 'string'},
	{name: 'concepto', type: 'string'},
    {name: 'inicio', type: 'date', dateFormat:'Y-m-d'},
	{name: 'vencimiento', type: 'date', dateFormat:'Y-m-d'},
	{name: 'vlrrecargo', type: 'float'},
	{name: 'vlrminimo', type: 'float'},
	{name: 'aplicacion', type: 'string'},
	{name: 'aplicacion_min', type: 'string'},
	{name: 'idmoneda', type: 'string'},
	{name: 'observaciones', type: 'string'}		
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/recargosPorLineaData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico."&impoexpo=".$impoexpo."&idlinea=".$idlinea;

	
?>
var storeRecargos = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	sortInfo:{field: 'id', direction: "ASC"}
});
	
/*
* Crea la columna de chequeo
*/	
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false}); 

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModel = new Ext.grid.ColumnModel({		
	columns: [
        <?
        if( $nivel==0 ){
        ?>
        expander,
        <?
        }
        ?>
		checkColumn
		,
		<?		
		if( !$idlinea ){
		?>		
		{
			header: "<?=$lineaStr?>",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'linea' 
			<?
			if( $nivel>0 ){
			?>
			,
			editor: comboLineas 
			<?
			}
			?>
		}		
		,
		<?
		}
		?>
		{
			header: "Recargo",
			width: 150,
			sortable: false,	
			hideable: false,		
			dataIndex: 'recargo' 
			<?
			if( $nivel>0 ){
			?>
			,
			editor: comboRecargos 
			<?
			}
			?>
		}
		,
		<?		
		if( $idtrafico=="99-999" && $transporte==Constantes::MARITIMO ){
		?>
		{
			header: "Concepto",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'concepto' 
			<?
			if( $nivel>0 ){
			?>
			,
			editor: comboConceptos 
			<?
			}
			?>
		}
		,
		<?
		}
		?>
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
		,
		{
			header: "Valor",
			width: 50,
			sortable: false,	
			hideable: false,		
			dataIndex: 'vlrrecargo',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false,
						decimalPrecision :3
			})  
		},
		{
			header: "Aplicación",
			width: 80,
			sortable: false,	
			hideable: false,		
			dataIndex: 'aplicacion'
			<?
			if( $nivel>0 ){
			?>
			,
			editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
			<?
			}
			?>
		}
		<?
		if( $modalidad!="FCL" ){
		?>
		,
		{
			header: "Mínimo",
			width: 50,
			sortable: true,	
			hideable: false,		
			dataIndex: 'vlrminimo',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:true,
						allowNegative: false,
						decimalPrecision :3
			})  
		},
		{
			header: "Aplicación Mín.",
			width: 80,
			sortable: false,	
			hideable: false,		
			dataIndex: 'aplicacion_min'
			<?
			if( $nivel>0 ){
			?>
			,
			editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
			<?
			}
			?>
		}
		<?
		}
		?>
		,
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 40,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false
			<?
			if( $nivel>0 ){
			?>
			,			
			editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
			<?
			}
			?>
		}
		<?
        if( $nivel!=0 ){
        ?>
		,
		{
			id: 'observaciones',
			header: "Observaciones",
			<?
			if( $modalidad!="FCL" ){
			?>	
			width: 260, 
			<?
			}else{
			?>
			width: 100, 
			<?
			}
			?>
			sortable: false,
			dataIndex: 'observaciones',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'Detalles',
	                    allowBlank:true
			})
		}
        <?
        }
        ?>
				
	],
	isCellEditable: function(colIndex, rowIndex) {	
		var record = storeRecargos.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
		
		<?
		if($idtrafico!="99-999"){ 
		?>
		if( !record.data.idlinea && field!="linea" ){
			return false;
		}
		
		if( record.data.idlinea && field=="linea" ){
			return false;
		}
		<?
		}else{
		?>
		if( !record.data.idrecargo && field!="recargo" ){
			return false;
		}
		
		if( record.data.idrecargo && field=="recargo" ){
			return false;
		}
		<?
		}
		?>
		
		
		
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
		var records = storeRecargos.getModifiedRecords();				
		var lenght = records.length;				
		var field = e.field;
				
		for( var i=0; i< lenght; i++){
			r = records[i];			
			if(r.data.sel){
				if ( (field == 'linea')) {			
					continue;
				}	
				r.set(field,e.value);
				
				if ( (field == 'recargo')) {			
					r.set("idrecargo",e.record.data.idrecargo);
				}	
				
			}
		}
	}	
}

/*
* Handler que se encarga de colocar el dato recargo_id en el Record 
* cuando se inserta un nuevo recargo
*/
var gridOnValidateEdit = function(e){
	
	if( e.field == "recargo"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
		
	    store.each( function( r ){				
				if( r.data.idrecargo==e.value ){					
					<?
					if($idtrafico=="99-999"){ 
					?>
					if( !rec.data.idrecargo  ){	
						/*
						* Crea una columna en blanco adicional para permitir 
						* agregar mas items
						*/
						var newRec = new record({
							id: rec.data.id+1, 
						   idtrafico: rec.data.idtrafico,  
						   idlinea: '<?=$idlinea?>',
						   linea: '+', 
						   idrecargo: '',  						   
						   recargo: '', 						   
						   vlrrecargo: '',  
						   vlrminimo: '',   
						   aplicacion: '',
						   aplicacion_min: '',							   
						   idmoneda: '',
						   observaciones: ''
						});	
						newRec.id = rec.data.id+1;								
						//Inserta una columna en blanco al final												
						storeRecargos.addSorted(newRec);										
						
					}
					<?
					}
					?>	
					rec.set("idconcepto", '9999');
					rec.set("concepto", 'Aplica para todos');	   				
					rec.set("idrecargo", r.data.idrecargo);
					rec.set("idmoneda", "USD");
					e.value = r.data.recargo;				
					return true;
				}
			}
		)		
	}
	
	if( e.field == "concepto"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
		
	    store.each( function( r ){				
				if( r.data.idconcepto==e.value ){						
					rec.set("idconcepto", r.data.idconcepto);
					
					e.value = r.data.concepto;				
					return true;
				}
			}
		)		
	}
	
	if( e.field == "linea"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
		
	    store.each( function( r ){						
				if( r.data.idlinea==e.value ){									
					<?
					if($idtrafico!="99-999"){ 
					?>
					if( !rec.data.idlinea  ){	
						/*
						* Crea una columna en blanco adicional para permitir 
						* agregar mas items
						*/
						var newRec = new record({
							id: rec.data.id+1, 
						   idtrafico: rec.data.idtrafico,  
						   idlinea: '',
						   linea: '+', 
						   idrecargo: '',  					   					   
						   recargo: '', 
						   vlrrecargo: '',  
						   vlrminimo: '',   
						   aplicacion: '',
						   aplicacion_min: '',							   
						   idmoneda: '',
						   observaciones: ''
						});	
						newRec.id = rec.data.id+1;								
						//Inserta una columna en blanco al final												
						storeRecargos.addSorted(newRec);										
						
					}
					<?
					}
					?>						
					rec.set("idconcepto", '9999');
					rec.set("concepto", 'Aplica para todos');	   
					rec.set("idlinea", r.data.idlinea);
					rec.set("idmoneda", "USD");
					e.value = r.data.linea;				
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
		
		document.getElementById("obs_"+record.get("_id")).innerHTML  = "<b>Observaciones:</b> "+text;		
	}
}	

function guardarRecargosPorLinea(){
	var success = true;
	var records = storeRecargos.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
				
		changes['id']=r.id;
		changes['idlinea']=r.data.idlinea;										
 	    changes['idrecargo']=r.data.idrecargo;
        if(changes['inicio']){
			changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');
		}

		if(changes['vencimiento']){
			changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');
		}
		<?		
		if( $idtrafico=="99-999" && $transporte==Constantes::MARITIMO ){
		?>										
		changes['idconcepto']=r.data.idconcepto;
		<?
		}
		?>
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeRecargosPorLinea?idtrafico=".$idtrafico."&modalidad=".$modalidad."&impoexpo=".utf8_encode($impoexpo))?>', 						
				//Solamente se envian los cambios 						
				params :	changes,
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.id && res.success){				
						var rec = storeRecargos.getById( res.id );						
						rec.set("sel", false); //Quita la seleccion de todas las columnas				
						rec.commit();		
					}
				}	
										
				
			 }
		); 
		r.set("sel", false);//Quita la seleccion de todas las columnas 
	}	
	
}

/*
* Menu contextual que se despliega sobre una fila con el boton derecho
*/
var gridOnRowcontextmenu =  function(grid, index, e){

    if( typeof(this.menu) !="undefined" ){
        this.menu.removeAll( true );
    }
	rec = this.store.getAt(index);
	this.menu = new Ext.menu.Menu({
	id:'grid_recargos-ctx',
	items: [		
			{
				text: 'Eliminar item',
				iconCls: 'delete',
				scope:this,
				handler: function(){    					                   		
					if( this.ctxRecord && this.ctxRecord.data.idrecargo ){											
						var id = this.ctxRecord.id;						
						var idlinea = this.ctxRecord.data.idlinea;
						var idrecargo = this.ctxRecord.data.idrecargo;
						var idconcepto = this.ctxRecord.data.idconcepto;
											
						if( idrecargo && confirm("Esta seguro?") ){
							
							Ext.Ajax.request( 
							{   
								waitMsg: 'Guardando cambios...',						
								url: '<?=url_for("pricing/eliminarRecargosPorLinea?idtrafico=".$idtrafico."&modalidad=".$modalidad."&impoexpo=".utf8_encode($impoexpo))?>',
								//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{									
									idlinea: idlinea,									
									idrecargo: idrecargo,
									idconcepto: idconcepto,
									id: id

								},
														
								
								callback :function(options, success, response){	
										
									var res = Ext.util.JSON.decode( response.responseText );	
									
									if( res.id && res.success){				
										var rec = storeRecargos.getById( res.id );														
										storeRecargos.remove(rec);	
									}
								}									
								
								
							}); 
						}
					}						
				}
			}	
			]
	});
	//this.menu.on('hide', this.onContextHide, this);
   
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


var seleccionarTodo = function(){	
	storeRecargos.each( function(r){
			r.set("sel", true);
		} 
	);
}


	
/*
* Crea la grilla 
*/    

<?=isset($object)?"var ".$object."=":""?> new Ext.grid.<?=$nivel>0?"Editor":""?>GridPanel({
	 region: 'center',
	store: storeRecargos,
	//master_column_id : 'nconcepto',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
    loadMask: {msg:'Cargando...'},
	stripeRows: true,
	//autoExpandColumn: 'nconcepto',
	title: '<?=$titulo?>',
	height: 500,
	
	plugins: [checkColumn
    <?
    if( $nivel==0 ){
    ?>
    , expander
    <?
    }
    ?>
    ],
	closable: <?=$idtrafico=="99-999"?"false":"true"?>,	
	<?
	if( $nivel>0 ){
	?>
	tbar: [			  
		{
			text: 'Guardar Cambios',
			tooltip: 'Guarda los cambios realizados en el tarifario',
			iconCls:'disk',  // reference to our css
			handler: guardarRecargosPorLinea
		},	
		{
			text: 'Seleccionar todo',
			tooltip: 'Selecciona todas las ciudades',
			iconCls:'tick',  // reference to our css
			handler: seleccionarTodo
		}
	],
	<?
	}
	?>	
	view: new Ext.grid.GridView({
		 forceFit :true
		
	}),		
	listeners:{
		rowcontextmenu: gridOnRowcontextmenu,
		afteredit: gridAfterEditHandler,
		click: gridOnclickHandler,		
		validateedit: gridOnValidateEdit
		
	}	

});