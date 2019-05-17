Ext.define('Colsys.Riesgos.GridCriticos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridCriticos',   
    autoHeight: true,
    autoScroll: true,
    frame: true,    
    requires: [
        'Ext.grid.plugin.Exporter',
        'Ext.view.grid.ExporterController'
    ],
    plugins:{
        gridexporter: true
    },
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            return record.get('color');                            
        },
    },
    listeners:{
        render: function (me, eOpts){
            
            var headers = JSON.parse(me.headers);
            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: me.criterios,
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosCargosCriticos',            
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total'
                        }
                    },                   
                    autoLoad: true
                }),                                
                [
                    {                        
                        dataIndex: 'idcargo',
                        hidden: true
                    }, {
                        text: 'Cargo',
                        dataIndex: 'cargoiso',
                        flex: 2
                    }, {
                        header: 'Impacto',
                        dataIndex: 'impacto',
                        flex: 1,
                        align: 'right'                        
                    },
                    {
                        header: 'Todos los colaboradores',
                        dataIndex: 'todos',
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: 'Ponderaci\u00F3n Final',
                        dataIndex: 'pondfinal',
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: headers[1],
                        dataIndex: headers[1],
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: headers[2],
                        dataIndex: headers[2],
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: headers[3],
                        dataIndex: headers[3],
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: headers[4],
                        dataIndex: headers[4],
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: headers[5],
                        dataIndex: headers[5],                        
                        align: 'right'
                    },
                    {
                        header: headers[6],
                        dataIndex: headers[6],
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: headers[7],
                        dataIndex: headers[7],
                        flex: 1,                        
                        align: 'right'
                    },
                    {
                        header: "Total",
                        dataIndex: "total",
                        align: 'right'
                    }
                ]
            );
    
            var obj = {
                xtype: 'toolbar',
                dock: 'top',                    
                id: 'barcriticos-'+this.idgrid,                
                items: [
                {
                    text: 'Recargar',
                    iconCls: 'refresh',                    
                    handler : function(){
                        this.up("grid").getStore().reload();
                    }
                },{
                    text:   'Excel',
                    iconCls: 'csv',
                    cfg: {
                        type: 'excel07',
                        ext: 'xlsx'
                    },
                    handler: function(){
                        var cfg = Ext.merge({
                            title: 'Listado de Cargos Críticos',
                            fileName: 'Cargos Criticos' + '.' + (this.cfg.ext || this.cfg.type)
                        }, this.cfg);
                        
                        this.up("grid").saveDocumentAs(cfg);
                    }
                }]
            }
            
            this.addDocked(obj);
        }        
    }    
});