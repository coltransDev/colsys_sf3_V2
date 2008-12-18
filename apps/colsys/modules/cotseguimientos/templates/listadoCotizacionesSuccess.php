<?

?>

<script language="javascript" >
/*
* Crea el Record 
*/
var record = Ext.data.Record.create([   
	{name: 'idcotizacion', type: 'int'},				
	{name: 'cliente', type: 'string'},	
	{name: 'consecutivo', type: 'string'},
	{name: 'usuario', type: 'string'},
	{name: 'estado', type: 'string'},
	{name: 'motivonoaprobado', type: 'string'}
	
]);
   		
/*
* Crea el store
*/
var store = new Ext.data.Store({
	autoLoad : true,
	reader: new Ext.data.JsonReader(
		{			
			id: 'idcotizacion',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data))?>),
	sortInfo:{field: 'consecutivo', direction: "ASC"}
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
			header: "Vendedor",
			width: 30,
			sortable: true,	
			hideable: false,		
			dataIndex: 'usuario'
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
						valueField:'valor',
						displayField:'valor',
						store :  new Ext.data.SimpleStore({
								fields: ['valor', 'valor'],
								data : [
									<?
									$i = 0;								
									foreach( $estados as $estado ){
										if($i++!=0){
											echo ",";
										}
									?>
										['<?=$estado->getCaValor()?>', '<?=$estado->getCaValor()?>']
									<?
									}
									?>
									]
							})
						
						
						
					})
			
		}
		,
		{
			header: "Motivo no aprobado",
			width: 30,
			sortable: true,	
			hideable: false,		
			dataIndex: 'motivonoaprobado',
			editor: new Ext.form.ComboBox({								
						typeAhead: true,
						forceSelection: true,
						triggerAction: 'all',
						emptyText:'Seleccione',
						selectOnFocus: true,																									
						listClass: 'x-combo-list-small',
						mode: 'local',
						valueField:'valor',
						displayField:'valor',
						store :  new Ext.data.SimpleStore({
								fields: ['valor', 'valor'],
								data : [
									<?
									$i = 0;								
									foreach( $motivos as $motivo ){
										if($i++!=0){
											echo ",";
										}
									?>
										['<?=$motivo->getCaValor()?>', '<?=$motivo->getCaValor()?>']
									<?
									}
									?>
									]
							})
						
						
						
					})
		}
		
				
	],	
	isCellEditable: function(colIndex, rowIndex) {	
		var record = store.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
		
		if( field=="motivonoaprobado" && record.data.estado!="No aprobada" ){
			return false;
		}
		
		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);		
	}
	
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
		if(r.data.estado=="No aprobada" && r.data.motivonoaprobado==""){
			alert("Por favor indique el motivo por el cual la cotización no fue aprobada en todos los casos");
			return false;
		}
		
	}
	
	for( var i=0; i< lenght; i++){
		r = records[i];					
		var changes = r.getChanges();
		
		changes['idcotizacion']=r.data.idcotizacion;
			
												
		//envia los datos al servidor 
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("cotseguimientos/observeListadocotizaciones")?>', 						//method: 'POST', 
				//Solamente se envian los cambios 						
				params :	changes,
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.idcotizacion && res.success ){				
						var rec = store.getById( res.idcotizacion );																										
						rec.commit();						
					}
				}			
			 }
		); 
		
	}
	
}


var gridAfterEdit = function( e ){
	if( e.field=="estado" && e.record.data.estado!="No aprobado" ){
		e.record.set("motivonoaprobado", "");
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
	view: new Ext.grid.GridView({
		 forceFit :true,
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
		 afteredit : gridAfterEdit
	}
});

panel.render(document.body);
</script>