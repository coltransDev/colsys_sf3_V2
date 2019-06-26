winNuevaRespuesta = null;
Ext.define('Colsys.Ino.GridRespuestas', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridRespuestas',    
    scrollable: true,
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {            
            if ((store.getCount() - 1) == rowIndex) {
                return "row_yellow";
            }else{
                return "row_gray";
            }
        }
    },
    listeners: {
        render: function (ct, position) {
            var me = this;
            this.reconfigure(                    
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
                        header: "Mensaje",
                        dataIndex: 'cuerpo' + this.idmaster,
                        hideable: false,
                        sortable: false,
                        flex: 4,
                        renderer: this.formatTitle
                    },
                    {
                        header: "fecha",
                        dataIndex: 'fecha' + this.idmaster,                            
                        flex: 1,
                        renderer: function (value, metaData, record, rowIdx, colIdx, store, view) {
                            var dt = record.get('fecha'+this.idmaster);
                            return '<div class="entry-date">'+Ext.util.Format.date(dt,'M-d-Y h:i A')+"</div>";
                        }
                    },
                    {
                        header: "encabezado",
                        dataIndex: 'encabezado' + this.idmaster,                        
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
                    }]
                }
            });

            tb = new Ext.toolbar.Toolbar();            
                tb.add({
                    xtype: 'button',
                    id:'button-nvarespuesta'+this.idmaster,
                    text: 'Nueva Respuesta',
                    height: 30,
                    iconCls: 'add',
                    disabled: true,
                    handler: function () {
                        idmaster = this.up('grid').idmaster;
                        idticket = this.up('grid').idticket;
                        
                        if (winNuevaRespuesta == null) {                            
                            winNuevaRespuesta = new Ext.Window({
                                title: 'Nuevo Seguimiento',
                                width: 500,
                                id: 'winnuevarespuesta' + idmaster,
                                autoHeight: true,
                                items: {
                                    xtype: 'Colsys.Ino.FormNuevaRespuesta',
                                    referencia: 'blabla',
                                    idmaster: idmaster,
                                    idticket: idticket,
                                    flex:1
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
                });
            this.addDocked(tb);
        }
    },
    formatTitle: function (value, p, record) {
        return Ext.String.format('<div class="topic"><b>{0}</b><span class="author">{1}</span></div>', record.get('ca_encabezado'), value);
    },
    formatDate: function (date) {
        return '<div class="entry-date">'+Ext.Date.format(date, "Y/m/d g:i a")+'</div>';
    }
});