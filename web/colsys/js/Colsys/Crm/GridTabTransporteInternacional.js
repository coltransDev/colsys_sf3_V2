var win_header = null;

Ext.define('Colsys.Crm.GridTabTransporteInternacional', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridTabTransporteInternacional',
    plugins: [
        Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        })
    ],
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.reconfigure(
                    [{
                            header: 'Tipo',
                            sortable: true,
                            width: 150,
                            dataIndex: 'tipoI' 
                        }, {
                            header: 'Nombre',
                            flex: 1,
                            sortable: true,
                            dataIndex: 'nombre_tipotransporteI'
                        }, {
                            header: 'Contacto',
                            flex: 1,
                            sortable: true,
                            dataIndex: 'contactoI'
                        }, {
                            header: 'Telefono',
                            width: 150,
                            sortable: true,
                            dataIndex: 'telefonoI'
                        }, {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            id: 'actioncolumn_ficha' + me.idcliente,
                            width: 40,
                            items: [{
                                    iconCls: 'page_white_edit',
                                    id: 'editarTransporte_ficha' + me.idcliente,
                                    tooltip: 'Editar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        rec.data.filaNumero = rowIndex;
                                        if (win_header == null) {
                                            win_header = new Ext.Window({
                                                id: 'winTransporteInternacional',
                                                title: 'Datos',
                                                width: 600,
                                                height: 370,
                                                items: {
                                                    xtype: 'Colsys.Crm.FormTabTransporteInternacional',
                                                    id: 'formTabTransporte',
                                                    idcliente: me.idcliente,
                                                    rec: rec
                                                },
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        win_header = null;
                                                    }
                                                }
                                            });
                                            win_header.show();
                                        }
                                        
                                    }
                                }, {
                                    iconCls: 'delete',
                                    id: 'eliminarTransporte_ficha' + me.idcliente,
                                    tooltip: 'Eliminar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        store = grid.getStore();
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea borrar el registro?', function (choice) {
                                            if (choice == 'yes') {
//                                                var store = storeFichaTecnicaTI;
                                                store.remove(rec);
                                            }
                                        });
                                    }
                                }]
                        }]
                    );
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Adicionar',
                id: 'adicionarTransporte_ficha' + me.idcliente,
                tooltip: 'Adicionar un registro', 
                iconCls: 'add',
                scope: this,
                handler: function () {
                    if (win_header == null) {
                        win_header = new Ext.Window({
                            id: 'winTransporteInternacional',
                            title: 'Datos',
                            width: 600,
                            height: 370,
                            items: {
                                xtype: 'Colsys.Crm.FormTabTransporteInternacional',
                                id: 'formTabTransporte',
                                idcliente: me.idcliente,
                                rec: null
                            },
                            listeners: {
                                destroy: function (obj, eOpts)
                                {
                                    win_header = null;
                                }
                            }
                        });
                        win_header.show();
                    }
                }
            });
            this.addDocked(tb);

        }
    },
    changeRenderer: function (val) {
        if (val > 0) {
            return '<span style="color:green;">' + val + '</span>';
        } else if (val < 0) {
            return '<span style="color:red;">' + val + '</span>';
        }
        return val;
    },
    pctChangeRenderer: function (val) {
        if (val > 0) {
            return '<span style="color:green;">' + val + '%</span>';
        } else if (val < 0) {
            return '<span style="color:red;">' + val + '%</span>';
        }
        return val;
    },
    renderRating: function (val) {
        switch (val) {
            case 0:
                return 'A';
            case 1:
                return 'B';
            case 2:
                return 'C';
        }
    },
    onSelectionChange: function (model, records) {
        var rec = records[0];
        if (rec) {
            this.getForm().loadRecord(rec);
        }
    }
});