Ext.tip.QuickTipManager.init();
Ext.define('Colsys.Status.GridFinDescargue', {
    alias: 'widget.GridFinDescargue',
    extend: 'Ext.grid.Panel',
    autoHeight: true,
    autoScroll: true,    
    features: [{
        id: 'feature-descargue',
        ftype: 'grouping',
        startCollapsed: false,
        hideGroupedHeader: true,
        groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'
    }],
    listeners:{
        render: function (me, position) {
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {            
                    fields: [
                        { name: 'idmaster',         type: 'integer',    mapping: 'ca_idmaster' },
                        { name: 'referencia',       type: 'string',     mapping: 'ca_referencia' },
                        { name: 'impoexpo',         type: 'string',    mapping: 'ca_impoexpo' },
                        { name: 'transporte',       type: 'string',    mapping: 'ca_transporte' },
                        { name: 'origen',           type: 'string',    mapping: 'ca_origen' },
                        { name: 'destino',          type: 'string',     mapping: 'ca_destino' },
                        { name: 'fchllegada',       type: 'date',       mapping: 'ca_fchllegada',    dateFormat:'Y-m-d'},            
                        { name: 'fchlimite',        type: 'date',       mapping: 'ca_fchlimite',    dateFormat:'Y-m-d H:i:s'},
                        { name: 'color',          type: 'string',     mapping: 'ca_color' }
                    ],
                    autoLoad: true,
                    autoDestroy: true,
                    remoteSort: false,
                    groupField: 'destino',
                    proxy: {
                        type: 'ajax',
                        url: '/status/informeFindescargue',
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    }
                }),
                [{

                    text: "Id",
                    dataIndex: 'idmaster',
                    sortable: true, 
                    flex: 1,
                    hidden: true
                },
                {
                    text: "Referencia",
                    dataIndex: 'referencia',sortable: true, flex: 1,
                    sortable: true
                },
                {
                    text: "Origen",
                    dataIndex: 'origen',sortable: true, flex: 1
                },
                {
                    text: "Destino",
                    dataIndex: 'destino',sortable: true, flex: 1        
                },
                {
                    text: "Fch. Llegada",
                    dataIndex: 'fchllegada',sortable: true, flex: 1,
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {                    
                        return Ext.util.Format.date(value, 'Y-m-d');
                    }
                },
                {
                    text: "Fch. Limite",
                    dataIndex: 'fchlimite',sortable: true, flex: 1,
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {                    
                        return Ext.util.Format.date(value, 'Y-m-d');
                    }
                },            
                {
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    flex: 0.25,
                    iconCls: 'link',                    
                    getTip: function(value, metadata, record, row, col, store) {
                        return "Enviar Status Ref.: "+record.data.ca_referencia;
                    },        
                    handler: function (view, rowIndex, colIndex, item, e, record, row) {

                        var tabpanel = Ext.getCmp('tabpanel-conf');
                        var idmaster = record.data.idmaster;
                        var permisosC = view.up().permisos;
                        
                        if (!tabpanel.getChildByElement('tab' + idmaster) && idmaster !== "") {
                            if (record.data.impoexpo === "Importaci\u00F3n" || record.data.impoexpo === "Triangulaci\u00F3n") {
                                if (record.data.transporte === "Mar\u00EDtimo")
                                    var tmppermisos = permisosC.maritimo;
                            } else if (record.data.impoexpo === "OTM-DTA")
                                var tmppermisos = permisosC.otm;

                            tabpanel.add({
                                title: record.data.referencia,
                                id: 'tab' + idmaster,
                                itemId: 'tab' + idmaster,
                                closable: true,
                                autoScroll: true,
                                items: [{
                                    xtype: 'Colsys.Status.PanelPrincipal',
                                    id: 'panel-principal-' + idmaster,
                                    idmaster: idmaster,
                                    idreferencia: record.data.referencia,
                                    permisos: tmppermisos
                                }]
                            }).show();
                        }
                        tabpanel.setActiveTab('tab' + idmaster);

                    }
                }
            ]
            );
        },
        beforerender: function(ct, position){            

            var obj = {
                xtype: 'toolbar',
                dock: 'top',                    
                id: 'bar-grid-in-',                
                items: [{
                    text: 'Recargar',
                    iconCls: 'refresh',
                    //id:'btn-guardarrecarga',
                    handler : function(){
                        this.up("grid").getStore().reload();
                    }
                },{
                    text: 'Contraer',                    
                    id: 'bar-group-',
                    iconCls: 'switch',                    
                    handler : function(t){
                        var me = t;                        
                        t.up('grid').onToggle(me);
                    }
                },
                {
                    xtype: "textfield",
                    fieldLabel: 'Buscar',
                    id: 'indice-in',
                    listeners:{
                        change:function( obj, newValue, oldValue, eOpts ){

                            var store=this.up("grid").getStore();
                            store.clearFilter();
                            if(newValue!=""){
                                store.filterBy(function(record, id){                                    

                                    var str=record.get("referencia");

                                    var txt=new RegExp(newValue,"ig");
                                    if(str.search(txt) == -1)
                                        return false;
                                    else
                                        return true;
                                });
                            }
                        }
                    }
                }]
            }

            this.addDocked(obj);
        }
    },
    onToggle: function(t,eOpts){         
        var tipo = t.text;        
        switch(tipo){
            case "Expandir":                
                t.setText("Contraer");                
                t.up('grid').getView().getFeature('feature-descargue').expandAll();
                break;
            case "Contraer":         
                t.setText("Expandir");
                t.up('grid').getView().getFeature('feature-descargue').collapseAll();
                break;
        }
    },  
    viewConfig: {
        stripeRows: true,
        getRowClass: function (record, rowIndex, rowParams, store) {
            return "row_"+record.data.ca_color;
        }
    }
});