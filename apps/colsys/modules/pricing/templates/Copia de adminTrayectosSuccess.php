<?
use_helper("Ext2");
?>

/*
* Crea el Record 
*/
var record = Ext.data.Record.create([  
	{name: 'sel', type: 'string'}, 		
	{name: 'idtrayecto', type: 'string'},
	{name: 'trayecto', type: 'string'},
	{name: 'origen', type: 'string'},
	{name: 'destino', type: 'string'},					
	{name: 'linea', type: 'string'},		
	{name: 'ttransito', type: 'string'},
	{name: 'frecuencia', type: 'string'}
]);
   	
	/*
	{"success":true,"total":2,"data":[{"idtrayecto":551,"trayecto":"PUERTO MANZANILLO->BUENAVENTURA","origen"

:"Puerto Manzanillo","destino":"Buenaventura","linea":"CONSOLIDADO PROPIO COLTRANS","ttransito":"5 D

\u00edas","frecuencia":"Quincenal"},{"idtrayecto":2932,"trayecto":"PUERTO VERACRUZ->CARTAGENA","origen"

:"Puerto Veracruz","destino":"Cartagena","linea":"CONSOLIDADO PROPIO COLTRANS","ttransito":"6 d\u00edas

 ","frecuencia":"Semanal "}]}
		*/
/*
* Crea el store
*/
<?
$url = "pricing/datosAdminTrayectos?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico;
?>

var store = new Ext.data.GroupingStore({
	autoLoad : true,			
	url: '<?=url_for($url)?>',	
	reader: new Ext.data.JsonReader(
		{
			id: 'idtrayecto',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		record
	),
	sortInfo:{field: 'destino', direction: "ASC"},
	groupField: 'trayecto'		
	
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
		
		checkColumn,			
		{
			id: 'linea', //para aplicar estilos a esta columna
			header: "Linea",
			width: 200,
			sortable: true,			
			dataIndex: 'linea',
			hideable: false
		
			
		},	
		{
			id: 'origen',
			header: "Origen",
			width: 100,
			sortable: true,
			dataIndex: 'origen'			
		},	
		{
			id: 'destino',
			header: "Destino",
			width: 100,
			sortable: true,
			dataIndex: 'destino', 			
			hideable: false            
		},		 
		{
			id: 'ttransito',
			header: "Tiempo de transito",
			width: 80,
			sortable: true,
			groupable: false,								
			dataIndex: 'ttransito'		
		},		
		{
			id: 'frecuencia',
			header: "Frecuencia",
			width: 80,
			sortable: true,
			groupable: false,								
			dataIndex: 'frecuencia'		
		}
		
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
* Crea la grilla 
*/    
new Ext.grid.GridPanel({
	store: store,
	//master_column_id : 'linea',
	cm: colModel,
	sm: selModel,	
	clicksToEdit: 1,
	stripeRows: true,
	//autoExpandColumn: 'linea',
	title: '<?=$titulo?>',
	root_title: '<?=$trafico->getCaNombre()?>',	
	plugins: [checkColumn], 
	closable: true,
	id: '<?=$idcomponent?>',
	height: 400,
	//autoHeight : true, 
	/*tbar: [			  
	{
		text: 'Guardar Cambios',
		tooltip: 'Guarda los cambios realizados en el tarifario',
		iconCls:'disk',  // reference to our css
		handler: updateModel
	}],*/
	
	view: new Ext.grid.GroupingView({
		forceFit:true
		
	}),	

	

});
//store.load();



