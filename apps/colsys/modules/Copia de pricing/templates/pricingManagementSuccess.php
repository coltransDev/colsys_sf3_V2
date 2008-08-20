<link rel="stylesheet" type="text/css" href="/colsys_sf/css/treegrid/css/TreeGrid.css" />  
 <link rel="stylesheet" type="text/css" href="/colsys_sf/css/treegrid/css/TreeGridLevels.css" /> 
<script language="javascript" src="/colsys_sf/js/treegrid/TreeGrid.js"></script>
<script language="javascript" src="/colsys_sf/js/treegrid/RowExpander.js"></script>
<script language="javascript" src="/colsys_sf/js/treegrid/NumberFieldMin.js"></script>
<script language="javascript" src="/colsys_sf/js/treegrid/GroupingViewTree.js"></script>

<script language="javascript">


var data = <?=json_encode($data)?>;

var monedas = [
		<?
		$i=0;
		foreach( $monedas as $moneda ){
		if($i++!=0){
			echo ",";
		}
			?>
			['<?=$moneda->getcaIdMoneda()?>','<?=$moneda->getcaIdMoneda()?>']
			<?
		}
		?>  
       
    ];


Controller = function()
{
	
	
	function createGrid()
	{
    // create the data store
    var record = Ext.data.Record.create([
   		{name: 'linea'},
     	{name: 'idtrayecto', type: 'int'},
		{name: 'origen', type: 'string'},
		{name: 'destino', type: 'string'},
		{name: 'linea', type: 'string'},			
		{name: 'inicio', type: 'date', dateFormat:'m/d/Y'},
		{name: 'vencimiento', type: 'date', dateFormat:'m/d/Y'},		
		{name: 'moneda', type: 'string'},	
     	{name: '_id', type: 'int'},
     	{name: '_parent', type: 'auto'},
     	{name: '_is_leaf', type: 'bool'}	
		<?
		foreach( $conceptos as $concepto ){			
		?>
		,{name: 'concepto_<?=$concepto->getCaIdconcepto()?>', type: 'string'}			
		<?			
		}
		?>
		
   	]);
   
	var store = new Ext.ux.maximgb.treegrid.AdjacencyListStore({
    	autoLoad : true,
			reader: new Ext.data.JsonReader({id: '_id'}, record),
			proxy: new Ext.data.MemoryProxy(data)
    });
	
    // create the Grid
    var grid = new Ext.ux.maximgb.treegrid.GridPanel({
      store: store,
      master_column_id : 'linea',
      columns: [				
			{				
                id: 'linea',
                header: "Línea",
                width: 200,
                sortable: true,
                dataIndex: 'linea',
                summaryType: 'count',				
                hideable: false				
            },
			{
                header: "Origen",
                width: 120,
                sortable: true,
                dataIndex: 'origen'
            },			
            {
                id: 'destino',
                header: "Destino",
                width: 120,
                sortable: true,
                dataIndex: 'destino',               
                hideable: false               
            },			 
			{
                header: "Inicio",
                width: 80,
                sortable: true,
                dataIndex: 'inicio',               
                renderer: Ext.util.Format.dateRenderer('m/d/Y'),
                editor: new Ext.form.DateField({
                    format: 'm/d/Y'
                })
            },{
                header: "Venc.",
                width: 80,
                sortable: true,
                dataIndex: 'vencimiento',               
                renderer: Ext.util.Format.dateRenderer('m/d/Y'),
                editor: new Ext.form.DateField({
                    format: 'm/d/Y'
                })
            },{
                header: "Moneda",
                width: 80,
                sortable: false,
                dataIndex: 'moneda',              
                editor: new Ext.form.ComboBox({
					typeAhead: true,
					triggerAction: 'all',
					//transform:'light',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store : monedas	
				})
            }
			<?
			foreach( $conceptos as $concepto ){			
			?>
			,{
                id: 'concepto_<?=$concepto->getCaIdconcepto()?>',
                header: "<?=$concepto->getCaConcepto()?>",
                width: 80,
                sortable: true,
                groupable: false,			
				//renderer: rendererMin,							
                dataIndex: 'concepto_<?=$concepto->getCaIdconcepto()?>',               
                editor: new Ext.form.NumberFieldMin({
                    allowBlank: false ,
					allowNegative: false,
					style: 'text-align:left'                                      
                })
            }
			<?
			}
			?>
		
      ],
	  clicksToEdit: 1,
      stripeRows: true,
      autoExpandColumn: 'linea',
      title: 'Administrador del tarifario.',
      root_title: 'Companies',
	  view: new Ext.grid.GroupingViewTree({
            forceFit:false,
            showGroupName: false,
            enableNoGroups:true, // REQUIRED!
            hideGroupedColumn: true,			
			startCollapsed : false,
			sortAscText: "Orden Ascendente",
			sortDescText: "Orden Descendente",
			groupByText : "Agrupar por esta columna",
			columnsText : "Columnas",
			scrollOffset: 100
        }),	  
	  tbar: [
			  {
				text: 'Guardar Cambios',
				tooltip: 'Guarda los cambios realizados en el tarifario',
				iconCls:'add',                      // reference to our css
				handler: updateModel
			  } 
			  ]
    });
    var vp = new Ext.Viewport({
    	layout : 'fit',
    	items : grid
    });
 	//grid.getSelectionModel().selectFirstRow();
	}
	
	
  
  /*
	* Function for updating database
	*/
	function updateModel(){
		var success = true;
		
		store.each(function(r){			
			if( r.dirty ){
				var changes =  r.getChanges();
				
				if(changes['inicio']){
					changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');									
				}	
				
				if(changes['vencimiento']){
					changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');									
				}				
				
				//submit to server
				Ext.Ajax.request( 
					{   //Specify options (note success/failure below that
						//receives these same options)
						waitMsg: 'Saving changes...',
						//url where to send request (url to server side script)
						url: '<?=url_for("pricing/observePricingManagement")?>/id/'+r.data.idtrayecto, 
						
						//If specify params default is 'POST' instead of 'GET'
						//method: 'POST', 
						
						//params will be available server side via $_POST or $_REQUEST:
						params :	changes,
												
						//the function to be called upon failure of the request
						//(404 error etc, ***NOT*** success=false)
						failure:function(response,options){
							success = false;
						},//end failure block      
						
						//The function to be called upon success of the request                                
						success:function(response,options){							
							//alert( response.responseText );						
							//commit changes (removes the red triangle which
							//indicates a 'dirty' field)
							r.commit();										
							
						}//end success block                                      
					 }//end request config
				); //end request 
			} // End dirty	
			
			if( success ){
				Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
			}else{
				Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
			}
		 });
	}
  
  

	return {
		init : function()
		{
			createGrid();
		}
	}
}();




Ext.onReady(Controller.init);
</script>