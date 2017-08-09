var win_man = null;
var win_doc = null;
var win_arc = null;
comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};
Ext.define('Colsys.Crm.GridControlMandatos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridControlMandatos',
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
            me.getStore().load({
                params: {
                    id: this.idcliente
                },
                callback: function () {

                }
            });
            bbar = new Ext.PagingToolbar({
                dock: 'bottom',
                displayInfo: true,
                store: me.getStore(),
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            });
            me.addDocked(bbar);
        },
        beforerender: function (ct, position) {
            var me = this;
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        autoLoad: false,
                        fields: [
                            {name: 'idcliente', type: 'string'},
                            {name: 'idciudad', type: 'string'},
                            {name: 'ciudad', type: 'string'},
                            {name: 'idtipo', type: 'string'},
                            {name: 'tipo', type: 'string'},
                            {name: 'clase', type: 'string'},
                            {name: 'fchradicado', type: 'string'},
                            {name: 'fchvencimiento', type: 'string'},
                            {name: 'detalle', type: 'string'},
                            {name: 'idarchivo', type: 'string'},
                            {name: 'nombre', type: 'string'},
                            {name: 'observaciones', type: 'string'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/clientes/datosMandatosyPoderes',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            extraParams: {
                                id: me.idcliente
                            },
                            filterParam: 'query'
                        }
                    }),
                    [
                        {
                            header: 'Ciudad',
                            dataIndex: 'ciudad',
                            width: 85
                        },
                        {
                            header: 'Clase',
                            width: 130,
                            dataIndex: 'clase'
                        },
                        {
                            header: 'Documento',
                            width: 250,
                            dataIndex: 'tipo'
                        },
                        {
                            header: 'Radicado',
                            width: 90,
                            dataIndex: 'fchradicado'
                        },
                        {
                            header: 'Vence Fch.',
                            width: 90,
                            dataIndex: 'fchvencimiento'
                        },
                        {
                            header: 'Observaciones',
                            flex: 1,
                            dataIndex: 'observaciones'
                        },
                        {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 40,
                            items: [{
                                    tooltip: 'Editar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (win_man == null) {
                                            win_man = new Ext.Window({
                                                id: 'winMandatos',
                                                title: 'Definici&oacute;n Mandato o Poder',
                                                width: 800,
                                                height: 380,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.FormMandatos',
                                                        id: 'formMandatos',
                                                        idcliente: me.idcliente,
                                                        idtipo: rec.data.idtipo,
                                                        idciudad: rec.data.idciudad,
                                                        treeAvailable: false
                                                    }],
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        win_man = null;
                                                    }
                                                }
                                            });
                                        }
                                        //win_man.down('form').loadRecord(rec);
                                        //win_man.down('form').treeAvailable(false);
                                        win_man.show();
                                    },
                                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                                        return !me.permisos[10];
                                    },
                                    getClass: function (v, meta, rec) {
                                        if (me.permisos[10]) {
                                            return 'page_white_edit';
                                        }
                                    }
                                }, {
                                    tooltip: 'Eliminar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);

                                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea borrar el registro?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminado...',
                                                    url: '/clientes/eliminarMandatosyPoderes',
                                                    params: {
                                                        id: me.idcliente,
                                                        idtipo: rec.data.idtipo,
                                                        idciudad: rec.data.idciudad
                                                    },
                                                    failure: function (response, options) {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                        success = false;
                                                    },
                                                    success: function (response, options) {
                                                        var res = Ext.JSON.decode(response.responseText);
                                                        if (res.success) {
                                                            var storeAfter = me.getStore();
                                                            storeAfter.reload();
                                                        } else {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    },
                                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                                        return !me.permisos[11];
                                    },
                                    getClass: function (v, meta, rec) {
                                        if (me.permisos[11]) {
                                            return 'delete';
                                        }
                                    }
                                }]
                        }
                    ]


                    );

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Adicionar',
                tooltip: 'Adicionar un registro',
                iconCls: 'add',
                scope: this,
                handler: function () {
                    if (win_man == null) {
                        win_man = new Ext.Window({
                            id: 'winMandatos',
                            title: 'Definici&oacute;n Mandato o Poder',
                            width: 800,
                            height: 380,
                            closeAction: 'destroy',
                            items: [{
                                    xtype: 'Colsys.Crm.FormMandatos',
                                    id: 'formMandatos',
                                    idcliente: me.idcliente,
                                    treeAvailable: true
                                }],
                            listeners: {
                                destroy: function (obj, eOpts)
                                {
                                    win_man = null;
                                },
                                treeAvailable: function () {

                                }
                            }
                        });
                    }
                    win_man.show();
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[9]);
                    }
                }
            }, {
                text: 'Archivo Digital',
                tooltip: 'Mandatos y Poderes',
                iconCls: 'note-add',
                scope: this,
                handler: function () {
                    if (win_arc == null) {
                        win_arc = Ext.create('Ext.window.Window', {
                            id: 'winArchivos',
                            title: 'Subir Archivos',
                            width: 900,
                            height: 500,
                            closeAction: 'destroy',
                            items: {
                                // layout: 'column',
                                defaultType: 'container',
                                items: [{
                                        // columnWidth: 4 / 6,
                                        padding: '5 5 10 5',
                                        items: [
                                            Ext.create('Colsys.GestDocumental.treeGridFiles', {
                                                //xtype: 'Colsys.GestDocumental.treeGridFiles',
                                                id: 'tree-grid-file-mandatos' + me.idcliente,
                                                name: 'tree-grid-file',
                                                title: 'Listado de Archivos',
                                                height: 270,
                                                idsserie: 10,
                                                ref1: me.idcliente,
                                                idcliente: me.idcliente,
                                                treeStore: 'Mandatos',
                                                habilitarToolbar: false
                                            }
                                            )
                                        ]

                                    }, {
                                        // columnWidth: 2 / 6,
                                        padding: '5 5 10 5',
                                        items: {
                                            xtype: 'Colsys.GestDocumental.FormSubirArchivos',
                                            title: 'Nuevo Archivo',
                                            id: 'formSubirArchivos',
                                            width: 380,
                                            height: 160,
                                            idsserie: 10,
                                            idreferencia: me.idcliente,
                                            idcliente: me.idcliente,
                                            treeStore: 'Mandatos'
                                        }
                                    }]
                            },
                            listeners: {
                                afterrender: function (ct, position) {
                                    //Desabilitar toolbar para llamar al form, debido a que ya se encuentra en el grid
                                    /*if (Ext.getCmp('tree-grid-file-mandatos' + me.idcliente)) {
                                     var dateObj = Ext.ComponentQuery.query('[name=toolbarg]');
                                     dateObj[0].getEl().setVisible(false);
                                     }*/
                                },
                                beforeShow: function (win, e) {
                                    tree = Ext.getCmp("tree-grid-file-mandatos" + me.idcliente);
                                    tree.setStore(Ext.create('Ext.data.TreeStore', {
                                        fields: [
                                            {name: 'idarchivo', type: 'string'},
                                            {name: 'nombre', type: 'string'},
                                            {name: 'documento', type: 'string'},
                                            {name: 'iddocumental', type: 'string'},
                                            {name: 'path', type: 'string'},
                                            {name: 'ref1', type: 'string'},
                                            {name: 'ref2', type: 'string'},
                                            {name: 'ref3', type: 'string'},
                                            {name: 'usucreado', type: 'string'},
                                            {name: 'fchcreado', type: 'string'}
                                        ],
                                        proxy: {
                                            type: 'ajax',
                                            url: '/gestDocumental/dataFilesTree',
                                            autoLoad: false,
                                            extraParams: {
                                                ref1: me.idcliente,
                                                idsserie: 10
                                            }
                                        }
                                    }));
                                },
                                destroy: function (obj, eOpts)
                                {
                                    win_arc = null;
                                }
                            }
                        });
                    }
                    win_arc.show();
                }
            }

            );
            this.addDocked(tb);
        }
    }
});
