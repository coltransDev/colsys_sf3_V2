<?
$data = $sf_data->getRaw("data");
?>

/*
* Crea el Record
*/
var record = Ext.data.Record.create([
	{name: 'consecutivo', type: 'int'},
    {name: 'idconcepto', type: 'int'},
    {name: 'concepto', type: 'string'},
    {name: 'parametro', type: 'string'},
    {name: 'valor', type: 'string'},
    {name: 'aplicacion', type: 'string'},
    {name: 'valorminimo', type: 'string'},
    {name: 'aplicacionminimo', type: 'string'},
    {name: 'observaciones', type: 'string'},
    {name: 'idcotizacion', type: 'int'},
    {name: 'orden', type: 'string'}
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
* Crea la columna de chequeo
*/
var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false});

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/
var colModel = new Ext.grid.ColumnModel({
	columns: [
        checkColumn,
		{
        header: "Concepto",
        dataIndex: 'concepto',
        hideable: false,
        width: 170,
        renderer: this.formatItem,
        sortable: this.readOnly,
        editor: this.editorRecargos
      },
      {
        header: "Parametro",
        dataIndex: 'parametro',
        hideable: false,
        width: 170,
        renderer: this.formatItem,
        sortable: this.readOnly,
        editor: this.editorParametros
      },
      {
        header: "Valor",
        dataIndex: 'valor',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        editor: new Ext.form.NumberField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })
      },
      {
        header: "Aplicacion",
        dataIndex: 'aplicacion',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        editor: new Ext.form.NumberField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })
      },
      {
        header: "Valor Minimo",
        dataIndex: 'valorminimo',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        editor: new Ext.form.NumberField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })
      },
      {
        header: "Aplicacion Min",
        dataIndex: 'aplicacionminimo',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        editor: new Ext.form.NumberField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })
      }

	]
});






/*
* Handler que se dispara despues de editar una celda
*/
var gridAfterEditHandler = function(e) {

	/**
	* Copia los datos a las columnas seleccionadas
	**/
	if(e.record.data.sel){
		var records = store.getModifiedRecords();
		var lenght = records.length;
		var field = e.field;
        alert(e.value)
		for( var i=0; i< lenght; i++){
			r = records[i];
			if(r.data.sel){
				r.set(field,e.value);
			}
		}
	}
}

var seleccionarTodo = function(){
	store.each( function(r){
			r.set("sel", true);
		}
	);
}


/*
* Crea la grilla
*/

new Ext.grid.GridPanel({
	store: store,
	cm: colModel,
	sm: new  Ext.grid.CellSelectionModel(),
    loadMask: {msg:'Cargando...'},
	clicksToEdit: 1,
	stripeRows: true,
	title: 'Conceptos Aduana',
	height: 400,
	width: 780,
	plugins: [checkColumn], //expander,
	closable: true,
	id: '<?=$idcomponent?>',
	tbar: [
		{
			text: 'Seleccionar todo',
			tooltip: 'Selecciona todas las ciudades',
			iconCls:'tick',  // reference to our css
			handler: seleccionarTodo
		}
	],
	view: new Ext.grid.GridView({
		 forceFit :true

	})
});