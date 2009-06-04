/*
* Muetra todos los status 
*/


var recordStatusList = Ext.data.Record.create([   			
	{name: 'status', type: 'string'},
	{name: 'fecha', type: 'date', dateFormat:'Y-m-d'},
	{name: 'usuario', type: 'string'},
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
            url: '<?=url_for("traficos/detalleReportes")?>'
        }),
		autoLoad :false,
				
		reader: new Ext.data.JsonReader(
			{				
				root: 'data',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			recordStatusList
		),
		sortInfo:{field: 'fecha', direction: "DESC"},
		
    });
    this.store.setDefaultSort('fecha', "DESC");

    this.columns = [
	{      
        header: "Status",
        dataIndex: 'status',
        sortable:true,
        width: 100
        //,renderer: this.formatTitle
     }
	,
	{
        header: "Fecha",
        dataIndex: 'fecha',
        width: 100,      
        sortable:true
      },{
       
        header: "Etapa",
        dataIndex: 'etapa',
        width: 150,
        
        sortable:true
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
				showPreview:false,
				getRowClass : this.applyRowClass
				
			}
		),

    });

   // this.on('rowcontextmenu', this.onContextClick, this);
};

Ext.extend(StatusList, Ext.grid.GridPanel, {

    /*onContextClick : function(grid, index, e){
        if(!this.menu){ // create context menu on first right click
            this.menu = new Ext.menu.Menu({
                id:'grid-ctx',
                items: [{
                    text: 'Ver en nuevo tab',
                    iconCls: 'new-tab',
                    scope:this,
                    handler: function(){
                        this.viewer.openTab(this.ctxRecord);
                    }
                },{
                    iconCls: 'new-win',
                    text: 'Go to Post',
                    scope:this,
                    handler: function(){
                        window.open(this.ctxRecord.data.link);
                    }
                },'-',{
                    iconCls: 'refresh-icon',
                    text:'Recargar',
                    scope:this,
                    handler: function(){
                        this.ctxRow = null;
                        this.store.reload();
                    }
                }]
            });
            this.menu.on('hide', this.onContextHide, this);
        }
        e.stopEvent();
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
        this.ctxRow = this.view.getRow(index);
        this.ctxRecord = this.store.getAt(index);
        Ext.fly(this.ctxRow).addClass('x-node-ctx');
        this.menu.showAt(e.getXY());
    },
	
    onContextHide : function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },
	*/
    loadGrid : function(query, param) {
        this.store.baseParams = {
            query: query,
			param: param
        };
        this.store.load();
    },

    togglePreview : function(show){
        this.view.showPreview = show;
        this.view.refresh();
    },

    // within this function "this" is actually the GridView
    applyRowClass: function(record, rowIndex, p, ds) {
		
        if (this.showPreview) {
            var xf = Ext.util.Format;
            p.body = '<p>' + xf.ellipsis(xf.stripTags(record.data.status), 200) + '</p>';
            return 'x-grid3-row-expanded'+(record.data.class?' row_'+record.data.class:'');
        }
        return 'x-grid3-row-collapsed'+(record.data.class?' row_'+record.data.class:'');
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

    formatTitle: function(value, p, record) {
        /*return String.format(
                '<div class="topic"><b>{0}</b><span class="author">{1}</span></div>',
                value, record.data.origen+" "+record.data.destino, record.consecutivo, record.data.proveedor
                );*/
    }
});