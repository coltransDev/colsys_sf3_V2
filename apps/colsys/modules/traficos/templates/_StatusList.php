/*
* Muetra todos los status 
*/


var recordStatusList = Ext.data.Record.create([   	
    {name: 'reporte', type: 'string'},		
	{name: 'status', type: 'string'},
	{name: 'fchstatus', type: 'date', dateFormat:'Y-m-d'},
	{name: 'idemail', type: 'string'},
	{name: 'etapa', type: 'string'},			
	{name: 'ets', type: 'string'},
	{name: 'eta', type: 'string'},	
	{name: 'doctransporte', type: 'string'},
	{name: 'idnave', type: 'string'},
	{name: 'piezas', type: 'string'},
	{name: 'peso', type: 'string'},
	{name: 'volumen', type: 'string'},	
	{name: 'class', type: 'string'}	
]);

StatusList = function(viewer, config) {
    this.viewer = viewer;
    Ext.apply(this, config);

    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("traficos/historialStatus")?>'
        }),
		autoLoad :true,
				
		reader: new Ext.data.JsonReader(
			{				
				root: 'data',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			recordStatusList
		),
		sortInfo:{field: 'fchstatus', direction: "DESC"},
		
    });
    this.store.setDefaultSort('fchstatus', "DESC");

    this.columns = [
	{      
        header: "Etapa",
        dataIndex: 'etapa',
        sortable:true,
        width: 100
        //,renderer: this.formatStatus
     },
	 {      
        header: "Fecha",
        dataIndex: 'fchstatus',
        sortable:true,
        width: 100
        
     }
	
	
	];

    StatusList.superclass.constructor.call(this, {
       
        id: 'status-list',
        loadMask: {msg:'Cargando...'},
		height:200,
        sm: new Ext.grid.RowSelectionModel({
            singleSelect:true
        }),
		view: new Ext.grid.GridView(
			{
				forceFit:true,
				enableRowBody:true,				
				getRowClass : this.applyRowClass
				
			}
		),

    });

   // this.on('rowcontextmenu', this.onContextClick, this);
};

Ext.extend(StatusList, Ext.grid.GridPanel, {
    
    loadGrid : function( param ) {
        this.store.baseParams = {            
			reporte: param
        };
        this.store.load();
    },

    togglePreview : function(show){
        
        this.view.refresh();
    },

    // within this function "this" is actually the GridView
    applyRowClass: function(record, rowIndex, p, ds) {
		
       
		var xf = Ext.util.Format;
		p.body = '<p>' + xf.ellipsis(xf.stripTags(record.data.status), 200) + '</p>';
		return 'x-grid3-row-expanded'+(record.data.class?' row_'+record.data.class:'');
        
       
    },

    formatDate : function(date) {
        if (!date) {
            return '';
        }
        var now = new Date();
        var d = now.clearTime(true);
        var notime = date.clearTime(true).getTime();
        if (notime == d.getTime()) {
            return 'Hoy';
        }
        d = d.add('d', -6);
        if (d.getTime() <= notime) {
            return date.dateFormat('D');
        }
        return date.dateFormat('d/m/y ');
    }
	,

    formatStatus: function(value, p, record) {
        return String.format(
                '<div class="topic"><b>{0}</b><span class="author">{1}</span></div>',
                value, record.data.fchstatus, record.data.etapa
                );
    }
});