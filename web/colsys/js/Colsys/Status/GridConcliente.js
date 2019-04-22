Ext.define('Colsys.Status.GridConcliente', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Status.GridConcliente',
    autoHeight: true,
    autoScroll: true,
    //frame: true,
    //resizable: true,
    //height:440,
    features: [{
            id: 'tipo',
            ftype: 'groupingsummary',
            hideGroupedHeader: true,
            startCollapsed: false,
            totalSummary: 'fixed', // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true, // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],
    selModel: {
        type: 'cellmodel'
    },
    //bodyCls: 'grid-small',
    plugins: {
        cellediting: {
            clicksToEdit: 1
        }
    },
    listeners: {
        afterrender: function (ct, position) {
            //this.columns = this.getColumns();
            var idmaster = this.idhouse;
            //var permisos = this.permisos;            
            var me = this;
            //if(this.permisos === true){
            tbar = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    id: 'bar-eve-' + idmaster,
                    items: [{
                            text: 'Nuevo Contacto',
                            iconCls: 'add',
                            handler: function () {
                                var view = me.getView(),
                                        rec = new modelConcliente({
                                            email: '',
                                            cargo: '',
                                            tipo: 'Otros Contactos',
                                            sel: true
                                        });

                                view.store.insert(0, rec);
                                view.findPlugin('cellediting').startEdit(rec, 0);
                            }
                        },
                        {
                            text: 'Recargar',
                            iconCls: 'refresh',
                            handler: function () {
                                this.up("grid").getStore().reload();
                            }
                        }/*,
                         {
                         xtype: 'exporterbutton',
                         text: 'XLS',
                         iconCls: 'csv',
                         format:'excel'
                         }*/]
                }];

            this.addDocked(tbar);
            //}
        }, /*
         beforeitemcontextmenu: function(view, record, item, index, e){
         e.stopEvent();
         var idmaster = this.idhouse;
         var permisos = this.permisos;
         
         if (permisos === true){
         var record = this.store.getAt(index);                        
         var menu = new Ext.menu.Menu({
         items: [
         {
         text: 'Editar',
         iconCls: 'application_form',
         handler: function() {
         Ext.getCmp("grid-eve"+idmaster).ventanaEvento(record);
         }
         }
         ]
         }).showAt(e.getXY());
         }
         },*/
        beforerender: function (ct, position) {

            Ext.define('modelConcliente', {
                extend: 'Ext.data.Model',
                id: 'modelConcliente',
                fields: [
                    {name: 'email' + this.idhouse, type: 'string', mapping: 'email', matcher: /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/, message: "Wrong Email Format"},
                    {name: 'cargo' + this.idhouse, type: 'string', mapping: 'cargo'},
                    {name: 'tipo' + this.idhouse, type: 'string', mapping: 'tipo'},
                    {name: 'sel' + this.idhouse, type: 'boolean', mapping: 'sel'}
                ]
            });
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        model: modelConcliente,
                        id: 'store-grid-concliente',
                        proxy: {
                            type: 'ajax',
                            url: '/status/datosConcliente',
                            extraParams: {
                                idcliente: this.idcliente,
                                idreporte: this.idreporte
                            },
                            reader: {
                                type: 'json',
                                rootProperty: 'root',
                                totalProperty: 'total'
                            }
                        },
                        groupField: 'tipo',
                        sorters: [{
                                property: 'email',
                                direction: 'ASC'
                            }],
                        autoLoad: false
                    }),
                    [
                        {
                            header: 'Tipo',
                            dataIndex: 'tipo' + this.idhouse,
                            hidden: true
                        },
                        {xtype: 'rownumberer'},
                        {
                            xtype: 'checkcolumn',
                            header: 'Sel',
                            dataIndex: 'sel' + this.idhouse,
                            //headerCheckbox: true,
                            //flex: 1,
                            width: 50,
                            stopSelection: false
                        },
                        {
                            header: 'Email',
                            dataIndex: 'email' + this.idhouse,
                            flex: 1,
                            editor: {
                                xtype: "textfield",
                                regex: /^([\w\-\’\-]+)(\.[\w-\’\-]+)*@([\w\-]+\.){1,5}([A-Za-z]){2,4}$/
                            }
                        },
                        {
                            header: 'Cargo',
                            dataIndex: 'cargo' + this.idhouse,
                            flex: 1
                        }
                    ]
                    );
        },
        onRender: function (ct, position) {
            Colsys.Status.GridConcliente.superclass.onRender.call(this, ct, position);
        }
    }
});