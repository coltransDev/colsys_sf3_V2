<?

$recargos  = $trafico->getTipoRecargos($transporte);

?>
<script
	language="javascript" src="/colsys_sf/js/treegrid/NumberFieldMin.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/CheckColumn.js"></script>
<script type="text/javascript">
<!--

Ext.onReady(function(){

    Ext.QuickTips.init();

    var xg = Ext.grid;

    var reader = new Ext.data.JsonReader({
        idProperty:'taskId',
        fields: [
            {name: 'idciudad', type: 'int'},
            {name: 'ciudad', type: 'string'},
            {name: 'ckeck', type: 'int'},            
            {name: 'sel', type: 'bool'}
             <?
            foreach( $recargos as $recargo ){
            ?>
            ,{name: 'recargo_<?=$recargo->getCaIdRecargo()?>', type: 'float'}
            <?
            }
            ?>   
            
             
        ]

    });

    // define a custom summary function
    /*Ext.grid.GroupSummary.Calculations['totalCost'] = function(v, record, field){
        return v + (record.data.estimate * record.data.rate);
    }
	*/
    //var summary = new Ext.grid.GroupSummary(); 
	
	var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30}); 
	
	var colModel = new Ext.grid.ColumnModel({
		columns: [
            checkColumn,	
            {
                id: 'ciudad',
                header: "Ciudad",
                width: 160,
                sortable: true,
                dataIndex: 'ciudad',                
                hideable: false    
            }
            <?
            foreach( $recargos as $recargo ){
            ?>
            ,{
                header: "<?=$recargo->getCaRecargo()?>",
                width: 80,
                sortable: true,
                dataIndex: 'recargo_<?=$recargo->getCaIdRecargo()?>',
                renderer: rendererMin,
                editor: new Ext.form.NumberFieldMin({
                    allowBlank: false ,
					allowNegative: false,
					style: 'text-align:left'                                      
                })
            }
            <?
            }
            ?>
        ]
	
	});
	
	
	var store = new Ext.data.GroupingStore({
            reader: reader,
            data: xg.dummyData,
            sortInfo:{field: 'ciudad', direction: "ASC"}
            
        });
	
    var grid = new xg.EditorGridPanel({
        ds: store,
		        
		cm: colModel, 
		plugins: checkColumn,       
        frame:false,
        width: 800,
        height: 450,
        clicksToEdit: 1,        
        
        trackMouseOver: false,
        //enableColumnMove: false,
        title: 'Recargos por ciudad',
        iconCls: 'icon-grid',
        renderTo: 'recargosFijosgrid'
    });
	
	/**
	* Copia los datos a las columnas seleccionadas 
	**/
	grid.on('afteredit', function(e) {	
		
		if(e.record.data.sel){
			var records = store.getModifiedRecords();				
			var lenght = records.length;				
			var field = e.field;
					
			for( var i=0; i<lenght; i++){
				r = records[i];			
				if(r.data.sel){
									
					r.set(field,e.value);
				}
			}
		}
		
    }); 
});


<?
$ciudades = $trafico->getCiudads();
?>

Ext.grid.dummyData = [
	<?
	$i=0;	
	foreach( $ciudades as $ciudad ){
		echo $i++!=0?",":"";	
	?>
		{idciudad: 100, ciudad: '<?=$ciudad->getCaCiudad()?>'}
    <?
	}
    ?>
];



//-->
</script>