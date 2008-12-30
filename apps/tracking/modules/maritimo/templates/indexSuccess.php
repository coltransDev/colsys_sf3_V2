
<script type="text/javascript">
	
Ext.onReady(function(){
	Ext.QuickTips.init();	
	
	/*
	* Crea el expander
	*/
	var expander = new Ext.grid.RowExpander({  	  
		lazyRender : false, 
		width: 15,	
		tpl : new Ext.Template(  	
		  '<p><div id=\'status\'><b>{status}</b></div></p>'
		
		),
		renderer : function(v, p, record){   			
			if( record.data.status!='' ){
				p.cellAttr = 'rowspan="2"';
				return '<div class="x-grid3-row-expander">&#160;</div>';
			}else{
				return '';
			}
			
		} 
	});
	
	/*
	* Crea el Record 
	*/
	var record = Ext.data.Record.create([   			
		{name: 'consecutivo', type: 'string'},
		{name: 'origen', type: 'string'},
		{name: 'destino', type: 'string'},
		{name: 'proveedor', type: 'string'},
		{name: 'orden', type: 'string'},
		{name: 'ETS', type: 'string'},
		{name: 'ETA', type: 'string'},
		{name: 'status', type: 'string'},
		{name: 'actualizado', type: 'string'},
		{name: 'style', type: 'string'}		
	]);
			
	/*
	* Crea el store
	*/
	var store = new Ext.data.Store({
		autoLoad : true,
		reader: new Ext.data.JsonReader(
			{			
				root: 'data',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			record
		),
		proxy: new Ext.data.MemoryProxy( <?=json_encode(array("data"=>$data))?>),
		sortInfo:{field: 'orden', direction: "ASC"}
	});
		
	
	/*
	* Crea las columnas que van en la grilla, nuevas columnas se a�aden dinamicamente
	*/
	var colModel = new Ext.grid.ColumnModel({		
		columns: [	
			expander,	
			{
				header: "Orden",
				width: 90,
				sortable: true,	
				hideable: false,		
				dataIndex: 'orden'
				
			}
			,
			{
				header: "Proveedor",
				width: 90,
				sortable: true,	
				hideable: false,		
				dataIndex: 'proveedor'			
			}
			,			
			{
				header: "Origen",
				width: 60,
				sortable: true,	
				hideable: false,		
				dataIndex: 'origen'	
			}
			,
			{
				header: "Destino",
				width: 60,
				sortable: true,	
				hideable: false,		
				dataIndex: 'destino'
			},									
			{
				header: "ETS",
				width: 45,
				sortable: true,	
				hideable: false,		
				dataIndex: 'ETS'
			},				
			{
				header: "ETA",
				width: 45,
				sortable: true,	
				hideable: false,		
				dataIndex: 'ETA'
			},			
			{
				header: "Actualizado",
				width: 45,
				sortable: true,	
				hideable: false,		
				dataIndex: 'actualizado'
			},		
			{
				header: "Ref.",
				width: 50,
				sortable: true,	
				hideable: true,		
				dataIndex: 'consecutivo'				
			}					
		]	
	});
	
	/*
	* 
	*/
	var abrirBtnHandler=function( btn , e ){
		
		record =  panel.getSelectionModel().getSelected();
		if( typeof(record)!="undefined" ){
			var url = "<?=url_for("reportes/detalleReporte")?>/rep/"+record.data.consecutivo;
			if( btn.id=="bnt_opennewwindow" ){ 
				window.open( url );
			}else{
				document.location.href = url;
			}
		}
	}
	
		
	/*
	* Crea la grilla 
	*/    
	
	var panel = new Ext.grid.GridPanel({
		store: store,	
		cm: colModel,
		sm:  new Ext.grid.RowSelectionModel( {singleSelect:true}), 
		//height:350,
		autoHeight: true,         
		//renderTo: 'panel1',	
		plugins: [expander], 	
		view: new Ext.grid.GridView(
					 {
						 forceFit :true,
						 sortAscText: "Orden Ascendente",
						 sortDescText: "Orden Descendente", 
						 columnsText: "Columnas", 
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
					 } 
		),
		tbar: [			  
		{
			text: 'Abrir',
			tooltip: 'Muestra mas datos del item seleccionado',
			iconCls: 'application_go',  // reference to our css
			id: 'bnt_open',
			handler: abrirBtnHandler
		},
		{
			text: 'Abrir en nueva ventana',
			tooltip: 'Muestra mas datos del item seleccionado en una nueva ventana',
			iconCls: 'application_double',  // reference to our css,
			id: 'bnt_opennewwindow',
			handler: abrirBtnHandler
		}
		,
		{
			text: 'Expandir todos',
			tooltip: 'Expande el ultimo status de cada carga',
			iconCls: 'application_add',  // reference to our css
			handler: function(){
				var count = panel.store.getCount();
				for( var i = 0; i<count; i++ ){
					 expander.expandRow(i);
				}				
			}
		}
		,
		{
			text: 'Contraer todos',
			tooltip: 'Esconde todos los comentarios',
			iconCls: 'application_delete',  // reference to our css
			handler: function(){
				var count = panel.store.getCount();
				for( var i = 0; i<count; i++ ){
					 expander.collapseRow(i);
				}				
			}
		}
		,
		{
			text: 'Excel',
			tooltip: 'Importa los datos a una hoja de excel',
			iconCls: 'page_excel',  // reference to our css
			handler: abrirBtnHandler
		}
		]
	});
	panel.render('grid-panel');

	//panel.render(document.body);
	panel.getSelectionModel().selectFirstRow();
});
//



</script>

<!--<div align="left" style="margin-left:100px;">
	<table width="200" border="1" cellspacing="0" cellpadding="0" class="table1">
		<tr>
			<td ><strong>Leyenda</strong></td>		
		</tr>
		<tr>		
			<td>Sin novedad</td>
		</tr>
		<tr class="green">		
			<td>Nuevo Status</td>
		</tr>
		<tr class="yellow">		
			<td >Pendiente por instrucciones</td>
		</tr>		
		<tr class="blue">		
			<td>Carga embarcada</td>
		</tr>		
		<tr class="orange">		
			<td>Carga entregada</td>
		</tr>
		<tr class="pink">
			<td>Orden Anulada </td>
		</tr>
	</table>
</div>-->
<div align="center">
<h3>Importaciones Mar&iacute;timas</h3>
</div>
<br />
<div id="grid-panel"></div>


