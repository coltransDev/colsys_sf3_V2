var win_infofinanciera = null;

Ext.define('Colsys.Crm.GridTabInfoFinanciera', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridTabInfoFinanciera',
    stripeRows: true,
    plugins: [{
            ptype: 'rowexpander',
            rowBodyTpl: new Ext.XTemplate(
                    '<table class="bgrGREYlight" align=center width="100%" height="99%" border=0>' +
                    '<tbody>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Inventarios</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_inventarios}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Patrimonios</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_patrimonios}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Utilidades</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_utilidades}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Ventas</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_ventas}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Activos en SMMLV</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_actsmmlv}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Indice de Liquidez</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_indliquidez}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Indice de Endeudamiento</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_indendeudamiento}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Prueba &aacute;cida</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_pbaacida}</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Ino</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_ino}</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>',
                    {
                        formatChange: function (v) {
                            var color = v >= 0 ? 'green' : 'red';
                            return '<span style="color: ' + color + ';">' + Ext.util.Format.usMoney(v) + '</span>';
                        }
                    })
        }],
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.reconfigure(
                    [{
                            header: 'A\u00F1o',
                            width: 60,
                            dataIndex: 'ca_anno',
                            editor: {xtype: "textfield"}
                        }, {
                            text: 'Activos',
                            columns: [{
                                    header: 'Totales',
                                    width: 130,
                                    dataIndex: 'ca_activostotales',
                                    renderer: Ext.util.Format.numberRenderer('0,000'),
                                    editor: {xtype: "textfield"}
                                }, {
                                    header: 'Corrientes',
                                    width: 130,
                                    dataIndex: 'ca_activoscorrientes',
                                    renderer: Ext.util.Format.numberRenderer('0,000'),
                                    editor: {xtype: "textfield"}
                                }]
                        }, {
                            text: 'Pasivos',
                            columns: [{
                                    header: 'Totales',
                                    width: 130,
                                    dataIndex: 'ca_pasivostotales',
                                    renderer: Ext.util.Format.numberRenderer('0,000'),
                                    editor: {xtype: "textfield"}
                                }, {
                                    header: 'Corrientes',
                                    width: 130,
                                    dataIndex: 'ca_pasivoscorrientes',
                                    renderer: Ext.util.Format.numberRenderer('0,000'),
                                    editor: {xtype: "textfield"}
                                }]

                        }, {
                            header: 'Inventarios',
                            width: 150,
                            hidden: true,
                            dataIndex: 'ca_inventarios',
                            renderer: Ext.util.Format.numberRenderer('0,000'),
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'Patrimonios',
                            width: 150,
                            hidden: true,
                            dataIndex: 'ca_patrimonios',
                            renderer: Ext.util.Format.numberRenderer('0,000'),
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'Utilidades',
                            width: 150,
                            hidden: true,
                            dataIndex: 'ca_utilidades',
                            renderer: Ext.util.Format.numberRenderer('0,000'),
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'Ventas',
                            hidden: true,
                            width: 150,
                            dataIndex: 'ca_ventas',
                            renderer: Ext.util.Format.numberRenderer('0,000'),
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'ca_actsmmlv',
                            hidden: true,
                            width: 150,
                            dataIndex: 'ca_actsmmlv',
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'ca_indliquidez',
                            hidden: true,
                            width: 150,
                            dataIndex: 'ca_indliquidez',
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'ca_indendeudamiento',
                            hidden: true,
                            width: 150,
                            dataIndex: 'ca_indendeudamiento',
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'ca_pbaacida',
                            hidden: true,
                            width: 150,
                            dataIndex: 'ca_pbaacida',
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        }, {
                            header: 'ca_ino',
                            hidden: true,
                            width: 150,
                            dataIndex: 'ca_ino',
                            renderer: Ext.util.Format.numberRenderer('0,000'),
                            hideTrigger: true,
                            decimalPrecision: 2,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            editor: {xtype: "textfield"}
                        },
                        {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            id: 'actioncolumn_ControlFinanciero' + me.idcliente,
                            width: 40,
                            items: [{
                                    iconCls: 'page_white_edit',
                                    id: 'editar_ControlFinanciero' + me.idcliente,
                                    tooltip: 'Editar registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (win_infofinanciera == null)
                                        {
                                            win_infofinanciera = new Ext.Window({
                                                title: 'Datos financieros',
                                                width: 530,
                                                height: 390,
                                                id: "winFormEdit",
                                                name: "winFormEdit",
                                                items:
                                                        {
                                                            xtype: 'Colsys.Crm.FormTabInfoFinanciera',
                                                            id: 'formTabInfoFinanciera',
                                                            idcliente: me.idcliente,
                                                            rec: rec
                                                        },
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        win_infofinanciera = null;
                                                    }
                                                }
                                            });
                                            win_infofinanciera.show();
                                        }

                                    }
                                }, {
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular el registro?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminado...',
                                                    url: '/clientes/anularInfoFinanciera',
                                                    params: {
                                                        idcliente: me.idcliente,
                                                        anno: rec.data.ca_anno
                                                    },
                                                    failure: function (response, options) {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                                        success = false;
                                                    },
                                                    success: function (response, options) {
                                                        var res = Ext.JSON.decode(response.responseText);
                                                        if (res.success) {
                                                            store = grid.getStore();
                                                            store.reload();
                                                        } else {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }]
                        }
                    ]
                    );
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Adicionar',
                id: 'adicionarInfoFinanciera_ControlFinanciero' + me.idcliente,
                tooltip: 'Adicionar un registro',
                iconCls: 'add',
                scope: this,
                handler: function () {
                    if (win_infofinanciera == null) {
                        win_infofinanciera = new Ext.Window({
                            title: 'Datos financieros',
                            width: 530,
                            height: 390,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            items:
                                    {
                                        xtype: 'Colsys.Crm.FormTabInfoFinanciera',
                                        id: 'formTabInfoFinanciera',
                                        idcliente: me.idcliente,
                                        rec: null
                                    },
                            listeners: {
                                destroy: function (obj, eOpts)
                                {
                                    win_infofinanciera = null;
                                }
                            }
                        });
                        win_infofinanciera.show();
                    }
                }
            });
            this.addDocked(tb);

        }
    }
});