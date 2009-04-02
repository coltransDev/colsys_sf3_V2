/*
* Panel superior donde se muestra la lista de reportes
*/


var recordStatusGrid = Ext.data.Record.create([   			
	{name: 'reporte', type: 'string'},
	{name: 'origen', type: 'string'},
	{name: 'destino', type: 'string'},			
	{name: 'lastUpdate', type: 'date', dateFormat:'Y-m-d'},	
	{name: 'proveedor', type: 'string'},		
	{name: 'cliente', type: 'string'},
	{name: 'status', type: 'string'},
	{name: 'etapa', type: 'string'},
	{name: 'class', type: 'string'}	
]);

StatusGrid = function(viewer, config) {
    this.viewer = viewer;
    Ext.apply(this, config);

    this.store = new Ext.data.GroupingStore({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("traficos/listaReportes?impoexpo=".$impoexpo."&transporte=".$transporte)?>'
        }),

       reader: new Ext.data.JsonReader(
			{				
				root: 'data',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			recordStatusGrid
		),
		sortInfo:{field: 'reporte', direction: "ASC"},
		groupField: 'proveedor'
		
		
    });
    this.store.setDefaultSort('proveedor', "ASC");

    this.columns = [
	{
       
        header: "Reporte",
        dataIndex: 'reporte',
        sortable:true,
        width: 100
        //,renderer: this.formatTitle
     }
	,
	{
        header: "Origen",
        dataIndex: 'origen',
        width: 100,      
        sortable:true
      },{
       
        header: "Destino",
        dataIndex: 'destino',
        width: 150,
        
        sortable:true
    }	
	,{        
        header: "Proveedor",
        dataIndex: 'proveedor',
        width: 150,
       
        sortable:true
    }
	,{
       
        header: "Etapa",
        dataIndex: 'etapa',
        width: 150,
       
        sortable:true
    }
	,{
        
        header: "Actualizado",
        dataIndex: 'lastUpdate',
        width: 150,
        renderer:  this.formatDate,
        sortable:true
    }
	];

    StatusGrid.superclass.constructor.call(this, {
        region: 'center',
        id: 'status-grid',
        loadMask: {msg:'Cargando...'},

        sm: new Ext.grid.RowSelectionModel({
            singleSelect:true
        }),
		view: new Ext.grid.GroupingView(
			{
				forceFit:true,
				enableRowBody:true,
				showPreview:false,
				getRowClass : this.applyRowClass,
				hideGroupedColumn: true
			}
		),

    });

    this.on('rowcontextmenu', this.onContextClick, this);
};

Ext.extend(StatusGrid, Ext.grid.GridPanel, {

    onContextClick : function(grid, index, e){
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