winNuevoTipo = null;

Ext.define('Colsys.Ino.GridAsignacionFacturas', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridAsignacionFacturas',
    selModel: {
        selType: 'cellmodel'
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    width: 500,
    height: 500,
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(490);
            this.setWidth(490);
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idmaster', mapping: 'idmaster'},
                            {name: 'idcomprobante', mapping: 'idcomprobante'},
                            {name: 'seleccionado', mapping: 'seleccionado'},
                            {name: 'referencia', mapping: 'referencia'},
                            {name: 'factura', mapping: 'factura'},
                            {name: 'cliente', mapping: 'cliente'}
                        ],
                        autoLoad: false,
                        remoteSort: true,
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosfacturasporreferenciaycliente',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    [{
                            text: "idmaster",
                            dataIndex: 'idmaster',
                            width: 70,
                            sortable: false,
                            hideable: false,
                            hidden: true
                        },
                        {
                            text: "idcomprobante",
                            dataIndex: 'idcomprobante',
                            width: 70,
                            sortable: false,
                            hideable: false,
                            hidden: true
                        },
                        {
                            xtype: "checkcolumn",
                            dataIndex: 'seleccionado',
                            sortable: false,
                            hideable: false,
                            width: 40,
                            listeners: {
                                checkchange: function (grid, rowIndex, colIndex) {


                                }
                            }
                        },
                        {
                            text: "Referencia",
                            dataIndex: 'referencia',
                            sortable: false,
                            hideable: false,
                            width: 150,
                        },
                        {
                            text: "Factura",
                            dataIndex: 'factura',
                            sortable: false,
                            hideable: false,
                            width: 100
                        },
                        {
                            text: "Cliente",
                            dataIndex: 'cliente',
                            sortable: false,
                            hideable: false,
                            width: 200
                        }
                    ]

                    );

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'button',
                text: 'Guardar',
                height: 30,
                iconCls: 'disk',
                handler: function () {
                    x = 0;
                    var idcom = this.up("grid").idcomprobante;
                    var idmast = this.up("grid").idmaster;
                    changes = [];
                    var storG = this.up('grid').getStore();
                    for (var i = 0; i < storG.getCount(); i++) {
                        var record = storG.getAt(i);


                        if (Ext.Object.getSize(record.getChanges()) != 0) {
                            record.data.id = record.id
                            changes[x] = record.data;
                            x++;
                        }
                    }
                    var strGrid = JSON.stringify(changes);

                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/inoF2/asignarAnticipoaFactura',
                        params: {
                            datosGrid: strGrid,
                            idcomprobante: idcom
                        },
                        failure: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.errorInfo)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function (response, options) {

                            var res = Ext.decode(response.responseText);
                            Ext.MessageBox.alert("Mensaje", 'Anticipo Asignado correctamente<br>');
                            storG.reload();
                            Ext.getCmp('panel-factura-' + idmast).getStore().reload();
                        }
                    });

                }
            }

            );
            this.addDocked(tb);
        },
        afterrender: function (ct, position) {
            store = this.getStore();
            idmaster = this.idmaster;
            idcliente = this.idcliente;
            cliente = this.cliente;
            idcomprobante = this.idcomprobante;
            store.load({
                params: {
                    idmaster: idmaster,
                    idcliente: idcliente,
                    cliente: cliente,
                    idreferencia: idcomprobante

                }
            });
        }
    }
}
);
