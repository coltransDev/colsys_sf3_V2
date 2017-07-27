var win_encuesta = null;
var win_arc = null;
var id_ag = 0;
comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};
Ext.define('Colsys.Crm.GridAgenteAduana', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridAgenteAduana',
    /*plugins: [Ext.create('Ext.grid.plugin.CellEditing', {
     clicksToEdit: 2,
     listeners: {
     'validateedit': function (editor, e) {
     if (e.field == "nombre_agente") {
     if (e.column.getEditor().displayTplData) {
     var id_agente = e.column.getEditor().displayTplData.id;
     e.record.data["id_agente"] = id_agente;
     }
     }
     }
     }
     })],*/
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
            store = me.getStore();
            Ext.getCmp('id_agente' + me.idcliente).getStore().load({
                callback: function (records, operation, success) {
                    me.getStore().load({
                        params: {
                            idcliente: me.idcliente,
                        }
                    });

                    /*res = Ext.JSON.decode(operation._response.responseText);
                     res = (res.root);
                     for(var i = 0; i < res.length; i++){
                     console.log(res[i].id_agente);
                     Ext.getCmp('id_agente' + me.idcliente).getStore().add(
                     {"id" : res[i].id_agente},
                     {"nombre": "aaaaaaaaa"}
                     );
                     }
                     for (var i= 0; i< store.getCount(); i++){
                     record = store.getAt(i);
                     record.set('id_agente',res[i].nombre_agente);
                     }*/
                    //Ext.getCmp('id_agente' + me.idcliente).load();

                }
            });
            bbar = new Ext.PagingToolbar({
                dock: 'bottom',
                displayInfo: true,
                store: me.getStore(),
                idcliente: me.idcliente,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            });
            me.addDocked(bbar);

        },
        beforerender: function (ct, position) {
            var me = this;
            this.reconfigure(
                    /*store = Ext.create('Ext.data.Store', {
                     autoLoad: true,
                     fields: [
                     {name: 'idcliente', type: 'string'},
                     {name: 'id_agente', type: 'string'},
                     {name: 'nombre_agente', type: 'string'},
                     {name: 'fecha_vigencia', type: 'date'},
                     {name: 'fecha_autorizacion', type: 'date'},
                     {name: 'iddocumento', type: 'string'}
                     ],
                     proxy: {
                     type: 'ajax',
                     url: '/clientes/datosAgaduanaAutorizado',
                     reader: {
                     type: 'json',
                     root: 'root'
                     },
                     extraParams: {
                     idcliente: this.idcliente
                     },
                     filterParam: 'query'
                     }
                     }),*/
                            [
                                {
                                    header: 'Nombre Agente',
                                    dataIndex: 'id_agente',
                                    flex: 1,
                                    width: 200,
                                    editor: Ext.create('Colsys.Widgets.WgAgentesAduana', {
                                        id: 'id_agente' + me.idcliente
                                    }),
                                    renderer: comboBoxRenderer(Ext.getCmp('id_agente' + me.idcliente))
                                }, {
                                    header: 'Fecha Autorizaci&oacute;n',
                                    width: 140,
                                    dataIndex: 'fecha_autorizacion',
                                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                    editor: new Ext.form.DateField({
                                        id: 'fecha_autorizacion' + me.idcliente,
                                        width: 90,
                                        allowBlank: false,
                                        format: 'Y-m-d',
                                        useStrict: undefined
                                    })
                                }, {
                                    header: 'Fin de Vigencia',
                                    width: 120,
                                    dataIndex: 'fecha_vigencia',
                                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                    editor: new Ext.form.DateField({
                                        id: 'fecha_vigencia' + me.idcliente,
                                        width: 90,
                                        allowBlank: false,
                                        format: 'Y-m-d',
                                        useStrict: undefined
                                    })
                                }, {
                                    menuDisabled: true,
                                    sortable: false,
                                    xtype: 'actioncolumn',
                                    width: 40,
                                    items: [{
                                            isDisabled: function(view, rowIndex, colIndex, item, record) {
                                                if (!record.get('idcliente')) {
                                                    return true;
                                                }
                                            },
                                            getClass: function (v, meta, rec) {
                                                if (rec.get('idcliente')) {
                                                    return 'import';
                                                }
                                            },
                                            getTip: function (v, meta, rec) {
                                                if (rec.get('idcliente')) {
                                                    return 'Subir Documentos';
                                                }
                                            },
                                            handler: function (grid, rowIndex, colIndex) {
                                                var rec = grid.getStore().getAt(rowIndex);
                                                id_ag = rec.data.id_agente;
                                                if (win_arc == null) {
                                                    win_arc = Ext.create('Ext.window.Window', {
                                                        id: 'winArchivos',
                                                        title: 'Subir Archivos',
                                                        width: 900,
                                                        height: 500,
                                                        closeAction: 'destroy',
                                                        items: {
                                                            defaultType: 'container',
                                                            items: [{
                                                                    padding: '5 5 10 5',
                                                                    items: {
                                                                        xtype: 'Colsys.GestDocumental.treeGridFiles',
                                                                        id: 'tree-grid-file-agenteAduana' + me.idcliente,
                                                                        name: 'tree-grid-file',
                                                                        title: 'Listado de Archivos',
                                                                        height: 270,
                                                                        idsserie: 11,
                                                                        ref1: me.idcliente,
                                                                        treeStore: 'agenteAduana',
                                                                        idcliente: me.idcliente,
                                                                        habilitarToolbar: false
                                                                    }
                                                                }, {
                                                                    padding: '5 5 10 5',
                                                                    items: {
                                                                        xtype: 'Colsys.GestDocumental.FormSubirArchivos',
                                                                        title: 'Nuevo Archivo',
                                                                        id: 'subirArchivoAduana',
                                                                        width: 380,
                                                                        height: 160,
                                                                        idsserie: 11,
                                                                        idreferencia: me.idcliente,
                                                                        idcliente: me.idcliente,
                                                                        treeStore: 'agenteAduana',
                                                                        ref2: id_ag
                                                                    }
                                                                }]
                                                        },
                                                        listeners: {
                                                            beforeshow: function (win, e) {
                                                                /*archivo = Ext.getCmp("subirArchivo");
                                                                 storeArchivo = archivo.store;
                                                                 storeArchivo.id_agente = id_ag;
                                                                 storeArchivo.idcliente = me.idcliente;*/
                                                                tree = Ext.getCmp("tree-grid-file-agenteAduana" + me.idcliente);
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
                                                                        autoLoad: false
                                                                    },
                                                                    autoLoad: false
                                                                }));

                                                                store = tree.getStore();
                                                                store.load({
                                                                    params: {
                                                                        idsserie: 11, //Constante para Autorizaciones Clientes
                                                                        ref1: me.idcliente,
                                                                        ref2: id_ag
                                                                    }
                                                                });
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
                                        }, {
                                            // iconCls: 'delete',
                                            tooltip: 'Eliminar',
                                            id: 'btnAnular',
                                            isDisabled: function(view, rowIndex, colIndex, item, record) {
                                                return !me.permisos[18];
                                            },
                                            getClass: function(v, meta, rec) {
                                                if (rec.get('idcliente') && me.permisos[18]) {
                                                    return 'delete';
                                                }
                                            },
                                            getTip: function (v, meta, rec) {
                                                if (rec.get('idcliente') && me.permisos[18]) {
                                                    return 'Eliminar Registro';
l                                                }
                                            },
                                            handler: function (grid, rowIndex, colIndex) {
                                                var rec = grid.getStore().getAt(rowIndex);
                                                var store = Ext.getCmp("gridagenteAduana" + me.idcliente).getStore();
                                                if (rec.get('idcliente')) {
                                                    Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular el agente?', function (choice) {
                                                        if (choice == 'yes') {
                                                            Ext.Ajax.request({
                                                                waitMsg: 'Eliminado...',
                                                                url: '/clientes/anularAgaduanaAutorizado',
                                                                params: {
                                                                    idcliente: me.idcliente,
                                                                    id_agente: rec.data.id_agente
                                                                },
                                                                failure: function (response, options) {
                                                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                                    success = false;
                                                                },
                                                                success: function (response, options) {
                                                                    var res = Ext.JSON.decode(response.responseText);
                                                                    if (res.success) {
                                                                        store.reload();
                                                                    } else {
                                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            }
                                        }]
                                }
                            ]);
                    tb = new Ext.toolbar.Toolbar();
                    tb.add({
                        text: 'Adicionar',
                        tooltip: 'Adicionar un registro',
                        iconCls: 'add',
                        scope: this,
                        handler: function () {
                            var store = Ext.getCmp("gridagenteAduana" + me.idcliente).getStore();
                            var r = Ext.create(store.model);
                            store.insert(0, r);
                        },
                        listeners: {
                            beforerender: function () {
                                this.setVisible(me.permisos[16]);
                            }
                        }
                    }, {
                        text: 'Guardar',
                        tooltip: '',
                        iconCls: 'disk',
                        scope: this,
                        handler: function () {
                            var store = Ext.getCmp("gridagenteAduana" + me.idcliente).getStore();
                            var records = store.getModifiedRecords();
                            var lenght = records.length;
                            changes = [];
                            for (var i = 0; i < lenght; i++) {
                                r = records[i];
                                if (r.getChanges()) {
                                    records[i].data.id = r.id;
                                    changes[i] = records[i].data;
                                }
                            }
                            var str = JSON.stringify(changes);
                            if (str.length > 5) {
                                Ext.Ajax.request({
                                    url: '/clientes/guardarAgaduanaAutorizado',
                                    params: {
                                        datos: str,
                                        idcliente: me.idcliente
                                    },
                                    success: function (response, opts) {
                                        var res = Ext.decode(response.responseText);
                                        if (res.id && res.success) {
                                            var idclientes = res.idclientes;
                                            id = res.id;
                                            for (i = 0; i < id.length; i++) {
                                                var rec = store.getById(id[i]);
                                                rec.set('idcliente', idclientes[i]);
                                                rec.commit();
                                            }
                                            Ext.MessageBox.alert("Mensaje", 'Se guard&oacute; Correctamente la informaci&oacute;n');
                                        } else {
                                            Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar la fila <br>' + res.errorInfo);
                                        }
                                        store.reload();
                                    },
                                    failure: function (response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hide();
                                    }
                                });
                            }
                        },
                        listeners: {
                            beforerender: function () {
                                this.setVisible(me.permisos[17]);
                            }
                        }
                    });
                    this.addDocked(tb);
                }
            }
        });
