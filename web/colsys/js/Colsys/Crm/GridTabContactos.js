Ext.define('Colsys.Crm.GridTabContactos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridTabContactos',
    selType: 'cellmodel',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            
            this.reconfigure(
                    [{
                            header: 'Tipo',
                            width: 230,
                            dataIndex: 'tipo',
                            editor: {
                                xtype: 'combo-tipocontacto',
                                originalValue: '',
                                allowBlank: true
                            }
                        }, {
                            header: 'Contacto',
                            width: 400,
                            dataIndex: 'contacto',
                            editor: {
                                xtype: 'textfield',
                                originalValue: '',
                                allowBlank: true
                            }
                        }, {
                            header: 'Tel&eacute;fono',
                            width: 150,
                            dataIndex: 'telefono',
                            editor: {
                                xtype: 'textfield',
                                originalValue: '',
                                allowBlank: true
                            }
                        }, {
                            header: 'Convenio',
                            width: 170,
                            dataIndex: 'convenio',
                            editor: {
                                xtype: 'textfield',
                                originalValue: '',
                                allowBlank: true
                            }
                        }, {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 25,
                            items: [{
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar M&eacute;todo',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular el registro?', function (choice) {
                                            if (choice == 'yes') {
                                                grid.getStore().remove(rec);
                                            }
                                        });

                                    }
                                }]
                        }
                    ]);
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                iconCls: 'add',
                id: 'adicion-metodos'+me.idcliente,
                handler: function () {
                    var store = Ext.getCmp("gridTabContactos" + me.idcliente).store;
                    var r = Ext.create(store.model);
                    store.insert(0, r);
                }

            }
            );
            this.addDocked(tb);
        }
    }
});