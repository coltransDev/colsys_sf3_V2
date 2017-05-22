winSubirArchivo = null;
Ext.define('Colsys.Ino.GridDocumentosAuditoria', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridDocumentosAuditoria',
    id: 'griddocumentos' + this.idmaster,
    listeners: {
        rowdblclick: function (obj, record, tr, rowIndex, e, eOpts) {
            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                sorc: record.get('path')
            });
            windowpdf.show();

        },
        render: function (ct, position) {


            // this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            // this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
            this.reconfigure(
                    //     this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idarchivo' + this.idmaster, type: 'string', mapping: 'idarchivo'},
                            {name: 'name' + this.idmaster, type: 'string', mapping: 'name'},
                            {name: 'lastmod' + this.idmaster, type: 'string', mapping: 'lastmod'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/gestDocumental/dataArchivos',
                            reader: {
                                type: 'json',
                                rootProperty: 'files',
                                totalProperty: 'total'
                            }
                        }
                    }),
                    [
                        {
                            header: "idarchivo",
                            dataIndex: 'idarchivo' + this.idmaster,
                            hidden: true
                        },
                        {
                            header: " ",
                            dataIndex: 'name' + this.idmaster,
                            hideable: false,
                            sortable: false,
                            width: 290,
                            flex: 1
                        },
                        {
                            header: "lastmod",
                            dataIndex: 'lastmod' + this.idmaster,
                            width: 100,
                            hidden: true
                        }
                    ]
                    );
            this.getStore().load({
                params: {
                    folder: btoa('Projects/' + this.idticket)
                }
            });

            tb = new Ext.toolbar.Toolbar();
            if (this.idticket != -1) {
                tb.add(
                        {
                            xtype: 'button',
                            text: 'Nuevo',
                            height: 30,
                            iconCls: 'add',
                            handler: function () {
                                idmaster : this.idmaster;
                                if (winSubirArchivo == null) {
                                    winSubirArchivo = new Ext.Window({
                                        title: 'Subir Archivo',
                                        width: 300,
                                        id: 'winSubirArchivo' + idmaster,
                                        height: 150,
                                        //closeAction: 'close',
                                        items: {
                                            xtype: 'Colsys.Ino.FormSubirArchivo',
                                            idmaster: idmaster,
                                            folder: 'Projects/' + idticket
                                        },
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winSubirArchivo = null;
                                            }
                                        }
                                    })
                                }
                                winSubirArchivo.show();

                            }
                        }
                );
            }
            this.addDocked(tb);
        }

    }

});