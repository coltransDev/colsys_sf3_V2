var win_infofinanciera = null;

Ext.define('Colsys.Crm.GridTabDocumentos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridTabDocumentos',
    selType: 'cellmodel',
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
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
                    [{
                            header: 'idtipo',
                            width: 25,
                            dataIndex: 'idtipo',
                            hidden: true
                        }, {
                            xtype: "checkcolumn",
                            dataIndex: 'seleccionado',
                            width: 40,
                            listeners: {
                                checkchange: function (grid, rowIndex, colIndex) {
//                                    var record = storeControlFinanciero.getAt(rowIndex);
                                    var record = me.getStore().getAt(rowIndex);

                                    var fech = new Date();
                                    var dd = fech.getDate();
                                    if (dd < 10) {
                                        dd = "0" + dd;
                                    }
                                    var mm = fech.getMonth() + 1; //hoy es 0!
                                    if (mm < 10) {
                                        mm = "0" + mm;
                                    }
                                    var yyyy = fech.getFullYear();
                                    var hoy = yyyy + "-" + mm + "-" + dd;

                                    if (record.get('seleccionado')) {
                                        record.set('fch_documento', hoy);
                                    } else {
                                        record.set('fch_documento', '');
                                    }
                                }
                            }
                        }, {
                            header: 'Documento',
                            width: 200,
                            flex: 1,
                            dataIndex: 'documento'
                        }, {
                            header: 'Fecha Revisi&oacute;n',
                            width: 125,
                            dataIndex: 'fch_documento',
                            renderer: function (a, b, c, d) {
                                if (a) {
                                    var formattedDate = new Date(a);
                                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d;
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1;  // JavaScript months are 0-11
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    return y + "-" + m + "-" + d;
                                }
                            },
                            editor: new Ext.form.DateField({
                                width: 90,
                                format: 'Y-m-d',
                                useStrict: undefined
                            })
                        }, {
                            header: 'Observaciones',
                            flex: 1,
                            width: 120,
                            dataIndex: 'observaciones',
                            editor: {
                                xtype: 'textfield',
                                originalValue: '',
                                allowBlank: true
                            }
                        }]
                    );
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Seleccionar todo',
                iconCls: 'checklist',
                handler: function () {
                    var fech = new Date();
                    var dd = fech.getDate();
                    if (dd < 10) {
                        dd = "0" + dd;
                    }
                    var mm = fech.getMonth() + 1; //hoy es 0!
                    if (mm < 10) {
                        mm = "0" + mm;
                    }
                    var yyyy = fech.getFullYear();
                    var hoy = yyyy + "-" + mm + "-" + dd;
                    for (var i = 0; i < me.getStore().getTotalCount(); i++) {
                        var record = me.getStore().getAt(i);
                        record.set('seleccionado', true);
                        record.set('fch_documento', hoy);
                    }

                }
            }, {
                text: 'Deseleccionar todo',
                iconCls: 'no_checklist',
                handler: function () {
                    for (var i = 0; i < me.getStore().getTotalCount(); i++) {
                        var record = me.getStore().getAt(i);
                        record.set('seleccionado', false);
                        record.set('fch_documento', '');
                    }

                }
            });
            this.addDocked(tb);

        }
    }
});