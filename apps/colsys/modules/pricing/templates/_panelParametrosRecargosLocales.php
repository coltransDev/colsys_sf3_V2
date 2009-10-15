<?
if( $nivel>0 ){	
	

?>
	var comboConcepto = new Ext.form.ComboBox({			
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
						foreach( $parametros as $parametro ){
							if( $i++!=0 ){
								echo ",";
							}
						?>
							['<?=$parametro->getCaIdentificacion()?>','<?=$parametro->getCaValor()?>']
						<?
						}
						?>
					]
				})
	
	});
	
	var comboValores = <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>;
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
var recordRecargosLocalesParametros = Ext.data.Record.create([   			
	{name: 'id', type: 'int'},
	{name: 'modalidad', type: 'string'},	
	{name: 'idlinea', type: 'string'},	
	{name: 'impoexpo', type: 'string'},	
	{name: 'linea', type: 'string'},
	{name: 'idconcepto', type: 'string'},
	{name: 'concepto', type: 'string'},
	{name: 'valor', type: 'string'},
	{name: 'observaciones', type: 'string'}		
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/recargosPorLineaParametrosData?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&impoexpo=".$impoexpo."&idlinea=".$idlinea;

	
?>
var storeRecargosLocalesParametros = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordRecargosLocalesParametros
	),
	sortInfo:{field: 'id', direction: "ASC"}
});
	


/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModelRecargosLocalesParametros = new Ext.grid.ColumnModel({		
	columns: [
        <?		
        if( $nivel==0 ){
        ?>
        expander,
        <?
        }
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
			,editor: comboConcepto 		
			<?
			}
			?>
		}		
		,
		{
			header: "Aplicación",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'valor' 
			<?
			if( $nivel>0 ){	
			?>
			,editor: comboValores 		
			<?
			}
			?>
			
			
		}
        <?
        if( $nivel>0 ){
        ?>
		,
		{
			header: "Observaciones",
			width: 100,
			sortable: false,	
			hideable: false,		
			dataIndex: 'observaciones',
			editor: new Ext.form.TextField({
						
			})   
			
		}
        <?
        }
        ?>
				
	],
	isCellEditable: function(colIndex, rowIndex) {	
		var record = storeRecargosLocalesParametros.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
		
		
		if( !record.data.concepto && field!="concepto" ){
			
			return false;
		}
		
		if( record.data.concepto!="+" && field=="concepto" ){			
			return false;
		}
		
		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);		
	}	
});

/*
* Configura el modo de seleccion de la grilla 
*/
var selModelRecargosLocalesParametros = new  Ext.grid.CellSelectionModel();

/*
* Actualiza los datos de la base de datos usando Ajax.
*/

/*
* Handlers de los eventos y botones de la grilla 
*/





/*
* Handler que se encarga de colocar el dato recargo_id en el Record 
* cuando se inserta un nuevo recargo
*/
var gridOnvalidateedit = function(e){
	
	if( e.field == "concepto"){		
		var rec = e.record;		   
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		var store = ed.field.store;
		
		store.each( function( r ){				
				if( r.data.idconcepto==e.value ){					
					
					if( !rec.data.idconcepto  ){	
						/*
						* Crea una columna en blanco adicional para permitir 
						* agregar mas items
						*/
						var newRec = new record({			
						   concepto: '+',							   
						   valor: '',
						   observaciones: ''
						});	
											
						//Inserta una columna en blanco al final												
						storeRecargosLocalesParametros.addSorted(newRec);											
						
					}
					
					   				
					rec.set("idconcepto", r.data.idconcepto);					
					e.value = r.data.concepto;				
					return true;
				}
			}
		)			
	}
	
}

var gridOnBeforeedit  = function( e ){						
	
	if( e.field=="valor" ){
		<?
		foreach( $parametros as $parametro ){
			?>
			var datosValor<?=$parametro->getCaIdentificacion()?> = [
				<?
				$aplicaciones = explode("|", $parametro->getcaValor2() );
				$i=0;
				foreach( $aplicaciones as $aplicacion ){
					if( $i++!=0){
						echo ",";
					}
				?>
					['<?=$aplicacion?>']
				<?
				}
				?>			
			];
		<?
		}
		?>
			
		var ed = this.colModel.getCellEditor(e.column, e.row);		
		
		eval("ed.field.store.loadData( datosValor"+e.record.data.idconcepto+" );");
		
	}
		
}


var guardarParametrosRecargos = function(){
	var success = true;
	var records = storeRecargosLocalesParametros.getModifiedRecords();
			
	var lenght = records.length;
	for( var i=0; i< lenght; i++){
		r = records[i];
					
		var changes = r.getChanges();
				
		changes['id']=r.id;										
 	    changes['concepto']=r.data.concepto;	
		changes['valor']=r.data.valor;	
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeRecargosParametros?modalidad=".$modalidad."&transporte=".$transporte."&impoexpo=".$impoexpo."&idlinea=".$idlinea )?>', 						
				//Solamente se envian los cambios 						
				params :	changes,				
				callback :function(options, success, response){											
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.id && res.success){				
						var rec = storeRecargosLocalesParametros.getById( res.id );														
						rec.commit();		
					}
				}	
			 }
		); 
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
					if( this.ctxRecord && this.ctxRecord.data.concepto ){											
						var id = this.ctxRecord.id;						
						var concepto = this.ctxRecord.data.concepto;
					
											
						if( concepto!="+" && confirm("Esta seguro?") ){
							
							Ext.Ajax.request( 
							{   
								waitMsg: 'Guardando cambios...',						
								url: '<?=url_for("pricing/eliminarParametroRecargos?idlinea=".$idlinea."&modalidad=".$modalidad."&impoexpo=".$impoexpo."&transporte=".$transporte  )?>',
								//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{	
									concepto: concepto,
									id: id
								},
									
								callback :function(options, success, response){	
										
									var res = Ext.util.JSON.decode( response.responseText );	
									
									if( res.id && res.success){				
										var rec = storeRecargosLocalesParametros.getById( res.id );														
										storeRecargosLocalesParametros.remove(rec);	
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


	
/*
* Crea la grilla 
*/    

<?=isset($object)?"var ".$object."=":""?>  new Ext.grid.<?=($nivel>=1)?"Editor":""?>GridPanel({
	store: storeRecargosLocalesParametros,
	//master_column_id : 'nconcepto',
	cm: colModelRecargosLocalesParametros,
	sm: selModelRecargosLocalesParametros,	
	clicksToEdit: 1,
	stripeRows: true,
	//autoExpandColumn: 'nconcepto',
	title: 'Parametros',
	height: 500,
	width: '100',

    <?
    if( $nivel==0 ){
    ?>
        plugins: [expander],    
    <?
    }
    ?>
	closable: false,	
	region: 'west',
	<?
	if( $nivel>0 ){
	?>
	tbar: [			  
		{
			text: 'Guardar Cambios',
			tooltip: 'Guarda los cambios realizados en el tarifario',
			iconCls:'disk',  // reference to our css
			handler: guardarParametrosRecargos
		}
	],
	<?
	}
	?>	
	view: new Ext.grid.GridView({
		 forceFit :true
		
	})
	,		
	listeners:{
		rowcontextmenu: gridOnRowcontextmenu,				
		validateedit: gridOnvalidateedit,
		beforeedit:gridOnBeforeedit
	}	

});