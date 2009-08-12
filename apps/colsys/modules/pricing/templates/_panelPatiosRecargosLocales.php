<?

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
var recordRecargosPatios = Ext.data.Record.create([   		
	{name: 'sel', type: 'bool'},
	{name: 'id', type: 'int'},
	{name: 'idpatio', type: 'string'},	
	{name: 'nombre', type: 'string'},	
	{name: 'direccion', type: 'string'},	
	{name: 'ciudad', type: 'string'},
	{name: 'observaciones', type: 'string'}	
]);
   		
/*
* Crea el store
*/
<?
$url = "pricing/recargosLocalesPatiosData?modalidad=".$modalidad."&transporte=".$transporte."&impoexpo=".$impoexpo."&idlinea=".$idlinea;

	
?>
var storeRecargosPatios = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',
	reader: new Ext.data.JsonReader(
		{			
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordRecargosPatios
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
var colModelRecargosPatios = new Ext.grid.ColumnModel({		
	columns: [		
		<?
		if( $nivel>0 ){
		?>
		checkColumn			
		, 	
		<?
		}
        if( $nivel==0 ){
        ?>
        expander,
        <?
        }
        ?>

		{
			header: "Patio",
			width: 80,
			sortable: false,	
			hideable: false,		
			dataIndex: 'nombre' 			
		}
		,
		
		{
			header: "Dirección",
			width: 150,
			sortable: false,	
			hideable: false,		
			dataIndex: 'direccion' 			
		}
		,
		{
			header: "Ciudad",
			width: 50,
			sortable: false,	
			hideable: false,		
			dataIndex: 'ciudad' 			
		}
        <?
        if( $nivel>0 ){
        ?>
		,		
		{
			header: "Observaciones",
			width: 200,
			sortable: false,	
			hideable: false,		
			dataIndex: 'observaciones',
			editor: new Ext.form.TextField({						
	                    allowBlank:true
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
var selModelRecargosPatios = new  Ext.grid.CellSelectionModel();

/*
* Actualiza los datos de la base de datos usando Ajax.
*/

/*
* Handlers de los eventos y botones de la grilla 
*/


function guardarRecargosPatios(){
	var success = true;
	var records = storeRecargosPatios.getRange();
			
	var lenght = records.length;
	
	
	var patios="";
	
	for( var i=0; i< lenght; i++){
		r = records[i];	 				
		if( r.data.sel ){
			if(patios!=""){
				patios+="|";
			}
			patios+=r.data.idpatio+","+r.data.observaciones;
		} 
	}
	
	Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando cambios...',						
				url: '<?=url_for("pricing/observeRecargosLocalesPatios?idlinea=".$idlinea."&modalidad=".$modalidad."&impoexpo=".$impoexpo."&transporte=".$transporte)?>', 						
				//Solamente se envian los cambios 						
				params :	{patios:patios},
				
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );	
					if( res.success){				
						storeRecargosPatios.commitChanges();
			
						
					}
				}	
										
				
			 }
		);
	
	
	
}


var seleccionarTodoRecargosPatios = function(){	
	storeRecargosPatios.each( function(r){
			r.set("sel", true);
		} 
	);
}


	
/*
* Crea la grilla 
*/    

<?=isset($object)?"var ".$object."=":""?> new Ext.grid.<?=$nivel>0?"Editor":""?>GridPanel({
	 region: 'center',
	store: storeRecargosPatios,
	//master_column_id : 'nconcepto',
	cm: colModelRecargosPatios,
	sm: selModelRecargosPatios,	
	clicksToEdit: 1,
	stripeRows: true,
	//autoExpandColumn: 'nconcepto',
	title: 'Patios',
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
	closable: false,	
	<?
	if( $nivel>0 ){
	?>
	tbar: [			  
		{
			text: 'Guardar Cambios',
			tooltip: 'Guarda los cambios realizados en el tarifario',
			iconCls:'disk',  // reference to our css
			handler: guardarRecargosPatios
		},	
		{
			text: 'Seleccionar todo',
			tooltip: 'Selecciona todos los patios',
			iconCls:'tick',  // reference to our css
			handler: seleccionarTodoRecargosPatios
		}
	],
	<?
	}
	?>	
	view: new Ext.grid.GridView({
		 forceFit :true
		
	})

});