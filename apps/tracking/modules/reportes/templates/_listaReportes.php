<?
$data = $sf_data->getRaw("data");
?>
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
		  '<div id=\'status\'><b>{status}</b></div>'
		
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
	* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
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
	* 
	*/
	var excelBtnHandler=function( btn , e ){
		var url = "<?=url_for("reportes/informeTraficosFormato1?impoexpo=".$impoexpo."&transporte=".$transporte.($historial?"&historial=".$historial:""))?>";
		document.location.href = url;
	}
	
	var rowdblclickHandler=function( grid , rowIndex, e ){
		record =  panel.store.getAt( rowIndex );
		if( typeof(record)!="undefined" ){
			var url = "<?=url_for("reportes/detalleReporte")?>/rep/"+record.data.consecutivo;
			
			window.open( url );
			
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
		width: 1024,
		autoHeight: true,         
		//renderTo: 'panel1',	
		plugins: [expander], 	
		view: new Ext.grid.GridView(
					 {
						 forceFit :true,
						 sortAscText: "Orden Ascendente",
						 sortDescText: "Orden Descendente", 
						 columnsText: "Columnas"	
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
				handler: excelBtnHandler
			}
            <?
            //if( $idclienteActivo==800182042 ){ // Solo para probar con el cliente BECOR
            ?>
            ,
			{
				text: 'Historial',
				tooltip: 'Lista todas las cargas desde hace un año',
				iconCls: 'clock',  // reference to our css
				handler: function(){
                    document.location="?historial=true";
                }
			}
            <?
            //}
            ?>
		],
		listeners:{
			 rowdblclick : rowdblclickHandler
		}
	});
	panel.render('grid-panel');

	//panel.render(document.body);
	panel.getSelectionModel().selectFirstRow();
	panel.setWidth(Ext.getBody().getViewSize().width-40);


});
//
</script>
<div id="grid-panel" style="margin:0 20px 0 20px"></div>