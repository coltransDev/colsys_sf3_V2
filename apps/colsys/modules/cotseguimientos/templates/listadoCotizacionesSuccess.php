<?

?>

<script language="javascript" >
/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   
	{name: 'id', type: 'int'},                                 	
	{name: 'idcotizacion', type: 'int'},
	{name: 'idproducto', type: 'int'},				
	{name: 'cliente', type: 'string'},	
	{name: 'consecutivo', type: 'string'},
	{name: 'trayecto', type: 'string'},
	{name: 'usuario', type: 'string'},
	{name: 'estado', type: 'string'},	
	{name: 'seguimiento', type: 'string'},
	{name: 'etapa', type: 'string'},
	
]);
   		
/*
* Crea el store
*/
var store = new Ext.data.GroupingStore({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{	
			id: 'id',			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data))?>),
	sortInfo:{field: 'consecutivo', direction: "ASC"},	
	groupField: 'consecutivo'	
});
	

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModel = new Ext.grid.ColumnModel({		
	columns: [				
		{
			header: "Consecutivo",
			width: 30,
			sortable: true,	
			hideable: false,
			hidden: true,		
			dataIndex: 'consecutivo'	
		},
		{
			header: "Cliente",
			width: 90,
			sortable: true,	
			hideable: false,		
			dataIndex: 'cliente'	
		}
		,	
		{
			header: "Trayectos",
			width: 90,
			sortable: true,	
			hideable: false,		
			dataIndex: 'trayecto'	
		}
		,		
		{
			header: "Vendedor",
			width: 30,
			sortable: true,	
			hideable: false,		
			dataIndex: 'usuario'
		}
		,		
		{
			header: "Etapa",
			width: 30,
			sortable: true,	
			hideable: false,
			hidden: true,				
			dataIndex: 'etapa'
		}
		,
		{
			header: "Estado",
			width: 30,
			sortable: true,	
			hideable: false,		
			dataIndex: 'estado',
			editor: new Ext.form.ComboBox({								
						typeAhead: true,
						forceSelection: true,
						triggerAction: 'all',
						emptyText:'Seleccione',
						selectOnFocus: true,																									
						listClass: 'x-combo-list-small',
						mode: 'local',
						valueField:'etapa',
						displayField:'valor',
						store :  new Ext.data.SimpleStore({
								fields: ['etapa', 'valor'],
								data : [
									<?
									$i = 0;								
									foreach( $estados as $estado ){
										if($i++!=0){
											echo ",";
										}
									?>
										['<?=$estado->getCaValor()?>', '<?=$estado->getCaValor2()?>']
									<?
									}
									?>
									]
							})
						
						
						
					})
			
		}
		,
		{
			header: "Seguimiento",
			width: 30,
			sortable: true,	
			hideable: false,		
			dataIndex: 'seguimiento',			
			editor: new Ext.form.TextField()			
		}
		
				
	]
	
});



/*
* Guarda los cambios en la base de datos
*/

function guardarCambios(){	
	var records = store.getModifiedRecords();
	var lenght = records.length;
	
	//Validacion
	for( var i=0; i< lenght; i++){
		r = records[i];			
		if(r.data.estado=="No Aprobada" && r.data.seguimiento==""){
			alert("Por favor indique el motivo por el cual la cotización no fue aprobada en todos los casos");
			return false;
		}
		
	}
	
	for( var i=0; i< lenght; i++){
		r = records[i];					
		var changes = r.getChanges();
		
		changes['idcotizacion']=r.data.idcotizacion;
		changes['idproducto']=r.data.idproducto;
		changes['etapa']=r.data.etapa;	
		changes['seguimiento']=r.data.seguimiento;								
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("cotseguimientos/observeListadocotizaciones")?>', 						//method: 'POST', 
				//Solamente se envian los cambios 						
				params :	changes,
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.idcotizacion && res.idproducto && res.success ){				
						var rec = store.getById( res.idcotizacion+"-"+res.idproducto );																										
						rec.commit();						
					}
				}			
			 }
		); 
		
	}
	
}


var gridValidateEdit = function( e ){	
	var rec = e.record;		   
	var ed = this.colModel.getCellEditor(e.column, e.row);		
	var store = ed.field.store;
	if( e.field == "estado"){
		store.each( function( r ){	    		
				if( r.data.etapa==e.value ){									
					rec.set("etapa", r.data.etapa );
					e.value = r.data.valor;								
					return true;
				}
			}
		);	
	}else{
		return true;
	}	
	
}
	
/*
* Crea la grilla 
*/    

var panel = new Ext.grid.EditorGridPanel({
	store: store,	
	cm: colModel,
	sm: new  Ext.grid.CellSelectionModel(),	
	clicksToEdit: 1,
	stripeRows: true,	
	title: 'Cotizaciones en seguimiento',
	height: 400,	
	closable: true,	
	//renderTo: 'panelRutinas',
	tbar: [			
		{
			text: 'Guardar',
			tooltip: 'Guarda los cambios',
			iconCls:'disk',  // reference to our css
			handler: guardarCambios
		}
	],		
	view: new Ext.grid.GroupingView({
		 forceFit :true,
		 enableGroupingMenu: false,
		 getRowClass: function(  record,  index,  rowParams,  store ){			
			
			switch( record.data.estado ){
				case "Negocio asignado":					
					return "row_yellow";
					break;
				case "No aprobada":								
					return "row_pink";
					break;
				default:
					return "";
					break;
			}
		} 
		
	}),
	listeners:{
		validateedit: gridValidateEdit
		
	}
});

panel.render(document.body);
panel.setWidth(Ext.getBody().getViewSize().width-10);

</script>