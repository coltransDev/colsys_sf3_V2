var win_house = null;

Ext.define('Colsys.Ino.GridHouseRadicacion', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridHouseRadicacion',
    width: '100%',
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
            me.getStore().load();
            bbar = new Ext.PagingToolbar({
                dock: 'bottom',
                displayInfo: true,
                store: me.getStore(),
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            });
            me.addDocked(bbar);
            me.setHeight(this.up('container').getHeight());
        },
        render: function (ct, position) {
            var me = this;
            me.setHeight(me.up('container').getHeight());
        },
        beforerender: function (ct, position) {
            var me = this;
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        autoLoad: false,
                        fields: [
                            {name: 'idhouse', type: 'string'},
                            {name: 'doctransporte', type: 'string'},
                            {name: 'dispocarga', type: 'string'},
                            {name: 'disposicion', type: 'string'},
                            {name: 'coddeposito', type: 'string'},
                            {name: 'deposito', type: 'string'},
                            {name: 'bodega', type: 'string'},
                            {name: 'tipodocviaje', type: 'string'},
                            {name: 'tipodocumento', type: 'string'},
                            {name: 'idcondiciones', type: 'string'},
                            {name: 'condiciones', type: 'string'},
                            {name: 'responsabilidad', type: 'string'},
                            {name: 'tiponegociacion', type: 'string'},
                            {name: 'negociacion', type: 'string'},
                            {name: 'idprecursores', type: 'string'},
                            {name: 'vlrfob', type: 'string'},
                            {name: 'vlrflete', type: 'string'},
                            {name: 'iddocactual', type: 'string'},
                            {name: 'iddocanterior', type: 'string'},
                            {name: 'iddestino', type: 'string'},
                            {name: 'destino', type: 'string'},
                            {name: 'sinidentificacion', type: 'string'},
                            {name: 'nitdeposito', type: 'string'},
                            {name: 'mercancia_desc', type: 'string'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosHouseRadicacion',
                            reader: {
                                type: 'json',
                                transform: {
                                    fn: function (data) {
                                        me.setDisabled(!data.editable);
                                        return data.root;
                                    },
                                    scope: this
                                }
                            },
                            extraParams: {
                                idmaster: me.idmaster
                            }
                        }
                    }),
                    [
                        {
                            header: 'Doc.Transporte',
                            dataIndex: 'doctransporte',
                            width: 120
                        }, {
                            header: 'Disposici\u00F3n/Carga',
                            dataIndex: 'disposicion',
                            width: 85
                        }, {
                            header: 'Tipo Doc.Viaje',
                            dataIndex: 'tipodocumento',
                            width: 130
                        }, {
                            header: 'C43',
                            dataIndex: 'sinidentificacion',
                            width: 50
                        }, {
                            header: 'Negociaci\u00F3n',
                            dataIndex: 'negociacion',
                            width: 90
                        }, {
                            header: 'Dep\u00F3sito',
                            dataIndex: 'deposito',
                            flex: 1,
                            renderer: function (value, metaData, record, rowIdx, colIdx, store) {
                                if (record.get('bodega') != '') {
                                    metaData.tdAttr = 'data-qtip="Bodega: ' + record.get('bodega') + '"';
                                }
                                return value;
                            }
                        }, {
                            header: 'Descripci\u00F3n Mcia.',
                            dataIndex: 'mercancia_desc',
                            flex: 1
                        }, {
                            header: 'Dst.DTA/OTM',
                            dataIndex: 'carga',
                            width: 150
                        }, {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 41,
                            items: [{
                                    iconCls: 'page_white_edit',
                                    tooltip: 'Editar Radicaci\u00F3n House',
                                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                                        return !me.permisos.MuiscaEd;
                                    },
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (win_house == null) {
                                            win_house = new Ext.Window({
                                                id: 'winHouseRadicacion',
                                                title: 'Radicacion House',
                                                width: 900,
                                                height: 410,
                                                closeAction: 'destroy',
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        win_house = null;
                                                    }
                                                },
                                                items: {
                                                    xtype: 'Colsys.Ino.FormHouseRadicacion',
                                                    id: 'formHouseRadicacion',
                                                    idmaster: me.idmaster,
                                                    idhouse: rec.get("idhouse"),
                                                    doctransporte: rec.get("doctransporte")
                                                }
                                            });
                                        }
                                        win_house.show();
                                    }
                                }, {
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar Datos de Radicaci\u00F3n',
                                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                                        return !me.permisos.MuiscaEd;
                                    },
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea eliminar los datos?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminado...',
                                                    url: '/inoF2/eliminarHouseRadicacion',
                                                    params: {
                                                        idhouse: rec.get("idhouse")
                                                    },
                                                    failure: function (response, options) {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando los registros.<br>' + response.errorInfo);
                                                        success = false;
                                                    },
                                                    success: function (response, options) {
                                                        var res = Ext.JSON.decode(response.responseText);
                                                        if (res.success) {
                                                            grid.getStore().reload();
                                                        } else {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando los registros.<br>' + res.responseInfo);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }]
                        }
                    ]);
        }
    }
});