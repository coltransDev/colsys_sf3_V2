winNuevaRespuesta = null;
Ext.define('Colsys.Ino.GridRespuestas', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridRespuestas',
    id: 'gridrespuestas' + this.idmaster,
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {

            if ((rowIndex % 2) == 0) {
                return "row_gray";
            }
            if ((store.getCount() - 1) == rowIndex) {
                return "row_yellow";
            }
        }
    },
    listeners: {
        render: function (ct, position) {


            // this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            // this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
            this.reconfigure(
                    //     this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'encabezado' + this.idmaster, type: 'string', mapping: 'ca_encabezado'},
                            {name: 'cuerpo' + this.idmaster, type: 'string', mapping: 'ca_cuerpo'},
                            {name: 'fecha' + this.idmaster, type: 'string', mapping: 'ca_fecha'},
                            {name: 'idticket' + this.idmaster, type: 'string', mapping: 'ca_idticket'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosRespuestas',
                            reader: {
                                type: 'json',
                                rootProperty: 'root',
                                totalProperty: 'total'
                            }
                        }
                    }),
                    [
                        {
                            header: "idticket",
                            dataIndex: 'idticket' + this.idmaster,
                            hidden: true
                        },
                        {
                            header: " ",
                            dataIndex: 'cuerpo' + this.idmaster,
                            hideable: false,
                            sortable: false,
                            width: 600,
                            flex: 1,
                            renderer: this.formatTitle
                        },
                        {
                            header: "fecha",
                            dataIndex: 'fecha' + this.idmaster,
                            //renderer: this.formatDate,
                            width: 100
                        },
                        {
                            header: "encabezado",
                            dataIndex: 'encabezado' + this.idmaster,
                            width: 100,
                            hidden: true
                        }


                    ]
                    );
            Ext.apply(this, {
                cls: 'feed-grid',
                viewConfig: {
                    itemId: 'view',
                    plugins: [{
                            pluginId: 'preview',
                            ptype: 'preview',
                            bodyField: 'description',
                            expanded: true
                        }],
                    listeners: {
                        // scope: this,
                        // itemdblclick: this.onRowDblClick
                    }
                }
            });
            this.getStore().load({
                params: {
                    idticket: this.idticket
                }
            });

            tb = new Ext.toolbar.Toolbar();
            if (this.idticket > 0) {
                tb.add({
                    xtype: 'button',
                    text: 'Nueva Respuesta',
                    height: 30,
                    iconCls: 'add',
                    handler: function () {
                        idmaster = this.up('grid').idmaster;
                        idticket = this.up('grid').idticket;

                        if (winNuevaRespuesta == null) {
                            winNuevaRespuesta = new Ext.Window({
                                title: 'Nueva Respuesta',
                                width: 800,
                                id: 'winnuevarespuesta' + idmaster,
                                height: 600,
                                //closeAction: 'close',
                                items: {
                                    xtype: 'Colsys.Ino.FormNuevaRespuesta',
                                    referencia: 'blabla',
                                    idmaster: idmaster,
                                    idticket: idticket
                                },
                                listeners: {
                                    close: function (win, eOpts) {
                                        winNuevaRespuesta = null;
                                    }
                                }
                            })
                        }
                        winNuevaRespuesta.show();
                    }
                }

                );
            }

            this.addDocked(tb);
        }

    },
    formatTitle: function (value, p, record) {
        return Ext.String.format('<div class="topic"><b>{0}</b><span class="author">{1}</span></div>', record.get('ca_encabezado'), value);
    },
    formatDate: function (date) {
        if (!date) {
            return '';
        }

        var now = new Date(), d = Ext.Date.clearTime(now, true), notime = Ext.Date.clearTime(date, true).getTime();

        if (notime === d.getTime()) {
            return 'Today ' + Ext.Date.format(date, 'g:i a');
        }

        d = Ext.Date.add(d, 'd', -6);
        if (d.getTime() <= notime) {
            return Ext.Date.format(date, 'D g:i a');
        }
        return Ext.Date.format(date, 'Y/m/d g:i a');
    }
});